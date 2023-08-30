<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Model {
    public function get_data_pasien_id_namakk()
    {
        $sql = "SELECT id, nama_kk FROM pasien";
        return $this->db->query($sql)->result_array();
    }

    public function daftar() {
        $password = md5($_POST['password']);
        $sql = "INSERT INTO user VALUES (NULL, '6', '". $_POST['email'] ."', '". $password ."', '". $_POST['nama_kk'] ."', '". $_POST['no_hp'] ."');";
        $this->db->query($sql);

        $sql = "INSERT INTO pasien VALUES (NULL, '". $_POST['nik'] ."', '". $_POST['nama_kk'] ."', '". $_POST['nama'] ."', '". $_POST['tanggal_lahir'] ."', '". $_POST['alamat'] ."', '". $_POST['jenis_kelamin'] ."', '". $_POST['pekerjaan'] ."', '". $_POST['agama'] ."', '". $_POST['no_hp'] ."', '". $_POST['umur'] ."', '". $_POST['email'] ."', '". $password ."');";
        $this->db->query($sql);

        $sql = "INSERT INTO rekam_medik(id_pasien, no_kartu) VALUES (LAST_INSERT_ID(), '". $_POST['no_kartu'] ."');";
        $this->db->query($sql);

        $sql = "INSERT INTO rekap_medis(id, id_rekam_medik, tgl) VALUES (NULL, LAST_INSERT_ID(), date_format(curdate(), '%d/%m/%Y'));";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function daftar_pengguna() {
        $password = md5($_POST['password']);
        $sql = "INSERT INTO user VALUES (NULL, '". $_POST['role'] ."', '". $_POST['email'] ."', '". $password ."', '". $_POST['full_name'] ."', '". $_POST['no_hp'] ."');";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function get_all_rekap_medis_by_id_pasien() {
        $sql = "SELECT rms.* FROM rekap_medis AS rms INNER JOIN rekam_medik AS rmk ON rms.id_rekam_medik=rmk.id INNER JOIN pasien AS p ON rmk.id_pasien=p.id WHERE rmk.id_pasien='". $_POST['id_pasien'] ."';";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_rekam_medik_by_id_pasien() {
        $sql = "SELECT rmk.* FROM rekam_medik AS rmk INNER JOIN pasien AS p ON rmk.id_pasien=p.id WHERE rmk.id_pasien='". $_POST['id_pasien'] ."';";
        return $this->db->query($sql)->result_array();
    }

    public function read_email_by_email() {
        $sql = "SELECT email from pasien WHERE email='". $_POST['email'] ."';";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_roles_for_staf() {
        $sql = "SELECT * FROM role WHERE rolename!='admin' AND rolename!='pasien';";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_roles_for_admin() {
        $sql = "SELECT * FROM role WHERE rolename='staf';";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_role_full_name_for_staf() {
        $sql = "SELECT u.*, r.rolename FROM user AS u INNER JOIN role AS r ON u.id_role=r.id WHERE r.rolename NOT IN ('admin', 'pasien');";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_role_full_name_for_admin() {
        $sql = "SELECT u.*, r.rolename FROM user AS u INNER JOIN role AS r ON u.id_role=r.id WHERE r.rolename IN ('staf');";
        return $this->db->query($sql)->result_array();
    }

    public function update_pengguna_for_staf() {
        $sql = "UPDATE user SET id_role='". $_POST['id_role'] ."', email='". $_POST['email'] ."', full_name='". $_POST['full_name'] ."', no_hp='". $_POST['no_hp'] ."' WHERE id='". $_POST['id'] ."';";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function update_staf_for_admin() {
        $sql = "UPDATE user SET id_role='". $_POST['id_role'] ."', email='". $_POST['email'] ."', full_name='". $_POST['full_name'] ."', no_hp='". $_POST['no_hp'] ."' WHERE id='". $_POST['id'] ."';";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function delete_pengguna_for_staf($id) {
        $sql = "DELETE FROM user WHERE id='". $id ."';";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function model_delete_pasien() {
        $sql = "DELETE FROM user WHERE id='". $_POST['id_user'] ."';";
        $this->db->query($sql);

        $sql = "DELETE FROM pasien WHERE id='". $_POST['id_pasien'] ."';";
        $this->db->query($sql);

        $sql = "DELETE FROM rekam_medik WHERE id='". $_POST['id_rekam_medik'] ."';";
        $this->db->query($sql);

        $sql = "DELETE FROM rekap_medis WHERE id_rekam_medik='". $_POST['id_rekam_medik'] ."';";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function get_data_by_id_pasien($id_pasien) {
        $sql = "SELECT p.*, rmk.no_kartu FROM pasien AS p INNER JOIN rekam_medik AS rmk ON p.id=rmk.id_pasien WHERE p.id='". $id_pasien ."';";
        return $this->db->query($sql)->result_array(); 
    }

    public function model_edit_data_pasien($data_pasien) {
        $success_query = 0;
        $sql = "UPDATE pasien SET nik='". $data_pasien["nik"] ."', nama_kk='". $data_pasien["nama_kk"] ."', nama='". $data_pasien["nama"] ."', tanggal_lahir='". $data_pasien["tanggal_lahir"] ."', alamat='". $data_pasien["alamat"] ."', jenis_kelamin='". $data_pasien["jenis_kelamin"] ."', pekerjaan='". $data_pasien["pekerjaan"] ."', agama='". $data_pasien["agama"] ."', no_hp='". $data_pasien["no_hp"] ."', umur='". $data_pasien["umur"] ."', email='". $data_pasien["email"] ."' WHERE id='". $data_pasien['id_pasien'] ."';";
        $this->db->query($sql);
        if ($this->db->affected_rows() != 0) {
            $success_query += 1;
        }

        $sql = "UPDATE user SET email='". $data_pasien["email"] ."', full_name='". $data_pasien["nama_kk"] ."', no_hp='". $data_pasien["no_hp"] ."' WHERE id='". $data_pasien['id_user'] ."';";
        $this->db->query($sql);
        if ($this->db->affected_rows() != 0) {
            $success_query += 1;
        }

        $sql = "UPDATE rekam_medik SET no_kartu='". $data_pasien["no_kartu"] ."' WHERE id_pasien='". $data_pasien['id_pasien'] ."';";
        $this->db->query($sql);
        if ($this->db->affected_rows() != 0) {
            $success_query += 1;
        }

        return $success_query;
    }
}