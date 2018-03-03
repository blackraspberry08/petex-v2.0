<?php

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();

//---> LIBRARIES HERE!
//---> SESSIONS HERE!
    }

    function _alpha_dash_space($str = '') {
        if (!preg_match("/^([-a-z_ ])+$/i", $str)) {
            $this->form_validation->set_message('_alpha_dash_space', 'The {field} may only contain alphabet characters, spaces, underscores, and dashes.');
            return FALSE;
        } else {
            return TRUE;
        }
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

    public function contact() {
        $this->form_validation->set_rules("name", "Firstname", "required|min_length[2]|callback__alpha_dash_space");
        $this->form_validation->set_rules("email", "Email", "required|valid_email");
        $this->form_validation->set_rules("subject", "Subject", "required");
        $this->form_validation->set_rules("message", "Message", "required");
        if ($this->form_validation->run() == FALSE) {
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
        } else {
            $data = array(
                'name' => $this->input->post("name"),
                'email' => $this->input->post("email"),
                'subject' => $this->input->post("subject"),
                'message' => $this->input->post("message"),
            );
            $this->sendMessage($data);
        }
    }

    public function sendMessage($user) {
        $this->email->from("codebusters.solutions@gmail.com", 'Codebusters Team');
        $this->email->to("codebusters.solutions@gmail.com");
        $this->email->subject($user['subject']);
        $data = array('name' => $user['name'], 'email' => $user['email'], 'message' => $user['message'],);
        $this->email->message($this->load->view('main/sendMessage', $data, true));

        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        } else {

            redirect(base_url() . "main");
        }
    }

}
