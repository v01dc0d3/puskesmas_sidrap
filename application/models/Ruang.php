<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruang extends CI_Model {
    public function get_data_ruang()
    {
        $sql = "SELECT * FROM ruang";
        return $this->db->query($sql)->result_array();
    }
}