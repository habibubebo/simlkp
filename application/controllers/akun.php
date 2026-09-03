<?php
defined('BASEPATH') or exit('No direct script access allowed');

class akun extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_APS');
        $this->load->view('layout/head');
        $data['profil'] = $this->Model_APS->tampil_data('profil', 'npsn', 'ASC')->result();
        $this->load->view('layout/sidebar_menu', $data);
        $this->load->view('layout/navbar');
        require_superadmin();
    }

    function index()
    {
        $data['akun'] = $this->db->order_by('id', 'ASC')->get('akun')->result();
        $this->load->view('akun/manajemen', $data);
        $this->load->view('layout/footer');
    }

    function tambah()
    {
        $this->load->view('akun/tambah', array('instruktur_list' => $this->db->order_by('Id', 'ASC')->get('instruktur')->result()));
        $this->load->view('layout/footer');
    }

    function simpan()
    {
        $username = trim($this->input->post('username'));
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        $instructor_id = (int) $this->input->post('instructor_id');
        $nama = trim($this->input->post('nama'));

        if (!in_array($role, ['superadmin', 'admin', 'instructor'], true)) {
            $role = 'instructor';
        }
        if ($username === '' || $password === '') {
            $this->session->set_flashdata('error', 'Username dan password wajib diisi.');
            redirect('akun/tambah');
            return;
        }

        if ($this->db->where('username', $username)->get('akun')->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Username sudah digunakan.');
            redirect('akun/tambah');
            return;
        }

        $data = array(
            'instructor_id' => $instructor_id > 0 ? $instructor_id : null,
            'role' => $role,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'nama' => $nama !== '' ? $nama : null,
        );
        $this->Model_APS->simpan_data($data, 'akun');
        helper_log("add", "menambahkan akun $username");
        redirect('akun');
    }

    function form_ubah($id)
    {
        $id = (int)$id;
        $akun = $this->db->where('id', $id)->get('akun')->row();
        if (!$akun) {
            redirect('akun');
            return;
        }
        $data['akun'] = $akun;
        $data['instruktur_list'] = $this->db->order_by('Id', 'ASC')->get('instruktur')->result();
        $this->load->view('akun/ubah', $data);
        $this->load->view('layout/footer');
    }

    function ubah()
    {
        $id = (int) $this->input->post('id');
        $username = trim($this->input->post('username'));
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        $instructor_id = (int) $this->input->post('instructor_id');
        $nama = trim($this->input->post('nama'));

        $akun = $this->db->where('id', $id)->get('akun')->row();
        if (!$akun) {
            redirect('akun');
            return;
        }

        $dup = $this->db->where('username', $username)->where('id !=', $id)->get('akun')->num_rows();
        if ($dup > 0) {
            $this->session->set_flashdata('error', 'Username sudah digunakan.');
            redirect('akun/form_ubah/' . $id);
            return;
        }

        $data = array(
            'instructor_id' => $instructor_id > 0 ? $instructor_id : null,
            'role' => in_array($role, ['superadmin', 'admin', 'instructor'], true) ? $role : $akun->role,
            'username' => $username,
            'nama' => $nama !== '' ? $nama : null,
        );
        if ($password !== '') {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $this->Model_APS->proses_update(array('id' => $id), $data, 'akun');
        helper_log("edit", "memperbarui akun $username");
        redirect('akun');
    }

    function hapus($id)
    {
        $id = (int)$id;
        // Jangan izinkan menghapus akun sendiri.
        if ($id === (int)$this->session->userdata('id')) {
            $this->session->set_flashdata('error', 'Tidak dapat menghapus akun yang sedang dipakai.');
            redirect('akun');
            return;
        }
        $this->Model_APS->hapus_data(array('id' => $id), 'akun');
        helper_log("delete", "menghapus akun id $id");
        redirect('akun');
    }
}
