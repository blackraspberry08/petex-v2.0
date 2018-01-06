<!--===========================
Animal Information
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>PetManagement">Pet Management</a>
            </li>
            <li class="breadcrumb-item active"><?= $animal->pet_name;?>'s Information</li>
        </ol>
        <?php include_once (APPPATH."views/show_error/show_error.php");?>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> <?= $animal->pet_name;?>'s Information
            </div>
            <div class="card-body">
                dsa
            </div>
        </div>
    </div>