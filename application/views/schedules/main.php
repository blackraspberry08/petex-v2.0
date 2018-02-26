<!--===========================
SCHEDULES
============================-->
<style>
    .timepicker{
        overflow: hidden;
    }
    .timepicker .datetimepicker-hours .next,
    .timepicker .datetimepicker-minutes .next > table{
        visibility:hidden;
    }
</style>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>AdminDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Schedules</li>
        </ol>
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <?php include_once ("schedules.php"); ?>
    </div>

    <script>
        $(document).ready(function () {
            var dt = new Date();
            dt.setFullYear(new Date().getFullYear());
            //DATE PICKER FOR SCHEDULE
            $(".schedule_datepicker").datetimepicker({
                format: 'MM d, yyyy',
                todayBtn: true,
                autoclose: true,
                minView: 2,
            });
            $('.schedule_datepicker').datetimepicker('setStartDate', dt);

            //TIME PICKER FOR SCHEDULE
            $(".limited-timepicker").datetimepicker({
                format: 'H:ii P',
                autoclose: true,
                minView: 0,
                maxView: 1,
                startView: 1,
                showMeridian: true,
                startDate: new Date(),
            });
            //$('.limited-timepicker').datetimepicker('setStartDate', dt);
            $(".no-limit-timepicker").datetimepicker({
                format: 'H:ii P',
                autoclose: true,
                minView: 0,
                maxView: 1,
                startView: 1,
                showMeridian: true,
            });
        });
    </script>