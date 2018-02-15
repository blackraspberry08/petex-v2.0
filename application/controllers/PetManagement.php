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
            redirect(base_url() . 'main/');
        } else {
            $current_user = $this->session->userdata("current_user");
            if ($this->session->userdata("user_access") == "user") {
//USER!
                $this->session->set_flashdata("err_5", "You are currently logged in as " . $current_user->user_firstname . " " . $current_user->user_lastname);
                redirect(base_url() . "UserDashboard");
            } else if ($this->session->userdata("user_access") == "subadmin") {
//SUBADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as " . $current_user->user_firstname . " " . $current_user->user_lastname);
                redirect(base_url() . "SubadminDashboard");
            } else if ($this->session->userdata("user_access") == "admin") {
//ADMIN!
//Do nothing!
            }
        }
    }

//------------ FUNCTIONS ----------------
    function getTextBetween($start, $end, $text) {
        $text = str_replace(" ", "", $text);
// explode the start string
        $holder = explode($start, $text, 2);
        $first_strip = end($holder);

// explode the end string
        $final_strip = explode($end, $first_strip)[0];
        return $final_strip;
    }

    function _alpha_dash_space($str) {
        if (!preg_match("/^([-a-z_ ])+$/i", $str)) {
            $this->form_validation->set_message('_alpha_dash_space', 'The {field} may only contain alphabet characters, spaces, underscores, and dashes.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function index() {
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $all_animals = $this->PetManagement_model->get_all_animals();
        $data = array(
            'title' => "Pet Management",
            'all_animals' => $all_animals,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("pet_management/main");
        $this->load->view("dashboard/includes/footer");
    }

    public function medical_records_exec() {
        $this->session->set_userdata("medical_records", $this->uri->segment(3));
        redirect(base_url() . "PetManagement/medical_records");
    }

    public function medical_records() {
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $animal_id = $this->session->userdata("medical_records");
        $animal_medical_records = $this->PetManagement_model->get_animal_medical_records(array("medical_record.pet_id" => $animal_id));
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        $data = array(
            'title' => $animal->pet_name . " | Medical Records",
            'animal_medical_records' => $animal_medical_records,
            'animal' => $animal,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("medical_records/medical_records");
        $this->load->view("dashboard/includes/footer");
    }

    public function add_medical_record_exec() {
        $animal_id = $this->uri->segment(3);
        $this->form_validation->set_rules('medicalRecord_date', "Date ", "required");
        $this->form_validation->set_message('required', 'The {field} field is required');
        $this->form_validation->set_rules('medicalRecord_weight', "Weight ", "numeric|required");
        $this->form_validation->set_message('numeric', 'The {field} must be numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->medical_records();
        } else {
            $medical_record = array(
                "pet_id" => $animal_id,
                "medicalRecord_date" => strtotime($this->input->post("medicalRecord_date")),
                "medicalRecord_weight" => $this->input->post("medicalRecord_weight"),
                "medicalRecord_diagnosis" => $this->input->post("medicalRecord_diagnosis"),
                "medicalRecord_treatment" => $this->input->post("medicalRecord_treatment")
            );
            if ($this->PetManagement_model->add_medical_record($medical_record)) {
//SUCCESS
                $animal = $this->PetManagement_model->get_animal_info(array("pet_id"=>$animal_id))[0];
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Added a medical record for ".$animal->pet_name);
                $this->session->set_flashdata("add_medical_record_success", "Successfully added a medical record for ".$animal->pet_name);
            } else {
//FAILED
                $this->session->set_flashdata("add_medical_record_fail", "Something went wrong in adding a medical record.");
            }
            redirect(base_url() . "PetManagement/medical_records");
        }
    }

    public function remove_medical_record_exec() {
        $record_id = $this->uri->segment(3);
        if ($this->PetManagement_model->remove_medical_record(array("medicalRecord_id" => $record_id))) {
            $record = $this->PetManagement_model->get_animal_medical_records(array("medicalRecord_id" => $record_id))[0];
            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Added a medical record for ".$record->pet_name);
            $this->session->set_flashdata("remove_medical_record_success", "Successfully removed a medical record from ".$record->pet_name);
        } else {
            $this->session->set_flashdata("remove_medical_record_fail", "Something went wrong while removing the medical record from ".$record->pet_name);
        }
        redirect(base_url() . "PetManagement/medical_records");
    }

    public function edit_medical_record_exec() {
        $animal_id = $this->uri->segment(3);
        $record_id = $this->uri->segment(4);
        $this->session->set_userdata("animal_id", $animal_id);
        $this->session->set_userdata("medical_record_id", $record_id);
        redirect(base_url() . "PetManagement/edit_medical_record");
    }

    public function edit_medical_record() {
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
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("medical_records/edit_medical_record");
        $this->load->view("dashboard/includes/footer");
    }

    public function edit_medical_record_submit() {
        $this->form_validation->set_rules('medicalRecord_date', "Date ", "required");
        $this->form_validation->set_message('required', 'The {field} field is required');
        $this->form_validation->set_rules('medicalRecord_weight', "Weight ", "numeric|required");
        $this->form_validation->set_message('numeric', 'The {field} must be numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_medical_record();
        } else {
            $animal_id = $this->session->userdata("animal_id");
            $record_id = $this->session->userdata("medical_record_id");
            $medical_record = array(
                "pet_id" => $this->session->userdata("animal_id"),
                "medicalRecord_date" => strtotime($this->input->post("medicalRecord_date")),
                "medicalRecord_weight" => $this->input->post("medicalRecord_weight"),
                "medicalRecord_diagnosis" => $this->input->post("medicalRecord_diagnosis"),
                "medicalRecord_treatment" => $this->input->post("medicalRecord_treatment")
            );
            if ($this->PetManagement_model->edit_medical_record($medical_record, array("medicalRecord_id" => $record_id))) {
//SUCCESS       
                $record = $this->PetManagement_model->get_animal_medical_records(array("medicalRecord_id" => $record_id))[0];
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "edited a medical record from ".$record->pet_name);
                $this->session->set_flashdata("edit_medical_record_success", "Successfully edited a medical record.");
            } else {
//FAILED
                $this->session->set_flashdata("edit_medical_record_fail", "Something went wrong in editing a medical record.");
            }
            redirect(base_url() . "PetManagement/medical_records_exec/" . $animal_id);
        }
    }

    public function animal_info_exec() {
        $this->session->set_userdata("animal_info", $this->uri->segment(3));
        redirect(base_url() . "PetManagement/animal_info");
    }

    public function animal_info() {
        $animal_id = $this->session->userdata("animal_info");
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => $animal->pet_name . " | Pet Information",
            'animal' => $animal,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("pet_management/animal_information");
        $this->load->view("dashboard/includes/footer");
    }

    public function edit_animal_info_exec() {
        header('X-XSS-Protection:0');
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $this->uri->segment(3)))[0];
        $this->form_validation->set_rules('pet_name', "Pet Name", "required|callback__alpha_dash_space|max_length[25]");
        $this->form_validation->set_rules('pet_breed', "Pet Breed", "required|callback__alpha_dash_space|min_length[3]");
        $this->form_validation->set_rules('pet_description', "Pet Description", "required");
        $this->form_validation->set_rules('pet_video', "Pet Video", "regex_match[/embed\/([\w+\-+]+)[\"\?]/]");

        if ($this->form_validation->run() == FALSE) {
            //ERROR IN FORM
            $this->animal_info();
        } else {
            $config['upload_path'] = './images/animal/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_ext_tolower'] = true;
            $config['max_size'] = 5120;
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);

            if (!empty($_FILES["pet_picture"]["name"])) {
                if ($this->upload->do_upload('pet_picture')) {
                    $imagePath = "images/animal/" . $this->upload->data("file_name");
                    unlink($animal->pet_picture);
                } else {
                    echo $this->upload->display_errors();
                    $this->session->set_flashdata("uploading_error", "Please make sure that the max size is 5MB the types may only be .jpg, .jpeg, .gif, .png");
                }
            } else {
//DO METHOD WITHOUT PICTURE PROVIDED
                if ($animal->pet_picture == "images/animal/dog_temp_pic.png" || $animal->pet_picture == "images/animal/cat_temp_pic.png") {
                    if ($this->input->post('pet_specie') == "canine") {
                        $imagePath = "images/animal/dog_temp_pic.png";
                    } else {
                        $imagePath = "images/animal/cat_temp_pic.png";
                    }
                } else {
                    $imagePath = $animal->pet_picture;
                }
            }
            
            if($this->input->post("pet_video") == "" || $this->input->post("pet_video") == NULL){
                $pet_video = $animal->pet_video;
            }else{
                $pet_video = $this->getTextBetween('src="', '"', $this->input->post("pet_video"));
            }
            
            $pet = array(
                'pet_name' => $this->input->post("pet_name"),
                'pet_bday' => strtotime($this->input->post("pet_bday")),
                'pet_specie' => $this->input->post("pet_specie"),
                'pet_sex' => $this->input->post("pet_sex"),
                'pet_breed' => $this->input->post("pet_breed"),
                'pet_size' => $this->input->post("pet_size"),
                'pet_status' => $this->input->post("pet_status"),
                'pet_neutered_spayed' => $this->input->post("pet_neutered_spayed"),
                'pet_admission' => $this->input->post("pet_admission"),
                'pet_description' => $this->input->post("pet_description"),
                'pet_history' => $this->input->post("pet_history"),
                'pet_picture' => $imagePath,
                'pet_video' => $pet_video,
                'pet_updated_at' => time()
            );

            if ($this->PetManagement_model->update_animal_record($pet, array("pet_id" => $animal->pet_id))) {
//SUCCESS
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Updated the record of " . $animal->pet_name);
                $this->session->set_flashdata("uploading_success", "Successfully updated the record of " . $animal->pet_name);
            } else {
                $this->session->set_flashdata("uploading_fail2", $animal->pet_name . " seems to not exist in the database.");
            }
            redirect(base_url() . "PetManagement/animal_info");
        }
    }

    public function remove_animal_exec() {
        $animal_id = $this->uri->segment(3);
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        if ($this->PetManagement_model->remove_animal(array("pet_id" => $animal_id))) {
            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Removed ".$animal->pet_name." from the database");
            $this->session->set_flashdata("remove_animal_success", "Successfully removed " . $animal->pet_name . " from the database. Bye " . $animal->pet_name . "!");
        } else {
            $this->session->set_flashdata("remove_animal_fail", "Something went wrong while removing " . $animal->pet_name . " from the database");
        }
        redirect(base_url() . "PetManagement");
    }

    public function add_animal() {
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Animal Registration",
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("pet_management/animal_registration");
        $this->load->view("dashboard/includes/footer");
    }

    public function register_animal() {
        header('X-XSS-Protection:0');
        $this->form_validation->set_rules('pet_name', "Pet Name", "required|callback__alpha_dash_space|max_length[25]");
        $this->form_validation->set_rules('pet_breed', "Pet Breed", "required|callback__alpha_dash_space|min_length[3]");
        $this->form_validation->set_rules('pet_description', "Pet Description", "required");
        $this->form_validation->set_rules('pet_history', "Pet History", "required");
        $this->form_validation->set_rules('pet_video', "Pet Video", "required|regex_match[/embed\/([\w+\-+]+)[\"\?]/]");
        if ($this->form_validation->run() == FALSE) {
            
            //$this->add_animal();
        } else {
            $config['upload_path'] = './images/animal/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_ext_tolower'] = true;
            $config['max_size'] = 5120;
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);

            if (!empty($_FILES["pet_picture"]["name"])) {
                if ($this->upload->do_upload('pet_picture')) {
                    $imagePath = "images/animal/" . $this->upload->data("file_name");
                } else {
                    echo $this->upload->display_errors();
                    $this->session->set_flashdata("uploading_error", "Please make sure that the max size is 5MB the types may only be .jpg, .jpeg, .gif, .png");
                    redirect(base_url() . "PetManagement/");
                }
            } else {
//DO METHOD WITHOUT PICTURE PROVIDED
                if ($this->input->post('pet_specie') == "canine") {
                    $imagePath = "images/animal/dog_temp_pic.png";
                } else {
                    $imagePath = "images/animal/cat_temp_pic.png";
                }
            }

            $pet = array(
                'pet_name' => $this->input->post("pet_name"),
                'pet_bday' => strtotime($this->input->post("pet_bday")),
                'pet_specie' => $this->input->post("pet_specie"),
                'pet_sex' => $this->input->post("pet_sex"),
                'pet_breed' => $this->input->post("pet_breed"),
                'pet_size' => $this->input->post("pet_size"),
                'pet_status' => $this->input->post("pet_status"),
                'pet_neutered_spayed' => $this->input->post("pet_neutered_spayed"),
                'pet_admission' => $this->input->post("pet_admission"),
                'pet_description' => $this->input->post("pet_description"),
                'pet_history' => $this->input->post("pet_history"),
                'pet_picture' => $imagePath,
                'pet_video' => $this->getTextBetween('src="', '"', $this->input->post("pet_video")),
                'pet_added_at' => time(),
                'pet_updated_at' => time()
            );

            if ($this->PetManagement_model->register_animal_record($pet)) {
//SUCCESS
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Registered " . $pet->pet_name. " to the database");
                $this->session->set_flashdata("registration_success", "Successfully registered " . $pet->pet_name. " to the database");
            } else {
                $this->session->set_flashdata("registration_fail", "Something went wrong while registering " . $pet->pet_name . " to the database");
            }
            redirect(base_url() . "PetManagement/");
        }
    }

    public function interested_adopters_exec() {
        $this->session->set_userdata("interested_adopters", $this->uri->segment(3));
        redirect(base_url() . "PetManagement/interested_adopters");
    }
    
    public function interested_adopters() {
        $animal_id = $this->session->userdata("interested_adopters");
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $active_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.pet_id" => $animal_id));
        $not_active_transaction = $this->PetManagement_model->get_not_active_transactions(array("transaction.pet_id" => $animal_id));
        $data = array(
            'title' => $animal->pet_name . " | Interested Adopters",
            'animal' => $animal,
            'active_transactions' => $active_transaction,
            'not_active_transactions' => $not_active_transaction,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("pet_management/interested_adopters");
        $this->load->view("dashboard/includes/footer");
    }
    
    public function adoption_information_exec() {
        $this->session->set_userdata("adoption_information", $this->uri->segment(3));
        redirect(base_url() . "PetManagement/adoption_information");
    }
    
    public function adoption_information() {
        $animal_id = $this->session->userdata("adoption_information");
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $animal_id))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $finished_transaction = $this->PetManagement_model->get_finished_transaction(array("transaction.pet_id" => $animal_id));
        $data = array(
            'title' => $animal->pet_name . " | Interested Adopters",
            'animal' => $animal,
            'finished_transaction' => $finished_transaction,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("pet_management/adoption_information");
        $this->load->view("dashboard/includes/footer");
    }
    
    public function restore_transaction_exec() {
        $transaction_id = $this->uri->segment(3);
        $transaction_user_id = $this->uri->segment(4);
        $transaction_user = $this->ManageUsers_model->get_users("user", array("user_id" => $transaction_user_id))[0];
        if ($this->PetManagement_model->restore_transaction(array("transaction_id" => $transaction_id))) {
            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Restored the transaction of " . $transaction_user->user_firstname . " " . $transaction_user->user_lastname);
            $this->session->set_flashdata("restore_success", "Successfully restored the transaction of " . $transaction_user->user_firstname . " " . $transaction_user->user_lastname);
        } else {
            $this->session->set_flashdata("restore_fail", "Something went wrong while restoring the transaction of " . $transaction_user->user_firstname . " " . $transaction_user->user_lastname);
        }
        redirect(base_url() . "PetManagement/interested_adopters_exec/" . $this->session->userdata("interested_adopters"));
    }

    public function drop_transaction_exec() {
        $transaction_id = $this->uri->segment(3);
        $transaction_user_id = $this->uri->segment(4);
        $transaction_user = $this->ManageUsers_model->get_users("user", array("user_id" => $transaction_user_id))[0];
        if ($this->PetManagement_model->drop_transaction(array("transaction_id" => $transaction_id))) {
            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Dropped the transaction of " . $transaction_user->user_firstname . " " . $transaction_user->user_lastname);
            $this->session->set_flashdata("drop_success", "Dropped the transaction of " . $transaction_user->user_firstname . " " . $transaction_user->user_lastname);
        } else {
            $this->session->set_flashdata("drop_fail", "Something went wrong while dropping the transaction of " . $transaction_user->user_firstname . " " . $transaction_user->user_lastname);
        }
        redirect(base_url() . "PetManagement/interested_adopters_exec/" . $this->session->userdata("interested_adopters"));
    }

    public function manage_progress_exec() {
        $transaction_id = $this->uri->segment(3);
        $current_transaction = $this->PetManagement_model->get_transaction(array("transaction.transaction_id" => $transaction_id));
        $this->session->set_userdata("manage_progress_transaction_id", $transaction_id);
        $this->session->set_userdata("pet_status", $current_transaction->pet_status);
        redirect(base_url() . "ManageProgress");
    }

}
