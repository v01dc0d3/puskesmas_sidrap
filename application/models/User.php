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
}