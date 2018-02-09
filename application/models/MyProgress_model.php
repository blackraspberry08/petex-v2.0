<?php

class MyProgress_model extends CI_Model {

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
        $this->db->order_by("progress.checklist_id", "ASC");
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function get_comments($where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join("progress", "progress_comment.progress_id = progress.progress_id", "left outer");
        $this->db->join("transaction", "progress.transaction_id = transaction.transaction_id", "left outer");
        $this->db->order_by("progress_comment_added_at", "ASC");
        $query = $this->db->get("progress_comment");
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetch($table, $where = NULL) {
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

}
