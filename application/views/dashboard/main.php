
<!--===========================
Dashboard
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Dashboard</li>
        </ol>
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Statistics -->
        <style>
            a:hover{
                text-decoration: none;
            }
        </style>
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <a href ="#" data-toggle="modal" data-target=".adoptable"  data-placement="bottom" title="View All Adoptable Animals">
                    <div class="card text-success border-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon pr-3 pt-2">
                                <i class="fa fa-fw fa-paw"></i>
                            </div>
                            <h1 class="mr-5"><?= $adoptable_animals ?></h1>
                        </div>
                        <div class = "card-footer">
                            <span class="float-left">Adoptable Animals</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <a href ="#" data-toggle="modal" data-target=".removed"  data-placement="bottom" title="View All Removed Animals">
                    <div class="card text-success border-success  o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon pr-3 pt-2">
                                <i class="fa fa-fw fa-ban"></i>
                            </div>
                            <h1 class="mr-5"><?= $removed_animals ?></h1>
                        </div>
                        <div class = "card-footer">
                            <span class="float-left">Removed Animals</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <a href ="#" data-toggle="modal" data-target=".adopted"  data-placement="bottom" title="View All Adopted Animals">
                    <div class="card text-success border-success  o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon pr-3 pt-2">
                                <i class="fa fa-fw fa-heart"></i>
                            </div>
                            <h1 class="mr-5"><?= $adopted_animals ?></h1>
                        </div>
                        <div class = "card-footer">
                            <span class="float-left">Adopted Animals</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <a href ="#" data-toggle="modal" data-target=".adopters"  data-placement="bottom" title="View All Pet Adopters">
                    <div class="card text-success border-success  o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon pr-3 pt-2">
                                <i class="fa fa-fw fa-user"></i>
                            </div>
                            <h1 class="mr-5"><?= $pet_adopters ?></h1>
                        </div>
                        <div class = "card-footer">
                            <span class="float-left">Pet Adopters</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <a href ="#" data-toggle="modal" data-target=".nonadoptable"  data-placement="bottom" title="View All Non Adoptable Animals">
                    <div class="card text-success border-success  o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon pr-3 pt-2">
                                <i class="fa fa-fw fa-paw"></i>
                            </div>
                            <h1 class="mr-5"><?= $non_adoptable_animals ?></h1>
                        </div>
                        <div class = "card-footer">
                            <span class="float-left">Non Adoptable Animals</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <a href ="#" data-toggle="modal" data-target=".deceased"  data-placement="bottom" title="View All Deceased Animals">
                    <div class="card text-success border-success  o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-times pr-3 pt-2"></i>
                            </div>
                            <h1 class="mr-5"><?= $deceased_animals ?></h1>
                        </div>
                        <div class = "card-footer">
                            <span class="float-left">Deceased Animals</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <a href ="#" data-toggle="modal" data-target=".transactions"  data-placement="bottom" title="View All Transactions">
                    <div class="card text-success border-success  o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon pr-3 pt-2">
                                <i class="fa fa-fw fa-exchange"></i>
                            </div>
                            <h1 class="mr-5"><?= $transactions ?></h1>
                        </div>
                        <div class = "card-footer">
                            <span class="float-left">Ongoing Transactions</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <a href ="#" data-toggle="modal" data-target=".users"  data-placement="bottom" title="View All Users">
                    <div class="card text-success border-success  o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon pr-3 pt-2">
                                <i class="fa fa-fw fa-users"></i>
                            </div>
                            <h1 class="mr-5"><?= $users ?></h1>
                        </div>
                        <div class = "card-footer">
                            <span class="float-left">Users</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">

            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <a href ="#" data-toggle="modal" data-target=".missing"  data-placement="bottom" title="View All Missing Pets">
                    <div class="card text-success border-success  o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon pr-3 pt-2">
                                <i class="fa fa-fw fa-question"></i>
                            </div>
                            <h1 class="mr-5"><?= $missing_animals ?></h1>
                        </div>
                        <div class = "card-footer">
                            <span class="float-left">Missing Pets</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <a href ="#" data-toggle="modal" data-target=".found"  data-placement="bottom" title="View All Found Pets">
                    <div class="card text-success border-success  o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon pr-3 pt-2">
                                <i class="fa fa-fw fa-eye"></i>
                            </div>
                            <h1 class="mr-5"><?= $found_animals ?></h1>
                        </div>
                        <div class = "card-footer">
                            <span class="float-left">Found Pets</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <!-- Example Doughnut Chart Card-->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-pie-chart"></i> Animals Status</div>
                    <div class="card-body">
                        <canvas id="myDoughnutChart" width="100%" height="100">
                        </canvas>
                    </div>
                </div>
            </div>
            <div class = "col-lg-4 align-self-center text-center">
                <h6 class = "lead">TOTAL ANIMALS IN PAWS</h6>
                <h1 class = "display-1">
                    <?= $pets; ?>
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
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-area-chart"></i> Adopted Animals in 2018</div>
                    <div class="card-body">
                        <canvas id="myAreaChart" width="100%" height="30"></canvas>
                    </div>
                </div>
            </div>
            <div class = "col-lg-12">
                <?php include_once (APPPATH . "views/userlogs/userlogs.php"); ?>
            </div>
            <div class = "col-lg-12">
                <?php include_once (APPPATH . "views/audit_trail/audit_trail.php"); ?>
            </div>
        </div>
    </div>
    <!-- Modal Adoptable -->
    <div class="modal fade adoptable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class = "fa fa-paw"></i> Adoptable Animals</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (empty($alladoptable)): ?>
                        <center>
                            <h4>No Adoptable Animal/s Yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>

                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Added at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alladoptable as $adoptable): ?>
                                        <tr>
                                            <td><?= $adoptable->pet_name ?></td>
                                            <td><?= $adoptable->pet_status ?></td>
                                            <td><?= date('F d, Y \a\t h:m A', $adoptable->pet_added_at); ?></td>
                                            <td>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href = "<?= base_url() ?>PetManagement/animal_info_exec/<?= $adoptable->pet_id; ?>" class = "btn btn-outline-primary">Show Information</a>
                                        </div>
                                    </center>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Removed -->
    <div class="modal fade removed" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-fw fa-ban"></i> Removed Animals</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (empty($allremoved)): ?>
                        <center>
                            <h4>No Removed Animal/s Yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>

                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Added at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allremoved as $removed): ?>
                                        <tr>
                                            <td><?= $removed->pet_name ?></td>
                                            <td><?= $removed->pet_status ?></td>
                                            <td><?= date('F d, Y \a\t h:m A', $removed->pet_added_at); ?></td>
                                            <td>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href = "<?= base_url() ?>PetManagement/animal_info_exec/<?= $removed->pet_id; ?>" class = "btn btn-outline-primary">Show Information</a>
                                        </div>
                                    </center>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Adopted -->
    <div class="modal fade adopted" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class = "fa fa-heart"></i> Adopted Animals</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (empty($alladopted)): ?>
                        <center>
                            <h4>No Adopted Animal/s Yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>

                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Pet Name</th>
                                        <th>Owner Name</th>
                                        <th>Adopted at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alladopted as $adopted): ?>
                                        <tr>
                                            <td><?= $adopted->pet_name ?></td>
                                            <td><?= $adopted->user_lastname . ', ' . $adopted->user_firstname ?> </td>
                                            <td><?= date('F d, Y \a\t h:m A', $adopted->adoption_adopted_at); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Adopters -->
    <div class="modal fade adopters" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class = "fa fa-user"></i> Pet Adopter/s</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (empty($alladopters)): ?>
                        <center>
                            <h4>No Pet Adopter/s Yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>

                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Owner Name</th>
                                        <th>Pet Name</th>
                                        <th>Adopted at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alladopters as $adopters): ?>
                                        <tr>
                                            <td><?= $adopters->user_lastname . ', ' . $adopters->user_firstname ?> </td>
                                            <td><?= $adopters->pet_name ?></td>
                                            <td><?= date('F d, Y \a\t h:m A', $adopters->adoption_adopted_at); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Non Adoptable -->
    <div class="modal fade nonadoptable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class = "fa fa-paw"></i> Non Adoptable Animal/s</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (empty($allnonadoptable)): ?>
                        <center>
                            <h4>No Non Adoptable Animal/s Yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>

                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Owner Name</th>
                                        <th>Pet Name</th>
                                        <th>Adopted at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allnonadoptable as $nonadoptable): ?>
                                        <tr>
                                            <td><?= $nonadoptable->pet_name ?></td>
                                            <td><?= $nonadoptable->pet_status ?></td>
                                            <td><?= date('F d, Y \a\t h:m A', $nonadoptable->pet_added_at); ?></td>
                                            <td>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href = "<?= base_url() ?>PetManagement/animal_info_exec/<?= $nonadoptable->pet_id; ?>" class = "btn btn-outline-primary">Show Information</a>
                                        </div>
                                    </center>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Deceased -->
    <div class="modal fade deceased" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class = "fa fa-times"></i> Deceased Animal/s</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (empty($alldeceased)): ?>
                        <center>
                            <h4>No Deceased Animal/s Yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>

                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Added at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alldeceased as $deceased): ?>
                                        <tr>
                                            <td><?= $deceased->pet_name ?></td>
                                            <td><?= $deceased->pet_status ?></td>
                                            <td><?= date('F d, Y \a\t h:m A', $deceased->pet_added_at); ?></td>
                                            <td>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href = "<?= base_url() ?>PetManagement/animal_info_exec/<?= $deceased->pet_id; ?>" class = "btn btn-outline-primary">Show Information</a>
                                        </div>
                                    </center>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Transnaction -->
    <div class="modal fade transactions" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-fw fa-exchange"></i>Transaction/s</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (empty($alltransactions)): ?>
                        <center>
                            <h4>No Transaction/s Yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>

                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Owner Name</th>
                                        <th>Pet Name</th>
                                        <th>Progress (%)</th>
                                        <th>Started at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alltransactions as $transactions): ?>
                                        <tr>
                                            <td><?= $transactions->user_lastname . ', ' . $transactions->user_firstname ?> </td>
                                            <td><?= $transactions->pet_name ?></td>
                                            <td><?= $transactions->transaction_progress ?></td>
                                            <td><?= date('F d, Y \a\t h:m A', $transactions->transaction_started_at); ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Users -->
    <div class="modal fade users" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-fw fa-users"></i>All Users</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (empty($allusers)): ?>
                        <center>
                            <h4>No users yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>

                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Added at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allusers as $user): ?>
                                        <tr>
                                            <td><?= $user->user_firstname . " " . $user->user_lastname ?></td>
                                            <td><?= $user->user_status == 1 ? "Active" : "Inactive"; ?></td>
                                            <td><?= date('F d, Y \a\t h:m A', $user->user_added_at); ?></td>
                                            <td>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href = "<?= base_url() ?>ManageUser/show_user_info_exec/<?= $user->user_id ?>" class = "btn btn-outline-primary">Show Information</a>
                                        </div>
                                    </center>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Missing -->
    <div class="modal fade missing" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-fw fa-question"></i>Missing Pets</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (empty($allMissing)): ?>
                        <center>
                            <h4>No Missing Pet/s yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>

                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Added at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allMissing as $missing): ?>
                                        <tr>
                                            <td><?= $missing->pet_name ?></td>
                                            <td><?= $missing->pet_status ?></td>
                                            <td><?= date('F d, Y \a\t h:m A', $missing->pet_added_at); ?></td>
                                            <td>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href = "<?= base_url() ?>PetManagement/animal_info_exec/<?= $missing->pet_id; ?>" class = "btn btn-outline-primary">Show Information</a>
                                        </div>
                                    </center>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Found -->
    <div class="modal fade found" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-fw fa-eye"></i>All Found Pets</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (empty($allFound)): ?>
                        <center>
                            <h4>No Found Pet/s yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>

                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered datatable-class" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Added at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allFound as $found): ?>
                                        <tr>
                                            <td><?= $found->pet_name ?></td>
                                            <td><?= $found->pet_status ?></td>
                                            <td><?= date('F d, Y \a\t h:m A', $found->pet_added_at); ?></td>
                                            <td>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href = "<?= base_url() ?>PetManagement/animal_info_exec/<?= $found->pet_id; ?>" class = "btn btn-outline-primary">Show Information</a>
                                        </div>
                                    </center>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
