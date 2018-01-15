<?php
class ManageProgress_model extends CI_Model {
    public function get_progress($where = NULL){
        $table = "progress";
        $join = "checklist";
        $on = "progress.checklist_id = checklist.checklist_id";
        $join2 = "transaction";
        $on2 = "progress.transaction_id = transaction.transaction_id";
        $join3 = "user";
        $on3 = "progress.user_id = user.user_id";
        $join4 = "pet";
        $on4 = "transaction.pet_id = pet.pet_id";
        $this->db->where(array("transaction_isFinished" => 0));
        $this->db->where(array("transaction_isActivated" => 1));
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->join($join3, $on3, "left outer");
        $this->db->join($join4, $on4, "left outer");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function get_adoption_form($where = NULL){
        $table = "adoption_form";
        $join = "transaction";
        $on = "adoption_form.transaction_id = transaction.transaction_id";
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join($join, $on, "left outer");
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    
    public function add_adoption_form($data){
        $table = "adoption_form";
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }
}
