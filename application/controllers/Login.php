<?php

class Login extends CI_Controller {
    /* =======================================
     * ERROR LOGS:
     * err_1        -   "Invalid Account"
     * err_2        -   "Account is blocked"
     * err_3        -   "Account is not yet verified"
     * err_4        -   "Login First"
     * err_5        -   "You are currently logged in as ????? "
     *  
      ======================================= */

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        $this->load->model('login_model');

        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
        if ($this->session->has_userdata('isloggedin') == TRUE) {
            $currentUserId = $this->session->userdata('userid');
            $currentUser = $this->login_model->fetch("user", array("user_id" => $currentUserId))[0];
        }
    }

    public function index() {
        $data = array(
            'title' => 'Pet Ex | Pet Express Homepage',
            'wholeUrl' => base_url(uri_string())
        );
        $this->load->view("main/includes/header", $data);
        $this->load->view("main/main");
        $this->load->view("main/includes/footer");
    }

    public function login_exec() {

        $dataAdmin = array(
            'admin_username' => $this->input->post('username'),
            'admin_password' => $this->input->post('password'),
        );

        $accountDetailsAdmin = $this->login_model->getinfo("admin", $dataAdmin);

        $dataUser = array(
            'user_username' => $this->input->post('username'),
            'user_password' => $this->input->post('password'),
        );

        $accountDetailsUser = $this->login_model->getinfo("user", $dataUser);

        if (!$accountDetailsUser && !$accountDetailsAdmin) {
            //OOPS no accounts like that!
            $this->session->set_flashdata("err_1", "Invalid Account");
            redirect(base_url() . "main");
        } else {
            $accountDetailsAdmin = $accountDetailsAdmin[0];
            $accountDetailsUser = $accountDetailsUser[0];

            if ($accountDetailsAdmin->admin_access == "Admin") {
                if ($accountDetailsAdmin->admin_status == 0) {
                    //OOPS user is blocked by the admin. Please contact the admin.
                    $this->session->set_flashdata("err_2", "Account is blocked. Please contact the administrator to reactivate your account.");
                    redirect(base_url() . "main");
                } else {
                    if ($accountDetailsAdmin->admin_isverified == 0) {
                        //OOPS user is not verified yet.
                        $this->session->set_flashdata("err_3", "Account is not yet verified. Please verify your account through your email.");
                        redirect(base_url() . "main");
                    } else {
                        $this->session->set_userdata('isloggedin', true);
                        $this->session->set_userdata('userid', $accountDetailsAdmin->admin_id);
                        $this->session->set_userdata('current_user', $accountDetailsAdmin);
                        $this->session->set_userdata('user_access', "admin");
                        redirect(base_url() . 'AdminDashboard/');
                    }
                }
            } else if ($accountDetailsAdmin->admin_access == "Subadmin") {
                if ($accountDetailsAdmin->admin_status == 0) {
                    //OOPS user is blocked by the admin. Please contact the admin.
                    $this->session->set_flashdata("err_2", "Account is blocked. Please contact the administrator to reactivate your account.");
                    redirect(base_url() . "main");
                } else {
                    if ($accountDetailsAdmin->admin_isverified == 0) {
                        //OOPS user is not verified yet.
                        $this->session->set_flashdata("err_3", "Account is not yet verified. Please verify your account through your email.");
                        redirect(base_url() . "main");
                    } else {
                        $this->session->set_userdata('isloggedin', true);
                        $this->session->set_userdata('userid', $accountDetailsAdmin->admin_id);
                        $this->session->set_userdata('current_user', $accountDetailsAdmin);
                        $this->session->set_userdata('user_access', "subadmin");
                        redirect(base_url() . 'SubadminDashboard/');
                    }
                }
            } else {
                if ($accountDetailsUser->user_status == 0) {
                    //OOPS user is blocked by the admin. Please contact the admin.

                    $this->session->set_flashdata("err_2", "Account is blocked. Please contact the administrator to reactivate your account.");
                    redirect(base_url() . "main");
                } else {
                    if ($accountDetailsUser->user_isverified == 0) {
                        //OOPS user is not verified yet.
                        $this->session->set_flashdata("err_3", "Account is not yet verified. Please verify your account through your email.");
                        redirect(base_url() . "main");
                    } else {
                        $this->session->set_userdata('isloggedin', true);
                        $this->session->set_userdata('userid', $accountDetailsUser->user_id);
                        $this->session->set_userdata('current_user', $accountDetailsUser);
                        $this->session->set_userdata('user_access', "user");
                        redirect(base_url() . 'UserDashboard/');
                    }
                }
            }
        }
    }

}
