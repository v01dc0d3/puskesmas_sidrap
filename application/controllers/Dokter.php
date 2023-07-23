<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {
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
        $data['title'] = "Dokter";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('templates/script_js/script_topbar');
		$this->load->view('dokter/index', $data);
		$this->load->view('dokter/script');
        $this->load->view('templates/footer');
	}

    public function get_all_rekap_medis_group() {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->get_all_rekap_medis_group());
    }

    public function detail() {
        $data['id_rekam_medik'] = $_POST['id_rekam_medik'];
        $data['id_pasien'] = $_POST['id_pasien'];
        $data['nama_kk'] = $_POST['nama_kk'];
        $data['nik'] = $_POST['nik'];
        $data['no_kartu'] = $_POST['no_kartu'];
        $data['title'] = "Detail Rekap Medis";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('dokter/detail', $data);
		$this->load->view('dokter/script_detail', $data);
        $this->load->view('templates/footer');
    }

    public function get_all_rekap_medis_by_id_rekam_medik() {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->get_all_rekap_medis_by_id_rekam_medik());
    }

    public function get_data_pasien() {
        $this->load->model("Pasien");
        echo json_encode($this->Pasien->get_data_pasien_id_namakk());
    }

    public function get_data_ruang() {
        $this->load->model("Ruang");
        echo json_encode($this->Ruang->get_data_ruang());
    }

    public function get_data_rekam_medik_by_id($id) {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->get_data_rekam_medik_by_id($id));
    }

    public function detail_rekap_pasien() {
        $data['id'] = $_POST['id'];
        $data['title'] = "Detail Rekap Medis Pasien";

        $data['nama_kk'] = $_POST['nama_kk'];
        $data['nik'] = $_POST['nik'];
        $data['tgl'] = $_POST['tgl'];
        $data['id_ruang'] = $_POST['id_ruang'];
        $data['kajian_subjektif'] = $_POST['kajian_subjektif'];
        $data['kajian_objektif'] = $_POST['kajian_objektif'];
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
        $data['paraf_paramedis'] = $_POST['paraf_paramedis'];
        $data['paraf_medis'] = $_POST['paraf_medis'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('dokter/detail_rekap_pasien', $data);
		$this->load->view('dokter/script_detail_rekap_pasien', $data);
        $this->load->view('templates/footer');
    }

    public function print_data_rekap_pasien() {
        $this->load->model("Rekap_medis");
        $data['data_rekap_pasien'] = $this->Rekap_medis->get_all_rekap_medis_by_id_rekam_medik();

        $this->load->model("Rekam_medik");
        $data['data_identitas'] = $this->Rekam_medik->get_identitas_by_id($_POST["id_rekam_medik"]);

        $this->load->view('dokter/print_data_rekap_pasien', $data);
    }

    public function edit_rekap_pasien() {
        $data['id'] = $_POST['id'];
        $data['title'] = "Edit Rekap Medis Pasien";

        $data['nama_kk'] = $_POST['nama_kk'];
        $data['nik'] = $_POST['nik'];
        $data['tgl'] = $_POST['tgl'];
        $data['id_ruang'] = $_POST['id_ruang'];
        $data['kajian_subjektif'] = $_POST['kajian_subjektif'];
        $data['kajian_objektif'] = $_POST['kajian_objektif'];
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
        $data['paraf_paramedis'] = $_POST['paraf_paramedis'];
        $data['paraf_medis'] = $_POST['paraf_medis'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
		$this->load->view('dokter/edit_rekap_pasien', $data);
		$this->load->view('dokter/script_edit_rekap_pasien', $data);
        $this->load->view('templates/footer');
    }

    public function edit_data_rekap_pasien() {
        $this->load->model("Rekap_medis");
        echo $this->Rekap_medis->edit_data_rekap_pasien();
    }

    public function delete_data_rekap_by_id($id) {
        $this->load->model("Rekap_medis");
        echo $this->Rekap_medis->delete_data_rekap_by_id($id);
    }

    public function modal_body_resep_obat() {
        $data["modal_id"] = "modal_resep_obat";
        $data["modal_label"] = "modal_label_resep_obat";
        $data["modal_title"] = "Resep Obat";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('dokter/modal/resep_obat');
        $this->load->view('templates/modal/modal_footer');
    }

    public function get_resep_by_id_rms() {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->get_resep_by_id_rms());
    }

    public function tambah_resep_obat() {
        $this->load->model("Resep_obat");
        echo $this->Resep_obat->tambah_resep_obat();
    }

    public function edit_resep_obat() {
        $this->load->model("Resep_obat");
        echo $this->Resep_obat->edit_resep_obat();
    }

}
