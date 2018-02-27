<!--===========================
Admin Nav Header
============================-->
<style>
    .crop-word{
        max-width:200px;
        overflow: hidden;
        white-space:nowrap;
        text-overflow: ellipsis;
    }
    .li.active{
        background:black !important;
    }
    .dropdown-toggle::after {
        display:none
    }

    .profile-header-img {
        padding: 0px;
    }

    .profile-header-img > img.img-circle {
        height:65px;
        padding:-8px !important;
        border: 2px solid #aaa;
        border-radius: 50%;
    }
    #user-name{
        color:#141414;
        font-size:16px;
    }
    .scrollbar-custom::-webkit-scrollbar-track{
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #eee;
    }

    .scrollbar-custom::-webkit-scrollbar{
        width: 5px;
        background-color: #24282C;
    }

    .scrollbar-custom::-webkit-scrollbar-thumb{
        background-color: #24282C;
    }
    .nav-item .dropdown-menu {
        width: 300px !important;
    }
    .tooltip { pointer-events: none; }

</style>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('.preloader-background').delay(800).fadeOut('slow');
            $('.preloader-wrapper').delay(800).fadeOut();
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        });
    </script>
    <?php include 'preloader.php' ?>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="<?= base_url() ?>main"><img src = "<?= base_url() ?>images/logo/logo.png" height="25"/></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav scrollbar-custom" id="exampleAccordion">
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url() . "AdminDashboard") !== FALSE ? "active" : ""; ?>" data-toggle="tooltip" data-placement = "right" title="Dashboard">
                    <a class="nav-link" href="<?= base_url() ?>AdminDashboard">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url() . "PetManagement") !== FALSE || strpos(base_url(uri_string()), $this->config->base_url() . "ManageProgress") !== FALSE ? "active" : ""; ?>" data-toggle="tooltip" data-placement="right" title="Pet Management">
                    <a class="nav-link" href="<?= base_url() ?>PetManagement">
                        <i class="fa fa-fw fa-paw"></i>
                        <span class="nav-link-text">Pet Management</span>
                    </a>
                </li>
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url() . "RemovedPets") !== FALSE ? "active" : ""; ?>" data-toggle="tooltip" data-placement="right" title="Removed Pets">
                    <a class="nav-link" href="<?= base_url() ?>RemovedPets">
                        <i class="fa fa-fw fa-ban"></i>
                        <span class="nav-link-text">Removed Pets</span>
                    </a>
                </li>
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url() . "Schedules") !== FALSE ? "active" : ""; ?>" data-toggle="tooltip" data-placement="right" title="Schedules">
                    <a class="nav-link" href="<?= base_url() ?>Schedules">
                        <i class="fa fa-fw fa-calendar"></i>
                        <span class="nav-link-text">Schedules</span>
                    </a>
                </li>
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url() . "ManageUser") !== FALSE ? "active" : ""; ?>" data-toggle="tooltip" data-placement="right" title="Manage Users">
                    <a class="nav-link" href="<?= base_url() ?>ManageUser">
                        <i class="fa fa-fw fa-users"></i>
                        <span class="nav-link-text">Manage Users</span>
                    </a>
                </li>
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url() . "ManageOfficer") !== FALSE ? "active" : ""; ?>" data-toggle="tooltip" data-placement="right" title="Manage Admin">
                    <a class="nav-link" href="<?= base_url() ?>ManageOfficer">
                        <i class="fa fa-fw fa-lock"></i>
                        <span class="nav-link-text">Manage Officers</span>
                    </a>
                </li>
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url() . "UserLogs") !== FALSE ? "active" : ""; ?>" data-toggle="tooltip" data-placement="right" title="User Logs">
                    <a class="nav-link" href="<?= base_url() ?>UserLogs">
                        <i class="fa fa-fw fa-key"></i>
                        <span class="nav-link-text">User Logs</span>
                    </a>
                </li>
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url() . "AuditTrail") !== FALSE ? "active" : ""; ?>" data-toggle="tooltip" data-placement="right" title="Audit Trails">
                    <a class="nav-link" href="<?= base_url() ?>AuditTrail">
                        <i class="fa fa-fw fa-list-ul"></i>
                        <span class="nav-link-text">Audit Trail</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto" >

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="crop-word">
                            <?= $user_name ?>&emsp; 
                        </div>       
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class = "dropdown-header">
                            <div class ="row no-gutters">
                                <div class = "col-lg-4 ">
                                    <div class="profile-header-img ">
                                        <img class="img-circle" src="<?= base_url() . $user_picture ?>" />
                                    </div>
                                </div>
                                <div class = "col-lg-8" style = "overflow:hidden;">
                                    <span id = "user-name" data-toggle="tooltip" data-placement="bottom" title="<?= $user_name ?>"><?= $user_name ?></span>
                                    <br>
                                    <span id = "user-access"><?= $user_access ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url() ?>AdminProfile">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url() ?>AdminSettings">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" style = "cursor:pointer;" data-toggle="modal" data-target="#exampleModal">
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
