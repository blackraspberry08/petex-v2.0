<style> 
    .card-img-top {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
</style>
    <div class="card-group">
        <div class="row">
        <?php if(empty($all_animals)):?>
        <div class = "col-lg-12">
            <center>
                <h4>No animals yet</h4>
                <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
            </center>
        </div>
        <?php else:?>
            <?php foreach ($all_animals as $animal):?>
                <div class="col-md-4 col-xs-6 my-3">
                    <div class="card">
                        <a href = "<?= base_url().$animal->pet_picture?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $animal->pet_name?></b>">
                            <img class="card-img-top" src = "<?= base_url().$animal->pet_picture?>" alt="<?= $animal->pet_name?> picture">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?= $animal->pet_name?></h5>
                            <!-- Animal Gender -->
                                <?php if($animal->pet_sex == "Male"):?>
                                <small><i class="fa fa-mars"></i> Male</small>
                                <?php else:?>
                                <small><i class="fa fa-venus"></i> Female</small>
                                <?php endif;?>
                                | 
                            <!-- Adoption Status -->
                                <?php if($animal->pet_status == "Adoptable"):?>
                                <small class = "text-success">Adoptable</small>
                                <?php elseif($animal->pet_status == "NonAdoptable"):?>
                                <small class = "text-secondary">Not Adoptable</small>
                                <?php else:?>
                                <small class = "text-danger">Adopted</small>
                                <?php endif;?>
                            <p class="card-text"><?= $animal->pet_description?></p>
                        </div>
                        <div class="card-footer text-center">
                            <div class = "btn-group" role="group" aria-label="Button Group">
                                <a href = "<?= base_url()?>PetManagement/medical_records_exec/<?= $animal->pet_id;?>" class = "btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Medical Records"><i class = "fa fa-stethoscope fa-2x"></i></a>
                                <a href = "<?= base_url()?>PetManagement/animal_info_exec/<?= $animal->pet_id;?>" class = "btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Animal Information"><i class = "fa fa-paw fa-2x"></i></a>
                                <a href = "<?= base_url()?>PetManagement/interested_adopters_exec/<?= $animal->pet_id;?>" class = "btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Interested Adopters"><i class = "fa fa-heart fa-2x"></i></a>
                                <a href = "#" class = "btn btn-outline-danger" data-toggle="modal" data-target = "#remove_animal_<?= $animal->pet_id?>" title="Remove Animal"><i class = "fa fa-times fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <?php foreach ($all_animals as $animal):?>
        <div class="modal fade" id="remove_animal_<?= $animal->pet_id?>" tabindex="-1" role="dialog" aria-labelledby="VerificationModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="VerificationModal">Remove Animal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong><?= $animal->pet_name?></strong> will be removed from the animal database. Don't worry, <?= $animal->pet_sex == "Male"? "he":"she";?> can be restored back at "Removed Pet" link.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href ="<?= base_url()?>PetManagement/remove_animal_exec/<?= $animal->pet_id?>" class="btn btn-danger">Remove Pet</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
        <?php endif;?>
    </div>
    
</div>

