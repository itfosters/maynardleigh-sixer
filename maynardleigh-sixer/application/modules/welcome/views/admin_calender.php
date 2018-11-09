<?php //echo "<pre>";print_r($view);die;
$status = array(0=>'Awaiting..',1=>'Accepted',2=>'Rejected');
?>
<div class="col-md-12">
<div class="row">
<div class="col-md-6">

<?php
   echo form_dropdown('user_date', $property, $ids, 'class="required form-control user_date" id="userdata"  onchange="changeCalender(this)"');
?>
</div>
<div class="col-md-6">
<style>.btn.dropdown-toggle.btn-default{width:250px!important;}</style>
<a data-toggle="modal" style="display:none" id="leaveRequest" data-target="#myModalLeaveRequest" class="btn btn-primary mb10 pull-left">Add Leave Request</a>
</div></div></div>


<!-- Modal -->
<div id="myModalLeaveRequest" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Leave Request</h4>
      </div>
      <div class="modal-body">
         <?php echo form_open(); ?>
        <div class="col-md-6">
            <div class="form-group">
                <label>Client Name </label>
                <div class="clearfix"></div>
                 <?php                 
                echo form_dropdown('managerId[]', $property2, "", ' multiple   id="multipleRecourcesId" ');
                ?></div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Leaves Reason</label>
                <div class="clearfix"></div>
                <?php echo form_dropdown('leave_reason', $reasonsData, "" ,'class="form-control" id="manager"');?>
            </div> 
        </div>
     
      <div class="col-md-6">
            <div class="form-group">
                <label>Date -Time</label>
                <div class="clearfix"></div>
                <input type="text" class="form-control" name="daterange" value="" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Title</label>
                <div class="clearfix"></div>
                <input type="text" class="form-control" name="leave_title" value="" />
            </div>
        </div>
     
      <div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6 text-center">
    <input type="submit" class="btn btn-primary mb10 " value="submit" name="submit" onclick="return dataSet(this)">
    <input type="hidden" value="leave_request" name="leave_request">
    
    </div>
  </div>
      <div id='processing'></div>
      <?php echo form_close(); ?>
    </div>

  </div>
</div>
</div>

<!-- <div class="abcde" id="hints">No record found. Please Select other Resource</div> -->
<!-- <div class="hidden1 mt20" id="resourceused">
<table class="table able-striped table-bordered">
<thead  class=" table-inverse">
<tr><th>Name</th><th>Job</th><th>Subproducts</th><th>Location</th><th>Start Date</th><th>Start time</th><th>End Date</th><th>End time</th><th>Status</th></tr>
</thead>
<tbody id="rexourdedt">
</tbody>
</table>
</div> -->
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
           
            <div id = "clientname"></div>
            <div id = "job"></div>
            <div id = "subpro"></div>
            <div id = "location"></div>
            <div id = "orderidvalue"></div>
            <div id = "bookedtime"></div>
            <div id = "comment"></div>
            
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

	<div id='processing'></div>

  <nav aria-label="Page navigation">
        <ul class="pagination" id="pagination">
        	
        </ul>
    </nav>
<script type="text/javascript">
    
$(document).ready(function(){
   $("#multipleRecourcesId").selectpicker();  // $('#multiple-checkboxes').multiselect();
	if(parseInt("<?php print $ids; ?>")>0){
		$('[name="user_date"]').change();
    }
});
</script>
<script type="text/javascript">
function deleteReason(){
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
function  changeCalender(obj)
    { if(obj.value>0){
        $("#leaveRequest").show();
        $('[name="manager_id"]').val(obj.value);
        }else{
            $("#leaveRequest").hide();
        }
    
    
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
                var managerId  = $('#userdata').val();
                $.ajax({
                        url: ADMINURL+'welcome/showAllDates',
                        dataType: 'json',
                        type:'post',
                        data: {
                            action: 'assigndate',
                            managerid: managerId,
                            start: start.unix(),
                            end: end.unix(),
                            
                        },
                        
                        beforeSend: function() {    
                            $('#processing').html("<font style=color:green size='5'><b>Please wait...</b></font>");
                        },
                        success: function(doc){
                        	//console.log(doc);
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
                console.log(event);
                element.attr("href","javascript:void(0);");
                element.click(function() {
                    if(event.hasOwnProperty("LeaveReq") && event.LeaveReq!="" ){
						//alert(event.LeaveReq);
						var leaveInfo='<div class="row"><div class="col-md-6">RecourceName : <strong>'+event.name+'</strong></div><div class="col-md-6">Reason : <strong>'+event.LeaveReq+'</strong></div></div>'+
						'<div class="row"><div class="col-md-12">Leave Title : <strong>'+event.leave_title+'</strong></div></div>'+
						'<div class="row"><div class="col-md-6">Date -Time : <strong>'+event.starts+'</strong></div><div class="col-md-6"> To : <strong> '+event.ends+'</strong></div></div>'+
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
                        var typearray={};               
                        typearray[1]='diagnose';
                        typearray[2]='design';
                        typearray[3]='delivery';
                        typearray[4]='discovery';
                        var htmlData='<div id = "clientname">Client Name :<b>'+event.clientname+'</b></div>'+
                            '<div id = "job">Job Name :<b>'+event.job+'</b></div>'+
                            '<div id = "subpro">Sub-product :<b>'+event.Subproduct+'</b</div>'+
                            '<div id = "location">Location :<b>'+event.location+'</b></div>'+
                            '<div id = "orderidvalue">Order Id :<b>'+event.orderid+'</b></div>'+
                            '<div id = "bookedtime">Time Duration :<b>'+event.interval+'</b></div>'+
                            '<div id = "comment"><b><a href="'+ADMINURL+typearray[event.ordertype]+'/index/'+event.main_orderid+'-'+event.diagnose_id+'">Go to Order</b></div>';
                        /* $('#clientname').html('Client Name :<b>'+event.clientname+'</b>');
                        $('#job').html('Job Name :<b>'+event.job+'</b>');
                        $('#subpro').html('Sub-product :<b>'+event.Subproduct+'</b>');
                        $('#location').html('Location :<b>'+event.location+'</b>');
                        $('#orderidvalue').html('Order Id :<b>'+event.orderid+'</b>');
                        $('#bookedtime').html('Time Duration :<b>'+event.interval+'</b>');
                        $('#comment').html('<b>'+event.comment+'</b>');
                        $('#comment').html('<b><a href="'+ADMINURL+typearray[event.ordertype]+'/index/'+event.main_orderid+'-'+event.diagnose_id+'">Go to Order</b>');
                         */
                        $("#modalBody").html(htmlData);
                        }
                        $('#fullCalModal').modal();    

                        });
                },
                
        });
     }
</script>