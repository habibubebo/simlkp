<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesertas extends CI_Controller {

	public function __construct(){
        parent::__construct();
    
        // Load Model
        $this->load->model('Model_APS');
    
        // Load base_url
        $this->load->helper('url');
    }
    
    
	public function Nipd(){
		// POST data
		$postData = $this->input->post();

		// get data
		$data = $this->Model_APS->getNipdD($postData);

		echo json_encode($data);
	}

}
