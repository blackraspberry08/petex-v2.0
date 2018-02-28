<?php if (empty($logs)): ?>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> User Logs
        </div>
        <div class="card-body">
            <center>
                <h4>No user logs yet</h4>
                <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
            </center>
        </div>
    </div>
<?php else: ?>
    <!-- Example DataTables Card-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> User Logs
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Activity</th>
                            <th>Access</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log): ?>
                        <?php if($log->user_id != ""):?>
                            <tr>
                                <td><?= $log->user_firstname . " " . $log->user_lastname ?></td>
                                <td><?= $log->event_description ?></td>
                                <td>Pet Adopter</td>
                                <td>
                                    <span style = "display:none;"><?= $log->event_added_at?></span>
                                    <?= date("F d, Y - h:m A", $log->event_added_at) ?>
                                </td>
                            </tr>
                        <?php else:?>
                            <tr>
                                <td><?= $log->admin_firstname . " " . $log->admin_lastname ?></td>
                                <td><?= $log->event_description ?></td>
                                <td><?= $log->admin_access == "Subadmin"? "PAWS Officer" : "Administrator"; ?></td>
                                <td>
                                    <span style = "display:none;"><?= $log->event_added_at?></span>
                                    <?= date("F d, Y - h:m A", $log->event_added_at) ?>
                                </td>
                            </tr>
                        <?php endif;?>
                            
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>
