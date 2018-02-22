<!--===========================
Profile
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>UserDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
        <!-- Registered -->
        <div class="row">
            <div class="col-md-3">   
                <div class="card">
                    <div class="card-header">
                        <center>
                            <img src="<?= base_url() . $userDetails->user_picture ?>" class="img-fluid img-circle">
                        </center>
                    </div>
                    <div class="card-body">
                        <center>
                            <div class="card-title">
                                <h4><?= $userDetails->user_firstname . " " . $userDetails->user_lastname ?></h4>
                            </div>
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item"><?= $userDetails->user_email ?></li>
                                <li class="list-group-item"><?= $userDetails->user_contact_no ?></li>
                            </ul>
                        </center>
                    </div>
                </div>
                <br>
            </div> 
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fa fa-user"></i> About</h5>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-outline-info pull-right" href="<?= base_url() ?>Profile/edit_profile"><i class="fa fa-pencil"></i> Edit Profile</a>

                        <table style="margin-top:55px;" class = "table table-responsive-md table-hover">
                            <tbody>
                                <tr>
                                    <th>Username: </th>
                                    <td><?= $userDetails->user_username ?></td>
                                </tr>
                                <tr>
                                    <th>Firstname: </th>
                                    <td><?= $userDetails->user_firstname ?></td>
                                </tr>
                                <tr>
                                    <th>Lastname: </th>
                                    <td><?= $userDetails->user_lastname ?></td>
                                </tr>
                                <tr>
                                    <th>Birthday: </th>
                                    <td><?= date("F d, Y", $userDetails->user_bday); ?></td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td><?= $userDetails->user_sex ?></td>
                                </tr>
                                <tr>
                                    <th>Address: </th>
                                    <td><?= $userDetails->user_address ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fa fa-history"></i> Records</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4 col-sm-6 mb-3" style="height:50%; margin-top:100px; ">
                                <div class="card text-success border-success  o-hidden h-100">
                                    <div class="card-body">
                                        <div class="card-body-icon pr-3 pt-2">
                                            <i class="fa fa-fw fa-exchange"></i>
                                        </div>
                                        <h1 class="counter"><?= $transactions ?></h1>
                                    </div>
                                    <div class = "card-footer">
                                        <span class="float-left">My Transactions</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Example Doughnut Chart Card-->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <i class="fa fa-pie-chart"></i> My Pets</div>
                                    <div class="card-body">
                                        <canvas id="mypets" width="100%" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 mb-3" style="height:50%; margin-top:100px; ">
                                <div class="card text-success border-success  o-hidden h-100">
                                    <div class="card-body">
                                        <div class="card-body-icon pr-3 pt-2">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </div>
                                        <h1 class="counter"><?= $missing ?></h1>
                                    </div>
                                    <div class = "card-footer">
                                        <span class="float-left">Missing Pets</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Activities
                    </div>
                    <div class="card-body">
                        <?php if (empty($trails)): ?>
                            <center>
                                <h4>No activities yet</h4>
                                <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                            </center>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Activity</th>
                                    <th>Access</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($trails as $trail): ?>
                                    <?php if ($trail->user_id != ""): ?>
                                        <tr>
                                            <td><?= $trail->user_firstname . " " . $trail->user_lastname ?></td>
                                            <td><?= $trail->event_description ?></td>
                                            <td>Pet Adopter</td>
                                            <td>
                                                <span style = "display:none;"><?= $trail->event_added_at ?></span>
                                                <?= date('F d, Y \a\t h:m A', $trail->event_added_at); ?>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td><?= $trail->admin_firstname . " " . $trail->admin_lastname ?></td>
                                            <td><?= $trail->event_description ?></td>
                                            <td><?= $trail->admin_access == "Subadmin" ? "PAWS Officer" : "Administrator"; ?></td>
                                            <td>
                                                <span style = "display:none;"><?= $trail->event_added_at ?></span>
                                                <?= date('F d, Y \a\t h:m A', $trail->event_added_at); ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
    <br>
</div>
</div>
</div>
