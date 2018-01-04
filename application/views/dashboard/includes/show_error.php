
<?php if(!empty($this->session->flashdata("err_5"))):?>
    <div class="err_msg alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class = "fa fa-exclamation"></i></strong> <?= $this->session->flashdata("err_5");?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>
