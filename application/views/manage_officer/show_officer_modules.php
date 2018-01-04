<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Modules
    </div>
    <div class="card-body">
<?php if (empty($module_access)): ?>
        <center>
            <h4>No modules yet</h4>
            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
        </center>
    </div>
</div>
<?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Module</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($module_access as $officer_module): ?>
                        <tr>
                            <td><span class = "text-success">Allowed</span></td>
                            <td><?= $officer_module->module_title ?></td>
                            <td><?= $officer_module->module_desc?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>
