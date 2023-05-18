<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
        $data['title'] = "Login";

		$this->load->view('templates/auth/auth_header', $data);
		$this->load->view('login/index');
        $this->load->view('login/script');
		$this->load->view('templates/auth/auth_footer');
	}

	public function cek_akun() {
		$this->load->model("User");

		$data_user = $this->User->cek_akun()[0];
		if (!empty($data_user)) {
			$rolename = $this->User->get_role_name($data_user['id_role'])[0]["rolename"];

			if ($data_user['id_role'] == '6') {
				// ngambil data pasien
			} else {
				$this->session->set_userdata([
					'id_user' => $data_user['id'],
					'id_role' => $data_user['id_role'],
					'email' => $data_user['email'],
					'rolename' => $rolename,
					'login' => "true",
				]);
			}
		}
		echo json_encode($this->session->userdata());
	}
}
