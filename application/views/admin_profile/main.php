<!--===========================
Profile
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
        <!-- Registered -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-user"></i> Profile

            </div>
            <div class="card-body container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <img src="<?= base_url() . $userDetails->admin_picture ?>" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-2">
                        <br>
                        <center>
                            <a class="btn btn-outline-info" href="<?= base_url() ?>AdminProfile/edit_profile"><i class="fa fa-pencil"></i> Edit Profile</a>
                        </center>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="fa fa-user"></i> Personal Information</h5>
                        <hr class="my-3">
                    </div>
                    <div class="row container">
                        <div class="col-md-12">
                            <h5>
                                <div class="col-sm-6 pull-left">
                                    Name:
                                </div>
                                <div class="col-sm-6 pull-right" id="user_info">
                                    <?= $userDetails->admin_firstname ?> <?= $userDetails->admin_lastname ?>
                                </div> 
                            </h5>
                            <h5>
                                <div class="col-sm-6 pull-left">
                                    Gender:
                                </div>
                                <div class="col-sm-6 pull-right" id="user_info">
                                    <?= $userDetails->admin_sex ?>
                                </div> 
                            </h5>
                            <h5>
                                <div class="col-sm-6 pull-left">
                                    Birthday:
                                </div>
                                <div class="col-sm-6 pull-right" id="user_info">
                                    <?= date("F d, Y", $userDetails->admin_bday); ?>
                                </div> 
                            </h5>
                            <h5>
                                <div class="col-sm-6 pull-left">
                                    Age:
                                </div>
                                <div class="col-sm-6 pull-right" id="user_info">
                                    <?= get_age($userDetails->admin_bday); ?>
                                </div> 
                            </h5>
                            <h5>
                                <div class="col-sm-6 pull-left">
                                    Address:
                                </div>
                                <div class="col-sm-6 pull-right" id="user_info">
                                    <?= $userDetails->admin_address ?> <?= $userDetails->admin_brgy ?> <?= $userDetails->admin_city ?>
                                </div> 
                            </h5>
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div class="row container">
                <div class="col-md-12">
                    <h5><i class="fa fa-info"></i> Login Information</h5>
                    <hr class="my-3">
                </div>
                <div class="row container">
                    <div class="col-md-12">
                        <h5>
                            <div class="col-sm-6 pull-left">
                                Username:
                            </div>
                            <div class="col-sm-6 pull-right" id="user_info">
                                <?= $userDetails->admin_username ?>
                            </div> 
                        </h5>
                        <h5>
                            <div class="col-sm-6 pull-left">
                                Password:
                            </div>
                            <div class="col-sm-6 pull-right" id="user_info">
                                ********
                            </div> 
                        </h5>
                    </div>
                </div>
            </div><br><br>
            <div class="row container">
                <div class="col-md-12">
                    <h5><i class="fa fa-address-book"></i> Contact Information</h5>
                    <hr class="my-3">
                </div>
                <div class="row container">
                    <div class="col-md-12">
                        <h5>
                            <div class="col-sm-6 pull-left">
                                Phone Number:
                            </div>
                            <div class="col-sm-6 pull-right" id="user_info">
                                <?= $userDetails->admin_contact_no ?>
                            </div> 
                        </h5>
                        <h5>
                            <div class="col-sm-6 pull-left">
                                Email Address:
                            </div>
                            <div class="col-sm-6 pull-right" id="user_info">
                                <?= $userDetails->admin_email ?>

                            </div> 
                        </h5>
                    </div>

                </div>
            </div>
            <br><br>
        </div>
    </div><br>
</div>
</div>
</div>
