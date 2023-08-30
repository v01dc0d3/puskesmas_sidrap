<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
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
        $now = new \DateTime('now');
        $monthNum  = $now->format('m');
        $monthNames = [ "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ];
        $monthName = "";
        // var_dump(8 == intval($monthNum));

        for ($i = 0; $i < count($monthNames); $i++) {
            if ($i == intval($monthNum)) {
                $monthName = $monthNames[$i-1];
            }
        }

        $data['title'] = "Laporan " . $monthName;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('templates/script_js/script_topbar');
		$this->load->view('laporan/styling_laporan_print');
		$this->load->view('laporan/index');
		$this->load->view('laporan/script');
        $this->load->view('templates/footer');
	}

    public function read_diagnosis() {
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->model_read_diagnosis());
    }

    public function read_diagnosis_by_month() {
        $month_filter = $_POST["month_filter"];
        $this->load->model("Rekap_medis");
        echo json_encode($this->Rekap_medis->model_read_diagnosis_by_month($month_filter));
    }

    public function print_laporan() {
        $this->load->view('laporan/print_laporan');
    }

}
