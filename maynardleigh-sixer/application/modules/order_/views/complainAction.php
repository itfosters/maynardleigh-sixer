<div class="row">
    <div class="col-md-6">

       
    </div> 
    <div class="col-md-6 text-right"> 
        <a data-toggle="modal" style="" id="actionAdd" data-target="#myModalAddActionRequest" class="btn btn-primary">Add New Action</a>
    </div>
</div>
<div class="row">

    <!-- <div class="clearfix"></div> -->
    <!-- Trigger the modal with a button -->
    <div class="table-responsive">
        <div id="accordion" role="tablist" aria-multiselectable="true">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> </a>
            <div role="button"  class="thead-inverse deal">
                <?php 
                
                if (count($cmpAct) > 0) { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" summary="">
                            <thead class="thead-inverse">

                                <tr>
                                    <!--<th><input type="checkbox" name="" id="selecctall" value="1" title="Select All"></th>-->
                                    <th width="5%">S.No</th>
                                    <th width="5%">OrderId</th>
                                    <th width="30%" >Action Title </th>
                                    <th width="40%">Action Status</th>
                                    <th width="5%" colspan="7">Action</th>
                                </tr>  
                            </thead>
                            <tbody>
                            
							 <?php foreach($cmpAct as $key => $value){ ?>
							<tr>
							    <td><?php echo $key + 1; ?></td>
							    <td><?php echo $value->compId; ?></td>
							    <td><?php echo $value->actName; ?></td> 
							    <td><?php echo ($value->actStatus==0)? "Panding" : "Done";   ?></td> 
							    <td>
							    
							    <input class="comStatusCmp" type="checkbox" value="<?php echo $value->actId; ?>" name="comStatus">
							   <!--  <a title="Edit" onclick="edit">
							    <i class="fa fa-pencil"></i>
							    </a> -->
							    <a title="Delete" onclick="deleteComplainAtction('<?php echo $value->compId; ?>','<?php echo $ordId; ?>','<?php echo $value->actId; ?>')">
							    <i class="fa fa fa-trash-o"></i>
							    </a>
							    
							    </td>
							</tr>
							<?php } ?> 
							 </tbody>
                        </table>

<?php } else { ?>

                        <div class="page-head-line"></div>
                        <div class="notfound_text">Sorry!</div>
                        <div class="norecordfound">No Complains Found in the Order</div>
<?php } ?>
                </div>


            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModalAddActionRequest" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Complain Action </h4>
      </div>
      <div class="modal-body">
         <?php echo form_open(); ?>
         <div ng-controller="MainCtrl2" class="ng-scope">
        <div class="row" >
        <div class="col-md-12" >
         <table class="table">
            <tbody>
              <tr>
                <td>Action Title</td>
                <td>*</td>
              </tr>
               <tr data-ng-repeat="choice in choices">
                <td><input type="text" placeholder="Action title" class="form-control" name="actionTitle[]"></td>
                <td><a ng-click="removeChoice()">Remove</a></td>
              </tr>
            </tbody>
          </table>
        </div> </div>
      <div class="row">
    <div class="col-md-6">&nbsp; <input class="addfields" type="button" ng-click="addNewAction()" value="Add More"></div>
    <div class="col-md-6 text-center">
    <input type="submit" class="btn btn-primary mb10 " value="submit" name="submit" onclick="return dataSet(this)">
    <input type="hidden" value="complainAction" name="complainAction">
    <input type="hidden" value="<?php echo $cmp_id;?>" name="copId">
    </div></div>
  </div>
      <div id='processing'></div>
      <?php echo form_close(); ?>
    </div>

  </div>
</div>
</div>
<script>
app.controller('MainCtrl2', function($scope) {
    $scope.choices = [{id: 'choice1'}];
   // $scope.choices = <?php echo isset($frm_data['billing']) ? json_encode($frm_data['billing']) : "[{id: 'choice1'}]"; ?>;
    //console.log($scope.choices.length);
    $scope.addNewAction = function() {

    var newItemNo = $scope.choices.length + 1;
    $scope.choices.push({'id':'choice' + newItemNo});
    };
    
    $scope.removeChoice = function() {
    var lastItem = $scope.choices.length - 1;
    $scope.choices.splice(lastItem);
    };
});
</script>

<script type="text/javascript">
	function deleteComplainAtction(cmpid,ordId, actId){
	if(confirm("Do you want to delete this record ?")){
		window.location.href=ADMINURL+'order/deleteComplainAction/'+ordId+'/'+cmpid+'/'+actId+'.html'; 
		}
		}
    $(document).ready(function () {
		$(".comStatusCmp").click(function(){
			if(confirm("Are you sure?. You want to complate this action")){
				var cmpActId=$(this).val();
				var $that=$(this);
				 $.ajax({
                    url: ADMINURL+'order/actioncomplate',
                    type:'POST',
                    data: {cmpActId: cmpActId},
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

