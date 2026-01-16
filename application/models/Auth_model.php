<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    protected $table = 'user';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Register user baru
     */
    public function register($nama, $email, $password, $nama_usaha = null)
    {
        $data = [
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'nama_usaha' => $nama_usaha,
            'role' => 'user'
        ];
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Login user dengan email dan password
     */
    public function login($email, $password)
    {
        $user = $this->db->get_where($this->table, ['email' => $email])->row();
        
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    /**
     * Cek apakah email sudah terdaftar
     */
    public function email_exists($email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->num_rows() > 0;
    }

    /**
     * Get user by ID
     */
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id_user' => $id])->row();
    }
}

