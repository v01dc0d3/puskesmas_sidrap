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
		$this->load->model("M_antrian");

		try {
			$data_user = $this->User->cek_akun();
			if (!empty($data_user)) {
				$data_user = $data_user[0];
				$rolename = $this->User->get_role_name($data_user['id_role'])[0]["rolename"];

				if ($data_user['id_role'] == '6') {
					$nama_pasien = $this->User->get_nama_pasien_from_email_and_pass($data_user['email'], $data_user['password'])[0]['nama_kk'];
					$id_pasien = $this->User->get_nama_pasien_from_email_and_pass($data_user['email'], $data_user['password'])[0]['id'];
					if(!empty($nama_pasien) || !empty($id_pasien)) {
						$this->session->set_userdata([
							'id_user' => $data_user['id'],
							'id_role' => $data_user['id_role'],
							'email' => $data_user['email'],
							'rolename' => $rolename,
							'login' => "true",
							'nama_kk' => $nama_pasien,
							'id_pasien' => $id_pasien,
						]);
					}
				} else {
					$this->session->set_userdata([
						'id_user' => $data_user['id'],
						'id_role' => $data_user['id_role'],
						'email' => $data_user['email'],
						'rolename' => $rolename,
						'login' => "true",
						'full_name' => $data_user['full_name'],
						'no_hp' => $data_user['no_hp'],
					]);
				}
			}
			echo json_encode($this->session->userdata());
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	
}
