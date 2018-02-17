<!-- /.container-fluid-->
<!-- /.content-wrapper-->
<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright © Petex 2017</small>
        </div>
    </div>
</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" style = "cursor: pointer;">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url() ?>UserLogout">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Core plugin JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.bundle.min.js" integrity="sha384-VspmFJ2uqRrKr3en+IG0cIq1Cl/v/PHneDw6SQZYgrcr8ZZmZoQ3zhuGfMnSR/F2" crossorigin="anonymous"></script>
<!-- Bootstrap Switch -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/admin/js/sb-admin.min.js"></script>
<!-- Stepper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.3/js/mdb.js"></script>
<script>
    $(".switch-style").bootstrapSwitch();
</script>
<!-- Tab Script-->
<script>
    $('#user_tab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>
<!-- Bootstrap Lightbox-->
<script src = "https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
<!-- Bootstrap Datepicker -->
<script src="<?= base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    var dt = new Date();
    dt.setFullYear(new Date().getFullYear());
    $(document).ready(function () {
        $(".form_datetime").datetimepicker({
            format: 'MM d, yyyy',
            todayBtn: true,
            autoclose: true,
            minView: 2,
        });
        $('.form_datetime').datetimepicker('setStartDate', dt);
    });
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prev_image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#files").change(function () {
        readURL(this);
        $("#nofilechosen").text("");
    });
</script>
<!-- Stepper -->
<script>

    $(document).ready(function () {
        var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn'),
                allPrevBtn = $('.prevBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                    $item = $(this);
            if (!$item.hasClass('')) {
                navListItems.removeClass('btn-indigo').addClass('btn-default');
                $item.addClass('btn-indigo');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });
        $('div.setup-panel div a.active').trigger('click');
    });
</script>

</div>
</body>
</html>
