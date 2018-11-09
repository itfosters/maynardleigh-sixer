<?php //echo "<pre>";print_r($alldata[0]->name);die; ?>
<div class="row">
    <div class="col-md-6">

       
    </div> 
    <div class="col-md-6 text-right"> 
        <a href="<?php echo site_url('admin/order/add_complain/'.$ordId); ?>" target="" value="Add New" class="btn btn-primary" type="button">Add New Complain</a>
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
                
                if (count($alldata) > 0) { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" summary="">
                            <thead class="thead-inverse">

                                <tr>
                                    <!--<th><input type="checkbox" name="" id="selecctall" value="1" title="Select All"></th>-->
                                    <th width="5%">S.No</th>
                                    <th width="5%">OrderId</th>
                                    <th width="30%" >Complain Type</th>
                                    <th width="20%">Complain Description</th>
                                    <th width="20%">Complain Responsible</th>
                                    <th width="10%" colspan="7">Action</th>
                                </tr>  
                            </thead>
                            <tbody>
							<?php foreach($alldata as $key => $value){ 
               

                ?>
							<tr>
							    <td><?php echo $key + 1; ?></td>
							    <td><?php echo $value->orderID; ?></td>
                                                            <td><?php echo isset($value->cmpTypeName)?$value->cmpTypeName:''; ?></td> 
                  <td><?php  echo html_entity_decode($value->cmp_desc);  //echo $value->cmp_desc; ?></td>
                  <td >
                                            <?php
                                            //echo $value->email_Id;
                                            foreach ($value->responsename as $singleDate) {
                                                echo isset($singleDate->name)?$singleDate->name:$singleDate->cmpname;
                                                echo "<br>";
                                            }
                                            ?>
                                        </td>
							    <td>
							    <a title="Edit" href="<?php echo site_url('admin/order/add_complain/'.$ordId.'/'.$value->cmp_id); ?>"><i class="fa fa-pencil"></i> </a>
							    &nbsp;<a title="Delete" onclick="deleteComplain('<?php echo $value->cmp_id; ?>','<?php echo $ordId; ?>')"><i class="fa fa fa-trash-o"></i></a>
							    &nbsp;<a title="Complain Action" href="<?php echo site_url('admin/order/complainAction/'.$ordId.'/'.$value->cmp_id); ?>">
							    <span class="glyphicon glyphicon-share" aria-hidden="true"></span>
							    </a>
                                                     <!--        <a type="button" value="view_details" title="Assing Resource" class="travel-pop" href="<?php echo site_url('admin/order/complainResponsible/'.$ordId.'/'.$value->cmp_id);?>">
                               <i class="fa fa-user"></i></a> -->
              <a type="button" title="Assing Responsiblity" class="fa fa-user pzi_modal" data-toggle="modal" orderid="<?= $ordId ?>" comlane_id="<?= $value->cmp_id?>" data-target="#exampleModal">
</a>			</tr>
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
         <?php echo form_open('admin/order/cmpresponsible/'); ?>
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
                   <td>
                       <select name="select" class="form-control"> <!--Supplement an id here instead of using 'name'-->
  <option value="value1">Value 1</option> 
  <option value="value2" selected>Value 2</option>
  <option value="value3">Value 3</option>
</select>
                   </td>
                   <td>
                       <select name="select" class="form-control"> <!--Supplement an id here instead of using 'name'-->
  <option value="value1">Value 1</option> 
  <option value="value2" selected>Value 2</option>
  <option value="value3">Value 3</option>
</select>
                   </td>
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
<script type="text/javascript">
function deleteComplain(comId, ordId){
 if(confirm("Do you want to delete this record ?")){
	window.location.href=ADMINURL+'order/deleteComplain/'+ordId+'/'+comId+'.html'; 
	}
	
}
    $(document).ready(function () {

        $('#clock').on('click', function () {
            //alert('hello');
            $('#modal').show('1000');
            //$('#modal').css('z-index', '1500');
        });

    });
</script>
<script>
app.controller('MainCtrl2', function($scope) {
    $scope.choices = [{id: 'choice1'}];
   // $scope.choices = <?php //echo isset($frm_data['billing']) ? json_encode($frm_data['billing']) : "[{id: 'choice1'}]"; ?>;
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

<!-- Modal -->
 <form action='' id="form">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Responsible</h5>
      </div>
      <div class="modal-body">
    <div class="row">
  <div class="col-md-12">

<table class="table" id="p_scents">


<tr>
  
  
   <td>Responsival</td>
   <td>Name</td>
 
 
   <td>Remove</td>
 
</tr>



  
  <tr class='input-wrap'>

  <td>
   
      <select id="counter" name="add_1"  class="form-control add_responsival" count='1'>
                    <option>Select Responsival</option>
                    <option value="CM"> Resource</option>
                    <option value="S">Sales</option>
                    <option value="PM">PM</option>
                    <option value="ST">Stage</option>
                    <option value="AC">Accounts</option>
                    <option value="O">Others</option>
      </select>
<input type="hidden" name="orderid" class='orderidc' >
<input type="hidden" name="complanid" class='comlane_idc' >
 </td>
 <td>
 <div class="decide_1"></div>

    </td>
    <td></td>
    </tr>

</table>
</div>
<div class="col-md-8"><h2><a href="#" id="addScnt"><i class="fa fa-plus-circle" aria-hidden="true"></i>
</a></h2>
</div>
<div class="col-md-2"><input type="submit" name="cmsub" class="btn btn-primary cmsub" value='submit'></div>
</div>





</div>


<script>
function resetIndexes() {
  var j = 1, name, $this;
  
  // for each element on the page with the class .input-wrap
  $('.input-wrap').each(function() {
    if (j > 1) {
      // within each matched .input-wrap element, find each <input> element  
      $(this).find('.add_responsival').each(function() {
        $this = $(this);

        name = $this.attr("name").split('_')[0];
       
        $(this).attr('name', name + '_' + j);
        $(this).attr('count',j);
             
      //  $(this).attr('placeholder', 'Input Value ' + j);
      });
         $(this).find('#decide_type').each(function() {
        $this = $(this);

        ranitf = $this.attr("class").split('_')[0];
       
        $(this).attr('class', ranitf + '_' + j);
              $(this).attr('count',j);
      //  $(this).attr('placeholder', 'Input Value ' + j);
      });
            $(this).find('.cmname').each(function() {
        $this = $(this);

        name = $this.attr("name").split('_')[0];
       
        $(this).attr('name', name + '_' + j);
              $(this).attr('count',j);
      //  $(this).attr('placeholder', 'Input Value ' + j);
      })
               $(this).find('.allcount').each(function() {
        $this = $(this);

        value = $this.attr("value").split('_')[0];
       
        $(this).attr('value', j);
              $(this).attr('count',j);
      //  $(this).attr('placeholder', 'Input Value ' + j);
      })
    }
    j++;
  });
}


$(function() {
  var scntDiv = $('#p_scents');
  //alert(scntDiv)
  //var ii=1
  var i=0;
  var count=1;
var len = 1;
  $('#addScnt').on('click', function() {
    // instead of counting inputs, count the wrappers
    i = $('#p_scents .input-wrap').size() + 1;

    $('<tr class="input-wrap"><td><select  count="'+i+'"  name="add_'+i+'" class="form-control add_responsival"><option>Select Responsival</option> <option value="CM">Resources</option> <option value="S">Sales</option><option value="PM">PM</option><option value="ST">Stage</option><option value="AC">Accounts</option><option value="O">Others</option> </select></td><td><div class="decide_'+i+'" id="decide_type"></div></td><td><a href="#" class="remScnt"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></td><td><input type="hidden" name="allcount" class="allcount" value="'+i+'"></td></tr>').appendTo(scntDiv);
  


  });

i++;

  $('#p_scents').on('click', '.remScnt', function() {

      $(this).parents('tr').remove();
 resetIndexes();

  });

$(document).on('change','.add_responsival',function(){

  var count=$(this).attr('count');
  var data=$(this).val();


switch(data)
{
case 'O':$('.decide_'+count).html('<input type="text" name="name_1" class="form-control">');
break;
case 'PM':$('.decide_'+count).html('<input type="text" name="name_1" class="form-control">');
break;
case 'AC':$('.decide_'+count).html('<input type="text" name="name_1" class="form-control">');
break;
case 'ST':$('.decide_'+count).html('<input type="text" name="name_1" class="form-control">');

break;
case 'CM':

 $.ajax({
        type:"POST",
        url:'<?php echo base_url("admin/order/getAllResource") ?>',
        data:{cm:data,inc:count},
   
        success:function(data){
         $('.decide_'+count).html(data);
        }
        });
break;
case 'S':

 $.ajax({
        type:"POST",
        url:'<?php echo base_url("admin/order/getAllResource") ?>',
        data:{cm:data,inc:count},
   
        success:function(data){
         $('.decide_'+count).html(data);
        }
        });
}
 })

});
</script>
</form>
<script type="text/javascript">
$(function(){
  $('.pzi_modal').click(function(){
    var comlane_ids=$(this).attr('comlane_id');
    var orderids=$(this).attr('orderid');
      $('.orderidc').val(orderids);
      $('.comlane_idc').val(comlane_ids);
  });
  $('#form').submit(function(e){
e.preventDefault();
 $.ajax({
        type:"POST",
        url:'<?php echo base_url("admin/order/itf_order_complain_response") ?>',
        data:$('#form').serialize(),
   
        success:function(data)
        {
      
        }
        });

  })
 })

</script>
     
      </div>
     
    </div>
  </div>
</div>

