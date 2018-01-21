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
function determine_access($access){
    switch ($access){
        case "Admin":{
            return "Administrator";
        }
        case "Subadmin":{
            return "PAWS Officer";
        }
        case "User":{
            return "Pet Adopter";
        }
        default:{
            return "";
        }
    }
}
?>
<style>
    .image-fit{
        padding:5px;
        object-fit: contain;
    }
    .image-fit img{
        width:55px;
        height:55px;
    }
</style>
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-paw"></i> Manage Progress
    </div>
    <div class="card-body">
        <div class="steps-form">
            <div class="steps-row setup-panel">
            <?php foreach ($progresses as $progress): ?>
                    <div class="steps-step" data-toggle = "tooltip" data-placement = "bottom" title = "<?= $progress->checklist_title ?>">
                        <a id = "step_id_<?= $progress->checklist_id ?>"  href="#step_<?= $progress->checklist_id ?>" class="btn btn-default btn-circle" style="height:45px; width:45px; color:white;"><i class="<?= getIcon($progress->checklist_id) ?> fa-1x"></i><br><?= $progress->checklist_id ?></a>
                    </div>
            <?php endforeach; ?>
            </div>
        </div>

        <!-- Adoption Form  --> 
        <div class="row setup-content" id="step_1">
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
                        <div class="embed-responsive embed-responsive-16by9 my-5 rounded">
                            <iframe class="embed-responsive-item" src="<?= base_url() . $adoption_form->adoption_form_location ?>" allowfullscreen type="application/pdf"></iframe>
                        </div>
                        <?php if(!empty($comments_step_1)):?>
                        <!-- There are recent comments -->
                        <div class="card mb-3">
                            <div class ="card-header">
                                <i class = "fa fa-comment" ></i> Comments
                            </div>
                            <?php foreach ($comments_step_1 as $comment):?>
                            <div class="card-body small bg-faded">    
                                <div class="media">
                                    <div class = "image-fit">
                                        <img class="d-flex mr-3" src="<?= base_url().$comment->progress_comment_picture?>" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1"><?= $comment->progress_comment_sender?></h6>
                                        <span class = "text-muted"><strong><?= determine_access($comment->progress_comment_sender_access)?></strong></span>&emsp;|&emsp;<span class = "text-muted"><?= date('F d, Y \a\t h:m A',$comment->progress_comment_added_at)?></span><br>
                                        <div class = "my-2">
                                            <?= $comment->progress_comment_content?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <div class="card-footer small text-muted">
                                <form action = "<?= base_url()?>ManageProgress/step_1/<?= $transaction->transaction_id?>" method = "POST">
                                    <div class="input-group">
                                        <button type ="submit" name = "disapprove" value = "disapprove" class = "input-group-addon btn btn-danger" style = "border-top-right-radius:0;border-bottom-right-radius:0; width:65px;" data-toggle = "tooltip" data-placement = "bottom" title = "Disapprove"><i class = "fa fa-thumbs-o-down"></i></button>
                                        <textarea class="form-control" name = "comment" placeholder = "Comment" required></textarea>     
                                        <button type ="submit" name = "approve" value = "approve" class = "input-group-addon btn btn-primary" style = "border-top-left-radius:0;border-bottom-left-radius:0; width:65px;" data-toggle = "tooltip" data-placement = "bottom" title = "Approve"><i class = "fa fa-thumbs-o-up"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /Comment-->
                        <?php else:?>
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
                            <div class="card-footer small text-muted">
                                <form action = "<?= base_url()?>ManageProgress/step_1/<?= $transaction->transaction_id?>" method = "POST">
                                    <div class="input-group">
                                        <button type ="submit" name = "disapprove" value = "disapprove" class = "input-group-addon btn btn-danger" style = "border-top-right-radius:0;border-bottom-right-radius:0; width:65px;" data-toggle = "tooltip" data-placement = "bottom" title = "Disapprove"><i class = "fa fa-thumbs-o-down"></i></button>
                                        <textarea class="form-control" name = "comment" placeholder = "Comment" required></textarea>     
                                        <button type ="submit" name = "approve" value = "approve" class = "input-group-addon btn btn-primary" style = "border-top-left-radius:0;border-bottom-left-radius:0; width:65px;" data-toggle = "tooltip" data-placement = "bottom" title = "Approve"><i class = "fa fa-thumbs-o-up"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /Comment-->
                        <?php endif;?>
                    <?php else: ?>
                        <!-- Adoption Form is approved -->
                        <h3 class = "mt-3 text-center">Adoption Form</h3>
                        <div class="embed-responsive embed-responsive-16by9 my-5 rounded">
                            <iframe class="embed-responsive-item" src="<?= base_url() . $adoption_form->adoption_form_location ?>" allowfullscreen type="application/pdf"></iframe>
                        </div>
                        <?php if(!empty($comments_step_1)):?>
                            <!-- If there are comments -->
                            <div class="card mb-3">
                                <div class ="card-header">
                                    <i class = "fa fa-comment" ></i> Comments
                                </div>
                                
                                <?php foreach ($comments_step_1 as $comment):?>
                                <div class="card-body small bg-faded">    
                                    <div class="media">
                                        <div class = "image-fit">
                                            <img class="d-flex mr-3" src="<?= base_url().$comment->progress_comment_picture?>" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1"><?= $comment->progress_comment_sender?></h6>
                                            <span class = "text-muted"><strong><?= determine_access($comment->progress_comment_sender_access)?></strong></span>&emsp;|&emsp;<span class = "text-muted"><?= date('F d, Y \a\t h:m A',$comment->progress_comment_added_at)?></span><br>
                                            <div class = "my-2">
                                                <?= $comment->progress_comment_content?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
                                <hr class="my-0">
                                <div class ="card-header">
                                    <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender?></strong>
                                </div>
                            </div><!-- /Comment-->
                        <?php else:?>
                            <!-- If there are no comments -->
                        <?php endif;?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>   
        </div>

        <!--  Meet And Greet -->  
        <div class="row setup-content" id="step_2">

            <div class = "col-lg-12 pt-5">
                <form method = "POST" action = "<?= base_url() ?>ManageProgress/step_2/<?= $transaction->transaction_id ?>">
                    <label for ="comment">Comment:</label>
                    <textarea class = "form-control" rows = 3 name = "comment"></textarea>
                    <center>
                        <div class = "btn-group mt-2" role="group" aria-label="Actions">
                            <button type = "submit" name = "disapprove" class = "btn btn-outline-secondary" value = "disapprove" ><i class = "fa fa-thumbs-o-down"></i> Disapprove</button>
                            <button type = "submit" name = "approve" class = "btn btn-outline-primary" value = "approve"><i class = "fa fa-thumbs-o-up"></i> Approve</button>
                        </div>
                    </center>
                </form>
            </div>

        </div>

        <!--  Interview  --> 
        <div class="row setup-content" id="step_3">
            <form method = "POST" action = "<?= base_url() ?>ManageProgress/step_3/<?= $transaction->transaction_id ?>">
                <label for ="comment">Comment:</label>
                <textarea class = "form-control" rows = 3 name = "comment"></textarea>
                <center>
                    <div class = "btn-group mt-2" role="group" aria-label="Actions">
                        <button type = "submit" name = "disapprove" class = "btn btn-outline-secondary" value = "disapprove" ><i class = "fa fa-thumbs-o-down"></i> Disapprove</button>
                        <button type = "submit" name = "approve" class = "btn btn-outline-primary" value = "approve"><i class = "fa fa-thumbs-o-up"></i> Approve</button>
                    </div>
                </center>
            </form>
        </div>

        <!--  Home Visit --> 
        <div class="row setup-content" id="step_4">
            <form method = "POST" action = "<?= base_url() ?>ManageProgress/step_4/<?= $transaction->transaction_id ?>">
                <label for ="comment">Comment:</label>
                <textarea class = "form-control" rows = 3 name = "comment"></textarea>
                <center>
                    <div class = "btn-group mt-2" role="group" aria-label="Actions">
                        <button type = "submit" name = "disapprove" class = "btn btn-outline-secondary" value = "disapprove" ><i class = "fa fa-thumbs-o-down"></i> Disapprove</button>
                        <button type = "submit" name = "approve" class = "btn btn-outline-primary" value = "approve"><i class = "fa fa-thumbs-o-up"></i> Approve</button>
                    </div>
                </center>
            </form>
        </div>

        <!--  Visit chosen adoptee -->  
        <div class="row setup-content" id="step_5">
            <form method = "POST" action = "<?= base_url() ?>ManageProgress/step_5/<?= $transaction->transaction_id ?>">
                <label for ="comment">Comment:</label>
                <textarea class = "form-control" rows = 3 name = "comment"></textarea>
                <center>
                    <div class = "btn-group mt-2" role="group" aria-label="Actions">
                        <button type = "submit" name = "disapprove" class = "btn btn-outline-secondary" value = "disapprove" ><i class = "fa fa-thumbs-o-down"></i> Disapprove</button>
                        <button type = "submit" name = "approve" class = "btn btn-outline-primary" value = "approve"><i class = "fa fa-thumbs-o-up"></i> Approve</button>
                    </div>
                </center>
            </form>
        </div>

        <!-- Release day -->
        <div class="row setup-content" id="step_6">

        </div>
    </div>
</div>

<!-- Bootstrap File Upload with preview -->
<script src = "https://unpkg.com/file-upload-with-preview"></script>
<script>
    var upload = new FileUploadWithPreview('adoption_form');
</script>

<!-- Textbox autoresize -->

<script src = "<?= base_url()?>assets/autosize-master/js/autosize.js"></script>
<script>
    // from a jQuery collection
    autosize($('textarea'));
</script>