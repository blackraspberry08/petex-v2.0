<?php

class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('Profile_model');
        //---> HELPERS HERE!
        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
        if ($this->session->has_userdata('isloggedin') == FALSE) {
            //user is not yet logged in
            $this->session->set_flashdata("err_4", "Login First!");
            redirect(base_url() . 'main/');
        } else {
            $current_user = $this->session->userdata("current_user");
            if ($this->session->userdata("user_access") == "user") {
                //USER!
                //Do nothing
            } else if ($this->session->userdata("user_access") == "subadmin") {
                //SUBADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as " . $current_user->user_firstname . " " . $current_user->user_lastname);
                redirect(base_url() . "SubadminDashboard");
            } else if ($this->session->userdata("user_access") == "admin") {
                //ADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as " . $current_user->admin_firstname . " " . $current_user->admin_lastname);
                redirect(base_url() . "AdminDashboard");
            }
        }
    }

    public function index() {
        $userDetails = $this->Profile_model->fetch("user", array("user_id" => $this->session->userdata("userid")))[0];
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Profile | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User",
            'userDetails' => $userDetails
        );
        $this->load->view("profile/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("profile/main");
        $this->load->view("profile/includes/footer");
    }

    public function edit_profile() {
        $userDetails = $this->Profile_model->fetch("user", array("user_id" => $this->session->userdata("userid")))[0];
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Edit Profile | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User",
            'userDetails' => $userDetails
        );
        $this->load->view("profile/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("profile/edit_profile");
        $this->load->view("profile/includes/footer");
    }

}
