<?php
Class instruktur extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('Model_APS');
        function garis(){
            $this->SetLineWidth(1);
            $this->Line(10,36,138,36);
            $this->SetLineWidth(0);
            $this->Line(10,37,138,37);
        }
    }
    function index(){
        // Atur orientasi dan ukuran Halaman
            $pdf = new FPDF('l','mm','legal');
        
        // membuat halaman baru
            $pdf->AddPage();
        
        // setting jenis font yang akan digunakan
        
        // header halaman 
            $pdf->Image(base_url('asset/img/logo/logo.png'),30,12,50);
            
            $pdf->SetFont('Times','B',18);
            $pdf->Cell(0,7,'LEMBAGA KURSUS DAN PELATIHAN (LKP)',0,1,'C');
            $pdf->Cell(0,7,'CENDEKIA UTAMA',0,1,'C');
            // $pdf->SetFont('Times','B',24);
            $pdf->SetFont('Times','',14);
            $pdf->Cell(0,5,'Akta Notaris ',0,1,'C');
            $pdf->SetFont('Times','',12);
            $pdf->Cell(0,5,'Jl. Veteran No. 44 Kota Blitar, e-mail : cenditama@gmail.com',0,1,'C');
            $pdf->SetTextColor(255,0,0);
            $pdf->SetFont('Times','B',16);
            $pdf->Cell(0,5,'TERAKREDITASI',0,1,'C');
            $pdf->SetTextColor(0,0,0);
        // Garis
            $pdf->SetLineWidth(1);
            $pdf->Line(15.3,39, 338.8, 39);
            $pdf->SetLineWidth(0.5);
            $pdf->Line(15,40.0, 339, 40.0);
            $pdf->SetLineWidth(0);

        // setting jenis font yang akan digunakan
            $pdf->SetFont('Times','B',18);
        
        // Title 
            $pdf->Cell(0,20,'Data Instruktur',0,0,'C');
        
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->ln(20);

        // setting jenis font yang akan digunakan
        $pdf->SetFont('Times','B',11);
        
        // membuat jarak margin kiri
        $pdf->Cell(12,7,'',0,0);

        // tabel membuat baris header
        $pdf->Cell(50,7,'Nama Instruktur',1,0,"C");
        $pdf->Cell(30,7,'Kelamin',1,0,"C");
        $pdf->Cell(50,7,'Tempat Lahir',1,0,"C");
        $pdf->Cell(30,7,'Tanggal Lahir',1,0,"C");
        $pdf->Cell(50,7,'Nama Ibu',1,0,"C");
        $pdf->Cell(50,7,'Alamat',1,0,"C");
        $pdf->Cell(50,7,'Alamat Email',1,1,"C");
        
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Times','',11);

        // tabel membuat baris isi ngambil database
        // $no = 1;
        $data = $this->db->query("SELECT * FROM instruktur")->result();
        $total = 0;
        $laki = 0;
        $perempuan = 0;
        foreach ($data as $row){
            $pdf->Cell(12,7,'',0,0);
            $pdf->Cell(50,7,$row->NamaInstruktur,1,0,"C"); 
            $pdf->Cell(30,7,$row->Kelamin,1,0,"C"); 
            $pdf->Cell(50,7,$row->Tempatlahir,1,0,"C"); 
            $pdf->Cell(30,7,$row->Tanggallahir,1,0,"C"); 
            $pdf->Cell(50,7,$row->Namaibu,1,0,"C"); 
            $pdf->Cell(50,7,$row->Alamat,1,0,"C"); 
            $pdf->Cell(50,7,$row->Email,1,1,"C"); 
            $total += 1;
            if ($row->Kelamin == "Laki - Laki") {
                $laki += 1;
            }elseif($row->Kelamin == "Perempuan") {
                $perempuan += 1;
            }
        }
        $pdf->Cell(13,7,'',0,0);
        $pdf->Cell(30,7,"Total Instruktur : ".$total." orang",0,1);
        $pdf->Cell(13,7,'',0,0);
        $pdf->Cell(30,7,"Laki - Laki : ".$laki,0,1);
        $pdf->Cell(13,7,'',0,0);
        $pdf->Cell(30,7,"Perempuan : ".$perempuan,0,1);
        $pdf->ln(5);
        $pdf->Output('I', 'Laporan Instruktur.pdf');
    }
}
?>