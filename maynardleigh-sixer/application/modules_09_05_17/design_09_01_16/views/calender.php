<?php
//$calview=$frmdata['calview'];
//echo "$$##<pre>"; print_r($frmdata);die;
$startdate = strtotime($frmdata['start_end']->start_date);
$enddate = strtotime($frmdata['start_end']->end_date);
$startdatenew = date('m/d/Y h:i A', $startdate);
$enddatenew = date('m/d/Y h:i A', $enddate);
?>

<div class="col-md-12">
    <div class="row">
<?php echo form_open(); ?>
        <div class="col-md-6">
            <div class="form-group">
                <label>Resources</label>
                <div class="clearfix"></div>

<?php echo form_dropdown('manager', $frmdata['allmanager'], '', 'class="selectpicker form-control" id="manager" onchange="changeCalender()"'); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Date -Time</label>
                <div class="clearfix"></div>
                <input type="text" class="form-control" name="daterange" value="<?php echo $startdatenew . ' ' . '-' . ' ' . $enddatenew; ?>" />
                <input type="hidden" class="form-control" name="diagnose_id" value="<?php echo $frmdata['diagnose_id']; ?>" />
                <input type="hidden" class="form-control" name="cast_email" value="<?php echo $frmdata['results']['assigndetails']->email; ?>" />
                <input type="hidden" class="form-control" name="cast_name" value="<?php echo $frmdata['results']['assigndetails']->resourcename; ?>" />
                <input type="hidden" class="form-control" name="product_name" value="<?php echo $frmdata['results']['assigndetails']->proname; ?>" />
                <input type="hidden" class="form-control" name="location" value="<?php echo $frmdata['results']['assigndetails']->location; ?>" /> 
                <input type="hidden" class="form-control" name="subpro" value="<?php echo $frmdata['results']['assigndetails']->name; ?>" />
                <input type="hidden" class="form-control" name="client_name" value="<?php echo $frmdata['results']['assigndetails']->clientname; ?>" />
                <input type="hidden" class="form-control" name="startdate" value="<?php echo $frmdata['results']['assigndetails']->start_date; ?>" />
                <input type="hidden" class="form-control" name="starttime" value="<?php echo $frmdata['results']['assigndetails']->start_time; ?>" />
                <input type="hidden" class="form-control" name="enddate" value="<?php echo $frmdata['results']['assigndetails']->end_date; ?>" />
                <input type="hidden" class="form-control" name="endtime" value="<?php echo $frmdata['results']['assigndetails']->end_time; ?>" />
            </div>
        </div>
        <div class="col-md-6">
            <input type="submit" class="btn btn-primary mb10" value="submit" name="submit">	
        </div>
        <div id='processing'></div>
<?php echo form_close(); ?>
    </div>
</div>

<!-- <div class="col-md-6">
   
       <a href="<?php //echo site_url('diagnose/viewCalender/'); ?>">View Calenders</a>
   
   </div>  -->
<div class="col-md-12">
    <div id='calendar'></div>
</div>
<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <div id="modalBody" class="modal-body">

                <div id = "statusconfirmation"></div>
                <div id = "statuscomment"></div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    var diagids = "<?php echo $frmdata['diagnose_id']; ?>";
//alert(diagids);
    function  changeCalender()
    {
        $('#calendar').fullCalendar('refetchEvents');
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: moment('<?php echo date("Y-m-d"); ?>'),
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events: function (start, end, timezone, callback) {
                //console.log(start+"*******"+end)
                var managerId = $('#manager').val();
                $.ajax({
                    url: ADMINURL + '/design/getAssignDate',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        action: 'assigndate',
                        diagnoseid: diagids,
                        managerid: managerId,
                        start: start.unix(),
                        end: end.unix()
                    },
                    beforeSend: function () {
                        $('#processing').html("<font style=color:green size='5'><b>Please wait...</b></font>");
                    },
                    success: function (doc) {
                        //console.log("response"+doc);
                        $('#processing').html("");
                        if (typeof doc == 'object') {
                            callback(doc);
                        }
                    },
                    error: function (e)
                    {
                        alert('Can not get the availability slot. Lost connect with your sever');
                    }
                });
            },
            eventRender: function (event, element) {

                element.attr("href", "javascript:void(0);");

                element.append("<span class='closeon'>X</span>");
                element.find(".closeon").click(function () {
                    if (confirm("Are you sure for remove this date from resouce calendar?")) {
                        //alert(event._id);
                        $('#calendar').fullCalendar('removeEvents', event._id);

                        $.ajax({
                            url: ADMINURL + 'diagnose/deleteAssignDate',
                            dataType: 'json',
                            type: 'post',
                            data: {
                                id: event._id
                            },
                            success: function (doc) {

                            },
                        });

                    }
                });



                element.click(function () {
                    //alert(event);

                    $('#statusconfirmation').html('Status is :<b>' + event.statusvalue + '</b>');
                    if (event.comments != '') {
                        $('#statuscomment').html('Rejection Comment is :  <b>' + event.comments + '</b>');
                    }
                    $('#fullCalModal').modal();
                });
            },
        });
    }
    $(document).ready(function () {


        $('#manager')
                .val('<?php echo isset($frmdata["selectedResource"]) ? $frmdata["selectedResource"] : 0; ?>')
                .trigger('change');
    });
</script>