<script>
    $(document).ready(function () {
        $("#filter_select").on("change", function () {
            var search_word = $("#search_text").val();
            var filter = $(this).val();
            console.log("FILTER = " + filter);
            $.ajax({
                "method": "POST",
                "url": '<?= base_url() ?>' + "PetAdoption/search_pet_adoptable",
                "dataType": "JSON",
                "data": {
                    'search_word': search_word,
                    'filter': filter
                },
                success: function (res) {
                    /*
                     * NOTE: 9 FUCKING HOURS
                     * ========= res.success CODES =========*
                     * 1 - NO STRINGS.......SHOW ALL PETS
                     * 2 - NO MATCH FOUND...SHOW NONE
                     * 3 - MATCH FOUND......SHOW RESULTS
                     * ====================================*
                     */

                    switch (res.success) {
                        case 1:
                        {
                            console.log(":: CASE 1 ::");
                            $("#search_result").html(res.result);
                            $(".pet-card").show();
                            break;
                        }
                        case 2:
                        {
                            console.log(":: CASE 2 ::");
                            $("#search_result").html(res.result);
                            $(".pet-card").hide();
                            break;
                        }
                        case 3:
                        {
                            console.log(":: CASE 3 ::");
                            var pet_ids = [];
                            $.each(res.pets, function (index, value) {
                                pet_ids.push(value.pet_id);
                            });
                            $("#search_result").html(res.result);
                            $(".pet-card").hide();
                            $(".pet-card").filter(
                                    function () {
                                        return pet_ids.includes($(".pet_id", this).attr("value"));
                                    }).show();
                            break;
                        }
                        default:
                        {
                            console.log(":: DEFAULT ::");
                            $(".pet-card").show();
                            break;
                        }
                    }
                    console.log(res);
                },
                error: function (res) {
                    swal("Reload", "Something Went Wrong", "error");
                }
            });
        });
        $("#search_text").bind("keyup", function (e) {
            //on letter number
            if (e.which <= 90 && e.which >= 48 || e.which === 8) {
                var search_word = $(this).val();
                var filter = $('#filter_select').val();
                console.log("FILTER = " + filter);
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url() ?>' + "PetAdoption/search_pet_adoptable",
                    "dataType": "JSON",
                    "data": {
                        'search_word': search_word,
                        'filter': filter
                    },
                    success: function (res) {
                        /*
                         * NOTE: 9 FUCKING HOURS
                         * ========= res.success CODES =========*
                         * 1 - NO STRINGS.......SHOW ALL PETS
                         * 2 - NO MATCH FOUND...SHOW NONE
                         * 3 - MATCH FOUND......SHOW RESULTS
                         * ====================================*
                         */

                        switch (res.success) {
                            case 1:
                            {
                                console.log(":: CASE 1 ::");
                                $("#search_result").html(res.result);
                                $(".pet-card").show();
                                break;
                            }
                            case 2:
                            {
                                console.log(":: CASE 2 ::");
                                $("#search_result").html(res.result);
                                $(".pet-card").hide();
                                break;
                            }
                            case 3:
                            {
                                console.log(":: CASE 3 ::");
                                var pet_ids = [];
                                $.each(res.pets, function (index, value) {
                                    pet_ids.push(value.pet_id);
                                });
                                $("#search_result").html(res.result);
                                $(".pet-card").hide();
                                $(".pet-card").filter(
                                        function () {
                                            return pet_ids.includes($(".pet_id", this).attr("value"));
                                        }).show();
                                break;
                            }
                            default:
                            {
                                console.log(":: DEFAULT ::");
                                $(".pet-card").show();
                                break;
                            }
                        }
                        console.log(res);
                    },
                    error: function (res) {
                        swal("Reload", "Something Went Wrong", "error");
                    }
                });
            }
        });
    });
