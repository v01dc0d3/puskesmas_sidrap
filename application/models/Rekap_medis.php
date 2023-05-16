<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_medis extends CI_Model {
    public function insert_data_perawat()
    {
        $id_rekam_medik = $_POST['id_rekam_medik'];
        $id_ruang = $_POST['id_ruang'];
        $tgl = $_POST['tgl'];
        $kajian = $_POST['kajian'];
        
        $sql = "INSERT INTO rekap_medis(id, id_rekam_medik, tgl, id_ruang, kajian) VALUES (NULL, '". $id_rekam_medik ."', '". $tgl ."', '". $id_ruang ."', '". $kajian ."');";
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
        $kajian = $_POST['kajian'];

        $sql = "UPDATE rekap_medis SET id_ruang='". $id_ruang ."', tgl='". $tgl ."', kajian='". $kajian ."' WHERE id='". $id ."';";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function delete_data_rekap_by_id($id) {
        $sql = "DELETE FROM rekap_medis WHERE id='$id';";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
}