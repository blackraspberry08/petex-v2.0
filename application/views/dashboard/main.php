<!--===========================
Dashboard
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Dashboard</li>
        </ol>
        <?php include_once (APPPATH."views/show_error/show_error.php");?>
        <!-- Statistics -->
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-success border-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon pr-3 pt-2">
                            <i class="fa fa-fw fa-paw"></i>
                        </div>
                        <h1 class="mr-5"><?= $adoptable_animals?></h1>
                    </div>
                    <div class = "card-footer">
                        <span class="float-left">Adoptable Animals</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-success border-success  o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon pr-3 pt-2">
                            <i class="fa fa-fw fa-ban"></i>
                        </div>
                        <h1 class="mr-5"><?= $removed_animals?></h1>
                    </div>
                    <div class = "card-footer">
                        <span class="float-left">Removed Animals</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-success border-success  o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon pr-3 pt-2">
                            <i class="fa fa-fw fa-heart"></i>
                        </div>
                        <h1 class="mr-5"><?= $adopted_animals?></h1>
                    </div>
                    <div class = "card-footer">
                        <span class="float-left">Adopted Animals</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-success border-success  o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon pr-3 pt-2">
                            <i class="fa fa-fw fa-user"></i>
                        </div>
                        <h1 class="mr-5"><?= $pet_adopters?></h1>
                    </div>
                    <div class = "card-footer">
                        <span class="float-left">Pet Adopters</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-success border-success  o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon pr-3 pt-2">
                            <i class="fa fa-fw fa-paw"></i>
                        </div>
                        <h1 class="mr-5"><?= $non_adoptable_animals?></h1>
                    </div>
                    <div class = "card-footer">
                        <span class="float-left">Non Adoptable Animals</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-success border-success  o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-times pr-3 pt-2"></i>
                        </div>
                        <h1 class="mr-5"><?= $deceased_animals?></h1>
                    </div>
                    <div class = "card-footer">
                        <span class="float-left">Deceased Animals</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-success border-success  o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon pr-3 pt-2">
                            <i class="fa fa-fw fa-exchange"></i>
                        </div>
                        <h1 class="mr-5"><?= $transactions?></h1>
                    </div>
                    <div class = "card-footer">
                        <span class="float-left">Ongoing Transactions</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-success border-success  o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon pr-3 pt-2">
                            <i class="fa fa-fw fa-users"></i>
                        </div>
                        <h1 class="mr-5"><?= $users?></h1>
                    </div>
                    <div class = "card-footer">
                        <span class="float-left">Number of Users</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4">
                <!-- Example Doughnut Chart Card-->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-pie-chart"></i> Animals Status</div>
                    <div class="card-body">
                        <canvas id="myDoughnutChart" width="100%" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class = "col-lg-4 align-self-center text-center">
                <h6 class = "lead">TOTAL ANIMALS IN PAWS</h6>
                <h1 class = "display-1">
                    25
                </h1>
            </div>
            <div class="col-lg-4">
                <!-- Example Pie Chart Card-->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-pie-chart"></i> Types of Animals in PAWS</div>
                    <div class="card-body">
                        <canvas id="myPieChart" width="100%" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class = "col-lg-12">
                <?php include_once (APPPATH."views/userlogs/userlogs.php"); ?>
            </div>
            <div class = "col-lg-12">
                <?php include_once (APPPATH."views/audit_trail/audit_trail.php");?>
            </div>
        </div>
    </div>