<style>
    .hide{
        display:none;
    }
    .label.label-success{
        background-color: #5cb85c;
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }
</style>

<?php 
    $progress_2 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 2, "progress.transaction_id" => $transaction->transaction_id))[0];
    $schedule_2 = $this->ManageProgress_model->get_schedule(array("schedule.progress_id" => $progress_2->progress_id))[0];
?>

<div class = "col-lg-12">
    <h3 class = "mt-3 text-center">Meet and Greet</h3>
    <p class = "text-muted">&emsp;<?= $progress_2->checklist_desc?></p>
    
    <div class="card border-dark mb-3 mx-auto text-center" style="max-width: 30rem;">
        <div class="card-header">
            <i class = "fa fa-clock-o fa-5x"></i>
            <br>
            <h5 class = "text-muted">Schedule</h5>
        </div>
        <div class="card-header">
            <div class ="row">
                <div class = "col-md-6">
                    <h6>Start</h6>
                    <span style = "font-size:12px;"><?= date('F d, Y', $schedule_2->schedule_startdate)?></span><br>
                    <span style = "font-size:12px;"><?= date('h:i A', $schedule_2->schedule_startdate)?></span>
                </div>
                <div class = "col-md-6">
                    <h6>End</h6>
                    <span style = "font-size:12px;"><?= date('F d, Y', $schedule_2->schedule_enddate)?></span><br>
                    <span style = "font-size:12px;"><?= date('h:i A', $schedule_2->schedule_enddate)?></span>
                </div>
            </div>
        </div>
        <div class="card-body text-dark">
            <h6 class="card-title"><?= $schedule_2->schedule_title?></h6>
            <p class="card-text"><?= $schedule_2->schedule_desc?></p>
        </div>
    </div>
    
    <!-- Comment -->
    <?php if (!empty($comments_step_2)): ?>
        <!-- There are recent comments -->
        <div class="card mb-3">
            <div class ="card-header">
                <i class = "fa fa-comment" ></i> Remarks
            </div>
            
            <?php foreach ($comments_step_2 as $comment): ?>
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
            <?php if($progress_2->progress_isSuccessful == 1):?>
                <div class ="card-footer">
                    <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                </div>
            <?php else:?>
                <div class="card-footer small text-muted text-center">
                    <div class="btn-group" role="group" aria-label="Approval">
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger" data-toggle = "modal"  title = "Disapprove" data-target = "#step_2_sched_disapprove"><i class = "fa fa-thumbs-o-down"></i></button>     
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary" data-toggle = "modal"  title = "Approve" data-target = "#step_2_sched_approve"><i class = "fa fa-thumbs-o-up"></i></button>
                    </div>
                </div>
            <?php endif;?>
            
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
            <?php if($progress_2->progress_isSuccessful == 1):?>
                <div class ="card-footer">
                    <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                </div>
            <?php else:?>
                <div class="card-footer small text-muted text-center">
                    <div class="btn-group" role="group" aria-label="Approval">
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger" data-toggle = "modal"  title = "Disapprove" data-target = "#step_2_sched_disapprove"><i class = "fa fa-thumbs-o-down"></i></button>     
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary" data-toggle = "modal"  title = "Approve" data-target = "#step_2_sched_approve"><i class = "fa fa-thumbs-o-up"></i></button>
                    </div>
                </div>
            <?php endif;?>
        </div><!-- /Comment-->
    <?php endif; ?>
</div>

