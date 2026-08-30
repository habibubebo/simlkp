<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alumni extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_APS');
    }

    // Halaman publik cek data alumni / verifikasi sertifikat.
    public function index()
    {
        $data['profil'] = $this->Model_APS->tampil_data('profil', 'npsn', 'ASC')->result();
        $data['q'] = trim((string)$this->input->get('q'));
        $data['hasil'] = ($data['q'] !== '') ? $this->_cari($data['q']) : array();

        $this->load->view('alumni/index', $data);
    }

    // Format tanggal ke "d Bulan Y" (mis. 30 Agustus 2026).
    private function _tgl($tanggal)
    {
        if (empty($tanggal)) {
            return '-';
        }
        $bulan = array(
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $pecah = explode('-', (string)$tanggal);
        if (count($pecah) !== 3) {
            return htmlspecialchars((string)$tanggal, ENT_QUOTES);
        }
        return $pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
    }

    // Cari peserta/lulusan berdasarkan NIPD (identitas unik pada sertifikat).
    private function _cari($q)
    {
        // Ambil angka pertama bila input berupa nomor sertifikat ("123/CU/2026/A").
        if (!preg_match('/\d+/', (string)$q, $m)) {
            return array();
        }
        $nipd = (int)$m[0];
        if ($nipd <= 0) {
            return array();
        }

        $this->db->select('p.Nipd, p.Nama, p.Kelamin, p.Tglmasuk, r.Namarombel, l.Tgllulus, l.Tglcetak, l.Id AS Idl');
        $this->db->from('peserta p');
        $this->db->join('rombel r', 'p.Jeniskursus = r.Id', 'left');
        $this->db->join('lulusan l', 'l.Nipd = p.Nipd', 'left');
        $this->db->where('p.Nipd', $nipd);
        $this->db->order_by('p.Nipd', 'ASC');
        $this->db->limit(1);

        $rows = $this->db->get()->result();
        $hasil = array();

        foreach ($rows as $r) {
            $valid = ($r->Idl !== null);
            $hasil[] = (object) array(
                'Nipd' => $r->Nipd,
                'Nama' => $r->Nama,
                'Kelamin' => $r->Kelamin,
                'Program' => trim((string)$r->Namarombel),
                'Mulai' => $this->_tgl($r->Tglmasuk),
                'Selesai' => $this->_tgl($r->Tgllulus),
                'Cetak' => $this->_tgl($r->Tglcetak),
                'Valid' => $valid,
                'NoSertifikat' => ($valid && !empty($r->Tgllulus))
                    ? 'No. ' . $r->Nipd . '/CU/' . date('Y', strtotime((string)$r->Tgllulus)) . '/A'
                    : '',
            );
        }

        return $hasil;
    }
}