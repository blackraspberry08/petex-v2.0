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
    .custom-file-container__image-preview{
        max-width:500px;
        margin:10px auto;
    }
</style>


<?php 
    $schedule_6 = $this->ManageProgress_model->get_schedule(array("schedule.progress_id" => $progress_6->progress_id))[0];
?>

<?php if(empty($schedule_6)):?>
    <!-- NOTHING TO DO HERE -->
<?php else:?>

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
    
    
    <?php if(!empty($adoption)): ?>
        <?php if($adoption != ""):?>
        <div class = "row my-3">
            <div class = "col-md-12 text-center">
                <h3 class = "mt-3">Adoption Proof</h3>
                <a href = "<?= base_url().$adoption->adoption_proof_img?>" data-toggle="lightbox" data-title = "Proof of adoption" data-footer="<?= $transaction->user_firstname." ".$transaction->user_lastname?> with his newly adopted pet, <?= $transaction->pet_name?>">
                    <img src = "<?= base_url().$adoption->adoption_proof_img?>" class = "img-fluid img-thumbnail" style = "max-height:200px">
                </a>
            </div>
        </div>
        <?php endif;?>
    <?php endif;?>
    
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
                    <h4>No remarks</h4>
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

<!-- MODAL FOR APPROVING STEP 6 -->
<div class="modal fade" id="step_6_sched_approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Displayed Fields -->
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id = "adoption_picture_form" action = "<?= base_url()?>ManageProgress/step_6_adoption_proof/<?= $transaction->transaction_id?>" role = "form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventHeader_prog6"><i class = "fa fa-thumbs-o-up"></i> Finishing Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class = "form-group">
                        <label for ="adoption_picture">Picture</label>
                        <div class="custom-file-container" data-upload-id="adoption_picture">
                            <label class="custom-file-container__custom-file" >
                                <input type="file" name = "adoption_picture" id = "adoption_picture" class="custom-file-container__custom-file__custom-file-input" accept="image/*" onClick="this.form.reset()">
                                <input type="hidden" name="MAX_FILE_SIZE" value = "10485760"/>
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                <button class="custom-file-container__image-clear">x</button>
                            </label>
                            <small id="videoHelp" class="form-text text-muted">
                                Max size is 5MB. Allowed types is .jpg, .jpeg, .gif, .png
                            </small>
                            <div class="custom-file-container__image-preview" id = "adoption_picture_edit_preview"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-danger" id = "btnReset_edit">Reset</button>
                    <button type="button" id = "step_6_approve" class="btn btn-primary">Approve</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MODAL FOR DISAPPROVING STEP 6 -->
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
                        <textarea class = "form-control" id = "comment_step_6_d" name = "comment" placeholder = "Leave a comment here." required=""></textarea>
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
                'comment':$('#comment_step_6_d').val(),
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
                    swal("Error", res.result, "error");
                    show_error(res.comment, $('#comment_step_6_d'));
                }
            },
            error: function(res){
                swal("Reload", "Something went wrong. Reload your browser", "error");
            }
        });
    });
    
    $(document).on('click', '#step_6_approve', function () {
        swal({title: "Success", text: "Proof of Adoption Image", type: "success"},
            function(){ 
                $('#adoption_picture_form').submit();
            }
        );
    });
});//ready()
</script>
<!-- Bootstrap File Upload with preview -->
<script src = "<?= base_url() ?>assets/bootstrap-fileupload/js/file-upload-with-preview.js"></script>
<script>
    var upload = new FileUploadWithPreview('adoption_picture')
</script>
<!-- Bootstrap File Upload with preview -->
<script>
    document.getElementById("btnReset_edit").onclick = function () {
        reset_upload()
    };
    function reset_upload() {
        document.getElementById("adoption_picture_edit").value = "";
    }
</script>
<?php endif;?>