<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pages  extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_APS');
        $this->load->view('layout/head');
        $data['profil'] = $this->Model_APS->tampil_data('profil', 'npsn', 'ASC')->result();
        $data['logs'] = $this->db->query("SELECT * FROM log ORDER BY log_tgl DESC LIMIT 3")->result();
        $this->load->view('layout/sidebar_menu', $data);
        $this->load->view('layout/navbar', $data);
        if ($this->session->userdata('status') == "") {
            redirect(base_url("login"));
        }
    }
    function dashboard()
    {
        $data['sapras'] = $this->Model_APS->tampil_data('sapras', 'Id', 'ASC')->result();
        $data['lulusan'] = $this->db->query("SELECT * FROM lulusan")->result();
        $data['peserta'] = $this->db->query("SELECT * FROM peserta WHERE Status=1 or Status=0")->result();
        $data['rombel'] = $this->db->query("SELECT * FROM rombel")->result();
        $data['instruktur'] = $this->db->query("SELECT * FROM instruktur")->result();
		$data['totals'] = $this->db->query("SELECT Namarombel,IFNULL(BelumLulus, 0) AS BL,IFNULL(TotalPeserta, 0) AS TP, ((TotalPeserta - BelumLulus) / TotalPeserta * 100) AS Persen
        FROM rombel 
        left JOIN (SELECT Jeniskursus, COUNT(Nipd) AS BelumLulus FROM peserta WHERE Nipd NOT IN (SELECT Nipd FROM lulusan) GROUP BY Jeniskursus
        ) AS t ON Jeniskursus=rombel.Id 
        left JOIN (SELECT rombel.Id, COUNT(peserta.Nipd) AS TotalPeserta FROM rombel JOIN peserta ON rombel.Id=peserta.Jeniskursus GROUP BY rombel.Id
        ) AS t2 ON t2.Id=rombel.Id")->result();
        $data['chart'] = $this->db->query("SELECT CAST(Tgl AS DATE) AS Hari, count(Nipd) AS Jml FROM presensi WHERE Tgl BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL -1 DAY) GROUP BY Hari")->result();
		$this->load->view('dashboard', $data);
        $this->load->view('layout/footer');
    }

    function lembaga()
    {
        $this->load->view('menu/profil/lihat', $data);
        $this->load->view('layout/footer');
    }
    function lembaga_edit()
    {
        $this->load->view('menu/profil/ubah', $data);
        $this->load->view('layout/footer');
    }
    function ubahdata()
    {
        $npsn = $this->input->post('npsn');
        $nmlem = $this->input->post('nmlem');
        $alamat = $this->input->post('alamat');
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        $kel = $this->input->post('kel');
        $kec = $this->input->post('kec');
        $kota = $this->input->post('kota');
        $prov = $this->input->post('prov');
        $kp = $this->input->post('kp');
        $namaya = $this->input->post('namaya');
        $telp = $this->input->post('telp');
        $fax = $this->input->post('fax');
        $email = $this->input->post('email');

        $data = array(
            'Namalkp' => $nmlem,
            'Npsn' => $npsn,
            'Alamat' => $alamat,
            'Kelurahan' => $kel,
            'Kecamatan' => $kec,
            'Kota' => $kota,
            'Provinsi' => $prov,
            'Rt' => $rt,
            'Rw' => $rw,
            'Kodepos' => $kp,
            'Namayayasan' => $namaya,
            'Telepon' => $telp,
            'Nofax' => $fax,
            'Email' => $email
        );
        $this->Model_APS->proses_update_all($data, 'profil');
        redirect('pages/lembaga');
    }

    function sapras()
    {
        $data['sapras'] = $this->Model_APS->tampil_data('sapras', 'Id', 'ASC')->result();

        $this->load->view('menu/sapras/lihat', $data);
        $this->load->view('layout/footer');
    }
    function instruktur()
    {
        $data['instruktur'] = $this->Model_APS->tampil_data('instruktur', 'Id', 'ASC')->result();

        $this->load->view('menu/instruktur/lihat', $data);
        $this->load->view('layout/footer');
    }
    function peserta()
    {
        $data['rombel'] = $this->db->query("SELECT Namarombel,Kelas FROM rombel")->result();
        $data['alert'] = $this->session->flashdata('alert');
        $this->load->view('menu/peserta/lihat-serverside', $data);
        $this->load->view('layout/footer');
    }
    function peserta2()
    {
        $data['rombel'] = $this->db->query("SELECT Namarombel,Kelas FROM rombel")->result();
        $data['alert'] = $this->session->flashdata('alert');
        $this->load->view('menu/peserta/lihat-serverside', $data);
        $this->load->view('layout/footer');
    }
    function rombel()
    {
        $data['rombel'] = $this->Model_APS->tampil_data('rombel', 'Id', 'ASC')->result();

        $this->load->view('menu/rombel/lihat', $data);
        $this->load->view('layout/footer');
    }
    function uk()
    {
        $on = "unitkompetensi.Rombel=rombel.Id";
        $data['uks'] = $this->Model_APS->tampil_data_join('*, rombel.Id as Idr, unitkompetensi.Id as Idu', 'unitkompetensi', 'rombel', $on, 'unitkompetensi.Id', 'ASC')->result();

        $this->load->view('menu/uk/lihat', $data);
        $this->load->view('layout/footer');
    }
    function lulusan()
    {
        $data['notes'] = $this->Model_APS->tampil_data('notes', 'Id', 'ASC')->result();
        $data['lulusan'] = $this->db->query("SELECT *,lulusan.Id AS Idl FROM lulusan JOIN instruktur JOIN peserta JOIN rombel JOIN unitkompetensi on lulusan.Instruktur=instruktur.Id AND lulusan.Nipd=peserta.Nipd AND peserta.Jeniskursus=rombel.Id AND unitkompetensi.Rombel=rombel.Id ORDER BY lulusan.Id desc")->result();
        $this->load->view('menu/lulusan/lihat', $data);
        $this->load->view('layout/footer');
    }
    function presensi()
    {
        $this->load->view('menu/presensi/lihat');
        $this->load->view('layout/footer');
    }
    function log()
    {
        $data['logs'] = $this->db->query("SELECT * FROM log ORDER BY log_tgl DESC LIMIT 200")->result();
        $this->load->view('menu/log', $data);
        $this->load->view('layout/footer');
    }
    function pegawai()
    {
        $data['pegawai'] = $this->Model_APS->tampil_data('pegawai', 'Id', 'ASC')->result();
        $this->load->view('menu/pegawai/lihat', $data);
        $this->load->view('layout/footer');
    }
}
