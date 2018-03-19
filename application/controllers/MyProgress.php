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
        $current_adoption_form = $this->ManageProgress_model->get_adoption_form(array("adoption_form.transaction_id" => $transaction->transaction_id))[0];
//        echo "<pre>";
//        print_r($current_adoption_form);
//        echo "</pre>";
//        die;
        if (empty($transaction)) {
            $data = array(
                'title' => "My Progress | " . $current_user->user_firstname . " " . $current_user->user_lastname,
                'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
                'user_picture' => $current_user->user_picture,
                'user_access' => "User",
            );
            $this->load->view("my_progress/includes/header", $data);
            $this->load->view("user_nav/navheader");
            $this->load->view("my_progress/main");
            $this->load->view("my_progress/includes/footer");
        } else {
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
                'adoption_form' => $current_adoption_form,
                'transaction_progress' => $transaction->transaction_progress,
                'comments_step_1' => $comments_step_1,
                'comments_step_2' => $comments_step_2,
                'comments_step_3' => $comments_step_3,
                'comments_step_4' => $comments_step_4,
                'comments_step_5' => $comments_step_5,
                'comments_step_6' => $comments_step_6,
                //NAV INFO
                'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
                'user_picture' => $current_user->user_picture,
                'user_access' => "User",
            );
            $this->load->view("my_progress/includes/header", $data);
            $this->load->view("user_nav/navheader");
            $this->load->view("my_progress/main");
            $this->load->view("my_progress/includes/footer");
        }
    }

    public function step1_comment_exec() {
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
//        echo "<pre>";
//        print_r($current_user);
//        echo "</pre>";
//        die;
        $progress_id = $this->uri->segment(3);
        $data = array(
            'progress_id' => $progress_id,
            "progress_comment_sender" => $current_user->user_firstname . " " . $current_user->user_lastname,
            'progress_comment_picture' => $current_user->user_picture,
            'progress_comment_sender_access' => "User",
            'progress_comment_content' => $this->input->post("date_step_1") . " " . $this->input->post("comment_step_1"),
            'progress_comment_added_at' => time()
        );
        if ($this->MyProgress_model->singleinsert("progress_comment", $data)) {
            $this->SaveEventUser->trail($this->session->userdata("userid"), $current_user->user_firstname . " sent a comment in Adoption Form progress");
            redirect(base_url() . "MyProgress");
        }
    }

    public function step2_comment_exec() {
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
//        echo "<pre>";
//        print_r($current_user);
//        echo "</pre>";
//        die;
        $progress_id = $this->uri->segment(3);
        $data = array(
            'progress_id' => $progress_id,
            "progress_comment_sender" => $current_user->user_firstname . " " . $current_user->user_lastname,
            'progress_comment_picture' => $current_user->user_picture,
            'progress_comment_sender_access' => "User",
            'progress_comment_content' => $this->input->post("date_step_2") . " " . $this->input->post("comment_step_2"),
            'progress_comment_added_at' => time()
        );
        if ($this->MyProgress_model->singleinsert("progress_comment", $data)) {
            $this->SaveEventUser->trail($this->session->userdata("userid"), $current_user->user_firstname . " sent a comment in Meet and Greet progress");
            redirect(base_url() . "MyProgress");
        }
    }

    public function step3_comment_exec() {
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
//        echo "<pre>";
//        print_r($current_user);
//        echo "</pre>";
//        die;
        $progress_id = $this->uri->segment(3);
        $data = array(
            'progress_id' => $progress_id,
            "progress_comment_sender" => $current_user->user_firstname . " " . $current_user->user_lastname,
            'progress_comment_picture' => $current_user->user_picture,
            'progress_comment_sender_access' => "User",
            'progress_comment_content' => $this->input->post("date_step_3") . " " . $this->input->post("comment_step_3"),
            'progress_comment_added_at' => time()
        );
        if ($this->MyProgress_model->singleinsert("progress_comment", $data)) {
            $this->SaveEventUser->trail($this->session->userdata("userid"), $current_user->user_firstname . " sent a comment in Interview progress");
            redirect(base_url() . "MyProgress");
        }
    }

    public function step4_comment_exec() {
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
//        echo "<pre>";
//        print_r($current_user);
//        echo "</pre>";
//        die;
        $progress_id = $this->uri->segment(3);
        $data = array(
            'progress_id' => $progress_id,
            "progress_comment_sender" => $current_user->user_firstname . " " . $current_user->user_lastname,
            'progress_comment_picture' => $current_user->user_picture,
            'progress_comment_sender_access' => "User",
            'progress_comment_content' => $this->input->post("date_step_4") . " " . $this->input->post("comment_step_4"),
            'progress_comment_added_at' => time()
        );
        if ($this->MyProgress_model->singleinsert("progress_comment", $data)) {
            $this->SaveEventUser->trail($this->session->userdata("userid"), $current_user->user_firstname . " sent a comment in Home Visit progress");
            redirect(base_url() . "MyProgress");
        }
    }

    public function step5_comment_exec() {
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
//        echo "<pre>";
//        print_r($current_user);
//        echo "</pre>";
//        die;
        $progress_id = $this->uri->segment(3);
        $data = array(
            'progress_id' => $progress_id,
            "progress_comment_sender" => $current_user->user_firstname . " " . $current_user->user_lastname,
            'progress_comment_picture' => $current_user->user_picture,
            'progress_comment_sender_access' => "User",
            'progress_comment_content' => $this->input->post("date_step_5") . " " . $this->input->post("comment_step_5"),
            'progress_comment_added_at' => time()
        );
        if ($this->MyProgress_model->singleinsert("progress_comment", $data)) {
            $this->SaveEventUser->trail($this->session->userdata("userid"), $current_user->user_firstname . " sent a comment in Visit Chosen Adoptee progress");
            redirect(base_url() . "MyProgress");
        }
    }

    public function step6_comment_exec() {
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
//        echo "<pre>";
//        print_r($current_user);
//        echo "</pre>";
//        die;
        $progress_id = $this->uri->segment(3);
        $data = array(
            'progress_id' => $progress_id,
            "progress_comment_sender" => $current_user->user_firstname . " " . $current_user->user_lastname,
            'progress_comment_picture' => $current_user->user_picture,
            'progress_comment_sender_access' => "User",
            'progress_comment_content' => $this->input->post("date_step_5") . " " . $this->input->post("comment_step_6"),
            'progress_comment_added_at' => time()
        );
        if ($this->MyProgress_model->singleinsert("progress_comment", $data)) {
            $this->SaveEventUser->trail($this->session->userdata("userid"), $current_user->user_firstname . " sent a comment in Release Day progress");
            redirect(base_url() . "MyProgress");
        }
    }

}
