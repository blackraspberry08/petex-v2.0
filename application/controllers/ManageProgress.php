<?php

class ManageProgress extends CI_Controller {
    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        
        //---> LIBRARIES HERE!
        
        //---> SESSIONS HERE!
        if ($this->session->has_userdata('isloggedin') == FALSE) {
            //user is not yet logged in
            $this->session->set_flashdata("err_4", "Login First!");
            redirect(base_url().'main/');
        }else{
            $current_user = $this->session->userdata("current_user");
            if($this->session->userdata("user_access") == "user"){
                //USER!
                $this->session->set_flashdata("err_5", "You are currently logged in as ".$current_user->user_firstname." ".$current_user->user_lastname);
                redirect(base_url()."UserDashboard");
            }
            else if($this->session->userdata("user_access") == "subadmin"){
                //SUBADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as ".$current_user->user_firstname." ".$current_user->user_lastname);
                redirect(base_url()."SubadminDashboard");
            }
            else if($this->session->userdata("user_access") == "admin"){
                //ADMIN!
                //Do nothing!
            }
        }
    }
    
    public function index(){
        $transaction_id = $this->session->userdata("manage_progress_transaction_id");
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id));
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $adoption_form = $this->ManageProgress_model->get_adoption_form(array("adoption_form.transaction_id" => $current_transaction->transaction_id))[0];
        $comments_step_1 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 1, "progress.transaction_id" => $transaction_id));
        $comments_step_2 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 2, "progress.transaction_id" => $transaction_id));
        $comments_step_3 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 3, "progress.transaction_id" => $transaction_id));
        $comments_step_4 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 4, "progress.transaction_id" => $transaction_id));
        $comments_step_5 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 5, "progress.transaction_id" => $transaction_id));
        $comments_step_6 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 6, "progress.transaction_id" => $transaction_id));
        $data = array(
            'title' => $current_transaction->user_firstname." ".$current_transaction->user_lastname." | Manage Progress",
            'transaction' => $current_transaction,
            'progresses' => $progress,
            'adoption_form' => $adoption_form,
            'comments_step_1' => $comments_step_1,
            'comments_step_2' => $comments_step_2,
            'comments_step_3' => $comments_step_3,
            'comments_step_4' => $comments_step_4,
            'comments_step_5' => $comments_step_5,
            'comments_step_6' => $comments_step_6,
            //NAV INFO
            'user_name' => $current_user->admin_firstname." ".$current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("manage_progress/main");
        $this->load->view("dashboard/includes/footer");
    }
    
    public function upload_adoption_form(){
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $this->uri->segment(3)))[0];
        
        $file_name = $current_transaction->transaction_id."_adopter-".$current_transaction->user_id."_pet-".$current_transaction->pet_id.".pdf";
        $config['upload_path']          = './download/pending/';
        $config['allowed_types']        = 'pdf';
        $config['file_ext_tolower']     = true;
        $config['max_size']             = 5120;
        $config['file_name']            = $file_name;
        $this->load->library('upload', $config);
        
        if(!empty($_FILES["adoption_form"]["name"])){
            if(file_exists("download/pending/".$file_name)){
                unlink("download/pending/".$file_name);
            }
            if ($this->upload->do_upload('adoption_form')){
                $location = "download/pending/".$this->upload->data("file_name");
            } else {
                echo $this->upload->display_errors();
                $this->session->set_flashdata("uploading_error", "Please make sure that the max size is 5MB the types may only be .pdf");
                redirect(base_url()."ManageProgress");
            }
        }
        else {
            //NO PDF SENT
            $this->session->set_flashdata("uploading_error", "No pdf detected.");
            redirect(base_url()."ManageProgress");
        }
        
        $data = array(
            "transaction_id"            => $this->uri->segment(3),
            "adoption_form_location"    => $location,
            "adoption_form_isPending"   => 1,
            "adoption_form_added_at"    => time()
        );
        
        if($this->ManageProgress_model->add_adoption_form($data)){
            $this->session->set_flashdata("adoption_form_success", "Successfully uploaded the adoption form.");
        }
        else{
            $this->session->set_flashdata("adoption_form_fail", "Something went wrong");
        }
        redirect(base_url()."ManageProgress");
    }
    
    public function step_1(){
        $transaction_id = $this->uri->segment(3);
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $current_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 1))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $current_adoption_form = $this->ManageProgress_model->get_adoption_form(array("adoption_form.transaction_id" => $transaction_id))[0];
        if($this->input->post('approve') == "approve"){
            $data = array(
                "progress_accomplished_at"  => time(),
                "progress_isSuccessful"     => 1,
            );
            $transaction_progress = array(
                "transaction_progress"      => 16
            );
            $adoption_form = array(
                "adoption_form_isPending"   => 0,
                "adoption_form_location"    => "download/adoption_form/".$transaction_id."_adopter-".$current_transaction->user_id."_pet-".$current_transaction->pet_id.".pdf"
            );
            $progress_comment = array(
                "progress_id"                   => $current_progress->progress_id,
                "progress_comment_sender"       => $current_user->admin_firstname." ".$current_user->admin_lastname,
                "progress_comment_picture"      => $current_user->admin_picture,
                "progress_comment_sender_access" => $current_user->admin_access,
                "progress_comment_content"      => $this->input->post('comment'),
                "progress_comment_added_at"     => time()
            );
            // rename() moves file, not rename them.
            rename($current_adoption_form->adoption_form_location, $adoption_form['adoption_form_location']);
            if(    $this->ManageProgress_model->approve_adoption_form($data, array("checklist_id" => 1, "transaction_id" => $transaction_id)) 
                && $this->ManageProgress_model->update_progress($transaction_progress, array("transaction_id" => $transaction_id)) 
                && $this->ManageProgress_model->update_adoption_form($adoption_form, array("transaction_id" => $transaction_id))
                && $this->ManageProgress_model->add_progress_comment($progress_comment)
                ){
                $this->session->set_flashdata("approve_adoption_form_success", "Successfully approved adoption form!");
            }else{
                die;
                $this->session->set_flashdata("approve_adoption_form_fail", "Something went wrong while approving adoption form");
            }
        }
        
        else if ($this->input->post('disapprove') == "disapprove") {
            
            $data = array(
                "user_id"                   => $current_user->admin_id,
                "progress_accomplished_at"  => 0,
                "progress_isSuccessful"     => 0,
                "progress_comment"          => $this->input->post("comment")
            );
            if($this->ManageProgress_model->approve_adoption_form($data, array("checklist_id" => 1, "transaction_id" => $transaction_id))){
                $this->session->set_flashdata("approve_adoption_form_success", "Disapproved adoption form. Comment has been sent to the pet adopter.");
            }else{
                $this->session->set_flashdata("approve_adoption_form_fail", "Something went wrong while disapproving adoption form");
            }
        }
        redirect(base_url()."ManageProgress");
    }
    
}


