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
    function view()
    {
        $tables = "peserta";
        $search = array('Nama', 'Id', 'Nipd', 'Ttl');
        // jika memakai IS NULL pada where sql
        $isWhere = null;
        header('Content-Type: application/json');
        echo $this->Model_APS->get_tables($tables, $search, $isWhere);
    }
    function view2()
    {
        $query  = "SELECT *,peserta.Id AS Idp FROM peserta JOIN rombel ON peserta.Jeniskursus=rombel.Id";
        $search = array('Nama', 'peserta.Id', 'Nipd', 'Ttl', 'Status','rombel.Namarombel');
        $where  = null;

        $isWhere = null;
        // $isWhere = 'artikel.deleted_at IS NULL';
        header('Content-Type: application/json');
        echo $this->Model_APS->get_tables_query($query, $search, $where, $isWhere);
    }

    function lulusan()
    {
        $draw = $_GET['draw'];
        $start = $_GET['start'];
        $length = $_GET['length'];
        $search_value = $_GET['search']['value'];
       
        $query = "SELECT *,lulusan.Id AS Idl FROM lulusan JOIN instruktur JOIN peserta JOIN rombel JOIN unitkompetensi on lulusan.Instruktur=instruktur.Id AND lulusan.Nipd=peserta.Nipd AND peserta.Jeniskursus=rombel.Id AND unitkompetensi.Rombel=rombel.Id ORDER BY lulusan.Id desc";
        
        if (!empty($search_value)) {
            $query .= " WHERE name LIKE '%" . $search_value . "%' ";
        }
        
        // Hitung total data tanpa filter
        $total_data = $this->db->query($query)->num_rows;
        
        // Tambahkan LIMIT untuk paginasi
        $query .= " LIMIT " . $start . ", " . $length;
        
        $data = $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
        
        // Persiapkan respons dalam format JSON untuk DataTables
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,  // Anda bisa menghitung ulang jika ada filter pencarian
            "data" => $data
        );
        
        echo json_encode($response);
     


    }
}
