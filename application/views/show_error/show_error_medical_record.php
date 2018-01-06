<?php if (!empty($this->session->flashdata("add_medical_record_fail"))): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("add_medical_record_fail"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty($this->session->flashdata("add_medical_record_success"))): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("add_medical_record_success"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty(form_error('medicalRecord_date'))): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?php echo form_error('medicalRecord_date', '<span>', '</span>'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty(form_error('medicalRecord_weight'))): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= form_error('medicalRecord_weight', '<span>', '</span>'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty($this->session->flashdata("remove_medical_record_fail"))): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("remove_medical_record_fail"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty($this->session->flashdata("remove_medical_record_success"))): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("remove_medical_record_success"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty($this->session->flashdata("edit_medical_record_fail"))): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("edit_medical_record_fail"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty($this->session->flashdata("edit_medical_record_success"))): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("edit_medical_record_success"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>