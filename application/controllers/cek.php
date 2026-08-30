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
        $induk = (int)($this->input->get('nipd') ?? 0);
        if ($induk <= 0) {
            return;
        }
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
        $draw = (int)($this->input->get('draw') ?? 0);
        $start = (int)($this->input->get('start') ?? 0);
        $length = (int)($this->input->get('length') ?? 10);
        if ($length < 1 || $length > 200) { $length = 10; }
        $search_value = $this->db->escape_like_str((string)($this->input->get('search')['value'] ?? ''));

        $query = "SELECT *,lulusan.Id AS Idl FROM lulusan JOIN instruktur JOIN peserta JOIN rombel JOIN unitkompetensi on lulusan.Instruktur=instruktur.Id AND lulusan.Nipd=peserta.Nipd AND peserta.Jeniskursus=rombel.Id AND unitkompetensi.Rombel=rombel.Id";
        
        if ($search_value !== '') {
            $query .= " WHERE (peserta.Nama LIKE '%" . $search_value . "%' OR rombel.Namarombel LIKE '%" . $search_value . "%')";
        }
        
        $query .= " ORDER BY lulusan.Id desc";
        
        // Hitung total data tanpa filter
        $total_data = $this->db->query($query)->num_rows();
        
        // Tambahkan LIMIT untuk paginasi
        $query .= " LIMIT " . $start . ", " . $length;
        
        $data = $this->db->query($query)->result_array();
        
        // Persiapkan respons dalam format JSON untuk DataTables
        $response = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,  // Anda bisa menghitung ulang jika ada filter pencarian
            "data" => $data
        );
        
        echo json_encode($response);
    }

    function presensi()
    {
        $draw = intval($_POST['draw'] ?? 0);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 10);
        $search = $_POST['search']['value'] ?? '';
        $orderCol = intval($_POST['order'][0]['column'] ?? 0);
        $orderDir = strtoupper((string)($_POST['order'][0]['dir'] ?? '')) === 'ASC' ? 'ASC' : 'DESC';

        $cols = ['Tgl', 'Nama', 'Namarombel', 'NamaInstruktur', 'Materi', 'Id'];
        $orderField = $cols[$orderCol] ?? 'Tgl';

        $base = "FROM presensi JOIN peserta ON presensi.Nipd=peserta.Nipd JOIN instruktur ON presensi.Instruktur=instruktur.Id JOIN rombel ON presensi.Jeniskursus=rombel.Id";

        $where = '';
        if (!empty($search)) {
            $s = $this->db->escape_like_str($search);
            $where = " WHERE (peserta.Nama LIKE '%$s%' OR rombel.Namarombel LIKE '%$s%' OR instruktur.NamaInstruktur LIKE '%$s%' OR presensi.Materi LIKE '%$s%')";
        }

        $total = $this->db->query("SELECT COUNT(*) AS cnt $base $where")->row()->cnt;

        $sql = "SELECT presensi.Id, presensi.Tgl, presensi.Nipd, peserta.Nama, peserta.Jeniskursus, rombel.Namarombel, instruktur.Id AS IdI, instruktur.NamaInstruktur, peserta.Id AS Idp, presensi.Materi $base $where ORDER BY $orderField $orderDir LIMIT $start, $length";
        $rows = $this->db->query($sql)->result();

        $data = [];
        foreach ($rows as $r) {
            $data[] = [
                'Tgl' => $r->Tgl,
                'Nama' => $r->Nama,
                'Namarombel' => $r->Namarombel,
                'NamaInstruktur' => $r->NamaInstruktur,
                'Materi' => $r->Materi,
                'Id' => $r->Id,
                'Nipd' => $r->Nipd,
                'IdI' => $r->IdI,
                'Idp' => $r->Idp,
                'Jeniskursus' => $r->Jeniskursus,
            ];
        }

        header('Content-Type: application/json');
        echo json_encode([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
    }
}