</script>

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
                <div class="row">
                    <div class = "col-lg-12">
                        <center>
                            <h4>No animals yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>
                    </div>
                </div>
            <?php else: ?>
                    <div class ="card-header">
                        <form role = "form" id = "search_form" action = "">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class = "fa fa-search"></i></span>
                                </div>
                                <input id = "search_text" type="text" class="form-control" placeholder="Search the name of pet" aria-label="Pet's Name" aria-describedby="basic-addon2">    
                                <div class="input-group-append">
                                    <select class="custom-select" id="filter_select">
                                        <option selected value = "nofilter">No Filters</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class ="card-body">
                        <span class ="text-muted" id = "search_result"></span>
                        <div class ="row mt-3">
                            <?php foreach ($pets as $animal): ?>
                                <?php $medical = $this->PetAdoption_model->get_animal_medical_records(array("medical_record.pet_id" => $animal->pet_id))[0]; ?>
                                <?php $petAdopters = $this->UserDashboard_model->fetchJoinThreeProgressDesc(array('transaction.pet_id' => $animal->pet_id)); ?>
                                <?php if ($animal->pet_status == 'Adoptable' && $animal->pet_access == 1): ?>
                                <div class ="col-md-4 mb-2 pet-card">
                                    <div class ="d-flex align-items-stretch">
                                        <span class ="d-none pet_id" value = "<?= $animal->pet_id ?>"></span>
                                        <div class="card ">
                                            <a href = "<?= base_url() . $animal->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $animal->pet_name ?></b>">
                                                <img class="card-img-top" src = "<?= base_url() . $animal->pet_picture ?>" alt="<?= $animal->pet_name ?> picture">
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title" value = "<?= $animal->pet_name ?>"><?= $animal->pet_name ?></h5>
                                                <!-- Animal Gender -->
                                                <?php if ($animal->pet_sex == "Male"): ?>
                                                    <small><i class="fa fa-mars"></i> Male</small>
                                                <?php else: ?>
                                                    <small><i class="fa fa-venus"></i> Female</small>
                                                <?php endif; ?>
                                                | 
                                                <!-- Adoption Status -->
                                                <?php if ($animal->pet_status == "Adoptable"): ?>
                                                    <small class = "text-success">Adoptable</small>
                                                <?php elseif ($animal->pet_status == "NonAdoptable"): ?>
                                                    <small class = "text-secondary">Not Adoptable</small>
                                                <?php elseif ($animal->pet_status == "Deceased"): ?>
                                                    <small class = "text-warning">Deceased</small>
                                                <?php else: ?>
                                                    <small class = "text-danger">Adopted</small>
                                                <?php endif; ?>
                                                <p class="card-text"><?= $animal->pet_description ?></p>
                                            </div>
                                            <div class="card-footer text-center">
                                                <div class = "btn-group" role="group" aria-label="Button Group">
                                                    <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $animal->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye"></i> <span class="badge badge-pill badge-secondary"><?= $petAdopters?></span></a>
                                                    <?php if (empty($userInfo)): ?>
                                                        <a href = "<?= base_url() ?>PetAdoption/petAdoptionOnlineForm_exec/<?= $animal->pet_id ?>" class = "btn btn-outline-secondary btn-md"  title="Adopt a Pet"><i class = "fa fa-star"></i></a>
                                                    <?php else: ?>
                                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $animal->pet_id; ?>warning" data-placement="bottom" title="Adopt a Pet"><i class = "fa fa-star"></i></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Detail -->
                                <div class="modal fade <?= $animal->pet_id; ?>detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                                        <img src = "<?= $this->config->base_url() . $animal->pet_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                                                    </div>
                                                    <div class ="col-md-7">
                                                        <table class = "table table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Name: </th>
                                                                    <td><?= $animal->pet_name; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Interested Adopters: </th>
                                                                    <td><?= $petAdopters ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Size: </th>
                                                                    <td><?= $animal->pet_size; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Birthday: </th>
                                                                    <td><?= date("F d, Y", $animal->pet_bday); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Age:</th>
                                                                    <td><?= get_age($animal->pet_bday); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Specie: </th>
                                                                    <td><?= $animal->pet_specie; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Sex: </th>
                                                                    <td><?= $animal->pet_sex; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Breed: </th>
                                                                    <td><?= $animal->pet_breed; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Sterilized: </th>
                                                                    <td><?= $animal->pet_neutered_spayed == 1 ? "Yes" : "No"; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Admission: </th>
                                                                    <td><?= $animal->pet_admission; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Description: </th>
                                                                    <td><?= $animal->pet_description; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Findings: </th>
                                                                    <td><?= $animal->pet_history; ?></td>
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
                                                                <?php if ($animal->pet_video == NULL): ?>
                                                                    <h2>This pet has no Video</h2>
                                                                <?php else: ?>
                                                                    <div class="embed-responsive embed-responsive-16by9 rounded mb-4">
                                                                        <?= wrap_iframe($animal->pet_video); ?>
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
                                <div class="modal fade <?= $animal->pet_id; ?>warning" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
