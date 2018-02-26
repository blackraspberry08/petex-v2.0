
<?php
$progress_1 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 1, "progress.transaction_id" => $progress->transaction_id))[0];
?>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-4"><br>
            <div class="card">
                <a href = "<?= $this->config->base_url() . $progress_1->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $progress_1->pet_name ?></b>">
                    <img class="card-img-top" src = "<?= $this->config->base_url() . $progress_1->pet_picture ?>" alt="picture">
                </a>
                <div class="card-body">
                    <h4 class="card-title"><?= $progress_1->pet_name ?></h4>
                    <i class="fa fa-calendar"></i> <?= date('M. j, Y', $progress_1->pet_bday) ?><br>
                    <?php if ($progress_1->pet_sex == "Male" || $progress_1->pet_sex == "male"): ?>
                        <i class="fa fa-mars" style="color:blue"></i> <?= $progress_1->pet_sex ?><br>
                    <?php else: ?>
                        <i class="fa fa-venus" style="color:red"></i> <?= $progress_1->pet_sex ?><br>
                    <?php endif; ?>
                    <i class="fa fa-paw"></i> <?= $progress_1->pet_breed ?><br>
                    <i class="fa fa-check-square" style="color:green"></i> <?= $progress_1->pet_status ?>
                </div>

                <div class="card-footer text-center">
                    <div class = "btn-group" role="group" aria-label="Button Group">
                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress_1->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress_1->pet_id; ?>medical"  data-placement="bottom" title="View Medical Records"><i class = "fa fa-stethoscope fa-2x"></i></a>
                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress_1->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                    </div>
                </div>
            </div>
            <br>
            <center>
                <?php if ($progress_1->progress_isSuccessful == 0): ?>
                    <a href = "<?= base_url() ?>PetAdoption/petAdoptionOnlineForm_exec/<?= $progress_1->pet_id; ?>" class = "btn btn-outline-primary">Repeat Adoption Form</a>
                <?php else: ?>
                    <button  class = "btn btn-outline-primary" disabled="disabled">Repeat Adoption Form</button>
                <?php endif; ?>
            </center>
            <br>
            <?php if ($progress_1->progress_isSuccessful == 0): ?>
                <div class="card">
                    <form action="<?= base_url() ?>MyProgress/step1_comment_exec/<?= $progress_1->progress_id ?>" method="POST">
                        <div class ="card-header">
                            <i class = "fa fa-comment" ></i> Remarks
                        </div>
                        <div class="card-body">
                            <div class = "form-group">
                                <label for="date_step_1">Date</label>
                                <input type = "text" id = "date_step_1" name = "date_step_1" class = "form-control form_datetime" readonly="" />
                            </div>
                            <div class = "form-row">
                                <label for="comment_step_1"> Comment</label>
                                <textarea class = "form-control" id = "comment_step_1" name = "comment_step_1" placeholder = "Leave a comment here."></textarea>
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
                    <form action="step1_comment" method="POST">
                        <div class ="card-header">
                            <i class = "fa fa-comment" ></i> Remarks
                        </div>
                        <div class="card-body">
                            <h5><i class="fa fa-check"></i>This progress is already approved.</h5>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <h3 class = "mt-3 text-center">Adoption Form</h3>
            <p class = "text-muted">&emsp;<?= $progress_1->checklist_desc ?></p>
            <?php if (!empty($comments_step_1)): ?>
                <!-- There are recent comments -->
                <div class="card mb-3">
                    <div class ="card-header">
                        <i class = "fa fa-comment" ></i> Remarks
                    </div>
                    <?php foreach ($comments_step_1 as $comment): ?>
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
                    <?php if ($progress_1->progress_isSuccessful == 1): ?>
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
                </div><!-- /Comment-->
            <?php endif; ?>

        </div>
    </div>
</div>
<!-- Modal Details -->
<div class="modal fade <?= $progress_1->pet_id; ?>detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                        <img src = "<?= $this->config->base_url() . $progress_1->pet_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                    </div>
                    <div class ="col-md-7">
                        <table class = "table table-responsive table-striped">
                            <tbody>
                                <tr>
                                    <th>Name: </th>
                                    <td><?= $progress_1->pet_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Status: </th>
                                    <td><?= $progress_1->pet_status; ?></td>
                                </tr>
                                <tr>
                                    <th>Size: </th>
                                    <td><?= $progress_1->pet_size; ?></td>
                                </tr>
                                <tr>
                                    <th>Birthday: </th>
                                    <td><?= date("F d, Y", $progress_1->pet_bday); ?></td>
                                </tr>
                                <tr>
                                    <th>Age:</th>
                                    <td><?= get_age($progress_1->pet_bday); ?></td>
                                </tr>
                                <tr>
                                    <th>Specie: </th>
                                    <td><?= $progress_1->pet_specie; ?></td>
                                </tr>
                                <tr>
                                    <th>Sex: </th>
                                    <td><?= $progress_1->pet_sex; ?></td>
                                </tr>
                                <tr>
                                    <th>Breed: </th>
                                    <td><?= $progress_1->pet_breed; ?></td>
                                </tr>
                                <tr>
                                    <th>Sterilized: </th>
                                    <td><?= $progress_1->pet_neutered_spayed == 1 ? "Yes" : "No"; ?></td>
                                </tr>
                                <tr>
                                    <th>Admission: </th>
                                    <td><?= $progress_1->pet_admission; ?></td>
                                </tr>
                                <tr>
                                    <th>Description: </th>
                                    <td><?= $progress_1->pet_description; ?></td>
                                </tr>
                                <tr>
                                    <th>Findings: </th>
                                    <td><?= $progress_1->pet_history; ?></td>
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
<?php $medical = $this->MyProgress_model->get_animal_medical_records(array("medical_record.pet_id" => $progress_1->pet_id))[0]; ?>
<div class="modal fade <?= $progress_1->pet_id; ?>medical" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
<div class="modal fade <?= $progress_1->pet_id; ?>video" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <?php if ($progress_1->pet_video == NULL): ?>
                        <h2>This pet has no Video</h2>
                    <?php else: ?>
                        <div class="embed-responsive embed-responsive-16by9 rounded mb-4">
                            <?= wrap_iframe($progress_1->pet_video); ?>
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
