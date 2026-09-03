<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pegawai extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Model_APS');
        $this->load->view('layout/head');
        $data['profil'] = $this->Model_APS->tampil_data('profil','npsn','ASC')->result();
        $this->load->view('layout/sidebar_menu',$data);
        $this->load->view('layout/navbar');
        require_admin();
    }
    function form(){
        $this->load->view('menu/pegawai/tambah');
        $this->load->view('layout/footer');
    }
    function tambah(){
        $ni = $this->input->post('ni');
        $jk = $this->input->post('jk');
        $tl = $this->input->post('tl');
        $tgl = $this->input->post('tgl');
        $al = $this->input->post('al');
        $email = $this->input->post('email');
        $nipg = $this->input->post('nipg');
        
        $data = array(
            'NamaPegawai' => $ni,
            'Kelamin' => $jk,
            'Tempatlahir' => $tl,
            'TanggalLahir' => $tgl,
            'Alamat' => $al,
            'Email' => $email,
            'Nipg' => $nipg
        );
        $this->Model_APS->simpan_data($data,'pegawai');
        redirect('pages/pegawai');
    }
    function form_ubah($Id){
        $where = array('Id' => $Id);
        $data['pegawai'] = $this->Model_APS->edit_data('pegawai',$where)->result();
        $this->load->view('menu/pegawai/ubah',$data);
        $this->load->view('layout/footer');
    }
    function ubah($Id  = null){
        $Id = $this->input->post('Id');
        $ni = $this->input->post('ni');
        $jk = $this->input->post('jk');
        $tl = $this->input->post('tl');
        $tgl = $this->input->post('tgl');
        $al = $this->input->post('al');
        $email = $this->input->post('email');
        $nipg = $this->input->post('nipg');
        
        $data = array(
            'NamaPegawai' => $ni,
            'Kelamin' => $jk,
            'Tempatlahir' => $tl,
            'TanggalLahir' => $tgl,
            'Alamat' => $al,
            'Email' => $email,
            'Nipg' => $nipg
        );
        $where = array('Id' => $Id);
        $this->Model_APS->proses_update($where,$data,'pegawai');
        redirect('pages/pegawai');
    }
    function hapus($Id){
        $where = array('Id' => $Id);
        $this->Model_APS->hapus_data($where,'pegawai');
        redirect('pages/pegawai');

    }
}