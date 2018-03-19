<?php

class PetManagement_model extends CI_Model {

    public function get_all_animals() {
        $table = "pet";
        $where = array("pet_access" => 1);
        $this->db->where($where);
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

    public function get_medical_record($where = NULL) {
        $table = "medical_record";
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function add_medical_record($medical_record) {
        $table = "medical_record";
        $this->db->insert($table, $medical_record);
        return $this->db->affected_rows();
    }

    public function remove_medical_record($where = NULL) {
        $table = "medical_record";
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function edit_medical_record($medical_record, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("medical_record", $medical_record);
        return $this->db->affected_rows();
    }

    public function remove_animal($where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $data = array("pet_access" => 0);
        $this->db->update("pet", $data);
        return $this->db->affected_rows();
    }

    public function restore_animal($where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $data = array("pet_access" => 1);
        $this->db->update("pet", $data);
        return $this->db->affected_rows();
    }

    public function update_animal_record($animal_record, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("pet", $animal_record);
        return $this->db->affected_rows();
    }

    public function register_animal_record($animal_record) {
        $table = "pet";
        $this->db->insert($table, $animal_record);
        return $this->db->affected_rows();
    }

    public function get_removed_animals() {
        $table = "pet";
        $where = array("pet_access" => 0);
        $this->db->where($where);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function get_transactions($where = NULL) {
        $table = "transaction";
        $join = "pet";
        $on = "transaction.pet_id = pet.pet_id";
        $join2 = "user";
        $on2 = "transaction.user_id = user.user_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
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

    public function get_inactive_transactions($where = NULL) {
        $table = "transaction";
        $join = "pet";
        $on = "transaction.pet_id = pet.pet_id";
        $join2 = "user";
        $on2 = "transaction.user_id = user.user_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->where(array("transaction.transaction_isActivated" => 0));
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function get_not_active_transactions($where = NULL) {
        $table = "transaction";
        $join = "pet";
        $on = "transaction.pet_id = pet.pet_id";
        $join2 = "user";
        $on2 = "transaction.user_id = user.user_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->where(array("transaction.transaction_isActivated" => 0));
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function get_finished_transaction($where) {
        $table = "transaction";
        $join = "pet";
        $on = "transaction.pet_id = pet.pet_id";
        $join2 = "user";
        $on2 = "transaction.user_id = user.user_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->where(array("transaction.transaction_isFinished" => 1));
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function get_transaction($where) {
        $table = "transaction";
        $join = "pet";
        $on = "transaction.pet_id = pet.pet_id";
        $join2 = "user";
        $on2 = "transaction.user_id = user.user_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function restore_transaction($where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("transaction", array("transaction_isActivated" => 1));
        return $this->db->affected_rows();
    }

    public function drop_transaction($where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("transaction", array("transaction_isActivated" => 0));
        return $this->db->affected_rows();
    }
    
    public function search_animal($like = NULL){
        $table = "pet";
        if (!empty($like)) {
            $this->db->like('pet_name', $like);
        }
        $where = array("pet_access" => 1);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

}
