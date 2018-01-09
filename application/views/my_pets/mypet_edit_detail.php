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
<!--===========================
EDIT PET INFO
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <?php include_once (APPPATH . "views/show_error/show_error_medical_record.php"); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>UserDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>MyPets">My Pets</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>MyPets/edit_details_exec/<?= $animal->pet_id ?>"><?= "Details of " . $animal->pet_name ?></a>
            </li>
            <li class="breadcrumb-item active">Edit Pet Details</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-info"></i> Edit Pet Details
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
                            </li>
                            <li class="list-group-item">
                                <?php if ($animal->pet_sex == "Male"): ?>
                                    <small><i class="fa fa-mars"></i> Male</small>
                                <?php else: ?>
                                    <small><i class="fa fa-venus"></i> Female</small>
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
                    <div class = "col-lg-8 col-sm-12" id = "animal_info">
                        <form method = "POST" action = "<?= base_url() ?>MyPets/edit_details_submit/<?= $animal->pet_id ?>">   
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="pet_name">Name: </label>
                                    <input type="text" name="pet_name" value = "<?= set_value("pet_name", $animal->pet_name); ?>" class="form_datetime form-control" placeholder="Date">
                                </div>
                            </div>
                            <div class = "form-group">
                                <label for="description">Description: </label>
                                <textarea class="form-control" id="description" rows="3" name = "pet_description"><?= set_value("pet_description", $animal->pet_description); ?></textarea>
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
                            <div class="form-group">
                                <label for="pet_video">Video</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class = "fa fa-link"></i></span>
                                    <input type="text" class="form-control" id="pet_video" placeholder="Paste Link Here" name = "pet_video" value = '<?= set_value("pet_description", wrap_iframe($animal->pet_video)); ?>'>
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
                    <div class = "col-lg-2 col-sm-12"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap File Upload with preview -->
<script src = "<?= base_url() ?>assets/bootstrap-fileupload/js/file-upload-with-preview.js"></script>
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