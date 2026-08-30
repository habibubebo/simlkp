<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_APS extends CI_Model
{
    function cek_akun($kondisi)
    {
        return $this->db->get_where('akun', $kondisi);
    }
    function tampil_data($nm_table, $field, $order)
    {
        $this->db->select('*');
        $this->db->from($nm_table);
        $this->db->order_by($field, $order);
        return $this->db->get();
    }
    function tampil_data_join($sel, $nm_tabel, $nm_tabel_join, $kondisi, $field, $order)
    {
        $this->db->select($sel);
        $this->db->from($nm_tabel);
        $this->db->join($nm_tabel_join, $kondisi);
        $this->db->order_by($field, $order);
        return $query = $this->db->get();
    }
    function tampil_data_join2($sel, $nm_tabel, $nm_tabel_join, $kondisi, $nm_tabel_join2, $kondisi2, $field, $order)
    {
        $this->db->select($sel);
        $this->db->from($nm_tabel);
        $this->db->join($nm_tabel_join, $kondisi);
        $this->db->join($nm_tabel_join2, $kondisi2);
        $this->db->order_by($field, $order);
        return $query = $this->db->get();
    }
    function simpan_data($data, $nm_table)
    {
        $this->db->insert($nm_table, $data);
    }
    function hapus_data($kondisi, $nm_table)
    {
        $this->db->where($kondisi);
        $this->db->delete($nm_table);
    }
    function edit_data($nm_table, $kondisi)
    {
        return $this->db->get_where($nm_table, $kondisi);
    }
    function sel_edit_data_join($sel, $nm_tabel, $nm_tabel_join, $on, $kondisi)
    {
        $this->db->select($sel);
        $this->db->from($nm_tabel);
        $this->db->join($nm_tabel_join, $on);
        $this->db->where($kondisi);
        return $query = $this->db->get();
    }
    function edit_data_join($nm_tabel, $nm_tabel_join, $on, $kondisi)
    {
        $this->db->select('*');
        $this->db->from($nm_tabel);
        $this->db->join($nm_tabel_join, $on);
        $this->db->where($kondisi);
        return $query = $this->db->get();
    }
    function edit_data_join2($sel, $nm_tabel, $nm_tabel_join, $on, $nm_tabel_join2, $on2, $kondisi)
    {
        $this->db->select($sel);
        $this->db->from($nm_tabel);
        $this->db->join($nm_tabel_join, $on);
        $this->db->join($nm_tabel_join2, $on2);
        $this->db->where($kondisi);
        return $query = $this->db->get();
    }
    function proses_update($kondisi, $data, $nm_table)
    {
        $this->db->where($kondisi);
        $this->db->update($nm_table, $data);
    }
    function proses_update_all($data, $nm_table)
    {
        $this->db->update($nm_table, $data);
    }
    function getNipds()
    {
        $this->db->select('Nipd');
        $records = $this->db->get('peserta');
        $users = $records->result_array();
        return $users;
    }
    function getNipdD($postData = array())
    {
        $response = array();

        if (isset($postData['Nipd'])) {
            $this->db->select('*');
            $this->db->where('Nipd', $postData['Nipd']);
            $this->db->join('rombel', 'peserta.Jeniskursus=rombel.Id');
            $this->db->join('unitkompetensi', 'unitkompetensi.Rombel=rombel.Id');
            $records = $this->db->get('peserta');
            $response = $records->result_array();
        }
        return $response;
    }
    function save_log($param)
    {
        $sql        = $this->db->insert_string('log', $param);
        $ex         = $this->db->query($sql);
        return $this->db->affected_rows($sql);
    }
    function get_tables($tables,$cari,$iswhere)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = isset($_POST['search']['value']) ? $this->db->escape_like_str($_POST['search']['value']) : '';
            // Ambil data limit per page
            $limit = (int)preg_replace("/[^0-9]/", '', "{$_POST['length']}");
            $limit = ($limit < 1 || $limit > 200) ? 10 : $limit;
            // Ambil data start
            $start = (int)preg_replace("/[^0-9]/", '', "{$_POST['start']}"); 
            
            $query = $tables;
            
            if(!empty($iswhere)){
                $sql = $this->db->query("SELECT * FROM ".$query." WHERE ".$iswhere);
            }else{
                $sql = $this->db->query("SELECT * FROM ".$query);
            }

            $sql_count = $sql->num_rows();

            $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";

            
            // Untuk mengambil nama field yg menjadi acuan untuk sorting
            $order_field = (int)($_POST['order'][0]['column'] ?? 0);
            $colName = $_POST['columns'][$order_field]['data'] ?? '';
            if (!preg_match('/^[a-zA-Z0-9_.]+$/', $colName)) { $colName = '1'; }

            // Untuk menentukan order by "ASC" atau "DESC"
            $order_ascdesc = strtoupper((string)($_POST['order'][0]['dir'] ?? '')) === 'ASC' ? 'ASC' : 'DESC';
            $order = " ORDER BY ".$colName." ".$order_ascdesc;

            if(!empty($iswhere)){
                $sql_data = $this->db->query("SELECT * FROM ".$query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
            }else{
                $sql_data = $this->db->query("SELECT * FROM ".$query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
            }

            if(isset($search))
            {
                if(!empty($iswhere)){
                    $sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE $iswhere (".$cari.")");
                }else{
                    $sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE (".$cari.")");
                }
                $sql_filter_count = $sql_cari->num_rows();
            }else{
                if(!empty($iswhere)){
                    $sql_filter = $this->db->query("SELECT * FROM ".$query."WHERE ".$iswhere);
                }else{
                    $sql_filter = $this->db->query("SELECT * FROM ".$query);
                }
                $sql_filter_count = $sql_filter->num_rows();
            }
            $data = $sql_data->result_array();

            $callback = array(    
                'draw' => (int)($_POST['draw'] ?? 0), // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$data
            );
            return json_encode($callback); // Convert array $callback ke json
        }
        function get_tables_query($query,$cari,$where,$iswhere)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = isset($_POST['search']['value']) ? $this->db->escape_like_str($_POST['search']['value']) : '';
            // Ambil data limit per page
            $limit = (int)preg_replace("/[^0-9]/", '', "{$_POST['length']}");
            $limit = ($limit < 1 || $limit > 200) ? 10 : $limit;
            // Ambil data start
            $start = (int)preg_replace("/[^0-9]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }
                $fwhere = implode(' AND ', $setWhere);

                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere AND ".$fwhere);
                    
                }else{
                    $sql = $this->db->query($query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();
    
                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
// Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = (int)($_POST['order'][0]['column'] ?? 0);
                $colName = $_POST['columns'][$order_field]['data'] ?? '';
                if (!preg_match('/^[a-zA-Z0-9_.]+$/', $colName)) { $colName = '1'; }

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = strtoupper((string)($_POST['order'][0]['dir'] ?? '')) === 'ASC' ? 'ASC' : 'DESC';
                $order = " ORDER BY ".$colName." ".$order_ascdesc;
    
                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere AND ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query($query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();

            }else{
                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere ");
                }else{
                    $sql = $this->db->query($query);
                }
                $sql_count = $sql->num_rows();
    
                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
// Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = (int)($_POST['order'][0]['column'] ?? 0);
                $colName = $_POST['columns'][$order_field]['data'] ?? '';
                if (!preg_match('/^[a-zA-Z0-9_.]+$/', $colName)) { $colName = '1'; }

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = strtoupper((string)($_POST['order'][0]['dir'] ?? '')) === 'ASC' ? 'ASC' : 'DESC';
                $order = " ORDER BY ".$colName." ".$order_ascdesc;
    
                if(!empty($iswhere))
                {                
                    $sql_data = $this->db->query($query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {     
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere");
                    }else{
                        $sql_filter = $this->db->query($query);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();
            }
            
            $callback = array(    
                'draw' => (int)($_POST['draw'] ?? 0), // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$data
            );
            return json_encode($callback); // Convert array $callback ke json
        }

    function Gethari($tanggal)
    {
        $day = date('D', strtotime($tanggal));
        $hari = date('d ', strtotime($tanggal));
        $tahun = date(' Y', strtotime($tanggal));
        $jam = date('H:i', strtotime($tanggal));
        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // echo $dayList[$day] . ', ' . $pecahkan[0] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[2];
        echo $dayList[$day].', '.$hari.$bulan[(int)$pecahkan[1]].$tahun.' <span class="text-info">Pukul '.$jam.'</span>';
    }
    function update_notes($tabel, $id, $field, $value)
    {
        $data = array($field => $value);
        $this->db->where('id', $id);
        $this->db->update($tabel, $data);
    }
    function tambahKoma($array) {
        $hasil = '';
        foreach ($array as $item) {
            $hasil .= $item . ', ';
        }
        // Menghapus koma terakhir dan spasi
        $hasil = rtrim($hasil, ', ');
        return $hasil;
    }
}
