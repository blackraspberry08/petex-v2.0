<?php
class ManageUsers_model extends CI_Model {
    public function get_users($table, $where){
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function get_recent_timestamp($table, $where = NULL, $column = NULL){
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($column)) {
            $this->db->select_max($column);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }   
}
