<?php

class UserSettings extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> HELPERS HERE!
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

    function _alpha_dash_space($str = '') {
        if (!preg_match("/^([-a-z_ ])+$/i", $str)) {
            $this->form_validation->set_message('_alpha_dash_space', 'The {field} is not correct.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function index() {

        $userDetails = $this->Profile_model->fetch("user", array("user_id" => $this->session->userdata("userid")))[0];
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Settings | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User",
            'userDetails' => $userDetails
        );
        $this->load->view("user_settings/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("user_settings/main");
        $this->load->view("user_settings/includes/footer");
    }

    public function username_submit() {
        $userDetails = $this->Profile_model->fetch("user", array("user_id" => $this->session->userdata("userid")))[0];
        $this->form_validation->set_rules("user_username", "Username", "required|min_length[5]|is_unique[user.user_username]");
        if ($this->form_validation->run() == FALSE) {
            //ERROR IN FORM
            $this->index();
        } else {
            $data = array(
                'user_username' => $this->input->post("user_username"),
                'user_updated_at' => time()
            );

            if ($this->Profile_model->update_user_record($data, array("user_id" => $userDetails->user_id))) {
                //SUCCESS
                $this->SaveEventUser->trail($this->session->userdata("userid"), $userDetails->user_firstname . " changed username.");
                $this->session->set_flashdata("uploading_success", "You have successfully changed your username");
                redirect(base_url() . "UserSettings/");
            } else {
                $this->session->set_flashdata("uploading_fail", $userDetails->user_lastname . " seems to not exist in the database.");
            }
            redirect(base_url() . "UserSettings/");
        }
    }

    public function password_submit() {
        $userDetails = $this->Profile_model->fetch("user", array("user_id" => $this->session->userdata("userid")))[0];
        $this->form_validation->set_rules("user_password", "Password", "required|matches[user_conpassword]|alpha_numeric|min_length[8]");
        $this->form_validation->set_rules("user_conpassword", "Confirm Password", "required|matches[user_password]|alpha_numeric|min_length[8]");
        if ($this->form_validation->run() == FALSE) {
            //ERROR IN FORM
            $this->index();
        } else {
            $data = array(
                'user_password' => sha1($this->input->post("user_password")),
                'user_updated_at' => time()
            );

            if ($this->Profile_model->update_user_record($data, array("user_id" => $userDetails->user_id))) {
                //SUCCESS
                $this->SaveEventUser->trail($this->session->userdata("userid"), $userDetails->user_firstname . " changed password.");
                $this->session->set_flashdata("uploading_success", "You have successfully changed your password");
                redirect(base_url() . "UserSettings/");
            } else {
                $this->session->set_flashdata("uploading_fail", $userDetails->user_lastname . " seems to not exist in the database.");
            }
            redirect(base_url() . "UserSettings/");
        }
    }

}
