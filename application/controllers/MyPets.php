<?php

class MyPets extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('main_model');

        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
    }

    public function index() {
        $data = array(
            'title' => "My Pets | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            'wholeUrl' => base_url(uri_string())
        );
        $this->load->view("my_pets/includes/header", $data);
        $this->load->view("my_pets/main");
        $this->load->view("my_pets/includes/footer");
    }

}
