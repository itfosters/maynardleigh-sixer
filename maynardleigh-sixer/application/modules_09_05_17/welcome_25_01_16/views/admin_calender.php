<?php //echo "<pre>";print_r($view);die;
$status = array(0=>'Awaiting..',1=>'Accepted',2=>'Rejected');
?>
<?php
   echo form_dropdown('user_date', $property,isset($frmdata['view']->parentid)?$frmdata['view']->parentid:"",  'class="required form-control user_date" id="userdata"  onchange="changeCalender()"');
?>
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
    
    // $('.user_date').change(function(){
    //  var user=$('.user_date').val();
   
    //    $.ajax({
    //             url: "<?php echo site_url("welcome/admin/showAllDates");?>",
    //             type: "POST",
    //             data:{"id":user},
    //             success: function (emp_list) {
    //                 //console.log(emp_list);
				// 	$("#hints").hide();
				// 	$("#resourceused").show();
				// 	$("#rexourdedt").empty();
                   
    //                 var txt = "";
				// 	 //var prop = emp_list;
				   
				// 	 //console.log(prop);
				// 	   $.each(emp_list, function(index, item) {
				// 		item.clientname=(item.clientname==null)?'':item.clientname;
				// 		item.moreinfo.name=(item.moreinfo.name==null)?'':item.moreinfo.name;
				// 		item.moreinfo.subname=(item.moreinfo.subname==null)?'':item.moreinfo.subname;
				// 		item.moreinfo.location=(item.moreinfo.location==null)?'':item.moreinfo.location;
					   

				// 	 	var status = 'Awaiting';
				// 		if (item.status=='1')
				// 			status ="Approved";
				// 		else if (item.status=='2')
				// 			status='Rejected';
						
						
				// 		txt = "<tr class='sts"+item.status+"rw'><td>"+item.clientname+"</td><td>"+item.moreinfo.name+"</td>"+
				// 		 "<td>"+item.moreinfo.subname+"</td><td>"+item.moreinfo.location+"</td>"+
				// 		 "<td>"+item.start_date+"</td><td>"+item.start_time+"</td>"+
				// 		 "<td>"+item.end_date+"</td><td>"+item.end_time+"</td>"+
				// 		 "<td class='status'>"+status+"</td></tr>";
				// 		//alert(txt);
				// 		//console.log("Prem ji chill"+item.moreinfo)
				// 		$(".table").DataTable(txt)
						 
					   
				// 	 });


				// }
                    
    //    });
    // })
})

</script>
<script type="text/javascript">
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

                        $('#clientname').html('Client Name :<b>'+event.clientname+'</b>');
                        $('#job').html('Job Name :<b>'+event.job+'</b>');
                        $('#subpro').html('Sub-product :<b>'+event.Subproduct+'</b>');
                        $('#location').html('Location :<b>'+event.location+'</b>');
                        $('#orderidvalue').html('Order Id :<b>'+event.orderid+'</b>');
                        $('#bookedtime').html('Time Duration :<b>'+event.interval+'</b>');
                        $('#comment').html('<b>'+event.comment+'</b>');
                        $('#fullCalModal').modal();    
                                });
                },
                
        });
     } 

</script>

