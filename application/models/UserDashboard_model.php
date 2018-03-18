<?php

class UserDashboard_model extends CI_Model {

    public function fetchPetDesc($table, $where = NULL) {

        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->limit(4);
        $this->db->order_by('pet_added_at', 'desc');
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

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

    public function get_adopted($where = NULL) {
        $table = "adoption";
        $join = "pet";
        $on = "adoption.pet_id = pet.pet_id";
        $join2 = "user";
        $on2 = "adoption.user_id = user.user_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->limit(4);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetchJoinThreeProgressDesc($where = NULL) {
        //$on must be array('pet.user_id = user.user_id');
        $table = "transaction";
        $join = "pet";
        $on = "transaction.pet_id = pet.pet_id";
        $join2 = "user";
        $on2 = "transaction.user_id = user.user_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->count_all_results($table);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from($table);
        return $this->db->count_all_results();
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

    public function update_adoption($adoption, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("adoption", $adoption);
        return $this->db->affected_rows();
    }

}
