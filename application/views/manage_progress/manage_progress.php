<?php
    function getIcon($var) {
        if ($var == 1) {
            echo "fa fa-envelope";
        } else if ($var == 2) {
            echo "fa fa-handshake-o";
        } else if ($var == 3) {
            echo "fa fa-comments";
        } else if ($var == 4) {
            echo "fa fa-eye";
        } else if ($var == 5) {
            echo "fa fa-home";
        } else if ($var == 6) {
            echo "fa fa-check";
        }
    }
?>
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-paw"></i> Manage Progress
    </div>
    <div class="card-body">
        <div class="steps-form">
            <div class="steps-row setup-panel">
                <?php foreach ($progresses as $progress): ?>
                    <div class="steps-step" data-toggle = "tooltip" data-placement = "bottom" title = "<?= $progress->checklist_title ?>">
                        <a id = "step_id_<?= $progress->checklist_id ?>"  href="#step_<?= $progress->checklist_id ?>" class="btn btn-default btn-circle" style="height:45px; width:45px; color:white;"><i class="<?= getIcon($progress->checklist_id) ?> fa-1x"></i><br><?= $progress->checklist_id ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
            <?php foreach ($progresses as $progress): ?>
            <div class="row setup-content" id="step_<?= $progress->checklist_id ?>">
                <div class="col-md-12">
                    <h3 class="font-bold pl-0 my-4"><strong> <?= $progress->checklist_title ?></strong></h3>
                    <div class="row">
                        <div class="col-md-4"><br>
                            <div class="card">
                                <a href = "<?= $this->config->base_url() . $progress->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $progress->pet_name ?></b>">
                                    <img class="card-img-top" src = "<?= $this->config->base_url() . $progress->pet_picture ?>" alt="picture">
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title"><?= $progress->pet_name ?></h4>
                                    <i class="fa fa-calendar"></i> <?= date('M. j, Y', $progress->pet_bday) ?><br>
                                    <?php if ($progress->pet_sex == "Male" || $progress->pet_sex == "male"): ?>
                                        <i class="fa fa-mars" style="color:blue"></i> <?= $progress->pet_sex ?><br>
                                    <?php else: ?>
                                        <i class="fa fa-venus" style="color:red"></i> <?= $progress->pet_sex ?><br>
                                    <?php endif; ?>
                                    <i class="fa fa-paw"></i> <?= $progress->pet_breed ?><br>
                                    <i class="fa fa-check-square" style="color:green"></i> <?= $progress->pet_status ?>
                                </div>

                                <div class="card-footer text-center">
                                    <div class = "btn-group" role="group" aria-label="Button Group">
                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                                        <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $progress->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-8">
                            <p><?= $progress->progress_comment ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Details-->
            <div class="modal fade <?= $progress->pet_id; ?>detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                    <img src = "<?= $this->config->base_url() . $progress->pet_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                                </div>
                                <div class ="col-md-7">
                                    <table class = "table table-responsive table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Name: </th>
                                                <td><?= $progress->pet_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status: </th>
                                                <td><?= $progress->pet_status; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Size: </th>
                                                <td><?= $progress->pet_size; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Birthday: </th>
                                                <td><?= date("F d, Y", $progress->pet_bday); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Age:</th>
                                                <td><?= get_age($progress->pet_bday); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Specie: </th>
                                                <td><?= $progress->pet_specie; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Sex: </th>
                                                <td><?= $progress->pet_sex; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Breed: </th>
                                                <td><?= $progress->pet_breed; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Sterilized: </th>
                                                <td><?= $progress->pet_neutered_spayed == 1 ? "Yes" : "No"; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Admission: </th>
                                                <td><?= $progress->pet_admission; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Description: </th>
                                                <td><?= $progress->pet_description; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Findings: </th>
                                                <td><?= $progress->pet_history; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        
        
        
        
        
        
        
        
        
        
    </div>
</div>