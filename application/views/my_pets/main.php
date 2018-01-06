<?php
$userInfo = $this->MyPets_model->fetchJoinThreeAdoptedDesc("adoption", "pet", "adoption.pet_id = pet.pet_id", "user", "adoption.user_id = user.user_id", array('user.user_id' => $this->session->userid));
?>
<!--===========================
My Pets
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>UserDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Pets</li>
        </ol>
        <!-- My Pets -->
        <div class="card">
            <?php if (empty($userInfo)): ?>
                <div class = "col-lg-12">
                    <center>
                        <h4>You have no Pet/s yet</h4>
                        <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                    </center>
                </div>
            <?php else: ?>
                <h3 class="card-header">My Pets</h3>
                <div class="card-body container-fluid">
                    <div class="row">
                        <?php foreach ($userInfo as $pet): ?>
                            <?php if ($pet->pet_access == 1): ?>
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
                                                <a href = "<?= base_url() ?>MyPets/edit_details_exec/<?= $pet->pet_id ?>" class = "btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit Details"><i class = "fa fa-pencil fa-2x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Details -->
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
                                                    <?php if ($pet->pet_video == NULL): ?>
                                                        <h2>This pet has no Video</h2>
                                                    <?php else: ?>
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <iframe class="embed-responsive-item" src="..."></iframe>
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
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div><br>
    </div>
</div>
</div>
