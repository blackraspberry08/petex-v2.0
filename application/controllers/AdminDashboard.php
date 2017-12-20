<?php

class AdminDashboard extends CI_Controller {
    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('AdminDashboard_model');
        
        //---> LIBRARIES HERE!

        
        //---> SESSIONS HERE!
        
    }
    
    public function index(){
        $data = array(
            'title' => "Dashboard",
            'user_name' => "Juan Carlo D.R. Valencia"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("adminNav/navheader");
        $this->load->view("dashboard/main");
        $this->load->view("dashboard/includes/footer");
    }
}


