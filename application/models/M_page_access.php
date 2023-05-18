<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_page_access extends CI_Model {
    public function get_all_page_access()
    {
        $sql = "SELECT pa.*, r.rolename, p.pagename FROM page_access AS pa INNER JOIN role AS r ON pa.id_role=r.id INNER JOIN page AS p ON pa.id_page=p.id ORDER BY pa.id DESC;";
        return $this->db->query($sql)->result_array();
    }

    public function get_data_halaman() { return $this->db->query("SELECT * FROM page;")->result_array(); }
    
    public function get_data_role() { return $this->db->query("SELECT * FROM role;")->result_array(); }

    public function insert_akses_halaman() {
        $sql = "INSERT INTO page_access VALUES (NULL, '". $_POST['id_role'] ."', '". $_POST['id_page'] ."');";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function delete_akses() {
        $sql = "DELETE FROM page_access WHERE id='". $_POST['id'] ."';";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }
}