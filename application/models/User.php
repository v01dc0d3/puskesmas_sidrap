<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
    public function cek_akun()
    {
        $sql = "SELECT * FROM user WHERE email='". $_POST['email'] ."' AND password='". md5($_POST['password']) ."';";
        return $this->db->query($sql)->result_array();
    }

    public function get_role_name($id_role) {
        $sql = "SELECT rolename FROM role WHERE id='". $id_role ."';";
        return $this->db->query($sql)->result_array();
    }

    public function cek_akses_halaman($id_role, $pagename) {
        $sql = "SELECT p.pagename FROM page_access AS pa INNER JOIN page AS p ON pa.id_page = p.id WHERE pa.id_role='". $id_role ."' AND p.pagename='". $pagename ."'";
        return $this->db->query($sql)->num_rows();
    }

    public function get_nama_pasien_from_email_and_pass($email, $password) {
        $sql = "SELECT id, nama_kk FROM pasien WHERE email='". $email ."' AND password='". $password ."'";
        return $this->db->query($sql)->result_array();
    }

    public function update_profil_pegawai() {
        $sql = "UPDATE user SET full_name='". $_POST['full_name'] ."', no_hp='". $_POST['no_hp'] ."' WHERE id='". $_POST['id_user'] ."';";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function update_profil_pasien() {
        $sql = "UPDATE user SET email='". $_POST['email'] ."', full_name='". $_POST['nama_kk'] ."', no_hp='". $_POST['no_hp'] ."' WHERE id='". $_POST['id_user'] ."' AND id_role='6';";
        $this->db->query($sql);

        $sql = "UPDATE pasien SET nama_kk='". $_POST['nama_kk'] ."', nama='". $_POST['nama'] ."', tanggal_lahir='". $_POST['tanggal_lahir'] ."', alamat='". $_POST['alamat'] ."', jenis_kelamin='". $_POST['jenis_kelamin'] ."', pekerjaan='". $_POST['pekerjaan'] ."', agama='". $_POST['agama'] ."', no_hp='". $_POST['no_hp'] ."', umur='". $_POST['umur'] ."', email='". $_POST['email'] ."' WHERE id='". $_POST['id_pasien'] ."';";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function get_data_pasien() {
        $sql = "SELECT * FROM pasien WHERE id='". $this->session->userdata('id_pasien') ."';";
        return $this->db->query($sql)->result_array();
    }
}