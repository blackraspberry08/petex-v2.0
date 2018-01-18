<?php

class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('Profile_model');
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

    //------------ FUNCTIONS ----------------

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
            'title' => "Profile | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User",
            'userDetails' => $userDetails
        );
        $this->load->view("profile/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("profile/main");
        $this->load->view("profile/includes/footer");
    }

    public function edit_profile() {
        $userDetails = $this->Profile_model->fetch("user", array("user_id" => $this->session->userdata("userid")))[0];
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Edit Profile | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User",
            'userDetails' => $userDetails
        );
        $this->load->view("profile/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("profile/edit_profile");
        $this->load->view("profile/includes/footer");
    }

    public function edit_picture_submit() {
        $userDetails = $this->Profile_model->fetch("user", array("user_id" => $this->session->userdata("userid")))[0];

        $config['upload_path'] = './images/user/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_ext_tolower'] = true;
        $config['max_size'] = 5120;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        if (!empty($_FILES["user_picture"]["name"])) {
            if ($this->upload->do_upload('user_picture')) {
                $imagePath = "images/user/" . $this->upload->data("file_name");
                unlink($userDetails->user_picture);
            } else {
                echo $this->upload->display_errors();
                $this->session->set_flashdata("uploading_error", "Please make sure that the max size is 5MB the types may only be .jpg, .jpeg, .gif, .png");
            }
        } else {
            //DO METHOD WITHOUT PICTURE PROVIDED
            if ($userDetails->user_picture == "images/user/male.png" || $userDetails->user_picture == "images/user/female.png") {
                if ($this->input->post('user_sex') == "Male") {
                    $imagePath = "images/user/male.png";
                } else {
                    $imagePath = "images/user/female.png";
                }
            } else {
                $imagePath = $userDetails->user_picture;
            }
        }
        $data = array(
            'user_picture' => $imagePath,
            'user_updated_at' => time()
        );

        if ($this->Profile_model->update_user_record($data, array("user_id" => $userDetails->user_id))) {
            //SUCCESS
            $this->session->set_flashdata("uploading_success", "Successfully update the image");
        } else {
            
        }
        redirect(base_url() . "Profile/");
    }

    public function edit_personalInfo_submit() {
        $userDetails = $this->Profile_model->fetch("user", array("user_id" => $this->session->userdata("userid")))[0];
        $this->form_validation->set_rules('user_firstname', "Firstname", "required|callback__alpha_dash_space|min_length[2]");
        $this->form_validation->set_rules('user_lastname', "Lastname", "required|callback__alpha_dash_space|min_length[2]");
        $this->form_validation->set_rules('user_address', "Address", "required|regex_match[/^[a-zA-Z]+\ +[0-9]+$/]");
        $this->form_validation->set_rules('user_brgy', "Barangay", "required|callback__alpha_dash_space|min_length[2]");
        $this->form_validation->set_rules('user_city', "City", "required|callback__alpha_dash_space|min_length[2]");
        if ($this->form_validation->run() == FALSE) {
            //ERROR IN FORM
            $this->edit_profile();
        } else {
            $data = array(
                'user_firstname' => $this->input->post("user_firstname"),
                'user_lastname' => $this->input->post("user_lastname"),
                'user_sex' => $this->input->post("user_sex"),
                'user_bday' => strtotime($this->input->post('user_bday')),
                'user_address' => $this->input->post("user_address"),
                'user_brgy' => $this->input->post("user_brgy"),
                'user_city' => $this->input->post("user_city"),
                'user_updated_at' => time()
            );

            if ($this->Profile_model->update_user_record($data, array("user_id" => $userDetails->user_id))) {
                //SUCCESS
                $this->session->set_flashdata("uploading_success", "Successfully update the record of " . $userDetails->user_lastname);
            } else {
                $this->session->set_flashdata("uploading_fail2", $userDetails->user_lastname . " seems to not exist in the database.");
            }
            redirect(base_url() . "Profile/");
        }
    }

    public function edit_loginInfo_submit() {
        $userDetails = $this->Profile_model->fetch("user", array("user_id" => $this->session->userdata("userid")))[0];
        if (!empty($this->input->post('user_password'))) {

            $data = array(
                'user_username' => $this->input->post("user_username"),
                'user_password' => $this->input->post("user_password"),
                'user_updated_at' => time()
            );

            if ($this->Profile_model->update_user_record($data, array("user_id" => $userDetails->user_id))) {
                //SUCCESS
                $this->session->set_flashdata("uploading_success", "Successfully update the record of " . $userDetails->user_lastname);
            } else {
                $this->session->set_flashdata("uploading_fail2", $userDetails->user_lastname . " seems to not exist in the database.");
            }
            redirect(base_url() . "Profile/");
        } else {
            $data = array(
                'user_username' => $this->input->post("user_username"),
                'user_updated_at' => time()
            );

            if ($this->Profile_model->update_user_record($data, array("user_id" => $userDetails->user_id))) {
                //SUCCESS
                $this->session->set_flashdata("uploading_success", "Successfully update the record of " . $userDetails->user_lastname);
            } else {
                $this->session->set_flashdata("uploading_fail2", $userDetails->user_lastname . " seems to not exist in the database.");
            }
            redirect(base_url() . "Profile/");
        }
    }

}
