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
        <!-- Adoption Form  --> 
        <div class="row setup-content" id="step_1">
            <?php if(empty($adoption_form->adoption_form_location)):?>
            <div class = "col-lg-12 mt-3 text-center">
                <div class = "mb-5">
                    <h4>No Adoption Form Submitted</h4>
                    <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                </div>
                <div class = "mt-5">
                    <span class = "text-secondary">If submitted manually</span><br>
                    <div class = "btn-group mt-2" role="group" aria-label="Actions">
                        <a href = "#" data-toggle = "modal" data-target = "#upload_adoption_form" class = "btn btn-outline-primary"><i class = "fa fa-upload"></i> Upload</a>
                        <a href = "#" data-toggle = "modal" data-target = "#manual_input" class = "btn btn-outline-primary"><i class = "fa fa-keyboard-o"></i> Manual Input</a>
                    </div>
                </div>
            </div>
            <!-- Upload Adoption Form -->
            <div class="modal fade" id="upload_adoption_form" tabindex="-1" role="dialog" aria-labelledby="uploadAdoptionForm" aria-hidden="true">
                <form enctype="multipart/form-data" method = "POST" action = "<?= base_url()?>ManageProgress/upload_adoption_form/<?= $transaction->transaction_id?>">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class = "fa fa-upload"></i> Upload Adoption Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                    <div class = "form-group">
                                        <label for ="adoption_form">Adoption Form</label>
                                        <div class="custom-file-container" data-upload-id="adoption_form">
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" name = "adoption_form" id = "adoption_form_add" class="custom-file-container__custom-file__custom-file-input" accept="application/pdf" required>
                                                <input type="hidden" name="MAX_FILE_SIZE" value = "10485760"/>
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                <button class="custom-file-container__image-clear">x</button>
                                            </label>
                                            <div class="custom-file-container__image-preview" id = "adoption_form_preview"></div>
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- MANUAL INPUT -->
            <div class="modal fade" id="manual_input" tabindex="-1" role="dialog" aria-labelledby="uploadAdoptionForm" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class = "fa fa-keyboard-o"></i> Manual Input</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php include_once 'adoption_form.php';?> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php else:?>
            <div class="embed-responsive embed-responsive-16by9 mx-3 my-5 rounded">
                <iframe class="embed-responsive-item" src="<?= base_url().$adoption_form->adoption_form_location?>" allowfullscreen type="application/pdf"></iframe>
            </div>
            <?php endif;?>   
        </div>
            

    </div>
</div>

<!-- Bootstrap File Upload with preview -->
<script src = "https://unpkg.com/file-upload-with-preview"></script>
<script>
    var upload = new FileUploadWithPreview('adoption_form')
</script>

 <!-- Bootstrap File Upload with preview -->
