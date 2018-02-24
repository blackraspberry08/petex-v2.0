<?php

class SubadminDashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        //---> LIBRARIES HERE!
        //---> SESSIONS HERE!
        if ($this->session->has_userdata('isloggedin') == FALSE) {
            //user is not yet logged in
            $this->session->set_userdata("err_4", "Login First!");
            redirect(base_url() . 'login/');
        } else {
            $current_user = $this->session->userdata("current_user");
            if ($this->session->userdata("user_access") == "user") {
                //USER!
                $this->session->set_flashdata("err_5", "You are currently logged in as " . $current_user->user_firstname . " " . $current_user->user_lastname);
                redirect(base_url() . "userDashboard");
            } else if ($this->session->userdata("user_access") == "subadmin") {
                //SUBADMIN!
                //Do nothing.
            } else if ($this->session->userdata("user_access") == "admin") {
                //ADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as " . $current_user->admin_firstname . " " . $current_user->admin_lastname);
                redirect(base_url() . "AdminDashboard");
            }
        }
    }

    public function index() {
        $manageUserModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 1));
        $manageOfficerModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 2));
        $petManagementModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 3));
        $scheduleModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 4));

        $adoptable_animals = $this->AdminDashboard_model->count_adoptable_animal();
        $non_adoptable_animals = $this->AdminDashboard_model->count_non_adoptable_animal();
        $deceased_animals = $this->AdminDashboard_model->count_deceased_animal();
        $removed_animals = $this->AdminDashboard_model->count_removed_animal();
        $adopted_animals = $this->AdminDashboard_model->count_adopted_animal();
        $pet_adopters = $this->AdminDashboard_model->count_pet_adopter();
        $transactions = $this->AdminDashboard_model->count_transaction();
        $users = $this->AdminDashboard_model->count_user();
        $dogs = $this->AdminDashboard_model->count_dogs();
        $cats = $this->AdminDashboard_model->count_cats();
        $pets = $this->AdminDashboard_model->count_all_animals();
        $allusers = $this->AdminDashboard_model->fetch("user", array("user_status" => 1));
        $alladoptable = $this->AdminDashboard_model->fetch("pet", array("pet_status" => "Adoptable", "pet_access" => 1));
        $allnonadoptable = $this->AdminDashboard_model->fetch("pet", array("pet_status" => "NonAdoptable", "pet_access" => 1));
        $allremoved = $this->AdminDashboard_model->fetch("pet", array("pet_access" => 0));
        $alladopted = $this->AdminDashboard_model->fetch_all_adopted("adoption", "pet", "adoption.pet_id = pet.pet_id", "user", "adoption.user_id = user.user_id");
        $alladopters = $this->AdminDashboard_model->fetch_all_adopters();
        $alldeceased = $this->AdminDashboard_model->fetch("pet", array("pet_status" => "Deceased", "pet_access" => 1));
        $alltransactions = $this->AdminDashboard_model->fetch_all_transactions();
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            /* MODULE ACCESS */
            'manageUserModule' => $manageUserModule,
            'manageOfficerModule' => $manageOfficerModule,
            'petManagementModule' => $petManagementModule,
            'scheduleModule' => $scheduleModule,
            'title' => "Dashboard",
            'trails' => $this->AuditTrail_model->get_audit_trail("event", "admin", "event.admin_id = admin.admin_id", "user", "event.user_id = user.user_id", array("event_classification" => "trail")),
            'logs' => $this->UserLogs_model->get_userlogs("event", "admin", "event.admin_id = admin.admin_id", "user", "event.user_id = user.user_id", array("event_classification" => "log")),
            'adoptable_animals' => $adoptable_animals,
            'non_adoptable_animals' => $non_adoptable_animals,
            'deceased_animals' => $deceased_animals,
            'removed_animals' => $removed_animals,
            'adopted_animals' => $adopted_animals,
            'pet_adopters' => $pet_adopters,
            'transactions' => $transactions,
            'users' => $users,
            'dogs' => $dogs,
            'cats' => $cats,
            'pets' => $pets,
            'allusers' => $allusers,
            'alladoptable' => $alladoptable,
            'allnonadoptable' => $allnonadoptable,
            'allremoved' => $allremoved,
            'alladopters' => $alladopters,
            'alladopted' => $alladopted,
            'alldeceased' => $alldeceased,
            'alltransactions' => $alltransactions,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "PAWS Officer"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("subadmin_nav/navheader");
        $this->load->view("dashboard/main");
        $this->load->view("dashboard/includes/footer");
    }

}
