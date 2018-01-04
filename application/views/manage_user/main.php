<!--======================
MANAGE USERS
=======================-->
<div class="content-wrapper">
    <?php include_once (APPPATH."views/show_error/show_error.php");?>
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Manage Users</li>
        </ol>  
        <?php include_once 'manage_user.php';?>