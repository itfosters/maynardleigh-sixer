<?php
//echo "<pre>";print_r($frmdata);die;
?>

<div class="col-md-12">
<div id='calendar'></div>

</div>


<script>
  
   $(document).ready(function() {
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
                          start: start.unix(),
                          end: end.unix()
                        },
                        success: function(doc){
                          //console.log(doc);
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
                          var ordertype=event.order_type;
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