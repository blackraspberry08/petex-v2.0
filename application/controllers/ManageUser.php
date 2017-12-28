<?php

class ManageUser extends CI_Controller {
    function __construct() {
        parent::__construct();
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
    
    public function activate_user_exec(){
        $this->session->set_userdata("activate_user", $this->uri->segment(3));
        redirect(base_url()."ManageUser/activate_user");
    }
    
    public function activate_user(){
        $user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("activate_user")))[0];
        if($this->ManageUsers_model->activate_user("user", array("user_id" => $this->session->userdata("activate_user")))){
            $this->session->set_flashdata("activation_success", "Successfully activated ".$user->user_firstname." ".$user->user_lastname."'s account.");
        }else{
            $this->session->set_flashdata("activation_fail", "Something went wrong while activating ".$user->user_firstname." ".$user->user_lastname."'s account.");
        }
        $this->session->unset_userdata("activate_user");
        redirect(base_url()."ManageUser");
    }
    
    public function deactivate_user_exec(){
        $this->session->set_userdata("deactivate_user", $this->uri->segment(3));
        redirect(base_url()."ManageUser/deactivate_user");
    }
    
    public function deactivate_user(){
        $user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("deactivate_user")))[0];
        if($this->ManageUsers_model->deactivate_user("user", array("user_id" => $this->session->userdata("deactivate_user")))){
            $this->session->set_flashdata("activation_success", "Successfully deactivated ".$user->user_firstname." ".$user->user_lastname."'s account.");
        }else{
            $this->session->set_flashdata("activation_fail", "Something went wrong while deactivating ".$user->user_firstname." ".$user->user_lastname."'s account.");
        }
        $this->session->unset_userdata("deactivate_user");
        redirect(base_url()."ManageUser");
    }
    
    public function show_user_info_exec(){
        $this->session->set_userdata("show_user_info", $this->uri->segment(3));
        redirect(base_url()."ManageUser/show_user_info");
    }
    public function show_user_info(){
        $selected_user = $this->ManageUsers_model->get_user_info("user", array("user_id" => $this->session->userdata("show_user_info")))[0];
        $user_transaction = $this->ManageUsers_model->get_user_transaction(array("transaction.user_id" => $this->session->userdata("show_user_info")));
        $data = array(
            "title" => $selected_user->user_firstname." ".$selected_user->user_lastname." | Information",
            "user" => $selected_user,
            "transactions" => $user_transaction,
            //FOR DUMMY VARIABLES
            'user_name' => "Juan Carlo D.R. Valencia",
            'user_picture' => "images/user/jc.png",
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("manage_user/show_user_information");
        $this->load->view("dashboard/includes/footer");
    }
    
}