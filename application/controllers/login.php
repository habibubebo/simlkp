<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{
    // Fungsi __construct() Untuk pendeklarasian awal.------------------------------------------------------------
    function __construct()
    {
        parent::__construct();
        // Menambahkan Model-------------------------------------------------------------------------------------
        $this->load->model('Model_APS');
    }
    // Fungsi Index() Untuk menjalankan baris kode secara otomatis ketika program berjalan-------------------------
    function index()
    {
        // Menambahkan/memanggil file view (v_login.php)-------------------------------------------------------
        if ($this->session->userdata('status') == "masuk") {
            redirect(base_url('pages/dashboard'));
        } else {
            // Ambil nama lembaga dari tabel profil untuk hook cek data alumni.
            $data['namalembaga'] = '';
            $profil = $this->Model_APS->tampil_data('profil', 'npsn', 'ASC')->result();
            if (!empty($profil)) {
                $data['namalembaga'] = trim((string)$profil[0]->Namalkp);
            }
            $this->load->view('V_login.php', $data);
        };
    }
    // Fungsi Auth() Untuk memeriksa / memproses inputan yang dikirim dari form login (v_login.php)----------------
    function auth()
    {
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');
        $is_pwa = $this->input->post('is_pwa');

        // Query hanya berdasarkan username
        $where = array('username' => $user);
        $query = $this->Model_APS->cek_akun($where);

        if ($query->num_rows() > 0) {
            $akun = $query->row();

            // Verifikasi password dengan password_verify()
            if (!password_verify($pass, $akun->password)) {
                $this->session->set_flashdata('error', 'Username atau password salah!');
                redirect('login');
                return;
            }

            $datalogin = array(
                'id' => $akun->id,
                'nama' => $akun->nama,
                'username' => $akun->username,
                'status' => "masuk",
                'is_pwa' => ($is_pwa === '1' ? '1' : '0'),
                'last_active' => time(),
            );
            if ($datalogin['is_pwa'] !== '1') {
                $datalogin['session_expiry'] = time() + 7200;
            }
            $this->session->set_userdata($datalogin);
            $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];
            helper_log("login", 'login ke sistem dari '.$ip);
            header('location:' . base_url() . 'pages/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('login');
        }
    }
    // Membuat fungsi logout() untuk keluar akun
    function logout()
    {
        helper_log("logout", "logout dari sistem");
        // Memanggil fungsi session_destroy() untuk mengahapus data login--------------------------------------
        $this->session->sess_destroy();
        // Memanggil fungsi header() untuk mengarahkan halaman---------------------------------------------
        header('location:' . base_url() . 'login');
    }
}
