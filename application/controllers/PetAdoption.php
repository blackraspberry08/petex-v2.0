<?php

class PetAdoption extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('PetAdoption_model');

        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
    }

    public function index() {
        $allPets = $this->PetAdoption_model->fetchPetDesc("pet");
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];

        $data = array(
            'title' => "Pet Adoption | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User",
            'pets' => $allPets,
        );
        $this->load->view("pet_adoption/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("pet_adoption/main");
        $this->load->view("pet_adoption/includes/footer");
    }

}
