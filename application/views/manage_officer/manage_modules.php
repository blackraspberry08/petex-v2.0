<!--======================
MANAGE OFFICER MMODULES
=======================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>ManageOfficer">Manage Officers</a>
            </li>
            <li class="breadcrumb-item active"><?= $officer->user_firstname." ".$officer->user_lastname?> Module Access</li>
        </ol>
        Modules here.