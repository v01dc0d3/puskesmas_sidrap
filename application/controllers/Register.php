<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (empty($this->session->has_userdata('login'))) {
            header("Location: " . base_url('login') );
        } else {
            $this->load->model("User");
            $akses = $this->User->cek_akses_halaman($this->session->userdata('id_role'), $this->router->fetch_class());
            if ($akses == 0) {
                header("Location: " . base_url('beranda/akses_halaman_terlarang') );
            }
        }
    }
    
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
