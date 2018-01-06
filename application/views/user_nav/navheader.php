<!--===========================
User Nav Header
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
    .dropdown-menu {
        width: 300px !important;
    }
</style>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.html"><img src = "<?= base_url()?>images/logo/logo.png" height="25"/></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav scrollbar-custom" id="exampleAccordion">
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url()."UserDashboard") !== FALSE? "active":"" ;?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="<?= base_url()?>UserDashboard">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url()."MyPets") !== FALSE? "active":"" ;?>" data-toggle="tooltip" data-placement="right" title="My Pets">
                    <a class="nav-link" href="<?= base_url()?>MyPets">
                        <i class="fa fa-fw fa-users"></i>
                        <span class="nav-link-text">My Pets</span>
                    </a>
                </li>
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url()."PetAdoption") !== FALSE? "active":"" ;?>" data-toggle="tooltip" data-placement="right" title="Pet Adoption">
                    <a class="nav-link" href="<?= base_url()?>PetAdoption">
                        <i class="fa fa-fw fa-lock"></i>
                        <span class="nav-link-text">Pet Adoption</span>
                    </a>
                </li>
                <li class="nav-item <?= strpos(base_url(uri_string()), $this->config->base_url()."MyProgress") !== FALSE? "active":"" ;?>" data-toggle="tooltip" data-placement="right" title="My Progress">
                    <a class="nav-link" href="<?= base_url()?>MyProgress">
                        <i class="fa fa-fw fa-key"></i>
                        <span class="nav-link-text">My Progress</span>
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
                    <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="d-lg-none">Alerts
                            <span class="badge badge-pill badge-warning">6 New</span>
                        </span>
                        <span class="indicator text-warning d-none d-lg-block">
                            <i class="fa fa-fw fa-circle"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">Notifications:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-success">
                                <strong>
                                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-danger">
                                <strong>
                                    <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-success">
                                <strong>
                                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">View all alerts</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="crop-word">
                            <?= $user_name?>&emsp;   
                        </div>       
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class = "dropdown-header">
                            <div class ="row no-gutters">
                                <div class = "col-lg-4 ">
                                    <div class="profile-header-img ">
                                        <img class="img-circle" src="<?= base_url().$user_picture?>" />
                                    </div>
                                </div>
                                <div class = "col-lg-8" style = "overflow:hidden;">
                                    <span id = "user-name" data-toggle="tooltip" data-placement="bottom" title="<?= $user_name?>"><?= $user_name?></span>
                                    <br>
                                    <span id = "user-access"><?= $user_access?></span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Profiles</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"  style = "cursor:pointer;" data-toggle="modal" data-target="#exampleModal">
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>