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
$priceunit=array(
            '0'=>'Price per unit',
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
    <label>Details<span class="red_text">*</span></label>
    <?php $data=array('name'=>'ddetails',
'class'=>'gui-input form-control',
'placeholder'=>'Details',
'value'=>isset($frmdata['subdiagnoseid']->details)?$frmdata['subdiagnoseid']->details:""
);
echo form_input($data);

?><?php echo form_error('ddetails');?>
  </div>
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
    <label>Units</label>
    <?php echo form_dropdown('dunits', $priceunit,isset($frmdata['subdiagnoseid']->units)?$frmdata['subdiagnoseid']->units:"", 'class="form-control" id="no_of_units"');?>
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
<div class="col-md-6">
  <div class="form-group"> 
  <label>Casting</label>
  <?php //echo "<pre>";print_r($frmdata['castingmanager']);
                      //print_r($frmdata['castingemail']);die;?>
  <?php echo form_dropdown('dnocasting[]',$frmdata['castingmanager'],isset($frmdata['selectedmangers'])?$frmdata['selectedmangers']:array(), ' multiple="multiple" class="selectpicker form-control" id="no_of_casting"');?> 
  <?php //echo form_dropdown();?>
   <?php echo form_error('dnocasting');?>
    <?php //echo form_dropdown('shirts', $substore_details, $array, 'multiple'); ?>
    <?php //echo form_dropdown('dnocasting[]', $frmdata['manager'],isset($frmdata['subdiagnoseid']->no_ofcasting)?$frmdata['subdiagnoseid']->no_ofcasting:"", ' multiple="multiple" class="form-control" id="no_of_casting"');?> 
    </div>
</div>
<!--            <div id="" class="plus margin_top20" style="display: none;"> --> 
<!-- <a href="" data-toggle="modal" data-target="#myModal">Modal Link</a>  -->
<!--            </div>-->
<div class="col-md-6">
  <div class="form-group">
    <label>Days<span class="red_text">*</span></label>
    <?php echo form_dropdown('dnoofdays', $noofcasting,isset($frmdata['subdiagnoseid']->no_ofdays)?$frmdata['subdiagnoseid']->no_ofdays:"", 'class="form-control" id="no_of_days"');?> 
    </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label>Cunsulting</label>
   
    <?php echo form_dropdown('dcunsulting', $noofcasting,isset($frmdata['subdiagnoseid']->cunsulting_days)?$frmdata['subdiagnoseid']->cunsulting_days:"", 'class="form-control" id="cunsulting_days"');?> </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Start Date<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dstartdate',
'class'=>'gui-input datepicker form-control',
'placeholder'=>'Start Date',
'value'=>isset($frmdata['subdiagnoseid']->start_date)?$frmdata['subdiagnoseid']->start_date:""
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
'value'=>isset($frmdata['subdiagnoseid']->end_date)?$frmdata['subdiagnoseid']->end_date:""
);
echo form_input($data);
?><?php echo form_error('denddate');?>
  </div>
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
    <label>Price And Unit<span class="red_text">*</span></label>
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
<script type="text/javascript">
      $(function() {
    $( ".datepicker" ).datepicker({formatDate: "yyyy-mm-dd"  });
      });
      </script>
      <style type="text/css">
</style>
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
});
</script>
