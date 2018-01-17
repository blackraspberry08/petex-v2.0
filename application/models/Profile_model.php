<?php

class Profile_model extends CI_Model {

    public function fetch($table, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function update_user_record($user_record, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("user", $user_record);
        return $this->db->affected_rows();
    }

    public function update_admin_record($user_record, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("admin", $user_record);
        return $this->db->affected_rows();
    }

}
