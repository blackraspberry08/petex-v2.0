<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Activities
    </div>
    <div class="card-body">
<?php if (empty($activities)): ?>
        <center>
            <h4>No activities yet</h4>
            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
        </center>
    </div>
</div>
<?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered datatable-class" id = "" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Activity</th>
                        <th>Access</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activities as $activity): ?>
                        <tr>
                            <td><?= $activity->user_firstname . " " . $activity->user_lastname ?></td>
                            <td><?= $activity->event_description ?></td>
                            <td>Pet Adopter</td>
                            <td><?= date('F d, Y \a\t h:m A', $activity->event_added_at); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>
