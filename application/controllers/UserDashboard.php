<?php

class UserDashboard extends CI_Controller {
    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        
        //---> LIBRARIES HERE!

        
        //---> SESSIONS HERE!
        if ($this->session->has_userdata('isloggedin') == FALSE) {
            //user is not yet logged in
            $this->session->set_userdata("err_4", "Login First!");
            redirect(base_url().'login/');
        }else{
            $current_user = $this->session->userdata("current_user");
            if($this->session->userdata("user_access") == "user"){
                //USER!
                //Do nothing
            }
            else if($this->session->userdata("user_access") == "subadmin"){
                //SUBADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as ".$current_user->user_firstname." ".$current_user->user_lastname);
                redirect(base_url()."SubadminDashboard");
            }
            else if($this->session->userdata("user_access") == "admin"){
                //ADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as ".$current_user->admin_firstname." ".$current_user->admin_lastname);
                redirect(base_url()."AdminDashboard");
            }
        }
    }
    
    public function index(){
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Dashboard",
            'trails' => $this->AuditTrail_model->get_audit_trail("event", "user", "event.user_id = user.user_id", "admin", "event.admin_id = admin.admin_id", array("event_classification" => "trail")),
            'logs' => $this->UserLogs_model->get_userlogs("event", "user", "event.user_id = user.user_id", "admin", "event.admin_id = admin.admin_id", array("event_classification" => "log")),
            'logs_last_update' => $this->UserLogs_model->get_recent_timestamp("event", array("event_classification" => "log"), "event_added_at"),
            'trails_last_update' => $this->AuditTrail_model->get_recent_timestamp("event", array("event_classification" => "audit"), "event_added_at"),
            //NAV INFO
            'user_name' => $current_user->admin_firstname." ".$current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("dashboard/main");
        $this->load->view("dashboard/includes/footer");
    }
}


