<?php

class PetAdoption_model extends CI_Model {

    public function fetch($table, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function get_active_transactions($where = NULL) {
        $table = "transaction";
        $join = "pet";
        $on = "transaction.pet_id = pet.pet_id";
        $join2 = "user";
        $on2 = "transaction.user_id = user.user_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->where(array("transaction.transaction_isActivated" => 1));
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function get_animal_medical_records($where = NULL) {
        $table = "medical_record";
        $join = "pet";
        $on = "medical_record.pet_id = pet.pet_id";
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join($join, $on, "left outer");
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetchPetDesc($table, $where = NULL) {

        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->order_by('pet_added_at', 'desc');
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetchJoinThreeProgressDesc($table, $join = NULL, $on = NULL, $join2 = NULL, $on2 = NULL, $where = NULL) {
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
        $this->db->order_by('transaction_started_at', 'asc');
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetchJoinProgress($where = NULL) {
        $table = "progress";
        $join = "checklist";
        $on = "progress.checklist_id = checklist.checklist_id";
        $join2 = "transaction";
        $on2 = "progress.transaction_id = transaction.transaction_id";
        $join3 = "pet";
        $on3 = "transaction.pet_id = pet.pet_id";
        $this->db->where(array("transaction_isFinished" => 0));
        $this->db->where(array("transaction_isActivated" => 1));
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->join($join3, $on3, "left outer");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    function getinfo($table, $where = NULL) {
        if ($where !== NULL) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function insert($table, $data) {
        $this->db->insert_batch($table, $data);
        return $this->db->affected_rows();
    }

    public function singleinsert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function update_adoption_form($adoption_form_record, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("adoption_form", $adoption_form_record);
        return $this->db->affected_rows();
    }
    
    public function search_animal_adoptable($like = NULL, $filter = NULL){
        $table = "pet";
        if (!empty($like)) {
            $this->db->like('pet_name', $like);
        }
        if (!empty($filter)) {
            $this->db->where(array("pet_sex" => $filter));
        }
        $this->db->where(array("pet_status" => "Adoptable"));
        $this->db->where(array("pet_access" => 1));
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

}
