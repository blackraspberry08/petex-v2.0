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
function determine_access($access){
    switch ($access){
        case "Admin":{
            return "Administrator";
        }
        case "Subadmin":{
            return "PAWS Officer";
        }
        case "User":{
            return "Pet Adopter";
        }
        default:{
            return "";
        }
    }
}
?>
<style>
    .image-fit{
        padding:5px;
        object-fit: contain;
    }
    .image-fit img{
        width:55px;
        height:55px;
        border-radius: 50%;
    }
</style>
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

        <!-- Adoption Form  --> 
        <div class="row setup-content" id="step_1">
            <?php include_once 'step_1.php';?>  
        </div>

        <!--  Meet And Greet -->  
        <div class="row setup-content" id="step_2">
            <?php include_once 'step_2.php';?>
        </div>

        <!--  Interview  --> 
        <div class="row setup-content" id="step_3">
            <?php include_once 'step_3.php';?>
        </div>

        <!--  Home Visit --> 
        <div class="row setup-content" id="step_4">
            <?php include_once 'step_4.php';?>
        </div>

        <!--  Visit chosen adoptee -->  
        <div class="row setup-content" id="step_5">
            <?php include_once 'step_5.php';?>
        </div>

        <!-- Release day -->
        <div class="row setup-content" id="step_6">
            <?php include_once 'step_6.php';?>
        </div>
    </div>
</div>

<!-- Bootstrap File Upload with preview -->
<script src = "https://unpkg.com/file-upload-with-preview"></script>
<script>
    var upload = new FileUploadWithPreview('adoption_form');
</script>

<!-- Textbox autoresize -->

<script src = "<?= base_url()?>assets/autosize-master/js/autosize.js"></script>
<script>
    // from a jQuery collection
    autosize($('textarea'));
</script>