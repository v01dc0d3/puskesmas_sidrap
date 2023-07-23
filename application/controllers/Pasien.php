<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
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
        $data['id_pasien'] = $_POST['id_pasien'];
        $data['nama_kk'] = $_POST['nama_kk'];
        $data['nik'] = $_POST['nik'];
        $data['title'] = "Pasien";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('templates/script_js/script_topbar');
		$this->load->view('pasien/index', $data);
		$this->load->view('pasien/script');
        $this->load->view('templates/footer');
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

    public function get_all_rekap_medis_by_id_pasien() {
        $this->load->model('M_pasien');
        echo json_encode($this->M_pasien->get_all_rekap_medis_by_id_pasien());
    }

    public function get_all_rekam_medik_by_id_pasien() {
        $this->load->model('M_pasien');
        echo json_encode($this->M_pasien->get_all_rekam_medik_by_id_pasien());
    }

    public function detail_rekap_pasien() {
        $data['id'] = $_POST['id'];
        $data['title'] = "Detail Rekap Medis Pasien";

        $data['nama_kk'] = $_POST['nama_kk'];
        $data['nik'] = $_POST['nik'];
        $data['tgl'] = $_POST['tgl'];
        $data['id_ruang'] = $_POST['id_ruang'];
        $data['kajian'] = $_POST['kajian'];
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
		$this->load->view('pasien/detail_rekap_pasien', $data);
		$this->load->view('pasien/script_detail_rekap_pasien', $data);
        $this->load->view('templates/footer');
    }

    public function modal_body_detail_rekam() {
        $data["modal_id"] = "modal_detail_rekam";
        $data["modal_label"] = "modal_label_detail_rekam";
        $data["modal_title"] = "Detail Rekam Medik";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('pasien/modal/detail_rekam');
        $this->load->view('templates/modal/modal_footer');
    }

    public function print_data_rekap_pasien() {
        $this->load->model("Rekap_medis");
        $data['data_rekap_pasien'] = $this->Rekap_medis->get_all_rekap_medis_by_id_rekam_medik();

        $this->load->model("Rekam_medik");
        $data['data_identitas'] = $this->Rekam_medik->get_identitas_by_id($_POST["id_rekam_medik"]);

        $this->load->view('perawat/print_data_rekap_pasien', $data);
    }

    public function cek_tgl_antrian() {
        $this->load->model("M_antrian");
        echo json_encode($this->M_antrian->cek_tgl_antrian());
    }

    public function create_antrian() {
        $this->load->model("M_antrian");
        echo $this->M_antrian->create_antrian();
    }

    public function read_antrian_from_id_user() {
        $this->load->model("M_antrian");
        echo json_encode($this->M_antrian->read_antrian_from_id_user($_POST['id_user']));
    }

    public function delete_all_antrian() {
        $this->load->model("M_antrian");
        $this->M_antrian->delete_all_antrian();
    }

}
