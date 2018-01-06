<a href = "<?= $this->config->base_url() . $adoptedPets->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $adoptedPets->pet_name ?></b>">
                                    <img class="card-img-top" src = "<?= $this->config->base_url() . $adoptedPets->pet_picture ?>" alt="picture">
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title"><?= $adoptedPets->pet_name ?></h4>
                                    <i class="fa fa-calendar"></i> <?= date('M. j, Y', $adoptedPets->pet_bday) ?><br>
                                    <?php if ($adoptedPets->pet_sex == "Male" || $adoptedPets->pet_sex == "male"): ?>
                                        <i class="fa fa-mars" style="color:blue"></i> <?= $adoptedPets->pet_sex ?><br>
                                    <?php else: ?>
                                        <i class="fa fa-venus" style="color:red"></i> <?= $adoptedPets->pet_sex ?><br>
                                    <?php endif; ?>
                                    <i class="fa fa-paw"></i> <?= $adoptedPets->pet_breed ?><br>
                                    <i class="fa fa-check-square" style="color:green"></i> <?= $adoptedPets->pet_status ?>
                                </div>