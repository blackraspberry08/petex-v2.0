
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6" style="margin-top:100px;">
            <form method="POST" action="<?= base_url() ?>reset/enter_newPass_submit/<?= $username ?>">
                <div class="card wow fadeInRight">
                    <div class="card-header">
                        <br>
                        <h4> <i class="fa fa-lock fa-lg"></i> Enter New Password</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <input class="form-control <?= !empty(form_error("password")) ? "is-invalid" : ""; ?>" type="password" name="password" placeholder="Password" autofocus value = "<?= set_value("password") ?>"> 
                                <div class="invalid-feedback"><?= form_error('password') ?></div>
                                <br>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="form-control <?= !empty(form_error("conpass")) ? "is-invalid" : ""; ?>" type="password" name="conpass" placeholder="Confirm Password" value = "<?= set_value("conpass") ?>">
                                <div class="invalid-feedback"><?= form_error('conpass') ?></div>
                            </div>
                        </div> 

                    </div> 
                    <div class="card-footer ">
                        <button class="btn btn-success pull-right">
                            <i class="fa fa-send fa-lg"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-3">
        </div>
    </div>
</div>