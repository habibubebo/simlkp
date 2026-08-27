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
            redirect(base_url("login"));
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
        $kode1 = $this->input->post('kode1');
        $kode2 = $this->input->post('kode2');
        $kode3 = $this->input->post('kode3');
        $kode4 = $this->input->post('kode4');
        $kode5 = $this->input->post('kode5');
        $kode6 = $this->input->post('kode6');
        $uk1 = $this->input->post('uk1');
        $uk2 = $this->input->post('uk2');
        $uk3 = $this->input->post('uk3');
        $uk4 = $this->input->post('uk4');
        $uk5 = $this->input->post('uk5');
        $uk6 = $this->input->post('uk6');
        $jp1 = $this->input->post('jp1');
        $jp2 = $this->input->post('jp2');
        $jp3 = $this->input->post('jp3');
        $jp4 = $this->input->post('jp4');
        $jp5 = $this->input->post('jp5');
        $jp6 = $this->input->post('jp6');
        $jptot = $this->input->post('jptotal');

        $data = array(
            'Rombel' => $rombel,
            'Kode1' => $kode1,
            'Kode2' => $kode2,
            'Kode3' => $kode3,
            'Kode4' => $kode4,
            'Kode5' => $kode5,
            'Kode6' => $kode6,
            'Uk1' => $uk1,
            'Uk2' => $uk2,
            'Uk3' => $uk3,
            'Uk4' => $uk4,
            'Uk5' => $uk5,
            'Uk6' => $uk6,
            'Jp1' => $jp1,
            'Jp2' => $jp2,
            'Jp3' => $jp3,
            'Jp4' => $jp4,
            'Jp5' => $jp5,
            'Jp6' => $jp6,
            'Jptotal' => $jptot
   );
        $this->Model_APS->simpan_data($data,'unitkompetensi');
        redirect('pages/uk');
    }
    // from-Ubah
    function form_ubah($Id){
        // Select eksplisit: kolom Id tidak bentrok dengan rombel.Id,
        // LEFT JOIN agar data tetap tampil walau jenis kursus sudah terhapus
        $data['uks'] = $this->db
            ->select('unitkompetensi.*, rombel.Namarombel, rombel.Kelas')
            ->from('unitkompetensi')
            ->join('rombel', 'unitkompetensi.Rombel = rombel.Id', 'left')
            ->where('unitkompetensi.Id', $Id)
            ->get()->result();
        $this->load->view('menu/uk/ubah',$data);
        $this->load->view('layout/footer');
    }
    // ubah
    function ubah($Id  = null){
        $Id = $this->input->post('Id');
           $rombel = $this->input->post('rombel');
        $kode1 = $this->input->post('kode1');
        $kode2 = $this->input->post('kode2');
        $kode3 = $this->input->post('kode3');
        $kode4 = $this->input->post('kode4');
        $kode5 = $this->input->post('kode5');
        $kode6 = $this->input->post('kode6');
        $uk1 = $this->input->post('uk1');
        $uk2 = $this->input->post('uk2');
        $uk3 = $this->input->post('uk3');
        $uk4 = $this->input->post('uk4');
        $uk5 = $this->input->post('uk5');
        $uk6 = $this->input->post('uk6');
        $jp1 = $this->input->post('jp1');
        $jp2 = $this->input->post('jp2');
        $jp3 = $this->input->post('jp3');
        $jp4 = $this->input->post('jp4');
        $jp5 = $this->input->post('jp5');
        $jp6 = $this->input->post('jp6');
        $jptot = $this->input->post('jptotal');

        $data = array(
            'Rombel' => $rombel,
            'Kode1' => $kode1,
            'Kode2' => $kode2,
            'Kode3' => $kode3,
            'Kode4' => $kode4,
            'Kode5' => $kode5,
            'Kode6' => $kode6,
            'Uk1' => $uk1,
            'Uk2' => $uk2,
            'Uk3' => $uk3,
            'Uk4' => $uk4,
            'Uk5' => $uk5,
            'Uk6' => $uk6,
            'Jp1' => $jp1,
            'Jp2' => $jp2,
            'Jp3' => $jp3,
            'Jp4' => $jp4,
            'Jp5' => $jp5,
            'Jp6' => $jp6,
            'Jptotal' => $jptot
        );
        $where = array('Id' => $Id);
        $this->Model_APS->proses_update($where,$data,'unitkompetensi');
        redirect('pages/uk');
    }
    // hapus
    function hapus($Id){
        $where = array('Id' => $Id);
        $this->Model_APS->hapus_data($where,'unitkompetensi');
        redirect('pages/uk');

    }
}