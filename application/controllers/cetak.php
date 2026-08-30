<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cetak extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Model_APS');
    	$this->load->library('pdf');
    	$this->load->library('merge');
    	if($this->session->userdata('status') == ""){
            redirect(base_url("login"));
        }
    }
    
	function index(){
		$Id = $this->input->get('Id');
		$id0 = (int)($Id[0] ?? 0);
		$id1 = (int)($Id[1] ?? 0);
		if ($id0 <= 0 || $id1 <= 0) {
			redirect(base_url("pages/lulusan"));
		}
		$merge = new FPDF_Merge();
		$merge->add(base_url("sertifikat?Id=$id0"));
		$merge->add(base_url("sertifikat?Id=$id1"));
		$merge->output();
	}

}
