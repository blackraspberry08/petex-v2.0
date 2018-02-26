<?php

class AdminSettings extends CI_Controller {

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
                $this->session->set_flashdata("err_5", "You are currently logged in as " . $current_user->user_firstname . " " . $current_user->user_lastname);
                redirect(base_url() . "UserDashboard");
            } else if ($this->session->userdata("user_access") == "subadmin") {
                //SUBADMIN!
            } else if ($this->session->userdata("user_access") == "admin") {
                //ADMIN!
                // Do Nothing
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
        $manageUserModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 1));
        $manageOfficerModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 2));
        $petManagementModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 3));
        $scheduleModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 4));

        $userDetails = $this->Profile_model->fetch("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Settings | " . $current_user->admin_firstname . " " . $current_user->admin_lastname,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator",
            'userDetails' => $userDetails
        );
        $this->load->view("admin_settings/includes/header", $data);
        if ($current_user->admin_access == "Subadmin") {
            $this->load->view("subadmin_nav/navheader");
        } else {
            $this->load->view("admin_nav/navheader");
        }
        $this->load->view("admin_settings/main");
        $this->load->view("admin_settings/includes/footer");
    }

    public function username_submit() {
        $userDetails = $this->Profile_model->fetch("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $this->form_validation->set_rules("admin_username", "Username", "required|min_length[5]|is_unique[admin.admin_username]");
        if ($this->form_validation->run() == FALSE) {
            //ERROR IN FORM
            $this->index();
        } else {
            $data = array(
                'admin_username' => $this->input->post("admin_username"),
                'admin_updated_at' => time()
            );

            if ($this->Profile_model->update_admin_record($data, array("admin_id" => $userDetails->admin_id))) {
                //SUCCESS
                $this->SaveEventUser->trail($this->session->userdata("userid"), $userDetails->admin_firstname . " changed username.");
                $this->session->set_flashdata("uploading_success", "You have successfully changed your username");
                redirect(base_url() . "AdminSettings/");
            } else {
                $this->session->set_flashdata("uploading_fail", $userDetails->admin_lastname . " seems to not exist in the database.");
            }
            redirect(base_url() . "AdminSettings/");
        }
    }

    public function password_submit() {
        $userDetails = $this->Profile_model->fetch("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $this->form_validation->set_rules("admin_password", "Password", "required|matches[admin_conpassword]|alpha_numeric|min_length[8]");
        $this->form_validation->set_rules("admin_conpassword", "Confirm Password", "required|matches[admin_password]|alpha_numeric|min_length[8]");
        if ($this->form_validation->run() == FALSE) {
            //ERROR IN FORM
            $this->index();
        } else {
            $data = array(
                'admin_password' => sha1($this->input->post("admin_password")),
                'admin_updated_at' => time()
            );

            if ($this->Profile_model->update_admin_record($data, array("admin_id" => $userDetails->admin_id))) {
                //SUCCESS
                $this->SaveEventUser->trail($this->session->userdata("userid"), $userDetails->admin_firstname . " changed password.");
                $this->session->set_flashdata("uploading_success", "You have successfully changed your password");
                redirect(base_url() . "AdminSettings/");
            } else {
                $this->session->set_flashdata("uploading_fail", $userDetails->admin_lastname . " seems to not exist in the database.");
            }
            redirect(base_url() . "AdminSettings/");
        }
    }

}
