<?php
class UserLogs_model extends CI_Model {
    public function get_userlogs($table, $join = NULL, $on = NULL, $join2 = NULL, $on2 = NULL, $where = NULL){
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!(empty($join) || empty($on))) {
            $this->db->join($join, $on, "left outer");
        }
        if (!(empty($join2) || empty($on2))) {
            $this->db->join($join2, $on2, "left outer");
        }
        $this->db->order_by('event_added_at', 'DESC');
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
