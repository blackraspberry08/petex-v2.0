<?php

class MyPets_model extends CI_Model {

    public function fetchJoinThreeAdoptedDesc($table, $join = NULL, $on = NULL, $join2 = NULL, $on2 = NULL, $where = NULL) {
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
        $this->db->order_by('adoption_adopted_at', 'desc');
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function get_animal_info($where = NULL) {
        $table = "pet";
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function update_animal_record($animal_record, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("pet", $animal_record);
        return $this->db->affected_rows();
    }

}
