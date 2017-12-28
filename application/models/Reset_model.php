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

}
