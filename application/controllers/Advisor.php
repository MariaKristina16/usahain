<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advisor extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Allow public access: all advisor features accessible without login
        $this->load->helper(['url','form']);
        $this->load->library('form_validation');
        $this->load->model('Al_advisor_model');
    }

    public function index()
    {
        // Show the advisor form directly as the main advisor page
        $this->load->view('advisor/form');
    }

    public function view($id = null)
    {
        if (!$id) { show_404(); return; }
        $id_user = $this->session->userdata('id_user');
        $advisor = $this->db->get_where('al_advisor', ['id_ide' => $id, 'id_user' => $id_user])->row();
        if (!$advisor) { show_404(); return; }
        $data['advisor'] = $advisor;
        $this->load->view('advisor/view', $data);
    }

    /**
     * Chat interface for a specific advisor entry.
     * Accessible after a recommendation has been created.
     */
    public function chat($id = null)
    {
        if (!$id) { show_404(); return; }
        $id_user = $this->session->userdata('id_user');
        $advisor = $this->Al_advisor_model->get($id);
        if (!$advisor || $advisor->id_user != $id_user) { show_404(); return; }

        // decode chat history (stored as JSON) if exists
        $chat = [];
        if (!empty($advisor->riwayat_chat)) {
            $decoded = json_decode($advisor->riwayat_chat, true);
            if (is_array($decoded)) $chat = $decoded;
        }

        $data['advisor'] = $advisor;
        $data['chat'] = $chat;
        $this->load->view('advisor/chat', $data);
    }

    public function form()
    {
        $this->load->view('advisor/form');
    }

    public function create()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('modal', 'Modal Awal', 'required|numeric');
            $this->form_validation->set_rules('lokasi', 'Lokasi Usaha', 'required|min_length[3]');
            $this->form_validation->set_rules('minat', 'Jenis Usaha/Minat', 'required|min_length[3]');

            if ($this->form_validation->run() === TRUE) {
                $id_user = $this->session->userdata('id_user');
                $modal = $this->input->post('modal');
                $lokasi = $this->input->post('lokasi');
                $minat = $this->input->post('minat');
                
                // Generate AI recommendation based on input
                $rekomendasi = $this->generate_recommendation($modal, $lokasi, $minat);

                $data = [
                    'id_user' => $id_user,
                    'modal' => $modal,
                    'lokasi' => $lokasi,
                    'minat' => $minat,
                    'rekomendasi' => $rekomendasi,
                    'riwayat_chat' => '',
                ];
                $insert_id = $this->Al_advisor_model->insert($data);
                redirect('advisor/chat/'.$insert_id);
                return;
            }
        }
        $this->load->view('advisor/form');
    }

    public function edit($id = null)
    {
        if (!$id) { show_404(); return; }
        $id_user = $this->session->userdata('id_user');
        $advisor = $this->db->get_where('al_advisor', ['id_ide' => $id, 'id_user' => $id_user])->row();
        if (!$advisor) { show_404(); return; }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('modal', 'Modal Awal', 'required|numeric');
            $this->form_validation->set_rules('lokasi', 'Lokasi Usaha', 'required|min_length[3]');
            $this->form_validation->set_rules('minat', 'Jenis Usaha/Minat', 'required|min_length[3]');

            if ($this->form_validation->run() === TRUE) {
                $modal = $this->input->post('modal');
                $lokasi = $this->input->post('lokasi');
                $minat = $this->input->post('minat');
                $rekomendasi = $this->generate_recommendation($modal, $lokasi, $minat);

                $update_data = [
                    'modal' => $modal,
                    'lokasi' => $lokasi,
                    'minat' => $minat,
                    'rekomendasi' => $rekomendasi,
                ];
                $this->db->where('id_ide', $id)->update('al_advisor', $update_data);
                redirect('advisor');
                return;
            }
        }

        $data['advisor'] = $advisor;
        $this->load->view('advisor/form', $data);
    }

    public function delete($id = null)
    {
        if (!$id) { show_404(); return; }
        $id_user = $this->session->userdata('id_user');
        $advisor = $this->db->get_where('al_advisor', ['id_ide' => $id, 'id_user' => $id_user])->row();
        if (!$advisor) { show_404(); return; }

        if ($this->input->method() !== 'post') {
            $data['advisor'] = $advisor;
            $this->load->view('advisor/delete', $data);
            return;
        }

        $this->db->where('id_ide', $id)->delete('al_advisor');
        redirect('advisor');
    }

    /**
     * AJAX endpoint to append a user message and generate a simple AI reply.
     * Expects POST: id (advisor id), message (text)
     */
    public function send_message()
    {
        if ($this->input->method() !== 'post') {
            show_404(); return;
        }

        $id = $this->input->post('id');
        $message = trim($this->input->post('message'));
        if (!$id || $message === '') {
            echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
            return;
        }

        $id_user = $this->session->userdata('id_user');
        $advisor = $this->Al_advisor_model->get($id);
        if (!$advisor || $advisor->id_user != $id_user) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            return;
        }

        // build or decode chat history
        $chat = [];
        if (!empty($advisor->riwayat_chat)) {
            $decoded = json_decode($advisor->riwayat_chat, true);
            if (is_array($decoded)) $chat = $decoded;
        }

        $now = date('Y-m-d H:i:s');
        $chat[] = ['from' => 'user', 'message' => $message, 'time' => $now];

        // Attempt to generate a reply from configured Gemini API. If not configured
        // or the call fails, fall back to the built-in recommendation generator.
        $ai_reply = $this->generate_recommendation($advisor->modal, $advisor->lokasi, $advisor->minat);
        // try gemini with richer context
        $gemini_reply = $this->call_gemini_response($advisor, $message);
        if (!empty($gemini_reply)) {
            $ai_reply = $gemini_reply;
        }

        $chat[] = ['from' => 'ai', 'message' => $ai_reply, 'time' => date('Y-m-d H:i:s')];

        // save back as JSON
        $this->Al_advisor_model->update($id, ['riwayat_chat' => json_encode($chat)]);

        echo json_encode(['status' => 'ok', 'chat' => $chat]);
    }

    // Helper method to generate AI-like recommendations
    private function generate_recommendation($modal, $lokasi, $minat)
    {
        $recommendations = [];

        // Modal-based recommendations
        if ($modal < 5000000) {
            $recommendations[] = "Mulai dengan usaha skala kecil seperti dagang eceran, jasa freelance, atau produk digital.";
        } elseif ($modal < 50000000) {
            $recommendations[] = "Dengan modal Rp " . number_format($modal, 0, ',', '.') . ", Anda bisa membuka warung makan, toko kelontong, atau usaha jasa.";
        } else {
            $recommendations[] = "Modal Anda cukup untuk membuka usaha skala menengah seperti toko retail, layanan konsultasi, atau manufaktur kecil.";
        }

        // Location-based recommendations
        if (stripos($lokasi, 'kota') !== false || stripos($lokasi, 'perkotaan') !== false) {
            $recommendations[] = "Di area perkotaan, pertimbangkan bisnis yang dekat dengan target pasar urban seperti kafe, boutique, atau layanan digital.";
        } elseif (stripos($lokasi, 'desa') !== false || stripos($lokasi, 'pedesaan') !== false) {
            $recommendations[] = "Di area pedesaan, fokus pada produk lokal, pertanian, atau jasa yang dibutuhkan komunitas lokal.";
        }

        // Business type recommendations
        if (stripos($minat, 'makanan') !== false || stripos($minat, 'kuliner') !== false) {
            $recommendations[] = "Untuk bisnis kuliner, pastikan memiliki sertifikat HALAL dan izin usaha dagang dari dinas setempat.";
            $recommendations[] = "Manfaatkan platform online seperti Gofood, Grabfood, atau Instagram untuk marketing digital.";
        } elseif (stripos($minat, 'elektronik') !== false || stripos($minat, 'gadget') !== false) {
            $recommendations[] = "Pastikan stok terjamin dan harga kompetitif. Pertimbangkan membership program untuk customer loyalty.";
        } elseif (stripos($minat, 'fashion') !== false || stripos($minat, 'pakaian') !== false) {
            $recommendations[] = "Tren fashion cepat berubah. Pantau media sosial dan tren global untuk selalu relevan.";
            $recommendations[] = "Bangun komunitas followers dan lakukan kolaborasi dengan influencer lokal.";
        } else {
            $recommendations[] = "Lakukan riset pasar mendalam untuk memahami kebutuhan dan preferensi target customer Anda.";
        }

        // General business advice
        $recommendations[] = "Buat business plan yang matang dan kelola keuangan dengan baik menggunakan aplikasi ini.";
        $recommendations[] = "Selalu catat setiap transaksi untuk monitoring performa bisnis Anda.";

        return implode("\n\n", $recommendations);
    }
}

