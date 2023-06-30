<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf extends CI_Controller {
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
        $data['title'] = "Staf";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('templates/script_js/script_topbar');
		$this->load->view('staf/index', $data);
		$this->load->view('staf/script');
        $this->load->view('templates/footer');
	}

    public function get_all_last_rekam_medik_pasien() {
        $this->load->model("Rekam_medik");
        echo json_encode($this->Rekam_medik->get_all_last_rekam_medik_pasien());
    }

    public function atur() {
        $data['title'] = 'Atur Rekam Medik';

        $data['id_pasien'] = $_POST['id_pasien'];
        $data['nama_kk'] = $_POST['nama_kk'];
        $data['no_kartu'] = $_POST['no_kartu'];
        $data['no'] = $_POST['no'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('staf/atur', $data);
		$this->load->view('staf/script_atur', $data);
        $this->load->view('templates/footer');
    }

    public function get_all_rekam_medik_pasien_by_id_pasien() {
        $this->load->model("Rekam_medik");
        echo json_encode($this->Rekam_medik->get_all_rekam_medik_pasien_by_id_pasien());
    }

    public function modal_body_tambah_rekam() {
        $data["modal_id"] = "modal_tambah_rekam";
        $data["modal_label"] = "modal_label_tambah_rekam";
        $data["modal_title"] = "Tambah Rekam Medik";

        $data['nama_kk'] = $_POST['nama_kk'];

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('staf/modal/tambah_rekam');
        $this->load->view('templates/modal/modal_footer');
    }

    public function insert_data_rekam() {
        $this->load->model("Rekam_medik");
        echo $this->Rekam_medik->insert_data_rekam();
    }

    public function delete_data_rekam_by_id() {
        $this->load->model("Rekam_medik");
        echo $this->Rekam_medik->delete_data_rekam_by_id();
    }

    public function modal_body_detail_rekam() {
        $data["modal_id"] = "modal_detail_rekam";
        $data["modal_label"] = "modal_label_detail_rekam";
        $data["modal_title"] = "Detail Rekam Medik";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('staf/modal/detail_rekam');
        $this->load->view('templates/modal/modal_footer');
    }

    public function modal_body_edit_rekam() {
        $data["modal_id"] = "modal_edit_rekam";
        $data["modal_label"] = "modal_label_edit_rekam";
        $data["modal_title"] = "Edit Rekam Medik";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('staf/modal/edit_rekam');
        $this->load->view('templates/modal/modal_footer');
    }

    public function edit_data_rekam() {
        $this->load->model("Rekam_medik");
        echo $this->Rekam_medik->edit_data_rekam();
    }

    public function cek_tgl_antrian() {
        $this->load->model("M_antrian");
        echo json_encode($this->M_antrian->cek_tgl_antrian());
    }

    public function create_antrian() {
        $this->load->model("M_antrian");
        echo json_encode($this->M_antrian->create_antrian());
    }

    public function delete_all_antrian() {
        $this->load->model("M_antrian");
        $this->M_antrian->delete_all_antrian();
    }

    public function atur_pengguna() {
        $data['title'] = "Atur Pengguna";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('templates/script_js/script_topbar');
		$this->load->view('staf/atur_pengguna', $data);
		$this->load->view('staf/script_atur_pengguna');
        $this->load->view('templates/footer');
    }

    public function get_all_role_full_name_for_staf() {
        $this->load->model("Pasien");
        echo json_encode($this->Pasien->get_all_role_full_name_for_staf());
    }

    public function modal_body_edit_pengguna() {
        $this->load->model("Pasien");
        $data['roles'] = $this->Pasien->get_all_roles_for_staf();

        $data["modal_id"] = "modal_edit_pengguna";
        $data["modal_label"] = "modal_label_edit_pengguna";
        $data["modal_title"] = "Edit pengguna";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('staf/modal/edit_pengguna', $data);
        $this->load->view('templates/modal/modal_footer');
    }

    public function update_pengguna_for_staf() {
        $this->load->model("Pasien");
        echo $this->Pasien->update_pengguna_for_staf();
    }

    public function delete_pengguna_for_staf($id) {
        $this->load->model("Pasien");
        echo $this->Pasien->delete_pengguna_for_staf($id);
    }

}
