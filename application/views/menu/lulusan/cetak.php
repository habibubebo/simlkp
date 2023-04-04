<?php
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
foreach ($lulusan as $row);

//variabel isian data

$Tglmasukfinal = tgl_indo($row->Tglmasuk);
$Tgllulusfinal = tgl_indo($row->Tgllulus);
$Tglcetakfinal = tgl_indo($row->Tglcetak);
$year = date("Y");
$nomorfinal = "No. $row->Nipd/CU/$year/A";
$nama = ucwords(strtolower($row->Nama));
$ttl = ucwords(strtolower($row->Ttl));
$ttlfinal = "Lahir Di $ttl";
$ket = "telah mengikuti kursus komputer Program $row->Jeniskursus";
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
$pdf->Image(base_url('asset/img/certioffice.png'), 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());

$pdf->SetFont('rockwell', '', 14);
$pdf->text(80, 31, $row->Nipd, 0, 1, '');
$pdf->text(80, 37, strtoupper($nama), 0, 1, '');
$pdf->text(80, 44, $row->Jeniskursus, 0, 1, '');
$pdf->SetFont('arialbd', '', 14);
$pdf->text(187, 74, $row->n1, 0, 1);
$pdf->text(187, 84, $row->n2, 0, 1);
$pdf->text(187, 94, $row->n3, 0, 1);
$pdf->text(187, 104, $row->n4, 0, 1);
$pdf->ln(160);
$pdf->SetFont('arialbd', '', 12);
$pdf->Cell(190, 5, '', 0, 0, 'R');
$pdf->Cell(60, 5, $row->Instruktur, 0, 0, 'C');

//jadikan pdf				
//$pdf->Output('I', 'Serttifikat '.$nama.'.pdf');
$pdf->Output('I', 'Serttifikat.pdf');
