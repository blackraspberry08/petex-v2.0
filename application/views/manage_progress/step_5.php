<style>
    .hide{
        display:none;
    }
    .label.label-success{
        background-color: #5cb85c;
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }
    .disabled{
        cursor:not-allowed;
    }
</style>

<?php
$schedule_5 = $this->ManageProgress_model->get_schedule(array("schedule.progress_id" => $progress_5->progress_id, "schedule.transaction_id" => $transaction->transaction_id));
?>

<?php if (!empty($schedule_5)): ?>
    <?php
    $sched_1 = $schedule_5[0];
    $sched_2 = $schedule_5[1];
    $sched_3 = $schedule_5[2];
    ?>


    <script>
        $(document).ready(function () {
            $('.approve_5').attr("disabled", "disabled");
            $('.approve_5').addClass("disabled");
    <?php if ($progress_5->progress_percentage == 0): ?>
                $('#done_sched_<?= $sched_1->schedule_id ?>').removeClass("disabled");
                $('#done_sched_<?= $sched_1->schedule_id ?>').prop("disabled", false);
    <?php elseif ($progress_5->progress_percentage == 33): ?>
                //INTERVIEW #1 is DONE!
                $('#done_sched_<?= $sched_1->schedule_id ?>').removeClass("btn-outline-dark");
                $('#done_sched_<?= $sched_1->schedule_id ?>').addClass("disabled btn-outline-success");
                $('#done_sched_<?= $sched_1->schedule_id ?>').attr("disabled", "disabled");
                $('#done_sched_<?= $sched_1->schedule_id ?>').html("<i class = 'fa fa-check'></i> Schedule is done");
                $('#done_sched_<?= $sched_2->schedule_id ?>').removeClass("disabled");
                $('#done_sched_<?= $sched_2->schedule_id ?>').prop("disabled", false);
                $('#return_sched_<?= $sched_1->schedule_id ?>').removeClass("d-none");
                $('.return_5').attr("disabled", "disabled");
                $('.return_5').addClass("disabled");
    <?php elseif ($progress_5->progress_percentage == 66): ?>
                //INTERVIEW #2 is DONE!
                $('#done_sched_<?= $sched_1->schedule_id ?>').removeClass("btn-outline-dark");
                $('#done_sched_<?= $sched_1->schedule_id ?>').addClass("disabled btn-outline-success");
                $('#done_sched_<?= $sched_1->schedule_id ?>').attr("disabled", "disabled");
                $('#done_sched_<?= $sched_1->schedule_id ?>').html("<i class = 'fa fa-check'></i> Schedule is done");
                $('#done_sched_<?= $sched_2->schedule_id ?>').removeClass("btn-outline-dark");
                $('#done_sched_<?= $sched_2->schedule_id ?>').addClass("disabled btn-outline-success");
                $('#done_sched_<?= $sched_2->schedule_id ?>').attr("disabled", "disabled");
                $('#done_sched_<?= $sched_2->schedule_id ?>').html("<i class = 'fa fa-check'></i> Schedule is done");
                $('#done_sched_<?= $sched_3->schedule_id ?>').removeClass("disabled");
                $('#done_sched_<?= $sched_3->schedule_id ?>').prop("disabled", false);
                $('#return_sched_<?= $sched_2->schedule_id ?>').removeClass("d-none");
                $('.return_5').attr("disabled", "disabled");
                $('.return_5').addClass("disabled");
    <?php elseif ($progress_5->progress_percentage == 100): ?>
                //INTERVIEW #3 is DONE!
                $('#done_sched_<?= $sched_1->schedule_id ?>').removeClass("btn-outline-dark");
                $('#done_sched_<?= $sched_1->schedule_id ?>').addClass("disabled btn-outline-success");
                $('#done_sched_<?= $sched_1->schedule_id ?>').attr("disabled", "disabled");
                $('#done_sched_<?= $sched_1->schedule_id ?>').html("<i class = 'fa fa-check'></i> Schedule is done");
                $('#done_sched_<?= $sched_2->schedule_id ?>').removeClass("btn-outline-dark");
                $('#done_sched_<?= $sched_2->schedule_id ?>').addClass("disabled btn-outline-success");
                $('#done_sched_<?= $sched_2->schedule_id ?>').attr("disabled", "disabled");
                $('#done_sched_<?= $sched_2->schedule_id ?>').html("<i class = 'fa fa-check'></i> Schedule is done");
                $('#done_sched_<?= $sched_3->schedule_id ?>').removeClass("btn-outline-dark");
                $('#done_sched_<?= $sched_3->schedule_id ?>').addClass("disabled btn-outline-success");
                $('#done_sched_<?= $sched_3->schedule_id ?>').attr("disabled", "disabled");
                $('#done_sched_<?= $sched_3->schedule_id ?>').html("<i class = 'fa fa-check'></i> Schedule is done");
                $('#return_sched_<?= $sched_3->schedule_id ?>').removeClass("d-none");
                $(".approve_5").prop("disabled", false);
                $(".approve_5").removeClass("disabled");
                $(".approve_5").css("cursor", "pointer");
                $('.return_5').attr("disabled", "disabled");
                $('.return_5').addClass("disabled");
    <?php endif; ?>

            //IF ANIMAL IS ADOPTED, NO RETURN BUTTON
    <?php if ($transaction->pet_status == "Adopted"): ?>
                $('#return_sched_<?= $sched_1->schedule_id ?>').addClass("d-none");
                $('#return_sched_<?= $sched_2->schedule_id ?>').addClass("d-none");
                $('#return_sched_<?= $sched_3->schedule_id ?>').addClass("d-none");
    <?php endif; ?>

            //Functions here
            $('#modal_done_sched_<?= $sched_1->schedule_id ?>').click(function () {
                $('#done_sched_<?= $sched_1->schedule_id ?>').removeClass("btn-outline-dark");
                $('#done_sched_<?= $sched_1->schedule_id ?>').addClass("disabled btn-outline-success");
                $('#done_sched_<?= $sched_1->schedule_id ?>').attr("disabled", "disabled");
                $('#done_sched_<?= $sched_1->schedule_id ?>').html("<i class = 'fa fa-check'></i> Schedule is done");
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url() ?>' + "ManageProgress/step_5/<?= $transaction->transaction_id ?>",
                    "dataType": "JSON",
                    "data": {
                        'event_type': "done_sched_1",
                        'visit_adoptee_1': $('#visit_adoptee_1').val()
                    },
                    success: function (res) {
                        if (res.success) {
                            swal({title: "Success", text: res.result, type: "success"},
                                    function () {
                                        location.reload();
                                    }
                            );
                        } else {
                            swal("Error", res.result, "error");

                        }
                    },
                    error: function (res) {
                        swal("Reload", "Something went wrong. Reload your browser.", "error");
                    }
                });
            });
            $('#modal_done_sched_<?= $sched_2->schedule_id ?>').click(function () {
                $('#done_sched_<?= $sched_2->schedule_id ?>').removeClass("btn-outline-dark");
                $('#done_sched_<?= $sched_2->schedule_id ?>').addClass("disabled btn-outline-success");
                $('#done_sched_<?= $sched_2->schedule_id ?>').attr("disabled", "disabled");
                $('#done_sched_<?= $sched_2->schedule_id ?>').html("<i class = 'fa fa-check'></i> Schedule is done");
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url() ?>' + "ManageProgress/step_5/<?= $transaction->transaction_id ?>",
                    "dataType": "JSON",
                    "data": {
                        'event_type': "done_sched_2",
                        'visit_adoptee_2': $('#visit_adoptee_2').val()
                    },
                    success: function (res) {
                        if (res.success) {
                            swal({title: "Success", text: res.result, type: "success"},
                                    function () {
                                        location.reload();
                                    }
                            );
                        } else {
                            swal("Error", res.result, "error");
                        }
                    },
                    error: function (res) {
                        swal("Reload", "Something went wrong. Reload your browser.", "error");
                    }
                });
            });
            $('#modal_done_sched_<?= $sched_3->schedule_id ?>').click(function () {
                $('#done_sched_<?= $sched_3->schedule_id ?>').removeClass("btn-outline-dark");
                $('#done_sched_<?= $sched_3->schedule_id ?>').addClass("disabled btn-outline-success");
                $('#done_sched_<?= $sched_3->schedule_id ?>').attr("disabled", "disabled");
                $('#done_sched_<?= $sched_3->schedule_id ?>').html("<i class = 'fa fa-check'></i> Schedule is done");
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url() ?>' + "ManageProgress/step_5/<?= $transaction->transaction_id ?>",
                    "dataType": "JSON",
                    "data": {
                        'event_type': "done_sched_3",
                        'visit_adoptee_3': $('#visit_adoptee_3').val()
                    },
                    success: function (res) {
                        if (res.success) {
                            swal({title: "Success", text: res.result, type: "success"},
                                    function () {
                                        location.reload();
                                    }
                            );
                        } else {
                            swal("Error", res.result, "error");
                        }
                    },
                    error: function (res) {
                        swal("Reload", "Something went wrong. Reload your browser.", "error");
                    }
                });
            });

            //RETURN FUNCTIONS
            $('#return_sched_<?= $sched_1->schedule_id ?>').click(function () {
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url() ?>' + "ManageProgress/step_5_return_exec/<?= $transaction->transaction_id ?>",
                    "dataType": "JSON",
                    "data": {
                        'event_type': "return_sched_1",
                        'progress_id': <?= $progress_5->progress_id ?>
                    },
                    success: function (res) {
                        if (res.success) {
                            swal({title: "Success", text: res.result, type: "success"},
                                    function () {
                                        location.reload();
                                    }
                            );
                        } else {
                            swal("Error", res.result, "error");

                        }
                    },
                    error: function (res) {
                        swal("Reload", "Something went wrong. Reload your browser.", "error");
                    }
                });
            });
            $('#return_sched_<?= $sched_2->schedule_id ?>').click(function () {
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url() ?>' + "ManageProgress/step_5_return_exec/<?= $transaction->transaction_id ?>",
                    "dataType": "JSON",
                    "data": {
                        'event_type': "return_sched_2",
                        'progress_id': <?= $progress_5->progress_id ?>
                    },
                    success: function (res) {
                        if (res.success) {
                            swal({title: "Success", text: res.result, type: "success"},
                                    function () {
                                        location.reload();
                                    }
                            );
                        } else {
                            swal("Error", res.result, "error");

                        }
                    },
                    error: function (res) {
                        swal("Reload", "Something went wrong. Reload your browser.", "error");
                    }
                });
            });

            $('#return_sched_<?= $sched_3->schedule_id ?>').click(function () {
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url() ?>' + "ManageProgress/step_5_return_exec/<?= $transaction->transaction_id ?>",
                    "dataType": "JSON",
                    "data": {
                        'event_type': "return_sched_3",
                        'progress_id': <?= $progress_5->progress_id ?>
                    },
                    success: function (res) {
                        if (res.success) {
                            swal({title: "Success", text: res.result, type: "success"},
                                    function () {
                                        location.reload();
                                    }
                            );
                        } else {
                            swal("Error", res.result, "error");

                        }
                    },
                    error: function (res) {
                        swal("Reload", "Something went wrong. Reload your browser.", "error");
                    }
                });
            });

            $('#step_5_return').click(function () {
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url() ?>' + "ManageProgress/step_5_return_exec/",
                    "dataType": "JSON",
                    "data": {
                        'event_type': "step_5_return",
                        'progress_id': '<?= $progress_4->progress_id ?>',
                        'transaction_id': '<?= $transaction->transaction_id ?>'
                    },
                    success: function (res) {
                        if (res.success) {
                            swal({title: "Success", text: res.result, type: "success"},
                                    function () {
                                        location.reload();
                                    }
                            );
                        } else {
                            swal("Error", res.result, "error");

                        }
                    },
                    error: function (res) {
                        swal("Reload", "Something went wrong. Reload your browser.", "error");
                    }
                });
            });


            //approve
            $('#step_5_approve').click(function () {
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url() ?>' + "ManageProgress/step_5/<?= $transaction->transaction_id ?>",
                    "dataType": "JSON",
                    "data": {
                        'schedule_title': "Release Day : <?= $transaction->user_firstname . " " . $transaction->user_lastname ?>",
                        'schedule_desc': "Visiting Chosen Adoptee is done! Release Day will be the next step for <?= $transaction->user_firstname . " " . $transaction->user_lastname ?> to adopt <?= $transaction->pet_name ?>. <?= $transaction->user_firstname . " " . $transaction->user_lastname ?> can now get your chosen adoptee to PAWS",
                        'schedule_color': "#1e7e34",
                        'schedule_startdate': $("#event_startdate_step_5").val(),
                        'schedule_starttime': $("#event_starttime_step_5").val(),
                        'schedule_enddate': $("#event_enddate_step_5").val(),
                        'schedule_endtime': $("#event_endtime_step_5").val(),
                        'comment': $("#comment_step_5").val(),
                        'event_type': "approve"
                    },
                    success: function (res) {
                        if (res.success) {
                            swal({title: "Success", text: res.result, type: "success"},
                                    function () {
                                        location.reload();
                                    }
                            );
                        } else {
                            swal("Error", res.result, "error");
                            show_error(res.startdate, $("#event_startdate_step_5"));
                            show_error(res.starttime, $("#event_starttime_step_5"));
                            show_error(res.enddate, $("#event_enddate_step_5"));
                            show_error(res.endtime, $("#event_endtime_step_5"));
                            show_error(res.comment, $("#comment_step_5"));
                            console.log(res);
                        }
                    },
                    error: function (res) {
                        swal("Reload", "Something went wrong. Reload your browser.", "error");
                        console.log(res);
                    }
                });

            });
        });
    </script>

    <div class = "col-lg-12">
        <h3 class = "mt-3 text-center">Visiting Chosen Adoptee</h3>
        <p class = "text-muted">&emsp;<?= $progress_5->checklist_desc ?></p>

        <?php if (!empty($schedule_5)): ?>
            <div class = "row">
                <div class = "col-md-4">
                    <div class="card border-dark mb-3 mx-auto text-center">
                        <div class="card-header">
                            <i class = "fa fa-clock-o fa-5x"></i>
                            <br>
                            <h5 class = "text-muted">Schedule</h5>
                        </div>
                        <div class="card-header">
                            <div class ="row">
                                <div class = "col-md-6">
                                    <h6>Start</h6>
                                    <span style = "font-size:12px;"><?= date('F d, Y', $sched_1->schedule_startdate) ?></span><br>
                                    <span style = "font-size:12px;"><?= date('h:i A', $sched_1->schedule_startdate) ?></span>
                                </div>
                                <div class = "col-md-6">
                                    <h6>End</h6>
                                    <span style = "font-size:12px;"><?= date('F d, Y', $sched_1->schedule_enddate) ?></span><br>
                                    <span style = "font-size:12px;"><?= date('h:i A', $sched_1->schedule_enddate) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-dark">
                            <h6 class="card-title"><?= $sched_1->schedule_title ?></h6>
                            <p class="card-text"><?= $sched_1->schedule_desc ?></p>
                        </div>
                        <?php $visit_adoptee_1_remarks = $this->ManageProgress_model->get_visit_adoptee($progress_5->progress_id, 33)[0]; ?>

                        <?php if (!empty($visit_adoptee_1_remarks)): ?>
                            <div class ="card-body text-dark">
                                <button class = "btn btn-outline-primary" data-toggle = "modal" data-target = "#visit_adoptee_1" >See Remarks</button>
                            </div>
                            <div class="modal fade" id="visit_adoptee_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="eventHeader"> Visiting Chosen Adoptee #1</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <h6>Remarks: </h6>
                                            <p><?= $visit_adoptee_1_remarks->visit_adoptee_remarks_content ?></p>

                                            <div class ="row">
                                                <div class = "col-sm-6">
                                                    <div class="media">
                                                        <div class = "image-fit">
                                                            <a href = "<?= base_url() . $visit_adoptee_1_remarks->user_picture ?>" data-toggle="lightbox">
                                                                <img class="d-flex mr-1" src="<?= base_url() . $visit_adoptee_1_remarks->user_picture ?>" alt = "<?= $visit_adoptee_1_remarks->user_firstname . " " . $visit_adoptee_1_remarks->user_lastname ?>">
                                                            </a>
                                                        </div>
                                                        <div class="media-body text-left">
                                                            <h6>Interviewee:</h6>
                                                            <small class="font-weight-bold text-muted"><?= $visit_adoptee_1_remarks->user_firstname . " " . $visit_adoptee_1_remarks->user_lastname ?></small><br>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-sm-6">
                                                    <div class="media">
                                                        <div class="media-body text-right">
                                                            <h6>Interviewer:</h6>
                                                            <small class="font-weight-bold text-muted"><?= $visit_adoptee_1_remarks->admin_firstname . " " . $visit_adoptee_1_remarks->admin_lastname ?></small><br>
                                                            <small class = "text-muted"><?= date('F d, Y', $visit_adoptee_1_remarks->visit_adoptee_remarks_added_at) ?></small><br>
                                                            <small class = "text-muted"><?= date('h:m A', $visit_adoptee_1_remarks->visit_adoptee_remarks_added_at) ?></small>
                                                        </div>
                                                        <div class = "image-fit">
                                                            <a href = "<?= base_url() . $visit_adoptee_1_remarks->admin_picture ?>" data-toggle="lightbox">
                                                                <img class="d-flex ml-1" src="<?= base_url() . $visit_adoptee_1_remarks->admin_picture ?>" alt = "<?= $visit_adoptee_1_remarks->admin_firstname . " " . $visit_adoptee_1_remarks->admin_lastname ?>">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($transaction->transaction_dropped_at != 0): ?>

                        <?php else: ?>
                            <div class = "card-footer">
                                <button id = "return_sched_<?= $sched_1->schedule_id ?>" class = "btn btn-outline-danger d-none" >Return</button>
                                <button id = "done_sched_<?= $sched_1->schedule_id ?>" data-toggle = "modal" data-target = "#modal_<?= $sched_1->schedule_id ?>" class = "btn btn-outline-dark disabled" disabled>Done</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- MODAL FOR DONE SCHED 1 -->
                <div class="modal fade" id="modal_<?= $sched_1->schedule_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form id = "visit_adoptee_1_remarks_form" method = "POST" role = "form">
                        <!-- Displayed Fields -->
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eventHeader"> Leave a remark on Visiting Chosen Adoptee #1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class = "form-row">
                                        <label for="visit_adoptee_1">Remarks</label>
                                        <textarea class = "form-control" id = "visit_adoptee_1" name = "visit_adoptee_1" placeholder = "What happenned on the visit?" required=""></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" id = "modal_done_sched_<?= $sched_1->schedule_id ?>" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class = "col-md-4">
                    <div class="card border-dark mb-3 mx-auto text-center">
                        <div class="card-header">
                            <i class = "fa fa-clock-o fa-5x"></i>
                            <br>
                            <h5 class = "text-muted">Schedule</h5>
                        </div>
                        <div class="card-header">
                            <div class ="row">
                                <div class = "col-md-6">
                                    <h6>Start</h6>
                                    <span style = "font-size:12px;"><?= date('F d, Y', $sched_2->schedule_startdate) ?></span><br>
                                    <span style = "font-size:12px;"><?= date('h:i A', $sched_2->schedule_startdate) ?></span>
                                </div>
                                <div class = "col-md-6">
                                    <h6>End</h6>
                                    <span style = "font-size:12px;"><?= date('F d, Y', $sched_2->schedule_enddate) ?></span><br>
                                    <span style = "font-size:12px;"><?= date('h:i A', $sched_2->schedule_enddate) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-dark">
                            <h6 class="card-title"><?= $sched_2->schedule_title ?></h6>
                            <p class="card-text"><?= $sched_2->schedule_desc ?></p>
                        </div>
                        <?php $visit_adoptee_2_remarks = $this->ManageProgress_model->get_visit_adoptee($progress_5->progress_id, 66)[0]; ?>
                        <?php if (!empty($visit_adoptee_2_remarks)): ?>
                            <div class ="card-body text-dark">
                                <button class = "btn btn-outline-primary" data-toggle = "modal" data-target = "#visit_adoptee_2" >See Remarks</button>
                            </div>
                            <div class="modal fade" id="visit_adoptee_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="eventHeader"> Visiting Chosen Adoptee #2</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <h6>Remarks: </h6>
                                            <p><?= $visit_adoptee_2_remarks->visit_adoptee_remarks_content ?></p>

                                            <div class ="row">
                                                <div class = "col-sm-6">
                                                    <div class="media">
                                                        <div class = "image-fit">
                                                            <a href = "<?= base_url() . $visit_adoptee_2_remarks->user_picture ?>" data-toggle="lightbox">
                                                                <img class="d-flex mr-1" src="<?= base_url() . $visit_adoptee_2_remarks->user_picture ?>" alt = "<?= $visit_adoptee_2_remarks->user_firstname . " " . $visit_adoptee_2_remarks->user_lastname ?>">
                                                            </a>
                                                        </div>
                                                        <div class="media-body text-left">
                                                            <h6>Interviewee:</h6>
                                                            <small class="font-weight-bold text-muted"><?= $visit_adoptee_2_remarks->user_firstname . " " . $visit_adoptee_2_remarks->user_lastname ?></small><br>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-sm-6">
                                                    <div class="media">
                                                        <div class="media-body text-right">
                                                            <h6>Interviewer:</h6>
                                                            <small class="font-weight-bold text-muted"><?= $visit_adoptee_2_remarks->admin_firstname . " " . $visit_adoptee_2_remarks->admin_lastname ?></small><br>
                                                            <small class = "text-muted"><?= date('F d, Y', $visit_adoptee_2_remarks->visit_adoptee_remarks_added_at) ?></small><br>
                                                            <small class = "text-muted"><?= date('h:m A', $visit_adoptee_2_remarks->visit_adoptee_remarks_added_at) ?></small>
                                                        </div>
                                                        <div class = "image-fit">
                                                            <a href = "<?= base_url() . $visit_adoptee_2_remarks->admin_picture ?>" data-toggle="lightbox">
                                                                <img class="d-flex ml-1" src="<?= base_url() . $visit_adoptee_2_remarks->admin_picture ?>" alt = "<?= $visit_adoptee_2_remarks->admin_firstname . " " . $visit_adoptee_2_remarks->admin_lastname ?>">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($transaction->transaction_dropped_at != 0): ?>

                        <?php else: ?>
                            <div class = "card-footer">
                                <button id = "return_sched_<?= $sched_2->schedule_id ?>" class = "btn btn-outline-danger d-none" >Return</button>
                                <button id = "done_sched_<?= $sched_2->schedule_id ?>" data-toggle = "modal" data-target = "#modal_<?= $sched_2->schedule_id ?>" class = "btn btn-outline-dark disabled" disabled>Done</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- MODAL FOR DONE SCHED 2 -->
                <div class="modal fade" id="modal_<?= $sched_2->schedule_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form id = "visit_adoptee_2_remarks_form" method = "POST" role = "form">
                        <!-- Displayed Fields -->
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eventHeader"> Leave a remark on Visiting Chosen Adoptee #2</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class = "form-row">
                                        <label for="visit_adoptee_2">Remarks</label>
                                        <textarea class = "form-control" id = "visit_adoptee_2" name = "visit_adoptee_2" placeholder = "What happenned on the visit?" required=""></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" id = "modal_done_sched_<?= $sched_2->schedule_id ?>" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class = "col-md-4">
                    <div class="card border-dark mb-3 mx-auto text-center">
                        <div class="card-header">
                            <i class = "fa fa-clock-o fa-5x"></i>
                            <br>
                            <h5 class = "text-muted">Schedule</h5>
                        </div>
                        <div class="card-header">
                            <div class ="row">
                                <div class = "col-md-6">
                                    <h6>Start</h6>
                                    <span style = "font-size:12px;"><?= date('F d, Y', $sched_3->schedule_startdate) ?></span><br>
                                    <span style = "font-size:12px;"><?= date('h:i A', $sched_3->schedule_startdate) ?></span>
                                </div>
                                <div class = "col-md-6">
                                    <h6>End</h6>
                                    <span style = "font-size:12px;"><?= date('F d, Y', $sched_3->schedule_enddate) ?></span><br>
                                    <span style = "font-size:12px;"><?= date('h:i A', $sched_3->schedule_enddate) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-dark">
                            <h6 class="card-title"><?= $sched_3->schedule_title ?></h6>
                            <p class="card-text"><?= $sched_3->schedule_desc ?></p>
                        </div>
                        <?php $visit_adoptee_3_remarks = $this->ManageProgress_model->get_visit_adoptee($progress_5->progress_id, 100)[0]; ?>
                        <?php if (!empty($visit_adoptee_3_remarks)): ?>
                            <div class ="card-body text-dark">
                                <button class = "btn btn-outline-primary" data-toggle = "modal" data-target = "#visit_adoptee_3" >See Remarks</button>
                            </div>
                            <div class="modal fade" id="visit_adoptee_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="eventHeader"> Visiting Chosen Adoptee #3</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <h6>Remarks: </h6>
                                            <p><?= $visit_adoptee_3_remarks->visit_adoptee_remarks_content ?></p>

                                            <div class ="row">
                                                <div class = "col-sm-6">
                                                    <div class="media">
                                                        <div class = "image-fit">
                                                            <a href = "<?= base_url() . $visit_adoptee_3_remarks->user_picture ?>" data-toggle="lightbox">
                                                                <img class="d-flex mr-1" src="<?= base_url() . $visit_adoptee_3_remarks->user_picture ?>" alt = "<?= $visit_adoptee_3_remarks->user_firstname . " " . $visit_adoptee_3_remarks->user_lastname ?>">
                                                            </a>
                                                        </div>
                                                        <div class="media-body text-left">
                                                            <h6>Interviewee:</h6>
                                                            <small class="font-weight-bold text-muted"><?= $visit_adoptee_3_remarks->user_firstname . " " . $visit_adoptee_3_remarks->user_lastname ?></small><br>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-sm-6">
                                                    <div class="media">
                                                        <div class="media-body text-right">
                                                            <h6>Interviewer:</h6>
                                                            <small class="font-weight-bold text-muted"><?= $visit_adoptee_3_remarks->admin_firstname . " " . $visit_adoptee_3_remarks->admin_lastname ?></small><br>
                                                            <small class = "text-muted"><?= date('F d, Y', $visit_adoptee_3_remarks->visit_adoptee_remarks_added_at) ?></small><br>
                                                            <small class = "text-muted"><?= date('h:m A', $visit_adoptee_3_remarks->visit_adoptee_remarks_added_at) ?></small>
                                                        </div>
                                                        <div class = "image-fit">
                                                            <a href = "<?= base_url() . $visit_adoptee_3_remarks->admin_picture ?>" data-toggle="lightbox">
                                                                <img class="d-flex ml-1" src="<?= base_url() . $visit_adoptee_3_remarks->admin_picture ?>" alt = "<?= $visit_adoptee_3_remarks->admin_firstname . " " . $visit_adoptee_3_remarks->admin_lastname ?>">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($transaction->transaction_dropped_at != 0): ?>

                        <?php else: ?>
                            <div class = "card-footer">
                                <button id = "return_sched_<?= $sched_3->schedule_id ?>" class = "btn btn-outline-danger d-none" >Return</button>
                                <button id = "done_sched_<?= $sched_3->schedule_id ?>" data-toggle = "modal" data-target = "#modal_<?= $sched_3->schedule_id ?>" class = "btn btn-outline-dark disabled" disabled>Done</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- MODAL FOR DONE SCHED 3 -->
                <div class="modal fade" id="modal_<?= $sched_3->schedule_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form id = "visit_adoptee_3_remarks_form" method = "POST" role = "form">
                        <!-- Displayed Fields -->
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eventHeader"> Leave a remark on Visiting Chosen Adoptee #3</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class = "form-row">
                                        <label for="visit_adoptee_3">Remarks</label>
                                        <textarea class = "form-control" id = "visit_adoptee_3" name = "visit_adoptee_3" placeholder = "What happenned on the visit?" required=""></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" id = "modal_done_sched_<?= $sched_3->schedule_id ?>" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Comment -->
        <?php if (!empty($comments_step_5)): ?>
            <!-- There are recent comments -->
            <div class="card mb-3">
                <div class ="card-header">
                    <i class = "fa fa-comment" ></i> Remarks
                </div>

                <?php foreach ($comments_step_5 as $comment): ?>
                    <div class="card-body small bg-faded">    
                        <div class="media">
                            <div class = "image-fit">
                                <img class="d-flex mr-3" src="<?= base_url() . $comment->progress_comment_picture ?>" alt="">
                            </div>
                            <div class="media-body">
                                <h6 class="mt-0 mb-1"><?= $comment->progress_comment_sender ?></h6>
                                <span class = "text-muted"><strong><?= determine_access($comment->progress_comment_sender_access) ?></strong></span>&emsp;|&emsp;<span class = "text-muted"><?= date('F d, Y \a\t h:m A', $comment->progress_comment_added_at) ?></span><br>
                                <div class = "my-2">
                                    <?= $comment->progress_comment_content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if ($progress_5->progress_isSuccessful == 1): ?>
                    <div class ="card-footer">
                        <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                    </div>
                <?php else: ?>
                    <?php if ($transaction->transaction_dropped_at != 0): ?>

                    <?php else: ?>
                        <div class="card-footer small text-muted text-center">
                            <div class="btn-group" role="group" aria-label="Approval">
                                <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger return_5" data-toggle = "modal"  title = "Return to Step 4" data-target = "#step_5_sched_return"><i class = "fa fa-chevron-left"></i> Return to Step 4</button>     
                                <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-secondary" data-toggle = "modal"  title = "Leave a remark" data-target = "#step_5_sched_disapprove"><i class = "fa fa-comment"></i> Leave a remark</button>     
                                <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary approve_5" data-toggle = "modal"  title = "Proceed to Step 6" data-target = "#step_5_sched_approve"><i class = "fa fa-chevron-right"></i> Proceed to Step 6</button>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div><!-- /Comment-->
        <?php else: ?>
            <!-- There are no comments -->
            <div class="card mb-3">
                <div class ="card-header">
                    <i class = "fa fa-comment" ></i> Remarks
                </div>
                <div class="card-body small bg-faded">
                    <center>
                        <h4>No remarks yet.</h4>
                        <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        <br><br>
                    </center>
                </div>
                <?php if ($progress_5->progress_isSuccessful == 1): ?>
                    <div class ="card-footer">
                        <i class = "fa fa-check" ></i> Closed. Approved by <strong><?= $comment->progress_comment_sender ?></strong>
                    </div>
                <?php else: ?>
                    <?php if ($transaction->transaction_dropped_at != 0): ?>

                    <?php else: ?>
                        <div class="card-footer small text-muted text-center">
                            <div class="btn-group" role="group" aria-label="Approval">
                                <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-danger return_5" data-toggle = "modal"  title = "Return to Step 4" data-target = "#step_5_sched_return"><i class = "fa fa-chevron-left"></i> Return to Step 4</button>     
                                <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-secondary" data-toggle = "modal"  title = "Leave a remark" data-target = "#step_5_sched_disapprove"><i class = "fa fa-comment"></i> Leave a remark</button>     
                                <button type ="button" class = "px-5 py-2 input-group-addon btn btn-outline-primary approve_5" data-toggle = "modal"  title = "Proceed to Step 6" data-target = "#step_5_sched_approve"><i class = "fa fa-chevron-right"></i> Proceed to Step 6</button>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div><!-- /Comment-->
        <?php endif; ?>
    </div>


    <!-- MODAL FOR RETURNING FROM STEP 5 -->
    <div class="modal fade" id="step_5_sched_return" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id = "step_5_form_d" method = "POST" role = "form">
            <!-- Displayed Fields -->
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventHeader">Return to Step 4</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to return to Step 4? All progress on this step will be lost.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type = "button" id ="step_5_return" class="btn btn-danger">Yes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- MODAL FOR APPROVING STEP 3 -->
    <div class="modal fade" id="step_5_sched_approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id = "step_5_form_a" method = "POST" role = "form">
            <!-- Displayed Fields -->
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventHeader_prog3"> Set schedule for Release Day</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted"><i class="fa fa-check"></i> Before approving Step 5 (Visiting Chosen Adoptee), set schedule for the next step (Release Day).</p>
                        <div class = "form-row">
                            <div class = "col-md-6 form-group">
                                <label for="event_startdate_step_6">Start Date</label>
                                <input type = "text" id = "event_startdate_step_5" name = "event_startdate_step_5" class = "form-control schedule_datepicker" placeholder = "Start Date" readonly="" required/>
                            </div>
                            <div class = "col-md-6 form-group">
                                <label for="event_starttime_step_5">Start Time</label>
                                <input type = "text" id = "event_starttime_step_5" name = "event_starttime_step_5" class = "form-control no-limit-timepicker" placeholder = "Start Time" readonly="" required/>
                            </div>
                        </div>
                        <div class = "form-row">
                            <div class = "col-md-6 form-group">
                                <label for="event_enddate_step_5">End Date</label>
                                <input type = "text" id = "event_enddate_step_5" name = "event_enddate_step_5" class = "form-control schedule_datepicker" placeholder = "End Date" readonly="" required/>
                            </div>
                            <div class = "col-md-6 form-group">
                                <label for="event_endtime_step_5">End Time</label>
                                <input type = "text" id = "event_endtime_step_5" name = "event_endtime_step_5" class = "form-control no-limit-timepicker" placeholder = "End Time" readonly="" required/>
                            </div>
                        </div>
                        <div class = "form-row">
                            <label for="comment_step_5">Remarks</label>
                            <textarea class = "form-control" id = "comment_step_5" name = "comment_step_5" placeholder = "Leave a remarks here." required=""></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id = "step_5_approve" class="btn btn-primary">Set Schedule</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- MODAL FOR DISAPPROVING STEP 3 -->
    <div class="modal fade" id="step_5_sched_disapprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id = "step_5_form_d" method = "POST" role = "form">
            <!-- Displayed Fields -->
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventHeader"> Leave remark on Meet and Greet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class = "form-row">
                            <label for="comment_d_5">Remarks</label>
                            <textarea class = "form-control" id = "comment_d_5" name = "comment_d_5" placeholder = "Leave a remark here." required=""></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id = "step_5_disapprove" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#step_5_disapprove', function () {
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url() ?>' + "ManageProgress/step_5/<?= $transaction->transaction_id ?>",
                    "dataType": "JSON",
                    "data": {
                        'comment': $('#comment_d_5').val(),
                        'event_type': "disapprove"
                    },
                    success: function (res) {
                        if (res.success) {
                            swal({title: "Success", text: res.result, type: "success"},
                                    function () {
                                        location.reload();
                                    }
                            );
                        } else {
                            swal("Error", res.result, "error");
                            show_error(res.comment, $('#comment_d_5'));
                        }
                    },
                    error: function (res) {
                        swal("Reload", "Something went wrong. Reload your browser", "error");
                    }
                });
            });
        });//ready()
    </script>
<?php endif; ?>
