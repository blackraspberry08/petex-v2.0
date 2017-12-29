<!--======================
MANAGE ADMIN
=======================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Manage Officers</li>
        </ol>
        <?php include_once 'manage_officer.php';?>