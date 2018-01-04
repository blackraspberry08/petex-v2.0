<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>assets/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    var dt = new Date();
    dt.setFullYear(new Date().getFullYear() - 18);
    $(document).ready(function () {
        $(".form_datetime").datetimepicker({
            format: 'mm dd, yyyy',
            todayBtn: true,
            autoclose: true,
            minView: 2,
        });
        $('.form_datetime').datetimepicker('setEndDate', dt);
    });

</script>  
</body>
</html>
