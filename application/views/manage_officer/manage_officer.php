<?php if(!empty($this->session->flashdata("activation_success"))):?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("activation_success");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>
<?php if(!empty($this->session->flashdata("activation_fail"))):?>
    <div class="alert alert-alert alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-times"></i></strong> <?= $this->session->flashdata("activation_fail");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif;?>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Manage Officers
            </div>
            <div class="card-body">
                <?php if (empty($admins)): ?>
                <center>
                    <h4>No officers yet</h4>
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
                        <th>Status</th>
                        <th>Added at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?= $admin->admin_firstname . " " . $admin->admin_lastname ?></td>
                            <td><?= $admin->admin_status == 1? "Active" : "Inactive" ; ?></td>
                            <td><?= date('F d, Y \a\t h:m A', $admin->admin_added_at); ?></td>
                            <td>
                                <center>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href = "<?= base_url()?>ManageOfficer/show_officer_info_exec/<?= $admin->admin_id?>" class = "btn btn-outline-primary">Show Information</a>
                                        <a href = "<?= base_url()?>ManageOfficer/manage_module_exec/<?= $admin->admin_id?>" class = "btn btn-outline-primary">Modules</a>
                                        <a href = "#" class = "btn btn-outline-primary" style = "width:100px;" data-toggle="modal" data-target="#activate_officer_<?= $admin->admin_id?>">
                                            <?= $admin->admin_status == 0 ? "Activate" : "Deactivate";?>
                                        </a>
                                    </div>
                                </center>
                            </td>
                        </tr>
                        <div class="modal fade" id="activate_officer_<?= $admin->admin_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $admin->admin_status == 0 ? "Activate" : "Deactivate";?> Officer</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if($admin->admin_status == 0):?>
                                            Once you activate this officer's account, <?= $admin->admin_sex == "Male"? "he" : "she";?> will be able to log into the system.
                                        <?php else:?>
                                            Once you deactivate this officer's account, <?= $admin->admin_sex == "Male"? "he" : "she";?> will no longer be able to log into the system.
                                        <?php endif;?>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal" style = "cursor: pointer;">Cancel</button>
                                        <?php if($admin->admin_status == 0):?>
                                        <a class="btn btn-primary" href="<?= base_url()?>ManageOfficer/activate_officer_exec/<?= $admin->admin_id?>">Activate</a>
                                        <?php else:?>
                                        <a class="btn btn-primary" href="<?= base_url()?>ManageOfficer/deactivate_officer_exec/<?= $admin->admin_id?>">Deactivate</a>
                                        <?php endif;?>
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
