<?php if (!empty($this->session->flashdata("restore_fail"))): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("restore_fail"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty($this->session->flashdata("restore_success"))): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("restore_success"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty($this->session->flashdata("drop_fail"))): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("drop_fail"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (!empty($this->session->flashdata("drop_success"))): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("drop_success"); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>