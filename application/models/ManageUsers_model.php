<?php
class ManageUsers_model extends CI_Model {
    public function get_users($table, $where = NULL){
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function activate_user($table, $where){
        $this->db->set("user_status", 1);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update($table);
        return $this->db->affected_rows();
    }
    public function deactivate_user($table, $where){
        $this->db->set("user_status", 0);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update($table);
        return $this->db->affected_rows();
    }
    
    public function get_recent_timestamp($table, $where = NULL, $column = NULL){
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($column)) {
            $this->db->select_max($column);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    
    public function get_user_info($table, $where){
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function get_user_transactions($where = NULL){
        $table = "transaction";
        $join = "user";
        $on = "transaction.user_id = user.user_id";
        $join2 = "pet";
        $on2 = "transaction.pet_id = pet.pet_id";
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
    public function get_transaction_info($where = NULL){
        $table = "progress";
        $join = "checklist";
        $on = "progress.checklist_id = checklist.checklist_id";
        $join2 = "transaction";
        $on2 = "progress.transaction_id = transaction.transaction_id";
        $join3 = "admin";
        $on3 = "progress.admin_id = admin.admin_id";
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->join($join3, $on3, "left outer");
        $this->db->order_by("progress.checklist_id", "ASC");
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function get_user_pets($where = NULL){
        $table = "adoption";
        $join = "user";
        $on = "adoption.user_id = user.user_id";
        $join2 = "pet";
        $on2 = "adoption.pet_id = pet.pet_id";
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->order_by("adoption.adoption_adopted_at", "DESC");
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
    public function get_user_activities($where = NULL){
        $table = "event";
        $join = "user";
        $on = "event.user_id = user.user_id";
        $join2 = "admin";
        $on2 ="event.admin_id = admin.admin_id";
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->order_by("event.event_added_at", "DESC");
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }
}
