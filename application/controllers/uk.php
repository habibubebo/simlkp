<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class uk extends CI_Controller {
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
        $this->load->view('menu/uk/tambah');
        $this->load->view('layout/footer');
    }
    // Tambah
    function tambah(){
        $rombel = $this->input->post('rombel');
        $uk1 = $this->input->post('uk1');
        $uk2 = $this->input->post('uk2');
        $uk3 = $this->input->post('uk3');
        $uk4 = $this->input->post('uk4');
        $uk5 = $this->input->post('uk5');
        $jp1 = $this->input->post('jp1');
        $jp2 = $this->input->post('jp2');
        $jp3 = $this->input->post('jp3');
        $jp4 = $this->input->post('jp4');
        $jp5 = $this->input->post('jp5');
        $jptot = $this->input->post('jptotal');

        $data = array(
            'Rombel' => $rombel,
            'Uk1' => $uk1,
            'Uk2' => $uk2,
            'Uk3' => $uk3,
            'Uk4' => $uk4,
            'Uk5' => $uk5,
            'Jp1' => $jp1,
            'Jp2' => $jp2,
            'Jp3' => $jp3,
            'Jp4' => $jp4,
            'Jp5' => $jp5,
            'Jptotal' => $jptot
   );
        $this->Model_APS->simpan_data($data,'unitkompetensi');
        redirect('index.php/pages/uk');
    }
    // from-Ubah
    function form_ubah($Id){
        $where = array('unitkompetensi.Id' => $Id);
        $data['uks'] = $this->Model_APS->edit_data_join('unitkompetensi','rombel', 'unitkompetensi.Rombel=rombel.Id',$where)->result();
        $this->load->view('menu/uk/ubah',$data);
        $this->load->view('layout/footer');
    }
    // ubah
    function ubah($Id  = null){
        $Id = $this->input->post('Id');
           $rombel = $this->input->post('rombel');
        $uk1 = $this->input->post('uk1');
        $uk2 = $this->input->post('uk2');
        $uk3 = $this->input->post('uk3');
        $uk4 = $this->input->post('uk4');
        $uk5 = $this->input->post('uk5');
        $jp1 = $this->input->post('jp1');
        $jp2 = $this->input->post('jp2');
        $jp3 = $this->input->post('jp3');
        $jp4 = $this->input->post('jp4');
        $jp5 = $this->input->post('jp5');
        $jptot = $this->input->post('jptotal');

        $data = array(
            'Rombel' => $rombel,
            'Uk1' => $uk1,
            'Uk2' => $uk2,
            'Uk3' => $uk3,
            'Uk4' => $uk4,
            'Uk5' => $uk5,
            'Jp1' => $jp1,
            'Jp2' => $jp2,
            'Jp3' => $jp3,
            'Jp4' => $jp4,
            'Jp5' => $jp5,
            'Jptotal' => $jptot
        );
        $where = array('Id' => $Id);
        $this->Model_APS->proses_update($where,$data,'unitkompetensi');
        redirect('index.php/pages/uk');
    }
    // hapus
    function hapus($Id){
        $where = array('Id' => $Id);
        $this->Model_APS->hapus_data($where,'unitkompetensi');
        redirect('index.php/pages/uk');

    }
}