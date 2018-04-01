<?php

class ReturnProgress extends CI_Model {

    public function step_1($progress_id, $transaction_id, $schedule_id) {
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $current_adoption_form = $this->ManageProgress_model->get_adoption_form(array("adoption_form.transaction_id" => $transaction_id))[0];
        $comments_step_1 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 1, "progress.transaction_id" => $transaction_id));
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 2))[0];
            
        //EDIT TRANSACTION
        $this->db->where(array("transaction_id" => $transaction_id));
        $this->db->update("transaction", array("transaction_progress" => 0));
        $boolean1 = $this->db->affected_rows() > 0;
        
        //EDIT PROGRESS
        $this->db->where(array("progress_id" => $progress_id));
        $this->db->update("progress", array("progress_percentage" => 0, "progress_accomplished_at" => 0, "progress_isSuccessful" => 0));
        $boolean2 = $this->db->affected_rows() > 0;
        
        //REMOVE PROGRESS COMMENT
        $this->db->delete("progress_comment", array("progress_id" => $next_progress->progress_id));
        $this->db->delete("progress_comment", array("progress_comment_id" => end($comments_step_1)->progress_comment_id));
        $boolean3 = $this->db->affected_rows() > 0;
       
        //REMOVE SCHEDULE
        $this->db->delete("schedule", array("schedule_id" => $schedule_id));
        $boolean4 = $this->db->affected_rows() > 0;
        
        //EDIT ADOPTION FORM
        $data = array(
            "adoption_form_isPending" => 1,
            "adoption_form_location" => "download/pending/" . $transaction_id . "_adopter-" . $current_transaction->user_id . "_pet-" . $current_transaction->pet_id . ".pdf"
        );
        rename($current_adoption_form->adoption_form_location, $data['adoption_form_location']);
        $this->db->where(array("adoption_form_id" => $current_adoption_form->adoption_form_id));
        $this->db->update("adoption_form", $data);
        $boolean5 = $this->db->affected_rows() > 0;
        
        return ($boolean1 && $boolean2 && $boolean3 && $boolean4 && $boolean5);
    }
    
    public function step_2($progress_id, $transaction_id){
        $comments_step_2 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 2, "progress.transaction_id" => $transaction_id));
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 3))[0];
        
        //EDIT TRANSACTION
        $this->db->where(array("transaction_id" => $transaction_id));
        $this->db->update("transaction", array("transaction_progress" => 16));
        $boolean1 = $this->db->affected_rows() > 0;
        
        //EDIT PROGRESS
        $this->db->where(array("progress_id" => $progress_id));
        $this->db->update("progress", array("progress_percentage" => 0, "progress_accomplished_at" => 0, "progress_isSuccessful" => 0));
        $boolean2 = $this->db->affected_rows() > 0;
        
        //REMOVE PROGRESS COMMENT
        $this->db->delete("progress_comment", array("progress_id" => $next_progress->progress_id));
        $this->db->delete("progress_comment", array("progress_comment_id" => end($comments_step_2)->progress_comment_id));
        $boolean3 = $this->db->affected_rows() > 0;
       
        //REMOVE SCHEDULE
        $this->db->delete("schedule", array("progress_id" => $next_progress->progress_id));
        $boolean4 = $this->db->affected_rows() > 0;
        
        return ($boolean1 && $boolean2 && $boolean3 && $boolean4);
    }
    
    public function step_3_perSched($progress_id, $sched_no = NULL){
        switch($sched_no){
            case "1":{
                //REMOVE INTERVIEW REMARKS
                $this->db->delete("interview_remarks", array("progress_id" => $progress_id, "interview_remarks_percentage" => 33));
                $boolean2 = $this->db->affected_rows() > 0;
                
                //EDIT PROGRESS
                $this->db->where(array("progress_id" => $progress_id));
                $this->db->update("progress", array("progress_percentage" => 0));
                $boolean1 = $this->db->affected_rows() > 0;
                
                return ($boolean1 && $boolean2);
            }
            case "2":{
                //REMOVE INTERVIEW REMARKS
                $this->db->delete("interview_remarks", array("progress_id" => $progress_id, "interview_remarks_percentage" => 66));
                $boolean2 = $this->db->affected_rows() > 0;
                
                //EDIT PROGRESS
                $this->db->where(array("progress_id" => $progress_id));
                $this->db->update("progress", array("progress_percentage" => 33));
                $boolean1 = $this->db->affected_rows() > 0;
                
                return ($boolean1 && $boolean2);
            }
            case "3":{
                //REMOVE INTERVIEW REMARKS
                $this->db->delete("interview_remarks", array("progress_id" => $progress_id, "interview_remarks_percentage" => 100));
                $boolean2 = $this->db->affected_rows() > 0;
                
                //EDIT PROGRESS
                $this->db->where(array("progress_id" => $progress_id));
                $this->db->update("progress", array("progress_percentage" =>66));
                $boolean1 = $this->db->affected_rows() > 0;
                
                return ($boolean1 && $boolean2);
            }
        }
    }
    
    public function step_3($progress_id, $transaction_id, $schedule_id){
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 4))[0];
        $comments_step_3 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 3, "progress.transaction_id" => $transaction_id));
        
        //EDIT TRANSACTION
        $this->db->where(array("transaction_id" => $transaction_id));
        $this->db->update("transaction", array("transaction_progress" => 32));
        $boolean1 = $this->db->affected_rows() > 0;
        
        //EDIT PROGRESS
        $this->db->where(array("progress_id" => $progress_id));
        $this->db->update("progress", array("progress_percentage" => 100, "progress_accomplished_at" => 0, "progress_isSuccessful" => 0));
        $boolean2 = $this->db->affected_rows() > 0;
        
        //REMOVE PROGRESS COMMENT
        $this->db->delete("progress_comment", array("progress_id" => $next_progress->progress_id));
        $this->db->delete("progress_comment", array("progress_comment_id" => end($comments_step_3)->progress_comment_id));
        $boolean3 = $this->db->affected_rows() > 0;
       
        //REMOVE SCHEDULE
        $this->db->delete("schedule", array("schedule_id" => $schedule_id));
        $boolean4 = $this->db->affected_rows() > 0;
        
        return ($boolean1 && $boolean2 && $boolean3 && $boolean4);
    }
    
    public function step_4($progress_id, $transaction_id){
        $comments_step_4 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 4, "progress.transaction_id" => $transaction_id));
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 5))[0];
        
        //EDIT TRANSACTION
        $this->db->where(array("transaction_id" => $transaction_id));
        $this->db->update("transaction", array("transaction_progress" => 49));
        $boolean1 = $this->db->affected_rows() > 0;
        
        //EDIT PROGRESS
        $this->db->where(array("progress_id" => $progress_id));
        $this->db->update("progress", array("progress_percentage" => 0, "progress_accomplished_at" => 0, "progress_isSuccessful" => 0));
        $boolean2 = $this->db->affected_rows() > 0;
        
        //REMOVE PROGRESS COMMENT
        $this->db->delete("progress_comment", array("progress_id" => $next_progress->progress_id));
        $this->db->delete("progress_comment", array("progress_comment_id" => end($comments_step_4)->progress_comment_id));
        $boolean3 = $this->db->affected_rows() > 0;
       
        //REMOVE SCHEDULE
        $this->db->delete("schedule", array("progress_id" => $next_progress->progress_id));
        $boolean4 = $this->db->affected_rows() > 0;
        
        return ($boolean1 && $boolean2 && $boolean3 && $boolean4);
    }
    
    public function step_5_perSched($progress_id, $sched_no = NULL){
        switch($sched_no){
            case "1":{
                //REMOVE VISIT CHOSEN ADOPTEE REMARKS
                $this->db->delete("visit_adoptee_remarks", array("progress_id" => $progress_id, "visit_adoptee_remarks_percentage" => 33));
                $boolean2 = $this->db->affected_rows() > 0;
                
                //EDIT PROGRESS
                $this->db->where(array("progress_id" => $progress_id));
                $this->db->update("progress", array("progress_percentage" => 0));
                $boolean1 = $this->db->affected_rows() > 0;
                
                return ($boolean1 && $boolean2);
            }
            case "2":{
                //REMOVE VISIT CHOSEN ADOPTEE REMARKS
                $this->db->delete("visit_adoptee_remarks", array("progress_id" => $progress_id, "visit_adoptee_remarks_percentage" => 66));
                $boolean2 = $this->db->affected_rows() > 0;
                
                //EDIT PROGRESS
                $this->db->where(array("progress_id" => $progress_id));
                $this->db->update("progress", array("progress_percentage" => 33));
                $boolean1 = $this->db->affected_rows() > 0;
                return ($boolean1 && $boolean2);
            }
            case "3":{
                //REMOVE VISIT CHOSEN ADOPTEE REMARKS
                $this->db->delete("visit_adoptee_remarks", array("progress_id" => $progress_id, "visit_adoptee_remarks_percentage" => 100));
                $boolean2 = $this->db->affected_rows() > 0;
                
                $this->db->where(array("progress_id" => $progress_id));
                $this->db->update("progress", array("progress_percentage" =>66));
                $boolean1 = $this->db->affected_rows() > 0;
                return ($boolean1 && $boolean2);
            }
        }
    }
    
    public function step_5($progress_id, $transaction_id){
        $comments_step_5 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 5, "progress.transaction_id" => $transaction_id));
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 6))[0];
        
        //EDIT TRANSACTION
        $this->db->where(array("transaction_id" => $transaction_id));
        $this->db->update("transaction", array("transaction_progress" => 66));
        $boolean1 = $this->db->affected_rows() > 0;
        
        //EDIT PROGRESS
        $this->db->where(array("progress_id" => $progress_id));
        $this->db->update("progress", array("progress_percentage" => 100, "progress_accomplished_at" => 0, "progress_isSuccessful" => 0));
        $boolean2 = $this->db->affected_rows() > 0;
        
        //REMOVE PROGRESS COMMENT
        $this->db->delete("progress_comment", array("progress_id" => $next_progress->progress_id));
        $this->db->delete("progress_comment", array("progress_comment_id" => end($comments_step_5)->progress_comment_id));
        $boolean3 = $this->db->affected_rows() > 0;
       
        //REMOVE SCHEDULE
        $this->db->delete("schedule", array("progress_id" => $next_progress->progress_id));
        $boolean4 = $this->db->affected_rows() > 0;
        
        return ($boolean1 && $boolean2 && $boolean3 && $boolean4);
    }
}

