<?php

class PetAdoption extends CI_Controller {

    function __construct() {
        parent::__construct();
//---> HELPERS HERE!
        $this->load->helper('download');
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
//Do nothing
            } else if ($this->session->userdata("user_access") == "subadmin") {
//SUBADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as " . $current_user->user_firstname . " " . $current_user->user_lastname);
                redirect(base_url() . "SubadminDashboard");
            } else if ($this->session->userdata("user_access") == "admin") {
//ADMIN!
                $this->session->set_flashdata("err_5", "You are currently logged in as " . $current_user->admin_firstname . " " . $current_user->admin_lastname);
                redirect(base_url() . "AdminDashboard");
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

    public function download_exec() {
        $this->session->set_userdata("animal_id", $this->uri->segment(3));
        redirect(base_url() . "PetAdoption/download");
    }

    public function download() {
        $animal_id = $this->session->userdata("animal_id");
        $data = array(
            'pet_id' => $animal_id,
            'user_id' => $this->session->userdata("userid"),
            'transaction_progress' => 0,
            'transaction_isActivated' => 1,
            'transaction_started_at' => time(),
            'transaction_finished_at' => 0
        );

        if ($this->PetAdoption_model->singleinsert("transaction", $data)) {
            redirect(base_url() . "PetAdoption/progress");
        }
    }

    public function progress() {
        $transactionId = $this->PetAdoption_model->fetch("transaction", array("user_id" => $this->session->userdata("userid")))[0];

        $data = array(
            array(
                'checklist_id' => 1,
                'transaction_id' => $transactionId->transaction_id,
                'progress_percentage' => 0,
                'progress_accomplished_at' => 0,
                'progress_isSuccessful' => 0,
            ),
            array(
                'checklist_id' => 2,
                'transaction_id' => $transactionId->transaction_id,
                'progress_percentage' => 0,
                'progress_accomplished_at' => 0,
                'progress_isSuccessful' => 0,
            ),
            array(
                'checklist_id' => 3,
                'transaction_id' => $transactionId->transaction_id,
                'progress_percentage' => 0,
                'progress_accomplished_at' => 0,
                'progress_isSuccessful' => 0,
            ),
            array(
                'checklist_id' => 4,
                'transaction_id' => $transactionId->transaction_id,
                'progress_percentage' => 0,
                'progress_accomplished_at' => 0,
                'progress_isSuccessful' => 0,
            ),
            array(
                'checklist_id' => 5,
                'transaction_id' => $transactionId->transaction_id,
                'progress_percentage' => 0,
                'progress_accomplished_at' => 0,
                'progress_isSuccessful' => 0,
            ),
            array(
                'checklist_id' => 6,
                'transaction_id' => $transactionId->transaction_id,
                'progress_percentage' => 0,
                'progress_accomplished_at' => 0,
                'progress_isSuccessful' => 0,
            )
        );

        if ($this->PetAdoption_model->insert("progress", $data)) {
            redirect(base_url() . "MyProgress");
        }
    }

    public function index() {
        $allPets = $this->PetAdoption_model->fetchPetDesc("pet");
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];
        $petAdopters = $this->PetAdoption_model->fetchJoinThreeProgressDesc("transaction", "pet", "transaction.pet_id = pet.pet_id", "user", "transaction.user_id = user.user_id");
        $userInfo = $this->PetAdoption_model->fetchJoinProgress(array('transaction.user_id' => $this->session->userid));

        $data = array(
            'title' => "Pet Adoption | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User",
            'pets' => $allPets,
            'adopters' => $petAdopters,
            'userInfo' => $userInfo
        );
        $this->load->view("pet_adoption/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("pet_adoption/main");
        $this->load->view("pet_adoption/includes/footer");
    }

    public function petAdoptionOnlineForm_exec() {
        $this->session->set_userdata("petadopterid", $this->uri->segment(3));
        redirect(base_url() . "PetAdoption/petAdoptionOnlineForm");
    }

    public function petAdoptionOnlineForm() {
        $errors = $this->session->userdata("validationErrors");
        $selectedPetId = $this->session->userdata("petadopterid");
        $userInfo = $this->PetAdoption_model->getinfo('user', array('user_id' => $this->session->userid))[0];
        $pet = $this->PetAdoption_model->fetch('pet', array('pet_id' => $selectedPetId))[0];
        $current_user = $this->ManageUsers_model->get_users("user", array("user_id" => $this->session->userdata("userid")))[0];

        $data = array(
            'title' => "Online Adoption Application Form | " . $current_user->user_firstname . " " . $current_user->user_lastname,
            //NAV INFO
            'user_name' => $current_user->user_firstname . " " . $current_user->user_lastname,
            'user_picture' => $current_user->user_picture,
            'user_access' => "User",
            'wholeUrl' => base_url(uri_string()),
            'pet' => $pet,
            'userInfo' => $userInfo,
            'form_error' => $errors
        );
        $this->load->view("pet_adoption/includes/header", $data);
        $this->load->view("user_nav/navheader");
        $this->load->view("pet_adoption/petAdoptionOnlineForm");
        $this->load->view("pet_adoption/includes/footer");
    }

    public function petAdoptionOnlineForm_send() {
        $animal_id = $this->uri->segment(3);
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
        $this->form_validation->set_rules('num15', "No. 15", "required|is_natural_no_zero");
        if ($this->form_validation->run() == FALSE) {
            //ERROR IN FORM
            $errors = array(
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
            $this->session->set_userdata("validationErrors", $errors);
            $this->petAdoptionOnlineForm_exec();
        } else {
            $data = array(
                'pet_id' => $animal_id,
                'user_id' => $this->session->userdata("userid"),
                'transaction_progress' => 0,
                'transaction_isActivated' => 1,
                'transaction_started_at' => time(),
                'transaction_finished_at' => 0
            );

            if ($this->PetAdoption_model->singleinsert("transaction", $data)) {
                $transactionId = $this->PetAdoption_model->fetch("transaction", array("user_id" => $this->session->userdata("userid"), "pet_id" => $animal_id))[0];

                $data = array(
                    array(
                        'checklist_id' => 1,
                        'transaction_id' => $transactionId->transaction_id,
                        'progress_percentage' => 0,
                        'progress_accomplished_at' => 0,
                        'progress_isSuccessful' => 0,
                    ),
                    array(
                        'checklist_id' => 2,
                        'transaction_id' => $transactionId->transaction_id,
                        'progress_percentage' => 0,
                        'progress_accomplished_at' => 0,
                        'progress_isSuccessful' => 0,
                    ),
                    array(
                        'checklist_id' => 3,
                        'transaction_id' => $transactionId->transaction_id,
                        'progress_percentage' => 0,
                        'progress_accomplished_at' => 0,
                        'progress_isSuccessful' => 0,
                    ),
                    array(
                        'checklist_id' => 4,
                        'transaction_id' => $transactionId->transaction_id,
                        'progress_percentage' => 0,
                        'progress_accomplished_at' => 0,
                        'progress_isSuccessful' => 0,
                    ),
                    array(
                        'checklist_id' => 5,
                        'transaction_id' => $transactionId->transaction_id,
                        'progress_percentage' => 0,
                        'progress_accomplished_at' => 0,
                        'progress_isSuccessful' => 0,
                    ),
                    array(
                        'checklist_id' => 6,
                        'transaction_id' => $transactionId->transaction_id,
                        'progress_percentage' => 0,
                        'progress_accomplished_at' => 0,
                        'progress_isSuccessful' => 0,
                    )
                );

                if ($this->PetAdoption_model->insert("progress", $data)) {
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
                        $html = '<img src ="images/logo/header.png" style="height:100px" class ="img-fluid">';
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

                        $html = '<img src ="images/logo/questionaire.png" style="height:100px;" class ="img-fluid">';
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
                        //[Docuement_Root] sa pag Up
                        $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'petexphil/download/pending/' . $transactionId->transaction_id . '_adopter-' . $transactionId->user_id . '_pet-' . $transactionId->pet_id . '_OnlineAdoptionForm.pdf', 'F');
                        $data = array(
                            "adoption_form_location" => 'download/pending/' . $transactionId->transaction_id . '_adopter-' . $transactionId->user_id . '_pet-' . $transactionId->pet_id . '_OnlineAdoptionForm.pdf',
                        );
                        if ($this->PetAdoption_model->update_adoption_form($data, array("transaction_id" => $transactionId->transaction_id))) {
                            redirect(base_url() . "MyProgress/");
                        }
                    }
                }
            }
        }
    }

}
