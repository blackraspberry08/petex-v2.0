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
<!-- GOOGLE MAPS-->
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyD1VJrwMKjjvTi626jR6pdoaNdIHKEdp0c"></script>
<script>

    //EMPTY ADDRESS INPUT
    var map;
    function initialize() {
        // Set up the map
        var mapOptions = {
            zoom: 18,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            streetViewControl: false,
        };
        map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
        google.maps.event.addDomListener(window, 'load', initialize);
    }
</script>

<!-- GEO COMPLETE -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/geocomplete/1.7.0/jquery.geocomplete.min.js"></script>
<script>

    $(function () {
        $("#geocomplete").geocomplete({
            map: "#google-map",
            details: "form",
            country: 'ph',
        }).bind("geocode:result", function (event, result) {
//            console.log("===== FOOTER =====");
//            console.log(event);
//            console.log(result);
        });
    });
</script>


<script src="<?= base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">

    var dt = new Date();
    dt.setFullYear(new Date().getFullYear());
    $(document).ready(function () {
        $(".form_datetime").datetimepicker({
            format: 'MM dd, yyyy',
            todayBtn: true,
            autoclose: true,
            minView: 2,
        });

        $('.form_datetime').datetimepicker('setEndDate', dt);
    });

</script>  
<script>
    jQuery(document).ready(function ($) {
        $('.counter').counterUp({
            delay: 5,
            time: 1000
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0/jquery.counterup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.bundle.min.js" integrity="sha384-VspmFJ2uqRrKr3en+IG0cIq1Cl/v/PHneDw6SQZYgrcr8ZZmZoQ3zhuGfMnSR/F2" crossorigin="anonymous"></script>
<!-- Bootstrap Switch -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/admin/js/sb-admin.min.js"></script>
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
<!-- Core plugin JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<!-- Bootstrap Lightbox-->
<script src = "https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
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
<script type="text/javascript">
    var dt = new Date();
    dt.setFullYear(new Date().getFullYear() - 18);
    $(document).ready(function () {
        $(".form_datetime").datetimepicker({
            format: 'MM dd, yyyy',
            todayBtn: true,
            autoclose: true,
            minView: 2,
        });
        $('.form_datetime').datetimepicker('setEndDate', dt);
    });

</script>  
</div>
</body>
</html>
