<?php

class ManageOfficer extends CI_Controller {

    function __construct() {
        parent::__construct();
//---> MODELS HERE!
//---> LIBRARIES HERE!
//---> SESSIONS HERE!
        $manageOfficerModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 2));
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
                if (empty($manageOfficerModule)) {
                    $this->session->set_flashdata("err_5", "You have no access in Manage Officers Module.");
                    redirect(base_url() . "SubadminDashboard");
                }
            } else if ($this->session->userdata("user_access") == "admin") {
//ADMIN!
//Do nothing!
            }
        }
    }

    function _alpha_dash_space($str = '') {
        if (!preg_match("/^([-a-z_ ])+$/i", $str)) {
            $this->form_validation->set_message('_alpha_dash_space', 'The {field} may only contain alphabet characters, spaces, underscores, and dashes.');
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

        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            /* MODULE ACCESS */
            'manageUserModule' => $manageUserModule,
            'manageOfficerModule' => $manageOfficerModule,
            'petManagementModule' => $petManagementModule,
            'scheduleModule' => $scheduleModule,
            //////////////////////////////
            'current_user' => $current_user,
            'title' => "Manage Officer",
            'admins' => $this->ManageOfficer_model->get_admins($current_user->admin_id),
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        if ($current_user->admin_access == "Subadmin") {
            $this->load->view("subadmin_nav/navheader");
        } else {
            $this->load->view("admin_nav/navheader");
        }
        $this->load->view("manage_officer/main");
        $this->load->view("dashboard/includes/footer");
    }

    public function activate_officer_exec() {
        $this->session->set_userdata("activate_officer", $this->uri->segment(3));
        redirect(base_url() . "ManageOfficer/activate_officer");
    }

    public function activate_officer() {
        $user = $this->ManageOfficer_model->get_admin_deactivated(array("admin_id" => $this->session->userdata("activate_officer")))[0];

        if ($this->ManageOfficer_model->activate_admin("admin", array("admin_id" => $this->session->userdata("activate_officer")))) {
            $this->session->set_flashdata("activation_success", "Successfully activated " . $user->admin_firstname . " " . $user->admin_lastname . "'s account.");
            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Activated officer " . $user->admin_firstname . " " . $user->admin_lastname);
        } else {
            $this->session->set_flashdata("activation_fail", "Something went wrong while activating " . $user->admin_firstname . " " . $user->admin_lastname . "'s account.");
        }
        $this->session->unset_userdata("activate_officer");
        redirect(base_url() . "ManageOfficer");
    }

    public function deactivate_officer_exec() {
        $this->session->set_userdata("deactivate_officer", $this->uri->segment(3));
        redirect(base_url() . "ManageOfficer/deactivate_officer");
    }

    public function deactivate_officer() {
        $user = $this->ManageOfficer_model->get_admin_activated(array("admin_id" => $this->session->userdata("deactivate_officer")))[0];
        if ($this->ManageOfficer_model->deactivate_admin("admin", array("admin_id" => $this->session->userdata("deactivate_officer")))) {
            $this->session->set_flashdata("activation_success", "Successfully deactivated " . $user->admin_firstname . " " . $user->admin_lastname . "'s account.");
            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Deactivated officer " . $user->admin_firstname . " " . $user->admin_lastname);
        } else {
            $this->session->set_flashdata("activation_fail", "Something went wrong while deactivating " . $user->admin_firstname . " " . $user->admin_lastname . "'s account.");
        }
        $this->session->unset_userdata("deactivate_officer");
        redirect(base_url() . "ManageOfficer");
    }

    public function show_officer_info_exec() {
        $this->session->set_userdata("show_officer_info", $this->uri->segment(3));
        redirect(base_url() . "ManageOfficer/show_officer_info");
    }

    public function show_officer_info() {
        $manageUserModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 1));
        $manageOfficerModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 2));
        $petManagementModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 3));
        $scheduleModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 4));

        $selected_officer = $this->ManageUsers_model->get_user_info("admin", array("admin_id" => $this->session->userdata("show_officer_info")))[0];
        $officer_transaction = $this->ManageUsers_model->get_user_transactions(array("transaction.user_id" => $this->session->userdata("show_officer_info")));
        $officer_activity = $this->ManageUsers_model->get_user_activities(array("event.admin_id" => $this->session->userdata("show_officer_info")));
        $officer_modules = $this->ManageOfficer_model->get_officer_modules(array("module_access.admin_id" => $this->session->userdata("manage_module")));
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            /* MODULE ACCESS */
            'manageUserModule' => $manageUserModule,
            'manageOfficerModule' => $manageOfficerModule,
            'petManagementModule' => $petManagementModule,
            'scheduleModule' => $scheduleModule,
            //////////////////////////////
            "title" => $selected_officer->admin_firstname . " " . $selected_officer->admin_lastname . " | Information",
            "officer" => $selected_officer,
            "transactions" => $officer_transaction,
            "activities" => $officer_activity,
            "module_access" => $officer_modules,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        if ($current_user->admin_access == "Subadmin") {
            $this->load->view("subadmin_nav/navheader");
        } else {
            $this->load->view("admin_nav/navheader");
        }
        $this->load->view("manage_officer/show_officer_information");
        $this->load->view("dashboard/includes/footer");
    }

    public function manage_module_exec() {

        $this->session->set_userdata("manage_module", $this->uri->segment(3));
        redirect(base_url() . "ManageOfficer/manage_module");
    }

    public function manage_module() {

        $manageUserModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 1));
        $manageOfficerModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 2));
        $petManagementModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 3));
        $scheduleModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 4));
        $selected_officer = $this->ManageOfficer_model->get_subadmin($this->session->userdata("manage_module"))[0];

        $officer_modules = $this->ManageOfficer_model->get_officer_modules(array("module_access.admin_id" => $this->session->userdata("manage_module")));
