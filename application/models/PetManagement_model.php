<?php

class PetManagement_model extends CI_Model {
    public function get_all_animals(){
        $table = "pet";
        $where = array("pet_access" => 1);
        $this->db->where($where);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function get_animal_info($where = NULL){
        $table = "pet";
        if(!empty($where)){
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function get_animal_medical_records($where = NULL){
        $table = "medical_record";
        $join = "pet";
        $on = "medical_record.pet_id = pet.pet_id";
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->join($join, $on, "left outer");
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function get_medical_record($where = NULL){
        $table = "medical_record";
        if(!empty($where)){
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function add_medical_record($medical_record){
        $table = "medical_record";
        $this->db->insert($table, $medical_record);
        return $this->db->affected_rows();
    }
    public function remove_medical_record($where = NULL){
        $table = "medical_record";
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
    public function edit_medical_record($medical_record, $where = NULL){
        if(!empty($where)){
             $this->db->where($where);
        }
        $this->db->update("medical_record", $medical_record);
        return $this->db->affected_rows();
    }
}


