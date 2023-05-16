<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam_medik extends CI_Model {
    public function get_id_rekam_medik_by_pasien()
    {
        $sql = " SELECT id FROM rekam_medik WHERE id_pasien=". $_POST['id_pasien'] ." ORDER BY id DESC LIMIT 1;";
        return $this->db->query($sql)->result_array();
    }
}