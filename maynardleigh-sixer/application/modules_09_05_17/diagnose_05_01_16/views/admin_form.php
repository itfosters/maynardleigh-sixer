<?php 
//echo "<pre>2333";print_r($frmdata['subdiagnoseid'][]='Vivek');
//print_r($frmdata['selectedmangers']);
//echo "!!!!<pre>";print_r($frmdata['product'][0]->id);die;
$noofcasting=array(
						'1'=>'1',
						'2'=>'2',
						'3'=>'3',
						'4'=>'4',
						'5'=>'5'
						);

 echo form_open();?>
<div class="col-md-6">
  <div class="form-group">
    <label>Products</label>
    <?php echo form_dropdown('dproducts',$frmdata['product'],isset($frmdata['subdiagnoseid']->products)?$frmdata['subdiagnoseid']->products:"", 'class="form-control" id="name_of_products"');?> </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Sub-Products:</label>
    <?php echo form_dropdown('dsubproducts',$frmdata['subproducts'],isset($frmdata['subdiagnoseid']->subproducts)?$frmdata['subdiagnoseid']->subproducts:"", 'class="form-control" id="name_of_subproducts"');?> </div>

</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Weight<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dweight',
      'id'=>'weight',
'class'=>'gui-input form-control',
'placeholder'=>'Weight',
'value'=>isset($frmdata['subdiagnoseid']->weight)?$frmdata['subdiagnoseid']->weight:""
);
echo form_input($data);
?><?php echo form_error('dweight');?>
  </div>
</div>
 <div class="col-md-6">
         <div class="form-group">
            <label> Units</label>
            <?php $data=array('name'=>'dunits',
               'class'=>'gui-input form-control',
               'placeholder'=>'Units',
               'value'=>isset($frmdata['subdiagnoseid']->units)?$frmdata['subdiagnoseid']->units:"",
               'id'=>'no_of_units'
               );
               echo form_input($data);
               ?><?php echo form_error('dvlocation');?>
         </div>
      </div>   

<div class="clearfix"></div>
<div class="col-md-6">
  <div class="form-group">
    <label>Pax<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dpax',
      'id'=>'pax',
'class'=>'gui-input form-control',
'placeholder'=>'Pax',
'value'=>isset($frmdata['subdiagnoseid']->pax)?$frmdata['subdiagnoseid']->pax:""
);
echo form_input($data);
?><?php echo form_error('dpax');?>
  </div>
</div>
<!-- <div class="col-md-6">
  <div class="form-group"> 
  <label>Resources</label>
  <?php //echo "<pre>";print_r($frmdata['castingmanager']);
                      //print_r($frmdata['castingemail']);die;?>
  <?php //echo form_dropdown('dnocasting[]',$frmdata['castingmanager'],isset($frmdata['selectedmangers'])?$frmdata['selectedmangers']:array(), ' multiple="multiple" class="selectpicker form-control" id="no_of_casting"');?> 
  <?php //echo form_dropdown();?>
   <?php //echo form_error('dnocasting');?>
    <?php //echo form_dropdown('shirts', $substore_details, $array, 'multiple'); ?>
    <?php //echo form_dropdown('dnocasting[]', $frmdata['manager'],isset($frmdata['subdiagnoseid']->no_ofcasting)?$frmdata['subdiagnoseid']->no_ofcasting:"", ' multiple="multiple" class="form-control" id="no_of_casting"');?> 
    </div>
</div> -->
<!--            <div id="" class="plus margin_top20" style="display: none;"> --> 
<!-- <a href="" data-toggle="modal" data-target="#myModal">Modal Link</a>  -->
<!--            </div>-->

<div class="col-md-6">
  <div class="form-group">
    <label>Start Date<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dstartdate',
'class'=>'gui-input datepicker form-control',
'placeholder'=>'Start Date',
'value'=>isset($frmdata['subdiagnoseid']->start_date)?$frmdata['subdiagnoseid']->start_date:"",
'id'=>'startdt'
);
echo form_input($data);
?><?php echo form_error('dstartdate');?>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>End Date<span class="red_text">*</span></label>
    <?php $data=array('name'=>'denddate',
'class'=>'gui-input datepicker form-control',
'placeholder'=>'End Date',
'value'=>isset($frmdata['subdiagnoseid']->end_date)?$frmdata['subdiagnoseid']->end_date:"",
'id'=>'enddt'
);
echo form_input($data);
?><?php echo form_error('denddate');?>
  </div>