<!-- MODAL FOR APPROVING STEP 2 -->
<div class="modal fade multi-step" id="step_2_sched_approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Displayed Fields -->
    <div class="modal-dialog modal-lg"role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title step-1" data-step="1"><i class = "fa fa-thumbs-o-up"></i> Approve Meet and Greet</h5>
                <h5 class="modal-title step-2" data-step="2"><i class = "fa fa-thumbs-o-up"></i> Approve Meet and Greet</h5>
                <h5 class="modal-title step-3" data-step="3"><i class = "fa fa-thumbs-o-up"></i> Approve Meet and Greet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body step step-1">
                <p class="text-muted"><i class="fa fa-check"></i> Set schedule for Interview #1</p>
                <form role ="form" method="POST">
                    <!-- Hidden Fields -->
                    <input type ="hidden"  id="event_title_1" name = "event_title_1" value = "Interview #1 : <?= $transaction->user_firstname." ".$transaction->user_lastname?>" placeholder="Title">
                    <input type ="hidden"  id="event_color_1" name = "event_color_1" value = "#1e7e34"/>
                    <input type ="hidden"  id="event_type_1" name = "event_type_1" value = "approve"/>
                    <input type ="hidden"  id="event_description_1" name ="event_description_1" value = "Meet and Greet is completed (32%)! Interview #1 will be the next step for <?= $transaction->user_firstname." ".$transaction->user_lastname?> to adopt <?= $transaction->pet_name?>.">
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_startdate_1">Start Date</label>
                            <input type = "text" id = "event_startdate_1" name = "event_startdate_1" class = "form-control schedule_datepicker" placeholder = "Start Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_starttime_1">Start Time</label>
                            <input type = "text" id = "event_starttime_1" name = "event_starttime_1" class = "form-control no-limit-timepicker" placeholder = "Start Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_enddate_1">End Date</label>
                            <input type = "text" id = "event_enddate_1" name = "event_enddate_1" class = "form-control schedule_datepicker" placeholder = "End Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_endtime_1">End Time</label>
                            <input type = "text" id = "event_endtime_1" name = "event_endtime_1" class = "form-control no-limit-timepicker" placeholder = "End Time" readonly="" required/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-body step step-2">
                <p class="text-muted"><i class="fa fa-check"></i> Set schedule for Interview #2</p>
                <form role ="form" method="POST">
                    <!-- Hidden Fields -->
                    <input type ="hidden"  id="event_title_2" name = "event_title_2" value = "Interview #2 : <?= $transaction->user_firstname." ".$transaction->user_lastname?>" placeholder="Title">
                    <input type ="hidden"  id="event_color_2" name = "event_color_2" value = "#1e7e34"/>
                    <input type ="hidden"  id="event_type_2" name = "event_type_2" value = "approve"/>
                    <input type ="hidden"  id="event_description_2" name ="event_description_2" value = "Meet and Greet is completed (32%)! Interview #2 will be the next step for <?= $transaction->user_firstname." ".$transaction->user_lastname?> to adopt <?= $transaction->pet_name?>.">
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_startdate_2">Start Date</label>
                            <input type = "text" id = "event_startdate_2" name = "event_startdate_2" class = "form-control schedule_datepicker" placeholder = "Start Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_starttime_2">Start Time</label>
                            <input type = "text" id = "event_starttime_2" name = "event_starttime_2" class = "form-control no-limit-timepicker" placeholder = "Start Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_enddate_2">End Date</label>
                            <input type = "text" id = "event_enddate_2" name = "event_enddate_2" class = "form-control schedule_datepicker" placeholder = "End Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_endtime_2">End Time</label>
                            <input type = "text" id = "event_endtime_2" name = "event_endtime_2" class = "form-control no-limit-timepicker" placeholder = "End Time" readonly="" required/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-body step step-3">
                <p class="text-muted"><i class="fa fa-check"></i> Set schedule for Interview #3</p>
                <form role ="form" method="POST">
                    <!-- Hidden Fields -->
                    <input type ="hidden"  id="event_title_prog2" name = "event_title_prog2" value = "Interview #3 : <?= $transaction->user_firstname." ".$transaction->user_lastname?>" placeholder="Title">
                    <input type ="hidden"  id="event_color_prog2" name = "event_color_prog2" value = "#1e7e34"/>
                    <input type ="hidden"  id="event_type_prog2" name = "event_type_prog2" value = "approve"/>
                    <input type ="hidden"  id="event_description_prog2" name ="event_description_prog2" value = "Meet and Greet is completed (32%)! Interview #3 will be the next step for <?= $transaction->user_firstname." ".$transaction->user_lastname?> to adopt <?= $transaction->pet_name?>.">
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_startdate">Start Date</label>
                            <input type = "text" id = "event_startdate_prog2" name = "event_startdate_prog2" class = "form-control schedule_datepicker" placeholder = "Start Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_starttime">Start Time</label>
                            <input type = "text" id = "event_starttime_prog2" name = "event_starttime_prog2" class = "form-control no-limit-timepicker" placeholder = "Start Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_enddate">End Date</label>
                            <input type = "text" id = "event_enddate_prog2" name = "event_enddate_prog2" class = "form-control schedule_datepicker" placeholder = "End Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_endtime">End Time</label>
                            <input type = "text" id = "event_endtime_prog2" name = "event_endtime_prog2" class = "form-control no-limit-timepicker" placeholder = "End Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <label for="comment">Comment</label>
                        <textarea class = "form-control" id = "comment_a_2" name = "comment_a_2" placeholder = "Leave a comment here." required=""></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id = "setSched_1" class="btn btn-primary step step-1" data-step="1" onclick="nextStep(1)">Set Schedule #1</button>
                <button type="button" id = "setSched_2" class="btn btn-primary step step-2" data-step="2" onclick="nextStep(2)">Set Schedule #2</button>
                <button type="button" id = "step_2_approve" class="btn btn-primary step step-3" data-step="3" onclick="nextStep(3)">Approve</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FOR DISAPPROVING STEP 2 -->
