<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Transactions
    </div>
    <div class="card-body">
        <?php if (empty($transactions)): ?>
            <center>
                <h4>No transaction yet</h4>
                <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
            </center>
        </div>
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pet Name</th>
                    <th>Status</th>
                    <th>Started at</th>
                    <th>Finished at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?= $transaction->transaction_id;?></td>
                        <td><?= $transaction->pet_name;?></td>
                        <td><?= $transaction->transaction_isFinished == 1? "Done":"In Progress";?></td>
                        <td><?= date("F d, Y - h:m A", $transaction->transaction_started_at)?></td>
                        <td><?= $transaction->transaction_isFinished == 1? date("F d, Y - h:m A", $transaction->transaction_finished_at): "In Progress";?></td>
                        <td>
                            <center><a href = "#" class = "btn btn-outline-primary" data-toggle="modal" data-target="#show_transaction_info_<?= $transaction->transaction_id?>">Show Information</a></center>
                        </td>
                    </tr>
                    <?php 
                        /*
                         * I am truly sorry that I didn't
                         * follow MVC framework. I just can't
                         * find any other work arounds.
                         */
                         $transaction_info = $this->ManageUsers_model->get_transaction_info(array('progress.transaction_id' => $transaction->transaction_id));
                         ?>
                    <div class="modal fade" id="show_transaction_info_<?= $transaction->transaction_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Transaction ID : <?= $transaction->transaction_id?></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="page-header">
                                            <center><h4 id="timeline" style = "color: #2dc997;">Progress</h4></center>
                                        </div>
                                        <ul class="timeline">
                                            <?php foreach($transaction_info as $info):?>
                                                <?php if($info->progress_isSuccessful == 1):?>
                                                <li>
                                                    <div class="timeline-badge success"><i class="fa fa-check"></i></div>
                                                    <div class="timeline-panel">
                                                        <div class="timeline-heading">
                                                            <h4 class="timeline-title"><?=$info->checklist_title;?></h4>
                                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> Accomplished on <?= date('F d, Y \a\t h:m A', $info->progress_accomplished_at);?></small></p>
                                                        </div>
                                                        <div class="timeline-body">
                                                            <p><?=$info->progress_comment == ""? "No comments" : $info->progress_comment;?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php else:?>
                                                <li class = "timeline-inverted">
                                                    <div class="timeline-badge primary"><i class="fa fa-spinner"></i></div>
                                                    <div class="timeline-panel">
                                                        <div class="timeline-heading">
                                                            <h4 class="timeline-title"><?=$info->checklist_title;?></h4>
                                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> Not accomplished yet.</small></p>
                                                        </div>
                                                        <div class="timeline-body">
                                                            <p><?=$info->progress_comment == ""? "No comments" : $info->progress_comment;?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </ul>
                                        <div class="page-header">
                                            <center><h4 class = "text-danger">End</h4></center>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal" style = "cursor: pointer;">Cancel</button>
                                    <a class="btn btn-primary" href ="#" >Agree</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>
    </div>
<?php endif; ?>

