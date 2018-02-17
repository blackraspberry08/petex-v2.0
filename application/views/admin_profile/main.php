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
                            <img src="<?= base_url() . $userDetails->admin_picture ?>" class="img-fluid img-circle">
                        </center>
                    </div>
                    <div class="card-body">
                        <center>
                            <div class="card-title">
                                <h4><?= $userDetails->admin_firstname . " " . $userDetails->admin_lastname ?></h4>
                            </div>
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item"><?= $userDetails->admin_email ?></li>
                                <li class="list-group-item"><?= $userDetails->admin_contact_no ?></li>
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
                        <a class="btn btn-outline-info pull-right" href="<?= base_url() ?>AdminProfile/edit_profile"><i class="fa fa-pencil"></i> Edit Profile</a>

                        <table style="margin-top:55px;" class = "table table-responsive-md table-hover">
                            <tbody>
                                <tr>
                                    <th>Uusername: </th>
                                    <td><?= $userDetails->admin_username ?></td>
                                </tr>
                                <tr>
                                    <th>Firstname: </th>
                                    <td><?= $userDetails->admin_firstname ?></td>
                                </tr>
                                <tr>
                                    <th>Lastname: </th>
                                    <td><?= $userDetails->admin_lastname ?></td>
                                </tr>
                                <tr>
                                    <th>Birthday: </th>
                                    <td><?= date("F d, Y", $userDetails->admin_bday); ?></td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td><?= $userDetails->admin_sex ?></td>
                                </tr>
                                <tr>
                                    <th>Address: </th>
                                    <td><?= $userDetails->admin_address ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Audit Trail
                    </div>
                    <div class="card-body">
                        <?php if (empty($trails)): ?>
                            <center>
                                <h4>No audit trails yet</h4>
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
