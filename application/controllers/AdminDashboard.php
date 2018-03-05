<?php

class AdminDashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
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
                $this->session->set_flashdata("err_5", "You are currently logged in as " . $current_user->user_firstname . " " . $current_user->user_lastname);
                redirect(base_url() . "SubadminDashboard");
            } else if ($this->session->userdata("user_access") == "admin") {
                //ADMIN!
                //Do nothing!
            }
        }
    }

    public function index() {
        $adopted = $this->AdminDashboard_model->fetch("adoption");
        $januaryCount = 0;
        $februaryCount = 0;
        $marchCount = 0;
        $aprilCount = 0;
        $mayCount = 0;
        $juneCount = 0;
        $julyCount = 0;
        $augustCount = 0;
        $septemberCount = 0;
        $octoberCount = 0;
        $novemberCount = 0;
        $decemberCount = 0;
        if (!empty($adopted)) {
            foreach ($adopted as $mo) {
                $month = date("M", $mo->adoption_adopted_at);
                if ($month == 'Jan') {
                    $januaryCount = $januaryCount + 1;
                } else if ($month == 'Feb') {
                    $februaryCount = $februaryCount + 1;
                } else if ($month == 'Mar') {
                    $marchCount = $marchCount + 1;
                } else if ($month == 'Apr') {
                    $aprilCount = $aprilCount + 1;
                } else if ($month == 'May') {
                    $mayCount = $mayCount + 1;
                } else if ($month == 'Jun') {
                    $juneCount = $juneCount + 1;
                } else if ($month == 'Jul') {
                    $julyCount = $julyCount + 1;
                } else if ($month == 'Aug') {
                    $augustCount = $augustCount + 1;
                } else if ($month == 'Sep') {
                    $septemberCount = $septemberCount + 1;
                } else if ($month == 'Oct') {
                    $octoberCount = $octoberCount + 1;
                } else if ($month == 'Nov') {
                    $novemberCount = $novemberCount + 1;
                } else if ($month == 'Dec') {
                    $decemberCount = $decemberCount + 1;
                }
            }
        }
//        echo "<pre>";
//        print_r($january);
//        echo "</pre>";
//        die;

        $found_animals = $this->AdminDashboard_model->count_found_animal();

        $missing_animals = $this->AdminDashboard_model->count_missing_animal();
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
        $allMissing = $this->AdminDashboard_model->fetch_all_missing();

//        echo "<pre>";
//        print_r($allMissing);
//        echo "<pre>";
//        die;
        $allFound = $this->AdminDashboard_model->fetch_all_found();
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
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
            'allMissing' => $allMissing,
            'allFound' => $allFound,
            'missing_animals' => $missing_animals,
            'found_animals' => $found_animals,
            'januaryCount' => $januaryCount,
            'februaryCount' => $februaryCount,
            'marchCount' => $marchCount,
            'aprilCount' => $aprilCount,
            'mayCount' => $mayCount,
            'juneCount' => $juneCount,
            'julyCount' => $julyCount,
            'augustCount' => $augustCount,
            'septemberCount' => $septemberCount,
            'octoberCount' => $octoberCount,
            'novemberCount' => $novemberCount,
            'decemberCount' => $decemberCount,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("dashboard/main");
        $this->load->view("dashboard/includes/footer");
    }

}
