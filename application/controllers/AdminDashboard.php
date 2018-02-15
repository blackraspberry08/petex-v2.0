<?php

class AdminDashboard extends CI_Controller {
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
    
    public function index(){
        $adoptable_animals = $this->AdminDashboard_model->count_adoptable_animal();
        $non_adoptable_animals = $this->AdminDashboard_model->count_non_adoptable_animal();
        $deceased_animals = $this->AdminDashboard_model->count_deceased_animal();
        $removed_animals = $this->AdminDashboard_model->count_removed_animal();
        $adopted_animals = $this->AdminDashboard_model->count_adopted_animal();
        $pet_adopters = $this->AdminDashboard_model->count_pet_adopter();
        $transactions = $this->AdminDashboard_model->count_transaction();
        $users = $this->AdminDashboard_model->count_user();
        
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Dashboard",
            'trails' => $this->AuditTrail_model->get_audit_trail("event", "admin", "event.admin_id = admin.admin_id","user", "event.user_id = user.user_id", array("event_classification" => "trail")),
            'logs' => $this->UserLogs_model->get_userlogs("event", "admin", "event.admin_id = admin.admin_id", "user", "event.user_id = user.user_id", array("event_classification" => "log")),
            'adoptable_animals' => $adoptable_animals,
            'non_adoptable_animals' => $non_adoptable_animals,
            'deceased_animals' => $deceased_animals,
            'removed_animals' => $removed_animals,
            'adopted_animals' => $adopted_animals,
            'pet_adopters' => $pet_adopters,
            'transactions' => $transactions,
            'users' => $users,
            //NAV INFO
            'user_name' => $current_user->admin_firstname." ".$current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("dashboard/main");
        $this->load->view("dashboard/includes/footer");
    }
}


