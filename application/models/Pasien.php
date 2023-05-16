<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Model {
    public function get_data_pasien_id_namakk()
    {
        $sql = "SELECT id, nama_kk FROM pasien";
        return $this->db->query($sql)->result_array();
    }
}