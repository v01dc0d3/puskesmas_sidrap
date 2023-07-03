<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_medis extends CI_Model {
    public function insert_data_perawat()
    {
        $id_rekam_medik = $_POST['id_rekam_medik'];
        $id_ruang = $_POST['id_ruang'];
        $tgl = $_POST['tgl'];
        $kajian_subjektif = $_POST['kajian_subjektif'];
        $kajian_objektif = $_POST['kajian_objektif'];
        $asuhan = $_POST['asuhan'];
        $paraf_paramedis = $_POST['paraf_paramedis'];
        
        $sql = "INSERT INTO rekap_medis(id, id_rekam_medik, tgl, id_ruang, kajian_subjektif, kajian_objektif, asuhan, paraf_paramedis) VALUES (NULL, '". $id_rekam_medik ."', '". $tgl ."', '". $id_ruang ."', '". $kajian_subjektif ."', '". $kajian_objektif ."', '". $asuhan ."', '". $paraf_paramedis ."');";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function get_all_rekap_medis() {
        $sql = "SELECT rms.*, p.nama_kk FROM rekap_medis AS rms INNER JOIN rekam_medik AS rmk ON rms.id_rekam_medik = rmk.id INNER JOIN pasien AS p ON rmk.id_pasien = p.id;";
        return $this->db->query($sql)->result_array();
    }

    public function get_data_rekam_medik_by_id($id)
    {
        $sql = "SELECT rmk.id_pasien FROM rekap_medis AS rms INNER JOIN rekam_medik AS rmk ON rms.id_rekam_medik = rmk.id WHERE rms.id='". $id ."';";
        return $this->db->query($sql)->result_array();
    }

    public function edit_data_rekap($id)
    {
        $id_ruang = $_POST['id_ruang'];
        $tgl = $_POST['tgl'];
        $kajian_subjektif = $_POST['kajian_subjektif'];
        $kajian_objektif = $_POST['kajian_objektif'];
        $asuhan = $_POST['asuhan'];
        $paraf_paramedis = $_POST['paraf_paramedis'];

        $sql = "UPDATE rekap_medis SET id_ruang='". $id_ruang ."', tgl='". $tgl ."', kajian_subjektif='". $kajian_subjektif ."', kajian_objektif='". $kajian_objektif ."', asuhan='". $asuhan ."', paraf_paramedis='". $paraf_paramedis ."' WHERE id='". $id ."';";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function delete_data_rekap_by_id($id) {
        $sql = "DELETE FROM rekap_medis WHERE id='$id';";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function get_all_rekap_medis_group() {
        $sql = "SELECT rms.id_rekam_medik, rms.tgl, p.nama_kk, p.nik, rmk.no_kartu, rmk.id_pasien FROM rekap_medis AS rms INNER JOIN rekam_medik AS rmk ON rms.id_rekam_medik = rmk.id INNER JOIN pasien AS p ON rmk.id_pasien = p.id GROUP BY rmk.id_pasien;";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_rekap_medis_by_id_rekam_medik() {
        $sql = "SELECT rms.*, p.nama_kk, p.umur, p.nik, rmk.no_kartu, rmk.id_pasien, r.nama AS 'nama_ruang', r.id AS 'id_ruang' FROM rekap_medis AS rms INNER JOIN rekam_medik AS rmk ON rms.id_rekam_medik = rmk.id INNER JOIN pasien AS p ON rmk.id_pasien = p.id INNER JOIN ruang AS r ON rms.id_ruang = r.id WHERE rmk.id_pasien='". $_POST['id_pasien'] ."' AND rmk.no_kartu='". $_POST['no_kartu'] ."' AND p.nama_kk='". $_POST['nama_kk'] ."' ORDER BY rms.id DESC;";
        return $this->db->query($sql)->result_array();
    }

    public function edit_data_rekap_pasien() {
        $sql = "UPDATE rekap_medis SET anam_pem_fisik='". $_POST['anam_pem_fisik'] ."', diagnosis='". $_POST['diagnosis'] ."', terapi='". $_POST['terapi'] ."', icd='". $_POST['icd'] ."', id_petugas='0', paraf_medis='". $_POST['paraf_medis'] ."' WHERE id='". $_POST['id'] ."' AND id_rekam_medik='". $_POST['id_rekam_medik'] ."' AND tgl='". $_POST['tgl'] ."' AND id_ruang='". $_POST['id_ruang'] ."';";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function get_resep_by_id_rms() {
        $sql = "SELECT ro.* FROM resep_obat AS ro INNER JOIN rekap_medis AS rms ON ro.id_rekap_medis = rms.id WHERE ro.id_rekap_medis='". $_POST['id_rms'] ."';";
        return $this->db->query($sql)->result_array();
    }
}