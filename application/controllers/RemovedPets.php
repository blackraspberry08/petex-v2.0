<?php

class RemovedPets extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
        $petManagementModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 3));
        if ($this->session->has_userdata('isloggedin') == FALSE) {
            //user is not yet logged in
            $this->session->set_flashdata("err_4", "Login First!");
            redirect(base_url() . 'main/');
        } else {
            $current_user = $this->session->userdata("current_user");
            if ($this->session->userdata("user_access") == "user") {
                //USER!
                $this->session->set_flashdata("err_5", "You are currently logged in as " . $current_user->user_firstname . " " . $current_user->user_lastname);
                redirect(base_url() . "UserDashboard");
            } else if ($this->session->userdata("user_access") == "subadmin") {
                //SUBADMIN!
                if (empty($petManagementModule)) {
                    $this->session->set_flashdata("err_5", "You have no access in Pet Management Module.");
                    redirect(base_url() . "SubadminDashboard");
                }
            } else if ($this->session->userdata("user_access") == "admin") {
                //ADMIN!
                //Do nothing!
            }
        }
    }

    public function index() {
        $manageUserModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 1));
        $manageOfficerModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 2));
        $petManagementModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 3));
        $scheduleModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 4));

        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $removed_animals = $this->PetManagement_model->get_removed_animals();
        $data = array(
            /* MODULE ACCESS */
            'manageUserModule' => $manageUserModule,
            'manageOfficerModule' => $manageOfficerModule,
            'petManagementModule' => $petManagementModule,
            'scheduleModule' => $scheduleModule,
            //////////////////////////////
            'title' => "Removed Pets",
            'removed_animals' => $removed_animals,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        if ($current_user->admin_access == "Subadmin") {
            $this->load->view("subadmin_nav/navheader");
        } else {
            $this->load->view("admin_nav/navheader");
        }
        $this->load->view("removed_pets/main");
        $this->load->view("dashboard/includes/footer");
    }

    public function restore_animal_exec() {
        $animal_id = $this->uri->segment(3);
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        if ($this->PetManagement_model->restore_animal(array("pet_id" => $animal_id))) {
            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Restored " . $animal->pet_name . " to the database.");
            $this->session->set_flashdata("remove_animal_success", "Successfully restored " . $animal->pet_name . " to the database.");
        } else {
            $this->session->set_flashdata("remove_animal_fail", "Something went wrong while removing " . $animal->pet_name . " from the database");
        }
        redirect(base_url() . "RemovedPets");
    }

    public function search_pet_removed(){
        $word = $this->input->post("search_word");
        $filter = $this->input->post("filter");
        if($filter == "nofilter"){
            $matched_pet = $this->PetManagement_model->search_animal_removed($word);
        }else{
            $matched_pet = $this->PetManagement_model->search_animal_removed($word, $filter);
        }
        if($word == "" && $filter == "nofilter"){
            $removed_animals = $this->PetManagement_model->get_removed_animals();
            $data = array(
                "success"   => 1,
                "result"     => "",
                "pets"      => $removed_animals
            );
        }else{
            if(empty($matched_pet)){
                $data = array(
                    "success"   => 2,
                    "result"     => "No Matches Found",
                    "pets"      => $matched_pet
                );
            }else{
                $data = array(
                    "success"   => 3,
                    "result"     => count($matched_pet)." results found",
                    "pets"      => $matched_pet
                );
            }
            
        }
        
        echo json_encode($data);
    }
}
