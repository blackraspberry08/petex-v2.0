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


<!-- BOOTSTRAP -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.bundle.min.js" integrity="sha384-VspmFJ2uqRrKr3en+IG0cIq1Cl/v/PHneDw6SQZYgrcr8ZZmZoQ3zhuGfMnSR/F2" crossorigin="anonymous"></script>
<!-- DATETIME PICKER -->
<script src="<?= base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datetimepicker.js"></script>
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
<!-- SweetAlert -->
<script src = "https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


</body>
</html>
