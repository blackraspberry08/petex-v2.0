<?php

class UserLogs extends CI_Controller {
    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        
        //---> LIBRARIES HERE!

        
        //---> SESSIONS HERE!
        
    }
    
    public function index(){
        $data = array(
            'title' => "User Logs",
            'logs' => $this->UserLogs_model->get_userlogs("event", "user", "event.user_id = user.user_id", "admin", "event.admin_id = admin.admin_id", array("event_classification" => "log")),
            'logs_last_update' => $this->UserLogs_model->get_recent_timestamp("event", array("event_classification" => "log"), "event_added_at"),
            //FOR DUMMY VARIABLES
            'user_name' => "Juan Carlo D.R. Valencia",
            'user_picture' => "images/user/jc.png",
            'user_access' => "Administrator"
            );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("userlogs/main");
        $this->load->view("dashboard/includes/footer");
    }
}


