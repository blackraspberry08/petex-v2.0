<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Audit Trail
    </div>
    <div class="card-body">
<?php if (empty($trails)): ?>
        <center>
            <h4>No audit trails yet</h4>
            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
        </center>
    </div>
</div>
<?php else: ?>
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
                    <?php foreach ($trails as $trail): ?>
                        <?php if($trail->user_id != ""):?>
                            <tr>
                                <td><?= $trail->user_firstname . " " . $trail->user_lastname ?></td>
                                <td><?= $trail->event_description ?></td>
                                <td>Pet Adopter</td>
                                <td><?= date('F d, Y \a\t h:m A', $trail->event_added_at); ?></td>
                            </tr>
                        <?php else:?>
                            <tr>
                                <td><?= $trail->admin_firstname . " " . $trail->admin_lastname ?></td>
                                <td><?= $trail->event_description ?></td>
                                <td><?= $trail->admin_access == "Subadmin"? "PAWS Officer" : "Administrator";?></td>
                                <td><?= date('F d, Y \a\t h:m A', $trail->event_added_at); ?></td>
                            </tr>
                        <?php endif;?>
                        
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php endif; ?>