//
//        echo "<pre>";
//        print_r($selected_officer);
//        echo "</pre>";
//        die;
        $modules = $this->ManageOfficer_model->get_modules();
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];

        $data = array(
            /* MODULE ACCESS */
            'manageUserModule' => $manageUserModule,
            'manageOfficerModule' => $manageOfficerModule,
            'petManagementModule' => $petManagementModule,
            'scheduleModule' => $scheduleModule,
            //////////////////////////////
            'title' => $selected_officer->admin_firstname . " " . $selected_officer->admin_lastname . " | Module Access",
            'officer' => $selected_officer,
            'officer_modules' => $officer_modules,
            'modules' => $modules,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );

        $this->load->view("dashboard/includes/header", $data);
        if ($current_user->admin_access == "Subadmin") {
            $this->load->view("subadmin_nav/navheader");
        } else {
            $this->load->view("admin_nav/navheader");
        }
        $this->load->view("manage_officer/manage_modules.php");
        $this->load->view("dashboard/includes/footer");
    }

    public function add_modules_exec() {
        $officer = $this->ManageOfficer_model->get_subadmin($this->uri->segment(3))[0];

        $officer_module_access = $this->ManageOfficer_model->get_officer_modules(array("module_access.admin_id" => $this->uri->segment(3)));


        $officer_module_id = array();
        for ($i = 0; $i < sizeof($officer_module_access); $i++) {
            if ($officer_module_access[0] == NULL) {
                break;
            } else {
                array_push($officer_module_id, $officer_module_access[$i]->module_id);
            }
        }

//        echo "<pre>";
//        print_r($officer);
//        echo "</pre>";
//        die;

        if (empty($this->input->post("modules"))) {
            // NO SELECTED MODULE. REMOVE ALL MODULES RELATED TO THIS OFFICER
            $this->ManageOfficer_model->remove_all_modules(array("module_access.admin_id" => $this->uri->segment(3)));
        } else {
            $this->ManageOfficer_model->remove_all_modules(array("module_access.admin_id" => $this->uri->segment(3)));
            $selected_modules = $this->input->post("modules");
            foreach ($selected_modules as $selected_module) {

                $data = array(
                    'admin_id' => $this->uri->segment(3),
                    'module_id' => $selected_module
                );
                $this->ManageOfficer_model->add_module($data);
            }
        }

        $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Updated module access for " . $officer->admin_firstname . " " . $officer->admin_lastname);
        $this->session->set_flashdata("module_update", "Successfully updated " . $officer->admin_firstname . " " . $officer->admin_lastname . "'s modules.");
        redirect(base_url() . "ManageOfficer/manage_module");
    }

    public function remove_module_exec() {
        $module_access_id = $this->uri->segment(3);

        $module_access = $officer_module_access = $this->ManageOfficer_model->get_officer_modules(array("module_access.module_access_id" => $module_access_id))[0];

        $this->ManageOfficer_model->remove_module(array("module_access_id" => $module_access_id));
        $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Updated module access for " . $module_access->admin_firstname . " " . $module_access->admin_lastname);
        $this->session->set_flashdata("module_removed", "Successfully removed " . $module_access->module_title . " module to " . $module_access->admin_firstname . " " . $module_access->admin_lastname . "'s modules.");
        redirect(base_url() . "ManageOfficer/manage_module");
    }

    public function register_admin() {
        $manageUserModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 1));
        $manageOfficerModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 2));
        $petManagementModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 3));
        $scheduleModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 4));

        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            /* MODULE ACCESS */
            'manageUserModule' => $manageUserModule,
            'manageOfficerModule' => $manageOfficerModule,
            'petManagementModule' => $petManagementModule,
            'scheduleModule' => $scheduleModule,
            //////////////////////////////
            "title" => "Admin Registration",
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        if ($current_user->admin_access == "Subadmin") {
            $this->load->view("subadmin_nav/navheader");
        } else {
            $this->load->view("admin_nav/navheader");
        }
        $this->load->view("manage_officer/admin_registration");
        $this->load->view("manage_officer/footer");
    }

    public function admin_register_exec() {
        $this->form_validation->set_rules("username", "Username", "required|min_length[5]|is_unique[user.user_username]");
        $this->form_validation->set_rules("password", "Password", "required|matches[conpassword]|min_length[8]");
        $this->form_validation->set_rules("conpassword", "Confirm Password", "required|matches[password]|min_length[8]");
        $this->form_validation->set_rules("email", "Email", "required|valid_email");
        $this->form_validation->set_rules("phone", "Mobile Phone No.", "required|numeric|regex_match[^(09|\+639)\d{9}$^]");
        $this->form_validation->set_rules("lname", "Lastname", "required|min_length[2]|callback__alpha_dash_space");
        $this->form_validation->set_rules("fname", "Firstname", "required|min_length[2]|callback__alpha_dash_space");
        $this->form_validation->set_rules("bday", "Birthday", "required");
        $this->form_validation->set_rules("address", "Address", "required");
        if ($this->form_validation->run() == FALSE) {
            $this->register_admin();
        } else {
//Do Some Registering
            if ($this->input->post('gender') == "Male") {
                $imagePath = "images/user/male.png";
            } else {
                $imagePath = "images/user/female.png";
            }

            $data = array(
                'admin_username' => $this->input->post('username'),
                'admin_password' => sha1($this->input->post('password')),
                'admin_contact_no' => $this->input->post('phone'),
                'admin_email' => $this->input->post('email'),
                'admin_lastname' => $this->input->post('lname'),
                'admin_firstname' => $this->input->post('fname'),
                'admin_bday' => strtotime($this->input->post('bday')),
                'admin_status' => 1,
                'admin_sex' => $this->input->post('gender'),
                'admin_picture' => $imagePath,
                'admin_address' => $this->input->post('address'),
                'admin_isverified' => 1,
                'admin_added_at' => time(),
                'admin_updated_at' => time()
            );

            if ($this->Register_model->insert("admin", $data)) {
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), $user->admin_firstname . " added a new Officer");
                $this->session->set_flashdata("register_admin_success", "New officer has been registered.");
                redirect(base_url() . "ManageOfficer");
            } else {
                
            }
        }
    }

}
