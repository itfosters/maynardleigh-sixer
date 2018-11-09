<?php

//$calview=$frmdata['calview'];
//echo "$$<pre>"; print_r($frmdata['start_end']->start_date);
//print_r($frmdata['start_end']->end_date);
//die;

//$source = $frmdata['start_end']->start_date.'-'.$frmdata['start_end']->end_date;


//$source = $frmdata['start_end']->start_date."-".$frmdata['start_end']->end_date;
$startdate = strtotime($frmdata['start_end']->start_date);
$enddate = strtotime($frmdata['start_end']->end_date);
$startdatenew=date('m/d/Y h:i A',$startdate);
$enddatenew=date('m/d/Y h:i A',$enddate);



 ?>

<div class="col-md-12">
    <div class="row">
        <?php echo form_open(); ?>
        <div class="col-md-6">
            <div class="form-group">
                <label>Resources</label>
                <div class="clearfix"></div>
             
                
                <?php echo form_dropdown('manager', $frmdata['allmanager'],'','class="selectpicker form-control" id="manager" onchange="changeCalender()"');?> 
               <?php //echo form_dropdown('dnocasting[]', $frmdata['castingmanager'],isset($frmdata['selectedmangers'])?$frmdata['selectedmangers']:array(), ' multiple="multiple" class="selectpicker form-control" id="no_of_casting"');?>
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Date -Time</label>
                <div class="clearfix"></div>
                <?php //echo "$$!!<pre>"; print_r($startdatenew.' '.'-'.' '.$enddatenew);die;?>
                <?php //echo "$$!!<pre>"; print_r($frmdata['start_end']->end_date);die;?>
                <input type="text" class="form-control" name="daterange" value="<?php echo $startdatenew.' '.'-'.' '.$enddatenew;?>" />
                <input type="hidden" class="form-control" name="diagnose_id" value="<?php echo $frmdata['diagnose_id']; ?>" />
                <input type="hidden" id="remail" class="form-control" name="cast_email" value="<?php echo $frmdata['results']['assigndetails']->email; ?>" />
                <input type="hidden" id="rname" class="form-control" name="cast_name" value="<?php echo $frmdata['results']['assigndetails']->resourcename; ?>" />
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
<div class="col-md-12">
<div id='calendar'>
    
