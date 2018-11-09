<?php //echo "####<pre>";print_r($frmtodo['view']);die; ?>
<div class="row">

    <!-- Trigger the modal with a button -->
    <div class="table-responsive">
        <div id="accordion" role="tablist" aria-multiselectable="true">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> </a>
            <div role="button"  class="thead-inverse deal">
                <?php 
                $i=0;
                if (count($frmtodo['view']) > 0) { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" summary="">
                            <thead class="thead-inverse">

                                <tr>
                                    <!--<th><input type="checkbox" name="" id="selecctall" value="1" title="Select All"></th>-->
                                    <th width="5%">S.No</th>
                                    <th width="20%">My To Do</th>
                                    <th width="10%">Status</th>
                                    <th width="5%" colspan="7">Action</th>
                                </tr>  
                            </thead>
                            <tbody>
                            
							 <?php foreach($frmtodo['view'] as $key => $value){ ?>
							<tr>
							    <td><?php echo $i+1; ?></td>
							    <td><?php echo $value->todo; ?></td> 
							    <td><?php echo ($value->status==0)? "Panding" : "Done";   ?></td> 
							    <td>
							    
							    <input class="comStatusCmp" type="checkbox" value="<?php echo $value->id; ?>" name="comStatus">
							   <!--  <a title="Edit" onclick="edit">
							    <i class="fa fa-pencil"></i>
							    </a> -->
							    
							    </td>
							</tr>
							<?php } ?> 
							 </tbody>
                        </table>

<?php } else { ?>

                        <div class="page-head-line"></div>
                        <div class="notfound_text">Sorry!</div>
                        <div class="norecordfound">No Any ToDO(s)</div>
<?php } ?>
                </div>


            </div>

        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
		$(".comStatusCmp").click(function(){
			if(confirm("Are you sure?. You want to complate this TO DO")){
				var todoid=$(this).val();
				var $that=$(this);
				 $.ajax({
                    url: FRONTURL+'order/complateTodo',
                    type:'POST',
                    data: {todoId: todoid},
                    success: function(doc){
                        if(parseInt(doc)>0){
                    $that.parent().prev().html("Done");	
                         }
                    },
                    error:function(e){
                      alert('Can not get the availability slot. Lost connect with your sever');
                    }
                }); 
			}else{
			 $(this).prop("checked",false);
			}
		});
        $('#clock').on('click', function () {
            //alert('hello');
            $('#modal').show('1000');
            //$('#modal').css('z-index', '1500');
        });

    });
</script>

