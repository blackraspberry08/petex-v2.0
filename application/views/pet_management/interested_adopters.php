<!--===========================
INTERESTED ADOPTERS
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>PetManagement">Pet Management</a>
            </li>
            <li class="breadcrumb-item active">Interested Adopters</li>
        </ol>
        <?php include_once (APPPATH."views/show_error/show_error.php");?>
        <?php if (empty($active_transactions)): ?>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-heart"></i> Interested Adopters
            </div>
            <div class="card-body">
                <center>
                    <h4>No adopters yet</h4>
                    <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                </center>
            </div>
        </div>
        <?php else: ?>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Interested Adopters
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Adopters</th>
                                <th>Progress</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($active_transactions as $transaction): ?>
                                <tr>
                                    <td><?= $transaction->user_firstname . " " . $transaction->user_lastname ?></td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: <?= $transaction->transaction_progress?>%" aria-valuenow="<?= $transaction->transaction_progress?>" aria-valuemin="0" aria-valuemax="100"><?= $transaction->transaction_progress?>%</div>
                                        </div>
                                    </td>
                                    <td>
                                        <center>
                                            <div class = "btn-group" role = "group" aria-label="buttonGroup">
                                                <a href = "#" data-toggle = "tooltip" data-position = "bottom" class = "btn btn-outline-primary">Manage Progress</a>
                                                <a href = "#" data-toggle = "tooltip" data-position = "bottom" class = "btn btn-outline-danger">Drop </a>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <br>
        <?php if (empty($not_active_transactions)): ?>
        <!-- Nothing to display -->
        <?php else: ?>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-trash"></i> Dropped Transactions
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Adopters</th>
                                <th>Progress</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($not_active_transactions as $not_active_transaction): ?>
                                <tr>
                                    <td><?= $not_active_transaction->user_firstname . " " . $not_active_transaction->user_lastname ?></td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-secondary progress-bar-animated" role="progressbar" style="width: <?= $not_active_transaction->transaction_progress?>%" aria-valuenow="<?= $not_active_transaction->transaction_progress?>" aria-valuemin="0" aria-valuemax="100"><?= $not_active_transaction->transaction_progress?>%</div>
                                        </div>
                                    </td>
                                    <td>
                                        <center>
                                            <div class = "btn-group" role = "group" aria-label="buttonGroup">
                                                <a href = "#" data-toggle = "modal" data-target = "#restore_transaction_<?= $not_active_transaction->transaction_id?>" class = "btn btn-outline-primary">Restore</a>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                <div class="modal fade" id="restore_transaction_<?= $not_active_transaction->transaction_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Restore Transaction</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Restore this adopter's transaction to <?= $animal->pet_name?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal" style = "cursor: pointer;">Cancel</button>
                                                <a class="btn btn-danger" href="<?= base_url()."PetManagement/restore_transaction_exec/".$not_active_transaction->transaction_id."/".$not_active_transaction->user_id;?>">Remove</a>
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
    </div>