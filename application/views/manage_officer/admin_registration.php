<!--======================
ADMIN REGISTRATION
=======================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>ManageOfficer">Manage Officer</a>
            </li>
            <li class="breadcrumb-item active">Admin Registration</li>
        </ol>
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-user-md"></i> Admin Registration
            </div>
            <div class="card-body">
                <div class = "row">
                    <div class = "col-md-2"></div>
                    <div class = "col-md-8">
                        <form method="POST" action="<?= $this->config->base_url() ?>ManageOfficer/admin_register_exec">
                            <div class = "card">
                                <div class = "card-body">
                                    <div class="form-row">
                                        <div class="col">
                                            <input class="form-control <?= !empty(form_error("fname")) ? "is-invalid" : ""; ?>" type="text" autofocus name="fname" placeholder="Firstname" value = "<?= set_value("fname") ?>">
                                            <div class="invalid-feedback"><?= form_error('fname') ?></div>
                                            <br>
                                        </div>
                                        <div class="col">
                                            <input class="form-control <?= !empty(form_error("lname")) ? "is-invalid" : ""; ?>" type="text" name="lname" placeholder="Lastname" value = "<?= set_value("lname") ?>">
                                            <div class="invalid-feedback"><?= form_error('lname') ?></div>
                                        </div>
                                    </div>
                                    <div class="form-row"> 
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="gender" value="Male" checked>
                                                Male
                                            </label>
                                            <br>
                                        </div>
                                        <div class="col"></div>
                                        <div class="col">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="gender" value="Female" >
                                                Female
                                            </label>
                                            <br>
                                        </div>
                                        <div class="col">
                                        </div>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" name="bday" readonly="" class="form_datetime form-control <?= !empty(form_error("bday")) ? "is-invalid" : ""; ?>"  value = "<?= set_value("bday") ?>" placeholder="Birthday">
                                            <div class="invalid-feedback"><?= form_error('bday') ?></div>
                                        </div>
                                        <br>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="col">
                                            <input class="form-control <?= !empty(form_error("username")) ? "is-invalid" : ""; ?>" type="text" value = "<?= set_value("username") ?>" name="username"  placeholder="Username" autofocus>
                                            <div class="invalid-feedback"><?= form_error('username') ?></div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <input class="form-control <?= !empty(form_error("password")) ? "is-invalid" : ""; ?>" type="password" name="password" placeholder="Password">
                                            <div class="invalid-feedback"><?= form_error('password') ?></div>
                                        </div>
                                        <div class="col">
                                            <input class="form-control <?= !empty(form_error("conpassword")) ? "is-invalid" : ""; ?>" type="password" name="conpassword" placeholder="Confirm Password">
                                            <div class="invalid-feedback"><?= form_error('conpassword') ?></div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <input class="form-control <?= !empty(form_error("email")) ? "is-invalid" : ""; ?>" type="email" name="email" value = "<?= set_value("email") ?>" placeholder="Email Address">
                                            <div class="invalid-feedback"><?= form_error('email') ?></div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <input class="form-control <?= !empty(form_error("phone")) ? "is-invalid" : ""; ?>" type="text" name="phone" value = "<?= set_value("phone") ?>" placeholder="Mobile Phone">
                                            <div class="invalid-feedback"><?= form_error('phone') ?></div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class = "col">
                                            <input type="text" id = "geocomplete" name = "address" class="form-control <?= !empty(form_error("address")) ? "is-invalid" : ""; ?>" value = "<?= set_value("address") ?>" placeholder="Address" aria-label="Address" value = "" >
                                            <div class="invalid-feedback"><?= form_error('address') ?></div>
                                        </div>
                                    </div>
                                    <div class ="form-row mb-3">
                                        <div class ="col-lg-12 text-center" style = "height:400px;">
                                            <div id = "google-map" style="height:100%; min-height:250px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "card-footer">
                                    <div class="row">
                                        <div class = "col text-center">
                                            <button type ="reset" class = "btn btn-outline-secondary">Reset</button>&emsp;
                                            <button type ="submit" class = "btn btn-outline-primary">Register as Admin</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class = "col-md-2"></div>
                </div>
            </div>
        </div>
    </div>