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
        $sql = "INSERT INTO user VALUES (NULL, '6', '". $_POST['email'] ."', '". $password ."');";
        $this->db->query($sql);

        $sql = "INSERT INTO pasien VALUES (NULL, '". $_POST['nama_kk'] ."', '". $_POST['nama'] ."', '". $_POST['tanggal_lahir'] ."', '". $_POST['alamat'] ."', '". $_POST['jenis_kelamin'] ."', '". $_POST['pekerjaan'] ."', '". $_POST['agama'] ."', '". $_POST['no_hp'] ."', '". $_POST['umur'] ."', '". $_POST['email'] ."', '". $password ."');";
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
}