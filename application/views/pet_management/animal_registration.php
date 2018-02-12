<!--===========================
Animal Registration
============================-->
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
            <li class="breadcrumb-item active">Animal Registration</li>
        </ol>
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <div class = "row">
            <div class = "col-lg-2 col-md-12"></div>
            <div class ="col-lg-8 col-md-12 py-4" id = "animal_info">
                <form enctype="multipart/form-data" action = "<?= base_url() ?>PetManagement/register_animal/" method = "POST">
                    <div class = "form-group">
                        <label for ="pet_picture">Picture</label>
                        <div class="custom-file-container" data-upload-id="pet_picture">
                            <label class="custom-file-container__custom-file" >
                                <input type="file" name = "pet_picture" id = "pet_picture_add" class="custom-file-container__custom-file__custom-file-input" accept="image/*" onClick="this.form.reset()">
                                <input type="hidden" name="MAX_FILE_SIZE" value = "10485760"/>
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                <button class="custom-file-container__image-clear">x</button>
                            </label>
                            <small id="videoHelp" class="form-text text-muted">
                                Max size is 5MB. Allowed types is .jpg, .jpeg, .gif, .png
                            </small>
                            <div class="custom-file-container__image-preview" id = "pet_picture_add_preview"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 <?php if (!empty(form_error("pet_name"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                            <label for="pet_name" class="form-control-label">Name</label>
                            <input type="text" class="form-control <?php if (!empty(form_error("pet_name"))): ?>is-invalid<?php else: ?><?php endif; ?>" id="pet_name" name = "pet_name" value = "<?= set_value("pet_name"); ?>">
                            <div class="invalid-feedback"><?= form_error('pet_name') ?></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pet_bday">Birthday</label>
                            <input readonly type="text" class="form-control form_datetime" id="pet_bday" name = "pet_bday" value = "<?= set_value("pet_bday", date("F d, Y")); ?>">
                        </div>
                    </div>
                    <div class="form-group <?php if (!empty(form_error("pet_breed"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                        <label for="pet_breed" class="form-control-label" >Breed</label>
                        <input type="text" class="form-control <?php if (!empty(form_error("pet_breed"))): ?>is-invalid<?php else: ?><?php endif; ?>" id="pet_breed" name = "pet_breed" value = "<?= set_value("pet_breed"); ?>">
                        <div class="invalid-feedback"><?= form_error('pet_breed') ?></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for = "pet_status">Status</label>
                            <select class="form-control" name = "pet_status" id="pet_status">
                                <option value = "Adoptable" selected>Adoptable</option>
                                <option value = "NonAdoptable" >Not Adoptable</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pet_sex">Gender</label>
                            <select class="form-control" name = "pet_sex" id="pet_sex">
                                <option value = "Male" selected>Male</option>
                                <option value = "Female" >Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pet_size">Size</label>
                            <select class="form-control" name = "pet_size" id="pet_size">
                                <option value = "S" selected>Small</option>
                                <option value = "M" >Medium</option>
                                <option value = "L" >Large</option>
                                <option value = "XL">X Large</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for = "pet_specie">Specie</label>
                            <select class="form-control" name = "pet_specie" id="pet_specie">
                                <option value = "Canine" selected>Canine</option>
                                <option value = "Feline" >Feline</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pet_admission">Admission</label>
                            <select class="form-control" name = "pet_admission" id="pet_admission">
                                <option value = "Foster" selected>Foster</option>
                                <option value = "PARC" >PARC</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pet_neutered_spayed">Neutered or Spayed</label>
                            <select class="form-control" name = "pet_neutered_spayed" id="pet_neutered_spayed">
                                <option value = "1" selected>Yes</option>
                                <option value = "0" >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group <?php if (!empty(form_error("pet_description"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                        <label for="pet_description" class="form-control-label">Description</label>
                        <textarea class="form-control <?php if (!empty(form_error("pet_description"))): ?>is-invalid<?php else: ?><?php endif; ?>" name = "pet_description" rows = "3"><?= set_value("pet_description"); ?></textarea>
                        <div class="invalid-feedback"><?= form_error('pet_description') ?></div>
                    </div>
                    <div class="form-group <?php if (!empty(form_error("pet_history"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                        <label for="pet_history" class="form-control-label">History</label>
                        <textarea class="form-control <?php if (!empty(form_error("pet_history"))): ?>is-invalid<?php else: ?><?php endif; ?>" name = "pet_history" rows = "3"><?= set_value("pet_history"); ?></textarea>
                        <div class="invalid-feedback"><?= form_error('pet_history') ?></div>
                    </div>
                    <div class="form-group <?php if (!empty(form_error("pet_video"))): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                        <label for="pet_video" class="form-control-label">Video</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class = "fa fa-link"></i></span>
                            </div>
                            <input type="text" class="form-control <?php if (!empty(form_error("pet_video"))): ?>is-invalid<?php else: ?><?php endif; ?>" id="pet_video" placeholder="Paste Link Here" name = "pet_video" value = '<?= set_value("pet_video"); ?>'>
                        </div>
                        <div class="invalid-feedback"><?= form_error('pet_video') ?></div>
                        <small id="videoHelp" class="form-text text-muted">
                            Right click on a youtube video, and select "Copy embed code". Paste it here.
                        </small>
                    </div>
                    <div class ="text-center">
                        <button type="reset" class="btn btn-outline-secondary" id = "btnReset_edit">Reset</button>
                        <button type="submit" class="btn btn-outline-primary" id = "btnReset_add">Register Animal</button>
                    </div>
                </form>
            </div>
            <div class = "col-lg-2 col-md-12"></div>
        </div>
    </div>
    <!-- Bootstrap File Upload with preview -->
    <script src = "https://unpkg.com/file-upload-with-preview"></script>
    <script>
        var upload = new FileUploadWithPreview('pet_picture')
    </script>
    <script>
        var base_img = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAiQAAAD6CAMAAACmhqw0AAAA+VBMVEUAAAD29u3u7unt7ent7enu7uju7uihoqCio6Gio6KjpKOkpaSmpqSmp6WoqKaqq6mqq6qrq6qsrautrauur62wsa6xsa+xsrCys7GztLK0tbK1trS2t7S3t7W4uba5ure6u7e7vLm8vbu9vrvAwL3Awb3DxMHFxcPGxsPHx8TIycXLzMjLzMnMzMnNzsrPz8vP0MzQ0M3S0s/U1NDV1dLX19TY2NTY2NXZ2dba2tXb29bc3Nfc3Njc3dnd3dre3tre39vg4Nvh4dzi4t3i4t7j497k5N/k5ODl5eDl5eHl5uLm5uHn5+Lo6OPp6eTq6uXr6+bs7Oft7eh54KxIAAAAB3RSTlMAHKbl5uztvql9swAABA1JREFUeNrt3VlT01AYgOG0oEEE910URNzFBVFcqCgKirLU/P8fI3QYbEOSdtrMyJzzvHfMlFx833NBQuY0SRrN8UwqabzZSJLGaYNQVacaSdMUVF0zGTMEVTeWmIH6BYkgESSCRJAIEkEiSCRIBIkgESSCRJAIEkEiQSJIBIkgESSCRJAIEgkSQSJIBIkgESSCRJBIkAgSQSJIBIkgESSCRIJEkAgSQSJIBIkgkSARJIJEkAgSQSJIBIkEiSARJIJEkAgSQSJIJEgEiSARJIJEkAgSQSJBIkgEiSARJIJEkAgSCRJBIkgEiSARJIJEgkSQ5PvxbdS+tyEJuZVb0+noTV579geSQGs/SOvqxiYkYfYwra+rbUhC7NNEjUjSJ5CE2P06jaTnIAmxKwe7vb468t3N14WOki1IAuzMwWrf1HCh3Q6S95AEWGe1b0/WlSCBBBJIIAkdSXvt1aNXa21IICld7dJU5+epJUggKV7tzuzRA4/ZHUggKVrtfNdjsXlIIClY7XLPw9NlSCA5vtqLPUguQgLJsdX+zv0fZhsSSPKrXckhWSn5jV8zG5DEiuR1DsnrEiOX0vMbkESKZDWHZLXMSFqsBJIIkOz1vn40sVdqpFgJJDHc3dzsQXKzwkihEkhiQLI+2f3y+3qVkSIlkMSAJFvsQrJYbaRACSRRIMlenj0UcPZlPyPHlUASB5Jsc+7cwevMc5v9jRxTAkkkSPbb+riVZYMYySuBJB4kJRUYySmBJHYkhUZ6lUASOZISIz1KIIkbSamRbiWQxIZkvT2YkS4lkESGpDV9tz2YkX9KIIkLSWs6TY+U9DFypASSqJC0OicfHSrpa2T/k5BEh6R1eDpWR8kARtIZSGJD0jo6QW1fySBGIIkOSavrlL27PwcxAklsSFo9JzFOppBAkl9ta5jTOiGJCslQRiCJCslwRiCJCcmQRiCJCMmwRiCJB8mXoU+YhyQaJM9TSCCBBBJIIIEEEkgggQQSSCCJAsnyzLA9hiQWJCfnSpBAAgkkkATXxFCnPxfU7iB5B0mAXT5Y7Z3t0Y087SDZgCTA7tX6bZ5TGSQBtlwrkgVIgmy+RiMXdiEJsp3b9Rn5nEESaC/O1/P3yMJuBkm4bX94O2rvNiKbWXRIBIkgESSCRJAIEkEiQSJIBIkgESSCRJAIEgkSQSJIBIkgESSCRIJEkAgSQSJIBIkgESQSJIJEkAgSQSJIBIkgkSARJIJEkAgSQSJIBIkEiSARJIJEkAgSQSJIJEgEiSARJIJEkAgSCRJBIkgEiSARJIJEkEiQCBJBIkgEiSARJIJEgkSQCBJBIkgEiSARJBIkgkSQ6P8gGTMDVTeWNA1B1TWTxmlTUFWnGknSaI4bhMoabzaSv+4BHFVoHZzfAAAAAElFTkSuQmCC';
        function reset_upload() {
            document.getElementById("pet_picture_edit_preview").style.backgroundImage = "url('" + base_img + "')";
            document.getElementById("pet_picture_edit").value = "";
        }
    </script>

