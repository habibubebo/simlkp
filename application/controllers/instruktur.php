<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class instruktur  extends CI_Controller {
    function __construct(){
        parent::__construct();
        // Menambahkan Model-------------------------------------------------------------------------------------
        $this->load->model('Model_APS');
        // Menambahkan tampilan dan memanggil tampilan
        $this->load->view('layout/head');
        $data['profil'] = $this->Model_APS->tampil_data('profil','npsn','ASC')->result();
        $this->load->view('layout/sidebar_menu',$data);
        $this->load->view('layout/navbar');
        require_admin();
    }
    // form-tambah
    function form(){
        $this->load->view('menu/instruktur/tambah');
        $this->load->view('layout/footer');
    }
    // Tambah
    function tambah(){
        $ni = $this->input->post('ni');
        $jk = $this->input->post('jk');
        $tl = $this->input->post('tl');
        $tgl = $this->input->post('tgl');
        $nibu = $this->input->post('nibu');
        $al = $this->input->post('al');
        $email = $this->input->post('email');

        $data = array(
            'NamaInstruktur' => $ni,
            'Kelamin' => $jk,
            'Tempatlahir' => $tl,
            'Tanggallahir' => $tgl,
            'Namaibu' => $nibu,
            'Alamat' => $al,
            'Email' => $email
        );
        $this->Model_APS->simpan_data($data,'instruktur');
        $ins_id = (int)$this->db->insert_id();

        // Buat akun login otomatis dari data instruktur (jika diisi).
        if ($this->_buat_akun_instruktur($ins_id, $email, $ni)) {
            redirect('pages/instruktur');
        } else {
            $this->session->set_flashdata('error', 'Gagal membuat akun login instruktur.');
            redirect('pages/instruktur');
        }
    }

    // Membuat akun untuk instruktur (username = input atau email, pass = input atau nama).
    private function _buat_akun_instruktur($ins_id, $email, $nama)
    {
        $ins_id = (int)$ins_id;
        $ak_username = trim((string)$this->input->post('ak_username'));
        $ak_password = trim((string)$this->input->post('ak_password'));
        $ak_role = $this->input->post('ak_role');

        if ($ak_username === '') {
            $ak_username = trim((string)$email);
        }
        if ($ak_password === '') {
            $ak_password = trim(str_replace(' ', '', (string)$nama));
        }
        if (!in_array($ak_role, ['instructor', 'admin', 'superadmin'], true)) {
            $ak_role = 'instructor';
        }
        if (!is_superadmin() && $ak_role === 'superadmin') {
            $ak_role = 'instructor';
        }
        if ($ak_username === '' || $ak_password === '') {
            return true;
        }

        $akun = array(
            'instructor_id' => $ins_id,
            'role' => $ak_role,
            'username' => $ak_username,
            'password' => password_hash($ak_password, PASSWORD_DEFAULT),
            'nama' => $nama,
        );
        $this->Model_APS->simpan_data($akun, 'akun');
        helper_log("add", "menambahkan akun instruktur $ak_username");
        return true;
    }
    // from-Ubah
    function form_ubah($Id){
        $where = array('Id' => $Id);
        $data['instruktur'] = $this->Model_APS->edit_data('instruktur',$where)->result();
        $data['akun'] = $this->db->where('instructor_id', (int)$Id)->get('akun')->row();
        $this->load->view('menu/instruktur/ubah',$data);
        $this->load->view('layout/footer');
    }
    // ubah
    function ubah($Id  = null){
        $Id = $this->input->post('Id');
        $ni = $this->input->post('ni');
        $jk = $this->input->post('jk');
        $tl = $this->input->post('tl');
        $tgl = $this->input->post('tgl');
        $nibu = $this->input->post('nibu');
        $al = $this->input->post('al');
        $email = $this->input->post('email');

        $data = array(
            'NamaInstruktur' => $ni,
            'Kelamin' => $jk,
            'Tempatlahir' => $tl,
            'Tanggallahir' => $tgl,
            'Namaibu' => $nibu,
            'Alamat' => $al,
            'Email' => $email
        );
        $where = array('Id' => $Id);
        $this->Model_APS->proses_update($where,$data,'instruktur');

        // Sinkronkan akun login bila instruktur (jika akun belum ada & diisi -> buat).
        $this->_sinkron_akun_instruktur((int)$Id, $email, $ni);

        redirect('pages/instruktur');
    }

    // Sinkronkan akun login instruktur pada saat data instruktur diubah.
    private function _sinkron_akun_instruktur($ins_id, $email, $nama)
    {
        $ins_id = (int)$ins_id;
        $akun = $this->db->where('instructor_id', $ins_id)->get('akun')->row();

        if (!$akun) {
            // Belum punya akun -> coba buat dari field akun di form.
            $ak_username = trim((string)$this->input->post('ak_username'));
            $ak_password = trim((string)$this->input->post('ak_password'));
            if ($ak_username === '' && $email !== '') {
                $ak_username = trim((string)$email);
            }
            if ($ak_password === '' && $nama !== '') {
                $ak_password = trim(str_replace(' ', '', (string)$nama));
            }
            if ($ak_username === '' || $ak_password === '') {
                return;
            }
            $ak_role = $this->input->post('ak_role');
            if (!in_array($ak_role, ['instructor', 'admin', 'superadmin'], true)) {
                $ak_role = 'instructor';
            }
            $akun_baru = array(
                'instructor_id' => $ins_id,
                'role' => $ak_role,
                'username' => $ak_username,
                'password' => password_hash($ak_password, PASSWORD_DEFAULT),
                'nama' => $nama,
            );
            $this->Model_APS->simpan_data($akun_baru, 'akun');
            helper_log("add", "menambahkan akun instruktur $ak_username");
            return;
        }

        // Akun sudah ada -> perbarui username/nama (password & role hanya superadmin).
        $upd = array('nama' => $nama);
        $ak_username = trim((string)$this->input->post('ak_username'));
        if ($ak_username !== '') {
            $upd['username'] = $ak_username;
        }
        $ak_password = trim((string)$this->input->post('ak_password'));
        if ($ak_password !== '') {
            $upd['password'] = password_hash($ak_password, PASSWORD_DEFAULT);
        }
        if (is_superadmin()) {
            $ak_role = $this->input->post('ak_role');
            if (in_array($ak_role, ['instructor', 'admin', 'superadmin'], true)) {
                $upd['role'] = $ak_role;
            }
        }
        $this->db->where('id', $akun->id)->update('akun', $upd);
        helper_log("edit", "memperbarui akun instruktur");
    }
    // hapus
    function hapus($Id){
        $where = array('Id' => $Id);
        $this->Model_APS->hapus_data($where,'instruktur');
        redirect('pages/instruktur');

    }
}