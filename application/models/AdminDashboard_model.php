<?php
class AdminDashboard_model extends CI_Model {
    public function count_adoptable_animal(){
        $table = "pet";
        $this->db->count_all_results($table);
        $this->db->where(array("pet_status" => "Adoptable"));
        $this->db->where(array("pet_access" => 1));
        $this->db->from($table);
        return $this->db->count_all_results();
    }
    public function count_non_adoptable_animal(){
        $table = "pet";
        $this->db->count_all_results($table);
        $this->db->where(array("pet_status" => "NonAdoptable"));
        $this->db->where(array("pet_access" => 1));
        $this->db->from($table);
        return $this->db->count_all_results();
    }
    public function count_deceased_animal(){
        $table = "pet";
        $this->db->count_all_results($table);
        $this->db->where(array("pet_status" => "Deceased"));
        $this->db->where(array("pet_access" => 1));
        $this->db->from($table);
        return $this->db->count_all_results();
    }
    public function count_removed_animal(){
        $table = "pet";
        $this->db->count_all_results($table);
        $this->db->where(array("pet_access" => 0));
        $this->db->from($table);
        return $this->db->count_all_results();
    }
    public function count_adopted_animal(){
        $table = "adoption";
        $this->db->count_all_results($table);
        $this->db->from($table);
        $this->db->group_by('pet_id');
        $this->db->distinct();
        return $this->db->count_all_results();
    }
    public function count_pet_adopter(){
        $table = "adoption";
        $this->db->count_all_results($table);
        $this->db->from($table);
        $this->db->group_by('user_id');
        $this->db->distinct();
        return $this->db->count_all_results();
    }
    public function count_transaction(){
        $table = "transaction";
        $this->db->count_all_results($table);
        $this->db->from($table);
        $this->db->where(array("transaction_isActivated" => 1));
        $this->db->where(array("transaction_isFinished" => 0));
        return $this->db->count_all_results();
    }
    public function count_user(){
        $table = "user";
        $this->db->count_all_results($table);
        $this->db->from($table);
        $this->db->where(array("user_status" => 1));
        return $this->db->count_all_results();
    }
    
}
