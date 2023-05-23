<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function index()
	{
        $data['title'] = "Beranda";
		$this->load->view('beranda/index', $data);
	}

    public function akses_halaman_terlarang() {
        $this->load->view('templates/forbidden_access');
    }
}
