<?php
defined('BASEPATH') or exit('No direct script access allowed');

class presensi extends CI_Controller
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
        $this->load->view('menu/presensi/tambah');
        $this->load->view('layout/footer');
    }
    // Tambah
    function tambah()
    {
        $tgl = $this->input->post('tgl');
        $nipd = $this->input->post('nama');
        $jks = $this->input->post('jks');
        $ins = $this->input->post('Instruktur');
        $materi = $this->input->post('materi');
        $jml = $this->input->post('jumlah');

        $data = array(
            'Tgl' => $tgl,
            'Nipd' => $nipd,
            'Jeniskursus' => $jks,
            'Instruktur' => $ins,
            'Materi' => $materi
        );
        for ($x = 0; $x < $jml; $x++) {
            $this->Model_APS->simpan_data($data, 'presensi');
            helper_log("add", "menambahkan presensi $nipd"); 
        };
        redirect('pages/presensi');
    }
    // from-Ubah
    function form_ubah($Id)
    {
        $where = array('presensi.Id' => $Id);
        $on = "presensi.Nipd=peserta.Nipd";
        $data['presensi'] = $this->Model_APS->edit_data_join2('*, presensi.Id AS PrId, instruktur.Id AS InsId', 'presensi', 'peserta', $on, 'instruktur', 'presensi.Instruktur=instruktur.Id', $where)->result();
        $this->load->view('menu/presensi/ubah', $data);
        $this->load->view('layout/footer');
    }
    // ubah
    function ubah()
    {
        $Id = $this->input->post('Id');
        $tgl = $this->input->post('tgl');
        $nipd = $this->input->post('nama');
        $jks = $this->input->post('jks');
        $ins = $this->input->post('Instruktur');
        $materi = $this->input->post('materi');

        $data = array(
            'Tgl' => $tgl,
            'Nipd' => $nipd,
            'Jeniskursus' => $jks,
            'Instruktur' => $ins,
            'Materi' => $materi,
        );
        $where = array('Id' => $Id);
        $this->Model_APS->proses_update($where, $data, 'presensi');
        helper_log("add", "mengubah presensi $nipd");
        redirect('pages/presensi');
    }
    // hapus
    function hapus($Id)
    {
        $where = array('Id' => $Id);
        $this->Model_APS->hapus_data($where, 'presensi');
        helper_log("delete", "menghapus presensi");
        redirect('pages/presensi');
    }
    function peserta($Id = null)
    {
        $Id = $_REQUEST['Id'];
        $query = $this->db->query("SELECT *,presensi.Id AS Idpr,peserta.Id AS Idp FROM presensi JOIN peserta JOIN instruktur JOIN rombel ON presensi.Nipd=peserta.Nipd AND presensi.Instruktur=instruktur.Id AND presensi.Jeniskursus=rombel.Id WHERE peserta.Id=$Id order by presensi.Tgl ASC");
        
            if ($query->num_rows() == 0) {
                $this->session->set_flashdata('alert', 'Data presensi kosong');
                redirect($_SERVER['HTTP_REFERER']);
            };
        $data['presensi'] = $query->result();
        $this->load->view('menu/presensi/peserta', $data);
        $this->load->view('layout/footer');
    }
}
