<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Model {
    public function get_data_pasien_id_namakk()
    {
        $sql = "SELECT id, nama_kk FROM pasien";
        return $this->db->query($sql)->result_array();
    }

    public function daftar() {
        $password = md5($_POST['password']);
        $sql = "INSERT INTO user VALUES (NULL, '6', '". $_POST['email'] ."', '". $password ."', '". $_POST['nama_kk'] ."', '". $_POST['no_hp'] ."');";
        $this->db->query($sql);

        $sql = "INSERT INTO pasien VALUES (NULL, '". $_POST['nama_kk'] ."', '". $_POST['nama'] ."', '". $_POST['tanggal_lahir'] ."', '". $_POST['alamat'] ."', '". $_POST['jenis_kelamin'] ."', '". $_POST['pekerjaan'] ."', '". $_POST['agama'] ."', '". $_POST['no_hp'] ."', '". $_POST['umur'] ."', '". $_POST['email'] ."', '". $password ."', '". $_POST['nik'] ."');";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function daftar_pengguna() {
        $password = md5($_POST['password']);
        $sql = "INSERT INTO user VALUES (NULL, '". $_POST['role'] ."', '". $_POST['email'] ."', '". $password ."', '". $_POST['full_name'] ."', '". $_POST['no_hp'] ."');";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function get_all_rekap_medis_by_id_pasien() {
        $sql = "SELECT rms.* FROM rekap_medis AS rms INNER JOIN rekam_medik AS rmk ON rms.id_rekam_medik=rmk.id INNER JOIN pasien AS p ON rmk.id_pasien=p.id WHERE rmk.id_pasien='". $_POST['id_pasien'] ."';";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_rekam_medik_by_id_pasien() {
        $sql = "SELECT rmk.* FROM rekam_medik AS rmk INNER JOIN pasien AS p ON rmk.id_pasien=p.id WHERE rmk.id_pasien='". $_POST['id_pasien'] ."';";
        return $this->db->query($sql)->result_array();
    }

    public function read_email_by_email() {
        $sql = "SELECT email from pasien WHERE email='". $_POST['email'] ."';";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_roles_for_staf() {
        $sql = "SELECT * FROM role WHERE rolename!='admin' AND rolename!='pasien' AND rolename!='staf';";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_roles_for_admin() {
        $sql = "SELECT * FROM role WHERE rolename='staf';";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_role_full_name_for_staf() {
        $sql = "SELECT u.*, r.rolename FROM user AS u INNER JOIN role AS r ON u.id_role=r.id WHERE r.rolename NOT IN ('admin', 'staf', 'pasien');";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_role_full_name_for_admin() {
        $sql = "SELECT u.*, r.rolename FROM user AS u INNER JOIN role AS r ON u.id_role=r.id WHERE r.rolename IN ('staf');";
        return $this->db->query($sql)->result_array();
    }

    public function update_pengguna_for_staf() {
        $sql = "UPDATE user SET id_role='". $_POST['id_role'] ."', email='". $_POST['email'] ."', full_name='". $_POST['full_name'] ."', no_hp='". $_POST['no_hp'] ."' WHERE id='". $_POST['id'] ."';";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function update_staf_for_admin() {
        $sql = "UPDATE user SET id_role='". $_POST['id_role'] ."', email='". $_POST['email'] ."', full_name='". $_POST['full_name'] ."', no_hp='". $_POST['no_hp'] ."' WHERE id='". $_POST['id'] ."';";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function delete_pengguna_for_staf($id) {
        $sql = "DELETE FROM user WHERE id='". $id ."';";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }
}