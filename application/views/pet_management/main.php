<!--===========================
PET MANAGEMENT
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH."views/show_error/show_error.php");?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Pet Management</li>
        </ol>
        <?php include_once 'animal_database.php';?>