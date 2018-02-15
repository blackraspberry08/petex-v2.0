<?php

class MyProgress extends CI_Controller {

    function __construct() {
        parent::__construct();

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

    public function index() {
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
        $transaction = $this->MyProgress_model->fetchJoinProgress(array('transaction.user_id' => $this->session->userdata("userid")))[0];
        $progress = $this->MyProgress_model->fetchJoinProgress(array('progress.transaction_id' => $transaction->transaction_id));
        $comments_step_1 = $this->MyProgress_model->get_comments(array("progress.checklist_id" => 1, "progress.transaction_id" => $transaction->transaction_id));
        $comments_step_2 = $this->MyProgress_model->get_comments(array("progress.checklist_id" => 2, "progress.transaction_id" => $transaction->transaction_id));
        $comments_step_3 = $this->MyProgress_model->get_comments(array("progress.checklist_id" => 3, "progress.transaction_id" => $transaction->transaction_id));
        $comments_step_4 = $this->MyProgress_model->get_comments(array("progress.checklist_id" => 4, "progress.transaction_id" => $transaction->transaction_id));
        $comments_step_5 = $this->MyProgress_model->get_comments(array("progress.checklist_id" => 5, "progress.transaction_id" => $transaction->transaction_id));
        $comments_step_6 = $this->MyProgress_model->get_comments(array("progress.checklist_id" => 6, "progress.transaction_id" => $transaction->transaction_id));
//        echo "<pre>";
//        print_r($transaction);
//        echo "</pre>";
//        die;

        $data = array(
            'title' => "My Progress | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            'progress' => $progress,
            'transaction' => $transaction,
            'transaction_progress' => $transaction->transaction_progress,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User",
            'comments_step_1' => $comments_step_1,
            'comments_step_2' => $comments_step_2,
            'comments_step_3' => $comments_step_3,
            'comments_step_4' => $comments_step_4,
            'comments_step_5' => $comments_step_5,
            'comments_step_6' => $comments_step_6,
        );
        $this->load->view("my_progress/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("my_progress/main");
        $this->load->view("my_progress/includes/footer");
    }

}
