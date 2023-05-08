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
            redirect(base_url("login"));
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
        redirect('pages/presensi');
    }
    // from-Ubah
    function form_ubah($Id){
        $where = array('presensi.Id' => $Id);
        $on = "presensi.Nipd=peserta.Nipd";
        $data['presensi'] = $this->Model_APS->edit_data_join2('*','presensi','peserta',$on, 'instruktur', 'presensi.Instruktur=instruktur.Id', $where)->result();
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
        redirect('pages/presensi');
    }
    // hapus
    function hapus($Id){
        $where = array('Id' => $Id);
        $this->Model_APS->hapus_data($where,'presensi');
        redirect('pages/presensi');

    }
     function peserta($Id = null){
        $Id = $_REQUEST['Id'];
        $data['presensi'] = $this->db->query("SELECT *,presensi.Id AS Idpr,peserta.Id AS Idp FROM presensi JOIN peserta JOIN instruktur JOIN rombel ON presensi.Nipd=peserta.Nipd AND presensi.Instruktur=instruktur.Id AND presensi.Jeniskursus=rombel.Id WHERE peserta.Id=$Id order by presensi.Tgl ASC")->result();
        
        $this->load->view('menu/presensi/peserta',$data);
        $this->load->view('layout/footer');
    }
}