<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam_medik extends CI_Model {
    public function get_id_rekam_medik_by_pasien()
    {
        $sql = " SELECT id FROM rekam_medik WHERE id_pasien=". $_POST['id_pasien'] ." ORDER BY id DESC LIMIT 1;";
        return $this->db->query($sql)->result_array();
    }

    public function get_identitas_by_id($id) {
        $sql = "SELECT rmk.no, rmk.no_kartu, p.nama_kk, p.nama, p.tanggal_lahir, p.alamat, p.jenis_kelamin, p.pekerjaan, p.agama, p.no_hp, p.umur FROM rekam_medik AS rmk INNER JOIN pasien AS p ON rmk.id_pasien = p.id WHERE rmk.id='". $id ."';";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_last_rekam_medik_pasien() {
        $sql = "SELECT rmk.id AS id_rekam_medik, p.nama_kk, p.nik, rmk.id_pasien, rmk.no_kartu, MAX(rmk.no) AS 'no' FROM rekam_medik AS rmk INNER JOIN pasien AS p ON rmk.id_pasien = p.id GROUP BY rmk.id_pasien;";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_rekam_medik_pasien_by_id_pasien() {
        $sql = "SELECT p.*, rmk.id_pasien, rmk.id AS id_rmk, rmk.no_kartu, rmk.no, rmk.tgl, rmk.anamnesa, rmk.saran FROM rekam_medik AS rmk INNER JOIN pasien AS p ON rmk.id_pasien = p.id WHERE rmk.id_pasien='". $_POST['id_pasien'] ."' AND rmk.no_kartu='". $_POST['no_kartu'] ."' AND p.nama_kk='". $_POST['nama_kk'] ."';";
        return $this->db->query($sql)->result_array();
    }

    public function insert_data_rekam() {
        $id_pasien = $_POST['id_pasien'];
        $no_kartu = $_POST['no_kartu'];
        $no = $_POST['no'];
        $tgl = $_POST['tgl'];
        $anamnesa = $_POST['anamnesa'];
        $saran = $_POST['saran'];
        
        $sql = "INSERT INTO rekam_medik VALUES (NULL, '". $id_pasien ."', '". $no_kartu ."', '". $no ."', '". $tgl ."', '". $anamnesa ."', '". $saran ."');";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function delete_data_rekam_by_id() {
        $this->db->query("DELETE FROM rekam_medik WHERE id='". $_POST['id_rmk'] ."';");
        return $this->db->affected_rows();
    }

    public function edit_data_rekam() {
        $sql = "UPDATE rekam_medik SET anamnesa='". $_POST['anamnesa'] ."', saran='". $_POST['saran'] ."' WHERE id='". $_POST['id_rmk'] ."' AND id_pasien='". $_POST['id_pasien'] ."' AND no_kartu='". $_POST['no_kartu'] ."' AND no='". $_POST['no'] ."' AND tgl='". $_POST['tgl'] ."';";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
}