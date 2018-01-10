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

<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?= base_url() ?>assets/bootstrap-switch/js/bootstrap-switch.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/admin/js/sb-admin.min.js"></script>
<!-- Stepper -->
<script src="<?= base_url() ?>assets/stepper/js/mdb.js"></script>
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
<script src = "<?= base_url() ?>assets/bootstrap-lightbox/ekko-lightbox.js"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
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
