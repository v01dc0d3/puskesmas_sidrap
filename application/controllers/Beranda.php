<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function index()
	{
        $data['title'] = "Beranda";
        $data['nama'] = "Puskesmas Sidrap";
		$this->load->view('beranda/header', $data);
		$this->load->view('beranda/style', $data);
		$this->load->view('beranda/index', $data);
	}

    public function akses_halaman_terlarang() {
        $this->load->view('templates/forbidden_access');
    }
}
