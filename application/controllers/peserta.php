<?php
defined('BASEPATH') or exit('No direct script access allowed');

class peserta  extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Menambahkan Model-------------------------------------------------------------------------------------
        $this->load->model('Model_APS');
        // Menambahkan tampilan dan memanggil tampilan
        $this->load->view('layout/head');
        $data['profil'] = $this->Model_APS->tampil_data('profil', 'npsn', 'ASC')->result();
        $this->load->view('layout/sidebar_menu', $data);
        $this->load->view('layout/navbar');
        if ($this->session->userdata('status') == "") {
            redirect(base_url("login"));
        }
    }
    // form-tambah
    function form()
    {
        $data['rombel'] = $this->db->query("SELECT Namarombel,Kelas FROM rombel")->result();
        $this->load->view('menu/peserta/tambah', $data);
        $this->load->view('layout/footer');
    }
    // Tambah
    function tambah()
    {
        $nipd = $this->input->post('Nipd');
        $nokk = $this->input->post('Nokk');
        $nik = $this->input->post('Nik');
        $nama = $this->input->post('Nama');
        $kelamin = $this->input->post('Jk');
        $tgl = $this->input->post('Tgl');
        $jenis = $this->input->post('Jenis');
        $kls = $this->input->post('Kls');
        $tglmasuk = $this->input->post('Tglmasuk');
        $stat = $this->input->post('Status');

        $data = array(
            'Nama' => $nama,
            'Kelamin' => $kelamin,
            'Nipd' => $nipd,
            'Nik' => $nik,
            'Nokk' => $nokk,
            'Jeniskursus' => $jenis,
            'Kelas' => $kls,
            'Tglmasuk' => $tglmasuk,
            'Ttl' => $tgl,
            'Status' => $stat
        );
        $this->Model_APS->simpan_data($data, 'peserta');
        helper_log("add", "menambahkan peserta $nama");
        redirect('pages/peserta');
    }
    // from-Ubah
    function form_ubah($Id)
    {
        $where = array('Id' => $Id);
        $data['peserta'] = $this->Model_APS->edit_data('peserta', $where)->result();
        $this->load->view('menu/peserta/ubah', $data);
        $this->load->view('layout/footer');
    }
    // ubah
    function ubah($Id  = null)
    {
        $Id = $this->input->post('Id');
        $nipd = $this->input->post('Nipd');
        $nokk = $this->input->post('Nokk');
        $nik = $this->input->post('Nik');
        $nama = $this->input->post('Nama');
        $kelamin = $this->input->post('Jk');
        $tgl = $this->input->post('Tgl');
        $jenis = $this->input->post('Jenis');
        $kls = $this->input->post('Kls');
        $tglmasuk = $this->input->post('Tglmasuk');
        $stat = $this->input->post('Status');

        $data = array(
            'Nama' => $nama,
            'Kelamin' => $kelamin,
            'Nipd' => $nipd,
            'Nik' => $nik,
            'Nokk' => $nokk,
            'Jeniskursus' => $jenis,
            'Kelas' => $kls,
            'Tglmasuk' => $tglmasuk,
            'Ttl' => $tgl,
            'Status' => $stat
        );
        $where = array('Id' => $Id);
        $this->Model_APS->proses_update($where, $data, 'peserta');
        helper_log("edit", "mengubah peserta $nama");
        redirect('pages/peserta');
    }
    // hapus
    function hapus($Id)
    {
        $where = array('Id' => $Id);
        $this->Model_APS->hapus_data($where, 'peserta');
        helper_log("delete", "menghapus peserta");
        redirect('pages/peserta');
    }
}
