<?php
$progressInfo = $this->MyProgress_model->fetchJoinThreeProgressInfo("progress", "checklist", "progress.checklist_id = checklist.checklist_id");
/* echo $this->db->last_query();
  die; */
$userInfo = $this->MyProgress_model->fetchJoinThreeProgress("transaction", "pet", "transaction.pet_id = pet.pet_id", "user", "transaction.user_id = user.user_id", array('user.user_id' => $this->session->userid));
/* echo "<pre>";
  print_r($userInfo);
  echo "</pre>";
  die; */
?>
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
My Progress
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>UserDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Progress</li>
        </ol>
        <!-- My Pets -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-history"></i> My Progress
            </div>
            <?php if (empty($userInfo)): ?>
                <div class = "col-lg-12">
                    <center>
                        <h4>You have no Progress yet</h4>
                        <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                    </center>
                </div>
            <?php else: ?>
                <!-- Steps form -->
                <div class="card">
                    <?php foreach ($userInfo as $progress): ?>
                        <div class="card-body mb-4">
                            <h2 class="text-center font-bold pt-4 pb-5"></h2>
                            <div class="steps-form">
                                <div class="steps-row setup-panel">
                                    <div class="steps-step">
                                        <a href="#step-1"  class="btn btn-default btn-circle <?= $progress->transaction_progress >= '20' ? "active" : "disabled" ?>" style="height:45px; width:45px;"><i class="fa fa-envelope"></i><br>1</a>
                                        <p><?= $progressInfo[0]->checklist_title ?></p>
                                    </div>
                                    <div class="steps-step">
                                        <a href="#step-2"  class="btn btn-default btn-circle <?= $progress->transaction_progress >= '40' ? "active" : "disabled" ?> " style="height:45px; width:45px;"><i class="fa fa-handshake-o"></i><br>2</a>
                                        <p><?= $progressInfo[1]->checklist_title ?></p>
                                    </div>
                                    <div class="steps-step">
                                        <a href="#step-3"  class="btn btn-default btn-circle <?= $progress->transaction_progress >= '60' ? "active" : "disabled" ?>" style="height:45px; width:45px;"><i class="fa fa-comments"></i><br>3</a>
                                        <p><?= $progressInfo[2]->checklist_title ?></p>
                                    </div>
                                    <div class="steps-step">
                                        <a href="#step-4"  class="btn btn-default btn-circle <?= $progress->transaction_progress >= '80' ? "active" : "disabled" ?>" style="height:45px; width:45px;"><i class="fa fa-eye"></i><br>4</a>
                                        <p><?= $progressInfo[3]->checklist_title ?></p>
                                    </div>
                                    <div class="steps-step">
                                        <a href="#step-5"  class="btn btn-default btn-circle <?= $progress->transaction_progress >= '100' ? "active" : "disabled" ?>" style="height:45px; width:45px;"><i class="fa fa-home"></i><br>5</a>
                                        <p><?= $progressInfo[4]->checklist_title ?></p>
                                    </div>
                                    <div class="steps-step">
                                        <a href="#step-6"  class="btn btn-default btn-circle <?= $progress->transaction_isFinished >= '1' ? "active" : "disabled" ?>" style="height:45px; width:45px;"><i class="fa fa-check"></i><br>6</a>
                                        <p><?= $progressInfo[5]->checklist_title ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-content" id="step-1" >
                                <div class="col-md-12">
                                    <h3 class="font-bold pl-0 my-4"><strong><i class="fa fa-envelope"></i> <?= $progressInfo[0]->checklist_title ?></strong></h3>
                                    <div class="row">
                                        <div class="col-md-4"><br>
                                            <div class="card">
                                                <a href = "<?= $this->config->base_url() . $progress->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $progress->pet_name ?></b>">
                                                    <img class="card-img-top" src = "<?= $this->config->base_url() . $progress->pet_picture ?>" alt="picture">
                                                </a>
                                                <div class="card-body">
                                                    <h4 class="card-title"><?= $progress->pet_name ?></h4>
                                                    <i class="fa fa-calendar"></i> <?= date('M. j, Y', $progress->pet_bday) ?><br>
                                                    <?php if ($progress->pet_sex == "Male" || $progress->pet_sex == "male"): ?>
                                                        <i class="fa fa-mars" style="color:blue"></i> <?= $progress->pet_sex ?><br>
                                                    <?php else: ?>
                                                        <i class="fa fa-venus" style="color:red"></i> <?= $progress->pet_sex ?><br>
                                                    <?php endif; ?>
                                                    <i class="fa fa-paw"></i> <?= $progress->pet_breed ?><br>
                                                    <i class="fa fa-check-square" style="color:green"></i> <?= $progress->pet_status ?>
                                                </div>

                                                <div class="card-footer text-center">
                                                    <div class = "btn-group" role="group" aria-label="Button Group">
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $progressInfo[0]->checklist_desc ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-content" id="step-2" >
                                <div class="col-md-12">
                                    <h3 class="font-bold pl-0 my-4"><strong><i class="fa fa-handshake-o"></i> <?= $progressInfo[1]->checklist_title ?></strong></h3>
                                    <div class="row">
                                        <div class="col-md-4"><br>
                                            <div class="card">
                                                <a href = "<?= $this->config->base_url() . $progress->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $progress->pet_name ?></b>">
                                                    <img class="card-img-top" src = "<?= $this->config->base_url() . $progress->pet_picture ?>" alt="picture">
                                                </a>
                                                <div class="card-body">
                                                    <h4 class="card-title"><?= $progress->pet_name ?></h4>
                                                    <i class="fa fa-calendar"></i> <?= date('M. j, Y', $progress->pet_bday) ?><br>
                                                    <?php if ($progress->pet_sex == "Male" || $progress->pet_sex == "male"): ?>
                                                        <i class="fa fa-mars" style="color:blue"></i> <?= $progress->pet_sex ?><br>
                                                    <?php else: ?>
                                                        <i class="fa fa-venus" style="color:red"></i> <?= $progress->pet_sex ?><br>
                                                    <?php endif; ?>
                                                    <i class="fa fa-paw"></i> <?= $progress->pet_breed ?><br>
                                                    <i class="fa fa-check-square" style="color:green"></i> <?= $progress->pet_status ?>
                                                </div>

                                                <div class="card-footer text-center">
                                                    <div class = "btn-group" role="group" aria-label="Button Group">
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $progressInfo[1]->checklist_desc ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-content" id="step-3">
                                <div class="col-md-12">
                                    <h3 class="font-bold pl-0 my-4"><strong><i class="fa fa-comments"></i> <?= $progressInfo[2]->checklist_title ?></strong></h3>
                                    <div class="row">
                                        <div class="col-md-4"><br>
                                            <div class="card">
                                                <a href = "<?= $this->config->base_url() . $progress->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $progress->pet_name ?></b>">
                                                    <img class="card-img-top" src = "<?= $this->config->base_url() . $progress->pet_picture ?>" alt="picture">
                                                </a>
                                                <div class="card-body">
                                                    <h4 class="card-title"><?= $progress->pet_name ?></h4>
                                                    <i class="fa fa-calendar"></i> <?= date('M. j, Y', $progress->pet_bday) ?><br>
                                                    <?php if ($progress->pet_sex == "Male" || $progress->pet_sex == "male"): ?>
                                                        <i class="fa fa-mars" style="color:blue"></i> <?= $progress->pet_sex ?><br>
                                                    <?php else: ?>
                                                        <i class="fa fa-venus" style="color:red"></i> <?= $progress->pet_sex ?><br>
                                                    <?php endif; ?>
                                                    <i class="fa fa-paw"></i> <?= $progress->pet_breed ?><br>
                                                    <i class="fa fa-check-square" style="color:green"></i> <?= $progress->pet_status ?>
                                                </div>

                                                <div class="card-footer text-center">
                                                    <div class = "btn-group" role="group" aria-label="Button Group">
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $progressInfo[2]->checklist_desc ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-content" id="step-4">
                                <div class="col-md-12">
                                    <h3 class="font-bold pl-0 my-4"><strong><i class="fa fa-eye"></i> <?= $progressInfo[3]->checklist_title ?></strong></h3>
                                    <div class="row">
                                        <div class="col-md-4"><br>
                                            <div class="card">
                                                <a href = "<?= $this->config->base_url() . $progress->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $progress->pet_name ?></b>">
                                                    <img class="card-img-top" src = "<?= $this->config->base_url() . $progress->pet_picture ?>" alt="picture">
                                                </a>
                                                <div class="card-body">
                                                    <h4 class="card-title"><?= $progress->pet_name ?></h4>
                                                    <i class="fa fa-calendar"></i> <?= date('M. j, Y', $progress->pet_bday) ?><br>
                                                    <?php if ($progress->pet_sex == "Male" || $progress->pet_sex == "male"): ?>
                                                        <i class="fa fa-mars" style="color:blue"></i> <?= $progress->pet_sex ?><br>
                                                    <?php else: ?>
                                                        <i class="fa fa-venus" style="color:red"></i> <?= $progress->pet_sex ?><br>
                                                    <?php endif; ?>
                                                    <i class="fa fa-paw"></i> <?= $progress->pet_breed ?><br>
                                                    <i class="fa fa-check-square" style="color:green"></i> <?= $progress->pet_status ?>
                                                </div>

                                                <div class="card-footer text-center">
                                                    <div class = "btn-group" role="group" aria-label="Button Group">
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $progressInfo[3]->checklist_desc ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-content" id="step-5">
                                <div class="col-md-12">
                                    <h3 class="font-bold pl-0 my-4"><strong><i class="fa fa-home"></i> <?= $progressInfo[4]->checklist_title ?></strong></h3>
                                    <div class="row">
                                        <div class="col-md-4"><br>
                                            <div class="card">
                                                <a href = "<?= $this->config->base_url() . $progress->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $progress->pet_name ?></b>">
                                                    <img class="card-img-top" src = "<?= $this->config->base_url() . $progress->pet_picture ?>" alt="picture">
                                                </a>
                                                <div class="card-body">
                                                    <h4 class="card-title"><?= $progress->pet_name ?></h4>
                                                    <i class="fa fa-calendar"></i> <?= date('M. j, Y', $progress->pet_bday) ?><br>
                                                    <?php if ($progress->pet_sex == "Male" || $progress->pet_sex == "male"): ?>
                                                        <i class="fa fa-mars" style="color:blue"></i> <?= $progress->pet_sex ?><br>
                                                    <?php else: ?>
                                                        <i class="fa fa-venus" style="color:red"></i> <?= $progress->pet_sex ?><br>
                                                    <?php endif; ?>
                                                    <i class="fa fa-paw"></i> <?= $progress->pet_breed ?><br>
                                                    <i class="fa fa-check-square" style="color:green"></i> <?= $progress->pet_status ?>
                                                </div>

                                                <div class="card-footer text-center">
                                                    <div class = "btn-group" role="group" aria-label="Button Group">
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $progressInfo[4]->checklist_desc ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-content" id="step-5">
                                <div class="col-md-12">
                                    <h3 class="font-bold pl-0 my-4"><strong><i class="fa fa-home"></i> <?= $progressInfo[4]->checklist_title ?></strong></h3>
                                    <div class="row">
                                        <div class="col-md-4"><br>
                                            <div class="card">
                                                <a href = "<?= $this->config->base_url() . $progress->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $progress->pet_name ?></b>">
                                                    <img class="card-img-top" src = "<?= $this->config->base_url() . $progress->pet_picture ?>" alt="picture">
                                                </a>
                                                <div class="card-body">
                                                    <h4 class="card-title"><?= $progress->pet_name ?></h4>
                                                    <i class="fa fa-calendar"></i> <?= date('M. j, Y', $progress->pet_bday) ?><br>
                                                    <?php if ($progress->pet_sex == "Male" || $progress->pet_sex == "male"): ?>
                                                        <i class="fa fa-mars" style="color:blue"></i> <?= $progress->pet_sex ?><br>
                                                    <?php else: ?>
                                                        <i class="fa fa-venus" style="color:red"></i> <?= $progress->pet_sex ?><br>
                                                    <?php endif; ?>
                                                    <i class="fa fa-paw"></i> <?= $progress->pet_breed ?><br>
                                                    <i class="fa fa-check-square" style="color:green"></i> <?= $progress->pet_status ?>
                                                </div>

                                                <div class="card-footer text-center">
                                                    <div class = "btn-group" role="group" aria-label="Button Group">
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $progressInfo[5]->checklist_desc ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row setup-content" id="step-6">
                                <div class="col-md-12">
                                    <h3 class="font-bold pl-0 my-4"><strong><i class="fa fa-check"></i> <?= $progressInfo[5]->checklist_title ?></strong></h3>
                                    <div class="row">
                                        <div class="col-sm-4"><br>
                                            <div class="card">
                                                <a href = "<?= $this->config->base_url() . $progress->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $progress->pet_name ?></b>">
                                                    <img class="card-img-top" src = "<?= $this->config->base_url() . $progress->pet_picture ?>" alt="picture">
                                                </a>
                                                <div class="card-body">
                                                    <h4 class="card-title"><?= $progress->pet_name ?></h4>
                                                    <i class="fa fa-calendar"></i> <?= date('M. j, Y', $progress->pet_bday) ?><br>
                                                    <?php if ($progress->pet_sex == "Male" || $progress->pet_sex == "male"): ?>
                                                        <i class="fa fa-mars" style="color:blue"></i> <?= $progress->pet_sex ?><br>
                                                    <?php else: ?>
                                                        <i class="fa fa-venus" style="color:red"></i> <?= $progress->pet_sex ?><br>
                                                    <?php endif; ?>
                                                    <i class="fa fa-paw"></i> <?= $progress->pet_breed ?><br>
                                                    <i class="fa fa-check-square" style="color:green"></i> <?= $progress->pet_status ?>
                                                </div>

                                                <div class="card-footer text-center">
                                                    <div class = "btn-group" role="group" aria-label="Button Group">
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><?= $progressInfo[5]->checklist_desc ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Details -->
                        <div class="modal fade <?= $progress->pet_id; ?>detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                                <img src = "<?= $this->config->base_url() . $progress->pet_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                                            </div>
                                            <div class ="col-md-7">
                                                <table class = "table table-responsive table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th>Name: </th>
                                                            <td><?= $progress->pet_name; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status: </th>
                                                            <td><?= $progress->pet_status; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Size: </th>
                                                            <td><?= $progress->pet_size; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Birthday: </th>
                                                            <td><?= date("F d, Y", $progress->pet_bday); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Age:</th>
                                                            <td><?= get_age($progress->pet_bday); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Specie: </th>
                                                            <td><?= $progress->pet_specie; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sex: </th>
                                                            <td><?= $progress->pet_sex; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Breed: </th>
                                                            <td><?= $progress->pet_breed; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sterilized: </th>
                                                            <td><?= $progress->pet_neutered_spayed == 1 ? "Yes" : "No"; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Admission: </th>
                                                            <td><?= $progress->pet_admission; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Description: </th>
                                                            <td><?= $progress->pet_description; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Findings: </th>
                                                            <td><?= $progress->pet_history; ?></td>
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
                        <div class="modal fade <?= $progress->pet_id; ?>video" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                            <?php if ($progress->pet_video == NULL): ?>
                                                <h2>This pet has no Video</h2>
                                            <?php else: ?>
                                                <div class="embed-responsive embed-responsive-16by9 rounded mb-4">
                                                    <?= wrap_iframe($progress->pet_video); ?>
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
            <?php endif; ?>
            <!-- Steps form -->
        </div><br>
    </div>
</div>
</div>
