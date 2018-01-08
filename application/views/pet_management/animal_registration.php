<!--===========================
Animal Registration
============================-->
<?php 
    function wrap_iframe($src, $method = NULL){
        if($src == ''){
            $new_src = '';
        }else{
            $new_src = '<iframe class="embed-responsive-item" src="'.$src.'" allowfullscreen></iframe>';
            
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
            <li class="breadcrumb-item active">Animal Registration</li>
        </ol>
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        
    </div>
    
    
    <!-- Bootstrap File Upload with preview -->
    <script src = "<?= base_url()?>assets/bootstrap-fileupload/js/file-upload-with-preview.js"></script>
    <script>
        var upload = new FileUploadWithPreview('pet_picture')
    </script>
     <!-- Bootstrap File Upload with preview -->
    <script>
        document.getElementById("pet_picture_edit_preview").style.backgroundImage = "url('<?= base_url().$animal->pet_picture?>')";
        
        document.getElementById("btnReset_edit").onclick = function() {reset_upload()};
        function reset_upload() {
            document.getElementById("pet_picture_edit_preview").style.backgroundImage = "url('<?= base_url().$animal->pet_picture?>')";
            document.getElementById("pet_picture_edit").value = "";
        }   
    </script>
    
    