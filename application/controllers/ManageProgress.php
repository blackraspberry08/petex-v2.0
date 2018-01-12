<?php

class ManageProgress extends CI_Controller {
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
        $transaction_id = $this->session->userdata("manage_progress_transaction_id");
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id));
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => $current_transaction->user_firstname." ".$current_transaction->user_lastname." | Manage Progress",
            'transaction' => $current_transaction,
            'progresses' => $progress,
            //NAV INFO
            'user_name' => $current_user->admin_firstname." ".$current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("manage_progress/main");
        $this->load->view("dashboard/includes/footer");
    }
}


