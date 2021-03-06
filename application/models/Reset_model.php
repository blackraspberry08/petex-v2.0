<?php

class Reset_model extends CI_Model {

    public function fetch($table, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function emailAvailability($email) {
        $this->db->where('user_email', $email);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            Return true;
        } else {
            Return false;
        }
    }

    public function usernameAvailability($username) {
        $this->db->where('user_username', $username);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            Return true;
        } else {
            Return false;
        }
    }

    public function emailAvailabilityAdmin($email) {
        $this->db->where('admin_email', $email);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0) {
            Return true;
        } else {
            Return false;
        }
    }

    public function usernameAvailabilityAdmin($username) {
        $this->db->where('admin_username', $username);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0) {
            Return true;
        } else {
            Return false;
        }
    }

    public function update($table, $data, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

}
