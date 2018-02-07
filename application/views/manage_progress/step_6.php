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
    $progress_6 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 6, "progress.transaction_id" => $transaction->transaction_id))[0];
    $schedule_6 = $this->ManageProgress_model->get_schedule(array("schedule.progress_id" => $progress_6->progress_id))[0];
?>

<div class = "col-lg-12">
    <h3 class = "mt-3 text-center">Release Day</h3>
    <p class = "text-muted">&emsp;<?= $progress_6->checklist_desc?></p>
    
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
                    <span style = "font-size:12px;"><?= date('F d, Y', $schedule_6->schedule_startdate)?></span><br>
                    <span style = "font-size:12px;"><?= date('h:i A', $schedule_6->schedule_startdate)?></span>
                </div>
                <div class = "col-md-6">
                    <h6>End</h6>
                    <span style = "font-size:12px;"><?= date('F d, Y', $schedule_6->schedule_enddate)?></span><br>
                    <span style = "font-size:12px;"><?= date('h:i A', $schedule_6->schedule_enddate)?></span>
                </div>
            </div>
        </div>
        <div class="card-body text-dark">
            <h6 class="card-title"><?= $schedule_6->schedule_title?></h6>
            <p class="card-text"><?= $schedule_6->schedule_desc?></p>
        </div>
    </div>
    
    <!-- Comment -->
    <?php if (!empty($comments_step_6)): ?>
        <!-- There are recent comments -->
        <div class="card mb-3">
            <div class ="card-header">
                <i class = "fa fa-comment" ></i> Remarks
            </div>
            
            <?php foreach ($comments_step_6 as $comment): ?>
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
            <?php if($progress_6->progress_isSuccessful == 1):?>
                <div class ="card-footer">
                    <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                </div>
            <?php else:?>
                <div class="card-footer small text-muted text-center">
                    <div class="btn-group" role="group" aria-label="Approval">
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger" data-toggle = "modal"  title = "Disapprove" data-target = "#step_6_sched_disapprove"><i class = "fa fa-thumbs-o-down"></i></button>     
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary" data-toggle = "modal"  title = "Approve" data-target = "#step_6_sched_approve"><i class = "fa fa-thumbs-o-up"></i></button>
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
            <?php if($progress_6->progress_isSuccessful == 1):?>
                <div class ="card-footer">
                    <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                </div>
            <?php else:?>
                <div class="card-footer small text-muted text-center">
                    <div class="btn-group" role="group" aria-label="Approval">
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger" data-toggle = "modal"  title = "Disapprove" data-target = "#step_6_sched_disapprove"><i class = "fa fa-thumbs-o-down"></i></button>     
                        <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary" data-toggle = "modal"  title = "Approve" data-target = "#step_6_sched_approve"><i class = "fa fa-thumbs-o-up"></i></button>
                    </div>
                </div>
            <?php endif;?>
        </div><!-- /Comment-->
    <?php endif; ?>
</div>

<!-- MODAL FOR APPROVING STEP 5 -->
<div class="modal fade" id="step_6_sched_approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id = "step_6_form_a" method = "POST" role = "form">
        <!-- Hidden Fields -->
        <input type ="hidden"  id="event_title_prog5" name = "event_title_prog6" value = "Release Day : <?= $transaction->user_firstname." ".$transaction->user_lastname?>" placeholder="Title">
        <input type ="hidden"  id="event_color_prog5" name = "event_color_prog6" value = "#1e7e34"/>
        <input type ="hidden"  id="event_type" name = "event_type" value = "approve"/>
        <input type ="hidden"  id="event_description_prog5" name ="event_description_prog6" value = "Visiting chosen adoptee is done (83%)! Release Day will be the next step for <?= $transaction->user_firstname." ".$transaction->user_lastname?> to adopt <?= $transaction->pet_name?>.">
        <!-- Displayed Fields -->
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventHeader_prog6"><i class = "fa fa-thumbs-o-up"></i> Approve Visiting Chosen Adoptee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-muted"><i class="fa fa-check"></i> Set schedule for the Release Day</p>
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_startdate_prog6">Start Date</label>
                            <input type = "text" id = "event_startdate_prog6" name = "event_startdate_prog6" class = "form-control schedule_datepicker" placeholder = "Start Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_starttime_prog6">Start Time</label>
                            <input type = "text" id = "event_starttime_prog6" name = "event_starttime_prog6" class = "form-control no-limit-timepicker" placeholder = "Start Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_enddate_prog6">End Date</label>
                            <input type = "text" id = "event_enddate_prog5" name = "event_enddate_prog6" class = "form-control schedule_datepicker" placeholder = "End Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_endtime_prog6">End Time</label>
                            <input type = "text" id = "event_endtime_prog6" name = "event_endtime_prog6" class = "form-control no-limit-timepicker" placeholder = "End Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <label for="comment_prog5">Comment</label>
                        <textarea class = "form-control" id = "comment_prog6" name = "comment_prog6" placeholder = "Leave a comment here." required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id = "step_6_approve" class="btn btn-primary">Approve</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- MODAL FOR DISAPPROVING STEP 5 -->
<div class="modal fade" id="step_6_sched_disapprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id = "step_6_form_d" method = "POST" role = "form">
        <input type ="hidden"  id="event_type" name = "event_type" value = "disapprove"/>
        <!-- Displayed Fields -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventHeader"><i class = "fa fa-thumbs-o-down"></i> Disapprove Visiting Chosen Adoptee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class = "form-row">
                        <label for="comment">Comment</label>
                        <textarea class = "form-control" id = "comment_d_6" name = "comment" placeholder = "Leave a comment here." required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id = "step_6_disapprove" class="btn btn-danger">Disapprove</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
$(document).ready(function(){
    $(document).on('click', '#step_6_disapprove', function () {
        $.ajax({
            "method": "POST",
            "url": '<?= base_url() ?>' + "ManageProgress/step_6/<?= $transaction->transaction_id?>",
            "dataType": "JSON",
            "data": {
                'comment':$('#comment_d_6').val(),
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
    
    $(document).on('click', '#step_6_approve', function () {
        $.ajax({
            "method": "POST",
            "url": '<?= base_url() ?>' + "ManageProgress/step_6/<?= $transaction->transaction_id?>",
            "dataType": "JSON",
            "data": {
                'schedule_title_prog6': $("#event_title_prog6").val(),
                'schedule_desc_prog6': $("#event_description_prog6").val(),
                'schedule_color_prog6': $("#event_color_prog6").val(),
                'schedule_startdate_prog6': $("#event_startdate_prog6").val(),
                'schedule_starttime_prog6': $("#event_starttime_prog6").val(),
                'schedule_enddate_prog6': $("#event_enddate_prog6").val(),
                'schedule_endtime_prog6': $("#event_endtime_prog6").val(),
                'comment_prog6': $("#comment_prog6").val(),
                'event_type':"approve"
            },
            success: function (res) {
                if (res.success) {
                    location.reload();
                } else {
                    alert(res.result);
                    console.log(res);
                }
            },
            error: function(res){
                console.log("ERROR");
            }
        });
    });
});//ready()
</script>