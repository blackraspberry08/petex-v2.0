<?php
    $progress_2 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 2, "progress.transaction_id" => $transaction->transaction_id))[0];
?>

<div class = "col-lg-12">
    <h3 class = "mt-3 text-center">Meet and Greet</h3>
    <p class = "text-muted">&emsp;<?= $progress_2->checklist_desc?></p>

    <!-- Comment -->
    <?php if (!empty($comments_step_2)): ?>
        <!-- There are recent comments -->
        <div class="card mb-3">
            <div class ="card-header">
                <i class = "fa fa-comment" ></i> Comments
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
                <i class = "fa fa-comment" ></i> Comments
            </div>
            <div class="card-body small bg-faded">
                <center>
                    <h4>No comments yet.</h4>
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
<div class="modal fade" id="step_2_sched_approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id = "step_2_form_a" method = "POST" role = "form">
        <!-- Hidden Fields -->
        <input type ="hidden"  id="event_title" name = "event_title" value = "Meet and Greet : <?= $transaction->user_firstname." ".$transaction->user_lastname?>" placeholder="Title">
        <input type ="hidden"  id="event_color" name = "event_color" value = "#1e7e34"/>
        <input type ="hidden"  id="event_type" name = "event_type" value = "approve"/>
        <input type ="hidden"  id="event_description" name ="event_description" value = "Adoption Form is completed (16%)! Meet and Greet will be the next step for <?= $transaction->user_firstname." ".$transaction->user_lastname?> to adopt <?= $transaction->pet_name?>.">
        
        
        <!-- Displayed Fields -->
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventHeader"><i class = "fa fa-thumbs-o-up"></i> Approve Meet and Greet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_startdate">Start Date</label>
                            <input type = "text" id = "event_startdate" name = "event_startdate" class = "form-control schedule_datepicker" placeholder = "Start Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_starttime">Start Time</label>
                            <input type = "text" id = "event_starttime" name = "event_starttime" class = "form-control no-limit-timepicker" placeholder = "Start Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class = "col-md-6 form-group">
                            <label for="event_enddate">End Date</label>
                            <input type = "text" id = "event_enddate" name = "event_enddate" class = "form-control schedule_datepicker" placeholder = "End Date" readonly="" required/>
                        </div>
                        <div class = "col-md-6 form-group">
                            <label for="event_endtime">End Time</label>
                            <input type = "text" id = "event_endtime" name = "event_endtime" class = "form-control no-limit-timepicker" placeholder = "End Time" readonly="" required/>
                        </div>
                    </div>
                    <div class = "form-row">
                        <label for="comment">Comment</label>
                        <textarea class = "form-control" id = "comment" name = "comment" placeholder = "Leave a comment here." required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id = "progressSubmit_approve" class="btn btn-primary">Approve</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- MODAL FOR DISAPPROVING STEP 2 -->
<div class="modal fade" id="step_2_sched_disapprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id = "step_2_form_d" method = "POST" role = "form">
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
                        <label for="comment">Comment</label>
                        <textarea class = "form-control" id = "comment_d" name = "comment" placeholder = "Leave a comment here." required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id = "progressSubmit_disapprove" class="btn btn-danger ">Disapprove</button>
                </div>
            </div>
        </div>
    </form>
</div>