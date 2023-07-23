<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pasien extends CI_Model {
    public function get_all_rekap_medis_by_id_pasien() {
        $sql = "SELECT rms.*, rmk.id_pasien, p.nama_kk, p.nik, r.nama AS nama_ruang, rmk.no_kartu FROM rekap_medis AS rms INNER JOIN rekam_medik AS rmk ON rms.id_rekam_medik=rmk.id INNER JOIN pasien AS p ON rmk.id_pasien=p.id INNER JOIN ruang AS r ON rms.id_ruang=r.id WHERE rmk.id_pasien='". $_POST['id_pasien'] ."';";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_rekam_medik_by_id_pasien() {
        $sql = "SELECT rmk.*, p.nama_kk FROM rekam_medik AS rmk INNER JOIN pasien AS p ON rmk.id_pasien=p.id WHERE rmk.id_pasien='". $_POST['id_pasien'] ."';";
        return $this->db->query($sql)->result_array();
    }
}