<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditor extends CI_Controller {
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
        $data['title'] = "Auditor";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('templates/script_js/script_topbar');
		$this->load->view('auditor/index');
		$this->load->view('auditor/script');
        $this->load->view('templates/footer');
	}

    public function get_all_last_rekam_medik_pasien() {
        $this->load->model("Rekam_medik");
        echo json_encode($this->Rekam_medik->get_all_last_rekam_medik_pasien());
    }

    public function dokter() {
        $data['title'] = "Auditor Dokter";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('auditor/audit_dokter');
		$this->load->view('auditor/script_audit_dokter', $data);
        $this->load->view('templates/footer');
    }

    public function dokter_lihat() {
        $data['title'] = 'Lihat Rekap Medis';
        $data['id_rekam_medik'] = $_POST['id_rekam_medik'];
        $data['no_kartu'] = $_POST['no_kartu'];
        $data['nama_kk'] = $_POST['nama_kk'];
        $data['id_pasien'] = $_POST['id_pasien'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('auditor/audit_dokter_lihat');
		$this->load->view('auditor/script_audit_dokter_lihat', $data);
        $this->load->view('templates/footer');
    }

    public function get_all_rekap_medis_group() {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->get_all_rekap_medis_group());
    }

    public function get_all_rekap_medis_by_id_rekam_medik() {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->get_all_rekap_medis_by_id_rekam_medik());
    }

    public function detail_rekap_pasien() {
        $data['id'] = $_POST['id'];
        $data['title'] = "Detail Rekap Medis Pasien";

        $data['nama_kk'] = $_POST['nama_kk'];
        $data['tgl'] = $_POST['tgl'];
        $data['id_ruang'] = $_POST['id_ruang'];
        $data['kajian_subjektif'] = $_POST['kajian_subjektif'];
        $data['anam_pem_fisik'] = $_POST['anam_pem_fisik'];
        $data['diagnosis'] = $_POST['diagnosis'];
        $data['terapi'] = $_POST['terapi'];
        $data['asuhan'] = $_POST['asuhan'];
        $data['icd'] = $_POST['icd'];
        $data['id_pasien'] = $_POST['id_pasien'];
        $data['id_ruang'] = $_POST['id_ruang'];
        $data['nama_ruang'] = $_POST['nama_ruang'];
        $data['id_rekam_medik'] = $_POST['id_rekam_medik'];
        $data['no_kartu'] = $_POST['no_kartu'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('auditor/detail_rekap_pasien', $data);
		$this->load->view('auditor/script_detail_rekap_pasien', $data);
        $this->load->view('templates/footer');
    }

    public function modal_body_resep_obat() {
        $data["modal_id"] = "modal_resep_obat";
        $data["modal_label"] = "modal_label_resep_obat";
        $data["modal_title"] = "Resep Obat";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('auditor/modal/resep_obat');
        $this->load->view('templates/modal/modal_footer');
    }

    public function get_resep_by_id_rms() {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->get_resep_by_id_rms());
    }

    public function perawat()
	{
        $data['title'] = "Auditor Perawat";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('auditor/audit_perawat', $data);
		$this->load->view('auditor/script_audit_perawat');
        $this->load->view('templates/footer');
	}

    public function get_all_rekap_medis() {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->get_all_rekap_medis());
    }

    public function modal_body_detail_rekap()
    {
        $data["modal_id"] = "modal_detail_rekap";
        $data["modal_label"] = "modal_label_detail_rekap";
        $data["modal_title"] = "Detail Rekap Medis";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('auditor/modal/detail_rekap');
        $this->load->view('templates/modal/modal_footer');
    }

    public function get_data_rekam_medik_by_id($id) {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->get_data_rekam_medik_by_id($id));
    }

    public function get_data_pasien() {
        $this->load->model("Pasien");
        echo json_encode($this->Pasien->get_data_pasien_id_namakk());
    }

    public function get_data_ruang() {
        $this->load->model("Ruang");
        echo json_encode($this->Ruang->get_data_ruang());
    }

    public function print_data_rekap_pasien() {
        $this->load->model("Rekap_medis");
        $data['data_rekap_pasien'] = $this->Rekap_medis->get_all_rekap_medis_by_id_rekam_medik();

        $this->load->model("Rekam_medik");
        $data['data_identitas'] = $this->Rekam_medik->get_identitas_by_id($_POST['id_rekam_medik']);

        $this->load->view('auditor/print_data_rekap_pasien', $data);
    }

    public function staf()
	{
        $data['title'] = "Auditor Staf";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('auditor/audit_staf', $data);
		$this->load->view('auditor/script_audit_staf');
        $this->load->view('templates/footer');
	}

    public function staf_lihat() {
        $data['title'] = 'Lihat Rekam Medik';

        $data['id_pasien'] = $_POST['id_pasien'];
        $data['nama_kk'] = $_POST['nama_kk'];
        $data['no_kartu'] = $_POST['no_kartu'];
        $data['no'] = $_POST['no'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('auditor/audit_staf_lihat', $data);
		$this->load->view('auditor/script_audit_staf_lihat', $data);
        $this->load->view('templates/footer');
    }

    public function get_all_rekam_medik_pasien_by_id_pasien() {
        $this->load->model("Rekam_medik");
        echo json_encode($this->Rekam_medik->get_all_rekam_medik_pasien_by_id_pasien());
    }

    public function modal_body_detail_rekam() {
        $data["modal_id"] = "modal_detail_rekam";
        $data["modal_label"] = "modal_label_detail_rekam";
        $data["modal_title"] = "Detail Rekam Medik";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('staf/modal/detail_rekam');
        $this->load->view('templates/modal/modal_footer');
    }

    public function apoteker() {
        $data['title'] = "Audit Apoteker";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('auditor/audit_apoteker', $data);
		$this->load->view('auditor/script_audit_apoteker');
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
        $this->load->view('auditor/modal/edit_resep_obat');
        $this->load->view('templates/modal/modal_footer');
    }

}
