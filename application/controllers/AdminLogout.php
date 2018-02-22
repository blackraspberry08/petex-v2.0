<?php

class AdminLogout extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
    }

    public function index() {
		
        $this->SaveEventAdmin->logout($this->session->userdata("userid"));
        $this->session->sess_destroy();
        //echo base_url();
		redirect(base_url() . 'main/');
    }

}
