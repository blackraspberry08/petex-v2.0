<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?= $title ?></title>
  <link rel="shortcut icon" href="<?= $this->config->base_url() ?>images/logo/icon.png">
  <!-- JQUERY -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <!-- Bootstrap core CSS-->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- Page level plugin CSS-->
  <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
   <!-- Timeline CSS Files-->
   <link rel ="stylesheet" href = "<?= base_url()?>assets/timeline/timeline.css">
   <!-- Bootstrap Switch -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
   <!-- Bootstrap Lightbox-->
   <link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
   <!-- Bootstrap Datepicker -->
   <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/smalot-bootstrap-datetimepicker/2.4.4/css/bootstrap-datetimepicker.min.css">
   <!-- Bootstrap File Upload with preview -->
   <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">
   <!-- AnimateCss -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
   <!-- Full Calendar -->
   <link rel ="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.2/fullcalendar.css">
   <!-- SweetAlert -->
   <link rel = "stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
   
   <!-- Custom styles for this template-->
   <link href="<?= base_url()?>assets/admin/css/sb-admin.css" rel="stylesheet">
   <style>
       button{
           cursor:pointer;
       }
       .custom-file-container__image-clear{
            visibility:hidden;
        }
   </style>
   <script>
        function show_error(form_error, field) {
            if(form_error !== "" || typeof form_error === undefined){
                $(field).siblings(".invalid-feedback").remove();
                $(field).after("<div class = 'invalid-feedback'>"+form_error+"</div>");
                $(field).removeClass("is-invalid").addClass("is-invalid");
            }else{
                $(field).siblings(".invalid-feedback").remove();
                $(field).removeClass("is-invalid");
            }
        }
   </script>
</head>
