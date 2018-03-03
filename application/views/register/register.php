
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px; margin-bottom: 50px;">
            <form method="POST" action="<?= $this->config->base_url() ?>register/register_exec"> 
                <div class="card wow fadeInRight">
                    <div class="card-header">
                        <h4> <i class="fa fa-user-plus fa-lg"></i> Register</h4>
                    </div>
                    <div class="card-body" style = "background:#eee;">
                        <div class="form-row mb-3">
                            <div class="col">
                                <input class="form-control <?= !empty(form_error("username")) ? "is-invalid" : ""; ?>" type="text" name="username" placeholder="Username" autofocus value = "<?= set_value("username") ?>">
                                <div class="invalid-feedback"><?= form_error('username') ?></div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <input class="form-control <?= !empty(form_error("password")) ? "is-invalid" : ""; ?>" type="password" name="password" placeholder="Password" >
                                <div class="invalid-feedback"><?= form_error('password') ?></div>
                            </div>
                            <div class="col">
                                <input class="form-control <?= !empty(form_error("conpassword")) ? "is-invalid" : ""; ?>" type="password" name="conpassword" placeholder="Confirm Password" >
                                <div class="invalid-feedback"><?= form_error('conpassword') ?></div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <input class="form-control <?= !empty(form_error("email")) ? "is-invalid" : ""; ?>" type="email" name="email" placeholder="Email Address" value = "<?= set_value("email") ?>">
                                <div class="invalid-feedback"><?= form_error('email') ?></div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <input class="form-control <?= !empty(form_error("phone")) ? "is-invalid" : ""; ?>" type="text" name="phone" placeholder="Mobile Phone" value = "<?= set_value("phone") ?>">
                                <div class="invalid-feedback"><?= form_error('phone') ?></div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <input class="form-control <?= !empty(form_error("lname")) ? "is-invalid" : ""; ?>" type="text" name="lname" placeholder="Lastname" value = "<?= set_value("lname") ?>">
                                <div class="invalid-feedback"><?= form_error('lname') ?></div>
                            </div>
                            <div class="col">
                                <input class="form-control <?= !empty(form_error("fname")) ? "is-invalid" : ""; ?>" type="text" name="fname" placeholder="Firstname" value = "<?= set_value("fname") ?>">
                                <div class="invalid-feedback"><?= form_error('fname') ?></div>
                            </div>
                        </div>
                        <div class="form-row mb-3"> 
                            <div class="col"></div>
                            <div class="col">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="gender" value="Male" checked>
                                    Male
                                </label>
                            </div>
                            <div class="col"></div>
                            <div class="col">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="gender" value="Female" >
                                    Female
                                </label>
                            </div>
                            <div class="col"></div>
                        </div><br>
                        <div class="form-row mb-3">
                            <div class="col">
                                <input type="text" name="bday" class="form_datetime form-control <?= !empty(form_error("bday")) ? "is-invalid" : ""; ?>" placeholder="Birthday" readonly="" value = "<?= set_value("bday") ?>">
                                <div class="invalid-feedback"><?= form_error('bday') ?></div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class = "col">
                                <input type="text" id = "geocomplete" name = "address" class="form-control <?= !empty(form_error("address")) ? "is-invalid" : ""; ?>" placeholder="Address" aria-label="Address" value = "<?= set_value("address") ?>" >
                                <div class="invalid-feedback"><?= form_error('address') ?></div>
                            </div>
                        </div>
                        <div class ="form-row mb-3">
                            <div class ="col-lg-12 text-center" style = "height:400px;">
                                <div id = "google-map" style="height:100%; min-height:250px;"></div>
                            </div>
                        </div>
                        <div class ="form-row mb-3 "><br>
                            <div class ="mx-auto">
                                <?= $widget ?>
                                <?= $script ?>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input <?= !empty(form_error("accept")) ? "is-invalid" : ""; ?>" style="margin-top:3px;" type="checkbox" name="accept" value="1">
                            <label class=" form-check-label">
                                I agree to the <a href="<?= base_url() ?>register/terms" style="color:blue;">Terms and Conditions.</a>
                            </label>
                        </div>
                    </div> 

                    <div class="card-footer ">
                        <button class="btn btn-success pull-right">
                            <i class="fa fa-send fa-lg"></i> Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-2"></div>
    </div>

</div>