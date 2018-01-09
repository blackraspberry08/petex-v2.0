<?php

class Schedules extends CI_Controller {
    function __construct() {
        parent::__construct();
        //---> MODELS HERE!
        
        //---> LIBRARIES HERE!
        
        //---> SESSIONS HERE!
        if ($this->session->has_userdata('isloggedin') == FALSE) {
            //user is not yet logged in
            $this->session->set_flashdata("err_4", "Login First!");
            redirect(base_url().'main/');
        }else{
            $current_user = $this->session->userdata("current_user");
            if($this->session->userdata("user_access") == "user"){
                //USER!
                $this->session->set_flashdata("err_5", "You are currently logged in as ".$current_user->user_firstname." ".$current_user->user_lastname);
                redirect(base_url()."UserDashboard");
            }
            else if($this->session->userdata("user_access") == "subadmin"){
                //SUBADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as ".$current_user->user_firstname." ".$current_user->user_lastname);
                redirect(base_url()."SubadminDashboard");
            }
            else if($this->session->userdata("user_access") == "admin"){
                //ADMIN!
                //Do nothing!
            }
        }
    }
    
    public function index(){
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $data = array(
            'title' => "Schedules",
            //NAV INFO
            'user_name' => $current_user->admin_firstname." ".$current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("dashboard/includes/header", $data);
        $this->load->view("admin_nav/navheader");
        $this->load->view("schedules/main");
        $this->load->view("dashboard/includes/footer");
    }
    
    public function getscheds() {
        $query = $this->db->query("SELECT * FROM schedule");
        $result = $query->result_array();
        foreach ($result as $key => $arr) {
            $result[$key]['title'] = $arr['schedule_title'];
            $result[$key]['description'] = $arr['schedule_desc'];
            $result[$key]['color'] = $arr['schedule_color'];
            $result[$key]['start'] = date("Y-m-d H:i:s", $arr['schedule_startdate']);
            $result[$key]['end'] = date("Y-m-d H:i:s", $arr['schedule_enddate']);
        }
        echo json_encode($result);
    }

    public function getsched() {
        $query = $this->db->query("SELECT * FROM schedule where schedule_id = " . $this->input->post("id"));
        $result = $query->result_array();
        foreach ($result as $key => $arr) {
            $result[$key]['schedule_id'] = $arr['schedule_id'];
            $result[$key]['schedule_title'] = $arr['schedule_title'];
            $result[$key]['schedule_desc'] = $arr['schedule_desc'];
            $result[$key]['schedule_color'] = $arr['schedule_color'];
            $result[$key]['schedule_startdate'] = date("F d, Y", $arr['schedule_startdate']);
            $result[$key]['schedule_starttime'] = date("h:iA", $arr['schedule_startdate']);
            $result[$key]['schedule_enddate'] = date("F d, Y", $arr['schedule_enddate']);
            $result[$key]['schedule_endtime'] = date("h:iA", $arr['schedule_enddate']);
        }
        echo json_encode($result);
    }

    public function setreserve() {
        $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
        $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
        $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
        $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
        $this->form_validation->set_rules('schedule_title', "Title", "required");
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => false, 'result' => 'Some of the fields is wrong!'));
        } else {
            $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
            $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));
            if ($this->admin_model->fetch("schedule", array("schedule_startdate" => strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'))))) {
                echo json_encode(array('success' => false, 'result' => 'There is an existing schedule already!'));
            } else {
                $data = array(
                    "schedule_title" => $this->input->post('schedule_title'),
                    "schedule_desc" => $this->input->post('schedule_desc'),
                    "schedule_color" => $this->input->post('schedule_color'),
                    "schedule_startdate" => $startdate,
                    "schedule_enddate" => $enddate
                );
                $this->admin_model->singleinsert("schedule", $data);
                $log = array(
                    "user_id" => $this->session->userdata("userid"),
                    "event_description" => "Added a schedule named ".$data["schedule_title"],
                    "event_classification" => "audit",
                    "event_added_at" => time()
                );
                $this->putToEvents($log);
                echo json_encode(array('success' => true, 'result' => 'Success'));
            }
        }
    }

    public function updatereserve() {
        $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
        $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
        $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
        $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
        $this->form_validation->set_rules('schedule_title', "Title", "required");
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => false, 'result' => 'Some of the fields is wrong!'));
        } else {
            $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
            $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));
            $data = array(
                "schedule_title" => $this->input->post('schedule_title'),
                "schedule_desc" => $this->input->post('schedule_desc'),
                "schedule_color" => $this->input->post('schedule_color'),
                "schedule_startdate" => $startdate,
                "schedule_enddate" => $enddate
            );
            $this->admin_model->update("schedule", $data, array("schedule_id" => $this->input->post("schedule_id")));
            $log = array(
                    "user_id" => $this->session->userdata("userid"),
                    "event_description" => "Edited a schedule named ".$data["schedule_title"],
                    "event_classification" => "audit",
                    "event_added_at" => time()
                );
                $this->putToEvents($log);
            echo json_encode(array('success' => true, 'result' => "Success"));
        }
    }

    public function deletereserve() {
        $this->admin_model->delete("schedule", array("schedule_id" => $this->input->post("schedule_id")));
        $selectedSched = $this->admin_model->fetch("schedule", array("schedule_id" => $this->input->post("schedule_id"))); 
        $log = array(
            "user_id" => $this->session->userdata("userid"),
            "event_description" => "Removed a schedule named ".$selectedSched->schedule_title,
            "event_classification" => "audit",
            "event_added_at" => time()
        );
        $this->putToEvents($log);
        echo json_encode(array('success' => true, 'result' => "Success"));
    }
}


