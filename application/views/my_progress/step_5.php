
<?php
$progress_5 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 5, "progress.transaction_id" => $progress->transaction_id))[0];
$schedule_5 = $this->ManageProgress_model->get_schedule(array("schedule.progress_id" => $progress_5->progress_id));
$petAdopters = $this->UserDashboard_model->fetchJoinThreeProgressDesc(array('transaction.pet_id' => $progress_5->pet_id));
?>
<?php if (!empty($schedule_5)): ?>
    <?php
    $sched_1 = $schedule_5[0];
    $sched_2 = $schedule_5[1];
    $sched_3 = $schedule_5[2];
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4"><br>
                <div class="card">
                    <a href = "<?= $this->config->base_url() . $progress_5->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $progress_5->pet_name ?></b>">
                        <img class="card-img-top" src = "<?= $this->config->base_url() . $progress_5->pet_picture ?>" alt="picture">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title"><?= $progress_5->pet_name ?></h4>
                        <i class="fa fa-calendar"></i> <?= date('M. j, Y', $progress_5->pet_bday) ?><br>
                        <?php if ($progress_5->pet_sex == "Male" || $progress_5->pet_sex == "male"): ?>
                            <i class="fa fa-mars" style="color:blue"></i> <?= $progress_5->pet_sex ?><br>
                        <?php else: ?>
                            <i class="fa fa-venus" style="color:red"></i> <?= $progress_5->pet_sex ?><br>
                        <?php endif; ?>
                        <i class="fa fa-paw"></i> <?= $progress_5->pet_breed ?><br>
                        <i class="fa fa-users"></i> <?= $petAdopters ?><br>
                    </div>

                    <div class="card-footer text-center">
                        <div class = "btn-group" role="group" aria-label="Button Group">
                            <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress_5->pet_id; ?>detail5"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                            <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress_5->pet_id; ?>medical5"  data-placement="bottom" title="View Medical Records"><i class = "fa fa-stethoscope fa-2x"></i></a>
                            <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress_5->pet_id; ?>video5" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                        </div>
                    </div>

                </div>
                <br>
                <?php if ($progress_5->progress_isSuccessful == 0): ?>
                    <div class="card">
                        <form action="<?= base_url() ?>MyProgress/step5_comment_exec/<?= $progress_5->progress_id ?>" method="POST">
                            <div class ="card-header">
                                <i class = "fa fa-comment" ></i> Remarks
                            </div>
                            <div class="card-body">
                                <div class = "form-group">
                                    <label for="date_step_5">Date</label>
                                    <input type = "text" id = "date_step_5" name = "date_step_5" class = "form-control form_datetime" readonly="" required/>
                                </div>
                                <div class = "form-row">
                                    <label for="comment_step_5"> Comment</label>
                                    <textarea class = "form-control" id = "comment_step_5" name = "comment_step_5" placeholder = "Leave a comment here." required=""></textarea>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer" style="padding-bottom:50px;">
                                <button type="submit" class="btn btn-primary pull-right">Send <i class="fa fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="card">
                        <div class ="card-header">
                            <i class = "fa fa-comment" ></i> Remarks
                        </div>
                        <div class="card-body">
                            <h5><i class="fa fa-check"></i>This progress is already approved.</h5>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <h3 class = "mt-3 text-center">Visiting Chosen Adoptee</h3>
                <p class = "text-muted">&emsp;<?= $progress_5->checklist_desc ?></p>

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
                                    <?php if ($progress_5->progress_percentage >= 33): ?>
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
                                    <?php if ($progress_5->progress_percentage >= 66): ?>
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
                                    <?php if ($progress_5->progress_percentage >= 100): ?>
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
                <?php if (!empty($comments_step_5)): ?>
                    <!-- There are recent comments -->
                    <div class="card mb-3">
                        <div class ="card-header">
                            <i class = "fa fa-comment" ></i> Remarks
                        </div>

                        <?php foreach ($comments_step_5 as $comment): ?>
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
                        <?php if ($progress_5->progress_isSuccessful == 1): ?>
                            <div class ="card-footer">
                                <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                            </div>
                        <?php else: ?>
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
                        <?php if ($progress_5->progress_isSuccessful == 1): ?>
                            <div class ="card-footer">
                                <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                            </div>
                        <?php else: ?>

                        <?php endif; ?>
                    </div><!-- /Comment-->
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Modal Detail -->
    <div class="modal fade <?= $progress_5->pet_id; ?>detail5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <img src = "<?= $this->config->base_url() . $progress_5->pet_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                        </div>
                        <div class ="col-md-7">
                            <table class = "table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Name: </th>
                                        <td><?= $progress_5->pet_name; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Interested Adopters: </th>
                                        <td><?= $petAdopters ?></td>
                                    </tr>
                                    <tr>
                                        <th>Size: </th>
                                        <td><?= $progress_5->pet_size; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Birthday: </th>
                                        <td><?= date("F d, Y", $progress_5->pet_bday); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Age:</th>
                                        <td><?= get_age($progress_5->pet_bday); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Specie: </th>
                                        <td><?= $progress_5->pet_specie; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sex: </th>
                                        <td><?= $progress_5->pet_sex; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Breed: </th>
                                        <td><?= $progress_5->pet_breed; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sterilized: </th>
                                        <td><?= $progress_5->pet_neutered_spayed == 1 ? "Yes" : "No"; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Admission: </th>
                                        <td><?= $progress_5->pet_admission; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Description: </th>
                                        <td><?= $progress_5->pet_description; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Findings: </th>
                                        <td><?= $progress_5->pet_history; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fa fa-stethoscope"></i> Medical Record</h5>
                                </div>
                                <div class="card-body">
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
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fa fa-video-camera"></i> Video</h5>
                                </div>
                                <div class="card-body">
                                    <?php if ($progress_5->pet_video == NULL): ?>
                                        <h2>This pet has no Video</h2>
                                    <?php else: ?>
                                        <div class="embed-responsive embed-responsive-16by9 rounded mb-4">
                                            <?= wrap_iframe($progress_5->pet_video); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>    
<?php endif; ?>
