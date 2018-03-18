
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
Pet Adoption
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>UserDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Pet Adoption</li>
        </ol>
        <!-- Registered -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-home"></i> Pet Adoption
            </div>
            <?php if (empty($pets)): ?>
                <div class = "col-lg-12">
                    <center>
                        <h4>No animals yet</h4>
                        <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                    </center>
                </div>
            <?php else: ?>
                <div class="card-body container-fluid">
                    <div class="row">
                        <?php foreach ($pets as $pet): ?>
                            <?php $medical = $this->PetAdoption_model->get_animal_medical_records(array("medical_record.pet_id" => $pet->pet_id))[0]; ?>
                            <?php $petAdopters = $this->UserDashboard_model->fetchJoinThreeProgressDesc(array('transaction.pet_id' => $pet->pet_id)); ?>

                            <?php if ($pet->pet_status == 'Adoptable' && $pet->pet_access == 1): ?>
                                <div class="col-md-3">
                                    <div class="card">
                                        <a href = "<?= $this->config->base_url() . $pet->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $pet->pet_name ?></b>">
                                            <img class="card-img-top" src = "<?= $this->config->base_url() . $pet->pet_picture ?>"  style="height:180px;" alt="picture">
                                        </a>
                                        <div class="card-body">
                                            <h4 class="card-title"><?= $pet->pet_name ?></h4>
                                            <i class="fa fa-calendar"></i> <?= date('M. j, Y', $pet->pet_bday) ?><br>
                                            <?php if ($pet->pet_sex == "Male" || $pet->pet_sex == "male"): ?>
                                                <i class="fa fa-mars" style="color:blue"></i> <?= $pet->pet_sex ?><br>
                                            <?php else: ?>
                                                <i class="fa fa-venus" style="color:red"></i> <?= $pet->pet_sex ?><br>
                                            <?php endif; ?>
                                            <i class="fa fa-paw"></i> <?= $pet->pet_breed ?><br>     
                                            <i class="fa fa-users"></i> <?= $petAdopters ?><br>

                                        </div>

                                        <div class="card-footer text-center">
                                            <div class = "btn-group" role="group" aria-label="Button Group">
                                                <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $pet->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye"></i></a>
                                                <?php if (empty($userInfo)): ?>
                                                    <a href = "<?= base_url() ?>PetAdoption/petAdoptionOnlineForm_exec/<?= $pet->pet_id ?>" class = "btn btn-outline-secondary btn-md"  title="Adopt a Pet"><i class = "fa fa-star"></i></a>
                                                <?php else: ?>
                                                    <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $pet->pet_id; ?>warning" data-placement="bottom" title="Adopt a Pet"><i class = "fa fa-star"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div><br>
                                </div>
                                <!-- Modal Detail -->
                                <div class="modal fade <?= $pet->pet_id; ?>detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class = "fa fa-info"></i> Pet Info</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class ="col-md-5">
                                                        <img src = "<?= $this->config->base_url() . $pet->pet_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                                                    </div>
                                                    <div class ="col-md-7">
                                                        <table class = "table table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Name: </th>
                                                                    <td><?= $pet->pet_name; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Interested Adopters: </th>
                                                                    <td><?= $petAdopters ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Size: </th>
                                                                    <td><?= $pet->pet_size; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Birthday: </th>
                                                                    <td><?= date("F d, Y", $pet->pet_bday); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Age:</th>
                                                                    <td><?= get_age($pet->pet_bday); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Specie: </th>
                                                                    <td><?= $pet->pet_specie; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Sex: </th>
                                                                    <td><?= $pet->pet_sex; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Breed: </th>
                                                                    <td><?= $pet->pet_breed; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Sterilized: </th>
                                                                    <td><?= $pet->pet_neutered_spayed == 1 ? "Yes" : "No"; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Admission: </th>
                                                                    <td><?= $pet->pet_admission; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Description: </th>
                                                                    <td><?= $pet->pet_description; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Findings: </th>
                                                                    <td><?= $pet->pet_history; ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5><i class="fa fa-stethoscope"></i> Medical Record</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <?php if (empty($medical)): ?>
                                                                    <h2><i class="fa fa-warning"></i> This pet has no Medical Records</h2>
                                                                <?php else: ?>
                                                                    <table class = "table table-striped">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th>Date: </th>
                                                                                <td><?= date("F d, Y", $medical->medicalRecord_date); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Weight: </th>
                                                                                <td><?= $medical->medicalRecord_weight; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Diagnosis: </th>
                                                                                <td><?= $medical->medicalRecord_diagnosis; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Treatment: </th>
                                                                                <td><?= $medical->medicalRecord_treatment; ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <br>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5><i class="fa fa-video-camera"></i> Video</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <?php if ($pet->pet_video == NULL): ?>
                                                                    <h2>This pet has no Video</h2>
                                                                <?php else: ?>
                                                                    <div class="embed-responsive embed-responsive-16by9 rounded mb-4">
                                                                        <?= wrap_iframe($pet->pet_video); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                

                                <!-- Modal Warning -->
                                <div class="modal fade <?= $pet->pet_id; ?>warning" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class = "fa fa-warning"></i> Warning!</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row container">
                                                    <h3>Oops! Sorry, you cannot adopt this pet because you already have in progress...</h3>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div><br>
    </div>
</div>
</div>
