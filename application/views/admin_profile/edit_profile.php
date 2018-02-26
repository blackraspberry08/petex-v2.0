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
                    <div class="col-md-3">   
                        <div class="card">
                            <div class="card-header">
                                <center>
                                    <img src="<?= base_url() . $userDetails->admin_picture ?>" class="img-fluid img-circle">
                                </center>
                            </div>
                            <div class="card-body">
                                <center>
                                    <a href = "#" class = "btn btn-outline-success" data-toggle="modal" data-target=".<?= $userDetails->admin_id; ?>changePic"  data-placement="bottom" title="Change Picture"><i class = "fa fa-pencil"></i> Change Picture</a>
                                </center>
                            </div>
                        </div>
                        <br>
                    </div> 
                    <div class="col-md-9">
                        <div class="card">
                            <form class="form" action="<?= base_url() ?>AdminProfile/edit_profile_submit/" method="POST">

                                <div class="card-body ">
                                    <div class="row">
                                        <div class="form-group col-md-12 <?php if (!empty(form_error("admin_firstname"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                            <label for="admin_firstname" class=form-control-label">Firstname: </label>
                                            <input type="text" name="admin_firstname" value = "<?= set_value("admin_firstname", $userDetails->admin_firstname); ?>"  class="form-control <?php if (!empty(form_error("admin_firstname"))): ?>is-invalid<?php else: ?><?php endif; ?>">
                                            <div class="invalid-feedback"><?= form_error('admin_firstname') ?></div>
                                        </div>
                                        <div class="form-group col-md-12 <?php if (!empty(form_error("admin_lastname"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                            <label for="admin_lastname" class=form-control-label">Lastname: </label>
                                            <input type="text" name="admin_lastname" value = "<?= set_value("admin_lastname", $userDetails->admin_lastname); ?>"  class="form-control <?php if (!empty(form_error("admin_lastname"))): ?>is-invalid<?php else: ?><?php endif; ?>">
                                            <div class="invalid-feedback"><?= form_error('admin_lastname') ?></div>
                                        </div>
                                        <label for="admin_sex" class=form-control-label" style="margin-left:13px;">Gender: </label>
                                        <div class="form-check col-md-12">
                                            <label class="form-check-label col-md-6">
                                                <input name="admin_sex" type="radio" id="admin_sex" class = "form-check-label" value ="Male" <?= $userDetails->admin_sex == "Male" ? "checked = \"\"" : "" ?>/>
                                                Male
                                            </label>
                                            <label class="form-check-label col-md-6">
                                                <input name="admin_sex" type="radio" id="admin_sex" class = "form-check-label" value ="Female" <?= $userDetails->admin_sex == "Female" ? "checked = \"\"" : "" ?>/>
                                                Female
                                            </label>
                                        </div>
                                        <div class="form-group col-md-12 <?php if (!empty(form_error("admin_bday"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                            <label for="admin_bday" class=form-control-label">Birthday: </label>
                                            <input type="text" name="admin_bday" readonly="" value="<?= set_value("admin_bday", date("F d, Y", $userDetails->admin_bday)); ?>" class="form_datetime form-control <?php if (!empty(form_error("admin_bday"))): ?>is-invalid<?php else: ?><?php endif; ?>">
                                            <div class="invalid-feedback"><?= form_error('admin_bday') ?></div>
                                        </div>
                                        <div class="form-group col-md-12 <?php if (!empty(form_error("admin_email"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                            <label for="admin_email" class=form-control-label">Email Address: </label>
                                            <input type="email" name="admin_email" value = "<?= set_value("admin_email", $userDetails->admin_email); ?>"  class="form-control <?php if (!empty(form_error("admin_email"))): ?>is-invalid<?php else: ?><?php endif; ?>">
                                            <div class="invalid-feedback"><?= form_error('admin_email') ?></div>
                                        </div>
                                        <div class="form-group col-md-12 <?php if (!empty(form_error("admin_contact_no"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                            <label for="admin_contact_no" class=form-control-label">Phone Number: </label>
                                            <input type="text" name="admin_contact_no" value = "<?= set_value("admin_contact_no", $userDetails->admin_contact_no); ?>"  class="form-control <?php if (!empty(form_error("admin_contact_no"))): ?>is-invalid<?php else: ?><?php endif; ?>">
                                            <div class="invalid-feedback"><?= form_error('admin_contact_no') ?></div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="admin_address" class=form-control-label">Address: </label>
                                            <input type="text" id = "geocomplete" name = "admin_address" class="form-control <?= !empty(form_error("admin_address")) ? "is-invalid" : ""; ?>" placeholder="Address" aria-label="Address" value = "<?= set_value("admin_address", $userDetails->admin_address); ?>" >
                                            <div class="invalid-feedback"><?= form_error('admin_address') ?></div>
                                            <br>
                                            <div class ="col-lg-12 text-center" style = "height:400px;">
                                                <div id = "google-map" style="height:100%; min-height:250px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="reset" class="btn btn-outline-secondary" id = "btnReset_edit">Reset</button>

                                    <button class="btn btn-success pull-right" > 
                                        <i class="fa fa-send fa-lg"></i> Submit
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
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
                        <form method="POST" action = "<?= base_url() ?>AdminProfile/edit_picture_submit/" enctype="multipart/form-data">
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