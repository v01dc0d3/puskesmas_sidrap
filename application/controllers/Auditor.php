<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditor extends CI_Controller {
	public function index()
	{
        $data['title'] = "Auditor";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
		$this->load->view('beranda/index');
        $this->load->view('templates/footer');
	}
}
