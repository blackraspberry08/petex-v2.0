<?php

class PetManagement extends CI_Controller {
    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        
        //---> LIBRARIES HERE!
        
        //---> SESSIONS HERE!
        if ($this->session->has_userdata('isloggedin') == FALSE) {
            //user is not yet logged in
            $this->session->set_flashdata("err_4", "Login First!");
            redirect(base_url().'login/');
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

    public function index(){
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $all_animals = $this->PetManagement_model->get_all_animals();
        $data = array(
            'title' => "Pet Management",
            'all_animals' => $all_animals,
            //NAV INFO
            'user_name' => $current_user->admin_firstname." ".$current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("pet_management/main");
        $this->load->view("dashboard/includes/footer");
    }
    
    public function medical_records_exec(){
        $this->session->set_userdata("medical_records", $this->uri->segment(3));
        redirect(base_url()."PetManagement/medical_records");
    }
    public function medical_records(){
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $animal_id = $this->session->userdata("medical_records");
        $animal_medical_records = $this->PetManagement_model->get_animal_medical_records(array("medical_record.pet_id" => $animal_id));
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        $data = array(
            'title' => $animal->pet_name." | Medical Records",
            'animal_medical_records' => $animal_medical_records,
            'animal' => $animal,
            //NAV INFO
            'user_name' => $current_user->admin_firstname." ".$current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("medical_records/medical_records");
        $this->load->view("dashboard/includes/footer");
    }
    
    public function add_medical_record_exec(){
        $animal_id = $this->uri->segment(3);
        $this->form_validation->set_rules('medicalRecord_date', "Date ", "required");
        $this->form_validation->set_message('required', 'The {field} field is required');
        $this->form_validation->set_rules('medicalRecord_weight', "Weight ", "numeric");
        $this->form_validation->set_message('numeric', 'The {field} must be numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->medical_records();
        }else{
            $medical_record = array(
                "pet_id" => $animal_id,
                "medicalRecord_date" => strtotime($this->input->post("medicalRecord_date")),
                "medicalRecord_weight" => $this->input->post("medicalRecord_weight"),
                "medicalRecord_diagnosis" => $this->input->post("medicalRecord_diagnosis"),
                "medicalRecord_treatment" => $this->input->post("medicalRecord_treatment")
            );
            if($this->PetManagement_model->add_medical_record($medical_record)){
                //SUCCESS
                $this->session->set_flashdata("add_medical_record_success", "Successfully added a medical record.");
            }else{
                //FAILED
                $this->session->set_flashdata("add_medical_record_fail", "Something went wrong in adding a medical record.");
            }
            redirect(base_url()."PetManagement/medical_records");
        }
    }
    public function remove_medical_record_exec(){
        $record_id = $this->uri->segment(3);
        if($this->PetManagement_model->remove_medical_record(array("medicalRecord_id" => $record_id))){
            $this->session->set_flashdata("remove_medical_record_success", "Successfully removed a medical record");
        }else{
            $this->session->set_flashdata("remove_medical_record_fail", "Something went wrong while removing the medical record");
        }
        redirect(base_url()."PetManagement/medical_records");
    }
    public function edit_medical_record_exec() {
        $animal_id = $this->uri->segment(3);
        $record_id = $this->uri->segment(4);
        $this->session->set_userdata("animal_id", $animal_id);
        $this->session->set_userdata("medical_record_id", $record_id);
        redirect(base_url()."PetManagement/edit_medical_record");
    }
    public function edit_medical_record(){
        $animal_id = $this->session->userdata("animal_id");
        $record_id = $this->session->userdata("medical_record_id");
        $current_animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        $current_record = $this->PetManagement_model->get_medical_record(array("medicalRecord_id" => $record_id))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Edit Medical Record",
            'animal' => $current_animal,
            'record' => $current_record,
            //NAV INFO
            'user_name' => $current_user->admin_firstname." ".$current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("medical_records/edit_medical_record");
        $this->load->view("dashboard/includes/footer");
    }
    public function edit_medical_record_submit(){
        $this->form_validation->set_rules('medicalRecord_date', "Date ", "required");
        $this->form_validation->set_message('required', 'The {field} field is required');
        $this->form_validation->set_rules('medicalRecord_weight', "Weight ", "numeric");
        $this->form_validation->set_message('numeric', 'The {field} must be numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_medical_record();
        }else{
            $animal_id = $this->session->userdata("animal_id");
            $record_id = $this->session->userdata("medical_record_id");
            $medical_record = array(
                "pet_id" => $this->session->userdata("animal_id"),
                "medicalRecord_date" => strtotime($this->input->post("medicalRecord_date")),
                "medicalRecord_weight" => $this->input->post("medicalRecord_weight"),
                "medicalRecord_diagnosis" => $this->input->post("medicalRecord_diagnosis"),
                "medicalRecord_treatment" => $this->input->post("medicalRecord_treatment")
            );
            if($this->PetManagement_model->edit_medical_record($medical_record, array("medicalRecord_id" => $record_id))){
                //SUCCESS
                $this->session->set_flashdata("edit_medical_record_success", "Successfully edited a medical record.");
            }else{
                //FAILED
                $this->session->set_flashdata("edit_medical_record_fail", "Something went wrong in editing a medical record.");
            }
            redirect(base_url()."PetManagement/medical_records_exec/".$animal_id);
        }
    }
    
    public function animal_info_exec(){
        $this->session->set_userdata("animal_info", $this->uri->segment(3));
        redirect(base_url()."PetManagement/animal_info");
    }
    
    public function animal_info(){
        $animal_id = $this->session->userdata("animal_info");
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => $animal->pet_name." | Pet Information",
            'animal' => $animal,
            //NAV INFO
            'user_name' => $current_user->admin_firstname." ".$current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("pet_management/animal_information");
        $this->load->view("dashboard/includes/footer");
    }
    
    public function remove_animal_exec(){
        $animal_id = $this->uri->segment(3);
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        if($this->PetManagement_model->remove_animal(array("pet_id", $animal_id))){
            $this->session->set_flashdata("remove_animal_success", "Successfully removed ".$animal->pet_name." from the database. Bye ".$animal->pet_name."!");
        }else{
            $this->session->set_flashdata("remove_animal_fail", "Something went wrong while removing ".$animal->pet_name." from the database");
        }
        redirect(base_url()."PetManagement");
    }
}

