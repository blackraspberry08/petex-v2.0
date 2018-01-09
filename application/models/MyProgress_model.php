<?php

class MyProgress_model extends CI_Model {

    public function fetchJoinThreeProgress($table, $join = NULL, $on = NULL, $join2 = NULL, $on2 = NULL, $join3 = NULL, $on3 = NULL, $where = NULL) {
        //$on must be array('pet.user_id = user.user_id');
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!(empty($join) || empty($on))) {
            $this->db->join($join, $on, "left outer");
        }
        if (!(empty($join2) || empty($on2))) {
            $this->db->join($join2, $on2, "left outer");
        }
        if (!(empty($join3) || empty($on3))) {
            $this->db->join($join3, $on3, "left outer");
        }

        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetchJoinThreeProgressInfo($table, $join = NULL, $on = NULL, $where = NULL) {
        //$on must be array('pet.user_id = user.user_id');
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!(empty($join) || empty($on))) {
            $this->db->join($join, $on, "left outer");
        }

        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

}
