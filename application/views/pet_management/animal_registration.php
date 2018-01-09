<!--===========================
Animal Registration
============================-->
<?php 
    function wrap_iframe($src){
        if($src == ''){
            $new_src = '';
        }else{
            $new_src = '<iframe class="embed-responsive-item" src="'.$src.'" allowfullscreen></iframe>';
            
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
                <form enctype="multipart/form-data" action = "<?= base_url()?>PetManagement/register_animal/" method = "POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pet_name">Name</label>
                            <input type="text" class="form-control" id="pet_name" name = "pet_name" value = "<?= set_value("pet_name");?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pet_bday">Birthday</label>
                            <input readonly type="text" class="form-control form_datetime" id="pet_bday" name = "pet_bday" value = "<?= set_value("pet_bday",date("F d, Y"));?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pet_breed">Breed</label>
                        <input type="text" class="form-control" id="pet_breed" name = "pet_breed" value = "<?= set_value("pet_breed");?>">
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
                    <div class="form-group">
                        <label for="pet_description">Description</label>
                        <textarea class="form-control" name = "pet_description" rows = "3"><?= set_value("pet_description");?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pet_history">History</label>
                        <textarea class="form-control" name = "pet_history" rows = "3"><?= set_value("pet_history");?></textarea>
                    </div>
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
                    <div class="form-group">
                        <label for="pet_video">Video</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class = "fa fa-link"></i></span>
                            <input type="text" class="form-control" id="pet_video" placeholder="Paste Link Here" name = "pet_video" value = '<?= set_value("pet_description");?>'>
                        </div>
                        <small id="videoHelp" class="form-text text-muted">
                            Right click on a youtube video, and select "Copy embed code". Paste it here.
                        </small>
                    </div>
                    <div class ="text-center">
                        <button type="reset" class="btn btn-outline-secondary" id = "btnReset_add">Reset</button>
                        <button type="submit" class="btn btn-outline-primary">Register Animal</button>
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
    
    