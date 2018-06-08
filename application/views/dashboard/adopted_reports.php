
<!--===========================
Pet Adopted Reports
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Pet Adopted Reports</li>
        </ol>
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Statistics -->
        <style>
            a:hover{
                text-decoration: none;
            }
        </style>
        <div class="row">
            <div class="col-lg-5">
            </div>
            <div class="col-lg-5">
            </div>
            <div class="col-lg-2">
                <a href = "<?= base_url() ?>AdminDashboard/generate_excel/<?= $year_adopted ?>" class = "btn btn-outline-success">Generate Excel</a>

            </div>
        </div>
        <br>
        <div class="row">
            <?php if (empty($adopted_by_year)): ?>
                <div class = "col-lg-12">
                    <center>
                        <h4>No reports for this year.</h4>
                        <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                    </center>
                </div>
            <?php else: ?>
                <div class = "col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Pet Name</th>
                                    <th>Pet Gender</th>
                                    <th>Pet Specie</th>
                                    <th>Pet Breed</th>
                                    <th>Pet Size</th>
                                    <th>Pet Owner</th>
                                    <th>Adoption Proof</th>
                                    <th>Adopted At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($adopted_by_year as $adopted): ?>

                                    <tr>
                                        <td><?= $adopted->pet_name ?></td>
                                        <td><?= $adopted->pet_sex ?></td>
                                        <td><?= $adopted->pet_specie ?></td>
                                        <td><?= $adopted->pet_breed ?></td>
                                        <td><?= $adopted->pet_size ?></td>
                                        <td><?= $adopted->user_lastname . ", " . $adopted->user_firstname ?></td>
                                        <td style="text-align:center;"><img class="img-responsive" height="20%" src = "<?= $this->config->base_url() . $adopted->adoption_proof_img ?>" ></td>
                                        <td><?= date("F d, Y", $adopted->adoption_adopted_at); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
