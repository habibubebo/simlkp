<?php
class sertifikat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('Model_APS');
        if ($this->session->userdata('status') == "") {
            redirect(base_url("login"));
        }
    }

    function index()
    {
        $Id = $_REQUEST['Id'];
        $data['lulusan'] = $this->db->query("SELECT *,lulusan.Id AS Idl,rombel.Id AS Idr FROM lulusan JOIN instruktur JOIN peserta JOIN rombel JOIN unitkompetensi on lulusan.Instruktur=instruktur.Id AND lulusan.Nipd=peserta.Nipd AND peserta.Jeniskursus=rombel.Id AND unitkompetensi.Rombel=rombel.Id WHERE lulusan.Id=$Id")->result();
        function tgl_indo($tanggal)
        {
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
            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
        //Atur orientasi dan ukuran Halaman
        $pdf = new FPDF('l', 'mm', 'a4');

        //membuat halaman baru
        $pdf->AddPage();

        //setting jenis font yang akan digunakan
        $pdf->SetFont('Times', '', 11);
        $pdf->AddFont('arial', '', 'arial.php');
        $pdf->AddFont('arialbd', '', 'arialbd.php');
        $pdf->AddFont('bookos', '', 'BOOKOS.php');
        $pdf->AddFont('ebrima', '', 'ebrima.php');
        $pdf->AddFont('vivaldib', '', 'vivaldibold.php');
        $pdf->AddFont('rockwell', '', 'rockwell.php');

        //pecah variabel
        foreach ($data['lulusan'] as $row);

        //variabel isian data

        $Tglmasukfinal = tgl_indo($row->Tglmasuk);
        $Tgllulusfinal = tgl_indo($row->Tgllulus);
        $Tglcetakfinal = tgl_indo($row->Tglcetak);
        $year = date("Y");
        $nomorfinal = "No. $row->Nipd/CU/$year/A";
        $nama = ucwords(strtolower($row->Nama));
        $ttl = ucwords(strtolower($row->Ttl));
        $ttlfinal = "Lahir Di $ttl";
        $ket = "telah mengikuti kursus komputer Program $row->Namarombel";
        $ket2 = "yang dilaksanakan tanggal $Tglmasukfinal sampai dengan $Tgllulusfinal";
        $ket3 = "di Lembaga Kursus dan Pelatihan Cendekia Utama.";
        $Tglcetakfinal = "Blitar, " . $Tglcetakfinal;

        //halaman pertama
        $pdf->ln(7);
        $pdf->Image(base_url('asset/img/certi.png'), 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
        $pdf->SetTextColor(31, 31, 31);
        $pdf->SetFont('ebrima', '', 9.5);
        $pdf->Cell(0, 55, '', 0, 1, 'C');
        $pdf->Cell(0, 5, $nomorfinal, 0, 1, 'C');
        $pdf->ln(11);
        $pdf->SetFont('vivaldib', '', 36);
        $pdf->Cell(0, 17, $nama, 0, 1, 'C');
        $pdf->SetFont('bookos', '', 11);
        $pdf->Cell(0, 5, $ttlfinal, 0, 1, 'C');
        $pdf->ln(15);
        $pdf->SetTextColor(53, 53, 53);
        $pdf->Cell(0, 5, $ket, 0, 1, 'C');
        $pdf->Cell(0, 5, $ket2, 0, 1, 'C');
        $pdf->Cell(0, 5, $ket3, 0, 1, 'C');
        $pdf->ln(10);
        $pdf->Cell(200, 5, '', 0, 0, 'R');
        $pdf->SetFont('arialbd', '', 12);
        $pdf->Cell(50, 4, $Tglcetakfinal, 0, 0, 'C');

        //halaman kedua
        $pdf->AddPage();
        if ($row->Instruktur == 3) {
            $pdf->Image(base_url('asset/img/certihbb.png'), 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
        } else {
            $pdf->Image(base_url('asset/img/certibelakang.png'), 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
        }
        // $pdf->SetFont('rockwell','',14);
        $pdf->SetFont('arialbd', '', 14);
        $pdf->ln(15);
        $pdf->Cell(27, 8, '', 0, 0, 'C');
        $pdf->Cell(37, 8, 'Nomor Induk', 0, 0, 'L');
        $pdf->Cell(5, 8, ':', 0, 0, 'L');
        $pdf->Cell(170, 8, $row->Nipd, 0, 1, 'L');

        $pdf->Cell(27, 7, '', 0, 0, 'C');
        $pdf->Cell(37, 7, 'Nama', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'L');
        $pdf->Cell(170, 7, strtoupper($nama), 0, 1, 'L');

        $pdf->Cell(27, 7, '', 0, 0, 'C');
        $pdf->Cell(37, 7, 'Program', 0, 0, 'L');
        $pdf->Cell(5, 7, ':', 0, 0, 'L');
        $pdf->Cell(170, 7, $row->Namarombel, 0, 1, 'L');


        $pdf->ln(10);
        $pdf->SetDrawColor(31, 31, 31);
        $pdf->SetLineWidth(0.8);
        $pdf->Cell(23, 12, '', 0, 0, 'C');
        $pdf->Cell(17, 12, 'No', 1, 0, 'C');
        $pdf->Cell(73, 12, 'Unit Kompetensi', 1, 0, 'C');
        $pdf->Cell(44, 12, 'Waktu', 1, 0, 'C');
        $pdf->Cell(44, 12, 'Nilai', 1, 1, 'C');

        $pdf->Cell(23, 10, '', 0, 0, 'C');
        $pdf->Cell(17, 10, '1.', 1, 0, 'C');
        $pdf->Cell(73, 10, $row->Uk1, 1, 0, 'L');
        $pdf->Cell(44, 10, $row->Jp1, 1, 0, 'C');
        $pdf->Cell(44, 10, $row->n1, 1, 1, 'C');

        $pdf->Cell(23, 10, '', 0, 0, 'C');
        $pdf->Cell(17, 10, '2.', 1, 0, 'C');
        $pdf->Cell(73, 10, $row->Uk2, 1, 0, 'L');
        $pdf->Cell(44, 10, $row->Jp2, 1, 0, 'C');
        $pdf->Cell(44, 10, $row->n2, 1, 1, 'C');

        $pdf->Cell(23, 10, '', 0, 0, 'C');
        $pdf->Cell(17, 10, '3.', 1, 0, 'C');
        $pdf->Cell(73, 10, $row->Uk3, 1, 0, 'L');
        $pdf->Cell(44, 10, $row->Jp3, 1, 0, 'C');
        $pdf->Cell(44, 10, $row->n3, 1, 1, 'C');
        if ($row->Idr == 2) {
        } else if ($row->Idr == 3) {
            $pdf->Cell(23, 10, '', 0, 0, 'C');
            $pdf->Cell(17, 10, '4.', 1, 0, 'C');
            $pdf->Cell(73, 10, $row->Uk4, 1, 0, 'L');
            $pdf->Cell(44, 10, $row->Jp4, 1, 0, 'C');
            $pdf->Cell(44, 10, $row->n4, 1, 1, 'C');
            $pdf->Cell(23, 10, '', 0, 0, 'C');
            $pdf->Cell(17, 10, '5.', 1, 0, 'C');
            $pdf->Cell(73, 10, $row->Uk5, 1, 0, 'L');
            $pdf->Cell(44, 10, $row->Jp5, 1, 0, 'C');
            $pdf->Cell(44, 10, $row->n5, 1, 1, 'C');
        } else {
            $pdf->Cell(23, 10, '', 0, 0, 'C');
            $pdf->Cell(17, 10, '4.', 1, 0, 'C');
            $pdf->Cell(73, 10, $row->Uk4, 1, 0, 'L');
            $pdf->Cell(44, 10, $row->Jp4, 1, 0, 'C');
            $pdf->Cell(44, 10, $row->n4, 1, 1, 'C');
        };
        $pdf->Cell(23, 10, '', 0, 0, 'C');
        $pdf->Cell(17, 10, '', 1, 0, 'C');
        $pdf->Cell(73, 10, 'JUMLAH', 1, 0, 'C');
        $pdf->Cell(44, 10, $row->Jptotal, 1, 0, 'C');
        $pdf->Cell(44, 10, '', 1, 1, 'C');

        if ($row->Idr == 2) {
            $pdf->ln(30);
        } else {
            $pdf->ln(20);
        };
        $pdf->SetFont('arialbd', '', 12);
        $pdf->Cell(190, 5, '', 0, 0, 'R');
        $pdf->Cell(60, 5, 'Instruktur / Penguji', 0, 1, 'C');
        $pdf->ln(20);
        $pdf->Cell(190, 5, '', 0, 0, 'R');
        $pdf->Cell(60, 5, $row->NamaInstruktur, 0, 0, 'C');

        //jadikan pdf				
        $pdf->Output('D', 'Sertifikat ' . substr($nama, 0, 5) . '.pdf');
        // $pdf->Output('I', 'Sertifikat.pdf');
    }
}
