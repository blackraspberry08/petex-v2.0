<!--===========================
Edit Profile
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>UserDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>Profile">Profile</a>
            </li>
            <li class="breadcrumb-item active">Edit Profile</li>
        </ol>
        <!-- Registered -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-pencil"></i> Edit Profile

            </div>
            <div class="card-body container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <img src="<?= base_url() . $userDetails->user_picture ?>" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-md-8">
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
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="user_firstname">Firstname: </label>
                                            <input type="text" name="user_firstname" value = "<?= set_value("user_firstname", $userDetails->user_firstname); ?>"  class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="user_lastname">Lastname: </label>
                                            <input type="text" name="user_lastname" value = "<?= set_value("user_lastname", $userDetails->user_lastname); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div> 
                            </h5>
                            <h5>
                                <div class="col-sm-6 pull-left">
                                    <br><br>
                                    Gender:
                                </div>
                                <div class="col-sm-6 pull-right" id="user_info">
                                    <div class="form-check">
                                        <label class="form-check-label col-md-3" style="margin-left:-30px;">
                                            <input name="user_sex" type="radio" id="user_sex" class = "form-check-label" value ="Male" <?= $userDetails->user_sex == "Male" ? "checked = \"\"" : "" ?>/>
                                            Male
                                        </label>
                                        <label class="form-check-label col-md-4" style="margin-left:-30px;">
                                            <input name="user_sex" type="radio" id="user_sex" class = "form-check-label" value ="Female" <?= $userDetails->user_sex == "Female" ? "checked = \"\"" : "" ?>/>
                                            Female
                                        </label>

                                    </div>
                                </div>
                            </h5>
                            <h5>
                                <div class="col-sm-6 pull-left" >
                                    <br>
                                    Birthday:
                                </div>
                                <div class="col-sm-6 pull-right" id="user_info" >
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" name="user_bday" class="form_datetime form-control" value="<?= set_value("user_bday", date("F d, Y", $userDetails->user_bday)); ?>" style="margin-top:10px;">
                                        </div>    
                                    </div>
                                </div>
                            </h5>
                            <h5>
                                <div class="col-sm-6 pull-left" >
                                    <br>
                                    Address:
                                </div>
                                <div class="col-sm-6 pull-right" id="user_info" >
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="user_address">Address: </label>
                                            <input type="text" name="user_address" value = "<?= set_value("user_address", $userDetails->user_address); ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="user_brgy">Barangay: </label>
                                            <input type="text" name="user_brgy" value = "<?= set_value("user_brgy", $userDetails->user_brgy); ?>" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="user_city">City: </label>
                                            <input type="text" name="user_city" value = "<?= set_value("user_city", $userDetails->user_city); ?>" class="form-control" >
                                        </div>
                                    </div>
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
                            <div class="col-sm-6 pull-left" >
                                <br>
                                Username:
                            </div>
                            <div class="col-sm-6 pull-right" id="user_info" >
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="user_username" class="form-control" value="<?= set_value("user_username", $userDetails->user_username); ?>" style="margin-top:10px;">
                                    </div>    
                                </div>
                            </div>
                        </h5>
                        <h5>
                            <div class="col-sm-6 pull-left">
                                <br><br>
                                Password:
                            </div>
                            <div class="col-sm-6 pull-right" id="user_info">
                                <div class="form-row">
                                    <div class="form-group col-md-6">

                                        <label for="user_password">Password: </label>
                                        <input type="password" name="user_password"   class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="user_conpassword">Confirm Password: </label>
                                        <input type="password" name="user_conpassword" class="form-control">
                                    </div>
                                </div>
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
                            <div class="col-sm-6 pull-left" >
                                <br>
                                Phone Number:
                            </div>
                            <div class="col-sm-6 pull-right" id="user_info" >
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="user_contact_no" class="form-control" value="<?= set_value("user_contact_no", $userDetails->user_contact_no); ?>" style="margin-top:10px;">
                                    </div>    
                                </div>
                            </div>
                        </h5>
                        <h5>
                            <div class="col-sm-6 pull-left" >
                                <br>
                                Email Address:
                            </div>
                            <div class="col-sm-6 pull-right" id="user_info" >
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <input type="email" name="user_email" class="form-control" value="<?= set_value("user_email", $userDetails->user_email); ?>" style="margin-top:10px;">
                                    </div>    
                                </div>
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
