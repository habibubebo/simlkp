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
		
		// mengambil data dari database
		 $data = $this->db->query("SELECT * FROM peserta")->result();
		foreach ($data as $row){
             
            $pdf->Cell(50,7,$row->Nama,1,0,"C"); 
            
            $pdf->Cell(30,7,$row->Ttl,1,0,"C"); 
            $pdf->Cell(40,7,$row->Jeniskursus,1,0,"C"); 
            
            $pdf->Cell(40,7,$row->Tanggalmasuk,1,1,"C"); 
            
            //if ($row->Kelamin == "Laki - Laki") {
            //    $laki += 1;
            //}elseif($row->Kelamin == "Perempuan") {
            //    $perempuan += 1;
            //}
        }
		//variabel isian data
		  $year = date("Y");
		  $nomorfinal = "No. $row->Nipd/CU/$year/A";
		  $ttlchange = date('dddd, mmmmm yyyy',strtotime($row->Ttl));
		  $ttlfinal = "Lahir Di $ttlchange";
        // header halaman 
            $pdf->Image(base_url('asset/img/certi.png'),0,0,$pdf->GetPageWidth(),$pdf->GetPageHeight());
            $pdf->SetTextColor(31,31,31);
			$pdf->SetFont('Times','',12);
            $pdf->Cell(0,55,'',0,1,'C');
            $pdf->Cell(0,5,$nomorfinal,0,1,'C');
            $pdf->Cell(0,10,'',0,1,'C');
        // setting jenis font yang akan digunakan
            $pdf->SetFont('Times','B',18);
			$pdf->Cell(0,18,$row->Nama,1,1,'C');
			$pdf->SetFont('Times','',12);
			$pdf->Cell(0,5,$ttlfinal,1,1,'C');
			
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->ln(20);

        // setting jenis font yang akan digunakan
        $pdf->SetFont('Times','B',11);
        
        // membuat jarak margin kiri
        $pdf->Cell(12,7,'',0,0);
		$pdf->ln(5);
		
		$pdf->AddPage();
		$pdf->Image(base_url('asset/img/certioffice.png'),0,0,$pdf->GetPageWidth(),$pdf->GetPageHeight());
            $pdf->SetTextColor(31,31,31);
            $pdf->SetFont('Times','B',18);
            $pdf->Cell(0,7,$row->Nama,0,1,'');
			
        $pdf->Output('I', 'Serttifikat.pdf');
	}
	}
	
?>