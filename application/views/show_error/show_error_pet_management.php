<?php if (!empty($this->session->flashdata("remove_animal_fail"))): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("remove_animal_fail"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty($this->session->flashdata("remove_animal_success"))): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("remove_animal_success"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (!empty($this->session->flashdata("uploading_error"))): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("uploading_error"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty($this->session->flashdata("registration_fail"))): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("registration_fail"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty($this->session->flashdata("registration_success"))): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("registration_success"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>