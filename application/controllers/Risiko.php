<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Risiko extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Allow public access (no login required)
        $this->load->helper(['url','form']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $data['risiko_list'] = $this->db->get_where('manajemen_risiko', ['id_user' => $id_user])->result();
        $this->load->view('risiko/index', $data);
    }

    public function view($id = null)
    {
        if (!$id) { show_404(); return; }
        $id_user = $this->session->userdata('id_user');
        $risiko = $this->db->get_where('manajemen_risiko', ['id_risiko' => $id, 'id_user' => $id_user])->row();
        if (!$risiko) { show_404(); return; }
        $data['risiko'] = $risiko;
        $this->load->view('risiko/view', $data);
    }

    public function create()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'required|max_length[100]');
            $this->form_validation->set_rules('daftar_risiko', 'Daftar Risiko', 'required');
            $this->form_validation->set_rules('rekomendasi_mitigasi', 'Rekomendasi Mitigasi', 'required');

            if ($this->form_validation->run() === TRUE) {
                $id_user = $this->session->userdata('id_user');
                $data = [
                    'id_user' => $id_user,
                    'jenis_usaha' => $this->input->post('jenis_usaha'),
                    'daftar_risiko' => $this->input->post('daftar_risiko'),
                    'rekomendasi_mitigasi' => $this->input->post('rekomendasi_mitigasi'),
                ];
                $this->db->insert('manajemen_risiko', $data);
                redirect('risiko');
                return;
            }
        }
        $this->load->view('risiko/form');
    }

    public function edit($id = null)
    {
        if (!$id) { show_404(); return; }
        $id_user = $this->session->userdata('id_user');
        $risiko = $this->db->get_where('manajemen_risiko', ['id_risiko' => $id, 'id_user' => $id_user])->row();
        if (!$risiko) { show_404(); return; }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'required|max_length[100]');
            $this->form_validation->set_rules('daftar_risiko', 'Daftar Risiko', 'required');
            $this->form_validation->set_rules('rekomendasi_mitigasi', 'Rekomendasi Mitigasi', 'required');

            if ($this->form_validation->run() === TRUE) {
                $update_data = [
                    'jenis_usaha' => $this->input->post('jenis_usaha'),
                    'daftar_risiko' => $this->input->post('daftar_risiko'),
                    'rekomendasi_mitigasi' => $this->input->post('rekomendasi_mitigasi'),
                ];
                $this->db->where('id_risiko', $id)->update('manajemen_risiko', $update_data);
                redirect('risiko');
                return;
            }
        }

        $data['risiko'] = $risiko;
        $this->load->view('risiko/form', $data);
    }

    public function delete($id = null)
    {
        if (!$id) { show_404(); return; }
        $id_user = $this->session->userdata('id_user');
        $risiko = $this->db->get_where('manajemen_risiko', ['id_risiko' => $id, 'id_user' => $id_user])->row();
        if (!$risiko) { show_404(); return; }

        if ($this->input->method() !== 'post') {
            $data['risiko'] = $risiko;
            $this->load->view('risiko/delete', $data);
            return;
        }

        $this->db->where('id_risiko', $id)->delete('manajemen_risiko');
        redirect('risiko');
    }
}

