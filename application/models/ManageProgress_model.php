<?php

class ManageProgress_model extends CI_Model {

    public function get_progress($where = NULL) {
        $table = "progress";
        $join = "checklist";
        $on = "progress.checklist_id = checklist.checklist_id";
        $join2 = "transaction";
        $on2 = "progress.transaction_id = transaction.transaction_id";
        $join4 = "pet";
        $on4 = "transaction.pet_id = pet.pet_id";
        $this->db->where(array("transaction_isFinished" => 0));
        $this->db->where(array("transaction_isActivated" => 1));
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->join($join4, $on4, "left outer");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->order_by("progress.checklist_id", "ASC");
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function get_dropped_progress($where = NULL) {
        $table = "progress";
        $join = "checklist";
        $on = "progress.checklist_id = checklist.checklist_id";
        $join2 = "transaction";
        $on2 = "progress.transaction_id = transaction.transaction_id";
        $join4 = "pet";
        $on4 = "transaction.pet_id = pet.pet_id";
        $this->db->where(array("transaction_isFinished" => 0));
        $this->db->where(array("transaction_isActivated" => 0));
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->join($join4, $on4, "left outer");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->order_by("progress.checklist_id", "ASC");
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function get_finished_progress($where = NULL) {
        $table = "progress";
        $join = "checklist";
        $on = "progress.checklist_id = checklist.checklist_id";
        $join2 = "transaction";
        $on2 = "progress.transaction_id = transaction.transaction_id";
        $join4 = "pet";
        $on4 = "transaction.pet_id = pet.pet_id";
        $this->db->where(array("transaction_isFinished" => 1));
        $this->db->where(array("transaction_isActivated" => 0));
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->join($join4, $on4, "left outer");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->order_by("progress.checklist_id", "ASC");
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function get_adoption_form($where = NULL) {
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

    public function add_adoption_form($data) {
        $table = "adoption_form";
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function update_progress($progress, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("transaction", $progress);
        return $this->db->affected_rows();
    }

    public function update_adoption_form($adoption_form, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("adoption_form", $adoption_form);
        return $this->db->affected_rows();
    }

    public function approve_adoption_form($data, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("progress", $data);
        return $this->db->affected_rows();
    }

    public function edit_progress($data, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update("progress", $data);
        return $this->db->affected_rows();
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

    public function add_progress_comment($progress_comment) {
        $table = "progress_comment";
        $this->db->insert($table, $progress_comment);
        return $this->db->affected_rows();
    }

    public function get_schedule($where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join("admin", "schedule.admin_id = admin.admin_id", "left outer");
        $this->db->join("progress", "schedule.progress_id = progress.progress_id", "left outer");
        $query = $this->db->get("schedule");
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function add_adoption($adoption) {
        $table = "adoption";
        $this->db->insert($table, $adoption);
        return $this->db->affected_rows();
    }

    public function edit_pet_status($pet_id) {
        $where = array("pet_id" => $pet_id);
        $this->db->where($where);
        $this->db->update("pet", array("pet_status" => "Adopted"));
        return $this->db->affected_rows();
    }

    public function get_adoption($where = NULL) {
        $table = "adoption";
        $join = "user";
        $on = "adoption.user_id = user.user_id";
        $join2 = "pet";
        $on2 = "adoption.pet_id = pet.pet_id";
        $this->db->join($join, $on, "left outer");
        $this->db->join($join2, $on2, "left outer");
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function step_3_add_remarks($data) {
        $table = "interview_remarks";
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function get_interview($progress_id, $percentage) {
        $table = "interview_remarks";
        $join = "admin";
        $on = "interview_remarks.admin_id = admin.admin_id";
        $join2 = "transaction";
        $on2 = "progress.transaction_id = transaction.transaction_id";
        $join3 = "user";
        $on3 = "transaction.user_id = user.user_id";
        $join4 = "progress";
        $on4 = "interview_remarks.progress_id = progress.progress_id";

        $this->db->join($join, $on, "left outer");

        $this->db->join($join4, $on4, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->join($join3, $on3, "left outer");
        $this->db->where(array("interview_remarks.progress_id" => $progress_id));
        $this->db->where(array("interview_remarks_percentage" => $percentage));
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function step_5_add_remarks($data) {
        $table = "visit_adoptee_remarks";
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function get_visit_adoptee($progress_id, $percentage) {
        $table = "visit_adoptee_remarks";
        $join = "admin";
        $on = "visit_adoptee_remarks.admin_id = admin.admin_id";
        $join2 = "transaction";
        $on2 = "progress.transaction_id = transaction.transaction_id";
        $join3 = "user";
        $on3 = "transaction.user_id = user.user_id";
        $join4 = "progress";
        $on4 = "visit_adoptee_remarks.progress_id = progress.progress_id";

        $this->db->join($join, $on, "left outer");

        $this->db->join($join4, $on4, "left outer");
        $this->db->join($join2, $on2, "left outer");
        $this->db->join($join3, $on3, "left outer");
        $this->db->where(array("visit_adoptee_remarks.progress_id" => $progress_id));
        $this->db->where(array("visit_adoptee_remarks_percentage" => $percentage));
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

}
