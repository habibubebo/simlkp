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
		$Id = $_REQUEST['Id'];
		$merge = new FPDF_Merge();
		$merge->add(base_url("sertifikat?Id=$Id[0]"));
		$merge->add(base_url("sertifikat?Id=$Id[1]"));
		$merge->output();
	}

}
