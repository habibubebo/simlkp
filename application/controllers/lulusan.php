<?php
defined('BASEPATH') or exit('No direct script access allowed');

class lulusan  extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Menambahkan Model
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
        $users = $this->Model_APS->getNipds();
        $data['nipds'] = $users;
        $this->load->view('menu/lulusan/tambah', $data);
        $this->load->view('layout/footer');
    }
    // Tambah
    function tambah()
    {
        $nipd = $this->input->post('nipd');
        $tl = $this->input->post('tl');
        $tc = $this->input->post('tc');
        $ins = $this->input->post('Instruktur');
        $n1 = $this->input->post('n1');
        $n2 = $this->input->post('n2');
        $n3 = $this->input->post('n3');
        $n4 = $this->input->post('n4');
        $n5 = $this->input->post('n5');

        $data = array(
            'Nipd' => $nipd,
            'Tgllulus' => $tl,
            'Tglcetak' => $tc,
            'Instruktur' => $ins,
            'n1' => $n1,
            'n2' => $n2,
            'n3' => $n3,
            'n4' => $n4,
            'n5' => $n5
        );
        $this->Model_APS->simpan_data($data, 'lulusan');
        helper_log("add", "menambahkan lulusan $nipd");
        redirect('pages/lulusan');
    }
    // from-Ubah
    function form_ubah($Id)
    {
        $sel = 'lulusan.Id,lulusan.Nipd,lulusan.Tgllulus,lulusan.Tglcetak,lulusan.Instruktur,lulusan.n1,lulusan.n2,lulusan.n3,lulusan.n4,lulusan.n5,instruktur.NamaInstruktur';
        $where = array('lulusan.Id' => $Id);
        $data['lulusan'] = $this->Model_APS->sel_edit_data_join($sel, 'lulusan', 'instruktur', 'lulusan.Instruktur=instruktur.Id', $where)->result();

        $this->load->view('menu/lulusan/ubah', $data);
        $this->load->view('layout/footer');
    }
    // ubah
    function ubah($Id = null)
    {
        $Id = $this->input->post('Id');
        $nipd = $this->input->post('nipd');
        $tl = $this->input->post('tl');
        $tc = $this->input->post('tc');
        $ins = $this->input->post('Instruktur');
        $n1 = $this->input->post('n1');
        $n2 = $this->input->post('n2');
        $n3 = $this->input->post('n3');
        $n4 = $this->input->post('n4');
        $n5 = $this->input->post('n5');

        $data = array(
            'Nipd' => $nipd,
            'Tgllulus' => $tl,
            'Tglcetak' => $tc,
            'Instruktur' => $ins,
            'n1' => $n1,
            'n2' => $n2,
            'n3' => $n3,
            'n4' => $n4,
            'n5' => $n5
        );
        $where = array('Id' => $Id);
        $this->Model_APS->proses_update($where, $data, 'lulusan');
        helper_log("edit", "mengubah lulusan $nipd");
        redirect('pages/lulusan');
    }
    // hapus
    function hapus($Id)
    {
        $where = array('Id' => $Id);
        $this->Model_APS->hapus_data($where, 'lulusan');
        helper_log("delete", "menghapus lulusan");
        redirect('pages/lulusan');
    }
    function cetak($Id)
    {
        $this->load->library('pdf');
        $this->load->model('Model_APS');
        $this->load->view('menu/lulusan/cetak');
    }
}
