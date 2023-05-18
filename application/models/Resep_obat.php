<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resep_obat extends CI_Model {
    public function tambah_resep_obat()
    {
        $sql = "INSERT INTO resep_obat VALUES (NULL, '". $_POST['id_rms'] ."', '". $_POST['resep'] ."', 'request', '". $_POST['tgl'] ."');";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function edit_resep_obat()
    {
        $sql = "UPDATE resep_obat SET resep='". $_POST['resep'] ."', tgl='". $_POST['tgl'] ."', status='request' WHERE id='". $_POST['id_ro'] ."' AND id_rekap_medis='". $_POST['id_rms'] ."';";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function get_all_resep_obat()
    {
        $sql = "SELECT ro.*, p.nama_kk FROM resep_obat AS ro INNER JOIN rekap_medis AS rms ON ro.id_rekap_medis = rms.id INNER JOIN rekam_medik AS rmk ON rms.id_rekam_medik = rmk.id INNER JOIN pasien AS p ON rmk.id_pasien = p.id";
        return $this->db->query($sql)->result_array();
    }

    public function edit_resep_obat_apoteker() {
        $sql = "UPDATE resep_obat SET status='". $_POST['status'] ."' WHERE id='". $_POST['id'] ."';";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
}