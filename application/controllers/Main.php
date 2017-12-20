<?php

class Main extends CI_Controller {
    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('main_model');
        
        //---> LIBRARIES HERE!

        
        //---> SESSIONS HERE!
        
    }
    
    public function index(){
        $this->load->view("main/includes/header");
        $this->load->view("main/main");
        $this->load->view("main/includes/footer");
    }
}

