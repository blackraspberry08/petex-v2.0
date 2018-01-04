<!--======================
MANAGE OFFICER MODULES
=======================-->
<?php
    function allowed_modules($modules, $officer_modules){
        $module_id = array();
        $officer_module_id = array();
        for($i = 0; $i < sizeof($modules); $i++){
            array_push($module_id, $modules[$i]->module_id);
        }
        for($i = 0; $i < sizeof($officer_modules); $i++){
            array_push($officer_module_id, $officer_modules[$i]->module_id);
        }
        return array_intersect($module_id, $officer_module_id);
    }
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>ManageOfficer">Manage Officers</a>
            </li>
            <li class="breadcrumb-item active"><?= $officer->user_firstname . " " . $officer->user_lastname ?> Module Access</li>
        </ol>
        <?php if(!empty($this->session->flashdata("module_update"))):?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("module_update");?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif;?>
        <?php if(!empty($this->session->flashdata("module_removed"))):?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("module_removed");?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif;?>
        <div class="row">
            <div class="col-lg-12 py-3 ">
                <a href = "#" class = "btn btn-outline-primary pull-right" data-toggle="modal" data-target="#add_module"><i class = "fa fa-plus"></i> Add allowed modules</a>
            </div>
            <?php if (empty($officer_modules)): ?>
                <div class ="col-lg-12">
                    <center>
                        <h4>No modules for this officer yet</h4>
                        <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                    </center>
                </div>
            <?php else: ?>
                <!-- TABLE OF MODULES-->
                <div class ="col-lg-12">
                    <div class="table-responsive">
                        <table class="table border">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Modules</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($officer_modules as $officer_module): ?>
                                <tr>
                                    <td class = "text-success">Allowed</td>
                                    <td><?= $officer_module->module_title ?></td>
                                    <td><?= $officer_module->module_desc ?></td>
                                    <td><center><a href = "#" data-toggle="modal" data-target="#remove_module_<?= $officer_module->module_access_id?>" class = "btn btn-outline-danger">Remove Access</a></center></td>
                                </tr>
                                <div class="modal fade" id="remove_module_<?= $officer_module->module_access_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Remove Module</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Removing this module will revoke <?= $officer_module->user_firstname." ".$officer_module->user_lastname;?>'s access to this module.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a href ="<?= base_url()?>ManageOfficer/remove_module_exec/<?= $officer_module->module_access_id?>" class="btn btn-danger">Remove Module</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="modal fade" id="add_module" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method = "POST" action = "<?= base_url()?>ManageOfficer/add_modules_exec/<?= $officer->user_id?>">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Module</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class = "table border">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Module</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(empty($officer_module)){
                                       $officer_modules = array(); 
                                    }
                                    $allowed_modules = allowed_modules($modules, $officer_modules);
                                    foreach($modules as $module):
                                    ?>
                                    <tr>
                                        <?php if(in_array($module->module_id, $allowed_modules)):?>
                                        <td><input type="checkbox" class = "switch-style" name = "modules[]" value = "<?= $module->module_id;?>" checked></td>
                                        <?php else:?>
                                        <td><input type="checkbox" class = "switch-style" name = "modules[]" value = "<?= $module->module_id;?>"></td>
                                        <?php endif;?>
                                        <td><?= $module->module_title;?></td>
                                        <td><?= $module->module_desc;?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>