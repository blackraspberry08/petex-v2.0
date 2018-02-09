<?php
//echo $this->db->last_query();
//echo "<pre>";
//print_r($userInfo);
//echo "</pre>";
//die;
?>
<?php

function getIcon($var) {
    if ($var == 1) {
        echo "fa fa-envelope";
    } else if ($var == 2) {
        echo "fa fa-handshake-o";
    } else if ($var == 3) {
        echo "fa fa-comments";
    } else if ($var == 4) {
        echo "fa fa-eye";
    } else if ($var == 5) {
        echo "fa fa-home";
    } else if ($var == 6) {
        echo "fa fa-check";
    }
}

function determine_access($access) {
    switch ($access) {
        case "Admin": {
                return "Administrator";
            }
        case "Subadmin": {
                return "PAWS Officer";
            }
        case "User": {
                return "Pet Adopter";
            }
        default: {
                return "";
            }
    }
}

function wrap_iframe($src) {
    if ($src == '') {
        $new_src = '';
    } else {
        $new_src = '<iframe class="embed-responsive-item" src="' . $src . '" allowfullscreen></iframe>';
    }
    return $new_src;
}
?>
<!--===========================
My Progress
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>UserDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Progress</li>
        </ol>
        <!-- My Pets -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-history"></i> My Progress
            </div>
            <?php if (empty($progress)): ?>
                <div class = "col-lg-12">
                    <center>
                        <h4>You have no Progress yet</h4>
                        <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                    </center>
                </div>
            <?php else: ?>
                <!-- Steps form -->
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center font-bold"></h2>
                        <div class="steps-form">
                            <div class="steps-row setup-panel">
                                <?php foreach ($progress as $progress): ?>
                                    <div class="steps-step">
                                        <a id = "step_id_<?= $progress->checklist_id ?>" href="#step_<?= $progress->checklist_id ?>"  class="btn btn-default btn-circle" style="height:45px; width:45px; color:white;"><i class="<?= getIcon($progress->checklist_id) ?> fa-1x"></i><br><?= $progress->checklist_id ?></a>
                                        <p><small><?= $progress->checklist_title ?></small></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Adoption Form  --> 
                        <div class="row setup-content" id="step_1">
                            <?php include_once 'step_1.php'; ?>  
                        </div>

                        <!--  Meet And Greet -->  
                        <div class="row setup-content" id="step_2">
                            <?php include_once 'step_2.php'; ?>
                        </div>

                        <!--  Interview  --> 
                        <div class="row setup-content" id="step_3">
                            <?php include_once 'step_3.php'; ?>
                        </div>

                        <!--  Home Visit --> 
                        <div class="row setup-content" id="step_4">
                            <?php include_once 'step_4.php'; ?>
                        </div>

                        <!--  Visit chosen adoptee -->  
                        <div class="row setup-content" id="step_5">
                            <?php include_once 'step_5.php'; ?>
                        </div>

                        <!-- Release day -->
                        <div class="row setup-content" id="step_6">
                            <?php include_once 'step_6.php'; ?>
                        </div>
                    </div>

                </div>
            <?php endif; ?>
            <!-- Steps form -->
        </div><br>
    </div>
</div>
</div>


<script>
    $(document).ready(function () {
        switch (<?= $transaction_progress ?>) {
            case 0:
            {
                $("#step_id_1").addClass("active");
                $("#step_id_2").addClass("disabled");
                $("#step_id_3").addClass("disabled");
                $("#step_id_4").addClass("disabled");
                $("#step_id_5").addClass("disabled");
                $("#step_id_6").addClass("disabled");
                break;
            }
            case 16:
            {
                $("#step_id_1").addClass("bg-success");
                $("#step_id_2").addClass("active");
                $("#step_id_3").addClass("disabled");
                $("#step_id_4").addClass("disabled");
                $("#step_id_5").addClass("disabled");
                $("#step_id_6").addClass("disabled");
                $("#step_id_6").addClass("disabled");

                break;
            }
            case 32:
            {
                $("#step_id_1").addClass("bg-success");
                $("#step_id_2").addClass("bg-success");
                $("#step_id_3").addClass("active");
                $("#step_id_4").addClass("disabled");
                $("#step_id_5").addClass("disabled");
                $("#step_id_6").addClass("disabled");
                break;
            }
            case 49:
            {
                $("#step_id_1").addClass("bg-success");
                $("#step_id_2").addClass("bg-success");
                $("#step_id_3").addClass("bg-success");
                $("#step_id_4").addClass("active");
                $("#step_id_5").addClass("disabled");
                $("#step_id_6").addClass("disabled");
                break;
            }
            case 66:
            {
                $("#step_id_1").addClass("bg-success");
                $("#step_id_2").addClass("bg-success");
                $("#step_id_3").addClass("bg-success");
                $("#step_id_4").addClass("bg-success");
                $("#step_id_5").addClass("active");
                $("#step_id_6").addClass("disabled");
                break;
            }
            case 83:
            {
                $("#step_id_1").addClass("bg-success");
                $("#step_id_2").addClass("bg-success");
                $("#step_id_3").addClass("bg-success");
                $("#step_id_4").addClass("bg-success");
                $("#step_id_5").addClass("bg-success");
                $("#step_id_6").addClass("active");
                break;
            }
            case 100:
            {
                $("#step_id_1").addClass("bg-success");
                $("#step_id_2").addClass("bg-success");
                $("#step_id_3").addClass("bg-success");
                $("#step_id_4").addClass("bg-success");
                $("#step_id_5").addClass("bg-success");
                $("#step_id_6").addClass("bg-success");
                break;
            }
            default:
            {
                $("#step_id_1").addClass("disabled");
                $("#step_id_2").addClass("disabled");
                $("#step_id_3").addClass("disabled");
                $("#step_id_4").addClass("disabled");
                $("#step_id_5").addClass("disabled");
                $("#step_id_6").addClass("disabled");
                break;
            }
        }
    });

</script>