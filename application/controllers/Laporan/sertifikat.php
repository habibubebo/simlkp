<?php
Class sertifikat extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('Model_APS');
    }
	
    function index(){
		
        // Atur orientasi dan ukuran Halaman
            $pdf = new FPDF('l','mm','a4');
        
        // membuat halaman baru
            $pdf->AddPage();
		
		// setting jenis font yang akan digunakan
        $pdf->SetFont('Times','',11);
        $pdf->AddFont('arial', '', 'arial.php');
        $pdf->AddFont('arialbd', '', 'arialbd.php');
        $pdf->AddFont('bookos', '', 'BOOKOS.php');
		$pdf->AddFont('ebrima', '', 'ebrima.php');
		$pdf->AddFont('vivaldib', '', 'vivaldibold.php');

		
		// mengambil data dari database
		 $data = $this->db->query("SELECT * FROM peserta")->result();
		foreach ($data as $row){
            $pdf->Cell(50,7,$row->Nama,1,0,"C"); 
            $pdf->Cell(30,7,$row->Ttl,1,0,"C"); 
            $pdf->Cell(40,7,$row->Jeniskursus,1,0,"C"); 
            $pdf->Cell(40,7,$row->Tanggalmasuk,1,1,"C"); 
        }
		//variabel isian data
		  $year = date("Y");
		  $nomorfinal = "No. $row->Nipd/CU/$year/A";
		  $nama = ucwords(strtolower($row->Nama));
		  $ttl = ucwords(strtolower($row->Ttl));
		  $ttlfinal = "Lahir Di $ttl";
          $ket = "telah mengikuti kursus komputer Program $row->Jeniskursus";
          $ket2 = "yang dilaksanakan tanggal $row->Tanggalmasuk sampai dengan tglselesai";
          $ket3 = "di Lembaga Kursus dan Pelatihan Cendekia Utama.";
        // header halaman 
            $pdf->Image(base_url('asset/img/certi.png'),0,0,$pdf->GetPageWidth(),$pdf->GetPageHeight());
            $pdf->SetTextColor(31,31,31);
			$pdf->SetFont('ebrima','',9.5);
            $pdf->Cell(0,55,'',0,1,'C');
            $pdf->Cell(0,5,$nomorfinal,0,1,'C');
            $pdf->ln(10);
            $pdf->SetFont('vivaldib','',24);
			$pdf->Cell(0,18,$nama,0,1,'C');
			$pdf->SetFont('bookos','',11);
			$pdf->Cell(0,5,$ttlfinal,0,1,'C');
            $pdf->ln(15);
			$pdf->SetTextColor(53,53,53);
			$pdf->Cell(0,5,$ket,0,1,'C');
			$pdf->Cell(0,5,$ket2,0,1,'C');
			$pdf->Cell(0,5,$ket3,0,1,'C');
            $pdf->ln(10);
			
			$pdf->Cell(200,5,'',0,0,'R');
			$pdf->SetFont('arialbd','',12);
			$pdf->Cell(50,4,$row->Ttl,0,0,'C');


		
		//halaman kedua
		$pdf->AddPage();
		$pdf->Image(base_url('asset/img/certioffice.png'),0,0,$pdf->GetPageWidth(),$pdf->GetPageHeight());
            
            $pdf->SetFont('arialbd','',14);
            $pdf->text(80,31,$row->Nipd,0,1,'');
            $pdf->text(80,37,$nama,0,1,'');
            $pdf->text(80,44,$row->Jeniskursus,0,1,'');
            $pdf->text(187,74,'A',0,1);
            $pdf->text(187,84,'A',0,1);
            $pdf->text(187,94,'A',0,1);
            $pdf->text(187,104,'A',0,1);
			$pdf->ln(160);
            $pdf->SetFont('arialbd','',12);
			$pdf->Cell(190,5,'',0,0,'R');
			$pdf->Cell(60,5,'Habib Muhammad, S.Pd',0,0,'C');
			
			//trial
			
						
        $pdf->Output('I', 'Serttifikat.pdf');
	}
	}
	
?>