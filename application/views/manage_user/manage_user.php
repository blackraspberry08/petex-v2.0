<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Manage User
    </div>
    <div class="card-body">
<?php if (empty($users)): ?>
        <center>
            <h4>No users yet</h4>
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
                        <th>Access</th>
                        <th>Added at</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user->user_firstname . " " . $user->user_lastname ?></td>
                            <td><?= $user->user_access ?></td>
                            <td><?= date('F d, Y \a\t h:m A', $user->user_added_at); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Last updated on <?= date('F d, Y \a\t h:m A', $user_last_update[0]->user_added_at)?></div>
</div>
<?php endif; ?>
