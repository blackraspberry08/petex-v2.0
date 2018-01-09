<?php

class MyProgress extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('MyProgress_model');

        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
        if ($this->session->has_userdata('isloggedin') == FALSE) {
            //user is not yet logged in
            $this->session->set_userdata("err_4", "Login First!");
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
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];

        $data = array(
            'title' => "My Progress | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User"
        );
        $this->load->view("my_progress/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("my_progress/main");
        $this->load->view("my_progress/includes/footer");
    }

}
