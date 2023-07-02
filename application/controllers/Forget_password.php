<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget_password extends CI_Controller {
	public function index()
	{
        $data['title'] = "Lupa Passowrd";

		$this->load->view('templates/auth/auth_header', $data);
		$this->load->view('forget_password/index');
        $this->load->view('forget_password/script');
		$this->load->view('templates/auth/auth_footer');
	}

	
}
