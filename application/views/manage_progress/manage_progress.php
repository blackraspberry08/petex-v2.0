<?php

function getIcon($var) {
    if ($var == 1) {
        echo "fa fa-envelope";
    } else if ($var == 2) {
        echo "fa fa-handshake-o";
    } else if ($var == 3) {
        echo "fa fa-comments";
    } else if ($var == 4) {
        echo "fa fa-eye";
    } else if ($var == 5) {
        echo "fa fa-home";
    } else if ($var == 6) {
        echo "fa fa-check";
    }
}

function determine_access($access) {
    switch ($access) {
        case "Admin": {
                return "Administrator";
            }
        case "Subadmin": {
                return "PAWS Officer";
            }
        case "User": {
                return "Pet Adopter";
            }
        default: {
                return "";
            }
    }
}
?>
<style>
    .image-fit{
        padding:5px;
        object-fit: contain;
    }
    .image-fit img{
        width:55px;
        height:55px;
        border-radius: 50%;
    }
</style>
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-paw"></i> Adoption Information
    </div>
    <div class="card-body">
        <div class = "row mb-3">
            <div class ="col-md-5">
                <div class="card bg-light mb-3">
                    <div class="card-header text-center bg-success">Pet Adopter</div>
                    <div class="card-body text-center">
                        <div class = "image-fit">
                            <a href = "<?= base_url() . $transaction->user_picture ?>" data-toggle="lightbox">
                                <img class="d-flex mx-auto" src="<?= base_url() . $transaction->user_picture ?>"  style = "height:75px; width:75px;" alt = "<?= $transaction->user_firstname . " " . $transaction->user_lastname ?>">
                            </a>
                        </div>
                        <h5 class="card-title"><?= $transaction->user_firstname . " " . $transaction->user_lastname ?></h5>
                        <a href ="#" class = "btn btn-outline-success" data-toggle = "modal" data-target = "#user_detail_<?= $transaction->user_id; ?>">Show Information</a>
                    </div>
                </div>
            </div>
            <div class ="col-md-2 align-self-center text-center" style = "font-size:1.3vw;">
                <?php if ($this->session->userdata("pet_status") != "Adopted"): ?>
                    <i class ="fa fa-long-arrow-right"></i> Adopting <i class ="fa fa-long-arrow-right"></i>
                <?php else: ?>
                    <i class ="fa fa-long-arrow-right"></i> Adopted <i class ="fa fa-long-arrow-right"></i>
                <?php endif; ?>
            </div>
            <div class ="col-md-5">
                <div class="card bg-light mb-3">
                    <div class="card-header text-center bg-success">Animal</div>
                    <div class="card-body text-center">
                        <div class = "image-fit">
                            <a href = "<?= base_url() . $transaction->pet_picture ?>" data-toggle="lightbox">
                                <img class="d-flex mx-auto" src="<?= base_url() . $transaction->pet_picture ?>" style = "height:75px; width:75px;" alt = "<?= $transaction->user_firstname . " " . $transaction->user_lastname ?>">
                            </a>
                        </div>
                        <h5 class="card-title"><?= $transaction->pet_name ?></h5>
                        <a href = "#" class = "btn btn-outline-success" data-toggle = "modal" data-target = "#pet_detail_<?= $transaction->pet_id; ?>">Show Information</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="steps-form">
            <div class="steps-row setup-panel">
                <?php foreach ($progresses as $progress): ?>
                    <div class="steps-step" data-toggle = "tooltip" data-placement = "bottom" title = "<?= $progress->checklist_title ?>">
                        <a id = "step_id_<?= $progress->checklist_id ?>"  href="#step_<?= $progress->checklist_id ?>" class="btn btn-default btn-circle" style="height:45px; width:45px; color:white;"><i class="<?= getIcon($progress->checklist_id) ?> fa-1x"></i><br><?= $progress->checklist_id ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Adoption Form  --> 
        <div class="row setup-content" id="step_1">
            <?php include_once 'step_1.php'; ?>  
        </div>

        <!--  Meet And Greet -->  
        <div class="row setup-content" id="step_2">
            <?php include_once 'step_2.php'; ?>
        </div>

        <!--  Interview  --> 
        <div class="row setup-content" id="step_3">
            <?php include_once 'step_3.php'; ?>
        </div>

        <!--  Home Visit --> 
        <div class="row setup-content" id="step_4">
            <?php include_once 'step_4.php'; ?>
        </div>

        <!--  Visit chosen adoptee -->  
        <div class="row setup-content" id="step_5">
            <?php include_once 'step_5.php'; ?>
        </div>

        <!-- Release day -->
        <div class="row setup-content" id="step_6">
            <?php include_once 'step_6.php'; ?>
        </div>
    </div>
