<?php

class SubadminDashboard extends CI_Controller {
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
                $this->session->set_flashdata("err_5", "You are currently logged in as ".$current_user->user_firstname." ".$current_user->user_lastname);
                redirect(base_url()."userDashboard");
            }
            else if($this->session->userdata("user_access") == "subadmin"){
                //SUBADMIN!
                //Do nothing.
            }
            else if($this->session->userdata("user_access") == "admin"){
                //ADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as ".$current_user->admin_firstname." ".$current_user->admin_lastname);
                redirect(base_url()."AdminDashboard");
            }
        }
    }
    
    public function index(){
        $data = array(
            'title' => "Dashboard",
            //FOR DUMMY VARIABLES
            'user_name' => "Juan Carlo D.R. Valencia",
            'user_picture' => "images/user/jc.png",
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("dashboard/main");
        $this->load->view("dashboard/includes/footer");
    }
}


