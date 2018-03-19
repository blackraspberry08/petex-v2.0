<?php

class ManageProgress extends CI_Controller {

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
            } else if ($this->session->userdata("user_access") == "admin") {
                //ADMIN!
                //Do nothing!
            }
        }
    }

    function _alpha_dash_space($str = '') {
        if (!preg_match("/^([-a-z_ ])+$/i", $str)) {
            $this->form_validation->set_message('_alpha_dash_space', 'The {field} is not correct.');
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

        $transaction_id = $this->session->userdata("manage_progress_transaction_id");
        //$current = $this->ManageProgress_model->get_progress(array("transaction.transaction_id" => $transaction_id))[0];
        $current_transaction = $this->PetManagement_model->get_transactions(array("transaction.transaction_id" => $transaction_id))[0];
//
//        echo "<pre>";
//        print_r($current_transaction);
//        echo "</pre>";
//        die;
        if ($this->session->userdata("pet_status") != "Adopted" && $current_transaction->transaction_isActivated != 0) {
            $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
            $adoption = NULL;
            $adoption_form = $this->ManageProgress_model->get_adoption_form(array("adoption_form.transaction_id" => $transaction_id))[0];
            $comments_step_1 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 1, "progress.transaction_id" => $transaction_id));
            $comments_step_2 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 2, "progress.transaction_id" => $transaction_id));
            $comments_step_3 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 3, "progress.transaction_id" => $transaction_id));
            $comments_step_4 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 4, "progress.transaction_id" => $transaction_id));
            $comments_step_5 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 5, "progress.transaction_id" => $transaction_id));
            $comments_step_6 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 6, "progress.transaction_id" => $transaction_id));
            $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];

            $progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id));
            $progress_1 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 1, "progress.transaction_id" => $transaction_id))[0];
            $progress_2 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 2, "progress.transaction_id" => $transaction_id))[0];
            $progress_3 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 3, "progress.transaction_id" => $transaction_id))[0];
            $progress_4 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 4, "progress.transaction_id" => $transaction_id))[0];
            $progress_5 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 5, "progress.transaction_id" => $transaction_id))[0];
            $progress_6 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 6, "progress.transaction_id" => $transaction_id))[0];
        } else {
            $current_transaction = $this->PetManagement_model->get_inactive_transactions(array("transaction.transaction_id" => $transaction_id))[0];
//            echo $transaction_id;
//            die
//            echo "<pre>";
//            print_r($current_transaction);
//            echo "</pre>";
//            die;
            $adoption = $this->ManageProgress_model->get_adoption(array("adoption.user_id" => $current_transaction->user_id, "adoption.pet_id" => $current_transaction->pet_id))[0];
            $progress = $this->ManageProgress_model->get_finished_progress(array("progress.transaction_id" => $transaction_id));
            $progress_1 = $this->ManageProgress_model->get_finished_progress(array("progress.checklist_id" => 1, "progress.transaction_id" => $transaction_id))[0];
            $progress_2 = $this->ManageProgress_model->get_finished_progress(array("progress.checklist_id" => 2, "progress.transaction_id" => $transaction_id))[0];
            $progress_3 = $this->ManageProgress_model->get_finished_progress(array("progress.checklist_id" => 3, "progress.transaction_id" => $transaction_id))[0];
            $progress_4 = $this->ManageProgress_model->get_finished_progress(array("progress.checklist_id" => 4, "progress.transaction_id" => $transaction_id))[0];
            $progress_5 = $this->ManageProgress_model->get_finished_progress(array("progress.checklist_id" => 5, "progress.transaction_id" => $transaction_id))[0];
            $progress_6 = $this->ManageProgress_model->get_finished_progress(array("progress.checklist_id" => 6, "progress.transaction_id" => $transaction_id))[0];
            $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
            $adoption_form = $this->ManageProgress_model->get_adoption_form(array("adoption_form.transaction_id" => $transaction_id))[0];
            $comments_step_1 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 1, "progress.transaction_id" => $transaction_id));
            $comments_step_2 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 2, "progress.transaction_id" => $transaction_id));
            $comments_step_3 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 3, "progress.transaction_id" => $transaction_id));
            $comments_step_4 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 4, "progress.transaction_id" => $transaction_id));
            $comments_step_5 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 5, "progress.transaction_id" => $transaction_id));
            $comments_step_6 = $this->ManageProgress_model->get_comments(array("progress.checklist_id" => 6, "progress.transaction_id" => $transaction_id));
        }

        $data = array(
            /* MODULE ACCESS */
            'manageUserModule' => $manageUserModule,
            'manageOfficerModule' => $manageOfficerModule,
            'petManagementModule' => $petManagementModule,
            'scheduleModule' => $scheduleModule,
            //////////////////////////////
            'title' => $current_transaction->user_firstname . " " . $current_transaction->user_lastname . " | Manage Progress",
            'transaction' => $current_transaction,
            'progresses' => $progress,
            'adoption_form' => $adoption_form,
            'progress_1' => $progress_1,
            'progress_2' => $progress_2,
            'progress_3' => $progress_3,
            'progress_4' => $progress_4,
            'progress_5' => $progress_5,
            'progress_6' => $progress_6,
            'comments_step_1' => $comments_step_1,
            'comments_step_2' => $comments_step_2,
            'comments_step_3' => $comments_step_3,
            'comments_step_4' => $comments_step_4,
            'comments_step_5' => $comments_step_5,
            'comments_step_6' => $comments_step_6,
            'adoption' => $adoption,
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
        $this->load->view("manage_progress/main");
        $this->load->view("dashboard/includes/footer");
    }

    public function upload_adoption_form() {
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $this->uri->segment(3)))[0];

        $file_name = $current_transaction->transaction_id . "_adopter-" . $current_transaction->user_id . "_pet-" . $current_transaction->pet_id . ".pdf";
        $config['upload_path'] = './download/pending/';
        $config['allowed_types'] = 'pdf';
        $config['file_ext_tolower'] = true;
        $config['max_size'] = 5120;
        $config['file_name'] = $file_name;
        $this->load->library('upload', $config);

        if (!empty($_FILES["adoption_form"]["name"])) {
            if (file_exists("download/pending/" . $file_name)) {
                unlink("download/pending/" . $file_name);
            }
            if ($this->upload->do_upload('adoption_form')) {
                $location = "download/pending/" . $this->upload->data("file_name");
            } else {
                echo $this->upload->display_errors();
                $this->session->set_flashdata("uploading_error", "Please make sure that the max size is 5MB the types may only be .pdf");
                redirect(base_url() . "ManageProgress");
            }
        } else {
            //NO PDF SENT
            $this->session->set_flashdata("uploading_error", "No pdf detected.");
            redirect(base_url() . "ManageProgress");
        }

        $data = array(
            "transaction_id" => $this->uri->segment(3),
            "adoption_form_location" => $location,
            "adoption_form_isPending" => 1,
            "adoption_form_added_at" => time()
        );

        if ($this->ManageProgress_model->add_adoption_form($data)) {
            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Uploaded an adoption form manually.");
            $this->session->set_flashdata("adoption_form_success", "Successfully uploaded the adoption form.");
        } else {
            $this->session->set_flashdata("adoption_form_fail", "Something went wrong");
        }
        redirect(base_url() . "ManageProgress");
    }

    public function step_1() {
        $transaction_id = $this->uri->segment(3);
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $current_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 1))[0];
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 2))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $current_adoption_form = $this->ManageProgress_model->get_adoption_form(array("adoption_form.transaction_id" => $transaction_id))[0];
        if ($this->input->post('event_type') == "approve") {
            //Approve Step + Comment + Set Sched
            $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array(
                    'success' => false,
                    'result' => "There are errors in your form. Please check the fields.",
                    'startdate' => form_error('schedule_startdate'),
                    'starttime' => form_error('schedule_starttime'),
                    'enddate' => form_error('schedule_enddate'),
                    'endtime' => form_error('schedule_endtime'),
                    'comment' => form_error('comment')
                ));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
                $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array(
                        'success' => false,
                        'result' => 'There is an existing schedule already!',
                        'startdate' => "<p>There is an existing schedule for this date/time</p>",
                        'starttime' => "<p>There is an existing schedule for this date/time</p>",
                        'enddate' => "",
                        'endtime' => "",
                        'comment' => ""
                    ));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if ($startdate > $enddate) {
                        echo json_encode(array(
                            'success' => false,
                            'result' => 'Start Date/Time is ahead of End Date/Time',
                            'startdate' => "",
                            'starttime' => "",
                            'enddate' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'endtime' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'comment' => ""
                        ));
                    } else {
                        $data = array(
                            "progress_accomplished_at" => time(),
                            "progress_isSuccessful" => 1,
                            "progress_percentage" => 100
                        );
                        $transaction_progress = array(
                            "transaction_progress" => 16
                        );
                        $adoption_form = array(
                            "adoption_form_isPending" => 0,
                            "adoption_form_location" => "download/adoption_form/" . $transaction_id . "_adopter-" . $current_transaction->user_id . "_pet-" . $current_transaction->pet_id . ".pdf"
                        );
                        $progress_comment = array(
                            "progress_id" => $current_progress->progress_id,
                            "progress_comment_sender" => $current_user->admin_firstname . " " . $current_user->admin_lastname,
                            "progress_comment_picture" => $current_user->admin_picture,
                            "progress_comment_sender_access" => $current_user->admin_access,
                            "progress_comment_content" => $this->input->post('comment'),
                            "progress_comment_added_at" => time()
                        );
                        $sched = array(
                            "progress_id" => $next_progress->progress_id,
                            "admin_id" => $this->session->userdata("current_user")->admin_id,
                            "schedule_title" => $this->input->post('schedule_title'),
                            "schedule_desc" => $this->input->post('schedule_desc'),
                            "schedule_color" => $this->input->post('schedule_color'),
                            "schedule_startdate" => $startdate,
                            "schedule_enddate" => $enddate
                        );
                        // rename() moves file, not rename them.
                        rename($current_adoption_form->adoption_form_location, $adoption_form['adoption_form_location']);
                        if ($this->ManageProgress_model->approve_adoption_form($data, array("checklist_id" => 1, "transaction_id" => $transaction_id)) && $this->ManageProgress_model->update_progress($transaction_progress, array("transaction_id" => $transaction_id)) && $this->ManageProgress_model->update_adoption_form($adoption_form, array("transaction_id" => $transaction_id)) && $this->ManageProgress_model->add_progress_comment($progress_comment) && $this->Schedules_model->add_schedule($sched)
                        ) {
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Approved adoption form (step 1) and added a schedule for next step of " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname) . "";
                            $this->session->set_flashdata("approve_adoption_form_success", "Approved adoption form.");
                            echo json_encode(array('success' => true, 'result' => 'Successfully approved adoption form!'));
                        } else {
                            echo json_encode(array('success' => false, 'result' => 'Something went wrong while approving adoption form'));
                        }
                    }
                }
            }
        } else if ($this->input->post('event_type') == "disapprove") {
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "Pleas provide a comment.", "comment" => form_error("comment")));
            } else {
                //Disapprove Step + Comment
                $progress_comment = array(
                    "progress_id" => $current_progress->progress_id,
                    "progress_comment_sender" => $current_user->admin_firstname . " " . $current_user->admin_lastname,
                    "progress_comment_picture" => $current_user->admin_picture,
                    "progress_comment_sender_access" => $current_user->admin_access,
                    "progress_comment_content" => $this->input->post('comment'),
                    "progress_comment_added_at" => time()
                );
                if ($this->ManageProgress_model->add_progress_comment($progress_comment)) {
                    $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Disapproved adoption form (step 1) of " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                    $this->session->set_flashdata("approve_adoption_form_success", "Disapproved adoption form.");
                    echo json_encode(array('success' => true, 'result' => 'Successfully disapproved adoption form.'));
                } else {
                    echo json_encode(array('success' => false, 'result' => 'Something went wrong while disapproving adoption form'));
                }
            }
        } else {
            echo json_encode(array('success' => false, 'result' => "Something Went wrong. Try again later."));
        }
    }

    public function step_2() {
        $transaction_id = $this->uri->segment(3);
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $current_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 2))[0];
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 3))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        if ($this->input->post('event_type') == "approve") {
            $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array(
                    'success' => false,
                    'result' => "There are errors in your form. Please check the fields.",
                    'startdate' => form_error('schedule_startdate'),
                    'starttime' => form_error('schedule_starttime'),
                    'enddate' => form_error('schedule_enddate'),
                    'endtime' => form_error('schedule_endtime'),
                    'comment' => form_error('comment')
                ));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
                $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array(
                        'success' => false,
                        'result' => 'There is an existing schedule already!',
                        'startdate' => "<p>There is an existing schedule for this date/time</p>",
                        'starttime' => "<p>There is an existing schedule for this date/time</p>",
                        'enddate' => "",
                        'endtime' => "",
                        'comment' => ""
                    ));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if ($startdate > $enddate) {
                        echo json_encode(array(
                            'success' => false,
                            'result' => 'Start Date/Time is ahead of End Date/Time',
                            'startdate' => "",
                            'starttime' => "",
                            'enddate' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'endtime' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'comment' => ""
                        ));
                    } else {
                        $data = array(
                            "progress_accomplished_at" => time(),
                            "progress_isSuccessful" => 1,
                            "progress_percentage" => 100
                        );
                        $transaction_progress = array(
                            "transaction_progress" => 32
                        );

                        $progress_comment = array(
                            "progress_id" => $current_progress->progress_id,
                            "progress_comment_sender" => $current_user->admin_firstname . " " . $current_user->admin_lastname,
                            "progress_comment_picture" => $current_user->admin_picture,
                            "progress_comment_sender_access" => $current_user->admin_access,
                            "progress_comment_content" => $this->input->post('comment'),
                            "progress_comment_added_at" => time()
                        );
                        $sched = array(
                            "progress_id" => $next_progress->progress_id,
                            "admin_id" => $this->session->userdata("current_user")->admin_id,
                            "schedule_title" => $this->input->post('schedule_title'),
                            "schedule_desc" => $this->input->post('schedule_desc'),
                            "schedule_color" => $this->input->post('schedule_color'),
                            "schedule_startdate" => $startdate,
                            "schedule_enddate" => $enddate
                        );

                        if ($this->ManageProgress_model->approve_adoption_form($data, array("checklist_id" => 2, "transaction_id" => $transaction_id)) && $this->ManageProgress_model->update_progress($transaction_progress, array("transaction_id" => $transaction_id)) && $this->ManageProgress_model->add_progress_comment($progress_comment) && $this->Schedules_model->add_schedule($sched)
                        ) {
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Approved Meet and Greet (step 2) and added a schedule for next step of " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                            $this->session->set_flashdata("disapprove_step_2_success", "Successfully approved Meet and Greet!");
                            echo json_encode(array('success' => true, 'result' => "Successfully approved Meet and Greet!"));
                        } else {
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Meet and Greet"));
                            $this->session->set_flashdata("disapprove_step_2_fail", "Something went wrong while approving Meet and Greet");
                        }
                    }
                }
            }
        } else if ($this->input->post('event_type') == "disapprove") {
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "Please provide a comment.", 'comment' => form_error('comment')));
            } else {
                $progress_comment = array(
                    "progress_id" => $current_progress->progress_id,
                    "progress_comment_sender" => $current_user->admin_firstname . " " . $current_user->admin_lastname,
                    "progress_comment_picture" => $current_user->admin_picture,
                    "progress_comment_sender_access" => $current_user->admin_access,
                    "progress_comment_content" => $this->input->post('comment'),
                    "progress_comment_added_at" => time()
                );
                if (
                        $this->ManageProgress_model->add_progress_comment($progress_comment)
                ) {
                    $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Disapproved Meet And Greet (step 2) of " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                    $this->session->set_flashdata("disapprove_step_2_success", "Disapproved Meet And Greet.");
                    echo json_encode(array('success' => true, 'result' => "Disapproved Meet And Greet."));
                } else {
                    echo json_encode(array('success' => false, 'result' => "Something went wrong while disapproving Meet and Greet"));
                    $this->session->set_flashdata("disapprove_step_2_fail", "Something went wrong while disapproving Meet and Greet");
                }
            }
        } else if ($this->input->post('event_type') == "setSched_1") {
            $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array(
                    'success' => false,
                    'result' => "There are errors in your form. Please check the fields.",
                    'startdate' => form_error('schedule_startdate'),
                    'starttime' => form_error('schedule_starttime'),
                    'enddate' => form_error('schedule_enddate'),
                    'endtime' => form_error('schedule_endtime'),
                ));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
                $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array(
                        'success' => false,
                        'result' => 'There is an existing schedule already!',
                        'startdate' => "<p>There is an existing schedule for this date/time</p>",
                        'starttime' => "<p>There is an existing schedule for this date/time</p>",
                        'enddate' => "",
                        'endtime' => "",
                        'comment' => ""
                    ));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if ($startdate > $enddate) {
                        echo json_encode(array(
                            'success' => false,
                            'result' => 'Start Date/Time is ahead of End Date/Time',
                            'startdate' => "",
                            'starttime' => "",
                            'enddate' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'endtime' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'comment' => ""
                        ));
                    } else {
                        //Set Schedule Only 

                        $sched = array(
                            "progress_id" => $next_progress->progress_id,
                            "admin_id" => $this->session->userdata("current_user")->admin_id,
                            "schedule_title" => $this->input->post('schedule_title'),
                            "schedule_desc" => $this->input->post('schedule_desc'),
                            "schedule_color" => $this->input->post('schedule_color'),
                            "schedule_startdate" => $startdate,
                            "schedule_enddate" => $enddate
                        );
                        if ($this->Schedules_model->add_schedule($sched)) {
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Added Interview #1 Schedule for " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                            $this->session->set_flashdata("approve_step_2_success", "Schedule set.");
                            echo json_encode(array('success' => true, 'result' => "Schedule set."));
                        } else {
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while setting schedule for Interview"));
                            $this->session->set_flashdata("approve_step_2_fail", "Something went wrong while setting schedule for Interview");
                        }
                    }
                }
            }
        } else if ($this->input->post('event_type') == "setSched_2") {
            $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array(
                    'success' => false,
                    'result' => "There are errors in your form. Please check the fields.",
                    'startdate' => form_error('schedule_startdate'),
                    'starttime' => form_error('schedule_starttime'),
                    'enddate' => form_error('schedule_enddate'),
                    'endtime' => form_error('schedule_endtime'),
                ));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
                $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array(
                        'success' => false,
                        'result' => 'There is an existing schedule already!',
                        'startdate' => "<p>There is an existing schedule for this date/time</p>",
                        'starttime' => "<p>There is an existing schedule for this date/time</p>",
                        'enddate' => "",
                        'endtime' => "",
                        'comment' => ""
                    ));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if ($startdate > $enddate) {
                        echo json_encode(array(
                            'success' => false,
                            'result' => 'Start Date/Time is ahead of End Date/Time',
                            'startdate' => "",
                            'starttime' => "",
                            'enddate' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'endtime' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'comment' => ""
                        ));
                    } else {
                        //Set Schedule Only
                        $sched = array(
                            "progress_id" => $next_progress->progress_id,
                            "admin_id" => $this->session->userdata("current_user")->admin_id,
                            "schedule_title" => $this->input->post('schedule_title'),
                            "schedule_desc" => $this->input->post('schedule_desc'),
                            "schedule_color" => $this->input->post('schedule_color'),
                            "schedule_startdate" => $startdate,
                            "schedule_enddate" => $enddate
                        );
                        if ($this->Schedules_model->add_schedule($sched)) {
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Added Interview #2 Schedule for " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                            $this->session->set_flashdata("approve_step_2_success", "Schedule set.");
                            echo json_encode(array('success' => true, 'result' => "Schedule set."));
                        } else {
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while setting schedule for Interview"));
                            $this->session->set_flashdata("approve_step_2_fail", "Something went wrong while setting schedule for Interview");
                        }
                    }
                }
            }
        } else {
            echo json_encode(array('success' => false, 'result' => "Something Went wrong. Try again later."));
        }
    }

    public function step_3() {
        $transaction_id = $this->uri->segment(3);
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $current_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 3))[0];
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 4))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        if ($this->input->post('event_type') == "approve") {
            $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array(
                    'success' => false,
                    'result' => "There are errors in your form. Please check the fields.",
                    'startdate' => form_error('schedule_startdate'),
                    'starttime' => form_error('schedule_starttime'),
                    'enddate' => form_error('schedule_enddate'),
                    'endtime' => form_error('schedule_endtime'),
                    'comment' => form_error('comment'),
                ));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
                $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array(
                        'success' => false,
                        'result' => 'There is an existing schedule already!',
                        'startdate' => "<p>There is an existing schedule for this date/time</p>",
                        'starttime' => "<p>There is an existing schedule for this date/time</p>",
                        'enddate' => "",
                        'endtime' => "",
                        'comment' => ""
                    ));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if ($startdate > $enddate) {
                        echo json_encode(array(
                            'success' => false,
                            'result' => 'Start Date/Time is ahead of End Date/Time',
                            'startdate' => "",
                            'starttime' => "",
                            'enddate' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'endtime' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'comment' => ""
                        ));
                    } else {
                        $data = array(
                            "progress_accomplished_at" => time(),
                            "progress_isSuccessful" => 1
                        );
                        $transaction_progress = array(
                            "transaction_progress" => 49
                        );

                        $progress_comment = array(
                            "progress_id" => $current_progress->progress_id,
                            "progress_comment_sender" => $current_user->admin_firstname . " " . $current_user->admin_lastname,
                            "progress_comment_picture" => $current_user->admin_picture,
                            "progress_comment_sender_access" => $current_user->admin_access,
                            "progress_comment_content" => $this->input->post('comment'),
                            "progress_comment_added_at" => time()
                        );
                        $sched = array(
                            "progress_id" => $next_progress->progress_id,
                            "admin_id" => $this->session->userdata("current_user")->admin_id,
                            "schedule_title" => $this->input->post('schedule_title'),
                            "schedule_desc" => $this->input->post('schedule_desc'),
                            "schedule_color" => $this->input->post('schedule_color'),
                            "schedule_startdate" => $startdate,
                            "schedule_enddate" => $enddate
                        );

                        if ($this->ManageProgress_model->edit_progress($data, array("checklist_id" => 3, "transaction_id" => $transaction_id)) && $this->ManageProgress_model->update_progress($transaction_progress, array("transaction_id" => $transaction_id)) && $this->ManageProgress_model->add_progress_comment($progress_comment) && $this->Schedules_model->add_schedule($sched)
                        ) {
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Approved All Interviews (step 3) and added a schedule for next step of " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                            $this->session->set_flashdata("approve_success", "Successfully approved All Interviews!");
                            echo json_encode(array('success' => true, 'result' => "Successfully approved All Interviews!"));
                        } else {
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while approving All Interviews"));
                            $this->session->set_flashdata("approve_failed", "Something went wrong while approving All Interviews");
                        }
                    }
                }
            }
        } else if ($this->input->post('event_type') == "disapprove") {
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "Please provide a comment.", 'comment' => form_error("comment")));
            } else {
                $progress_comment = array(
                    "progress_id" => $current_progress->progress_id,
                    "progress_comment_sender" => $current_user->admin_firstname . " " . $current_user->admin_lastname,
                    "progress_comment_picture" => $current_user->admin_picture,
                    "progress_comment_sender_access" => $current_user->admin_access,
                    "progress_comment_content" => $this->input->post('comment'),
                    "progress_comment_added_at" => time()
                );
                if (
                        $this->ManageProgress_model->add_progress_comment($progress_comment)
                ) {
                    $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Disapproved Interview of " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                    $this->session->set_flashdata("approve_step_2_success", "Disapproved Interview");
                    echo json_encode(array('success' => true, 'result' => "Disapproved Interview"));
                } else {
                    echo json_encode(array('success' => false, 'result' => "Something went wrong while disapproving Interview"));
                    $this->session->set_flashdata("approve_step_2_fail", "Something went wrong while disapproving Interview");
                }
            }
        } else if ($this->input->post('event_type') == "done_sched_1") {
            $data = array(
                "progress_percentage" => 33
            );
            if ($this->ManageProgress_model->edit_progress($data, array("progress_id" => $current_progress->progress_id))) {
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Interview #1 is done for " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                $this->session->set_flashdata("approve_success", "Interview #1 is done");
                echo json_encode(array('success' => true, 'result' => "Interview #1 is done"));
            } else {
                $this->session->set_flashdata("approve_failed", "Something went wrong while approving Interview #1");
                echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Interview #1"));
            }
        } else if ($this->input->post('event_type') == "done_sched_2") {
            $data = array(
                "progress_percentage" => 66
            );
            if ($this->ManageProgress_model->edit_progress($data, array("progress_id" => $current_progress->progress_id))) {
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Interview #2 is done for " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                $this->session->set_flashdata("approve_success", "Interview #2 is done");
                echo json_encode(array('success' => true, 'result' => "Interview #2 is done"));
            } else {
                $this->session->set_flashdata("approve_failed", "Something went wrong while approving Interview #2");
                echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Interview #2"));
            }
        } else if ($this->input->post('event_type') == "done_sched_3") {
            $data = array(
                "progress_percentage" => 100
            );
            if ($this->ManageProgress_model->edit_progress($data, array("progress_id" => $current_progress->progress_id))) {
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Interview #3 is done for " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                $this->session->set_flashdata("approve_success", "Interview #3 is done");
                echo json_encode(array('success' => true, 'result' => "Interview #3 is done"));
            } else {
                $this->session->set_flashdata("approve_failed", "Something went wrong while approving Interview #3");
                echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Interview #3"));
            }
        } else {
            echo json_encode(array('success' => false, 'result' => "Something Went wrong. Try again later."));
        }
    }

    public function step_4() {
        $transaction_id = $this->uri->segment(3);
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $current_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 4))[0];
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 5))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        if ($this->input->post('event_type') == "approve") {
            $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array(
                    'success' => false,
                    'result' => "There are errors in your form. Please check the fields.",
                    'startdate' => form_error('schedule_startdate'),
                    'starttime' => form_error('schedule_starttime'),
                    'enddate' => form_error('schedule_enddate'),
                    'endtime' => form_error('schedule_endtime'),
                    'comment' => form_error('comment')
                ));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
                $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array(
                        'success' => false,
                        'result' => 'There is an existing schedule already!',
                        'startdate' => "<p>There is an existing schedule for this date/time</p>",
                        'starttime' => "<p>There is an existing schedule for this date/time</p>",
                        'enddate' => "",
                        'endtime' => "",
                        'comment' => ""
                    ));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if ($startdate > $enddate) {
                        echo json_encode(array(
                            'success' => false,
                            'result' => 'Start Date/Time is ahead of End Date/Time',
                            'startdate' => "",
                            'starttime' => "",
                            'enddate' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'endtime' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'comment' => ""
                        ));
                    } else {
                        $data = array(
                            "progress_accomplished_at" => time(),
                            "progress_isSuccessful" => 1,
                            "progress_percentage" => 100
                        );
                        $transaction_progress = array(
                            "transaction_progress" => 66
                        );

                        $progress_comment = array(
                            "progress_id" => $current_progress->progress_id,
                            "progress_comment_sender" => $current_user->admin_firstname . " " . $current_user->admin_lastname,
                            "progress_comment_picture" => $current_user->admin_picture,
                            "progress_comment_sender_access" => $current_user->admin_access,
                            "progress_comment_content" => $this->input->post('comment'),
                            "progress_comment_added_at" => time()
                        );
                        $sched = array(
                            "progress_id" => $next_progress->progress_id,
                            "admin_id" => $this->session->userdata("current_user")->admin_id,
                            "schedule_title" => $this->input->post('schedule_title'),
                            "schedule_desc" => $this->input->post('schedule_desc'),
                            "schedule_color" => $this->input->post('schedule_color'),
                            "schedule_startdate" => $startdate,
                            "schedule_enddate" => $enddate
                        );

                        if ($this->ManageProgress_model->approve_adoption_form($data, array("checklist_id" => 4, "transaction_id" => $transaction_id)) && $this->ManageProgress_model->update_progress($transaction_progress, array("transaction_id" => $transaction_id)) && $this->ManageProgress_model->add_progress_comment($progress_comment) && $this->Schedules_model->add_schedule($sched)
                        ) {
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Approved Home Visit (step 4) and added a schedule for next step of " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                            $this->session->set_flashdata("approve_success", "Successfully approved Home Visit!");
                            echo json_encode(array('success' => true, 'result' => "Successfully approved Home Visit!"));
                        } else {
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Home Visit"));
                            $this->session->set_flashdata("approve_failed", "Something went wrong while approving Home Visit");
                        }
                    }
                }
            }
        } else if ($this->input->post('event_type') == "disapprove") {
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "Please provide a comment.", 'comment' => form_error('comment')));
            } else {
                $progress_comment = array(
                    "progress_id" => $current_progress->progress_id,
                    "progress_comment_sender" => $current_user->admin_firstname . " " . $current_user->admin_lastname,
                    "progress_comment_picture" => $current_user->admin_picture,
                    "progress_comment_sender_access" => $current_user->admin_access,
                    "progress_comment_content" => $this->input->post('comment'),
                    "progress_comment_added_at" => time()
                );
                if (
                        $this->ManageProgress_model->add_progress_comment($progress_comment)
                ) {
                    $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Disapproved Meet And Greet (step 2) of " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                    $this->session->set_flashdata("approve_success", "Disapproved Meet And Greet.");
                    echo json_encode(array('success' => true, 'result' => "Disapproved Meet And Greet."));
                } else {
                    echo json_encode(array('success' => false, 'result' => "Something went wrong while disapproving Meet and Greet"));
                    $this->session->set_flashdata("approve_failed", "Something went wrong while disapproving Meet and Greet");
                }
            }
        } else if ($this->input->post('event_type') == "setSched_1") {
            $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array(
                    'success' => false,
                    'result' => "There are errors in your form. Please check the fields.",
                    'startdate' => form_error('schedule_startdate'),
                    'starttime' => form_error('schedule_starttime'),
                    'enddate' => form_error('schedule_enddate'),
                    'endtime' => form_error('schedule_endtime'),
                ));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
                $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array(
                        'success' => false,
                        'result' => 'There is an existing schedule already!',
                        'startdate' => "<p>There is an existing schedule for this date/time</p>",
                        'starttime' => "<p>There is an existing schedule for this date/time</p>",
                        'enddate' => "",
                        'endtime' => "",
                        'comment' => ""
                    ));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if ($startdate > $enddate) {
                        echo json_encode(array(
                            'success' => false,
                            'result' => 'Start Date/Time is ahead of End Date/Time',
                            'startdate' => "",
                            'starttime' => "",
                            'enddate' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'endtime' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'comment' => ""
                        ));
                    } else {
                        //Set Schedule Only 

                        $sched = array(
                            "progress_id" => $next_progress->progress_id,
                            "admin_id" => $this->session->userdata("current_user")->admin_id,
                            "schedule_title" => $this->input->post('schedule_title'),
                            "schedule_desc" => $this->input->post('schedule_desc'),
                            "schedule_color" => $this->input->post('schedule_color'),
                            "schedule_startdate" => $startdate,
                            "schedule_enddate" => $enddate
                        );
                        if ($this->Schedules_model->add_schedule($sched)) {
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Added Visit Chosen Adoptee #1 Schedule for " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                            $this->session->set_flashdata("approve_success", "Schedule set.");
                            echo json_encode(array('success' => true, 'result' => "Schedule set."));
                        } else {
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while setting schedule for Visit Chosen Adoptee"));
                            $this->session->set_flashdata("approve_failed", "Something went wrong while setting schedule for Visit Chosen Adoptee");
                        }
                    }
                }
            }
        } else if ($this->input->post('event_type') == "setSched_2") {
            $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array(
                    'success' => false,
                    'result' => "There are errors in your form. Please check the fields.",
                    'startdate' => form_error('schedule_startdate'),
                    'starttime' => form_error('schedule_starttime'),
                    'enddate' => form_error('schedule_enddate'),
                    'endtime' => form_error('schedule_endtime'),
                ));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
                $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array(
                        'success' => false,
                        'result' => 'There is an existing schedule already!',
                        'startdate' => "<p>There is an existing schedule for this date/time</p>",
                        'starttime' => "<p>There is an existing schedule for this date/time</p>",
                        'enddate' => "",
                        'endtime' => "",
                        'comment' => ""
                    ));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if ($startdate > $enddate) {
                        echo json_encode(array(
                            'success' => false,
                            'result' => 'Start Date/Time is ahead of End Date/Time',
                            'startdate' => "",
                            'starttime' => "",
                            'enddate' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'endtime' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'comment' => ""
                        ));
                    } else {
                        //Set Schedule Only
                        $sched = array(
                            "progress_id" => $next_progress->progress_id,
                            "admin_id" => $this->session->userdata("current_user")->admin_id,
                            "schedule_title" => $this->input->post('schedule_title'),
                            "schedule_desc" => $this->input->post('schedule_desc'),
                            "schedule_color" => $this->input->post('schedule_color'),
                            "schedule_startdate" => $startdate,
                            "schedule_enddate" => $enddate
                        );
                        if ($this->Schedules_model->add_schedule($sched)) {
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Added Visit Chosen Adoptee #2 Schedule for " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                            $this->session->set_flashdata("approve_succes", "Schedule set.");
                            echo json_encode(array('success' => true, 'result' => "Schedule set."));
                        } else {
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while setting schedule for Visit Chosen Adoptee"));
                            $this->session->set_flashdata("approve_failed", "Something went wrong while setting schedule for Visit Chosen Adoptee");
                        }
                    }
                }
            }
        } else {
            echo json_encode(array('success' => false, 'result' => "Something Went wrong. Try again later."));
        }
    }

    public function step_5() {
        $transaction_id = $this->uri->segment(3);
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $current_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 5))[0];
        $next_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 6))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        if ($this->input->post('event_type') == "approve") {
            $this->form_validation->set_rules('schedule_startdate', "Start Date", "required");
            $this->form_validation->set_rules('schedule_starttime', "Start Time", "required");
            $this->form_validation->set_rules('schedule_enddate', "End Date", "required");
            $this->form_validation->set_rules('schedule_endtime', "End Time", "required");
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array(
                    'success' => false,
                    'result' => "There are errors in your form. Please check the fields.",
                    'startdate' => form_error('schedule_startdate'),
                    'starttime' => form_error('schedule_starttime'),
                    'enddate' => form_error('schedule_enddate'),
                    'endtime' => form_error('schedule_endtime'),
                    'comment' => form_error('comment'),
                ));
            } else {
                //IF FORMS ARE VALID
                $startdate = strtotime($this->input->post('schedule_startdate') . " " . $this->input->post('schedule_starttime'));
                $enddate = strtotime($this->input->post('schedule_enddate') . " " . $this->input->post('schedule_endtime'));

                if ($this->Schedules_model->fetchSched(array("schedule_startdate" => $startdate))) {
                    //IF STARTDATE IS ALREADY EXISTING
                    echo json_encode(array(
                        'success' => false,
                        'result' => 'There is an existing schedule already!',
                        'startdate' => "<p>There is an existing schedule for this date/time</p>",
                        'starttime' => "<p>There is an existing schedule for this date/time</p>",
                        'enddate' => "",
                        'endtime' => "",
                        'comment' => ""
                    ));
                } else {
                    //IF STARTDATE IS UNIQUE
                    if ($startdate > $enddate) {
                        echo json_encode(array(
                            'success' => false,
                            'result' => 'Start Date/Time is ahead of End Date/Time',
                            'startdate' => "",
                            'starttime' => "",
                            'enddate' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'endtime' => "<p>End Date/Time must be ahead of Start Date/Time</p>",
                            'comment' => ""
                        ));
                    } else {
                        $data = array(
                            "progress_accomplished_at" => time(),
                            "progress_isSuccessful" => 1
                        );
                        $transaction_progress = array(
                            "transaction_progress" => 83
                        );

                        $progress_comment = array(
                            "progress_id" => $current_progress->progress_id,
                            "progress_comment_sender" => $current_user->admin_firstname . " " . $current_user->admin_lastname,
                            "progress_comment_picture" => $current_user->admin_picture,
                            "progress_comment_sender_access" => $current_user->admin_access,
                            "progress_comment_content" => $this->input->post('comment'),
                            "progress_comment_added_at" => time()
                        );
                        $sched = array(
                            "progress_id" => $next_progress->progress_id,
                            "admin_id" => $this->session->userdata("current_user")->admin_id,
                            "schedule_title" => $this->input->post('schedule_title'),
                            "schedule_desc" => $this->input->post('schedule_desc'),
                            "schedule_color" => $this->input->post('schedule_color'),
                            "schedule_startdate" => $startdate,
                            "schedule_enddate" => $enddate
                        );

                        if ($this->ManageProgress_model->edit_progress($data, array("checklist_id" => 5, "transaction_id" => $transaction_id)) && $this->ManageProgress_model->update_progress($transaction_progress, array("transaction_id" => $transaction_id)) && $this->ManageProgress_model->add_progress_comment($progress_comment) && $this->Schedules_model->add_schedule($sched)
                        ) {
                            $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Approved Visiting Chosen Adoptee (step 5) and added a schedule for next step of " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                            $this->session->set_flashdata("approve_success", "Successfully approved Visiting Chosen Adoptee!");
                            echo json_encode(array('success' => true, 'result' => "Successfully approved Visiting Chosen Adoptee!"));
                        } else {
                            echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Visiting Chosen Adoptee"));
                            $this->session->set_flashdata("approve_failed", "Something went wrong while approving Visiting Chosen Adoptee");
                        }
                    }
                }
            }
        } else if ($this->input->post('event_type') == "disapprove") {
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "Please provide a comment.", 'comment' => form_error("comment")));
            } else {
                $progress_comment = array(
                    "progress_id" => $current_progress->progress_id,
                    "progress_comment_sender" => $current_user->admin_firstname . " " . $current_user->admin_lastname,
                    "progress_comment_picture" => $current_user->admin_picture,
                    "progress_comment_sender_access" => $current_user->admin_access,
                    "progress_comment_content" => $this->input->post('comment'),
                    "progress_comment_added_at" => time()
                );
                if (
                        $this->ManageProgress_model->add_progress_comment($progress_comment)
                ) {
                    $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Disapproved Visited Chosen Adoptee of " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                    $this->session->set_flashdata("approve_success", "Disapproved Visited Chosen Adoptee");
                    echo json_encode(array('success' => true, 'result' => "Disapproved Visited Chosen Adoptee"));
                } else {
                    echo json_encode(array('success' => false, 'result' => "Something went wrong while disapproving Visited Chosen Adoptee"));
                    $this->session->set_flashdata("approve_failed", "Something went wrong while disapproving Interview");
                }
            }
        } else if ($this->input->post('event_type') == "done_sched_1") {
            $data = array(
                "progress_percentage" => 33
            );
            if ($this->ManageProgress_model->edit_progress($data, array("progress_id" => $current_progress->progress_id))) {
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Visited Chosen Adoptee #1 is done for " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                $this->session->set_flashdata("approve_success", "Visited Chosen Adoptee #1 is done");
                echo json_encode(array('success' => true, 'result' => "Visited Chosen Adoptee #1 is done"));
            } else {
                $this->session->set_flashdata("approve_failed", "Something went wrong while approving Visited Chosen Adoptee #1");
                echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Visited Chosen Adoptee #1"));
            }
        } else if ($this->input->post('event_type') == "done_sched_2") {
            $data = array(
                "progress_percentage" => 66
            );
            if ($this->ManageProgress_model->edit_progress($data, array("progress_id" => $current_progress->progress_id))) {
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Visited Chosen Adoptee #2 is done for " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                $this->session->set_flashdata("approve_success", "Visited Chosen Adoptee #2 is done");
                echo json_encode(array('success' => true, 'result' => "Visited Chosen Adoptee #2 is done"));
            } else {
                $this->session->set_flashdata("approve_failed", "Something went wrong while approving Visited Chosen Adoptee #2");
                echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Visited Chosen Adoptee #2"));
            }
        } else if ($this->input->post('event_type') == "done_sched_3") {
            $data = array(
                "progress_percentage" => 100
            );
            if ($this->ManageProgress_model->edit_progress($data, array("progress_id" => $current_progress->progress_id))) {
                $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Visited Chosen Adoptee #3 is done for " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                $this->session->set_flashdata("approve_success", "Visited Chosen Adoptee #3 is done");
                echo json_encode(array('success' => true, 'result' => "Visited Chosen Adoptee #3 is done"));
            } else {
                $this->session->set_flashdata("approve_failed", "Something went wrong while approving Visited Chosen Adoptee #3");
                echo json_encode(array('success' => false, 'result' => "Something went wrong while approving Visited Chosen Adoptee #3"));
            }
        } else {
            echo json_encode(array('success' => false, 'result' => "Something Went wrong. Try again later."));
        }
    }

    public function step_6() {
        $transaction_id = $this->uri->segment(3);
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $current_progress = $this->ManageProgress_model->get_progress(array("progress.transaction_id" => $transaction_id, "progress.checklist_id" => 6))[0];
        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        if ($this->input->post('event_type') == "disapprove") {
            $this->form_validation->set_rules('comment', "Comment", "required");
            if ($this->form_validation->run() == FALSE) {
                //IF THERE ARE ERRORS IN FORMS
                echo json_encode(array('success' => false, 'result' => "Please provide a comment.", "comment" => form_error("comment")));
            } else {
                //Disapprove Step + Comment
                $progress_comment = array(
                    "progress_id" => $current_progress->progress_id,
                    "progress_comment_sender" => $current_user->admin_firstname . " " . $current_user->admin_lastname,
                    "progress_comment_picture" => $current_user->admin_picture,
                    "progress_comment_sender_access" => $current_user->admin_access,
                    "progress_comment_content" => $this->input->post('comment'),
                    "progress_comment_added_at" => time()
                );
                if ($this->ManageProgress_model->add_progress_comment($progress_comment)) {
                    $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Disapproved Released Day (step 6) of " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                    $this->session->set_flashdata("approve_success", "Disapproved Released Day.");
                    echo json_encode(array('success' => true, 'result' => 'Successfully disapproved Released Day.'));
                } else {
                    $this->session->set_flashdata("approve_success", "Something went wrong while disapproving Released Day.");
                    echo json_encode(array('success' => false, 'result' => 'Something went wrong while disapproving Released Day.'));
                }
            }
        } else {
            echo json_encode(array('success' => false, 'result' => "Something Went wrong. Try again later."));
        }
    }

    public function step_6_adoption_proof() {
        $transaction_id = $this->uri->segment(3);
        $current_transaction = $this->PetManagement_model->get_active_transactions(array("transaction.transaction_id" => $transaction_id))[0];
        $config['upload_path'] = './images/adoption_proof/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_ext_tolower'] = true;
        $config['max_size'] = 5120;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if (!empty($_FILES["adoption_picture"]["name"])) {
            if ($this->upload->do_upload('adoption_picture')) {
                $imagePath = "images/adoption_proof/" . $this->upload->data("file_name");
                $progress = array(
                    "progress_accomplished_at" => time(),
                    "progress_isSuccessful" => 1,
                    "progress_percentage" => 100
                );
                $transaction_progress = array(
                    "transaction_progress" => 100,
                    "transaction_isFinished" => 1,
                    "transaction_isActivated" => 0,
                    "transaction_finished_at" => time()
                );
                $adoption = array(
                    "pet_id" => $current_transaction->pet_id,
                    "user_id" => $current_transaction->user_id,
                    "adoption_proof_img" => $imagePath,
                    "adoption_isMissing" => 0,
                    "adoption_adopted_at" => time()
                );

                if ($this->ManageProgress_model->edit_progress($progress, array("checklist_id" => 6, "transaction_id" => $transaction_id)) && $this->ManageProgress_model->update_progress($transaction_progress, array("pet_id" => $current_transaction->pet_id))) {
                    if ($this->ManageProgress_model->add_adoption($adoption) && $this->ManageProgress_model->edit_pet_status($current_transaction->pet_id)) {
                        $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Transaction is done for " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname . " in adopting " . $current_transaction->pet_name . ".");
                        $this->session->set_flashdata("approve_success", $current_transaction->pet_name . " now belongs to " . $current_transaction->user_firstname . " " . $current_transaction->user_lastname);
                    }
                } else {
                    $this->session->set_flashdata("approve_failed", "Something went wrong while approving the Release Day");
                    //echo json_encode(array('success' => false, 'result' => 'Something went wrong while approving the Release Day'));
                }
            } else {
                $this->upload->display_errors();
                $this->session->set_flashdata("uploading_error", "Please make sure that the max size is 5MB the types may only be .jpg, .jpeg, .gif, .png");
            }
        } else {
            //DO METHOD WITHOUT PICTURE PROVIDED
            $this->session->set_flashdata("uploading_error", "You must provide an image before approving.");
        }
        redirect(base_url() . "ManageProgress");
    }

    public function petAdoptionOnlineFormManual_exec() {
        $this->session->set_userdata("petadopterid", $this->uri->segment(3));
        $this->session->set_userdata("petadopteeid", $this->uri->segment(4));
        redirect(base_url() . "ManageProgress/petAdoptionOnlineFormManual");
    }

    public function petAdoptionOnlineFormManual() {
        $manageUserModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 1));
        $manageOfficerModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 2));
        $petManagementModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 3));
        $scheduleModule = $this->AdminDashboard_model->fetch("module_access", array("admin_id" => $this->session->userdata("userid"), "module_id" => 4));

        $current_user = $this->ManageUsers_model->get_users("admin", array("admin_id" => $this->session->userdata("userid")))[0];
        $errors = $this->session->userdata("validationErrors");
        $values = $this->session->userdata("validationValues");
        $selectedPetId = $this->session->userdata("petadopteeid");
        $selectedAdopterId = $this->session->userdata("petadopterid");
        $pet = $this->PetAdoption_model->fetch('pet', array('pet_id' => $selectedPetId))[0];
        $userInfo = $this->PetAdoption_model->fetch('user', array('user_id' => $selectedAdopterId))[0];
        $transaction_id = $this->session->userdata("manage_progress_transaction_id");
        //$current = $this->ManageProgress_model->get_progress(array("transaction.transaction_id" => $transaction_id))[0];
        $current_transaction = $this->PetManagement_model->get_transactions(array("transaction.transaction_id" => $transaction_id))[0];

        $data = array(
            /* MODULE ACCESS */
            'manageUserModule' => $manageUserModule,
            'manageOfficerModule' => $manageOfficerModule,
            'petManagementModule' => $petManagementModule,
            'scheduleModule' => $scheduleModule,
            //////////////////////////////////
            'title' => $current_transaction->user_firstname . " " . $current_transaction->user_lastname . " | Manage Progress",
            'pet' => $pet,
            'userInfo' => $userInfo,
            'form_error' => $errors,
            'set_value' => $values,
            //NAV INFO
            'user_name' => $current_user->admin_firstname . " " . $current_user->admin_lastname,
            'user_picture' => $current_user->admin_picture,
            'user_access' => "Administrator"
        );
        $this->load->view("pet_adoption/includes/header", $data);
        if ($current_user->admin_access == "Subadmin") {
            $this->load->view("subadmin_nav/navheader");
        } else {
            $this->load->view("admin_nav/navheader");
        }
        $this->load->view("manage_progress/petAdoptionOnlineFormManual");
        $this->load->view("pet_adoption/includes/footer");
    }

    public function petAdoptionOnlineFormManual_send() {
        $animal_id = $this->uri->segment(4);
        $user_id = $this->uri->segment(3);
        $this->form_validation->set_rules('numhome', "Tel No. (Home)", "numeric");
        $this->form_validation->set_rules('numwork', "Tel No. (Work)", "numeric");
        $this->form_validation->set_rules('nummobile', "Mobile No.", "required|regex_match[^(09|\+639)\d{9}$^]");
        $this->form_validation->set_rules('numref', "Mobile No.", "required|regex_match[^(09|\+639)\d{9}$^]");
        $this->form_validation->set_rules('nameref', "Name", "required|callback__alpha_dash_space|min_length[2]");
        $this->form_validation->set_rules('relref', "Relationship", "required|callback__alpha_dash_space|min_length[2]");
        $this->form_validation->set_rules('prompt', "Prompt", "required|callback__alpha_dash_space|min_length[2]");
        $this->form_validation->set_rules('num1', "No. 1", "required");
        $this->form_validation->set_rules('num13', "No. 13", "required");
        $this->form_validation->set_rules('num14', "No. 14", "required");
        $this->form_validation->set_rules('num16', "No. 16", "required");
        $this->form_validation->set_rules('num20', "No. 20", "required");
        $this->form_validation->set_rules('num24', "No. 24", "required");
        $this->form_validation->set_rules('yearslived', "Years Lived", "required|is_natural_no_zero");
        $this->form_validation->set_rules('num15', "No. 15", "required|is_natural");
        if ($this->form_validation->run() == FALSE) {
//ERROR IN FORM
            $errors = array(
                "numhome" => form_error('numhome'),
                "numwork" => form_error('numwork'),
                "nummobile" => form_error('nummobile'),
                "numref" => form_error('numref'),
                "nameref" => form_error('nameref'),
                "relref" => form_error('relref'),
                "prompt" => form_error('prompt'),
                "num1" => form_error('num1'),
                "num13" => form_error('num13'),
                "num14" => form_error('num14'),
                "num16" => form_error('num16'),
                "num20" => form_error('num20'),
                "num24" => form_error('num24'),
                "yearslived" => form_error('yearslived'),
                "num15" => form_error('num15'),
            );
            $values = array(
                "numhome" => set_value('numhome'),
                "numwork" => set_value('numwork'),
                "nummobile" => set_value('nummobile'),
                "numref" => set_value('numref'),
                "nameref" => set_value('nameref'),
                "relref" => set_value('relref'),
                "prompt" => set_value('prompt'),
                "num1" => set_value('num1'),
                "num13" => set_value('num13'),
                "num14" => set_value('num14'),
                "num16" => set_value('num16'),
                "num20" => set_value('num20'),
                "num24" => set_value('num24'),
                "yearslived" => set_value('yearslived'),
                "num15" => set_value('num15'),
            );
            $this->session->set_flashdata("validationErrors", $errors);
            $this->session->set_flashdata("validationValues", $values);
            $this->petAdoptionOnlineFormManual_exec();
        } else {

            $date = $this->input->post('date');
            $name = $this->input->post('name');
            $age = $this->input->post('userage');
            $email = $this->input->post('email');
            $address = $this->input->post('address');
            $numhome = $this->input->post('numhome');
            $numwork = $this->input->post('numwork');
            $nummobile = $this->input->post('nummobile');
            $petname = $this->input->post('adoptee_name');
            $petage = $this->input->post('adoptee_age');
            $petage = $this->input->post('adoptee_age');
            $petspecie = $this->input->post('adoptee_specie');
            $petsex = $this->input->post('adoptee_sex');
            $petsterilized = $this->input->post('adoptee_sterilized');
            $petadmission = $this->input->post('adoptee_admission');
            $refname = $this->input->post('nameref');
            $refrelationship = $this->input->post('relref');
            $refno = $this->input->post('numref');
            $prompt = $this->input->post('prompt');
            $interested = $this->input->post('interested');
            $petsize = $this->input->post('size');
            $petbreed = $this->input->post('breed');
            $description = $this->input->post('description');
            $num1 = $this->input->post('num1');
            $num2 = $this->input->post('num2');
            $num3 = $this->input->post('num3');
            $num3Other = $this->input->post('num3Other');
            $num4 = $this->input->post('num4');
            $num5 = $this->input->post('num5');
            $num5Other = $this->input->post('num5Other');
            $yearslived = $this->input->post('yearslived');
            $period = $this->input->post('period');
            $num6 = $this->input->post('num6');
            $num6explain = $this->input->post('num6explain');
            $num7 = $this->input->post('num7');
            $num7specify = $this->input->post('num7specify');
            $num8 = $this->input->post('num8');
            $num9 = $this->input->post('num9');
            $num9explain = $this->input->post('num9explain');
            $num10 = $this->input->post('num10');
            $num10age = $this->input->post('num10age');
            $num11 = $this->input->post('num11');
            $num11explain = $this->input->post('num11explain');
            $num12 = $this->input->post('num12');
            $num12age = $this->input->post('num12age');
            $num13 = $this->input->post('num13');
            $num14 = $this->input->post('num14');
            $num15 = $this->input->post('num15');
            $num16 = $this->input->post('num16');
            $num17 = $this->input->post('num17');
            $num17name = $this->input->post('num17name');
            $num18 = $this->input->post('num18');
            $num18animal = $this->input->post('num18animal');
            $num19 = $this->input->post('num19');
            $num20 = $this->input->post('num20');
            $num21 = $this->input->post('num21');
            $num21fence = $this->input->post('num21fence');
            $num22 = $this->input->post('num22');
            $num22how = $this->input->post('num22how');
            $num23 = $this->input->post('num23');
            $num23specify = $this->input->post('num23specify');
            $num24 = $this->input->post('num24');
            $num25 = $this->input->post('num25');
            $num2ifyes = $this->input->post('num2ifyes');
            $num2ifYesSpecie = $this->input->post('num2ifYesSpecie');
            $transactionId = $this->PetAdoption_model->fetch("transaction", array("user_id" => $user_id))[0];
//            echo "<pre>";
//            print_r($transactionId);
//            echo "</pre>";
//            die;
            if ($num4 == 'Yes') {
                $file_name = $transactionId->transaction_id . "_adopter-" . $transactionId->user_id . "_pet-" . $transactionId->pet_id . ".pdf";
                $config['upload_path'] = './download/permit/';
                $config['allowed_types'] = 'pdf';
                $config['file_ext_tolower'] = true;
                $config['max_size'] = 5120;
                $config['file_name'] = $file_name;
                $this->load->library('upload', $config);

                if (!empty($_FILES["num4file"]["name"])) {
                    if (file_exists("download/permit/" . $file_name)) {
                        unlink("download/permit/" . $file_name);
                    }
                    if ($this->upload->do_upload('num4file')) {
                        $permit = "download/permit/" . $this->upload->data("file_name");
                    } else {
                        echo $this->upload->display_errors();
                        $this->session->set_flashdata("uploading_error", "Please make sure that the max size is 5MB the types may only be .pdf");
                    }
                } else {
//NO PDF SENT
                    $this->session->set_flashdata("uploading_error", "No pdf detected.");
                }
            } else {
                $permit = "NULL";
            }

            if ($num21 == 'Yes') {
                $file_name = $transactionId->transaction_id . "_adopter-" . $transactionId->user_id . "_pet-" . $transactionId->pet_id;
                $config['upload_path'] = './images/fence/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['file_ext_tolower'] = true;
                $config['max_size'] = 5120;
                $config['file_name'] = $file_name;
                $this->load->library('upload', $config);

                if (!empty($_FILES["num21file"]["name"])) {
                    if (file_exists("images/fence/" . $file_name)) {
                        unlink("images/fence/" . $file_name);
                    }
                    if ($this->upload->do_upload('num21file')) {
                        $imagePath = "images/fence/" . $this->upload->data("file_name");
                    } else {
                        echo $this->upload->display_errors();
                    }
                } else {
                    $imagePath = "images/fence/fence.jpg";
                }
            } else {
                $imagePath = "NULL";
            }
            $data = array(
                "transaction_id" => $transactionId->transaction_id,
                "adoption_form_image_path" => $imagePath,
                "adoption_form_permit" => $permit,
                "adoption_form_isPending" => 1,
                "adoption_form_added_at" => time()
            );
            if ($this->PetAdoption_model->singleinsert("adoption_form", $data)) {
                $pet = $this->PetAdoption_model->fetch("pet", array("pet_id" => $animal_id))[0];
                $adoptionForm = $this->PetAdoption_model->fetch("adoption_form", array("transaction_id" => $transactionId->transaction_id))[0];
                $pdf = new Pdf();
                $pdf->SetTitle('Online Adoption Form');
                $pdf->SetHeaderMargin(30);
                $pdf->SetTopMargin(10);
                $pdf->setFooterMargin(20);
                $pdf->SetAutoPageBreak(false);
                $pdf->SetAuthor('Author');
                $pdf->SetDisplayMode('real', 'default');
                $pdf->AddPage();
                $html = '<img src ="https://preview.ibb.co/dFVuoS/header.png" style="height:100px" class ="img-fluid">';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<div style="text-align:right"><label style="font-weight:bold">Date of Application : </label>' . $date . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<div style="text-align:left; font-size:10px;">You will still need to have an interview with an adoption counsellor, prior to approval of your application.<br>
                 Filling out this form will save time at the shelter, but not substitute for an in-person interview.<br></div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<div style="text-align:left"><label style="font-weight:bold">Name : </label>' . $name . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . '<label style="font-weight:bold;">Age : </label>' . $age . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . '<label style="font-weight:bold;">Email : </label>' . $email . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<div style="text-align:left"><label style="font-weight:bold">Address : </label>' . $address . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                if (empty($numhome)) {
                    $html = '<div style="text-align:left"><label style="font-weight:bold">Tel Nos. (Home) : </label> N/A <label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Work) : </label> N/A <label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile No. : </label>' . $nummobile . '</div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    $html = '<div style="text-align:left"><label style="font-weight:bold">Tel Nos. (Home) : </label>' . $numhome . '<label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Work) : </label>' . $numwork . '<label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile No. : </label>' . $nummobile . '</div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                }
                $html = '<br><div style="text-align:left"><label style="font-weight:bold; color:red;">Chosen Adoptee : </label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left; "><img src = "' . base_url() . $pet->pet_picture . '" style="height:150px;"></div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left; "><label style="font-weight:bold">Pet Name : </label>' . $petname . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight:bold;">Age : </label>' . $petage . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left; "><label style="font-weight:bold">Specie : </label>' . $petspecie . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight:bold;">Sex : </label>' . $petsex . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left; "><label style="font-weight:bold">Neutered/Spayed : </label>' . $petsterilized . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight:bold;">Admission : </label>' . $petadmission . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left"><label style="font-weight:bold; color:red;">Personal Reference : </label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left; "><label style="font-weight:bold">Name : </label>' . $refname . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight:bold;">Relationship : </label>' . $refrelationship . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight:bold;">Tel No. : </label>' . $refno . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left"><label style="font-weight:bold">What prompted you to come to PARC? </label>' . $prompt . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left"><label style="font-weight:bold">Are you interested in a: </label>' . $interested . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left"><label style="font-weight:bold">Size : </label>' . $petsize . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left;"><label style="font-weight:bold">Breed/Mix : </label>' . $petbreed . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left;"><label style="font-weight:bold">Name/description of animal(if animal is available at PARC) : </label>' . $description . '</div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                $pdf->AddPage(); //ADD PAGE
                $html = '<img src ="https://preview.ibb.co/j6tVTS/questionaire.png" style="height:100px;" class ="img-fluid">';
                $pdf->writeHTML($html, true, false, true, false, '');

                $html = '<br><div style="text-align:left"><label style="font-weight:bold">1.) Why did you decide to adopt an animal from PAWS?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num1 . '</label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                if ($num2 == 'No') {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">2.) Have you adopted form PAWS/PARC before?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num2 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    if (empty($num2ifyes)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">2.) Have you adopted form PAWS/PARC before?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num2 . '</label><br><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When is the latest?</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="color:red">- N/A </label><br><label style="font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;What animal?</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="color:red">- ' . $num2ifYesSpecie . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">2.) Have you adopted form PAWS/PARC before?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num2 . '</label><br><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When is the latest?</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="color:red">- ' . $num2ifyes . '</label><br><label style="font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;What animal?</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="color:red">- ' . $num2ifYesSpecie . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                }
                if ($num3 == 'Other') {
                    if (empty($num3Other)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">3.) What type of building do you live in?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Specify <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num3 . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- N/A</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">3.) What type of building do you live in?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Specify <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num3 . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ' . $num3Other . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                } else {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">3.) What type of building do you live in?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num3 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                }
                $html = '<br><div style="text-align:left"><label style="font-weight:bold">4.) Do you rent?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num4 . '</label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                if ($num5 == 'Other') {
                    if (empty($num5Other)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">5.) Who do you live with?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; How long have you been in this address?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num5 . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ' . $yearslived . ' ' . $period . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Specify<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- N/A </label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">5.) Who do you live with?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; How long have you been in this address?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num5 . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ' . $yearslived . ' ' . $period . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Specify<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num5Other . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                } else {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">5.) Who do you live with?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; How long have you been in this address?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num5 . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ' . $yearslived . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                }
                if ($num6 == 'No') {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">6.)  Are you planning to move in the next 6 months?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num6 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    if (empty($num6explain)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">6.)  Are you planning to move in the next 6 months?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num6 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Where?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- N/A </label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">6.)  Are you planning to move in the next 6 months?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num6 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Where?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num6explain . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                }
                if ($num7 == 'Other') {
                    if (empty($num7specify)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">7.) For whom are you adopting animal?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Specify <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num7 . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- N/A </label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">7.) For whom are you adopting animal?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Specify <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num7 . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ' . $num7specify . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                } else {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">7.) For whom are you adopting animal?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num7 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                }

                $html = '<br><div style="text-align:left"><label style="font-weight:bold">8.) Will the whole family share in the care in the care of animal?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num8 . '</label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');

                if ($num9 == 'No') {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">9.) Is there anyone in your household who has objection(s) to the arrangement?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num9 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    if (empty($num9explain)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">9.) Is there anyone in your household who has objection(s) to the arrangement?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num9 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Explain.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- N/A </label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">9.) Is there anyone in your household who has objection(s) to the arrangement?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num9 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Explain.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num9explain . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                }

                if ($num10 == 'No') {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">10.) Are there any children that visit your home frequently?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num10 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    if (empty($num10age)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">10.) Are there any children that visit your home frequently?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num10 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Age Range<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- N/A </label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">10.) Are there any children that visit your home frequently?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num10 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Age Range<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num10age . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                }

                $pdf->AddPage(); //ADD PAGE

                if ($num11 == 'No') {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">11.) Are there any other regular visitors to your home, human or animal, with which your new companion must get along?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num11 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    if (empty($num11explain)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">11.) Are there any other regular visitors to your home, human or animal, with which your new companion must get along?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num11 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Explain.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- N/A </label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">11.) Are there any other regular visitors to your home, human or animal, with which your new companion must get along?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num11 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Explain.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num11explain . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                }
                if ($num12 == 'No') {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">12.) Are any members of your household allergic to cats/dogs?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num12 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    
                }
                if ($num12 == 'No') {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">12.) Are any members of your household allergic to cats/dogs?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num12 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    if (empty($num12age)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">12.) Are any members of your household allergic to cats/dogs?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num12 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Explain.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- N/A </label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">12.) Are any members of your household allergic to cats/dogs?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num12 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Explain.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num12age . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                }
                $html = '<br><div style="text-align:left"><label style="font-weight:bold">13.) What will happen to this animal if you have to move unexpectedly?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num13 . '</label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');
                $html = '<br><div style="text-align:left"><label style="font-weight:bold">14.) What kind of behavior(s) do you feel unable to accept?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num14 . '</label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');
                $html = '<br><div style="text-align:left"><label style="font-weight:bold">15.) How many hours in an average workday will your companion animal spend without a human?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num15 . '</label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');
                $html = '<br><div style="text-align:left"><label style="font-weight:bold">16.) What will happen to your companion animal, when you go on a vacation or in case of emergency?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num16 . '</label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');
                if ($num17 == 'No') {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">17.) Do you have regular veterinarian?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num17 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    if (empty($num17name)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">17.) Do you have regular veterinarian?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num17 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Name.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- N/A </label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">17.) Do you have regular veterinarian?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num17 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Name.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num17name . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                }
                if ($num18 == 'No') {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">18.) Do you have other companion animal(s) in the past?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num18 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">18.) Do you have other companion animal(s) in the past?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num18 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                    $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Name.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num18animal . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                }
                $html = '<br><div style="text-align:left"><label style="font-weight:bold">19.) What part of your house do you want this animal to stay?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num19 . '</label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');
                $html = '<br><div style="text-align:left"><label style="font-weight:bold">20.) Where will this animal be kept during the Day? Night?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num20 . '</label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');
                if ($num21 == 'No') {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">21.) Do you have a fenced yard?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num21 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    if (empty($num21fence)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">21.) Do you have a fenced yard?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num21 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Fence height and type<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num21fence . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<br><div style="text-align:left; "><img src = "' . base_url() . $adoptionForm->adoption_form_image_path . '" style="height:150px;"></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">21.) Do you have a fenced yard?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num21 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;Fence height and type<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- N/A </label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<br><div style="text-align:left; "><img src = "' . base_url() . $adoptionForm->adoption_form_image_path . '" style="height:150px;"></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                }
                $pdf->AddPage(); //ADD PAGE
                if ($num22 == 'Yes') {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">22.) If adopting a dog, does fencing completely enclose the yard?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num22 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    if (empty($num22how)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">22.) If adopting a dog, does fencing completely enclose the yard?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num22 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;How will you handle he dog\'s exercise and toilet duties?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- N/A </label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">22.) If adopting a dog, does fencing completely enclose the yard?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num22 . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                        $html = '<div style="text-align:left"><label style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;How will you handle he dog\'s exercise and toilet duties?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num22how . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                }
                if ($num23 == 'Other') {
                    if (empty($num23specify)) {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">23.) If adopting a cat, where will the litterbox be kept?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Specify <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num23 . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- N/A </label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    } else {
                        $html = '<br><div style="text-align:left"><label style="font-weight:bold">23.) If adopting a cat, where will the litterbox be kept?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Specify <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num23 . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ' . $num23specify . '</label></div>';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                } else {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">23.) If adopting a cat, where will the litterbox be kept?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num23 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                }
                $html = '<br><div style="text-align:left"><label style="font-weight:bold">24.) As a matter of policy, PARC will neuter all animals prior to releasing for adoption. What is your opinion about spaying and neutering (kapon) of companion animals?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num24 . '</label></div>';
                $pdf->writeHTML($html, true, false, true, false, '');
                if (empty($num25)) {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">25.) Do you have questions and comments?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- N/A </label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                } else {
                    $html = '<br><div style="text-align:left"><label style="font-weight:bold">25.) Do you have questions and comments?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="color:red">- ' . $num25 . '</label></div>';
                    $pdf->writeHTML($html, true, false, true, false, '');
                }
//[Document_Root] sa pag Up
                $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'download/pending/' . $transactionId->transaction_id . '_adopter-' . $transactionId->user_id . '_pet-' . $transactionId->pet_id . '_OnlineAdoptionFormManual.pdf', 'F');
                $data = array(
                    "adoption_form_location" => 'download/pending/' . $transactionId->transaction_id . '_adopter-' . $transactionId->user_id . '_pet-' . $transactionId->pet_id . '_OnlineAdoptionFormManual.pdf',
                );
//            $this->PetAdoption_model->update_adoption_form($data, array("transaction_id" => $transactionId->transaction_id));
//            echo $this->db->last_query();
//            die;
                if ($this->PetAdoption_model->update_adoption_form($data, array("transaction_id" => $transactionId->transaction_id))) {

                    $this->SaveEventAdmin->trail($this->session->userdata("userid"), "Fill up an adoption form manually.");
                    redirect(base_url() . "ManageProgress/");
                }
            }
        }
    }

}
