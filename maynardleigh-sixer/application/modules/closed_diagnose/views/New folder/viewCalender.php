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
                      <button type="submit" class="btn btn-primary	">Submit</button>
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
	var userids="0";
	$(document).ready(function() {
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '2016-06-12',
			eventClick:  function(event, jsEvent, view) {
	            $('#modalTitle').html(event.title);
	            $('#modalBody').html(event.description);
	            $('#eventUrl').attr('href',event.url);
	            $('#fullCalModal').modal();
	        },
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events:function(start, end, timezone, callback) {

				$.ajax({
                        url: FRONTURL+'diagnose/getAssignDate',
                        dataType: 'json',
                        type:'post',
                        data: {
                            action: 'assigndate',
                            userids_id: userids,
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function(doc){
                            if(typeof doc == 'object'){
                                callback(doc);
                            }
                        },
                        error:function(e)
                        {
                            alert('Can not get the availability slot. Lost connect with your sever');
                        }
                    });
			}
		});
		
	});
</script>