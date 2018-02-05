<?php if(!empty($this->session->flashdata("uploading_error"))):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("uploading_error");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>
<?php if(!empty($this->session->flashdata("adoption_form_fail"))):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("adoption_form_fail");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>
<?php if(!empty($this->session->flashdata("adoption_form_success"))):?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("adoption_form_success");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>
<?php if(!empty($this->session->flashdata("approve_adoption_form_fail"))):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("approve_adoption_form_fail");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>
<?php if(!empty($this->session->flashdata("approve_adoption_form_success"))):?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("approve_adoption_form_success");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>

<?php if(!empty($this->session->flashdata("approve_step_2_fail"))):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("approve_step_2_fail");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>
<?php if(!empty($this->session->flashdata("approve_step_2_success"))):?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("approve_step_2_success");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>
<?php if(!empty($this->session->flashdata("approve_failed"))):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("approve_failed");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>
<?php if(!empty($this->session->flashdata("approve_success"))):?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-check"></i></strong> <?= $this->session->flashdata("approve_success");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>