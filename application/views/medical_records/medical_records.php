<!--===========================
MEDICAL RECORDS
============================-->

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>PetManagement">Pet Management</a>
            </li>
            <li class="breadcrumb-item active"><?= "Medical Records of ".$animal->pet_name?></li>
        </ol>
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <?php include_once (APPPATH . "views/show_error/show_error_medical_record.php"); ?>
        <div class = "row my-3">
            <div class ="col-lg-12">
                <a href = "#" class = "btn btn-outline-primary pull-right" data-toggle="modal" data-target="#add_medical_record"><i class = "fa fa-plus"></i> Add Medical Records</a>
                <br>
            </div>
        </div>
        
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Medical Records
            </div>
            <div class="card-body">
        <?php if (empty($animal_medical_records)): ?>
                    <center>
                        <h4>No medical records yet</h4>
                        <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                    </center>
                </div>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Weight <small>(kg)</small></th>
                            <th>Diagnosis</th>
                            <th>Treatment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($animal_medical_records as $record): ?>
                            <tr>
                                <td><?= date("F d, Y", $record->medicalRecord_date);?></td>
                                <td><?= $record->medicalRecord_weight?></td>
                                <td><?= $record->medicalRecord_diagnosis?></td>
                                <td><?= $record->medicalRecord_treatment?></td>
                                <td>
                                    <center>
                                        <div class = "btn-group" role = "group" aria-label="buttonGroup">
                                            <a href = "<?= base_url()?>PetManagement/edit_medical_record_exec/<?= $animal->pet_id?>/<?= $record->medicalRecord_id?>" class = "btn btn-outline-success" data-toggle = "tooltip" data-placement = "bottom" title = "Edit"><i class = "fa fa-pencil"></i></a>
                                            <a href = "#" class = "btn btn-outline-danger" data-toggle = "modal" data-target = "#remove_medical_record_<?= $record->medicalRecord_id?>" title = "Remove"><i class = "fa fa-trash"></i></a>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                            <div class="modal fade" id="remove_medical_record_<?= $record->medicalRecord_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Remove medical this medical record?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class = "row">
                                                <div class = "col-3 text-right py-2">
                                                    <strong>Date :</strong>
                                                </div>
                                                <div class = "col-9 text-left py-2">
                                                    <?= date("F d, Y", $record->medicalRecord_date)?>
                                                </div>
                                                <div class = "col-3 text-right py-2">
                                                    <strong>Weight :</strong>
                                                </div>
                                                <div class = "col-9 text-left py-2">
                                                    <?= $record->medicalRecord_weight?>
                                                </div>
                                                <div class = "col-3 text-right py-2">
                                                    <strong>Diagnosis :</strong>
                                                </div>
                                                <div class = "col-9 text-left py-2">
                                                    <?= $record->medicalRecord_diagnosis?>
                                                </div>
                                                <div class = "col-3 text-right py-2">
                                                    <strong>Treatment :</strong>
                                                </div>
                                                <div class = "col-9 text-left py-2">
                                                    <?= $record->medicalRecord_treatment?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal" style = "cursor: pointer;">Cancel</button>
                                            <a class="btn btn-danger" href="<?= base_url()."PetManagement/remove_medical_record_exec/".$record->medicalRecord_id;?>">Remove</a>
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
    <div class="modal fade" id="add_medical_record" tabindex="-1" role="dialog" aria-labelledby="add_medical_record" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method = "POST" action = "<?= base_url()?>PetManagement/add_medical_record_exec/<?= $animal->pet_id?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Medical Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="medicalRecord_date">Date</label>
                                <input type="text" name="medicalRecord_date" value = "<?= set_value("medicalRecord_date");?>" class="form_datetime form-control" placeholder="Date" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="medicalRecord_weight">Weight <small>(kg)</small></label>
                                <input type="text" name = "medicalRecord_weight" value = "<?= set_value("medicalRecord_weight");?>" class="form-control" id="medicalRecord_weight" placeholder="Weight">
                            </div>
                        </div>
                        <div class = "form-group">
                            <label for="medicalRecord_diagnosis">Diagnosis</label>
                            <textarea class="form-control" id="medicalRecord_diagnosis" rows="3" name = "medicalRecord_diagnosis"><?= set_value("medicalRecord_diagnosis");?></textarea>
                        </div>
                        <div class = "form-group">
                            <label for="medicalRecord_treatment">Treatment</label>
                            <textarea class="form-control" id="medicalRecord_treatment" rows="3" name = "medicalRecord_treatment"><?= set_value("medicalRecord_treatment");?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer " >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Medical Record</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>