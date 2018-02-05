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
            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Uploaded an adoption form manually.");
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
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 2))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $current_adoption_form = $this->ManageProgress_model->get_adoption_form(array("adoption_form.transaction_id" => $transaction_id))[0];
        if($this->input->post('event_type') == "approve"){
            //Approve Step + Comment + Set Sched
            $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "There are errors in your form. Please check the fields."));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
                $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array('success' => false, 'result' => 'There is an existing schedule already!'));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if($startdate > $enddate){
                        echo json_encode(array('success' => false, 'result' => 'Start Date/Time is ahead of End Date/Time'));
                    }else{
                        $data = array(
                            "progress_accomplished_at"  => time(),
                            "progress_isSuccessful"     => 1,
                            "progress_percentage"       => 100
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
                        $sched = array(
                            "progress_id"       => $next_progress->progress_id,
                            "admin_id"          => $this->session->userdata("current_user")->admin_id,
                            "schedule_title"    => $this->input->post('schedule_title'),
                            "schedule_desc"     => $this->input->post('schedule_desc'),
                            "schedule_color"    => $this->input->post('schedule_color'),
                            "schedule_startdate"=> $startdate,
                            "schedule_enddate"  => $enddate
                        );
                        // rename() moves file, not rename them.
                        rename($current_adoption_form->adoption_form_location, $adoption_form['adoption_form_location']);
                        if(    $this->ManageProgress_model->approve_adoption_form($data, array("checklist_id" => 1, "transaction_id" => $transaction_id)) 
                            && $this->ManageProgress_model->update_progress($transaction_progress, array("transaction_id" => $transaction_id)) 
                            && $this->ManageProgress_model->update_adoption_form($adoption_form, array("transaction_id" => $transaction_id))
                            && $this->ManageProgress_model->add_progress_comment($progress_comment)
                            && $this->Schedules_model->add_schedule($sched)
                            ){
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Approved adoption form (step 1) and added a schedule for next step of ".$current_transaction->user_firstname." ".$current_transaction->user_lastname)."";
                            $this->session->set_flashdata("approve_adoption_form_success", "Approved adoption form.");
                            echo json_encode(array('success' => true, 'result' => 'Successfully approved adoption form!'));
                        }else{
                            echo json_encode(array('success' => false, 'result' => 'Something went wrong while approving adoption form'));
                        }
                    }
                }
            }
        }
        
        else if ($this->input->post('event_type') == "disapprove") {
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "Pleas provide a comment."));
            } else {
                //Disapprove Step + Comment
                $progress_comment = array(
                    "progress_id"                   => $current_progress->progress_id,
                    "progress_comment_sender"       => $current_user->admin_firstname." ".$current_user->admin_lastname,
                    "progress_comment_picture"      => $current_user->admin_picture,
                    "progress_comment_sender_access" => $current_user->admin_access,
                    "progress_comment_content"      => $this->input->post('comment'),
                    "progress_comment_added_at"     => time()
                );
                if($this->ManageProgress_model->add_progress_comment($progress_comment)){
                    $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Disapproved adoption form (step 1) of ".$current_transaction->user_firstname." ".$current_transaction->user_lastname);
                    $this->session->set_flashdata("approve_adoption_form_success", "Disapproved adoption form.");
                    echo json_encode(array('success' => true, 'result' => 'Successfully disapproved adoption form.'));
                }else{
                    echo json_encode(array('success' => false, 'result' => 'Something went wrong while disapproving adoption form'));
                }
            }
        }
        
        else{
            echo json_encode(array('success' => false, 'result' => "Something Went wrong. Try again later."));
        }
    }
    

    public function step_2(){
        $transaction_id = $this->uri->segment(3);
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $current_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 2))[0];
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 3))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        if($this->input->post('event_type') == "approve"){
            $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "There are errors in your form. Please check the fields."));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
                $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array('success' => false, 'result' => 'There is an existing schedule already!'));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if($startdate > $enddate){
                        echo json_encode(array('success' => false, 'result' => 'Start Date/Time is ahead of End Date/Time'));
                    }else{
                        $data = array(
                            "progress_accomplished_at"  => time(),
                            "progress_isSuccessful"     => 1,
                            "progress_percentage"       => 100
                        );
                        $transaction_progress = array(
                            "transaction_progress"      => 32
                        );

                        $progress_comment = array(
                            "progress_id"                   => $current_progress->progress_id,
                            "progress_comment_sender"       => $current_user->admin_firstname." ".$current_user->admin_lastname,
                            "progress_comment_picture"      => $current_user->admin_picture,
                            "progress_comment_sender_access" => $current_user->admin_access,
                            "progress_comment_content"      => $this->input->post('comment'),
                            "progress_comment_added_at"     => time()
                        );
                        $sched = array(
                            "progress_id"           => $next_progress->progress_id,
                            "admin_id"              => $this->session->userdata("current_user")->admin_id,
                            "schedule_title"        => $this->input->post('schedule_title'),
                            "schedule_desc"         => $this->input->post('schedule_desc'),
                            "schedule_color"        => $this->input->post('schedule_color'),
                            "schedule_startdate"    => $startdate,
                            "schedule_enddate"      => $enddate
                        );
                        
                        if(    $this->ManageProgress_model->approve_adoption_form($data, array("checklist_id" => 2, "transaction_id" => $transaction_id)) 
                            && $this->ManageProgress_model->update_progress($transaction_progress, array("transaction_id" => $transaction_id))
                            && $this->ManageProgress_model->add_progress_comment($progress_comment)
                            && $this->Schedules_model->add_schedule($sched)
                            ){
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Approved Meet and Greet (step 2) and added a schedule for next step of ".$current_transaction->user_firstname." ".$current_transaction->user_lastname);
                            $this->session->set_flashdata("disapprove_step_2_success", "Successfully approved Meet and Greet!");
                            echo json_encode(array('success' => true, 'result' => "Successfully approved Meet and Greet!"));
                        }else{
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Meet and Greet"));
                            $this->session->set_flashdata("disapprove_step_2_fail", "Something went wrong while approving Meet and Greet");
                        }
                    }
                }
            }
        }
        
        else if ($this->input->post('event_type') == "disapprove") {
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "Please provide a comment."));
            }else{
                $progress_comment = array(
                    "progress_id"                   => $current_progress->progress_id,
                    "progress_comment_sender"       => $current_user->admin_firstname." ".$current_user->admin_lastname,
                    "progress_comment_picture"      => $current_user->admin_picture,
                    "progress_comment_sender_access" => $current_user->admin_access,
                    "progress_comment_content"      => $this->input->post('comment'),
                    "progress_comment_added_at"     => time()
                );
                if(
                    $this->ManageProgress_model->add_progress_comment($progress_comment)
                ){
                    $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Disapproved Meet And Greet (step 2) of ".$current_transaction->user_firstname." ".$current_transaction->user_lastname);
                    $this->session->set_flashdata("disapprove_step_2_success", "Disapproved Meet And Greet.");
                    echo json_encode(array('success' => true, 'result' => "Disapproved Meet And Greet."));
                }else{
                    echo json_encode(array('success' => false, 'result' => "Something went wrong while disapproving Meet and Greet"));
                    $this->session->set_flashdata("disapprove_step_2_fail", "Something went wrong while disapproving Meet and Greet");
                }
            }
            
        }
        else if($this->input->post('event_type') == "setSched_1"){
            $this->form_validation->set_rules('schedule_startdate_1', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime_1', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate_1', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime_1', "End Time", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "There are errors in your form. Please check the fields."));
            }else{
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate_1') . " " . $this->input->post('schedule_starttime_1'));
                $enddate = strtotime($this->input->post('schedule_enddate_1') . " " . $this->input->post('schedule_endtime_1'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array('success' => false, 'result' => 'There is an existing schedule already!'));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if($startdate > $enddate){
                        echo json_encode(array('success' => false, 'result' => 'Start Date/Time is ahead of End Date/Time'));
                    }else{
                        //Set Schedule Only 
                        
                        $sched = array(
                            "progress_id" => $next_progress->progress_id,
                            "admin_id" => $this->session->userdata("current_user")->admin_id,
                            "schedule_title" => $this->input->post('schedule_title_1'),
                            "schedule_desc" => $this->input->post('schedule_desc_1'),
                            "schedule_color" => $this->input->post('schedule_color_1'),
                            "schedule_startdate" => $startdate,
                            "schedule_enddate" => $enddate
                        );
                        if($this->Schedules_model->add_schedule($sched)){
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Added Interview #1 Schedule for ".$current_transaction->user_firstname." ".$current_transaction->user_lastname);
                            $this->session->set_flashdata("approve_step_2_success", "Schedule set.");
                            echo json_encode(array('success' => true, 'result' => "Schedule set."));   
                        }else{
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while setting schedule for Interview"));
                            $this->session->set_flashdata("approve_step_2_fail", "Something went wrong while setting schedule for Interview");
                        }
                    }
                }
            }
        }
        else if($this->input->post('event_type') == "setSched_2"){
            $this->form_validation->set_rules('schedule_startdate_2', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime_2', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate_2', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime_2', "End Time", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "There are errors in your form. Please check the fields."));
            }else{
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate_2') . " " . $this->input->post('schedule_starttime_2'));
                $enddate = strtotime($this->input->post('schedule_enddate_2') . " " . $this->input->post('schedule_endtime_2'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array('success' => false, 'result' => 'There is an existing schedule already!'));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if($startdate > $enddate){
                        echo json_encode(array('success' => false, 'result' => 'Start Date/Time is ahead of End Date/Time'));
                    }else{
                        //Set Schedule Only
                        $sched = array(
                            "progress_id" => $next_progress->progress_id,
                            "admin_id" => $this->session->userdata("current_user")->admin_id,
                            "schedule_title" => $this->input->post('schedule_title_2'),
                            "schedule_desc" => $this->input->post('schedule_desc_2'),
                            "schedule_color" => $this->input->post('schedule_color_2'),
                            "schedule_startdate" => $startdate,
                            "schedule_enddate" => $enddate
                        );
                        if($this->Schedules_model->add_schedule($sched)){
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Added Interview #2 Schedule for ".$current_transaction->user_firstname." ".$current_transaction->user_lastname);
                            $this->session->set_flashdata("approve_step_2_success", "Schedule set.");
                            echo json_encode(array('success' => true, 'result' => "Schedule set."));   
                        }else{
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while setting schedule for Interview"));
                            $this->session->set_flashdata("approve_step_2_fail", "Something went wrong while setting schedule for Interview");
                        }
                    }
                }
            }
        }
        else{
            echo json_encode(array('success' => false, 'result' => "Something Went wrong. Try again later."));
        }
    }
    
    public function step_3(){
        $transaction_id = $this->uri->segment(3);
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $current_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" =>3))[0];
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 4))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        if($this->input->post('event_type') == "approve"){
            $this->form_validation->set_rules('schedule_startdate_prog3', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime_prog3', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate_prog3', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime_prog3', "End Time", "required");
            $this->form_validation->set_rules('comment_prog3', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "There are errors in your form. Please check the fields."));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate_prog3') . " " . $this->input->post('schedule_starttime_prog3'));
                $enddate = strtotime($this->input->post('schedule_enddate_prog3') . " " . $this->input->post('schedule_endtime_prog3'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array('success' => false, 'result' => 'There is an existing schedule already!'));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if($startdate > $enddate){
                        echo json_encode(array('success' => false, 'result' => 'Start Date/Time is ahead of End Date/Time'));
                    }else{
                        $data = array(
                            "progress_accomplished_at"  => time(),
                            "progress_isSuccessful"     => 1,
                            "progress_percentage"       => 100
                        );
                        $transaction_progress = array(
                            "transaction_progress"      => 49
                        );

                        $progress_comment = array(
                            "progress_id"                   => $current_progress->progress_id,
                            "progress_comment_sender"       => $current_user->admin_firstname." ".$current_user->admin_lastname,
                            "progress_comment_picture"      => $current_user->admin_picture,
                            "progress_comment_sender_access" => $current_user->admin_access,
                            "progress_comment_content"      => $this->input->post('comment_prog3'),
                            "progress_comment_added_at"     => time()
                        );
                        $sched = array(
                            "progress_id"           => $next_progress->progress_id,
                            "admin_id"              => $this->session->userdata("current_user")->admin_id,
                            "schedule_title"        => $this->input->post('schedule_title_prog3'),
                            "schedule_desc"         => $this->input->post('schedule_desc_prog3'),
                            "schedule_color"        => $this->input->post('schedule_color_prog3'),
                            "schedule_startdate"    => $startdate,
                            "schedule_enddate"      => $enddate
                        );
                        
                        if(    $this->ManageProgress_model->approve_adoption_form($data, array("checklist_id" => 3, "transaction_id" => $transaction_id)) 
                            && $this->ManageProgress_model->update_progress($transaction_progress, array("transaction_id" => $transaction_id))
                            && $this->ManageProgress_model->add_progress_comment($progress_comment)
                            && $this->Schedules_model->add_schedule($sched)
                            ){
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Approved All Interviews (step 3) and added a schedule for next step of ".$current_transaction->user_firstname." ".$current_transaction->user_lastname);
                            $this->session->set_flashdata("approve_success", "Successfully approved All Interviews!");
                            echo json_encode(array('success' => true, 'result' => "Successfully approved All Interviews!"));
                        }else{
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while approving All Interviews"));
                            $this->session->set_flashdata("approve_failed", "Something went wrong while approving All Interviews");
                        }
                    }
                }
            }
        }
        
        else if ($this->input->post('event_type') == "disapprove") {
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "Please provide a comment."));
            } else {
                $progress_comment = array(
                    "progress_id"                   => $current_progress->progress_id,
                    "progress_comment_sender"       => $current_user->admin_firstname." ".$current_user->admin_lastname,
                    "progress_comment_picture"      => $current_user->admin_picture,
                    "progress_comment_sender_access" => $current_user->admin_access,
                    "progress_comment_content"      => $this->input->post('comment'),
                    "progress_comment_added_at"     => time()
                );
                if(
                    $this->ManageProgress_model->add_progress_comment($progress_comment)
                ){
                    $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Disapproved Interview of ".$current_transaction->user_firstname." ".$current_transaction->user_lastname);
                    $this->session->set_flashdata("approve_step_2_success", "Disapproved Interview");
                    echo json_encode(array('success' => true, 'result' => "Disapproved Interview"));
                }else{
                    echo json_encode(array('success' => false, 'result' => "Something went wrong while disapproving Interview"));
                    $this->session->set_flashdata("approve_step_2_fail", "Something went wrong while disapproving Interview");
                }
            }
        }
        
        else if($this->input->post('event_type') == "done_sched_1"){
            $data = array(
                "progress_percentage"       => 33
            );
            if($this->ManageProgress_model->edit_progress($data, array("progress_id" => $current_progress->progress_id))){
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Interview #1 is done for ".$current_transaction->user_firstname." ".$current_transaction->user_lastname);
                $this->session->set_flashdata("approve_success", "Interview #1 is done");
                echo json_encode(array('success' => true, 'result' => "Interview #1 is done"));
            }else{
                $this->session->set_flashdata("approve_failed", "Something went wrong while approving Interview #1");
                echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Interview #1"));
            }
        }
        else if($this->input->post('event_type') == "done_sched_2"){
            $data = array(
                "progress_percentage"       => 66
            );
            if($this->ManageProgress_model->edit_progress($data, array("progress_id" => $current_progress->progress_id))){
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Interview #2 is done for ".$current_transaction->user_firstname." ".$current_transaction->user_lastname);
                $this->session->set_flashdata("approve_success", "Interview #2 is done");
                echo json_encode(array('success' => true, 'result' => "Interview #2 is done"));
            }else{
                $this->session->set_flashdata("approve_failed", "Something went wrong while approving Interview #2");
                echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Interview #2"));
            }
        }
        else if($this->input->post('event_type') == "done_sched_3"){
            $data = array(
                "progress_percentage"       => 100
            );
            if($this->ManageProgress_model->edit_progress($data, array("progress_id" => $current_progress->progress_id))){
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Interview #3 is done for ".$current_transaction->user_firstname." ".$current_transaction->user_lastname);
                $this->session->set_flashdata("approve_success", "Interview #3 is done");
                echo json_encode(array('success' => true, 'result' => "Interview #3 is done"));
            }else{
                $this->session->set_flashdata("approve_failed", "Something went wrong while approving Interview #3");
                echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Interview #3"));
            }
        }
        
        else{
            echo json_encode(array('success' => false, 'result' => "Something Went wrong. Try again later."));
        }
    }
}


