<?php
class ManageProgress_model extends CI_Model {
    public function get_progress($where = NULL){
        $table = "progress";
        $join = "checklist";
        $on = "progress.checklist_id = checklist.checklist_id";
        $join2 = "transaction";
        $on2 = "progress.transaction_id = transaction.transaction_id";
        $join3 = "admin";
        $on3 = "progress.admin_id = admin.admin_id";
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
        $this->db->order_by("progress.checklist_id", "ASC");
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
    
    public function update_progress($progress, $where = NULL){
        if(!empty($where)){
             $this->db->where($where);
        }
        $this->db->update("transaction", $progress);
        return $this->db->affected_rows();
    }
    
    public function update_adoption_form($adoption_form, $where = NULL){
        if(!empty($where)){
             $this->db->where($where);
        }
        $this->db->update("adoption_form", $adoption_form);
        return $this->db->affected_rows();
    }
    
    public function approve_adoption_form($data, $where = NULL){
        if(!empty($where)){
             $this->db->where($where);
        }
        $this->db->update("progress", $data);
        return $this->db->affected_rows();
    }
    public function get_comments($where = NULL){
        if(!empty($where)){
             $this->db->where($where);
        }
        $this->db->join("comment", "progress_comment.comment_id = comment.comment_id", "left outer");
        $this->db->join("progress", "progress_comment.progress_id = progress.progress_id", "left outer");
        $this->db->order_by("progress_comment_added_at", "ASC");
        $query = $this->db->get("progress_comment");
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
}
