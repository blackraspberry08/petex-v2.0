<script>
    $(document).ready(function(){
        $("#filter_select").on("change", function() {
            var search_word = $("#search_text").val();
            var filter = $(this).val();
            console.log("FILTER = " + filter);
            $.ajax({
                "method": "POST",
                "url": '<?= base_url() ?>' + "RemovedPets/search_pet_removed",
                "dataType": "JSON",
                "data": {
                    'search_word': search_word,
                    'filter' : filter
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

                    switch(res.success){
                        case 1:{
                                console.log(":: CASE 1 ::");
                                $("#search_result").html(res.result);
                                $(".pet-card").show();
                                break;
                        }
                        case 2:{
                                console.log(":: CASE 2 ::");
                                $("#search_result").html(res.result);
                                $(".pet-card").hide();
                                break;
                        }
                        case 3:{
                                console.log(":: CASE 3 ::");
                                var pet_ids = [];
                                $.each(res.pets, function( index, value ) {
                                     pet_ids.push(value.pet_id);
                                });
                                $("#search_result").html(res.result);
                                $(".pet-card").hide();
                                $(".pet-card").filter(
                                        function(){
                                            return pet_ids.includes($(".pet_id", this).attr("value"));
                                        }).show();
                                break;
                        }
                        default:{
                                console.log(":: DEFAULT ::");
                                $(".pet-card").show();
                                break;
                        }
                    }
                    console.log(res);
                },
                error: function(res){
                    swal("Reload", "Something Went Wrong", "error");
                }
            });
        });
        $("#search_text").bind("keyup", function(e) {
            //on letter number
            if (e.which <= 90 && e.which >= 48 || e.which === 8){
                var search_word = $(this).val();
                var filter = $('#filter_select').val();
                console.log("FILTER = " + filter);
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url() ?>' + "RemovedPets/search_pet_removed",
                    "dataType": "JSON",
                    "data": {
                        'search_word': search_word,
                        'filter' : filter
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
                        
                        switch(res.success){
                            case 1:{
                                    console.log(":: CASE 1 ::");
                                    $("#search_result").html(res.result);
                                    $(".pet-card").show();
                                    break;
                            }
                            case 2:{
                                    console.log(":: CASE 2 ::");
                                    $("#search_result").html(res.result);
                                    $(".pet-card").hide();
                                    break;
                            }
                            case 3:{
                                    console.log(":: CASE 3 ::");
                                    var pet_ids = [];
                                    $.each(res.pets, function( index, value ) {
                                         pet_ids.push(value.pet_id);
                                    });
                                    $("#search_result").html(res.result);
                                    $(".pet-card").hide();
                                    $(".pet-card").filter(
                                            function(){
                                                return pet_ids.includes($(".pet_id", this).attr("value"));
                                            }).show();
                                    break;
                            }
                            default:{
                                    console.log(":: DEFAULT ::");
                                    $(".pet-card").show();
                                    break;
                            }
                        }
                        console.log(res);
                    },
                    error: function(res){
                        swal("Reload", "Something Went Wrong", "error");
                    }
                });
            }
        });
    });
</script>
<style> 
    .card-img-top {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
</style>
        <?php if (empty($removed_animals)): ?>
    <div class="row">
        <div class = "col-lg-12">
            <center>
                <h4>No animals yet</h4>
                <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
            </center>
        </div>
    </div>
<?php else: ?>
    <div class ="card">
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
                            <option value="Adoptable">Adoptable</option>
                            <option value="Adopted">Adopted</option>
                            <option value="Deceased">Deceased</option>
                            <option value="Non Adoptable">Non Adoptable </option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class ="card-body">
            <span class ="text-muted" id = "search_result"></span>
            <div class ="row mt-3">
                <?php foreach ($removed_animals as $animal): ?>
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
                                        <a href = "<?= base_url() ?>PetManagement/medical_records_exec/<?= $animal->pet_id; ?>" class = "btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Medical Records"><i class = "fa fa-stethoscope fa-2x"></i></a>
                                        <a href = "<?= base_url() ?>PetManagement/animal_info_exec/<?= $animal->pet_id; ?>" class = "btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Animal Information"><i class = "fa fa-paw fa-2x"></i></a>

                                        <?php if ($animal->pet_status == "Adopted"): ?>
                                            <a href = "<?= base_url() ?>PetManagement/adoption_information_exec/<?= $animal->pet_id; ?>" class = "btn btn-outline-success" data-toggle="tooltip" data-placement="bottom" title="Adoption Info"><i class = "fa fa-heart fa-2x"></i></a>
                                        <?php else: ?>
                                            <a href = "<?= base_url() ?>PetManagement/interested_adopters_exec/<?= $animal->pet_id; ?>" class = "btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Interested Adopters"><i class = "fa fa-heart fa-2x"></i></a>
                                        <?php endif; ?>
                                        <a href = "#" class = "btn btn-outline-danger" data-toggle="modal" data-target = "#remove_animal_<?= $animal->pet_id ?>" title="Remove Animal"><i class = "fa fa-times fa-2x"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="remove_animal_<?= $animal->pet_id ?>" tabindex="-1" role="dialog" aria-labelledby="VerificationModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="VerificationModal">Remove Animal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <strong><?= $animal->pet_name ?></strong> will be removed from the animal database. Don't worry, <?= $animal->pet_sex == "Male" ? "he" : "she"; ?> can be restored back at "Removed Pets" link.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href ="<?= base_url() ?>PetManagement/remove_animal_exec/<?= $animal->pet_id ?>" class="btn btn-danger">Remove Pet</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>