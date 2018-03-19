<?php

class Register extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        //$this->load->model('register_model');
        //---> LIBRARIES HERE!
        //$this->load->library('email');
        //---> SESSIONS HERE!
    }

    function _alpha_dash_space($str = '') {
        if (!preg_match("/^([-a-z_ ])+$/i", $str)) {
            $this->form_validation->set_message('_alpha_dash_space', 'The {field} may only contain alphabet characters, spaces, underscores, and dashes.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _accept_terms() {
        //if (isset($_POST['accept_terms_checkbox']))
        if ($this->input->post('accept') == 1) {
            return TRUE;
        } else {
            $error = 'Please read and accept our terms and conditions.';
            $this->form_validation->set_message('_accept_terms', $error);
            return FALSE;
        }
    }

    public function index() {
        $data = array(
            'title' => 'Pet Ex | Register',
            'script' => $this->recaptcha->getScriptTag(),
            'widget' => $this->recaptcha->getWidget(),
        );
        $this->load->view("register/includes/header", $data);
        $this->load->view("register/register");
        $this->load->view("register/includes/footer");
    }

    public function register_exec() {
        $this->form_validation->set_rules("username", "Username", "required|min_length[5]|is_unique[user.user_username]");
        $this->form_validation->set_rules("password", "Password", "required|matches[conpassword]|min_length[8]");
        $this->form_validation->set_rules("conpassword", "Confirm Password", "required|matches[password]|min_length[8]");
        $this->form_validation->set_rules("email", "Email", "required|valid_email");
        $this->form_validation->set_rules("phone", "Mobile Phone No.", "required|numeric|regex_match[^(09|\+639)\d{9}$^]");
        $this->form_validation->set_rules("lname", "Lastname", "required|min_length[2]|callback__alpha_dash_space");
        $this->form_validation->set_rules("fname", "Firstname", "required|min_length[2]|callback__alpha_dash_space");
        $this->form_validation->set_rules("bday", "Birthday", "required");
        $this->form_validation->set_rules("address", "Address", "required");
        $this->form_validation->set_rules('g-recaptcha-response', "CAPTCHA", "required|callback_check_recaptcha");
        $this->form_validation->set_rules('accept', 'Accept', 'callback__accept_terms');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Pet Ex | Register',
                'script' => $this->recaptcha->getScriptTag(),
                'widget' => $this->recaptcha->getWidget(),
            );
            $this->load->view("register/includes/header", $data);
            $this->load->view("register/register");
            $this->load->view("register/includes/footer");
        } else {
            //Do Some Registering
            if ($this->input->post('gender') == "Male") {
                $imagePath = "images/user/male.png";
            } else {
                $imagePath = "images/user/female.png";
            }

            $data = array(
                'user_username' => $this->input->post('username'),
                'user_password' => sha1($this->input->post('password')),
                'user_contact_no' => $this->input->post('phone'),
                'user_email' => $this->input->post('email'),
                'user_lastname' => $this->input->post('lname'),
                'user_firstname' => $this->input->post('fname'),
                'user_bday' => strtotime($this->input->post('bday')),
                'user_status' => 1,
                'user_sex' => $this->input->post('gender'),
                'user_picture' => $imagePath,
                'user_address' => $this->input->post('address'),
                'user_verification_code' => $this->generate(),
                'user_added_at' => time(),
                'user_updated_at' => time()
            );

            if ($this->Register_model->insert("user", $data)) {
                $data += ["title" => "Verify your Email"];
                $data += ["status" => "success"];
                $this->sendemail($data);

                $this->load->view("register/includes/header", $data);
                $this->load->view("register/verify_page");
                $this->load->view("register/includes/footer");
            } else {
                $data = array(
                    "title" => "Verify your Email",
                    "status" => "failed"
                );
                $this->load->view("register/includes/header", $data);
                $this->load->view("register/verify_page");
                $this->load->view("register/includes/footer");
            }
        }
    }

    public function check_recaptcha($response) {
        if (!empty($response)) {
            //this function gets the response from the google's api
            $response = $this->recaptcha->verifyResponse($response);
            if ($response['success'] === TRUE) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function generate() {
        $this->load->helper('string');
        return random_string('alnum', rand(5, 15));
    }

    public function sendemail($user) {
        $this->email->from("codebusters.solutions@gmail.com", 'Codebusters Team');
        $this->email->to($user['user_email']);
        $this->email->subject('Email Verification');
        $data = array('name' => $user['user_firstname'], 'code' => $user['user_verification_code']);
        $this->email->message($this->load->view('register/verifyMessage', $data, true));

        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        } else {
            //VERIFY YOUR EMAIL
            //echo $this->email->print_debugger();
        }
    }

    public function verifyCode() {
        $code = $this->uri->segment(3);
        $this->Register_model->update('user', array('user_isverified' => '1'), array('user_verification_code' => $code));
        $data = array(
            "title" => "Welcome to new user!"
        );
        $this->load->view("register/includes/header", $data);
        $this->load->view("register/is_verified");
        $this->load->view("register/includes/footer");
    }

    public function terms() {
        $data = array(
            'title' => 'Pet Ex | Terms and Conditions',
        );
        $this->load->view("register/includes/header", $data);
        $this->load->view("register/terms");
        $this->load->view("register/includes/footer");
    }

}
