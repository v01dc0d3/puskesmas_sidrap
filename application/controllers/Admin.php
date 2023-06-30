<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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
        $data['title'] = "Admin";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('templates/script_js/script_topbar');
		$this->load->view('admin/index');
		$this->load->view('admin/script');
        $this->load->view('templates/footer');
	}

    public function get_all_page_access() {
        $this->load->model('M_page_access');
        echo json_encode($this->M_page_access->get_all_page_access());
    }

    public function modal_body_tambah_akses_halaman() {
        $data["modal_id"] = "modal_tambah_halaman";
        $data["modal_label"] = "modal_label_tambah_halaman";
        $data["modal_title"] = "Tambah Halaman";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('admin/modal/tambah_halaman');
        $this->load->view('templates/modal/modal_footer');
    }

    public function get_data_halaman() {
        $this->load->model('M_page_access');
        echo json_encode($this->M_page_access->get_data_halaman());
    }

    public function get_data_role() {
        $this->load->model('M_page_access');
        echo json_encode($this->M_page_access->get_data_role());
    }

    public function insert_akses_halaman() {
        $this->load->model('M_page_access');
        echo $this->M_page_access->insert_akses_halaman();
    }

    public function delete_akses() {
        $this->load->model('M_page_access');
        echo $this->M_page_access->delete_akses();
    }

    public function atur_staf() {
        $data['title'] = "Atur Staf";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('templates/script_js/script_topbar');
		$this->load->view('admin/atur_staf', $data);
		$this->load->view('admin/script_atur_staf');
        $this->load->view('templates/footer');
    }

    public function get_all_role_full_name_for_admin() {
        $this->load->model("Pasien");
        echo json_encode($this->Pasien->get_all_role_full_name_for_admin());
    }

    public function modal_body_edit_staf() {
        $this->load->model("Pasien");
        $data['roles'] = $this->Pasien->get_all_roles_for_admin();

        $data["modal_id"] = "modal_edit_staf";
        $data["modal_label"] = "modal_label_edit_staf";
        $data["modal_title"] = "Edit Staf";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('admin/modal/edit_staf', $data);
        $this->load->view('templates/modal/modal_footer');
    }

    public function update_staf_for_admin() {
        $this->load->model("Pasien");
        echo $this->Pasien->update_staf_for_admin();
    }

    public function delete_pengguna_for_admin($id) {
        $this->load->model("Pasien");
        echo $this->Pasien->delete_pengguna_for_staf($id);
    }

}
