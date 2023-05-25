<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apoteker extends CI_Controller {
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
        $data['title'] = "Apoteker";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('templates/script_js/script_topbar');
		$this->load->view('apoteker/index', $data);
		$this->load->view('apoteker/script');
        $this->load->view('templates/footer');
	}

    public function get_all_resep_obat() {
        $this->load->model("Resep_obat");
        echo json_encode($this->Resep_obat->get_all_resep_obat());
    }

    public function modal_body_edit_resep_obat() {
        $data["modal_id"] = "modal_edit_resep_obat";
        $data["modal_label"] = "modal_label_edit_resep_obat";
        $data["modal_title"] = "Detail Resep Obat";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('apoteker/modal/edit_resep_obat');
        $this->load->view('templates/modal/modal_footer');
    }

    public function edit_resep_obat_apoteker() {
        $this->load->model("Resep_obat");
        echo $this->Resep_obat->edit_resep_obat_apoteker();
    }
}
