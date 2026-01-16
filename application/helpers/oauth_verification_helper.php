<?php
/**
 * OAuth Verification Helper
 * 
 * Helper untuk verify dan test Google OAuth setup
 */

// Load .env file
if (file_exists(FCPATH . '.env')) {
    $env_contents = file_get_contents(FCPATH . '.env');
    $env_lines = explode("\n", $env_contents);
    foreach ($env_lines as $line) {
        $line = trim($line);
        if (!empty($line) && strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

// Check Google OAuth config
if (!function_exists('check_google_oauth_config')) {
    function check_google_oauth_config() {
        $checks = [];
        
        // Check .env exists
        $checks['env_exists'] = [
            'name' => 'File .env exists',
            'pass' => file_exists(FCPATH . '.env'),
            'message' => file_exists(FCPATH . '.env') ? 'OK' : 'File .env tidak ditemukan di root'
        ];
        
        // Check .env readable
        $checks['env_readable'] = [
            'name' => '.env is readable',
            'pass' => is_readable(FCPATH . '.env'),
            'message' => is_readable(FCPATH . '.env') ? 'OK' : 'File .env tidak bisa dibaca'
        ];
        
        // Check GOOGLE_CLIENT_ID
        $checks['client_id'] = [
            'name' => 'GOOGLE_CLIENT_ID configured',
            'pass' => !empty(getenv('GOOGLE_CLIENT_ID')),
            'message' => !empty(getenv('GOOGLE_CLIENT_ID')) ? 'Set: ' . substr(getenv('GOOGLE_CLIENT_ID'), 0, 20) . '...' : 'Not set in .env'
        ];
        
        // Check GOOGLE_CLIENT_SECRET
        $checks['client_secret'] = [
            'name' => 'GOOGLE_CLIENT_SECRET configured',
            'pass' => !empty(getenv('GOOGLE_CLIENT_SECRET')),
            'message' => !empty(getenv('GOOGLE_CLIENT_SECRET')) ? 'Set: ' . substr(getenv('GOOGLE_CLIENT_SECRET'), 0, 20) . '...' : 'Not set in .env'
        ];
        
        // Check composer autoload
        $checks['composer'] = [
            'name' => 'Composer autoload exists',
            'pass' => file_exists(FCPATH . 'vendor/autoload.php'),
            'message' => file_exists(FCPATH . 'vendor/autoload.php') ? 'OK' : 'Run: composer install'
        ];
        
        // Check Google API Client
        if (file_exists(FCPATH . 'vendor/autoload.php')) {
            require_once(FCPATH . 'vendor/autoload.php');
            $checks['google_apiclient'] = [
                'name' => 'Google API Client library',
                'pass' => class_exists('Google_Client'),
                'message' => class_exists('Google_Client') ? 'OK - google/apiclient installed' : 'Not installed'
            ];
        }
        
        return $checks;
    }
}

// Check database schema
if (!function_exists('check_database_schema')) {
    function check_database_schema(&$CI) {
        $checks = [];
        
        try {
            // Check google_id column
            $result = $CI->db->query("DESCRIBE user")->result();
            $columns = array_map(function($col) { return $col->Field; }, $result);
            
            $checks['google_id_column'] = [
                'name' => 'Table user has google_id column',
                'pass' => in_array('google_id', $columns),
                'message' => in_array('google_id', $columns) ? 'OK' : 'Missing column: google_id'
            ];
            
            $checks['oauth_provider_column'] = [
                'name' => 'Table user has oauth_provider column',
                'pass' => in_array('oauth_provider', $columns),
                'message' => in_array('oauth_provider', $columns) ? 'OK' : 'Missing column: oauth_provider'
            ];
            
            $checks['avatar_url_column'] = [
                'name' => 'Table user has avatar_url column',
                'pass' => in_array('avatar_url', $columns),
                'message' => in_array('avatar_url', $columns) ? 'OK' : 'Missing column: avatar_url'
            ];
            
            // Check google users
            $google_users = $CI->db->get_where('user', ['oauth_provider' => 'google'])->num_rows();
            $checks['google_users'] = [
                'name' => 'Google OAuth users in database',
                'pass' => $google_users >= 0,
                'message' => 'Count: ' . $google_users
            ];
            
        } catch (Exception $e) {
            $checks['database_error'] = [
                'name' => 'Database connection',
                'pass' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
        
        return $checks;
    }
}

// Check routes
if (!function_exists('check_oauth_routes')) {
    function check_oauth_routes() {
        $checks = [];
        
        // Check routes file exists
        $checks['routes_file'] = [
            'name' => 'Routes file exists',
            'pass' => file_exists(FCPATH . 'application/config/routes.php'),
            'message' => file_exists(FCPATH . 'application/config/routes.php') ? 'OK' : 'routes.php not found'
        ];
        
        // Check Googleauth controller exists
        $checks['googleauth_controller'] = [
            'name' => 'Googleauth controller exists',
            'pass' => file_exists(FCPATH . 'application/controllers/Googleauth.php'),
            'message' => file_exists(FCPATH . 'application/controllers/Googleauth.php') ? 'OK' : 'Googleauth.php not found'
        ];
        
        // Check Auth model exists
        $checks['auth_model'] = [
            'name' => 'Auth model exists',
            'pass' => file_exists(FCPATH . 'application/models/Auth_model.php'),
            'message' => file_exists(FCPATH . 'application/models/Auth_model.php') ? 'OK' : 'Auth_model.php not found'
        ];
        
        return $checks;
    }
}

// Format check result HTML
if (!function_exists('format_check_html')) {
    function format_check_html($checks) {
        $html = '';
        foreach ($checks as $key => $check) {
            $status_class = $check['pass'] ? 'pass' : 'fail';
            $status_icon = $check['pass'] ? '✓' : '✗';
            $html .= '<div class="check ' . $status_class . '">';
            $html .= '<span class="icon">' . $status_icon . '</span>';
            $html .= '<span class="name">' . $check['name'] . '</span>';
            $html .= '<span class="message">' . $check['message'] . '</span>';
            $html .= '</div>';
        }
        return $html;
    }
}
