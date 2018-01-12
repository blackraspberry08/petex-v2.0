<!--===========================
Profile
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>UserDashboard">Dashboard</a>
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
                        <img src="<?= $userDetails->user_picture ?>" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-2">
                        <br>
                        <center>
                            <a class="btn btn-outline-info"><i class="fa fa-pencil"></i> Edit Profile</a>
                        </center>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="fa fa-user"></i> Personal Information</h5>
                        <hr class="my-3">
                    </div>
                    <div class="col-md-2">
                        <h5>Name:</h5>
                        <h5>Gender:</h5>
                        <h5>Birthday:</h5>
                        <h5>Age:</h5>
                        <h5>Address:</h5>
                    </div>

                    <div class = "col-md-8" id = "user_info">
                        <h5><?= $userDetails->user_firstname ?> <?= $userDetails->user_lastname ?></h5>
                        <h5><?= $userDetails->user_sex ?></h5>
                        <h5><?= date("F d, Y", $userDetails->user_bday); ?></h5>
                        <h5><?= get_age($userDetails->user_bday); ?></h5>
                        <h5><?= $userDetails->user_address ?> <?= $userDetails->user_brgy ?> <?= $userDetails->user_city ?></h5>
                    </div>
                </div><br><br>
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="fa fa-info"></i> Login Information</h5>
                        <hr class="my-3">
                    </div>
                    <div class="col-md-2">
                        <h5>Username:</h5>
                        <h5>Password:</h5>
                    </div>
                    <div class = "col-md-8" id = "user_info">
                        <h5><?= $userDetails->user_username ?></h5>
                        <h5>********</h5> 
                    </div>
                </div><br><br>
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="fa fa-address-book"></i> Contact Information</h5>
                        <hr class="my-3">
                    </div>
                    <div class="col-md-2">
                        <h5>Phone Number:</h5>
                        <h5>Email Address:</h5>
                    </div>
                    <div class = "col-md-8" id = "user_info">
                        <h5><?= $userDetails->user_contact_no ?></h5>
                        <h5><?= $userDetails->user_email ?></h5> 
                    </div>
                </div>
            </div>
        </div><br>
    </div>
</div>
</div>
