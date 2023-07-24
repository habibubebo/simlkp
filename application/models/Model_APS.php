<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_APS extends CI_Model
{
    // Membuat fungsi cek_akun($Parameter) untuk melakukan pemeriksaan data($Parameter) ke tabel akun di database
    function cek_akun($kondisi)
    {
        // Mendapatkan nilai dari hasil pemeriksaan 
        return $this->db->get_where('akun', $kondisi);
    }
    // Membuat fungsi tampil_data($nm_tabel) untuk menampilkan data dari nama tabel yang dikirim
    function tampil_data($nm_table, $field, $order)
    {
        // Mendapatkan nilai dari pengambilan data dari nama tabel yang dikirim 
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
    // Membuat fungsi simpan_data($data,$nm_tabel)
    function simpan_data($data, $nm_table)
    {
        // Memanggil fungsi insert($nm_tabel,$data)
        $this->db->insert($nm_table, $data);
    }
    // Membuat fungsi hapus_data($kondisi,$nm_tabel)
    function hapus_data($kondisi, $nm_table)
    {
        // Memanggil fungsi where($kondisi)
        $this->db->where($kondisi);
        // Memanggil fungsi delete($nm_tabel)
        $this->db->delete($nm_table);
    }
    // Membuat fungsi edit_data($kondisi,$nm_tabel)
    function edit_data($nm_table, $kondisi)
    {
        // Mendapatkan nilai dari pengambilan data dari nama tabel dan kondisi yang dikirim 
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
    // Membuat fungsi proses_update($kondisi,$data,$nm_table)
    function proses_update($kondisi, $data, $nm_table)
    {
        $this->db->where($kondisi);
        $this->db->update($nm_table, $data);
    }
    function proses_update_all($data, $nm_table)
    {
        $this->db->update($nm_table, $data);
    }
    //cari data Nipd
    function getNipds()
    {
        $this->db->select('Nipd');
        $records = $this->db->get('peserta');
        $users = $records->result_array();
        return $users;
    }
    //cari detail Nipd
    function getNipdD($postData = array())
    {
        $response = array();

        if (isset($postData['Nipd'])) {
            $this->db->select('*');
            $this->db->where('Nipd', $postData['Nipd']);
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
    // Merubah tanggal
    function Gethari($tanggal)
    {
        $day = date('D', strtotime($tanggal));
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

        echo $dayList[$day] . ', ' . $pecahkan[0] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[2];
    }
}
