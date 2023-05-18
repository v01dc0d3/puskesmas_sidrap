<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
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
        $this->session->sess_destroy();
        header("Location: " . base_url('login'));
	}
}
