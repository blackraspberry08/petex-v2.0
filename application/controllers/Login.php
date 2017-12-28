<?php

class Login extends CI_Controller {

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
            echo "<script>alert('Account Failed');"
            . "window.location='" . base_url() . "main'</script>";
        } else {
            $accountDetailsAdmin = $accountDetailsAdmin[0];
            $accountDetailsUser = $accountDetailsUser[0];
            if ($accountDetailsUser->user_access == "User") {
                if ($accountDetailsUser->user_status == 0) {
                    //OOPS user is blocked by the admin. Please contact the admin.
                    echo "<script>alert('Account is Blocked!');"
                    . "window.location='" . base_url() . "main/'</script>";
                } else {
                    if ($accountDetailsUser->user_isverified == 0) {
                        //OOPS user is not verified yet.
                        echo "<script>alert('Account is not yet verified');"
                        . "window.location='" . base_url() . "main/'</script>";
                    } else {
                        $this->session->set_userdata('isloggedin', true);
                        $this->session->set_userdata('userid', $accountDetailsUser->user_id);
                        redirect(base_url() . 'UserDashboard/');
                    }
                }
            } else if ($accountDetailsUser->user_access == "Subadmin") {
                if ($accountDetailsUser->user_status == 0) {
                    //OOPS user is blocked by the admin. Please contact the admin.
                    echo "<script>alert('Account is Blocked!');"
                    . "window.location='" . base_url() . "main/'</script>";
                } else {
                    if ($accountDetailsUser->user_isverified == 0) {
                        //OOPS user is not verified yet.
                        echo "<script>alert('Account is not yet verified');"
                        . "window.location='" . base_url() . "main/'</script>";
                    } else {
                        $this->session->set_userdata('isloggedin', true);
                        $this->session->set_userdata('userid', $accountDetailsUser->user_id);
                        redirect(base_url() . 'SubadminDashboard/');
                    }
                }
            } else {
                if ($accountDetailsAdmin->admin_status == 0) {
                    //OOPS user is blocked by the admin. Please contact the admin.
                    echo "<script>alert('Account is Blocked!');"
                    . "window.location='" . base_url() . "main/'</script>";
                } else {
                    if ($accountDetailsAdmin->admin_isverified == 0) {
                        //OOPS user is not verified yet.
                        echo "<script>alert('Account is not yet verified');"
                        . "window.location='" . base_url() . "main/'</script>";
                    } else {
                        $this->session->set_userdata('isloggedin', true);
                        $this->session->set_userdata('userid', $accountDetailsAdmin->admin_id);
                        redirect(base_url() . 'AdminDashboard/');
                    }
                }
            }
        }
    }

}
