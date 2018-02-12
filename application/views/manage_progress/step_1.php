<script>
//BUTTON FUNCTIONS
$(document).on('click', '#step_1_approve', function () {
    $.ajax({
        "method": "POST",
        "url": '<?= base_url() ?>' + "ManageProgress/step_1/<?= $transaction->transaction_id?>",
        "dataType": "JSON",
        "data": {
            'schedule_title': "Meet and Greet : "+ "<?= $transaction->user_firstname." ".$transaction->user_lastname?>",
            'schedule_desc': "Adoption Form is approved (16%)! Meet and Greet will be the next step for " + "<?= $transaction->user_firstname." ".$transaction->user_lastname?>" + " to adopt " + "<?= $transaction->pet_name?>" + ".",
            'schedule_color': "#1e7e34",
            'schedule_startdate': $("#event_startdate_step_1").val(),
            'schedule_starttime': $("#event_starttime_step_1").val(),
            'schedule_enddate': $("#event_enddate_step_1").val(),
            'schedule_endtime': $("#event_endtime_step_1").val(),
            'comment':$('#comment_step_1').val(),
            'event_type':"approve"
        },
        success: function (res) {
            if (res.success) {
                swal({title: "Success", text: res.result, type: "success"},
                    function(){ 
                        location.reload();
                    }
                );
            } else {
                swal("Oops", res.result, "error");
                show_error(res.startdate, $("#event_startdate_step_1"));
                show_error(res.starttime, $("#event_starttime_step_1"));
                show_error(res.enddate, $("#event_enddate_step_1"));
                show_error(res.endtime, $("#event_endtime_step_1"));
                show_error(res.comment, $("#comment_step_1"));
            }

        },
        error: function(res){
            swal("Reload", "Something went wrong. Please reload your browser.", "error");
        }
    });

});

$(document).on('click', '#step_1_disapprove', function () {
    $.ajax({
        "method": "POST",
        "url": '<?= base_url() ?>' + "ManageProgress/step_1/<?= $transaction->transaction_id?>",
        "dataType": "JSON",
        "data": {
            'comment':$('#comment_step_1_d').val(),
            'event_type':"disapprove"
        },
        success: function (res) {
            if (res.success) {
                swal({title: "Success", text: res.result, type: "success"},
                    function(){ 
                        location.reload();
                    }
                );
            } else {
                swal("Oops", res.result, "error");
                show_error(res.comment, $("#comment_step_1_d"));
            }

        },
        error: function(res){
            swal("Reload", "Something went wrong. Please reload your browser.", "error");
        }
    });

});

</script>

<?php if (empty($adoption_form->adoption_form_location)): ?>
    <!-- No Adoption Form Submitted -->
    <div class = "col-lg-12 mt-3 text-center">
        <div class = "mb-5">
            <h4>No Adoption Form Submitted</h4>
            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
        </div>
        <div class = "mt-5">
            <span class = "text-secondary">If submitted manually</span><br>
            <div class = "btn-group mt-2 text-center" role="group" aria-label="Actions">
                <a href = "#" data-toggle = "modal" data-target = "#upload_adoption_form" class = "btn btn-outline-primary"><i class = "fa fa-upload"></i> Upload</a>
                <a href = "#" data-toggle = "modal" data-target = "#manual_input" class = "btn btn-outline-primary"><i class = "fa fa-keyboard-o"></i> Manual Input</a>
            </div>
        </div>
    </div>
    <!-- Upload Adoption Form -->
    <div class="modal fade" id="upload_adoption_form" tabindex="-1" role="dialog" aria-labelledby="uploadAdoptionForm" aria-hidden="true">
        <form enctype="multipart/form-data" method = "POST" action = "<?= base_url() ?>ManageProgress/upload_adoption_form/<?= $transaction->transaction_id ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class = "fa fa-upload"></i> Upload Adoption Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class = "form-group">
                            <label for ="adoption_form">Adoption Form</label>
                            <div class="custom-file-container" data-upload-id="adoption_form">
                                <label class="custom-file-container__custom-file" >
                                    <input type="file" name = "adoption_form" id = "adoption_form" class="custom-file-container__custom-file__custom-file-input" accept="application/pdf" required>
                                    <input type="hidden" name="MAX_FILE_SIZE" value = "10485760"/>
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    <button class="custom-file-container__image-clear">x</button>
                                </label>
                                <div class="custom-file-container__image-preview" id = "adoption_form_preview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- MANUAL INPUT -->
    <div class="modal fade" id="manual_input" tabindex="-1" role="dialog" aria-labelledby="uploadAdoptionForm" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class = "fa fa-keyboard-o"></i> Manual Input</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php include_once 'adoption_form.php'; ?> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>
    
