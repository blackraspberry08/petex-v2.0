<?php

class Android extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Android_model');
    }

    public function index() {
        //nothing to see here.
    }

    public function getJson_pet() {
        $query = $this->Android_model->fetch("pet", array("pet_access" => 1));
        $data = array(
            'result' => $query
        );
        $this->load->view("android/getJson_pet", $data);
    }

    public function getJson_user() {
        $user_id = $this->input->post("user_id");
        $query = $this->Android_model->fetch("user", array("user_status" => 1, "user_id" => $user_id));
        $data = array(
            'result' => $query
        );
        $this->load->view("android/getJson_user", $data);
    }

    public function getJson_adoption() {
        $user_id = $this->input->post("user_id");
        //$user_id = 20170001;
        $query = $this->Android_model->fetchTwo("adoption", "
				adoption_id,
				adoption.pet_id,
				adoption.user_id,
				adoption_proof_img,
				adoption_isRead,
				adoption_isMissing,
				adoption_adopted_at,
				user_firstname,
				user_lastname,
				user_username,
				user_password,
				user_bday,
				user_sex,
				user_status,
				user_email,
				user_verification_code,
				user_isverified,
				user_contact_no,
				user_picture,
				user_address,
				user_added_at,
				user_updated_at,
				pet_nfc_tag,
				pet_name,
				pet_bday,
				pet_specie,
				pet_sex,
				pet_breed,
				pet_size,
				pet_status,
				pet_access,
				pet_neutered_spayed,
				pet_admission,
				pet_description,
				pet_history,
				pet_picture,
				pet_video,
				pet_added_at,
				pet_updated_at", "user", "adoption.user_id = user.user_id", "pet", "adoption.pet_id = pet.pet_id", array("adoption.user_id" => $user_id));
        $data = array(
            'result' => $query
        );
        $this->load->view("android/getJson_adoption", $data);
    }

    public function getJson_adoption_isMissing() {
        $query = $this->Android_model->fetchTwo("adoption", "adoption_id,
				adoption.pet_id,
				adoption.user_id,
				adoption_proof_img,
				adoption_isRead,
				adoption_isMissing,
				adoption_adopted_at,
				user_firstname,
				user_lastname,
				user_username,
				user_password,
				user_bday,
				user_sex,
				user_status,
				user_email,
				user_verification_code,
				user_isverified,
				user_contact_no,
				user_picture,
				user_address,
				user_added_at,
				user_updated_at,
				pet_nfc_tag,
				pet_name,
				pet_bday,
				pet_specie,
				pet_sex,
				pet_breed,
				pet_size,
				pet_status,
				pet_access,
				pet_neutered_spayed,
				pet_admission,
				pet_description,
				pet_history,
				pet_picture,
				pet_video,
				pet_added_at,
				pet_updated_at", "user", "adoption.user_id = user.user_id", "pet", "adoption.pet_id = pet.pet_id", array("adoption_isMissing" => 1));
        $data = array(
            'result' => $query
        );
        $this->load->view("android/getJson_adoption", $data);
    }

    public function getJson_all_adoption() {
        $query = $this->Android_model->fetchTwo("adoption", "adoption_id,
				adoption.pet_id,
				adoption.user_id,
				adoption_proof_img,
				adoption_isRead,
				adoption_isMissing,
				adoption_adopted_at,
				user_firstname,
				user_lastname,
				user_username,
				user_password,
				user_bday,
				user_sex,
				user_status,
				user_email,
				user_verification_code,
				user_isverified,
				user_contact_no,
				user_picture,
				user_address,
				user_added_at,
				user_updated_at,
				pet_nfc_tag,
				pet_name,
				pet_bday,
				pet_specie,
				pet_sex,
				pet_breed,
				pet_size,
				pet_status,
				pet_access,
				pet_neutered_spayed,
				pet_admission,
				pet_description,
				pet_history,
				pet_picture,
				pet_video,
				pet_added_at,
				pet_updated_at", "user", "adoption.user_id = user.user_id", "pet", "adoption.pet_id = pet.pet_id");
        //echo $this->db->last_query();
        $data = array(
            'result' => $query
        );
        $this->load->view("android/getJson_adoption", $data);
    }

    public function edit_pet() {
        $pet_id = $this->input->post("pet_id");
        $user_id = $this->input->post("user_id");
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $pet_id))[0];

        $config['upload_path'] = './images/animal/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_ext_tolower'] = true;
        $config['max_size'] = 5120;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        if (!empty($_FILES["pet_picture"]["name"])) {
            if ($this->upload->do_upload('pet_picture')) {
                $imagePath = "images/animal/" . $this->upload->data("file_name");

                if ($animal->pet_picture == "images/animal/dog_temp_pic.png" || $animal->pet_picture == "images/animal/cat_temp_pic.png") {
                    //DON'T UNLINK
                } else {
                    unlink($animal->pet_picture);
                }
            } else {
                //echo $this->upload->display_errors();
                //$this->session->set_flashdata("uploading_error", "Please make sure that the max size is 5MB the types may only be .jpg, .jpeg, .gif, .png");
                $jsonStr = array("success" => false, "message" => "Please make sure that the max size is 5MB the types may only be .jpg, .jpeg, .gif, .png");
                echo json_encode($jsonStr);
            }
        } else {
            //DO METHOD WITHOUT PICTURE PROVIDED
            if ($animal->pet_picture == "images/animal/dog_temp_pic.png" || $animal->pet_picture == "images/animal/cat_temp_pic.png") {
                if ($this->input->post('pet_specie') == "canine") {
                    $imagePath = "images/animal/dog_temp_pic.png";
                } else {
                    $imagePath = "images/animal/cat_temp_pic.png";
                }
            } else {
                $imagePath = $animal->pet_picture;
            }
        }

        $data = array(
            "pet_name" => $this->input->post("pet_name"),
            "pet_description" => $this->input->post("pet_desc"),
            "pet_picture" => $imagePath
        );
        $this->PetManagement_model->update_animal_record($data, array("pet_id" => $pet_id));
        $jsonStr = array("success" => true, "message" => "Changes are saved");
        $this->SaveEventUser->trail($user_id, "Updated the record of " . $animal->pet_name);
        echo json_encode($jsonStr);
        
    }

    public function assign_nfc_to_pet() {
        $pet_id = $this->input->post("pet_id");
        $animal = $this->PetManagement_model->get_animal_info(array("pet_id" => $pet_id))[0];
        $user_id = $this->input->post("user_id");
        
        $data = array(
            "pet_nfc_tag" => $this->input->post("pet_nfc_tag"),
        );

        $this->PetManagement_model->update_animal_record($data, array("pet_id" => $pet_id));
        $jsonStr = array("success" => true, "message" => "NFC Tag is assigned to" . $animal->pet_name);
        $this->SaveEventUser->trail($user_id, "Assigned NFC to " . $animal->pet_name);
        echo json_encode($jsonStr);
    }

    
    // ================= (NOT DONE) PUTTING TO EVENTS ==========================
    public function report_pet_missing() {
        $adoption_id = $this->input->post("adoption_id");
        
        $data = array(
            "adoption_isMissing" => 1,
        );

        $this->Android_model->report_missing($data, $adoption_id);
        $jsonStr = array("success" => true, "message" => "Successfully reported this pet as missing.");
        echo json_encode($jsonStr);
    }

    public function pet_found() {
        $pet_id = $this->input->post("pet_id");
        $data = array(
            "adoption_isMissing" => 0,
        );

        $this->Android_model->pet_found($data, $pet_id);
        $jsonStr = array("success" => true, "message" => "Successfully found the pet.");
        echo json_encode($jsonStr);
    }

    public function getJson_adoption_by_id() {
        $adoption_id = $this->input->post("adoption_id");
        $query = $this->Android_model->fetchTwo("adoption", "adoption_id,
				adoption.pet_id,
				adoption.user_id,
				adoption_proof_img,
				adoption_isRead,
				adoption_isMissing,
				adoption_adopted_at,
				user_firstname,
				user_lastname,
				user_username,
				user_password,
				user_bday,
				user_sex,
				user_status,
				user_email,
				user_verification_code,
				user_isverified,
				user_contact_no,
				user_picture,
				user_address,
				user_added_at,
				user_updated_at,
				pet_nfc_tag,
				pet_name,
				pet_bday,
				pet_specie,
				pet_sex,
				pet_breed,
				pet_size,
				pet_status,
				pet_access,
				pet_neutered_spayed,
				pet_admission,
				pet_description,
				pet_history,
				pet_picture,
				pet_video,
				pet_added_at,
				pet_updated_at", "user", "adoption.user_id = user.user_id", "pet", "adoption.pet_id = pet.pet_id", array("adoption_id" => $adoption_id));
        //echo $this->db->last_query();
        $data = array(
            'result' => $query
        );
        $this->load->view("android/getJson_adoption", $data);
    }

    public function validate_user() {
        $dataUser = array(
            'user_username' => $this->input->post('username'),
            'user_password' => sha1($this->input->post('password'))
        );

        $accountDetailsUser = $this->Login_model->getinfo("user", $dataUser)[0];

        if (!$accountDetailsUser) {
            //OOPS no accounts like that!
            $user = array(
                "success" => false,
                "result" => "Invalid Account",
                "user_id" => "0"
            );
            echo json_encode($user);
        } else {
            if ($accountDetailsUser->user_status == 0) {
                //OOPS user is blocked by the admin. Please contact the admin.
                $user = array(
                    "success" => false,
                    "result" => "Account is blocked",
                    "user_id" => "0"
                );
                echo json_encode($user);
            } else {
                if ($accountDetailsUser->user_isverified == 0) {
                    $user = array(
                        "success" => false,
                        "result" => "Account is not yet verified",
                        "user_id" => "0"
                    );
                    echo json_encode($user);
                } else {
                    $user = array(
                        "success" => true,
                        "result" => "Successfully found the user",
                        "user_id" => $accountDetailsUser->user_id
                    );
                    echo json_encode($user);
                }
            }
        }
    }

    public function add_to_discovery() {

        $data = array(
            "user_id" => $this->input->post("user_id"),
            "pet_id" => $this->input->post("pet_id"),
            "discovery_latitude" => $this->input->post("latitude"),
            "discovery_longitude" => $this->input->post("longitude"),
            "discovery_added_at" => time()
        );

        if ($this->Android_model->pet_discovery($data)) {
            //SUCCESS
            $response = array(
                "success" => true,
                "result" => "Successfully inserted in discovery"
            );
            echo json_encode($response);
        } else {
            //FAILED
            $response = array(
                "success" => false,
                "result" => "Something went wrong while inserting to discovery table"
            );
            echo json_encode($response);
        }
    }

    public function getJson_discoveries() {
        $pet_id = $this->input->post("pet_id");
        //$user_id = $this->input->post("user_id");
        //$query = $this->Android_model->get_discoveries(array("discovery.pet_id" => $pet_id, "discovery.user_id" => $user_id));
        $query = $this->Android_model->get_discoveries(array("discovery.pet_id" => $pet_id));
        $data = array(
            "result" => $query
        );

        $this->load->view("android/getJson_discoveries", $data);
    }

}
