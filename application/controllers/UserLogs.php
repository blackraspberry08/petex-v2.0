<?php

class UserLogs extends CI_Controller {
    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('UserLogs_model');
        
        //---> LIBRARIES HERE!

        
        //---> SESSIONS HERE!
        
    }
    
    public function index(){
        $data = array(
            'title' => "User Logs",
            'user_name' => "Juan Carlo D.R. Valencia",
            'logs' => $this->UserLogs_model->get_userlogs("event", "user", "event.user_id = user.user_id", "admin", "event.admin_id = admin.admin_id")
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("adminNav/navheader");
        $this->load->view("userlogs/main");
        $this->load->view("dashboard/includes/footer");
    }
}


