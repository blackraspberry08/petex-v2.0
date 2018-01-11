<?php

class PetAdoption extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('PetAdoption_model');
        //---> HELPERS HERE!
        $this->load->helper('download');
        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
        if ($this->session->has_userdata('isloggedin') == FALSE) {
            //user is not yet logged in
            $this->session->set_flastdata("err_4", "Login First!");
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

    public function download($fileName = NULL) {
        if ($fileName) {
            $file = realpath("download") . "\\" . $fileName;
// check file exists    
            if (file_exists($file)) {
// get file content
                $data = file_get_contents($file);
//force download
                force_download($fileName, $data);
            } else {
// Redirect to base url
                redirect(base_url());
            }
        }
    }

    public function index() {
        $allPets = $this->PetAdoption_model->fetchPetDesc("pet");
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
        $petAdopters = $this->PetAdoption_model->fetchJoinThreeProgressDesc("transaction", "pet", "transaction.pet_id = pet.pet_id", "user", "transaction.user_id = user.user_id");
        $userInfo = $this->PetAdoption_model->fetchJoinProgress(array('transaction.user_id' => $this->session->userid));

        $data = array(
            'title' => "Pet Adoption | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User",
            'pets' => $allPets,
            'adopters' => $petAdopters,
            'userInfo' => $userInfo
        );
        $this->load->view("pet_adoption/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("pet_adoption/main");
        $this->load->view("pet_adoption/includes/footer");
    }

    public function petAdoptionOnlineForm_exec() {
        $this->session->set_userdata("petadopterid", $this->uri->segment(3));
        redirect(base_url() . "PetAdoption/petAdoptionOnlineForm");
    }

    public function petAdoptionOnlineForm() {
        $selectedPetId = $this->session->userdata("petadopterid");
        $userInfo = $this->PetAdoption_model->getinfo('user', array('user_id' => $this->session->userid))[0];
        $pet = $this->PetAdoption_model->fetch('pet', array('pet_id' => $selectedPetId))[0];
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];

        $data = array(
            'title' => "Online Adoption Application Form | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User",
            'wholeUrl' => base_url(uri_string()),
            'pet' => $pet,
            'userInfo' => $userInfo
        );
        $this->load->view("pet_adoption/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("pet_adoption/petAdoptionOnlineForm");
        $this->load->view("pet_adoption/includes/footer");
    }

}
