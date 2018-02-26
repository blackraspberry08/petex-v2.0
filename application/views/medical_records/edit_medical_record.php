<!--===========================
EDIT MEDICAL RECORD
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
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>PetManagement/medical_records_exec/<?= $animal->pet_id ?>"><?= "Medical Records of " . $animal->pet_name ?></a>
            </li>
            <li class="breadcrumb-item active">Edit Medical Record</li>
        </ol>
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-stethoscope"></i> Edit Medical Record
            </div>
            <div class="card-body">
                <div class = "row">
                    <div class = "col-lg-2 col-sm-12"></div>
                    <div class = "col-lg-8 col-sm-12">
                        <form method = "POST" action = "<?= base_url() ?>PetManagement/edit_medical_record_submit/<?= $record->medicalRecord_id ?>">   
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="medicalRecord_date">Date</label>
                                    <input type="text" name="medicalRecord_date" value = "<?= set_value("medicalRecord_date", date("F d, Y", $record->medicalRecord_date)); ?>" class="form_datetime form-control" placeholder="Date" readonly>
                                </div>
                                <div class="form-group col-md-6 <?php if (!empty(form_error("medicalRecord_weight"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                    <label for="medicalRecord_weight" class=form-control-label">Weight <small>(kg)</small></label>
                                    <input type="text" name = "medicalRecord_weight" value = "<?= set_value("medicalRecord_weight", $record->medicalRecord_weight); ?>" class="form-control <?php if (!empty(form_error("medicalRecord_weight"))): ?>is-invalid<?php else: ?><?php endif; ?>" id="medicalRecord_weight" placeholder="Weight">
                                    <div class="invalid-feedback"><?= form_error('medicalRecord_weight') ?></div>
                                </div>
                            </div>
                            <div class = "form-group">
                                <label for="medicalRecord_diagnosis">Diagnosis</label>
                                <textarea class="form-control" id="medicalRecord_diagnosis" rows="3" name = "medicalRecord_diagnosis"><?= set_value("medicalRecord_diagnosis", $record->medicalRecord_diagnosis); ?></textarea>
                            </div>
                            <div class = "form-group">
                                <label for="medicalRecord_treatment">Treatment</label>
                                <textarea class="form-control" id="medicalRecord_treatment" rows="3" name = "medicalRecord_treatment"><?= set_value("medicalRecord_treatment", $record->medicalRecord_treatment); ?></textarea>
                            </div>
                            <div class = "pull-right">
                                <a href = "<?= base_url() ?>PetManagement/medical_records_exec/<?= $animal->pet_id ?>" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary ">Save Medical Record</button>
                            </div>
                        </form>
                    </div>
                    <div class = "col-lg-2" col-sm-12></div>
                </div>
            </div>
        </div>
    </div>