</div>

<!-- PET DETAIL MODAL -->
<div class="modal fade" id = "pet_detail_<?= $transaction->pet_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class = "fa fa-info-circle"></i> Pet Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class ="col-md-5">
                        <img src = "<?= $this->config->base_url() . $transaction->pet_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                    </div>
                    <div class ="col-md-7">
                        <table class = "table  table-striped">
                            <tbody>
                                <tr>
                                    <th>Name: </th>
                                    <td><?= $transaction->pet_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Status: </th>
                                    <td><?= $transaction->pet_status; ?></td>
                                </tr>
                                <tr>
                                    <th>Size: </th>
                                    <td><?= $transaction->pet_size; ?></td>
                                </tr>
                                <tr>
                                    <th>Birthday: </th>
                                    <td><?= date("F d, Y", $transaction->pet_bday); ?></td>
                                </tr>
                                <tr>
                                    <th>Age:</th>
                                    <td><?= get_age($transaction->pet_bday); ?></td>
                                </tr>
                                <tr>
                                    <th>Specie: </th>
                                    <td><?= $transaction->pet_specie; ?></td>
                                </tr>
                                <tr>
                                    <th>Sex: </th>
                                    <td><?= $transaction->pet_sex; ?></td>
                                </tr>
                                <tr>
                                    <th>Breed: </th>
                                    <td><?= $transaction->pet_breed; ?></td>
                                </tr>
                                <tr>
                                    <th>Sterilized: </th>
                                    <td><?= $transaction->pet_neutered_spayed == 1 ? "Yes" : "No"; ?></td>
                                </tr>
                                <tr>
                                    <th>Admission: </th>
                                    <td><?= $transaction->pet_admission; ?></td>
                                </tr>
                                <tr>
                                    <th>Description: </th>
                                    <td><?= $transaction->pet_description; ?></td>
                                </tr>
                                <tr>
                                    <th>Findings: </th>
                                    <td><?= $transaction->pet_history; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- USER DETAIL MODAL -->
<div class="modal fade" id = "user_detail_<?= $transaction->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class = "fa fa-info-circle"></i> User Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class ="col-md-5">
                        <img src = "<?= $this->config->base_url() . $transaction->user_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                    </div>
                    <div class ="col-md-7">
                        <table class="table borderless table-responsive-sm">
                            <tbody>
                                <tr>
                                    <th scope="row">Username</th>
                                    <td><?= $transaction->user_username; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Birthday</th>
                                    <td><?= date("F d, Y", $transaction->user_bday); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td><?= $transaction->user_email; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Contact No.</th>
                                    <td><?= $transaction->user_contact_no; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td><?= $transaction->user_address; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap File Upload with preview -->
<script src = "https://unpkg.com/file-upload-with-preview"></script>
<script>
    var upload = new FileUploadWithPreview('adoption_form');
</script>

<!-- Textbox autoresize -->

<script src = "<?= base_url() ?>assets/autosize-master/js/autosize.js"></script>
<script>
    // from a jQuery collection
    autosize($('textarea'));
</script>