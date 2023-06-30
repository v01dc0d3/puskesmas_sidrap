<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_antrian extends CI_Model {
    public function cek_tgl_antrian() {
        $sql = "SELECT tgl FROM antrian ORDER BY id DESC LIMIT 1;";
        return $this->db->query($sql)->result_array();
    }

    public function create_antrian() {
        $sql = "INSERT INTO antrian VALUES (NULL, '". $this->session->userdata('id_user') ."', '". $_POST['tgl'] ."');";
        $this->db->query($sql);

        return $this->db->query("SELECT LAST_INSERT_ID() AS 'no_antrian';")->result_array();
    }

    public function read_antrian_from_id_user($id) {
        $sql = "SELECT id FROM antrian WHERE id_user='". $id ."';";
        return $this->db->query($sql)->result_array();
    }

    public function delete_all_antrian() {
        $this->db->query("TRUNCATE antrian;");
    }
}