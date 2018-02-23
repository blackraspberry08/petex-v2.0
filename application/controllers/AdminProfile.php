<?php

class AdminProfile extends CI_Controller {

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

    public function index() {
        $manageUserModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 1));
        $manageOfficerModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 2));
        $petManagementModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 3));
        $scheduleModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 4));

        $userDetails = $this->Profile_model->fetch("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Edit Profile | " . $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'trails' => $this->AuditTrail_model->get_audit_trail("event", "admin", "event.admin_id = admin.admin_id", "user", "event.user_id = user.user_id", array("event_classification" => "trail", 'admin.admin_id' => $this->session->userid)),
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator",
            'userDetails' => $userDetails
        );
        $this->load->view("admin_profile/includes/header", $data);
        if ($current_user->admin_access == "Subadmin") {
            $this->load->view("subadmin_nav/navheader");
        } else {
            $this->load->view("admin_nav/navheader");
        }
        $this->load->view("admin_profile/main");
        $this->load->view("admin_profile/includes/footer");
    }

    public function edit_profile() {
        $manageUserModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 1));
        $manageOfficerModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 2));
        $petManagementModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 3));
        $scheduleModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 4));

        $userDetails = $this->Profile_model->fetch("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Edit Profile | " . $current_user->admin_firstname . " " . $current_user->admin_lastname,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator",
            'userDetails' => $userDetails
        );
        $this->load->view("admin_profile/includes/header", $data);
        if ($current_user->admin_access == "Subadmin") {
            $this->load->view("subadmin_nav/navheader");
        } else {
            $this->load->view("admin_nav/navheader");
        }
        $this->load->view("admin_profile/edit_profile");
        $this->load->view("admin_profile/includes/footer");
    }

    public function edit_picture_submit() {
        $userDetails = $this->Profile_model->fetch("admin", array("admin_id" => $this->session->userdata("userid")))[0];

        $config['upload_path'] = './images/user/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_ext_tolower'] = true;
        $config['max_size'] = 5120;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        if (!empty($_FILES["user_picture"]["name"])) {
            if ($this->upload->do_upload('user_picture')) {
                $imagePath = "images/user/" . $this->upload->data("file_name");
                unlink($userDetails->admin_picture);
            } else {
                echo $this->upload->display_errors();
                $this->session->set_flashdata("uploading_error", "Please make sure that the max size is 5MB the types may only be .jpg, .jpeg, .gif, .png");
            }
        } else {
            //DO METHOD WITHOUT PICTURE PROVIDED
            if ($userDetails->admin_picture == "images/user/male.png" || $userDetails->admin_picture == "images/user/female.png") {
                if ($this->input->post('user_sex') == "Male") {
                    $imagePath = "images/user/male.png";
                } else {
                    $imagePath = "images/user/female.png";
                }
            } else {
                $imagePath = $userDetails->admin_picture;
            }
        }
        $data = array(
            'admin_picture' => $imagePath,
            'admin_updated_at' => time()
        );

        if ($this->Profile_model->update_admin_record($data, array("admin_id" => $userDetails->admin_id))) {
            //SUCCESS
            $this->session->set_flashdata("uploading_success", "Successfully update the image");
            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Updated his profile picture");
        } else {
            
        }
        redirect(base_url() . "AdminProfile/");
    }

    public function edit_personalInfo_submit() {
        $userDetails = $this->Profile_model->fetch("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'admin_firstname' => $this->input->post("user_firstname"),
            'admin_lastname' => $this->input->post("user_lastname"),
            'admin_sex' => $this->input->post("user_sex"),
            'admin_bday' => strtotime($this->input->post('user_bday')),
            'admin_address' => $this->input->post("user_address"),
            'admin_brgy' => $this->input->post("user_brgy"),
            'admin_city' => $this->input->post("user_city"),
            'admin_updated_at' => time()
        );

        if ($this->Profile_model->update_admin_record($data, array("admin_id" => $userDetails->admin_id))) {
            //SUCCESS
            $this->session->set_flashdata("uploading_success", "Successfully update the record of " . $userDetails->user_lastname);
            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Updated his personal information");
        } else {
            $this->session->set_flashdata("uploading_fail2", $userDetails->user_lastname . " seems to not exist in the database.");
        }
        redirect(base_url() . "AdminProfile/");
    }

    public function edit_loginInfo_submit() {
        $userDetails = $this->Profile_model->fetch("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        if (!empty($this->input->post('user_password'))) {
            $data = array(
                'admin_username' => $this->input->post("user_username"),
                'admin_password' => $this->input->post("user_password"),
                'admin_updated_at' => time()
            );

            if ($this->Profile_model->update_admin_record($data, array("admin_id" => $userDetails->admin_id))) {
                //SUCCESS
                $this->session->set_flashdata("uploading_success", "Successfully update the record of " . $userDetails->admin_lastname);
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Updated his login information");
            } else {
                $this->session->set_flashdata("uploading_fail2", $userDetails->admin_lastname . " seems to not exist in the database.");
            }
            redirect(base_url() . "AdminProfile/");
        } else {
            $data = array(
                'user_username' => $this->input->post("admin_username"),
                'user_updated_at' => time()
            );

            if ($this->Profile_model->update_admin_record($data, array("admin_id" => $userDetails->admin_id))) {
                //SUCCESS
                $this->session->set_flashdata("uploading_success", "Successfully update the record of " . $userDetails->admin_lastname);
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Updated his login information");
            } else {
                $this->session->set_flashdata("uploading_fail2", $userDetails->admin_lastname . " seems to not exist in the database.");
            }
            redirect(base_url() . "AdminProfile/");
        }
    }

}
