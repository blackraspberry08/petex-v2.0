<?php

class PetAdoption extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('main_model');

        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
    }

    public function index() {
        $data = array(
            'title' => "Pet Adoption | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            'wholeUrl' => base_url(uri_string())
        );
        $this->load->view("pet_adoption/includes/header", $data);
        $this->load->view("pet_adoption/main");
        $this->load->view("pet_adoption/includes/footer");
    }

}
