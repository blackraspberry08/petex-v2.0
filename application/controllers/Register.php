<?php

class Register extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        //$this->load->model('register_model');
        //---> LIBRARIES HERE!
        $this->load->library('email');
        //---> SESSIONS HERE!
    }


    public function index() {
        $data = array(
            'title' => 'Pet Ex | Register',
            'wholeUrl' => base_url(uri_string())
        );
        $this->load->view("register/includes/header", $data);
        $this->load->view("register/register");
        $this->load->view("register/includes/footer");
    }

}
