<?php
//echo "<pre>";print_r($frmdata);die;
?>
<style>
.fc-time{display : none;}
</style>
<div class="col-md-12">
<div class="row"><a data-toggle="modal" data-target="#myModalLeaveRequest" class="btn btn-primary mb10 pull-left">Leave Request</a></div>
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
                <label>Leaves Reason</label>
                <div class="clearfix"></div>
                <?php echo form_dropdown('leave_reason', $frmdata['reasonsData'],'','   class="selectpicker form-control" id="manager" onchange="changeCalender()"');?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Title</label>
                <div class="clearfix"></div>
                <input type="text" class="form-control" name="leave_title" value="" />
            </div>
        </div>
     </div>
      <div class="col-md-6">
            <div class="form-group">
                <label>Date -Time</label>
                <div class="clearfix"></div>
                <input type="text" class="form-control" name="daterange" value="" />
            </div>
        </div>
        <div class="col-md-6"><a id="moreRecources">More Recources</a>
        <div class="form-group" id="moreRecourcesAdded">
                <label>Other Recources </label>
                <div class="clearfix"></div>
                <?php                 
                echo form_dropdown('manager_id[]', $frmdata['property'], "", ' multiple data-actions-box="true" class="required form-control user_date" id="recourcesId" ');
                ?></div>
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
<div class="col-md-12">
 <div id='calendar'></div>
</div>


<script>
function dataSet(a){
var sel= document.getElementById("manager");
    if(sel.value < 1){
    	alert("Please select valid Reason.");
    	sel.focus();
    	return false;	
    }
	
}
  
   $(document).ready(function() {
	   $("#moreRecourcesAdded").hide();
	   //$('#recourcesId').selectpicker();
	   $("#moreRecources").click(function(){
		$(this).hide();
		 $("#moreRecourcesAdded").show();
		})
    $('#calendar').fullCalendar({
         selectable: true,
         defaultDate: moment('<?php echo date("Y-m-d");?>'),
         header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
         },      
        events: function(start, end, timezone, callback) {
            
                  $.ajax({
                        url: FRONTURL+'welcome/assignAllDate',
                        dataType: 'json',
                        type:'POST',
                        data: {
                          action: 'assigndate',
                          start: start._i,
                          end: end._i,
                          'tentative':1
                        },
                        success: function(doc){
                          console.log(doc);
                          var objdoc=doc;
                         $.each(objdoc, function (doc1, value){
                
                          $('#currentDiagnoseid').val((value.diagnose_id));
                         });
                        if(typeof doc == 'object'){  callback(doc);}},
                        error:function(e){
                          alert('Can not get the availability slot. Lost connect with your sever');
                        }
                    });
        },
        eventRender: function(event, element) {
            	element.attr("href", "javascript:void(0);");
                element.click(function() {
                  //console.log(event);
                         var mainid=event.id;
                         var ordertype=event.order_type||7;
                         var did= event.diagnose_id;
                         var status = event.status;
                                $.itfPopup.open({
                                      items: {
                                          src: FRONTURL +'welcome/getFullDetailByDiagnoseId/'+did+"/"+status+"/"+mainid+"/"+ordertype,
                                          type: 'ajax',                                        
                                          alignTop: false,
                                          overflowY: 'scroll'
                                          }
                                    });            
                                });
            },
         editable: false,
         eventLimit: true, 
         loading: function(isLoading, view){
                    if(isLoading){
                    }else{
                    }
                }
      });
      
   });
</script>