<div class="modal fade" id="step_2_sched_disapprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id = "step_2_form_d" method = "POST" role = "form">
        <input type ="hidden"  id="event_type" name = "event_type" value = "disapprove"/>
        <!-- Displayed Fields -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventHeader"><i class = "fa fa-thumbs-o-down"></i> Disapprove Meet and Greet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class = "form-row">
                        <label for="comment">Comment</label>
                        <textarea class = "form-control" id = "comment_d_2" name = "comment" placeholder = "Leave a comment here." required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id = "step_2_disapprove" class="btn btn-danger">Disapprove</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src = "<?=base_url()?>assets/bootstrap-modal-stepper/js/multi-step-modal.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '#step_2_disapprove', function () {
            $.ajax({
                "method": "POST",
                "url": '<?= base_url() ?>' + "ManageProgress/step_2/<?= $transaction->transaction_id?>",
                "dataType": "JSON",
                "data": {
                    'comment':$('#comment_d_2').val(),
                    'event_type':"disapprove"
                },
                success: function (res) {
                    if (res.success) {
                        location.reload();
                    } else {
                        alert(res.result);
                    }
                },
                error: function(res){
                    console.log("ERROR");
                }
            });
        });     
});//ready()
</script>
<script>
    $(document).ready(function(){
        nextStep = function(step) {
            switch(step){
                case 1:{
                    $.ajax({
                        "method": "POST",
                        "url": '<?= base_url() ?>' + "ManageProgress/step_2/<?= $transaction->transaction_id?>",
                        "dataType": "JSON",
                        "data": {
                            'schedule_title_1': $("#event_title_1").val(),
                            'schedule_desc_1': $("#event_description_1").val(),
                            'schedule_color_1': $("#event_color_1").val(),
                            'schedule_startdate_1': $("#event_startdate_1").val(),
                            'schedule_starttime_1': $("#event_starttime_1").val(),
                            'schedule_enddate_1': $("#event_enddate_1").val(),
                            'schedule_endtime_1': $("#event_endtime_1").val(),
                            'event_type':"setSched_1"
                        },
                        success: function (res) {
                            if (res.success) {
                                $('.step').trigger('next.m.2');
                                console.log("SUCCESS");
                            } else {
                                alert(res.result);
                                console.log("UNSUCCESSFUL");
                                console.log(res);
                            }
                        },
                        error: function(res){
                            console.log("ERROR");
                            console.log(res);
                        }
                    });
                    
                    break;
                }
                case 2:{
                    $.ajax({
                        "method": "POST",
                        "url": '<?= base_url() ?>' + "ManageProgress/step_2/<?= $transaction->transaction_id?>",
                        "dataType": "JSON",
                        "data": {
                            'schedule_title_2': $("#event_title_2").val(),
                            'schedule_desc_2': $("#event_description_2").val(),
                            'schedule_color_2': $("#event_color_2").val(),
                            'schedule_startdate_2': $("#event_startdate_2").val(),
                            'schedule_starttime_2': $("#event_starttime_2").val(),
                            'schedule_enddate_2': $("#event_enddate_2").val(),
                            'schedule_endtime_2': $("#event_endtime_2").val(),
                            'event_type':"setSched_2"
                        },
                        success: function (res) {
                            if (res.success) {
                                $('.step').trigger('next.m.3');
                                console.log("SUCCESS");
                            } else {
                                alert(res.result);
                                console.log("UNSUCCESSFUL");
                            }

                        },
                        error: function(res){
                            console.log("ERROR");
                            alert("Something went wrong while setting your schedule.");
                        }
                    });
                    break;
                }
                case 3:{
                    $.ajax({
                        "method": "POST",
                        "url": '<?= base_url() ?>' + "ManageProgress/step_2/<?= $transaction->transaction_id?>",
                        "dataType": "JSON",
                        "data": {
                            'schedule_title': $("#event_title_prog2").val(),
                            'schedule_desc': $("#event_description_prog2").val(),
                            'schedule_color': $("#event_color_prog2").val(),
                            'schedule_startdate': $("#event_startdate_prog2").val(),
                            'schedule_starttime': $("#event_starttime_prog2").val(),
                            'schedule_enddate': $("#event_enddate_prog2").val(),
                            'schedule_endtime': $("#event_endtime_prog2").val(),
                            'comment':$('#comment_a_2').val(),
                            'event_type':"approve"
                        },
                        success: function (res) {
                            if (res.success) {
                                location.reload();
                                console.log("SUCCESS");
                            } else {
                                alert(res.result);
                                console.log("UNSUCCESSFUL");
                                console.log(res);
                            }

                        },
                        error: function(res){
                            console.log("ERROR");
                            alert("Something went wrong while setting your schedule.");
                        }
                    });
                    break;
                }
                default:{}
            }
        }
        
    });
</script>