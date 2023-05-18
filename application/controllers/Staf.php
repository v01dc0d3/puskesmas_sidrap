<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf extends CI_Controller {
	public function index()
	{
        $data['title'] = "Staf";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
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

}
