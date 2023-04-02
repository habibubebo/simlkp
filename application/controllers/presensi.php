<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class presensi extends CI_Controller {
    function __construct(){
        parent::__construct();
        // Menambahkan Model-------------------------------------------------------------------------------------
        $this->load->model('Model_APS');
        // Menambahkan tampilan dan memanggil tampilan
        $this->load->view('layout/head');
        $data['profil'] = $this->Model_APS->tampil_data('profil','npsn','ASC')->result();
        $this->load->view('layout/sidebar_menu',$data);
        $this->load->view('layout/navbar');
        if($this->session->userdata('status') == ""){
            redirect(base_url("index.php/login"));
        }
    }
    // form-tambah
    function form(){
        $this->load->view('menu/presensi/tambah');
        $this->load->view('layout/footer');
    }
    // Tambah
    function tambah(){
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
            'Materi' => $materi
        );
        $this->Model_APS->simpan_data($data,'presensi');
        redirect('index.php/pages/presensi');
    }
    // from-Ubah
    function form_ubah($Id){
        $where = array('presensi.Id' => $Id);
        $on = "presensi.Nipd=peserta.Nipd";
        $data['presensi'] = $this->Model_APS->edit_data_join('presensi','peserta',$on,$where)->result();
        $this->load->view('menu/presensi/ubah',$data);
        $this->load->view('layout/footer');
    }
    // ubah
    function ubah($Id = null){
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
            'Materi' => $materi
        );
        $where = array('Id' => $Id);
        $this->Model_APS->proses_update($where,$data,'presensi');
        redirect('index.php/pages/presensi');
    }
    // hapus
    function hapus($Id){
        $where = array('Id' => $Id);
        $this->Model_APS->hapus_data($where,'presensi');
        redirect('index.php/pages/presensi');

    }
}