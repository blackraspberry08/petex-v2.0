<!--===========================
Animal Information
============================-->
<style>
    /* Small devices (landscape phones, 576px and up) */
    @media (min-width: 576px) {
        #animal_info{
            border-left: 0px solid #ccc;   
        }
    }

    /* Medium devices (tablets, 768px and up) */
    @media (min-width: 768px) {
        #animal_info{
            border-left: 1px solid #ccc;   
        }
    }

    /* Large devices (desktops, 992px and up) */
    @media (min-width: 992px) {
        #animal_info{
            border-left: 1px solid #ccc;   
        }
    }

    /* Extra large devices (large desktops, 1200px and up)*/
    @media (min-width: 1200px) {
        #animal_info{
            border-left: 1px solid #ccc;   
        }

    }
    .center-cropped {
        max-height: 230px;
        overflow: hidden;
        border-radius: 3px;
    }
    .center-cropped img {
        object-fit: cover;
    }
    .list-group-item:first-child{
        border-radius:0;
        padding:12px 10px;
        border-top:0;
    }
    .list-group-item{
        border-left:0;
        border-right:0;
        padding:6px 10px;
    }

</style>
<?php

function wrap_iframe($src) {
    if ($src == '') {
        $new_src = '';
    } else {
        $new_src = '<iframe class="embed-responsive-item" src="' . $src . '" allowfullscreen></iframe>';
    }
    return $new_src;
}
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>PetManagement">Pet Management</a>
            </li>
            <li class="breadcrumb-item active"><?= $animal->pet_name; ?>'s Information</li>
        </ol>
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <?php include_once (APPPATH . "views/show_error/show_error_animal_info.php"); ?>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> <?= $animal->pet_name; ?>'s Information
            </div>
            <div class="card-body">
                <div class = "row">
                    <div class ="col-lg-3 col-md-12">
                        <a href = "<?= base_url() . $animal->pet_picture; ?>" data-toggle = "lightbox" class = "center-cropped">
                            <img src = "<?= base_url() . $animal->pet_picture; ?>" class ="img-thumbnail center-cropped img-fluid mx-auto d-block">
                        </a>
                        <ul class="list-group" >
                            <li class="list-group-item">
                                <strong><?= $animal->pet_name ?></strong>
                                <span class = "pull-right">Pet ID : <?= $animal->pet_id ?></span>
                            </li>
                            <li class="list-group-item">
                                <?php if ($animal->pet_sex == "Male"): ?>
                                    <small><i class="fa fa-mars"></i> Male</small>
                                <?php else: ?>
                                    <small><i class="fa fa-venus"></i> Female</small>
                                <?php endif; ?> | 
                                <?php if ($animal->pet_status == "Adoptable"): ?>
                                    <small class = "text-success">Adoptable</small>
                                <?php elseif ($animal->pet_status == "NonAdoptable"): ?>
                                    <small class = "text-secondary">Not Adoptable</small>
                                <?php else: ?>
                                    <small class = "text-danger">Adopted</small>
                                <?php endif; ?>
                            </li>
                            <li class="list-group-item">
                                <small><?= date("F d, Y", $animal->pet_bday); ?></small>
                            </li>
                            <li class="list-group-item">
                                <small><?= $animal->pet_description ?></small>
                            </li>
                        </ul>
                    </div>
                    <div class ="col-lg-9 col-md-12 py-4" id = "animal_info">
                        <form enctype="multipart/form-data" action = "<?= base_url() ?>PetManagement/edit_animal_info_exec/<?= $animal->pet_id ?>" method = "POST">
                            <div class="form-row">
                                <div class="form-group col-md-6 <?php if (!empty(form_error("pet_name"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                    <label for="pet_name"  class=form-control-label">Name</label>
                                    <input type="text" class="form-control <?php if (!empty(form_error("pet_name"))): ?>is-invalid<?php else: ?><?php endif; ?>" id="pet_name" name = "pet_name" value = "<?= set_value("pet_name", $animal->pet_name); ?>">
                                    <div class="invalid-feedback"><?= form_error('pet_name') ?></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pet_bday">Birthday</label>
                                    <input readonly type="text" class="form-control form_datetime" id="pet_bday" name = "pet_bday" value = "<?= set_value("pet_bday", date("F d, Y", $animal->pet_bday)); ?>">
                                </div>
                            </div>
                            <div class="form-group <?php if (!empty(form_error("pet_breed"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <label for="pet_breed" class=form-control-label">Breed</label>
                                <input type="text" class="form-control <?php if (!empty(form_error("pet_breed"))): ?>is-invalid<?php else: ?><?php endif; ?>" id="pet_breed" name = "pet_breed" value = "<?= set_value("pet_breed", $animal->pet_breed); ?>">
                                <div class="invalid-feedback"><?= form_error('pet_breed') ?></div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for = "pet_status">Status</label>
                                    <?php if ($animal->pet_status == "Adopted"): ?>
                                        <input class="form-control" name = "pet_status" id="pet_status" value = "Adopted" readonly>
                                    <?php else: ?>
                                        <select class="form-control" name = "pet_status" id="pet_status">
                                            <option value = "Adoptable" <?= $animal->pet_status == "Adoptable" ? "selected" : ""; ?>>Adoptable</option>
                                            <option value = "NonAdoptable" <?= $animal->pet_status == "NonAdoptable" ? "selected" : ""; ?>>Not Adoptable</option>
                                        </select>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pet_sex">Gender</label>
                                    <select class="form-control" name = "pet_sex" id="pet_sex">
                                        <option value = "Male" <?= $animal->pet_sex == "Male" ? "selected" : ""; ?>>Male</option>
                                        <option value = "Female" <?= $animal->pet_sex == "Female" ? "selected" : ""; ?>>Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pet_size">Size</label>
                                    <select class="form-control" name = "pet_size" id="pet_size">
                                        <option value = "S" <?= $animal->pet_size == "S" ? "selected" : ""; ?>>Small</option>
                                        <option value = "M" <?= $animal->pet_size == "M" ? "selected" : ""; ?>>Medium</option>
                                        <option value = "L" <?= $animal->pet_size == "L" ? "selected" : ""; ?>>Large</option>
                                        <option value = "XL" <?= $animal->pet_size == "XL" ? "selected" : ""; ?>>X Large</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for = "pet_specie">Specie</label>
                                    <select class="form-control" name = "pet_specie" id="pet_specie">
                                        <option value = "Canine" <?= $animal->pet_specie == "Canine" ? "selected" : ""; ?>>Canine</option>
                                        <option value = "Feline" <?= $animal->pet_specie == "Feline" ? "selected" : ""; ?>>Feline</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pet_admission">Admission</label>
                                    <select class="form-control" name = "pet_admission" id="pet_admission">
                                        <option value = "Foster" <?= $animal->pet_admission == "Foster" ? "selected" : ""; ?>>Foster</option>
                                        <option value = "PARC" <?= $animal->pet_admission == "PARC" ? "selected" : ""; ?>>PARC</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pet_neutered_spayed"><?= $animal->pet_sex == "Male" ? "Neutered" : "Spayed"; ?></label>
                                    <select class="form-control" name = "pet_neutered_spayed" id="pet_neutered_spayed">
                                        <option value = "1" <?= $animal->pet_neutered_spayed == 1 ? "selected" : ""; ?>>Yes</option>
                                        <option value = "0" <?= $animal->pet_neutered_spayed == 0 ? "selected" : ""; ?>>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group <?php if (!empty(form_error("pet_description"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <label for="pet_description" class=form-control-label">Description</label>
                                <textarea class="form-control <?php if (!empty(form_error("pet_description"))): ?>is-invalid<?php else: ?><?php endif; ?>" name = "pet_description" rows = "3"><?= set_value("pet_description", $animal->pet_description); ?></textarea>
                                <div class="invalid-feedback"><?= form_error('pet_description') ?></div>
                            </div>
                            <div class="form-group <?php if (!empty(form_error("pet_history"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <label for="pet_history" class=form-control-label">History</label>
                                <textarea class="form-control <?php if (!empty(form_error("pet_history"))): ?>is-invalid<?php else: ?><?php endif; ?>" name = "pet_history" rows = "3"><?= set_value("pet_history", $animal->pet_history); ?></textarea>
                                <div class="invalid-feedback"><?= form_error('pet_history') ?></div>
                            </div>
                            <div class = "form-group">
                                <label for ="pet_picture">Picture</label>
                                <div class="custom-file-container" data-upload-id="pet_picture">
                                    <label class="custom-file-container__custom-file" >
                                        <input type="file" name = "pet_picture" id = "pet_picture_edit" class="custom-file-container__custom-file__custom-file-input" accept="image/*" onClick="this.form.reset()">
                                        <input type="hidden" name="MAX_FILE_SIZE" value = "10485760"/>
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        <button class="custom-file-container__image-clear">x</button>
                                    </label>
                                    <small id="videoHelp" class="form-text text-muted">
                                        Max size is 5MB. Allowed types is .jpg, .jpeg, .gif, .png
                                    </small>
                                    <div class="custom-file-container__image-preview" id = "pet_picture_edit_preview"></div>
                                </div>
                            </div>
                            <div class="form-group <?php if (!empty(form_error("pet_video"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <label for="pet_video" class=form-control-label">Video</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class = "fa fa-link"></i></span>
                                    <input type="text" class="form-control <?php if (!empty(form_error("pet_video"))): ?>is-invalid<?php else: ?><?php endif; ?>" id="pet_video" placeholder="Paste Link Here" name = "pet_video" value = '<?= set_value("pet_video", wrap_iframe($animal->pet_video)); ?>'>
                                    <div class="invalid-feedback"><?= form_error('pet_video') ?></div>
                                </div>
                                <small id="videoHelp" class="form-text text-muted">
                                    Right click on a youtube video, and select "Copy embed code". Paste it here.
                                </small>
                            </div>
                            <?php if (!empty($animal->pet_video)): ?>
                                <div class="embed-responsive embed-responsive-16by9 rounded mb-4">
                                    <?= wrap_iframe($animal->pet_video); ?>
                                </div>
                            <?php endif; ?>
                            <div class ="text-center">
                                <button type="reset" class="btn btn-outline-secondary" id = "btnReset_edit">Reset</button>
                                <button type="submit" class="btn btn-outline-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap File Upload with preview -->
    <script src = "https://unpkg.com/file-upload-with-preview"></script>
    <script>
                                            var upload = new FileUploadWithPreview('pet_picture')
    </script>
    <!-- Bootstrap File Upload with preview -->
    <script>
        document.getElementById("pet_picture_edit_preview").style.backgroundImage = "url('<?= base_url() . $animal->pet_picture ?>')";

        document.getElementById("btnReset_edit").onclick = function () {
            reset_upload()
        };
        function reset_upload() {
            document.getElementById("pet_picture_edit_preview").style.backgroundImage = "url('<?= base_url() . $animal->pet_picture ?>')";
            document.getElementById("pet_picture_edit").value = "";
        }
    </script>

