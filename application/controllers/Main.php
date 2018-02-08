<?php

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();

        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
    }

    public function index() {
        $countPets = $this->Main_model->count('pet');
        $countAdopters = $this->Main_model->count('adoption');
        $countDiscovered = $this->Main_model->count('discovery');
        $countTransactions = $this->Main_model->count('progress');

        $allPets = $this->Main_model->fetchPetDesc("pet");

        $data = array(
            'title' => 'Pet Ex | Pet Express Homepage',
            'wholeUrl' => base_url(uri_string()),
            'pets' => $allPets,
            'allPets' => $countPets,
            'allAdopters' => $countAdopters,
            'allDiscovered' => $countDiscovered,
            'allTransactions' => $countTransactions,
        );
        $this->load->view("main/includes/header", $data);
        $this->load->view("main/main");
        $this->load->view("main/includes/footer");
    }

}
