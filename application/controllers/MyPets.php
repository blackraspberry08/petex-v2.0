<?php

class MyPets extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('MyPets_model');
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
            'title' => "My Pets | " . $current_user->user_firstname . " " . $current_user->user_lastname,
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

    public function edit_details_exec() {
        $animal_id = $this->uri->segment(3);
        $this->session->set_userdata("animal_id", $animal_id);
        redirect(base_url() . "MyPets/edit_details");
    }

    public function edit_details() {
        $animal_id = $this->session->userdata("animal_id");
        $current_animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Edit My Pet | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            'animal' => $current_animal,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User"
        );
        $this->load->view("my_pets/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("my_pets/mypet_edit_detail");
        $this->load->view("my_pets/includes/footer");
    }

    public function edit_details_submit() {
        
    }

}
