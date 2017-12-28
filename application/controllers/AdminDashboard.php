<?php

class AdminDashboard extends CI_Controller {
    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        
        //---> LIBRARIES HERE!

        
        //---> SESSIONS HERE!
        
    }
    
    public function index(){
        $data = array(
            'title' => "Dashboard",
            'trails' => $this->AuditTrail_model->get_audit_trail("event", "user", "event.user_id = user.user_id", array("event_classification" => "trail")),
            'logs' => $this->UserLogs_model->get_userlogs("event", "user", "event.user_id = user.user_id", array("event_classification" => "log")),
            //FOR DUMMY VARIABLES
            'user_name' => "Juan Carlo D.R. Valencia",
            'user_picture' => "images/user/jc.png",
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("dashboard/main");
        $this->load->view("dashboard/includes/footer");
    }
}


