<!--===========================
SHOW OFFICER INFORMATION
============================-->
<style>
    /* USER PROFILE PAGE */
    #header-card {
        padding: 30px;
        background-color: rgba(214, 224, 226, 0.2);
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    #header-card.hovercard {
        position: relative;
        padding-top: 0;
        overflow: hidden;
        text-align: center;
        background-color: #fff;
        background-color: rgba(255, 255, 255, 1);
    }
    #header-card.hovercard .card-background {
        height: 130px;
    }
    .card-background img {
        -webkit-filter: blur(25px);
        -moz-filter: blur(25px);
        -o-filter: blur(25px);
        -ms-filter: blur(25px);
        filter: blur(25px);
        margin-left: -100px;
        margin-top: -300px;
        min-width: 120%;
    }
    #header-card.hovercard .useravatar {
        position: absolute;
        top: 15px;
        left: 0;
        right: 0;
    }
    #header-card.hovercard .useravatar img {
        width: 100px;
        height: 100px;
        max-width: 100px;
        max-height: 100px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.5);
    }
    #header-card.hovercard .card-info {
        position: absolute;
        bottom: 14px;
        left: 0;
        right: 0;
    }
    #header-card.hovercard .card-info .card-title {
        padding:0 5px;
        font-size: 20px;
        line-height: 1;
        color: #262626;
        background-color: rgba(255, 255, 255, 0.1);
    }
    #header-card.hovercard .card-info {
        overflow: hidden;
        font-size: 12px;
        line-height: 20px;
        color: #737373;
        text-shadow:0px 0px 2px white;
        text-overflow: ellipsis;
    }
    #header-card.hovercard .bottom {
        padding: 0 20px;
        margin-bottom: 17px;
    }

    .counters .sp {
        font-size: 48px;
        display: block;
        color: #2dc997;
    }

    .counters p {
        padding: 0;
        margin: 0 0 20px 0;
        font-family: "Poppins", sans-serif;
        font-size: 14px;
    }
    .nav-pills .nav-link.active{
        background: #ccc;
        color:#737373;
    }

    .nav-pills .nav-link{
        color:#737373;
        border:0;
        background:#eee;
        border-radius:0px;
        border-right: 1px solid white;
        border-left: 1px solid white;
    }
    .nav-pills .nav-link:hover{
        background: #ddd;
    }
    .nav-pills .nav-link.active:hover{
        background: #ccc;
        color:#737373;
    }
    #info_title{
        font-size:20px;
    }
    .borderless td, .borderless th {
        border: none;
    }
    #user_image{
        background:#eee;
        height:250px;
    }
</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>ManageOfficer">Manage Officers</a>
            </li>
            <li class="breadcrumb-item active"><?= $officer->user_firstname . " " . $officer->user_lastname . " Information" ?></li>
        </ol>
        <div class = "row">
            <div class = "col-lg-12 col-sm-12">
                <div id = "header-card" class=" hovercard border border-secondary border-bottom-0 rounded-top">
                    <div class="card-background">
                        <img class="card-bkimg" alt="" src="<?= base_url() . $officer->user_picture ?>">
                    </div>
                    <div class="useravatar">
                        <img alt="" src="<?= base_url() . $officer->user_picture ?>">
                    </div>
                    <div class="card-info"> <span class="card-title"><?= $officer->user_firstname . " " . $officer->user_lastname ?></span></div>
                </div>
            </div>
        </div>
        <div class = "mb-3" >
            <div class="card border border-secondary rounded-bottom border-top-0" style = "border-radius:0px; ">
                <div class = "card-header text-center">
                    <span class = "text-secondary" id = "info_title">Personal Information</span>
                </div>
                <div class="card-body">                    
                    <div class = "row">
                        <div class ="col-lg-4 col-sm-12">
                            <img class="img-fluid img-thumbnail mx-auto d-block" id = "user_image" src="<?= base_url().$officer->user_picture;?>" alt="<?= $officer->user_firstname." ".$officer->user_lastname;?>">
                        </div>
                        <div class ="col-lg-8 col-sm-12">
                            <table class="table borderless table-responsive-sm">
                                <tbody>
                                    <tr>
                                        <th scope="row">Username</th>
                                        <td><?= $officer->user_username;?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Birthday</th>
                                        <td><?= date("F d, Y", $officer->user_bday);?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td><?= $officer->user_email;?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Contact No.</th>
                                        <td><?= $officer->user_contact_no;?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td><?= $officer->user_address.", ".$officer->user_brgy.", ".$officer->user_city;?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class = "row">
            <div class = "col-lg-12 col-sm-12 counters">
                <nav class="nav nav-pills nav-fill my-1" id="user_tab" role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#activities" role="tab" aria-controls="home" aria-selected="true">
                        <span data-toggle="counter-up" class ="sp">
                            <?php
                            if (empty($activities)) {
                                echo "0";
                            } else {
                                echo count($activities);
                            }
                            ?>
                        </span>
                        <p>Activities</p>
                    </a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#modules" role="tab" aria-controls="home" aria-selected="true">
                        <span data-toggle="counter-up" class ="sp">
                            <?php
                            if (empty($module_access)) {
                                echo "0";
                            } else {
                                echo count($module_access);
                            }
                            ?>
                        </span>
                        <p>Modules</p>
                    </a>
                </nav>
                <div class="tab-content" id="user_tab_content">
                    <div class="p-3 tab-pane fade show active" id="activities" role="tabpanel" aria-labelledby="activities-tab">
                        <?php include_once("show_officer_activities.php"); ?>
                    </div>
                    <div class="p-3 tab-pane fade" id="modules" role="tabpanel" aria-labelledby="module-tab">
                        <?php include_once("show_officer_modules.php"); ?>
                    </div>
                </div>
            </div>
        </div>