<?php else: ?>
    <!-- Adoption Form Submitted -->
    <div class = "col-lg-12">
        <?php if ($adoption_form->adoption_form_isPending == 1): ?>
            <!-- Adoption Form is pending -->
            <h3 class = "mt-3 text-center">Pending Adoption Form</h3>
            <p class = "text-muted">&emsp;<?= $progress_1->checklist_desc?></p>
            <div class="embed-responsive embed-responsive-16by9 my-5 rounded">
                <iframe class="embed-responsive-item" src="<?= base_url() . $adoption_form->adoption_form_location ?>" allowfullscreen type="application/pdf"></iframe>
            </div>
            <div class ="row">
                <div class = "col-lg-12 mb-3">
                    <div class="media mr-3">
                        <div class="media-body text-right">
                            <h6 class="mt-0 mb-1" style ="font-weight:normal;">Sent by <strong><?= $transaction->user_firstname." ".$transaction->user_lastname?></strong></h6>
                            <span class = "text-muted">Submitted at <?= date('F d, Y \a\t h:i A', $adoption_form->adoption_form_added_at)?></span><br>
                        </div>
                        <div class = "image-fit">
                            <img class="d-flex ml-3" src="<?= base_url() . $transaction->user_picture ?>" alt = "<?= $transaction->user_firstname." ".$transaction->user_lastname?>">
                        </div>
                    </div>
                </div>
            </div>
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
                                    <img class="d-flex mr-3" src="<?= base_url() . $comment->progress_comment_picture ?>" alt="">
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
                    <div class="card-footer small text-muted text-center">
                        <div class="btn-group" role="group" aria-label="Approval">
                            <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger" data-toggle = "modal"  title = "Disapprove" data-target = "#step_1_sched_disapprove"><i class = "fa fa-thumbs-o-down"></i></button>     
                            <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary" data-toggle = "modal"  title = "Approve" data-target = "#step_1_sched_approve"><i class = "fa fa-thumbs-o-up"></i></button>
                        </div>
                    </div>
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
                    <div class="card-footer small text-muted text-center">
                        <div class="btn-group" role="group" aria-label="Approval">
                            <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger" data-toggle = "modal"  title = "Disapprove" data-target = "#step_1_sched_disapprove"><i class = "fa fa-thumbs-o-down"></i></button>     
                            <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary" data-toggle = "modal"  title = "Approve" data-target = "#step_1_sched_approve"><i class = "fa fa-thumbs-o-up"></i></button>
                        </div>
                    </div>
                </div><!-- /Comment-->
            <?php endif; ?>
        <?php else: ?>
            <!-- Adoption Form is approved -->
            <h3 class = "mt-3 text-center">Adoption Form</h3>
            <p class = "text-muted">&emsp;<?= $progress_1->checklist_desc?></p>
            
            <div class="embed-responsive embed-responsive-16by9 my-5 rounded">
                <iframe class="embed-responsive-item" src="<?= base_url() . $adoption_form->adoption_form_location ?>" allowfullscreen type="application/pdf"></iframe>
            </div>
            <div class ="row">
                <div class = "col-lg-12 mb-3">
                    <div class="media mr-3">
                        <div class="media-body text-right">
                            <h6 class="mt-0 mb-1" style ="font-weight:normal;">Sent by <strong><?= $transaction->user_firstname." ".$transaction->user_lastname?></strong></h6>
                            <span class = "text-muted">Submitted at <?= date('F d, Y \a\t h:i A', $adoption_form->adoption_form_added_at)?></span><br>
                        </div>
                        <div class = "image-fit">
                            <img class="d-flex ml-3" src="<?= base_url() . $transaction->user_picture ?>" alt = "<?= $transaction->user_firstname." ".$transaction->user_lastname?>">
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!empty($comments_step_1)): ?>
                <!-- If there are comments -->
                <div class="card mb-3">
                    <div class ="card-header">
                        <i class = "fa fa-comment" ></i> Remarks
                    </div>

                    <?php foreach ($comments_step_1 as $comment): ?>
                        <div class="card-body small bg-faded">    
                            <div class="media">
                                <div class = "image-fit">
                                    <img class="d-flex mr-3" src="<?= base_url() . $comment->progress_comment_picture ?>" alt="">
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
                    <div class ="card-footer">
                        <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                    </div>
                </div><!-- /Comment-->
            <?php else: ?>
                <!-- If there are no comments -->
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?> 
    
<!-- MODAL FOR APPROVING STEP 1 -->
<div class="modal fade" id="step_1_sched_approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id = "step_1_form_approve" method = "POST" role = "form">
        <!-- Displayed Fields -->
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventHeader_step_1"><i class = "fa fa-thumbs-o-up"></i> Approve Adoption Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-muted"><i class="fa fa-check"></i> Set schedule for Meet and Greet</p>
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_startdate_step_1">Start Date</label>
                            <input type = "text" id = "event_startdate_step_1" name = "event_startdate_step_1" class = "form-control schedule_datepicker" placeholder = "Start Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_starttime_step_1">Start Time</label>
                            <input type = "text" id = "event_starttime_step_1" name = "event_starttime_step_1" class = "form-control no-limit-timepicker" placeholder = "Start Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_enddate_step_1">End Date</label>
                            <input type = "text" id = "event_enddate_step_1" name = "event_enddate_step_1" class = "form-control schedule_datepicker" placeholder = "End Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_endtime_step_1">End Time</label>
                            <input type = "text" id = "event_endtime_step_1" name = "event_endtime_step_1" class = "form-control no-limit-timepicker" placeholder = "End Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <label for="comment_step_1">Comment</label>
                        <textarea class = "form-control" id = "comment_step_1" name = "comment_step_1" placeholder = "Leave a comment here." required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id = "step_1_approve" class="btn btn-primary">Approve</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- MODAL FOR DISAPPROVING STEP 1 -->
<div class="modal fade" id="step_1_sched_disapprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id = "step_1_form_d" method = "POST" role = "form">
        <input type ="hidden"  id="event_type" name = "event_type" value = "disapprove"/>
        <!-- Displayed Fields -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventHeader"><i class = "fa fa-thumbs-o-down"></i> Disapprove Adoption Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class = "form-row">
                        <label for="comment_step_1_d">Remarks</label>
                        <textarea class = "form-control" id = "comment_step_1_d" name = "comment_step_1_d" placeholder = "Leave a comment here." required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id = "step_1_disapprove" class="btn btn-danger ">Disapprove</button>
                </div>
            </div>
        </div>
    </form>
</div>