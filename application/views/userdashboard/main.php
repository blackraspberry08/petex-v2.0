
<?php

function wrap_iframe($src) {
    if ($src == '') {
        $new_src = '';
    } else {
        $new_src = '<iframe class="embed-responsive-item" src="' . $src . '" allowfullscreen></iframe>';
    }
    return $new_src;
}
?>
<!--===========================
Dashboard
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>UserDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Dashboard</li>
        </ol>
        <!-- Registered -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-dashboard"></i> Dashboard
            </div>
            <?php if (empty($pets)): ?>
                <div class = "col-lg-12">
                    <center>
                        <h4>No animals yet</h4>
                        <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                    </center>
                </div>
            <?php else: ?>
                <div class="card-body container-fluid">
                    <div class="row">
                        <?php $counter = 0; ?>
                        <?php foreach ($pets as $pet): ?>
                            <?php if ($pet->pet_status == 'Adoptable' && $pet->pet_access == 1): ?>
                                <div class="col-md-3">
                                    <div class="card">
                                        <a href = "<?= $this->config->base_url() . $pet->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $pet->pet_name ?></b>">
                                            <img class="card-img-top" src = "<?= $this->config->base_url() . $pet->pet_picture ?>" alt="picture">
                                        </a>
                                        <div class="card-body">
                                            <h4 class="card-title"><?= $pet->pet_name ?></h4>
                                            <i class="fa fa-calendar"></i> <?= date('M. j, Y', $pet->pet_bday) ?><br>
                                            <?php if ($pet->pet_sex == "Male" || $pet->pet_sex == "male"): ?>
                                                <i class="fa fa-mars" style="color:blue"></i> <?= $pet->pet_sex ?><br>
                                            <?php else: ?>
                                                <i class="fa fa-venus" style="color:red"></i> <?= $pet->pet_sex ?><br>
                                            <?php endif; ?>
                                            <i class="fa fa-paw"></i> <?= $pet->pet_breed ?><br>
                                            <i class="fa fa-check-square" style="color:green"></i> <?= $pet->pet_status ?>
                                        </div>

                                        <div class="card-footer text-center">
                                            <div class = "btn-group" role="group" aria-label="Button Group">
                                                <a href = "#" class = "btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".<?= $pet->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                                                <a href = "#" class = "btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".<?= $pet->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                                <a href = "#" class = "btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".<?= $pet->pet_id; ?>adopters" data-placement="bottom" title="Interested Adopters"><i class = "fa fa-users fa-2x"></i></a>
                                                <?php if (empty($userInfo)): ?>
                                                    <a href = "#" class = "btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".<?= $pet->pet_id; ?>adopt" data-placement="bottom" title="Adopt a Pet"><i class = "fa fa-star fa-2x"></i></a>
                                                <?php else: ?>
                                                    <a href = "#" class = "btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".<?= $pet->pet_id; ?>warning" data-placement="bottom" title="Adopt a Pet"><i class = "fa fa-star fa-2x"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Detail -->
                                <div class="modal fade <?= $pet->pet_id; ?>detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class = "fa fa-info"></i> Pet Info</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class ="col-md-5">
                                                        <img src = "<?= $this->config->base_url() . $pet->pet_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                                                    </div>
                                                    <div class ="col-md-7">
                                                        <table class = "table table-responsive table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Name: </th>
                                                                    <td><?= $pet->pet_name; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Status: </th>
                                                                    <td><?= $pet->pet_status; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Size: </th>
                                                                    <td><?= $pet->pet_size; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Birthday: </th>
                                                                    <td><?= date("F d, Y", $pet->pet_bday); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Age:</th>
                                                                    <td><?= get_age($pet->pet_bday); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Specie: </th>
                                                                    <td><?= $pet->pet_specie; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Sex: </th>
                                                                    <td><?= $pet->pet_sex; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Breed: </th>
                                                                    <td><?= $pet->pet_breed; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Sterilized: </th>
                                                                    <td><?= $pet->pet_neutered_spayed == 1 ? "Yes" : "No"; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Admission: </th>
                                                                    <td><?= $pet->pet_admission; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Description: </th>
                                                                    <td><?= $pet->pet_description; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Findings: </th>
                                                                    <td><?= $pet->pet_history; ?></td>
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
                                <!-- Modal Video -->
                                <div class="modal fade <?= $pet->pet_id; ?>video" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class = "fa fa-video-camera"></i> Pet Video</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row container">
                                                    <div class="row container">
                                                        <?php if ($pet->pet_video == NULL): ?>
                                                            <h2>This pet has no Video</h2>
                                                        <?php else: ?>
                                                            <div class="embed-responsive embed-responsive-16by9 rounded mb-4">
                                                                <?= wrap_iframe($pet->pet_video); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Interested Adopters -->
                                <div class="modal fade <?= $pet->pet_id; ?>adopters" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class = "fa fa-users"></i> Interested Adopters</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row container">
                                                    <?php if (!$adopters): ?>
                                                        <h2><i class="fa fa-warning"></i> This pet has no Adopters</h2>
                                                    <?php else: ?>
                                                        <?php foreach ($adopters as $adopter): ?>
                                                            <?php if ($adopter->pet_id == $pet->pet_id && $adopter->transaction_isFinished == 0): ?>
                                                                <br>
                                                                <div class="col-md-12">
                                                                    <div class="col-md-6 pull-left">
                                                                        <h6><strong>Name: </strong><?= $adopter->user_firstname ?></h6>
                                                                    </div>
                                                                    <div class="col-md-6 pull-right">
                                                                        <h6><strong>Pet Name: </strong><?= $adopter->pet_name ?></h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="progress" style="width:100%; ">
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?= $adopter->transaction_progress ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $adopter->transaction_progress . '%' ?>;"><?= $adopter->transaction_progress ?></div>
                                                                    </div>
                                                                </div>
                                                            <?php elseif ($adopter->pet_id != $pet->pet_id): ?>
                                                                <h2><i class="fa fa-warning"></i> This pet has no Adopter/s</h2>
                                                                <?php break; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Adopt -->
                                <div class="modal fade <?= $pet->pet_id; ?>adopt" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class = "fa fa-star"></i> Adopt a Pet</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row container">
                                                    <p><strong>There are two options for you to decide, its either download the form or fill up the form and send to our email online.</strong></p>
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-3">
                                                        <a href="<?= base_url() ?>download/adoption_application_form.pdf" class="btn btn-outline-primary">Download <i class = "fa fa-download"></i></a>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="<?= base_url() ?>PetAdoption/petAdoptionOnlineForm_exec/<?= $pet->pet_id ?>" class="btn btn-outline-primary">Fill up the Form Online</a>
                                                    </div>
                                                    <div class="col-md-3"></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Warning -->
                                <div class="modal fade <?= $pet->pet_id; ?>warning" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class = "fa fa-warning"></i> Warning!</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row container">
                                                    <h3>Oops! Sorry, you cannot adopt this pet because you already have in progress...</h3>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php
                            if ($counter == 4): {
                                    break;
                                }
                                ?>
                            <?php endif; ?>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url() ?>PetAdoption" class="pull-right">See more</a>
                </div>
            <?php endif; ?>
        </div><br>
        <!-- Adopted -->
        <div class="card">
            <h3 class="card-header ">Newly Adopted Pet</h3>
            <?php if (empty($adoptedPets)): ?>
                <div class = "col-lg-12">
                    <center>
                        <h4>No animals yet</h4>
                        <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                    </center>
                </div>
            <?php else: ?>
                <div class="card-body container-fluid">
                    <div class="row">
                        <?php $counter1 = 0; ?>
                        <?php foreach ($adoptedPets as $adopted): ?>
                            <div class="col-md-3">
                                <div class="card">
                                    <a href = "<?= $this->config->base_url() . $adopted->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $adopted->pet_name ?></b>">
                                        <img class="card-img-top" src = "<?= $this->config->base_url() . $adopted->pet_picture ?>" alt="picture">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title"><?= $adopted->pet_name ?></h4>
                                        <i class="fa fa-calendar"></i> <?= date('M. j, Y', $adopted->pet_bday) ?><br>
                                        <?php if ($adopted->pet_sex == "Male" || $adopted->pet_sex == "male"): ?>
                                            <i class="fa fa-mars" style="color:blue"></i> <?= $adopted->pet_sex ?><br>
                                        <?php else: ?>
                                            <i class="fa fa-venus" style="color:red"></i> <?= $adopted->pet_sex ?><br>
                                        <?php endif; ?>
                                        <i class="fa fa-paw"></i> <?= $adopted->pet_breed ?><br>
                                        <i class="fa fa-check-square" style="color:green"></i> <?= $adopted->pet_status ?>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class = "btn-group" role="group" aria-label="Button Group">
                                            <a href = "#" class = "btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".<?= $adopted->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                                            <a href = "#" class = "btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".<?= $adopted->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Detail Adopted-->
                            <div class="modal fade <?= $adopted->pet_id; ?>detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><i class = "fa fa-info"></i> Pet Info</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class ="col-md-5">
                                                    <img src = "<?= $this->config->base_url() . $adopted->pet_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                                                </div>
                                                <div class ="col-md-7">
                                                    <table class = "table table-responsive table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <th>Name: </th>
                                                                <td><?= $adopted->pet_name; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status: </th>
                                                                <td><?= $adopted->pet_status; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Owner: </th>
                                                                <td><?= $adopted->user_firstname; ?> <?= $adopted->user_lastname; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Size: </th>
                                                                <td><?= $adopted->pet_size; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Birthday: </th>
                                                                <td><?= date("F d, Y", $adopted->pet_bday); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Age:</th>
                                                                <td><?= get_age($adopted->pet_bday); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Specie: </th>
                                                                <td><?= $adopted->pet_specie; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Sex: </th>
                                                                <td><?= $adopted->pet_sex; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Breed: </th>
                                                                <td><?= $adopted->pet_breed; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Sterilized: </th>
                                                                <td><?= $adopted->pet_neutered_spayed == 1 ? "Yes" : "No"; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Admission: </th>
                                                                <td><?= $adopted->pet_admission; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Description: </th>
                                                                <td><?= $adopted->pet_description; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Findings: </th>
                                                                <td><?= $adopted->pet_history; ?></td>
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
                            <!-- Modal Video Adopted -->
                            <div class="modal fade <?= $adopted->pet_id; ?>video" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><i class = "fa fa-video-camera"></i> Pet Video</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row container">
                                                <?php if ($pet->pet_video == NULL): ?>
                                                    <h2>This pet has no Video</h2>
                                                <?php else: ?>
                                                    <div class="embed-responsive embed-responsive-16by9 rounded mb-4">
                                                        <?= wrap_iframe($pet->pet_video); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
