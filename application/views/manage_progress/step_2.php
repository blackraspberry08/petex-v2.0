<?php
    $progress_2 = $this->ManageProgress_model->get_progress(array("progress.checklist_id" => 2, "progress.transaction_id" => $transaction->transaction_id))[0];
?>

<div class = "col-lg-12">
    <h3 class = "mt-3 text-center">Meet and Greet</h3>
    <p class = "text-muted">&emsp;<?= $progress_2->checklist_desc?></p>
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
                <div class="card-footer small text-muted">
                    <form action = "<?= base_url() ?>ManageProgress/step_2/<?= $transaction->transaction_id ?>" method = "POST">
                        <div class="input-group">
                            <button type ="submit" name = "disapprove" value = "disapprove" class = "input-group-addon btn btn-danger" style = "border-top-right-radius:0;border-bottom-right-radius:0; width:65px;" data-toggle = "tooltip" data-placement = "bottom" title = "Disapprove"><i class = "fa fa-thumbs-o-down"></i></button>
                            <textarea class="form-control" name = "comment" placeholder = "Comment" required></textarea>     
                            <button type ="submit" name = "approve" value = "approve" class = "input-group-addon btn btn-primary" style = "border-top-left-radius:0;border-bottom-left-radius:0; width:65px;" data-toggle = "tooltip" data-placement = "bottom" title = "Approve"><i class = "fa fa-thumbs-o-up"></i></button>
                        </div>
                    </form>
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
                <div class="card-footer small text-muted">
                    <form action = "<?= base_url() ?>ManageProgress/step_2/<?= $transaction->transaction_id ?>" method = "POST">
                        <div class="input-group">
                            <button type ="submit" name = "disapprove" value = "disapprove" class = "input-group-addon btn btn-danger" style = "border-top-right-radius:0;border-bottom-right-radius:0; width:65px;" data-toggle = "tooltip" data-placement = "bottom" title = "Disapprove"><i class = "fa fa-thumbs-o-down"></i></button>
                            <textarea class="form-control" name = "comment" placeholder = "Comment" required></textarea>     
                            <button type ="submit" name = "approve" value = "approve" class = "input-group-addon btn btn-primary" style = "border-top-left-radius:0;border-bottom-left-radius:0; width:65px;" data-toggle = "tooltip" data-placement = "bottom" title = "Approve"><i class = "fa fa-thumbs-o-up"></i></button>
                        </div>
                    </form>
                </div>
            <?php endif;?>
        </div><!-- /Comment-->
    <?php endif; ?>
</div>