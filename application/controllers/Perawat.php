<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perawat extends CI_Controller {
	public function index()
	{
        $data['title'] = "Perawat";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('perawat/index', $data);
		// $this->load->view('perawat/script.js');
        $this->load->view('templates/footer');
	}
}