</div>
 <div class="col-md-6">
         <div class="form-group">
            <label>Days<span class="red_text">*</span></label>
            <?php $data=array('name'=>'dnoofdays',
               'class'=>'gui-input form-control',
               'placeholder'=>'No Of Days',
               'value'=>isset($frmdata['subdiagnoseid']->no_ofdays)?$frmdata['subdiagnoseid']->no_ofdays:"",
               'id'=>'noofdays'
               );
               echo form_input($data);
               ?><?php echo form_error('dnoofdays');?>
         </div>
      </div>  

<div class="col-md-6">
  <div class="form-group">
    <label>No.Of Consultants</label>
   
    <?php echo form_dropdown('dcunsulting', $noofcasting,isset($frmdata['subdiagnoseid']->cunsulting_days)?$frmdata['subdiagnoseid']->cunsulting_days:"", 'class="form-control" id="cunsulting_days"');?> </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Location<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dlocation',
'class'=>'gui-input form-control',
'placeholder'=>'Location',
'value'=>isset($frmdata['subdiagnoseid']->location)?$frmdata['subdiagnoseid']->location:""
);
echo form_input($data);
?><?php echo form_error('dlocation');?>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Price Per Unit<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dpriceandunit',
'class'=>'gui-input form-control',
'id'=>'price',
'placeholder'=>'Price and Unit',
'value'=>isset($frmdata['subdiagnoseid']->price_unit)?$frmdata['subdiagnoseid']->price_unit:""
);
echo form_input($data);
?><?php echo form_error('dpriceandunit');?>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Co-Ordinator<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dcoordinator',
'class'=>'gui-input form-control',
'placeholder'=>'Co-ordinator',
'value'=>isset($frmdata['subdiagnoseid']->coordinator)?$frmdata['subdiagnoseid']->coordinator:""
);
echo form_input($data);
?><?php echo form_error('dcoordinator');?>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Email<span class="red_text">*</span></label>
    <?php $data=array('name'=>'demail',
'class'=>'gui-input form-control',
'placeholder'=>'Email',
'value'=>isset($frmdata['subdiagnoseid']->email_id)?$frmdata['subdiagnoseid']->email_id:""
);
echo form_input($data);
?><?php echo form_error('demail');?>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Contact No<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dcontact',
'class'=>'gui-input form-control',
'placeholder'=>'Contact No',
'value'=>isset($frmdata['subdiagnoseid']->contact)?$frmdata['subdiagnoseid']->contact:""
);
echo form_input($data);
?><?php echo form_error('dcontact');?>
  </div>
</div>
<div class="clearfix"></div>
<div class="col-md-6">
  <div class="form-group">
    <?php 
echo form_submit('Submit', 'Save', 'class="btn btn-primary"');

?>
  </div>
</div>
<?php echo form_close();?>
<div class=""> 
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="z-index:1000000000">
    <div class="modal-dialog"> 
      
      <!-- Modal content-->
      <div class="modal-content" style="z-index:1000000000">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
      $(function() {
     $( ".datepicker" ).datepicker({formatDate: "dd-mm-yyyy"  });
    // var dateToday = new Date();
    // $('#startdt').datepicker({ 

    //   minDate: 0,
    
    // onSelect: function(selected) {

    //         $("#enddt").datepicker("option","minDate", selected)

    //       }
    //    });

    // $("#enddt").datepicker({ 
    //     minDate: 0,
    //    onSelect: function(selected) {
    //        $("#startdt").datepicker("option","maxDate", selected)
    //     }
    // });  
  });
</script>
<script>
$(document).ready(function()
{

    $(document).on('change', '#name_of_products', function() 
    {//alert('vfdtcgvyughbgh')
        var ids=$(this).val();
        //alert('vfdtcgvyughbgh')
       // alert(ids);
        $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/diagnose/getPriceByAjax'); ?>",
                dataType: 'json',
                data: {'ids':ids},
                before:function(){},
                success: function(res)
                {
                  $('#price').val(res.totalprice.price);
                  $('#weight').val(res.totalprice.weight);
                  //console.log(res);
                } 
          });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){

$('#pax').focusout(function(){
  var p=$(this).val();
  var w=$('#weight').val();
  if(p<w)
  {
    alert('Pax greater than weight ');
    $('#weight').focus();
  }
});

$('#enddt').change(function(){
  //alert('hello');
  var dt1=$('#startdt').val();
  var dt2=$('#enddt').val();
//alert(dt1);
var date1 = new Date(dt1);
var date2 = new Date(dt2);
var timeDiff = Math.abs(date2.getTime() - date1.getTime())+1;
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
$('#noofdays').val(diffDays);
});
});
</script>
