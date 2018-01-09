<script>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            handleWindowResize: true,
            weekends: true, // Show weekends
            //navLinks: true,  //can click day/week names to navigate views
            timeFormat: 'hh:mm A',
            editable: false,
            droppable: false,
            eventLimit: true, // allow "more" link when too many events
            displayEventTime: true,
            allDayText: 'Events/Activity',
            allDay: "",
            dayClick: function (date, jsEvent, view) {
                if(moment().date() > date.date()){
                   alert("You cannot set a schedule before the current date!");
                }else{
                    $('#eventForm')[0].reset();
                    $('#event_startDate').val(date.format("MMMM D, YYYY"));
                    $('#event_header').html('Add a schedule');
                    $('#sendReq').css({"display": "inline-block"});
                    $('#updateReq').css({"display": "none"});
                    $('#deleteReq').css({"display": "none"});
                    $("#event_startDate").prop("disabled", false);
                    $("#event_startTime").prop("disabled", false);
                    $("#event_endDate").prop("disabled", false);
                    $("#event_endTime").prop("disabled", false);
                    $('#customEvent').modal('open');
                }    
            },
            eventClick: function (calEvent, jsEvent, view) {
                console.log(calEvent.schedule_id);
                $.ajax({
                    "method": "POST",
                    "url": '<?= base_url()?>' + "Schedules/getsched/",
                    "dataType": "JSON",
                    "data": {
                        'id': calEvent.schedule_id
                    },
                    success: function (res) {
                        $('#event_header').html('Manage schedule');
                        $('#sendReq').css({"display": "none"});
                        $('#updateReq').css({"display": "inline-block"});
                        $('#deleteReq').css({"display": "inline-block"});
                        $("#event_id").val(res[0].schedule_id);
                        $("#event_name").val(res[0].schedule_title);
                        $("#event_description").val(res[0].schedule_desc);
                        $("#event_color").val(res[0].schedule_color);
                        $("#event_startDate").val(res[0].schedule_startdate);
                        $("#event_startDate").prop("disabled", true);
                        $("#event_startTime").val(res[0].schedule_starttime);
                        $("#event_startTime").prop("disabled", true);
                        $("#event_endDate").val(res[0].schedule_enddate);
                        $("#event_endDate").prop("disabled", true);
                        $("#event_endTime").val(res[0].schedule_endtime);
                        $("#event_endTime").prop("disabled", true);
                        $('#customEvent').modal('open');
                    }
                });
            },
            events: {
                method: "POST",
                url: '<?= base_url() ?>' + 'Schedules/getscheds/',
                dataType: 'JSON',
            },
            eventRender: function (event, element) {
                //element.css({"height":"30px"});
            }
        });
        
        $(document).on('click', '#sendReq', function () {
            $.ajax({
                "method": "POST",
                "url": '<?= base_url()?>' + "Schedules/setreserve/",
                "dataType": "JSON",
                "data": {
                    'schedule_title': $("#event_name").val(),
                    'schedule_desc': $("#event_description").val(),
                    'schedule_color': $("#event_color").val(),
                    'schedule_startdate': $("#event_startDate").val(),
                    'schedule_starttime': $("#event_startTime").val(),
                    'schedule_enddate': $("#event_endDate").val(),
                    'schedule_endtime': $("#event_endTime").val()
                },
                success: function (res) {
                    if (res.success) {
                        location.reload();
                    } else {
                        alert(res.result);
                    }

                }
            });

        });
        
        $(document).on('click', '#updateReq', function () {
            $.ajax({
                "method": "POST",
                "url": "<?= base_url()?>" + "Schedules/updatereserve/",
                "dataType": "JSON",
                "data": {
                    'schedule_id': $("#event_id").val(),
                    'schedule_title': $("#event_name").val(),
                    'schedule_desc': $("#event_description").val(),
                    'schedule_color': $("#event_color").val(),
                    'schedule_startdate': $("#event_startDate").val(),
                    'schedule_starttime': $("#event_startTime").val(),
                    'schedule_enddate': $("#event_endDate").val(),
                    'schedule_endtime': $("#event_endTime").val()
                },
                success: function (res) {
                    if (res.success) {
                        location.reload();
                    } else {
                        alert(res.result);
                    }
                }
            });
        });
        
        $(document).on('click', '#deleteReq', function () {
            $.ajax({
                "method": "POST",
                "url": "<?= base_url()?>" + "Schedules/deletereserve/",
                "dataType": "JSON",
                "data": {
                    'schedule_id': $("#event_id").val(),
                    'schedule_title': $("#event_name").val(),
                    'schedule_desc': $("#event_description").val(),
                    'schedule_color': $("#event_color").val(),
                    'schedule_startdate': $("#event_startDate").val(),
                    'schedule_starttime': $("#event_startTime").val(),
                    'schedule_enddate': $("#event_endDate").val(),
                    'schedule_endtime': $("#event_endTime").val()
                },
                success: function (res) {
                    if (res.success) {
                        location.reload();
                    } else {
                        alert(res.result);
                    }
                }
            });
        });
        
        
    });
    </script>
<div class ="side-nav-offset">
    <div class ="container containerCal">
        <div id="calendar"></div>
    </div>
</div>