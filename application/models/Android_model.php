<?php

class Android_model extends CI_Model {
    public function fetch($table, $where = NULL, $column = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($column)) {
            $this->db->select($column);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function fetchTwo($table, $column = NULL, $join = NULL, $on = NULL, $join2 = NULL, $on2 = NULL, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($column)) {
            $this->db->select($column);
        }
        if (!(empty($join) || empty($on))) {
            $this->db->join($join, $on, "INNER");
        }
        if (!(empty($join2) || empty($on2))) {
            $this->db->join($join2, $on2, "INNER");
        }

        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
	
	public function report_missing($data, $adoption_id){
		$this->db->where(array("adoption_id" => $adoption_id));
        $this->db->update("adoption", $data);
        return $this->db->affected_rows();
    }
}

