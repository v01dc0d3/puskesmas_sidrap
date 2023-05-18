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
}