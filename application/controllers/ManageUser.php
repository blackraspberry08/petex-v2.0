<?php

class ManageUser extends CI_Controller {
    function __construct() {
        parent::__construct();
        //---> MODELS HERE!

        
        //---> LIBRARIES HERE!

        
        //---> SESSIONS HERE!
        
    }
    
    public function index(){
        $data = array(
            'title' => "Manage Users",
            'users' => $this->ManageUsers_model->get_users("user", array("user_access"=>"User")),
            'user_last_update' => $this->ManageUsers_model->get_recent_timestamp("user", array("user_access"=>"User"), "user_added_at"),
            //FOR DUMMY VARIABLES
            'user_name' => "Juan Carlo D.R. Valencia",
            'user_picture' => "images/user/jc.png",
            'user_access' => "Administrator"
            );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("manage_user/main");
        $this->load->view("dashboard/includes/footer");
    }
}