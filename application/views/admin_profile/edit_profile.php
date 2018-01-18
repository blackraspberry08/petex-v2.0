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
                <a href="<?= base_url() ?>AdminProfile">Profile</a>
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
                        <img src="<?= base_url() . $userDetails->admin_picture ?>" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-md-8"><br><br>
                        <a href = "#" class = "btn btn-outline-success" data-toggle="modal" data-target=".<?= $userDetails->admin_id; ?>changePic"  data-placement="bottom" title="Change Picture"><i class = "fa fa-pencil"></i> Change Picture</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="fa fa-user"></i> Personal Information</h5>
                        <hr class="my-3">
                    </div>
                    <div class="row container">
                        <div class="col-sm-12">
                            <form method="POST" action = "<?= base_url() ?>AdminProfile/edit_personalInfo_submit/" >

                                <fieldset class="form-group">
                                    <legend>Name:</legend>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 <?php if (!empty(form_error("admin_firstname"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                            <label for="admin_firstname" class=form-control-label">Firstname: </label>
                                            <input type="text" name="admin_firstname" value = "<?= set_value("admin_firstname", $userDetails->admin_firstname); ?>"  class="form-control <?php if (!empty(form_error("admin_firstname"))): ?>is-invalid<?php else: ?><?php endif; ?>">
                                            <div class="invalid-feedback"><?= form_error('admin_firstname') ?></div>
                                        </div>
                                        <div class="form-group col-md-6 <?php if (!empty(form_error("admin_lastname"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                            <label for="admin_lastname">Lastname: </label>
                                            <input type="text" name="admin_lastname" value = "<?= set_value("admin_lastname", $userDetails->admin_lastname); ?>" class="form-control <?php if (!empty(form_error("admin_lastname"))): ?>is-invalid<?php else: ?><?php endif; ?>">
                                            <div class="invalid-feedback"><?= form_error('admin_lastname') ?></div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group">
                                    <legend>Gender:</legend>
                                    <div class="form-check">

                                        <label class="form-check-label col-md-3">
                                            <input name="admin_sex" type="radio" id="admin_sex" class = "form-check-label" value ="Male" <?= $userDetails->admin_sex == "Male" ? "checked = \"\"" : "" ?>/>
                                            Male
                                        </label>
                                        <label class="form-check-label col-md-3" >
                                            <input name="admin_sex" type="radio" id="admin_sex" class = "form-check-label" value ="Female" <?= $userDetails->admin_sex == "Female" ? "checked = \"\"" : "" ?>/>
                                            Female
                                        </label>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group">
                                    <legend>Birthday:</legend>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" name="admin_bday" class="form_datetime form-control" value="<?= set_value("admin_bday", date("F d, Y", $userDetails->admin_bday)); ?>" style="margin-top:10px;">
                                        </div>    
                                    </div>
                                </fieldset>
                                <fieldset class="form-group">
                                    <legend>Address:</legend>
                                    <div class="form-row">
                                        <div class="form-group col-md-8 <?php if (!empty(form_error("admin_address"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                            <label for="admin_address">Address: </label>
                                            <input type="text" name="admin_address" value = "<?= set_value("admin_address", $userDetails->admin_address); ?>" class="form-control <?php if (!empty(form_error("admin_address"))): ?>is-invalid<?php else: ?><?php endif; ?>">
                                            <div class="invalid-feedback"><?= form_error('admin_address') ?></div>
                                        </div>
                                        <div class="form-group col-md-4 <?php if (!empty(form_error("admin_brgy"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                            <label for="admin_brgy">Barangay: </label>
                                            <input type="text" name="admin_brgy" value = "<?= set_value("admin_brgy", $userDetails->admin_brgy); ?>" class="form-control <?php if (!empty(form_error("admin_brgy"))): ?>is-invalid<?php else: ?><?php endif; ?>">
                                            <div class="invalid-feedback"><?= form_error('admin_brgy') ?></div>
                                        </div>
                                        <div class="form-group col-md-6 <?php if (!empty(form_error("admin_city"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                            <label for="admin_city">City: </label>
                                            <input type="text" name="admin_city" value = "<?= set_value("admin_city", $userDetails->admin_city); ?>" class="form-control <?php if (!empty(form_error("admin_city"))): ?>is-invalid<?php else: ?><?php endif; ?>" >
                                            <div class="invalid-feedback"><?= form_error('admin_city') ?></div>
                                        </div>
                                    </div>
                                </fieldset>

                                <button type="submit" class = "btn btn-outline-success pull-right">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary  pull-left" id = "btnReset_edit">Reset</button>

                            </form>
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
                    <div class="col-sm-12">
                        <form method="POST" action = "<?= base_url() ?>AdminProfile/edit_loginInfo_submit/" >
                            <fieldset class="form-group">
                                <legend>Username:</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="admin_username" class="form-control" value="<?= set_value("admin_username", $userDetails->admin_username); ?>" style="margin-top:10px;">
                                    </div>    
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <legend>Password:</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-6">

                                        <label for="admin_password">New Password: </label>
                                        <input type="password" name="admin_password"   class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="admin_conpassword">Confirm Password: </label>
                                        <input type="password" name="admin_conpassword" class="form-control">
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class = "btn btn-outline-success pull-right">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary  pull-left" id = "btnReset_edit">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row container">

                <div class="col-md-12"><br><br>
                    <h5><i class="fa fa-address-book"></i> Contact Information</h5>
                    <hr class="my-3">
                </div>
                <div class="row container">
                    <div class="col-md-12">
                        <form method="POST" action="">
                            <fieldset class="form-group">
                                <legend>Phone Number:</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="admin_contact_no" class="form-control" value="<?= set_value("admin_contact_no", $userDetails->admin_contact_no); ?>" style="margin-top:10px;">
                                    </div>    
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <legend>Email Address:</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="email" name="admin_email" class="form-control" value="<?= set_value("admin_email", $userDetails->admin_email); ?>" style="margin-top:10px;">
                                    </div>    
                                </div>
                            </fieldset>
                            <button type="submit" class = "btn btn-outline-success pull-right">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary  pull-left" id = "btnReset_edit">Reset</button>
                        </form>
                    </div>

                </div>
            </div>
            <br><br>
        </div>
    </div><br>
</div>
<!-- Modal Change Picture -->
<div class="modal fade <?= $userDetails->admin_id; ?>changePic" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class = "fa fa-pencil"></i> Change Picture</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action = "<?= base_url() ?>Profile/edit_picture_submit/" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class = "form-group">
                        <label for ="admin_picture">Picture</label>
                        <div class="custom-file-container" data-upload-id="admin_picture">
                            <label class="custom-file-container__custom-file" >
                                <input type="file" name = "admin_picture" id = "admin_picture_edit" class="custom-file-container__custom-file__custom-file-input" accept="image/*" onClick="this.form.reset()">
                                <input type="hidden" name="MAX_FILE_SIZE" value = "10485760"/>
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                <button class="custom-file-container__image-clear">x</button>
                            </label>
                            <small id="videoHelp" class="form-text text-muted">
                                Max size is 5MB. Allowed types is .jpg, .jpeg, .gif, .png
                            </small>
                            <div class="custom-file-container__image-preview" id = "admin_picture_edit_preview"></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Bootstrap File Upload with preview -->
<script src = "<?= base_url() ?>assets/bootstrap-fileupload/js/file-upload-with-preview.js"></script>
<script>
                                    var upload = new FileUploadWithPreview('admin_picture')
</script>
<!-- Bootstrap File Upload with preview -->
<script>
    document.getElementById("admin_picture_edit_preview").style.backgroundImage = "url('<?= base_url() . $userDetails->admin_picture ?>')";

    document.getElementById("btnReset_edit").onclick = function () {
        reset_upload()
    };
    function reset_upload() {
        document.getElementById("admin_picture_edit_preview").style.backgroundImage = "url('<?= base_url() . $userDetails->admin_picture ?>')";
        document.getElementById("admin_picture_edit").value = "";
    }
</script>