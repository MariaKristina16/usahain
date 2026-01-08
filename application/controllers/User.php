<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(['url','form']);
        $this->load->library('form_validation');
    }

    // List users (HTML)
    public function index()
    {
        $data['users'] = $this->User_model->get();
        $this->load->view('user/index', $data);
    }

    // User dashboard (visual summary)
    public function dashboard()
{
    if (!$this->session->userdata('id_user')) {
        redirect('auth/login');
    }

    // ambil data user dari session
    $data['user'] = [
        'nama'  => $this->session->userdata('nama'),
        'email' => $this->session->userdata('email'),
        'role'  => $this->session->userdata('role'),
        'usaha' => $this->session->userdata('nama_usaha') ?? 'Bisnis Anda',
        'type'  => 'UMKM'
    ];

    // dummy data (nanti bisa dari DB)
    $data['summary'] = [
        'today_sales'   => 150000,
        'today_expense' => 75000,
        'today_profit'  => 75000
    ];

    $data['transactions'] = [
        [
            'title' => 'Penjualan 10 porsi',
            'time'  => 'Hari ini',
            'amount'=> 150000
        ],
        [
            'title' => 'Beli bahan baku',
            'time'  => 'Hari ini',
            'amount'=> -75000
        ]
    ];

    $this->load->view('user/dashboard', $data);
}


    // Show single user (HTML)
    public function view($id = null)
    {
        if (!$id) { show_404(); return; }
        $data['user'] = $this->User_model->get($id);
        if (!$data['user']) { show_404(); return; }
        $this->load->view('user/view', $data);
    }

    // Create user (form GET, submit POST)
    public function create()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[200]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[250]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'role' => $this->input->post('role') ?: 'user',
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'nama_usaha' => $this->input->post('nama_usaha'),
                ];
                $this->User_model->insert($data);
                redirect('user');
                return;
            }
        }

        $this->load->view('user/form');
    }

    // Edit user (form GET, submit POST)
    public function edit($id = null)
    {
        if (!$id) { show_404(); return; }
        $user = $this->User_model->get($id);
        if (!$user) { show_404(); return; }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[200]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[250]');
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]');

            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'role' => $this->input->post('role'),
                    'email' => $this->input->post('email'),
                    'nama_usaha' => $this->input->post('nama_usaha'),
                ];
                $pwd = $this->input->post('password');
                if ($pwd) {
                    $data['password'] = password_hash($pwd, PASSWORD_BCRYPT);
                }
                $this->User_model->update($id, $data);
                redirect('user');
                return;
            }
        }

        $data['user'] = $user;
        $this->load->view('user/form', $data);
    }

    // Delete user (show confirmation on GET, delete on POST)
    public function delete($id = null)
    {
        if (!$id) { show_404(); return; }
        if ($this->input->method() !== 'post') {
            $data['user'] = $this->User_model->get($id);
            if (!$data['user']) { show_404(); return; }
            $this->load->view('user/delete', $data);
            return;
        }
        $this->User_model->delete($id);
        redirect('user');
    }

    /**
     * Simpan informasi bisnis dari form perencanaan (AJAX)
     * Endpoint: POST /user/save_bisnis_info
     * IMPORTANT: Must return ONLY JSON, no HTML or other output
     */
    public function save_bisnis_info()
    {
        // Disable output buffering - return JSON ONLY
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        
        // ===== CRITICAL: Set JSON header FIRST =====
        header('Content-Type: application/json; charset=utf-8');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        
        // ===== STEP 1: CHECK SESSION =====
        if (!$this->session->userdata('id_user')) {
            http_response_code(401);
            echo json_encode([
                'status' => 'error',
                'code' => 'UNAUTHORIZED',
                'message' => 'Anda harus login terlebih dahulu'
            ]);
            exit;
        }
        
        $id_user = $this->session->userdata('id_user');
        
        // ===== STEP 2: GET INPUT (JSON or Form) =====
        $input = [];
        $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
        
        if (strpos($content_type, 'application/json') !== false) {
            // JSON input (from fetch/AJAX)
            $input = json_decode(file_get_contents('php://input'), true) ?: [];
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Form data (fallback)
            $input = $_POST;
        }
        
        // ===== STEP 3: EXTRACT & TRIM DATA =====
        $nama_usaha = isset($input['nama_usaha']) ? trim($input['nama_usaha']) : '';
        $jenis_usaha = isset($input['jenis_usaha']) ? trim($input['jenis_usaha']) : '';
        
        // ===== STEP 4: VALIDATION =====
        $errors = [];
        
        // Check if at least one field is provided
        if (empty($nama_usaha) && empty($jenis_usaha)) {
            $errors[] = 'Minimal salah satu field harus diisi';
        }
        
        // Validate nama_usaha
        if (!empty($nama_usaha)) {
            if (strlen($nama_usaha) < 3) {
                $errors[] = 'Nama usaha minimal 3 karakter';
            }
            if (strlen($nama_usaha) > 100) {
                $errors[] = 'Nama usaha maksimal 100 karakter';
            }
        }
        
        // Validate jenis_usaha
        if (!empty($jenis_usaha)) {
            if (strlen($jenis_usaha) < 3) {
                $errors[] = 'Jenis usaha minimal 3 karakter';
            }
            if (strlen($jenis_usaha) > 100) {
                $errors[] = 'Jenis usaha maksimal 100 karakter';
            }
        }
        
        // Return validation errors
        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'code' => 'VALIDATION_ERROR',
                'message' => implode(', ', $errors)
            ]);
            exit;
        }
        
        // ===== STEP 5: UPDATE DATABASE (Prepared Statement) =====
        try {
            $updated_at = date('Y-m-d H:i:s');
            
            // Build dynamic query
            $update_fields = [];
            $values = [];
            
            if (!empty($nama_usaha)) {
                $update_fields[] = 'nama_usaha = ?';
                $values[] = $nama_usaha;
            }
            
            if (!empty($jenis_usaha)) {
                $update_fields[] = 'jenis_usaha = ?';
                $values[] = $jenis_usaha;
            }
            
            // Always update timestamp
            $update_fields[] = 'updated_at = ?';
            $values[] = $updated_at;
            
            // Add id_user for WHERE clause
            $values[] = $id_user;
            
            // Build types string
            $types = str_repeat('s', count($values) - 1) . 'i'; // s for strings, i for id_user
            
            // SQL query
            $sql = 'UPDATE user SET ' . implode(', ', $update_fields) . ' WHERE id_user = ?';
            
            // Prepare statement
            $stmt = $this->db->conn->prepare($sql);
            
            if (!$stmt) {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'code' => 'PREPARE_ERROR',
                    'message' => 'Gagal mempersiapkan query',
                    'debug' => $this->db->conn->error
                ]);
                exit;
            }
            
            // Bind parameters
            if (!$stmt->bind_param($types, ...$values)) {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'code' => 'BIND_ERROR',
                    'message' => 'Gagal binding parameter',
                    'debug' => $stmt->error
                ]);
                $stmt->close();
                exit;
            }
            
            // Execute query
            if (!$stmt->execute()) {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'code' => 'EXECUTE_ERROR',
                    'message' => 'Gagal mengupdate database',
                    'debug' => $stmt->error
                ]);
                $stmt->close();
                exit;
            }
            
            $stmt->close();
            
            // ===== STEP 6: VERIFY DATA =====
            $result = $this->db->conn->query('SELECT * FROM user WHERE id_user = ' . (int)$id_user);
            
            if (!$result || $result->num_rows === 0) {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'code' => 'VERIFY_ERROR',
                    'message' => 'Data gagal tersimpan atau user tidak ditemukan'
                ]);
                exit;
            }
            
            $user = $result->fetch_assoc();
            
            // ===== STEP 7: UPDATE SESSION =====
            if (!empty($nama_usaha)) {
                $this->session->set_userdata('nama_usaha', $nama_usaha);
            }
            if (!empty($jenis_usaha)) {
                $this->session->set_userdata('jenis_usaha', $jenis_usaha);
            }
            $this->session->set_userdata('updated_at', $updated_at);
            
            // ===== STEP 8: SUCCESS RESPONSE =====
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'code' => 'OK',
                'message' => 'Data berhasil disimpan',
                'data' => [
                    'id_user' => $id_user,
                    'nama_usaha' => $user['nama_usaha'] ?? '',
                    'jenis_usaha' => $user['jenis_usaha'] ?? '',
                    'updated_at' => $updated_at
                ]
            ]);
            exit;
            
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'code' => 'EXCEPTION',
                'message' => 'Terjadi kesalahan server',
                'debug' => $e->getMessage()
            ]);
            exit;
        }
    }
}

