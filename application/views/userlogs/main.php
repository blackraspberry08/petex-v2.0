<!--===========================
User Logs
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url()?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">User Logs</li>
        </ol>
        <?php if(empty($logs)):?>
        <div class = "col-xs-12" style = "margin-top:30px;">
            <center>
                <h4>No user logs yet</h4>
                <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
            </center>
        </div>
        <?php else:?>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> User Logs</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Activity</th>
                                <th>Access</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($logs as $log):?>
                            <tr>
                                <td><?= $log->user_firstname." ".$log->user_lastname?></td>
                                <td><?= $log->event_description?></td>
                                <td><?= $log->user_access?></td>
                                <td><?= $log->event_added_at?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
        <?php endif;?>


