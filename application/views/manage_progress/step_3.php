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
    .disabled{
        cursor:not-allowed;
    }
</style>

<?php 
    $progress_3 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 3, "progress.transaction_id" => $transaction->transaction_id))[0];
    $schedule_3 = $this->ManageProgress_model->get_schedule(array("schedule.progress_id" => $progress_3->progress_id));
    $sched_1    = $schedule_3[0];
    $sched_2    = $schedule_3[1];
    $sched_3    = $schedule_3[2];
?>

<script>
    $(document).ready(function(){
        $('.approve_3').attr("disabled", "disabled");
        $('.approve_3').addClass("disabled");
        <?php if($progress_3->progress_percentage == 0):?>
            $('#done_sched_<?= $sched_1->schedule_id?>').removeClass("disabled");
            $('#done_sched_<?= $sched_1->schedule_id?>').prop("disabled", false);
        <?php elseif($progress_3->progress_percentage == 33):?>
            //INTERVIEW #1 is DONE!
            $('#done_sched_<?= $sched_1->schedule_id?>').removeClass("btn-outline-dark");
            $('#done_sched_<?= $sched_1->schedule_id?>').addClass("disabled btn-outline-success");
            $('#done_sched_<?= $sched_1->schedule_id?>').attr("disabled", "disabled");
            $('#done_sched_<?= $sched_1->schedule_id?>').html("<i class = 'fa fa-check'></i> Schedule is done");
            $('#done_sched_<?= $sched_2->schedule_id?>').removeClass("disabled");
            $('#done_sched_<?= $sched_2->schedule_id?>').prop("disabled", false);
        <?php elseif($progress_3->progress_percentage == 66):?>
            //INTERVIEW #2 is DONE!
            $('#done_sched_<?= $sched_1->schedule_id?>').removeClass("btn-outline-dark");
            $('#done_sched_<?= $sched_1->schedule_id?>').addClass("disabled btn-outline-success");
            $('#done_sched_<?= $sched_1->schedule_id?>').attr("disabled", "disabled");
            $('#done_sched_<?= $sched_1->schedule_id?>').html("<i class = 'fa fa-check'></i> Schedule is done");
            $('#done_sched_<?= $sched_2->schedule_id?>').removeClass("btn-outline-dark");
            $('#done_sched_<?= $sched_2->schedule_id?>').addClass("disabled btn-outline-success");
            $('#done_sched_<?= $sched_2->schedule_id?>').attr("disabled", "disabled");
            $('#done_sched_<?= $sched_2->schedule_id?>').html("<i class = 'fa fa-check'></i> Schedule is done");
            $('#done_sched_<?= $sched_3->schedule_id?>').removeClass("disabled");
            $('#done_sched_<?= $sched_3->schedule_id?>').prop("disabled", false);
        <?php elseif($progress_3->progress_percentage == 100):?>
            //INTERVIEW #3 is DONE!
            $('#done_sched_<?= $sched_1->schedule_id?>').removeClass("btn-outline-dark");
            $('#done_sched_<?= $sched_1->schedule_id?>').addClass("disabled btn-outline-success");
            $('#done_sched_<?= $sched_1->schedule_id?>').attr("disabled", "disabled");
            $('#done_sched_<?= $sched_1->schedule_id?>').html("<i class = 'fa fa-check'></i> Schedule is done");
            $('#done_sched_<?= $sched_2->schedule_id?>').removeClass("btn-outline-dark");
            $('#done_sched_<?= $sched_2->schedule_id?>').addClass("disabled btn-outline-success");
            $('#done_sched_<?= $sched_2->schedule_id?>').attr("disabled", "disabled");
            $('#done_sched_<?= $sched_2->schedule_id?>').html("<i class = 'fa fa-check'></i> Schedule is done");   
            $('#done_sched_<?= $sched_3->schedule_id?>').removeClass("btn-outline-dark");
            $('#done_sched_<?= $sched_3->schedule_id?>').addClass("disabled btn-outline-success");
            $('#done_sched_<?= $sched_3->schedule_id?>').attr("disabled", "disabled");
            $('#done_sched_<?= $sched_3->schedule_id?>').html("<i class = 'fa fa-check'></i> Schedule is done");
            $(".approve_3").prop("disabled", false);
            $(".approve_3").removeClass("disabled");
            $(".approve_3").css("cursor", "pointer");
        <?php endif;?>
            
        //Functions here
        $('#done_sched_<?= $sched_1->schedule_id?>').click(function(){
            $(this).removeClass("btn-outline-dark");
            $(this).addClass("disabled btn-outline-success");
            $(this).attr("disabled", "disabled");
            $(this).html("<i class = 'fa fa-check'></i> Schedule is done");
            $.ajax({
                "method": "POST",
                "url": '<?= base_url() ?>' + "ManageProgress/step_3/<?= $transaction->transaction_id?>",
                "dataType": "JSON",
                "data": {
                    'event_type':"done_sched_1"
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
        $('#done_sched_<?= $sched_2->schedule_id?>').click(function(){
            $(this).removeClass("btn-outline-dark");
            $(this).addClass("disabled btn-outline-success");
            $(this).attr("disabled", "disabled");
            $(this).html("<i class = 'fa fa-check'></i> Schedule is done");
            $.ajax({
                "method": "POST",
                "url": '<?= base_url() ?>' + "ManageProgress/step_3/<?= $transaction->transaction_id?>",
                "dataType": "JSON",
                "data": {
                    'event_type':"done_sched_2"
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
        $('#done_sched_<?= $sched_3->schedule_id?>').click(function(){
            $(this).removeClass("btn-outline-dark");
            $(this).addClass("disabled btn-outline-success");
            $(this).attr("disabled", "disabled");
            $(this).html("<i class = 'fa fa-check'></i> Schedule is done");
            $.ajax({
                "method": "POST",
                "url": '<?= base_url() ?>' + "ManageProgress/step_3/<?= $transaction->transaction_id?>",
                "dataType": "JSON",
                "data": {
                    'event_type':"done_sched_3"
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
        
        $('#step_3_approve').click(function(){
            $.ajax({
                "method": "POST",
                "url": '<?= base_url() ?>' + "ManageProgress/step_3/<?= $transaction->transaction_id?>",
                "dataType": "JSON",
                "data": {
                    'schedule_title_prog3': $("#event_title_prog3").val(),
                    'schedule_desc_prog3': $("#event_description_prog3").val(),
                    'schedule_color_prog3': $("#event_color_prog3").val(),
                    'schedule_startdate_prog3': $("#event_startdate_prog3").val(),
                    'schedule_starttime_prog3': $("#event_starttime_prog3").val(),
                    'schedule_enddate_prog3': $("#event_enddate_prog3").val(),
                    'schedule_endtime_prog3': $("#event_endtime_prog3").val(),
                    'comment_prog3': $("#comment_prog3").val(),
                    'event_type':"approve"
                },
                success: function (res) {
                    if (res.success) {
                        location.reload();
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
        
        });
    });
</script>

<div class = "col-lg-12">
    <h3 class = "mt-3 text-center">Interview</h3>
    <p class = "text-muted">&emsp;<?= $progress_3->checklist_desc?></p>
    
    <?php if(!empty($schedule_3)):?>
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
                                <span style = "font-size:12px;"><?= date('F d, Y', $sched_1->schedule_startdate)?></span><br>
                                <span style = "font-size:12px;"><?= date('h:i A', $sched_1->schedule_startdate)?></span>
                            </div>
                            <div class = "col-md-6">
                                <h6>End</h6>
                                <span style = "font-size:12px;"><?= date('F d, Y', $sched_1->schedule_enddate)?></span><br>
                                <span style = "font-size:12px;"><?= date('h:i A', $sched_1->schedule_enddate)?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-dark">
                        <h6 class="card-title"><?= $sched_1->schedule_title?></h6>
                        <p class="card-text"><?= $sched_1->schedule_desc?></p>
                    </div>
                    <div class = "card-footer">
                        <button id = "done_sched_<?= $sched_1->schedule_id?>" class = "btn btn-outline-dark disabled" disabled>Done</button>
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
                                <span style = "font-size:12px;"><?= date('F d, Y', $sched_2->schedule_startdate)?></span><br>
                                <span style = "font-size:12px;"><?= date('h:i A', $sched_2->schedule_startdate)?></span>
                            </div>
                            <div class = "col-md-6">
                                <h6>End</h6>
                                <span style = "font-size:12px;"><?= date('F d, Y', $sched_2->schedule_enddate)?></span><br>
                                <span style = "font-size:12px;"><?= date('h:i A', $sched_2->schedule_enddate)?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-dark">
                        <h6 class="card-title"><?= $sched_2->schedule_title?></h6>
                        <p class="card-text"><?= $sched_2->schedule_desc?></p>
                    </div>
                    <div class = "card-footer">
                        <button id = "done_sched_<?= $sched_2->schedule_id?>" class = "btn btn-outline-dark disabled" disabled>Done</button>
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
                                <span style = "font-size:12px;"><?= date('F d, Y', $sched_3->schedule_startdate)?></span><br>
                                <span style = "font-size:12px;"><?= date('h:i A', $sched_3->schedule_startdate)?></span>
                            </div>
                            <div class = "col-md-6">
                                <h6>End</h6>
                                <span style = "font-size:12px;"><?= date('F d, Y', $sched_3->schedule_enddate)?></span><br>
                                <span style = "font-size:12px;"><?= date('h:i A', $sched_3->schedule_enddate)?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-dark">
                        <h6 class="card-title"><?= $sched_3->schedule_title?></h6>
                        <p class="card-text"><?= $sched_3->schedule_desc?></p>
                    </div>
                    <div class = "card-footer">
                        <button id = "done_sched_<?= $sched_3->schedule_id?>" class = "btn btn-outline-dark disabled" disabled>Done</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
    
    <!-- Comment -->
    <?php if (!empty($comments_step_3)): ?>
        <!-- There are recent comments -->
        <div class="card mb-3">
            <div class ="card-header">
                <i class = "fa fa-comment" ></i> Comments
            </div>
            
            <?php foreach ($comments_step_3 as $comment): ?>
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
            <?php if($progress_3->progress_isSuccessful == 1):?>
                <div class ="card-footer">
                    <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                </div>
            <?php else:?>
                <div class="card-footer small text-muted text-center">
                    <div class="btn-group" role="group" aria-label="Approval">
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger" data-toggle = "modal"  title = "Disapprove" data-target = "#step_3_sched_disapprove"><i class = "fa fa-thumbs-o-down"></i></button>     
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary approve_3" data-toggle = "modal"  title = "Approve" data-target = "#step_3_sched_approve"><i class = "fa fa-thumbs-o-up"></i></button>
                    </div>
                </div>
            <?php endif;?>
            
        </div><!-- /Comment-->
    <?php else: ?>
        <!-- There are no comments -->
        <div class="card mb-3">
            <div class ="card-header">
                <i class = "fa fa-comment" ></i> Comments
            </div>
            <div class="card-body small bg-faded">
                <center>
                    <h4>No comments yet.</h4>
                    <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                    <br><br>
                </center>
            </div>
            <?php if($progress_3->progress_isSuccessful == 1):?>
                <div class ="card-footer">
                    <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                </div>
            <?php else:?>
                <div class="card-footer small text-muted text-center">
                    <div class="btn-group" role="group" aria-label="Approval">
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger" data-toggle = "modal"  title = "Disapprove" data-target = "#step_3_sched_disapprove"><i class = "fa fa-thumbs-o-down"></i></button>     
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary approve_3" data-toggle = "modal"  title = "Approve" data-target = "#step_3_sched_approve"><i class = "fa fa-thumbs-o-up"></i></button>
                    </div>
                </div>
            <?php endif;?>
        </div><!-- /Comment-->
    <?php endif; ?>
</div>

<!-- MODAL FOR APPROVING STEP 3 -->
<div class="modal fade" id="step_3_sched_approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id = "step_3_form_a" method = "POST" role = "form">
        <!-- Hidden Fields -->
        <input type ="hidden"  id="event_title_prog3" name = "event_title_prog3" value = "Home Visit : <?= $transaction->user_firstname." ".$transaction->user_lastname?>" placeholder="Title">
        <input type ="hidden"  id="event_color_prog3" name = "event_color_prog3" value = "#1e7e34"/>
        <input type ="hidden"  id="event_type_prog3" name = "event_type" value = "approve"/>
        <input type ="hidden"  id="event_description_prog3" name ="event_description_prog3" value = "All Interviews are done (49%)! Meet and Greet will be the next step for <?= $transaction->user_firstname." ".$transaction->user_lastname?> to adopt <?= $transaction->pet_name?>.">
        <!-- Displayed Fields -->
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventHeader_prog3"><i class = "fa fa-thumbs-o-up"></i> Approve Interviews</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-muted"><i class="fa fa-check"></i> Set schedule for Home Visit</p>
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_startdate_prog3">Start Date</label>
                            <input type = "text" id = "event_startdate_prog3" name = "event_startdate_prog3" class = "form-control schedule_datepicker" placeholder = "Start Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_starttime_prog3">Start Time</label>
                            <input type = "text" id = "event_starttime_prog3" name = "event_starttime_prog3" class = "form-control no-limit-timepicker" placeholder = "Start Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_enddate_prog3">End Date</label>
                            <input type = "text" id = "event_enddate_prog3" name = "event_enddate_prog3" class = "form-control schedule_datepicker" placeholder = "End Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_endtime_prog3">End Time</label>
                            <input type = "text" id = "event_endtime_prog3" name = "event_endtime_prog3" class = "form-control no-limit-timepicker" placeholder = "End Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <label for="comment_prog3">Comment</label>
                        <textarea class = "form-control" id = "comment_prog3" name = "comment_prog3" placeholder = "Leave a comment here." required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id = "step_3_approve" class="btn btn-primary">Approve</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- MODAL FOR DISAPPROVING STEP 2 -->
<div class="modal fade" id="step_3_sched_disapprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id = "step_3_form_d" method = "POST" role = "form">
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
                        <textarea class = "form-control" id = "comment_d_3" name = "comment" placeholder = "Leave a comment here." required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id = "step_3_disapprove" class="btn btn-danger">Disapprove</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $(document).on('click', '#step_3_disapprove', function () {
            $.ajax({
                "method": "POST",
                "url": '<?= base_url() ?>' + "ManageProgress/step_3/<?= $transaction->transaction_id?>",
                "dataType": "JSON",
                "data": {
                    'comment':$('#comment_d_3').val(),
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