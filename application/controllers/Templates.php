<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends CI_Controller {
    public function modal_body_edit_profil_pegawai() {
        $data["modal_id"] = "modal_edit_profil_pegawai";
        $data["modal_label"] = "modal_label_edit_profil_pegawai";
        $data["modal_title"] = "Edit Profile Pegawai";

        $this->load->view('templates/modal/modal_header', $data);
        $this->load->view('templates/edit_profil/pegawai');
        $this->load->view('templates/modal/modal_footer');
    }

    public function update_profil_pegawai() {
        $this->load->model("User");
        echo $this->User->update_profil_pegawai();
    }
    
    public function edit_profil_pasien() {
        $this->load->model("User");
        $data['title'] = "Edit Profil Pasien";
        $data['data_pasien'] =  $this->User->get_data_pasien();

        $this->load->view('templates/auth/auth_header', $data);
		$this->load->view('templates/edit_profil/pasien', $data);
        $this->load->view('templates/edit_profil/script_pasien', $data);
		$this->load->view('templates/auth/auth_footer');
    }

    public function update_profil_pasien() {
        $this->load->model("User");
        echo $this->User->update_profil_pasien();
    }
}
