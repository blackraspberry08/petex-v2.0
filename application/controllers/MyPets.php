<?php

class MyPets extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('MyPets_model');
        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
    }

    public function index() {
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];

        $data = array(
            'title' => "User Dashboard | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User"
        );
        $this->load->view("my_pets/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("my_pets/main");
        $this->load->view("my_pets/includes/footer");
    }

}
