<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index()
	{
        $data['title'] = "Register";

		$this->load->view('templates/auth/auth_header', $data);
		$this->load->view('register/index');
        $this->load->view('register/script');
		$this->load->view('templates/auth/auth_footer');
	}

    public function daftar() {
        $this->load->model("Pasien");
        echo $this->Pasien->daftar();
    }
}
