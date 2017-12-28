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
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                        <tr>
                            <td><?= $trail->user_firstname . " " . $trail->user_lastname ?></td>
                            <td><?= $trail->event_description ?></td>
                            <td><?= $trail->user_access ?></td>
                            <td><?= date('F d, Y \a\t h:m A', $trail->event_added_at); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Last updated on <?= date('F d, Y \a\t h:m A', $last_update[0]->event_added_at)?></div>
</div>
<?php endif; ?>
