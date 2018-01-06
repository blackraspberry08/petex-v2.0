<!--===========================
EDIT MEDICAL RECORD
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
                    <div class = "col-lg-2 col-sm-12"></div>
                    <div class = "col-lg-8 col-sm-12">
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
                                <label for="image">Image: </label>
                                <img src = "<?= $this->config->base_url() . $animal->pet_picture ?>" id = "prev_image" class = "img-fluid" style = "border-radius:50px;  margin-top:20px; margin-bottom:20px;"/><br>
                                <center>
                                    <label class="custom-file">
                                        <input type="file" id="files" class="custom-file-input">
                                        <span class="custom-file-control"></span>
                                    </label>
                                </center>
                            </div>
                            <div class = "form-group">
                                <label for="video">Video: </label>
                                <center>
                                    <label class="custom-file">
                                        <input type="file" id="file" class="custom-file-input">
                                        <span class="custom-file-control"></span>
                                    </label>
                                </center>
                            </div>
                            <div class = "pull-right">
                                <a href = "<?= base_url() ?>MyPets" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary ">Save Pet Details</button>
                            </div>
                        </form>
                    </div>
                    <div class = "col-lg-2 col-sm-12"></div>
                </div>
            </div>
        </div>
    </div>