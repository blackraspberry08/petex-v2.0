
<?php
$progress_3 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 3, "progress.transaction_id" => $progress->transaction_id))[0];
$schedule_3 = $this->ManageProgress_model->get_schedule(array("schedule.progress_id" => $progress_3->progress_id));
?>
<?php if (!empty($schedule_3)): ?>
    <?php
    $sched_1 = $schedule_3[0];
    $sched_2 = $schedule_3[1];
    $sched_3 = $schedule_3[2];
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4"><br>
                <div class="card">
                    <a href = "<?= $this->config->base_url() . $progress_3->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $progress_3->pet_name ?></b>">
                        <img class="card-img-top" src = "<?= $this->config->base_url() . $progress_3->pet_picture ?>" alt="picture">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title"><?= $progress_3->pet_name ?></h4>
                        <i class="fa fa-calendar"></i> <?= date('M. j, Y', $progress_3->pet_bday) ?><br>
                        <?php if ($progress_3->pet_sex == "Male" || $progress_3->pet_sex == "male"): ?>
                            <i class="fa fa-mars" style="color:blue"></i> <?= $progress_3->pet_sex ?><br>
                        <?php else: ?>
                            <i class="fa fa-venus" style="color:red"></i> <?= $progress_3->pet_sex ?><br>
                        <?php endif; ?>
                        <i class="fa fa-paw"></i> <?= $progress_3->pet_breed ?><br>
                        <i class="fa fa-check-square" style="color:green"></i> <?= $progress_3->pet_status ?>
                    </div>

                    <div class="card-footer text-center">
                        <div class = "btn-group" role="group" aria-label="Button Group">
                            <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress_3->pet_id; ?>detail3"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                            <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress_3->pet_id; ?>medical3"  data-placement="bottom" title="View Medical Records"><i class = "fa fa-stethoscope fa-2x"></i></a>
                            <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress_3->pet_id; ?>video3" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <h3 class = "mt-3 text-center">Interview</h3>
                <p class = "text-muted">&emsp;<?= $progress_3->checklist_desc ?></p>

                <?php if (!empty($schedule_3)): ?>
                    <div class = "row">
                        <div class = "col-md-4">
                            <div class="card border-dark mb-3 mx-auto text-center">
                                <div class="card-header">
                                    <i class = "fa fa-clock-o fa-5x"></i>
                                    <br>
                                    <h5 class = "text-muted">Schedule</h5>
                                </div>
                                <div class="card-header">
                                    <div class ="row">
                                        <div class = "col-md-6">
                                            <h6>Start</h6>
                                            <span style = "font-size:12px;"><?= date('F d, Y', $sched_1->schedule_startdate) ?></span><br>
                                            <span style = "font-size:12px;"><?= date('h:i A', $sched_1->schedule_startdate) ?></span>
                                        </div>
                                        <div class = "col-md-6">
                                            <h6>End</h6>
                                            <span style = "font-size:12px;"><?= date('F d, Y', $sched_1->schedule_enddate) ?></span><br>
                                            <span style = "font-size:12px;"><?= date('h:i A', $sched_1->schedule_enddate) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-dark">
                                    <h6 class="card-title"><?= $sched_1->schedule_title ?></h6>
                                    <p class="card-text"><?= $sched_1->schedule_desc ?></p>
                                </div>
                                <div class="card-footer">
                                    <?php if ($progress_3->progress_percentage >= 33): ?>
                                        <h5 style="color:green;"><i class="fa fa-check"></i> Done</h5>
                                    <?php else: ?>
                                        <h5 style="color:red;"><i class="fa fa-times"></i> Not yet Done</h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class = "col-md-4">
                            <div class="card border-dark mb-3 mx-auto text-center">
                                <div class="card-header">
                                    <i class = "fa fa-clock-o fa-5x"></i>
                                    <br>
                                    <h5 class = "text-muted">Schedule</h5>
                                </div>
                                <div class="card-header">
                                    <div class ="row">
                                        <div class = "col-md-6">
                                            <h6>Start</h6>
                                            <span style = "font-size:12px;"><?= date('F d, Y', $sched_2->schedule_startdate) ?></span><br>
                                            <span style = "font-size:12px;"><?= date('h:i A', $sched_2->schedule_startdate) ?></span>
                                        </div>
                                        <div class = "col-md-6">
                                            <h6>End</h6>
                                            <span style = "font-size:12px;"><?= date('F d, Y', $sched_2->schedule_enddate) ?></span><br>
                                            <span style = "font-size:12px;"><?= date('h:i A', $sched_2->schedule_enddate) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-dark">
                                    <h6 class="card-title"><?= $sched_2->schedule_title ?></h6>
                                    <p class="card-text"><?= $sched_2->schedule_desc ?></p>
                                </div>
                                <div class="card-footer">
                                    <?php if ($progress_3->progress_percentage >= 66): ?>
                                        <h5 style="color:green;"><i class="fa fa-check"></i> Done</h5>
                                    <?php else: ?>
                                        <h5 style="color:red;"><i class="fa fa-times"></i> Not yet Done</h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class = "col-md-4">
                            <div class="card border-dark mb-3 mx-auto text-center">
                                <div class="card-header">
                                    <i class = "fa fa-clock-o fa-5x"></i>
                                    <br>
                                    <h5 class = "text-muted">Schedule</h5>
                                </div>
                                <div class="card-header">
                                    <div class ="row">
                                        <div class = "col-md-6">
                                            <h6>Start</h6>
                                            <span style = "font-size:12px;"><?= date('F d, Y', $sched_3->schedule_startdate) ?></span><br>
                                            <span style = "font-size:12px;"><?= date('h:i A', $sched_3->schedule_startdate) ?></span>
                                        </div>
                                        <div class = "col-md-6">
                                            <h6>End</h6>
                                            <span style = "font-size:12px;"><?= date('F d, Y', $sched_3->schedule_enddate) ?></span><br>
                                            <span style = "font-size:12px;"><?= date('h:i A', $sched_3->schedule_enddate) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-dark">
                                    <h6 class="card-title"><?= $sched_3->schedule_title ?></h6>
                                    <p class="card-text"><?= $sched_3->schedule_desc ?></p>
                                </div>
                                <div class="card-footer">
                                    <?php if ($progress_3->progress_percentage >= 100): ?>
                                        <h5 style="color:green;"><i class="fa fa-check"></i> Done</h5>
                                    <?php else: ?>
                                        <h5 style="color:red;"><i class="fa fa-times"></i> Not yet Done</h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Comment -->
                <?php if (!empty($comments_step_3)): ?>
                    <!-- There are recent comments -->
                    <div class="card mb-3">
                        <div class ="card-header">
                            <i class = "fa fa-comment" ></i> Remarks
                        </div>

                        <?php foreach ($comments_step_3 as $comment): ?>
                            <div class="card-body small bg-faded">    
                                <div class="media">
                                    <div class = "image-fit">
                                        <img class="d-flex mr-3" style = "height:40px;" src="<?= base_url() . $comment->progress_comment_picture ?>" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1"><?= $comment->progress_comment_sender ?></h6>
                                        <span class = "text-muted"><strong><?= determine_access($comment->progress_comment_sender_access) ?></strong></span>&emsp;|&emsp;<span class = "text-muted"><?= date('F d, Y \a\t h:m A', $comment->progress_comment_added_at) ?></span><br>
                                        <div class = "my-2">
                                            <?= $comment->progress_comment_content ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if ($progress_3->progress_isSuccessful == 1): ?>
                            <div class ="card-footer">
                                <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                            </div>
                        <?php else: ?>
                            <div class="card-footer small text-muted text-center">
                                <div class="btn-group" role="group" aria-label="Approval">
                                    <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger" data-toggle = "modal"  title = "Disapprove" data-target = "#step_3_sched_disapprove"><i class = "fa fa-thumbs-o-down"></i></button>     
                                    <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary approve_3" data-toggle = "modal"  title = "Approve" data-target = "#step_3_sched_approve"><i class = "fa fa-thumbs-o-up"></i></button>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div><!-- /Comment-->
                <?php else: ?>
                    <!-- There are no comments -->
                    <div class="card mb-3">
                        <div class ="card-header">
                            <i class = "fa fa-comment" ></i> Remarks
                        </div>
                        <div class="card-body small bg-faded">
                            <center>
                                <h4>No remarks yet.</h4>
                                <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                                <br><br>
                            </center>
                        </div>
                        <?php if ($progress_3->progress_isSuccessful == 1): ?>
                            <div class ="card-footer">
                                <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                            </div>
                        <?php else: ?>
                            <div class="card-footer small text-muted text-center">
                                <div class="btn-group" role="group" aria-label="Approval">
                                    <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger" data-toggle = "modal"  title = "Disapprove" data-target = "#step_3_sched_disapprove"><i class = "fa fa-thumbs-o-down"></i></button>     
                                    <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary approve_3" data-toggle = "modal"  title = "Approve" data-target = "#step_3_sched_approve"><i class = "fa fa-thumbs-o-up"></i></button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div><!-- /Comment-->
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Modal Details -->
    <div class="modal fade <?= $progress_3->pet_id; ?>detail3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <img src = "<?= $this->config->base_url() . $progress_3->pet_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                        </div>
                        <div class ="col-md-7">
                            <table class = "table table-responsive table-striped">
                                <tbody>
                                    <tr>
                                        <th>Name: </th>
                                        <td><?= $progress_3->pet_name; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status: </th>
                                        <td><?= $progress_3->pet_status; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Size: </th>
                                        <td><?= $progress_3->pet_size; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Birthday: </th>
                                        <td><?= date("F d, Y", $progress_3->pet_bday); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Age:</th>
                                        <td><?= get_age($progress_3->pet_bday); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Specie: </th>
                                        <td><?= $progress_3->pet_specie; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sex: </th>
                                        <td><?= $progress_3->pet_sex; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Breed: </th>
                                        <td><?= $progress_3->pet_breed; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sterilized: </th>
                                        <td><?= $progress_3->pet_neutered_spayed == 1 ? "Yes" : "No"; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Admission: </th>
                                        <td><?= $progress_3->pet_admission; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Description: </th>
                                        <td><?= $progress_3->pet_description; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Findings: </th>
                                        <td><?= $progress_3->pet_history; ?></td>
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
    <?php $medical = $this->MyProgress_model->get_animal_medical_records(array("medical_record.pet_id" => $progress_3->pet_id))[0]; ?>
    <div class="modal fade <?= $progress_3->pet_id; ?>medical3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
    <div class="modal fade <?= $progress_3->pet_id; ?>video3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                        <?php if ($progress_3->pet_video == NULL): ?>
                            <h2>This pet has no Video</h2>
                        <?php else: ?>
                            <div class="embed-responsive embed-responsive-16by9 rounded mb-4">
                                <?= wrap_iframe($progress_3->pet_video); ?>
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
