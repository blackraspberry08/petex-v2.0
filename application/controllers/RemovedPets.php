<?php

class RemovedPets extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
        if ($this->session->has_userdata('isloggedin') == FALSE) {
            //user is not yet logged in
            $this->session->set_flashdata("err_4", "Login First!");
            redirect(base_url().'main/');
        }else{
            $current_user = $this->session->userdata("current_user");
            if($this->session->userdata("user_access") == "user"){
                //USER!
                $this->session->set_flashdata("err_5", "You are currently logged in as ".$current_user->user_firstname." ".$current_user->user_lastname);
                redirect(base_url()."UserDashboard");
            }
            else if($this->session->userdata("user_access") == "subadmin"){
                //SUBADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as ".$current_user->user_firstname." ".$current_user->user_lastname);
                redirect(base_url()."SubadminDashboard");
            }
            else if($this->session->userdata("user_access") == "admin"){
                //ADMIN!
                //Do nothing!
            }
        }
    }

    public function index() {
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $removed_animals = $this->PetManagement_model->get_removed_animals();
        $data = array(
            'title' => "Removed Pets",
            'removed_animals' => $removed_animals,
            //NAV INFO
            'user_name' => $current_user->admin_firstname." ".$current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("removed_pets/main");
        $this->load->view("dashboard/includes/footer");
    }
    
    public function restore_animal_exec(){
        $animal_id = $this->uri->segment(3);
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        if($this->PetManagement_model->restore_animal(array("pet_id" => $animal_id))){
            $this->session->set_flashdata("remove_animal_success", "Successfully removed ".$animal->pet_name." from the database. Bye ".$animal->pet_name."!");
        }else{
            $this->session->set_flashdata("remove_animal_fail", "Something went wrong while removing ".$animal->pet_name." from the database");
        }
        redirect(base_url()."RemovedPets");
    }

}
