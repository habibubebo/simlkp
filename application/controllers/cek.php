<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cek extends CI_Controller
{
   
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_APS');
    }
    
    function index()
    {
        $induk = $_GET['nipd'] ?? '1';
        $query = $this->db->query("SELECT *,lulusan.Id AS Idl FROM lulusan JOIN instruktur JOIN peserta JOIN rombel JOIN unitkompetensi on lulusan.Instruktur=instruktur.Id AND lulusan.Nipd=peserta.Nipd AND peserta.Jeniskursus=rombel.Id AND unitkompetensi.Rombel=rombel.Id where peserta.Nipd=$induk");
        $data = $query->result();
        
        if ($query->num_rows() == 0) {echo('<script>console.log("not found");</script>');} else echo('<script>console.log('.json_encode($data).');</script>');       
         // $this->load->view('menu/lulusan/lihat', $data);
    }
   
}
