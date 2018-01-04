<?php

class PetManagement_model extends CI_Model {
    public function get_all_animals(){
        $table = "pet";
        $where = array("pet_access" => 1);
        $this->db->where($where);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
}


