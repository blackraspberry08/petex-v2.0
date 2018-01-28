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
    
    //CALLBACKS
    public function is_larger_than_startdate($str){
        $unix_start = strtotime($this->input->post("event_startdate")." ".$this->input->post("event_starttime"));
        $unix_end = strtotime($this->input->post("event_enddate")." ".$this->input->post("event_endtime"));
        if ($unix_start > $unix_end){
            $this->form_validation->set_message('is_larger_than_startdate', 'The {field} must be larger than the start date/time');
            return FALSE;
        }
        else{
            return TRUE;
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
        $res = array();
        foreach ($result as $key => $arr) {
            $res[$key]["schedule_id"]   = $arr['schedule_id'];
            $res[$key]["user_id"]       = $arr['user_id'];
            $res[$key]["admin_id"]       = $arr['admin_id'];
            $res[$key]["title"]         = $arr['schedule_title'];
            $res[$key]["color"]         = $arr['schedule_color'];
            $res[$key]["start"]         = date("Y-m-d H:i:s", $arr['schedule_startdate']);
            $res[$key]["end"]           = date("Y-m-d H:i:s", $arr['schedule_enddate']);
            $res[$key]["description"]   = $arr['schedule_desc'];
        }

        echo json_encode($res);
    }

    public function getsched() {
        $query = $this->db->query("SELECT * FROM schedule WHERE schedule_id = " . $this->input->post("id"));
        $result = $query->result_array();
        $res = array();
        foreach ($result as $key => $arr) {
            $res[$key]['id']             = $arr['schedule_id'];
            $res[$key]['title']          = $arr['schedule_title'];
            $res[$key]['color']          = $arr['schedule_color'];
            $res[$key]['startdate']      = date("F d, Y", $arr['schedule_startdate']);
            $res[$key]['starttime']      = date("h:i A", $arr['schedule_startdate']);
            $res[$key]['enddate']        = date("F d, Y", $arr['schedule_enddate']);
            $res[$key]['endtime']        = date("h:i A", $arr['schedule_enddate']);
            $res[$key]['description']    = $arr['schedule_desc'];
        }
        echo json_encode($res);
    }

    public function setreserve() {
        $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
        $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
        $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
        $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
        $this->form_validation->set_rules('schedule_title', "Title", "required");
        
        if ($this->form_validation->run() == FALSE) {
            //IF THERE ARE ERRORS IN FORMS
            echo json_encode(array('success' => false, 'result' => "There are errors in your form. Please check the fields."));
        } else {
            //IF FORMS ARE VALID
            $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
            $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));
            
            if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                //IF STARTDATE IS ALREADY EXISTING
                echo json_encode(array('success' => false, 'result' => 'There is an existing schedule already!'));
            } else {
                //IF STARTDATE IS UNIQUE
                if($startdate > $enddate){
                    echo json_encode(array('success' => false, 'result' => 'Start Date/Time is ahead of End Date/Time'));
                }else{
                    $data = array(
                        "admin_id" => $this->session->userdata("current_user")->admin_id,
                        "schedule_title" => $this->input->post('schedule_title'),
                        "schedule_desc" => $this->input->post('schedule_desc'),
                        "schedule_color" => $this->input->post('schedule_color'),
                        "schedule_startdate" => $startdate,
                        "schedule_enddate" => $enddate
                    );
                    $this->Schedules_model->add_schedule($data);

                    echo json_encode(array('success' => true, 'result' => 'Success'));
                }
            }
        }
    }

    public function updatereserve() {
        $this->form_validation->set_rules('schedule_title', "Title", "required");
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('success' => false, 'result' => 'Fill up the necessary fields.'));
        } else {
            $data = array(
                "schedule_title" => $this->input->post('schedule_title'),
                "schedule_desc" => $this->input->post('schedule_desc'),
                "schedule_color" => $this->input->post('schedule_color'),
            );
            if($this->Schedules_model->update_sched($data, array("schedule_id" => $this->input->post("schedule_id")))){
                echo json_encode(array("data" => $data, 'id' => $this->input->post("schedule_id"), 'success' => true, 'result' => "Successfully updated."));
            }else{
                echo json_encode(array('success' => false, 'result' => 'Something went wrong while updating the event.'));
            }
        }
    }

    public function deletereserve() {
        $this->Schedules_model->delete_sched($this->input->post("schedule_id"));
        echo json_encode(array('success' => true, 'result' => "Success"));
    }
}


