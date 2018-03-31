<?php

class AdminDashboard_model extends CI_Model {

    public function fetch($table, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetch_all_adopted($table, $join = NULL, $on = NULL, $join2 = NULL, $on2 = NULL, $where = NULL) {
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
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetch_all_adopters() {
        $table = "adoption";
        $join = "user";
        $on = "adoption.user_id = user.user_id";
        $join2 = "pet";
        $on2 = "adoption.pet_id = pet.pet_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->group_by('adoption.user_id');
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetch_all_missing() {
        $table = "adoption";
        $join = "user";
        $on = "adoption.user_id = user.user_id";
        $join2 = "pet";
        $on2 = "adoption.pet_id = pet.pet_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->where(array("adoption_isMissing" => 1));
        $this->db->group_by('adoption.pet_id');
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetch_all_transactions($where = NULL) {
        $table = "transaction";
        $join = "user";
        $on = "transaction.user_id = user.user_id";
        $join2 = "pet";
        $on2 = "transaction.pet_id = pet.pet_id";
        $this->db->where(array("transaction_isFinished" => 0));
        $this->db->where(array("transaction_isActivated" => 1));
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetch_all_found() {
        $table = "discovery";
        $join = "user";
        $on = "discovery.user_id = user.user_id";
        $join2 = "pet";
        $on2 = "discovery.pet_id = pet.pet_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->group_by('discovery.pet_id');
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function count_missing_animal() {
        $table = "adoption";
       
        $this->db->count_all_results($table);
        $this->db->group_by('pet_id');
         $this->db->where(array("adoption_isMissing" => 1));
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function count_found_animal() {
        $table = "discovery";
        $this->db->count_all_results($table);
        $this->db->group_by('pet_id');
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function count_adoptable_animal() {
        $table = "pet";
        $this->db->count_all_results($table);
        $this->db->where(array("pet_status" => "Adoptable"));
        $this->db->where(array("pet_access" => 1));
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function count_non_adoptable_animal() {
        $table = "pet";
        $this->db->count_all_results($table);
        $this->db->where(array("pet_status" => "NonAdoptable"));
        $this->db->where(array("pet_access" => 1));
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function count_deceased_animal() {
        $table = "pet";
        $this->db->count_all_results($table);
        $this->db->where(array("pet_status" => "Deceased"));
        $this->db->where(array("pet_access" => 1));
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function count_adopted_animal() {
        $table = "pet";
        $this->db->count_all_results($table);
        $this->db->where(array("pet_status" => "Adopted"));
        $this->db->where(array("pet_access" => 1));
        $this->db->from($table);
        $this->db->group_by('pet_id');
        $this->db->distinct();
        return $this->db->count_all_results();
    }

    public function count_removed_animal() {
        $table = "pet";
        $this->db->count_all_results($table);
        $this->db->where(array("pet_access" => 0));
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function count_pet_adopter() {
        $table = "adoption";
        $this->db->count_all_results($table);
        $this->db->from($table);
        $this->db->group_by('user_id');
        $this->db->distinct();
        return $this->db->count_all_results();
    }

    public function count_transaction() {
        $table = "transaction";
        $this->db->count_all_results($table);
        $this->db->from($table);
        $this->db->where(array("transaction_isActivated" => 1));
        $this->db->where(array("transaction_isFinished" => 0));
        return $this->db->count_all_results();
    }

    public function count_user() {
        $table = "user";
        $this->db->count_all_results($table);
        $this->db->from($table);
        $this->db->where(array("user_status" => 1));
        return $this->db->count_all_results();
    }

    public function count_dogs() {
        $table = "pet";
        $this->db->count_all_results($table);
        $this->db->where(array("pet_specie" => "Canine"));
        $this->db->where(array("pet_access" => 1));
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function count_cats() {
        $table = "pet";
        $this->db->count_all_results($table);
        $this->db->where(array("pet_specie" => "Feline"));
        $this->db->where(array("pet_access" => 1));
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function count_all_animals() {
        $table = "pet";
       
        $this->db->count_all_results($table);
        $this->db->where_not_in(array("pet_status" => "Adopted"));
        $this->db->from($table);
        return $this->db->count_all_results();
    }

}
