<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pages  extends CI_Controller {
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
    function dashboard(){
        $data['profil'] = $this->Model_APS->tampil_data('profil','npsn','ASC')->result();
        $data['sapras'] = $this->Model_APS->tampil_data('sapras','Id','ASC')->result();
        
        $this->load->view('dashboard',$data);
        $this->load->view('layout/footer');
    }

    function lembaga(){
        $data['profil'] = $this->Model_APS->tampil_data('profil','npsn','ASC')->result();
        $this->load->view('menu/profil/lihat',$data);
        $this->load->view('layout/footer');
    }
        // from-Ubah lembaga
        function lembaga_edit(){
            $data['profil'] = $this->Model_APS->tampil_data('profil','npsn','ASC')->result();
            $this->load->view('menu/profil/ubah',$data);
            $this->load->view('layout/footer');
        }
        // ubah lembaga
        function ubahdata(){
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
            $this->Model_APS->proses_update_all($data,'profil');
            redirect('pages/lembaga');
        }

    function sapras(){
        $data['sapras'] = $this->Model_APS->tampil_data('sapras', 'Id','ASC')->result();
        
        $this->load->view('menu/sapras/lihat',$data);
        $this->load->view('layout/footer');
    }
    function instruktur(){
        $data['instruktur'] = $this->Model_APS->tampil_data('instruktur', 'Id','ASC')->result();
        
        $this->load->view('menu/instruktur/lihat',$data);
        $this->load->view('layout/footer');
    }
    function peserta(){
        $data['peserta'] = $this->Model_APS->tampil_data_join('*,peserta.Id AS Idp','peserta','rombel', 'peserta.Jeniskursus=rombel.Id', 'peserta.Id','ASC')->result();
        
        $this->load->view('menu/peserta/lihat',$data);
        $this->load->view('layout/footer');
    }
    function rombel(){
        $data['rombel'] = $this->Model_APS->tampil_data('rombel', 'Id','ASC')->result();
        
        $this->load->view('menu/rombel/lihat',$data);
        $this->load->view('layout/footer');
    }
    function uk(){
        $on = "unitkompetensi.Rombel=rombel.Id";
        $data['uks'] = $this->Model_APS->tampil_data_join('*','unitkompetensi', 'rombel',$on,'unitkompetensi.Id','ASC')->result();
        
        $this->load->view('menu/uk/lihat',$data);
        $this->load->view('layout/footer');
    }
    function lulusan(){
       $data['lulusan'] = $this->db->query("SELECT *,lulusan.Id AS Idl FROM lulusan JOIN instruktur JOIN peserta JOIN rombel JOIN unitkompetensi on lulusan.Instruktur=instruktur.Id AND lulusan.Nipd=peserta.Nipd AND peserta.Jeniskursus=rombel.Id AND unitkompetensi.Rombel=rombel.Id")->result();
        $this->load->view('menu/lulusan/lihat',$data);
        $this->load->view('layout/footer');
    }
    function presensi(){
        $data['presensi'] = $this->db->query("SELECT presensi.Id,presensi.Tgl,peserta.Nama,rombel.Namarombel,presensi.Materi,instruktur.NamaInstruktur,peserta.Id AS Idp FROM presensi JOIN peserta JOIN instruktur JOIN rombel ON presensi.Nipd=peserta.Nipd AND presensi.Instruktur=instruktur.Id AND presensi.Jeniskursus=rombel.Id order by presensi.Tgl DESC")->result();
        
        $this->load->view('menu/presensi/lihat',$data);
        $this->load->view('layout/footer');
    }
}