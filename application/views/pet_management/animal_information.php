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
                                <?php elseif ($animal->pet_status == "Deceased"): ?>
                                    <small class = "text-secondary">Deceased</small>
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
                        <a class="btn btn-outline-info pull-right" href="<?= base_url() ?>PetManagement/animal_edit_exec/<?= $animal->pet_id; ?>"><i class="fa fa-pencil"></i> Edit Information</a>

                        <div class="row">
                            <div class="col-md-6">
                                <h6>Name</h6>
                                <label><?= $animal->pet_name; ?></label>
                            </div>
                            <div class="col-md-6">
                                <h6 for="pet_bday">Birthday</h6>
                                <label> <?= date("F d, Y", $animal->pet_bday); ?></label>
                            </div>
                        </div>
                        <br>
                        <h6 for="pet_breed" class=form-control-label">Breed</h6>
                        <label> <?= $animal->pet_breed; ?></label><br><br>

                        <div class="row">
                            <div class="col-md-4">
                                <h6>Status</h6>
                            </div>
                            <div class="col-md-4">
                                <h6>Gender</h6>
                            </div>
                            <div class="col-md-4">
                                <h6>Size</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label> <?= $animal->pet_status; ?> </label>

                            </div>
                            <div class="col-md-4">
                                <label><?= $animal->pet_sex ?> </label>
                            </div>
                            <div class="col-md-4">
                                <label><?= $animal->pet_size ?> </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <h6 for = "pet_specie">Specie</h6>
                            </div>
                            <div class="col-md-4">
                                <h6 for="pet_admission">Admission</h6>
                            </div>
                            <div class="col-md-4">
                                <h6 for="pet_neutered_spayed"><?= $animal->pet_sex == "Male" ? "Neutered" : "Spayed"; ?></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label> <?= $animal->pet_specie; ?> </label>

                            </div>
                            <div class="col-md-4">
                                <label><?= $animal->pet_admission ?> </label>
                            </div>
                            <div class="col-md-4">
                                <?php if ($animal->pet_neutered_spayed == 1): ?>
                                    <label>Yes</label>
                                <?php else: ?>
                                    <label>No</label>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br>
                        <h6 for="pet_description" class=form-control-label">Description</h6>
                        <label><?= $animal->pet_description ?></label><br><br>
                        <h6 for="pet_history" class=form-control-label">History:</h6>
                        <label><?= $animal->pet_history ?></label><br><br>
                        <h6 for="pet_video" class="form-control-label">Video:</h6>

                        <?php if (!empty($animal->pet_video)): ?>
                            <div class="embed-responsive embed-responsive-16by9 rounded mb-4">
                                <?= wrap_iframe($animal->pet_video); ?>
                            </div>
                        <?php endif; ?>
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

