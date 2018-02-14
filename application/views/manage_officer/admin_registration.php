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
                    <div class = "col-md-3"></div>
                    <div class = "col-md-6">
                        <form method="POST" action="<?= $this->config->base_url() ?>ManageOfficer/admin_register_exec">
                            <div class = "card">
                                <div class = "card-body">
                                    <div class="form-row">
                                        <div class="col">
                                            <input class="form-control" type="text" name="fname" placeholder="Firstname">
                                            <br>
                                        </div>
                                        <div class="col">
                                            <input class="form-control" type="text" name="lname" placeholder="Lastname">
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
                                            <input type="text" name="bday" class="form_datetime form-control" placeholder="Birthday">
                                        </div>
                                        <br>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="col">
                                            <input class="form-control" type="text" name="username" autofocus placeholder="Username" autofocus>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <input class="form-control" type="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="col">
                                            <input class="form-control" type="password" name="conpassword" placeholder="Confirm Password">
                                            <br>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <input class="form-control" type="email" name="email" placeholder="Email Address">
                                            <br>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <input class="form-control" type="text" name="phone" placeholder="Mobile Phone">
                                            <br>
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
                    <div class = "col-md-3"></div>
                </div>
            </div>
        </div>
    </div>