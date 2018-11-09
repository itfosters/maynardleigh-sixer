<?php

//$calview=$frmdata['calview'];
//echo "$$<pre>"; print_r($frmdata['cldrdata']);die;
//echo "<pre>"; print_r($calender['cldrdata']);die;
$userid=isset($calender['cldrdata']->id)?$calender['cldrdata']->id:0;
$start=isset($calender['cldrdata']->start_date)?date("Y-m-d", strtotime($calender['cldrdata']->start_date)):0;
//die($start);
$end=isset($calender['cldrdata']->end_date)?date("Y-m-d", strtotime($calender['cldrdata']->end_date)):0;

 ?>

<div class="col-md-12">
<div id='calendar'></div>
<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <div id="modalBody" class="modal-body">
            <button type="button" class="btn btn-success">Accept</button>
            <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
             Reject
            </button>
            <div class="collapse" id="collapseExample">
              <div class="well mt10">
                <form>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <textarea class="form-control" rows="3"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button>-->
            </div>
        </div>
    </div>
</div>
</div>



<script>
  //alert(start);
   
   $(document).ready(function() {
      $('#calendar').fullCalendar({
         selectable: true,
         header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
         },
         defaultDate: '2016-06-12',  
           
           events: [
                        {
                        "title":"Booked",
                        "allDay":true,
                        "id":'<?php echo $userid;?>',
                        "start":'<?php echo $start;?>',
                        "end":'<?php echo $end;?>',
                        "url": '#'
                        
                        }
                    ],

        eventRender: function(event, element) {

                element.attr("href", "javascript:void(0);");
                element.click(function() {
                        $('#fullCalModal').modal();
                });
            },

         editable: false,
         eventLimit: true, // allow "more" link when too many events
         
      });
      
   });
</script>