<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perawat extends CI_Controller {
	public function index()
	{
        $data['title'] = "Perawat";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('perawat/index', $data);
		$this->load->view('perawat/script');
        $this->load->view('templates/footer');
	}

    public function modal_body_tambah_rekap() {
        $data["modal_id"] = "modal_tambah_rekap";
        $data["modal_label"] = "modal_label_tambah_rekap";
        $data["modal_title"] = "Tambah Rekap";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('perawat/modal/tambah_rekap');
        $this->load->view('templates/modal/modal_footer');
    }

    public function modal_body_edit_rekap() {
        $data["modal_id"] = "modal_edit_rekap";
        $data["modal_label"] = "modal_label_edit_rekap";
        $data["modal_title"] = "Edit Rekap";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('perawat/modal/edit_rekap');
        $this->load->view('templates/modal/modal_footer');
    }

    public function get_data_pasien() {
        $this->load->model("Pasien");
        echo json_encode($this->Pasien->get_data_pasien_id_namakk());
    }

    public function get_data_ruang() {
        $this->load->model("Ruang");
        echo json_encode($this->Ruang->get_data_ruang());
    }

    public function get_id_rekam_medik_by_pasien() {
        $this->load->model("Rekam_medik");
        echo json_encode($this->Rekam_medik->get_id_rekam_medik_by_pasien());
    }

    public function insert_data_rekap() {
        $this->load->model("Rekap_medis");
        echo $this->Rekap_medis->insert_data_perawat();
    }

    public function get_all_rekap_medis() {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->get_all_rekap_medis());
    }

    public function delete_data_rekap_by_id($id) {
        $this->load->model("Rekap_medis");
        echo $this->Rekap_medis->delete_data_rekap_by_id($id);
    }

    public function get_data_rekam_medik_by_id($id) {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->get_data_rekam_medik_by_id($id));
    }

    public function edit_data_rekap($id) {
        $this->load->model("Rekap_medis");
        echo $this->Rekap_medis->edit_data_rekap($id);
    }

    public function modal_body_detail_rekap()
    {
        $data["modal_id"] = "modal_detail_rekap";
        $data["modal_label"] = "modal_label_detail_rekap";
        $data["modal_title"] = "Detail Rekap Medis";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('perawat/modal/detail_rekap');
        $this->load->view('templates/modal/modal_footer');
    }
}