</div>
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
<style>
.fc-time{display : none;}
</style>
<script>
	function deleteReason(){
		debugger
		var changeRequest=document.getElementById("changeRequest");
		var requestTimeSetElement=document.getElementById("requestTimeSet");
		var rangeSelector=document.getElementById("rangeSelector");

		var reason=document.getElementById("change_reason");
		var requestRecId=document.getElementById("requestRecourse_id");
		if(requestTimeSetElement.style.display=="none"){
			requestTimeSetElement.style.display="block";
			changeRequest.style.display="none";
			rangeSelector.style.display="none";
			return false;
		}
		if(reason.value==""){
    		alert("please valid reason for change leave request.");
    		reason.focus();
    		return false;
		}
		$('#processing').html("<font style=color:green size='5'><b>Please wait...</b></font>");
		//alert("helllo this is value :"+reason.value+" :: "+range.value+" :: "+requestRecId.value );
		if(confirm("do you want to delete this record.")){
		$.ajax({
            url: ADMINURL+'diagnose/deleteRecourseRequest',
            type:'post',
            data: {
                reason: reason.value,
				managerid: requestRecId.value
            },
            beforeSend: function() {    
                $('#processing').html("<font style=color:green size='5'><b>Please wait...</b></font>");
            },
            success: function(doc){
                $('#processing').html("");
                /* if(typeof doc == 'object'){
                    callback(doc);
                } */
                window.location.reload(true);
            },
            error:function(e)
            {
                alert('Can not get the availability slot. Lost connect with your sever');
            }
        });
		}
	}
	function changReason(){
		debugger
		//	deleteRequest  change_reason
		//	requestTimeSet
		var requestTimeSetElement=document.getElementById("requestTimeSet");
		var deleteRequestElement=document.getElementById("deleteRequest");
		if(requestTimeSetElement.style.display=="none"){
			requestTimeSetElement.style.display="block";
			deleteRequestElement.style.display="none";
			//return false;
		}else{
		var reason=document.getElementById("change_reason");
		var range=document.getElementById("change_range");
		var requestRecId=document.getElementById("requestRecourse_id");
		if(reason.value==""){
		alert("please valid reason for change leave request.");
		reason.focus();
		return false;
		}
		if(reason.value==""){
			alert("please valid Date Range.");
			range.focus();
			return false;
		}
		$('#processing').html("<font style=color:green size='5'><b>Please wait...</b></font>");
		//alert("helllo this is value :"+reason.value+" :: "+range.value+" :: "+requestRecId.value );
		$.ajax({
            url: ADMINURL+'diagnose/updateRecourseRequest',
            type:'post',
            data: {
                reason: reason.value,
                range:range.value,
                managerid: requestRecId.value
            },
            beforeSend: function() {    
                $('#processing').html("<font style=color:green size='5'><b>Please wait...</b></font>");
            },
            success: function(doc){
                $('#processing').html("");
                /* if(typeof doc == 'object'){
                    callback(doc);
                } */
                window.location.reload(true);
            },
            error:function(e)
            {
                alert('Can not get the availability slot. Lost connect with your sever');
            }
        });


		
		}
	}
    var diagids="<?php echo $frmdata['diagnose_id'];  ?>";
    var startdt="<?php echo $frmdata['results']['assigndetails']->start_date; ?>";
    //alert(startdt)
    function  changeCalender()
    {
        $('#calendar').fullCalendar( 'refetchEvents' );
      $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: moment('<?php echo date("Y-m-d");?>'),
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events:function(start, end, timezone, callback) {
                var managerId  = $('#manager').val();
                $.ajax({
                        url: ADMINURL+'diagnose/getAssignDate',
                        dataType: 'json',
                        type:'post',
                        data: {
                            action: 'assigndate',
                            diagnoseid: diagids,
                            startdate:startdt,
                            managerid: managerId,
                            start: start.unix(),
                            end: end.unix(),
                        },
                        beforeSend: function() {    
                            $('#processing').html("<font style=color:green size='5'><b>Please wait...</b></font>");
                        },
                        success: function(doc){
                            $('#processing').html("");
                            if(typeof doc == 'object'){
                                callback(doc);
                            }
                        },
                
                        error:function(e)
                        {
                            alert('Can not get the availability slot. Lost connect with your sever');
                        }
                    });

            },
            eventRender: function(event, element) {
                element.attr("href","javascript:void(0);");
                element.append("<span class='closeon'>X</span>");
                element.find(".closeon").click(function () {
                    if (confirm("Are you sure for remove this date from resouce calendar?")) {
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
                element.click(function() {
                    //alert(1122); debugger
                    //if (typeof obj.foo !== 'undefined') {
                    if(typeof event.LeaveReq!=="undefined"){
						//alert(event.LeaveReq);
						var leaveInfo='<div class="row"><div class="col-md-6">RecourceName : <strong>'+event.name+'</strong></div><div class="col-md-6">Reason : <strong>'+event.LeaveReq+'</strong></div></div>'+
						'<div class="row"><div class="col-md-6">Date -Time : <strong>'+event.start._i+'</strong></div><div class="col-md-6"> To : <strong> '+event.ends+'</strong></div></div>'+
						'<div class="row"><div class="col-md-12" ><input type="hidden" value="'+event.diagnose_id+'" name="recourse_id" id="requestRecourse_id"></div></div>'+
						'<div class="row" id="requestTimeSet" style="display:none;"><div class="col-md-6"><div class="form-group"><label>Reason for change Request:</label><div class="clearfix"></div><input type="text" class="form-control" name="change_reason" id="change_reason" value="" /></div></div>'+
						'<div class="col-md-6" id="rangeSelector"><div class="form-group"><label>Date -Time</label><div class="clearfix"></div><input type="text" class="form-control" name="daterange" id="change_range" value="" /></div></div></div>'+
						'<div class="row"><div class="col-md-6 text-center"><button id="changeRequest" class="btn btn-primary mb10 " onclick="return changReason();">Change Time</button></div><div class="col-md-6"> <button id="deleteRequest" onclick="return deleteReason();"class="btn btn-primary mb10 ">Delete Request</button> </div>';
						$('body').on('focus','input[name="daterange"]',function(){
							$(this).daterangepicker({
								timePicker: true,
								timePickerIncrement: 30,
								locale: {
									format: 'MM/DD/YYYY h:mm A'
								}
							});
						});
						$("#modalBody").html(leaveInfo);
                        }else{
                        	//$('#statusconfirmation').html('Status is :<b>'+event.statusvalue+'</b>'); 
                        	$('#statusconfirmation').html('Status is :<b>'+event.statusvalue+'</b><br>Product Name:<b>'+event.name+'</b><br>Sub Product Name:<b>'+event.title+'</b><br>Location:<b>'+event.location+'</b><br>Time Duration:<b>'+event.time_duration+'</b>');
                            if(event.comments!=''){
                                  $('#statuscomment').html('Rejection Comment is :  <b>'+event.comments+'</b>');
                            }
                              
                        }$('#fullCalModal').modal();
                    });
                },
        });

      //ajax for get dynamic email address and resource name
        var selectedResourceid = $('#manager').val();
           $.ajax({
                        url: ADMINURL+'diagnose/getResourceEmailAndName',
                        dataType: 'json',
                        type:'post',
                        data: {
                            managerid:selectedResourceid
                        },
                        
                        beforeSend: function() {    
                            $('#processing').html("<font style=color:green size='5'><b>Please wait...</b></font>");
                        },
                        success: function(doc){
    
                            $('#remail').val(doc.resourceemailname.email);
                            $('#rname').val(doc.resourceemailname.name);
                            $('#processing').html("");
                            if(typeof doc == 'object'){
                            }
                        }
        //
        });
     } 


    $(document).ready(function() {
    

    $('#manager')
    .val('<?php echo isset($frmdata["selectedResource"])?$frmdata["selectedResource"]:0; ?>')
    .trigger('change');
    });
</script>