<?php

require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminDashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        //---> HELPERS HERE!
        $this->load->helper('download');
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

    function addImage($path, $coordinates, $sheet, $width, $height) {
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setPath($path);
        $drawing->setCoordinates($coordinates);
        $drawing->setWorksheet($sheet);
        $drawing->setWidth($width);
        $drawing->setHeight($height);
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

    public function adopted_reports() {
        $year_adopted = $this->input->post("year_adopted");

        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $adopted_by_year = $this->AdminDashboard_model->fetchJoinAdopted(array('Year(from_unixtime(adoption_adopted_at))' => $year_adopted));
//        echo $this->db->last_query();
//        die;
//        echo "<pre>";
//        print_r($adopted_by_year);
//        echo "</pre>";
//        die;

        $data = array(
            'year_adopted' => $year_adopted,
            'adopted_by_year' => $adopted_by_year,
            'title' => "Pet Adopted Reports",
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("dashboard/adopted_reports");
        $this->load->view("dashboard/includes/footer");
    }

    public function generate_excel() {
        $year_adopted = $this->uri->segment(3);
        $adopted_by_year = $this->AdminDashboard_model->fetchJoinAdopted(array('Year(from_unixtime(adoption_adopted_at))' => $year_adopted));

        $spreadsheet = new Spreadsheet();
        //Set Width per Column
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getStyle("A1:H1")->getFont()->setBold(true);
        for ($height = 2; $height <= 20; $height++) {
            $spreadsheet->getActiveSheet()->getRowDimension($height)->setRowHeight(60);
        }
        $sheet = $spreadsheet->getActiveSheet();
        $table_columns = array('Pet Name', 'Pet Gender', 'Pet Specie', 'Pet Breed', 'Pet Size', 'Pet Owner', 'Adoption Proof', 'Adopted At');
        $sheet->setCellValue('A1', 'Pet Name')->setCellValue('B1', 'Pet Gender')->setCellValue('C1', 'Pet Specie')->setCellValue('D1', 'Pet Breed')
                ->setCellValue('E1', 'Pet Size')->setCellValue('F1', 'Pet Owner')->setCellValue('G1', 'Adoption Proof')->setCellValue('H1', 'Adopted At');
        $row = 2;
        $drawing = new PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        foreach ($adopted_by_year as $adopted) {
            $sheet->setCellValue('A' . $row, $adopted->pet_name)
                    ->setCellValue('B' . $row, $adopted->pet_sex)
                    ->setCellValue('C' . $row, $adopted->pet_specie)
                    ->setCellValue('D' . $row, $adopted->pet_breed)
                    ->setCellValue('E' . $row, $adopted->pet_size)
                    ->setCellValue('F' . $row, $adopted->user_firstname . ' ' . $adopted->user_lastname)
                    ->setCellValue('H' . $row, date('M j, Y', $adopted->adoption_adopted_at));
            $drawing->setName('Adoption Proof');
            $drawing->setDescription('Adoption Proof');
            $this->addImage($_SERVER["DOCUMENT_ROOT"] . "petexphil/" . $adopted->adoption_proof_img, "G" . $row, $spreadsheet->getActiveSheet(), 300, 65);
            //$drawing->setPath($_SERVER["DOCUMENT_ROOT"] . 'petexphil/' . $adopted->adoption_proof_img);
//            $drawing->setCoordinates('G' . $row);
////setOffsetX works properly
//            $drawing->setOffsetX(25);
//            $drawing->setOffsetY(6);
////set width, height
//            $drawing->setWidth(400);
//            $drawing->setHeight(70);
//            $drawing->setWorksheet($spreadsheet->getActiveSheet());
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('Adoption_Reports' . $year_adopted . '.xlsx');
        force_download('Adoption_Reports' . $year_adopted . '.xlsx', NULL);
    }

}
