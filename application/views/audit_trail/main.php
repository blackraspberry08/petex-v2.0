<!--===========================
Audit Trail
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Audit Trail</li>
        </ol>
        <?php include_once (APPPATH."views/show_error/show_error.php");?>
        <?php include_once "audit_trail.php";?>
    </div>