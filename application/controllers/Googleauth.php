<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Google OAuth 2.0 Authentication Controller
 *
 * Handles:
 * - Redirect to Google login page
 * - Callback from Google with authorization code
 * - Exchange code for access token
 * - Get user profile from Google
 * - Create/update user in database
 * - Set session for logged in user
 */
class Googleauth extends CI_Controller
{

    private $google_client;
    private $google_service;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->config('google_oauth');
        $this->load->helper(['url', 'cookie']);

        // Initialize Google Client
        $this->_init_google_client();
    }

    /**
     * Initialize Google OAuth Client
     */
    private function _init_google_client()
    {
        try {
            // Load autoloader from composer
            $autoload_path = FCPATH . 'vendor/autoload.php';
            if (!file_exists($autoload_path)) {
                log_message('error', 'Composer autoload not found: ' . $autoload_path);
                return false;
            }
            require_once $autoload_path;

            // Get credentials from config
            $client_id     = trim($this->config->item('google_client_id') ?? '');
            $client_secret = trim($this->config->item('google_client_secret') ?? '');

            // Log for debugging
            log_message('debug', 'Google OAuth: ID length ' . strlen($client_id) . ', Secret length ' . strlen($client_secret));

            // Validate credentials are set
            if (empty($client_id) || empty($client_secret)) {
                log_message('error', 'Google OAuth credentials empty');
                log_message('error', 'Set GOOGLE_CLIENT_ID and GOOGLE_CLIENT_SECRET in .env file at: ' . FCPATH . '.env');
                return false;
            }

            // Check if Google_Client class exists
            if (!class_exists('Google_Client')) {
                log_message('error', 'Google_Client class not found. Run: composer install');
                return false;
            }

            // Create and configure Google Client
            $this->google_client = new Google_Client();
            $this->google_client->setClientId($client_id);
            $this->google_client->setClientSecret($client_secret);
            $this->google_client->setRedirectUri($this->config->item('google_redirect_uri'));
            $this->google_client->setScopes($this->config->item('google_scopes'));
            $this->google_client->setAccessType($this->config->item('google_access_type'));
            
            // Use setPrompt untuk force account selection
            $this->google_client->setPrompt('select_account');

            log_message('info', 'Google_Client initialized successfully');
            return true;
        } catch (Exception $e) {
            log_message('error', 'Google Client init error: ' . $e->getMessage());
            log_message('error', 'Class: ' . get_class($e));
            return false;
        }
    }

    /**
     * Redirect user to Google OAuth consent screen
     */
    public function login()
    {
        // Check if OAuth is configured
        if (!$this->google_client) {
            log_message('error', 'Google OAuth not initialized - credentials missing or config failed');
            $error_msg = 'Google OAuth tidak tersedia.<br>' .
                '<small>Fix: Edit file .env di root project, tambahkan:<br>' .
                'GOOGLE_CLIENT_ID=xxx<br>' .
                'GOOGLE_CLIENT_SECRET=xxx</small>';
            $this->session->set_flashdata('error', $error_msg);
            redirect('auth/login');
            return;
        }

        try {
            // Save redirect parameter to session if provided
            $redirect = $this->input->get('redirect');
            if ($redirect && filter_var($redirect, FILTER_VALIDATE_URL)) {
                $this->session->set_userdata('oauth_redirect', $redirect);
            }

            // Create state token to prevent CSRF
            $state = bin2hex(random_bytes(16));
            $this->session->set_userdata('oauth_state', $state);
            $this->google_client->setState($state);

            // Generate and redirect to auth URL
            $auth_url = $this->google_client->createAuthUrl();
            redirect($auth_url);

        } catch (Exception $e) {
            log_message('error', 'Google OAuth Login Error: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menghubungkan ke Google: ' . $e->getMessage());
            redirect('auth/login');
        }
    }

    /**
     * Handle callback from Google after user authorization
     */
    public function callback()
    {
        try {
            // Verify state to prevent CSRF
            $state         = $this->input->get('state');
            $session_state = $this->session->userdata('oauth_state');

            if (!$state || $state !== $session_state) {
                log_message('error', 'CSRF attack detected. State mismatch in OAuth callback');
                $this->session->set_flashdata('error', 'Invalid state parameter. Possible CSRF attack.');
                redirect('auth/login');
                return;
            }

            // Clear state from session
            $this->session->unset_userdata('oauth_state');

            // Check for error from Google
            $error = $this->input->get('error');
            if ($error) {
                $error_description = $this->input->get('error_description', 'Unknown error');
                log_message('error', 'Google OAuth Error: ' . $error . ' - ' . $error_description);
                $this->session->set_flashdata('error', 'Google authentication cancelled or failed: ' . $error_description);
                redirect('auth/login');
                return;
            }

            // Get authorization code
            $code = $this->input->get('code');
            if (!$code) {
                log_message('error', 'No authorization code received from Google');
                $this->session->set_flashdata('error', 'No authorization code received from Google.');
                redirect('auth/login');
                return;
            }

            // Exchange authorization code for access token
            try {
                log_message('debug', 'Attempting to fetch access token with code: ' . substr($code, 0, 20) . '...');
                
                $token = $this->google_client->fetchAccessTokenWithAuthCode($code);
                
                log_message('debug', 'Access token fetched successfully');

            } catch (\Exception $e) {
                // Handle any exception from token fetch
                log_message('error', 'Exception fetching token: ' . $e->getMessage());
                log_message('error', 'Exception class: ' . get_class($e));
                
                // Check if error is in response
                $prev = $e->getPrevious();
                if ($prev) {
                    log_message('error', 'Previous exception: ' . $prev->getMessage());
                }
                
                $this->session->set_flashdata('error', 'Failed to get authorization token from Google. Please try again.');
                redirect('auth/login');
                return;
            }

            if (isset($token['error'])) {
                log_message('error', 'Google OAuth Token Error: ' . json_encode($token));
                $error_desc = $token['error_description'] ?? $token['error'] ?? 'Unknown error';
                $this->session->set_flashdata('error', 'Failed to authenticate with Google: ' . $error_desc);
                redirect('auth/login');
                return;
            }

            // Validate token
            if (empty($token)) {
                log_message('error', 'Empty token response from Google');
                $this->session->set_flashdata('error', 'Empty token response from Google. Please try again.');
                redirect('auth/login');
                return;
            }

            // Set access token
            $this->google_client->setAccessToken($token);

            // Get user profile information
            $google_oauth        = new Google_Service_Oauth2($this->google_client);
            $google_account_info = $google_oauth->userinfo->get();

            // Extract user data
            $google_id = $google_account_info->id;
            $email     = $google_account_info->email;
            $name      = $google_account_info->name ?? 'Google User';
            $picture   = $google_account_info->picture ?? null;

            // Log for debugging
            log_message('info', 'Google OAuth successful for email: ' . $email);

            // Check if user exists by google_id
            $user = $this->Auth_model->get_user_by_google_id($google_id);

            if ($user) {
                // User exists, update last login and avatar
                $update_data = [
                    'avatar_url' => $picture,
                ];
                $this->Auth_model->update_user($user->id_user, $update_data);
                log_message('info', 'Existing Google user logged in: ' . $email);

            } else {
                // Check if email already exists (local account)
                $existing_user = $this->Auth_model->get_user_by_email($email);

                if ($existing_user) {
                    // Link Google account to existing local account
                    $update_data = [
                        'google_id'      => $google_id,
                        'oauth_provider' => 'google',
                        'avatar_url'     => $picture,
                    ];
                    $this->Auth_model->update_user($existing_user->id_user, $update_data);
                    $user = $existing_user;
                    log_message('info', 'Google account linked to existing local account: ' . $email);

                } else {
                    // Create new user
                    $user_data = [
                        'google_id'      => $google_id,
                        'oauth_provider' => 'google',
                        'nama'           => $name,
                        'email'          => $email,
                        'avatar_url'     => $picture,
                        'password'       => null, // OAuth users don't have password
                        'role'           => 'user',
                    ];

                    $user_id = $this->Auth_model->create_user($user_data);
                    $user    = $this->Auth_model->get_user_by_id($user_id);
                    log_message('info', 'New Google user created: ' . $email);
                }
            }

            // Check if user still doesn't exist
            if (!$user) {
                log_message('error', 'Failed to retrieve user after Google OAuth: ' . $email);
                $this->session->set_flashdata('error', 'Failed to create/retrieve user from database.');
                redirect('auth/login');
                return;
            }

            // Set session for logged in user
            $this->session->set_userdata([
                'id_user'        => $user->id_user,
                'nama'           => $user->nama,
                'email'          => $user->email,
                'role'           => $user->role,
                'avatar_url'     => $user->avatar_url ?? null,
                'oauth_provider' => 'google',
                'logged_in'      => true,
            ]);

            // Check if there's a redirect URL stored in session
            $redirect_url = $this->session->userdata('oauth_redirect');
            if ($redirect_url) {
                $this->session->unset_userdata('oauth_redirect');
                redirect($redirect_url);
                return;
            }

            // Redirect based on role
            if ($user->role === 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('auth/dashboard');
            }

        } catch (Exception $e) {
            log_message('error', 'Google OAuth Exception: ' . $e->getMessage() . '\nStack: ' . $e->getTraceAsString());
            $this->session->set_flashdata('error', 'An error occurred during Google authentication: ' . $e->getMessage());
            redirect('auth/login');
        }
    }

    /**
     * Logout and revoke Google access (optional)
     */
    public function logout()
    {
        // Optional: Revoke access token
        if ($this->session->userdata('oauth_provider') === 'google') {
            try {
                if ($this->google_client) {
                    $this->google_client->revokeToken();
                }
            } catch (Exception $e) {
                log_message('warning', 'Failed to revoke Google token: ' . $e->getMessage());
            }
        }

        // Destroy session
        $this->session->sess_destroy();

        $this->session->set_flashdata('success', 'You have been logged out successfully.');
        redirect('auth/login');
    }
}
