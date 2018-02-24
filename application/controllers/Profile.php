<?php

class Profile extends CI_Controller {

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
        $alldogs = $this->Profile_model->fetchJoinThreeAdoptedDesc("adoption", "pet", "adoption.pet_id = pet.pet_id", "user", "adoption.user_id = user.user_id", $this->db->count_all_results(), array('user.user_id' => $this->session->userid, 'pet.pet_specie' => 'Canine'));
        $allcats = $this->Profile_model->fetchJoinThreeAdoptedDesc("adoption", "pet", "adoption.pet_id = pet.pet_id", "user", "adoption.user_id = user.user_id", $this->db->count_all_results(), array('user.user_id' => $this->session->userid, 'pet.pet_specie' => 'Feline'));
        $alltransactions = $this->Profile_model->fetch_all_transactions($this->db->count_all_results());
        $allmissing = $this->Profile_model->fetch("adoption", $this->db->count_all_results(), array('user_id' => $this->session->userid, 'adoption_isMissing' => '1'));
        $userDetails = $this->Profile_model->fetch("user", array("user_id" => $this->session->userdata("userid")))[0];
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Profile | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            'trails' => $this->AuditTrail_model->get_audit_trail("event", "admin", "event.admin_id = admin.admin_id", "user", "event.user_id = user.user_id", array("event_classification" => "trail", 'user.user_id' => $this->session->userid)),
            'dogs' => $alldogs,
            'cats' => $allcats,
            'missing' => $allmissing,
            'transactions' => $alltransactions,
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
                if ($userDetails->user_picture == "images/user/male.png" || $userDetails->user_picture == "images/user/female.png") {
                    
                } else {
                    unlink($userDetails->user_picture);
                }
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
            $this->SaveEventUser->trail($this->session->userdata("userid"), $userDetails->user_firstname . " change profile picture.");
            $this->session->set_flashdata("uploading_success", "Successfully update the image");
            redirect(base_url() . "Profile/edit_profile");
        } else {
            
        }
        redirect(base_url() . "Profile/");
    }

    public function edit_profile_submit() {
        $userDetails = $this->Profile_model->fetch("user", array("user_id" => $this->session->userdata("userid")))[0];
        $this->form_validation->set_rules('user_firstname', "Firstname", "required|callback__alpha_dash_space|min_length[2]");
        $this->form_validation->set_rules('user_lastname', "Lastname", "required|callback__alpha_dash_space|min_length[2]");
        $this->form_validation->set_rules('user_address', "Address", "required");
        $this->form_validation->set_rules("user_email", "Email", "required|valid_email");
        $this->form_validation->set_rules("user_contact_no", "Mobile Phone No.", "required|numeric|regex_match[^(09|\+639)\d{9}$^]");
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
                'user_contact_no' => $this->input->post("user_contact_no"),
                'user_email' => $this->input->post("user_email"),
                'user_updated_at' => time()
            );

            if ($this->Profile_model->update_user_record($data, array("user_id" => $userDetails->user_id))) {
                //SUCCESS
                $this->SaveEventUser->trail($this->session->userdata("userid"), $userDetails->user_firstname . " change account information.");
                $this->session->set_flashdata("uploading_success", "You have successfully changed your account information");
                redirect(base_url() . "Profile/edit_profile");
            } else {
                $this->session->set_flashdata("uploading_fail", $userDetails->user_lastname . " seems to not exist in the database.");
            }
            redirect(base_url() . "Profile/");
        }
    }

}
