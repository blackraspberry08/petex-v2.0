<?php

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('Main_model');

        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
    }

    public function index() {
        $allPets = $this->Main_model->fetchPetDesc("pet");
        $data = array(
            'title' => 'Pet Ex | Pet Express Homepage',
            'wholeUrl' => base_url(uri_string()),
            'pets' => $allPets,
        );
        $this->load->view("main/includes/header", $data);
        $this->load->view("main/main");
        $this->load->view("main/includes/footer");
    }

}
