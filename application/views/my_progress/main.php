<?php
//echo $this->db->last_query();
//echo "<pre>";
//print_r($userInfo);
//echo "</pre>";
//die;
?>
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
                    <div class="card-body">
                        <h2 class="text-center font-bold"></h2>
                        <div class="steps-form">
                            <div class="steps-row setup-panel">
                                <?php foreach ($userInfo as $progress): ?>
                                    <div class="steps-step">
                                        <a id = "step_id_<?= $progress->checklist_id ?>" href="#step_<?= $progress->checklist_id ?>"  class="btn btn-default btn-circle" style="height:45px; width:45px; color:white;"><i class="<?= getIcon($progress->checklist_id) ?> fa-1x"></i><br><?= $progress->checklist_id ?></a>
                                        <p><small><?= $progress->checklist_title ?></small></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php foreach ($userInfo as $progress): ?>
                            <div class="row setup-content" id="step_<?= $progress->checklist_id ?>">
                                <div class="col-md-12">
                                    <h3 class="font-bold pl-0 my-4"><strong> <?= $progress->checklist_title ?></strong></h3>
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
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>medical"  data-placement="bottom" title="View Medical Records"><i class = "fa fa-stethoscope fa-2x"></i></a>
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $progress->checklist_desc?></p>
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
                            <!-- Modal Medical -->
                            <?php $medical = $this->MyProgress_model->get_animal_medical_records(array("medical_record.pet_id" => $progress->pet_id))[0]; ?>
                            <div class="modal fade <?= $progress->pet_id; ?>medical" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><i class = "fa fa-stethoscope"></i> Medical Records</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class ="row">
                                                <div class = "col-lg-12">
                                                    <?php if (empty($medical)): ?>
                                                        <h2><i class="fa fa-warning"></i> This pet has no Medical Records</h2>
                                                    <?php else: ?>
                                                        <table class = "table table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Date: </th>
                                                                    <td><?= date("F d, Y", $medical->medicalRecord_date); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Weight: </th>
                                                                    <td><?= $medical->medicalRecord_weight; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Diagnosis: </th>
                                                                    <td><?= $medical->medicalRecord_diagnosis; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Treatment: </th>
                                                                    <td><?= $medical->medicalRecord_treatment; ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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

                </div>
            <?php endif; ?>
            <!-- Steps form -->
        </div><br>
    </div>
</div>
</div>


<script>
    $(document).ready(function () {
        switch (<?= $transaction_progress ?>) {
            case 16:
            {
                $("#step_id_1").addClass("active");
                $("#step_id_2").addClass("disabled");
                $("#step_id_3").addClass("disabled");
                $("#step_id_4").addClass("disabled");
                $("#step_id_5").addClass("disabled");
                $("#step_id_6").addClass("disabled");
                break;
            }
            case 32:
            {
                $("#step_id_1").addClass("");
                $("#step_id_2").addClass("active");
                $("#step_id_3").addClass("disabled");
                $("#step_id_4").addClass("disabled");
                $("#step_id_5").addClass("disabled");
                $("#step_id_6").addClass("disabled");
                $("#step_id_6").addClass("disabled");

                break;
            }
            case 49:
            {
                $("#step_id_1").addClass("");
                $("#step_id_2").addClass("");
                $("#step_id_3").addClass("active");
                $("#step_id_4").addClass("disabled");
                $("#step_id_5").addClass("disabled");
                $("#step_id_6").addClass("disabled");
                break;
            }
            case 66:
            {
                $("#step_id_1").addClass("");
                $("#step_id_2").addClass("");
                $("#step_id_3").addClass("");
                $("#step_id_4").addClass("active");
                $("#step_id_5").addClass("disabled");
                $("#step_id_6").addClass("disabled");
                break;
            }
            case 83:
            {
                $("#step_id_1").addClass("");
                $("#step_id_2").addClass("");
                $("#step_id_3").addClass("");
                $("#step_id_4").addClass("");
                $("#step_id_5").addClass("active");
                $("#step_id_6").addClass("disabled");
                break;
            }
            case 100:
            {
                $("#step_id_1").addClass("");
                $("#step_id_2").addClass("");
                $("#step_id_3").addClass("");
                $("#step_id_4").addClass("");
                $("#step_id_5").addClass("");
                $("#step_id_6").addClass("active");
                break;
            }
        }
    });

</script>