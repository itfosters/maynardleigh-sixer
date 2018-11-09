<?php 
$noofcasting=range(0,5);

//echo "@@<pre>";print_r($frmdata['subdesignid']);
//echo "<pre>";print_r($frmdata['selectmanager']);die;


?>
<html>
<head>
<title></title>
</head>
<body>
<?php echo form_open();?>
<div class="col-md-6">
  <div class="form-group">
    <label>Products</label>
    <?php echo form_dropdown('dgproducts',$frmdata['product'],isset($frmdata['subdesignid']->products)?$frmdata['subdesignid']->products:"", 'class="form-control" id="name_of_products"');?> </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Sub-Products:</label>
    <?php echo form_dropdown('dsubproducts',$frmdata['subproducts'],isset($frmdata['subdesignid']->subproducts)?$frmdata['subdesignid']->subproducts:"", 'class="form-control" id="name_of_subproducts"');?> </div>

</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Weight<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dgweight',
      'id'=>'weight',
'class'=>'gui-input  form-control',
'placeholder'=>'Weight',
'value'=>isset($frmdata["subdesignid"]->weight)?$frmdata["subdesignid"]->weight:''
);
echo form_input($data);
?><?php echo form_error('dgweight');?>
  </div>
</div>
<div class="col-md-6">
         <div class="form-group">
            <label> Units</label>
            <?php $data=array('name'=>'dgunits',
               'class'=>'gui-input form-control',
               'placeholder'=>'Units',
               'value'=>isset($frmdata['subdesignid']->units)?$frmdata['subdesignid']->units:"",
               'id'=>'no_of_units'
               );
               echo form_input($data);
               ?><?php echo form_error('dgunits');?>
         </div>
      </div>   

<div class="col-md-6">
  <div class="form-group">
    <label>Pax<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dgpax',
      'id'=>'pax',
'class'=>'gui-input  form-control',
'placeholder'=>'Pax',
'value'=>isset($frmdata["subdesignid"]->pax)?$frmdata["subdesignid"]->pax:''
);
echo form_input($data);
?><?php echo form_error('dgpax');?>
  </div>
</div>
<!-- <div class="col-md-6">
  <div class="form-group">
    <label>Resources</label>
     <?php echo form_dropdown('dgnocasting[]', $frmdata['castingmanager'],isset($frmdata['selectedmangers'])?$frmdata['selectedmangers']:array(), ' multiple="multiple" class="selectpicker form-control" id="no_of_casting"');?>  
     <?php echo form_error('dgnocasting');?>
  </div>
</div> -->

<div class="col-md-6">
  <div class="form-group">
    <label>Start Date<span class="red_text">*</span>
        
        &nbsp;Not Confirm<?php
        $flag = isset($frmdata["subdesignid"]->notconfirmed) && $frmdata["subdesignid"]->notconfirmed == 1 ? TRUE : FALSE;
        $data1 = array(
            'name' => 'notconfirmed',
            'id' => 'notconfirmed',
            'value' => '1',
            'checked' => $flag,
            'style' => 'margin:10px'
        );

        echo form_checkbox($data1);
        ?>
    </label>
    <?php $data=array('name'=>'dgstartdate',
'class'=>'gui-input datepicker form-control',
'placeholder'=>'Start Date',
'value'=>isset($frmdata["subdesignid"]->start_date)?$frmdata["subdesignid"]->start_date:'',
 'id'=>'startdt'
);
echo form_input($data);
?>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>End Date<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dgenddate',
'class'=>'gui-input  form-control datepicker',
'placeholder'=>'End Date',
'value'=>isset($frmdata["subdesignid"]->end_date)?$frmdata["subdesignid"]->end_date:'',
 'id'=>'enddt'
);
echo form_input($data);
?>
  </div>
</div>
  <div class="col-md-6">
         <div class="form-group">
            <label>Days<span class="red_text">*</span></label>
            <?php $data=array('name'=>'dgnoofdays',
               'class'=>'gui-input form-control',
               'placeholder'=>'No Of Days',
               'value'=>isset($frmdata["subdesignid"]->no_ofdays) ? $frmdata["subdesignid"]->no_ofdays:"",
               'id'=>'noofdays'
               );
               echo form_input($data);
               ?><?php echo form_error('dgnoofdays');?>
         </div>
      </div>  

<div class="col-md-6">
  <div class="form-group">
    <label>No.Of Consultants</label>
    <?php echo form_dropdown('dgcunsulting', $noofcasting,isset($frmdata['subdesignid']->cunsulting_days)?$frmdata['subdesignid']->cunsulting_days:"", 'class="form-control" id="cunsulting_days"');?> </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Location<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dglocation',
'class'=>'gui-input  form-control',
'placeholder'=>'Location',
'value'=>isset($frmdata["subdesignid"]->location)?$frmdata["subdesignid"]->location:''
);
echo form_input($data);
?><?php echo form_error('dglocation');?>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Price Per Unit<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dgpriceandunit',
'class'=>'gui-input  form-control',
'id'=>'price',
'placeholder'=>'Price and Unit',
'value'=>isset($frmdata["subdesignid"]->price_unit)?$frmdata["subdesignid"]->price_unit:''
);
echo form_input($data);
?><?php echo form_error('dgpriceandunit');?>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Co-Ordinator<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dgcoordinator',
'class'=>'gui-input  form-control',

'placeholder'=>'Co-ordinator',
'value'=>isset($frmdata["subdesignid"]->coordinator)?$frmdata["subdesignid"]->coordinator:''
);
echo form_input($data);
?><?php echo form_error('dgcoordinator');?>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Email<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dgemail',
'class'=>'gui-input  form-control',
'placeholder'=>'Email',
'value'=>isset($frmdata["subdesignid"]->email_id)?$frmdata["subdesignid"]->email_id:''
);
echo form_input($data);
?><?php echo form_error('dgemail');?>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Contact No<span class="red_text">*</span></label>
    <?php $data=array('name'=>'dgcontact',
'class'=>'gui-input  form-control',
'placeholder'=>'Contact No',
'value'=>isset($frmdata["subdesignid"]->contact)?$frmdata["subdesignid"]->contact:''
);
echo form_input($data);
?><?php echo form_error('dgcontact');?>
  </div>
</div>
<div class="clearfix"></div>
<div class="col-md-6">
  <div class="form-group">
    <?php 
echo form_submit('Submit', 'Save','class="btn btn-primary"');

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
.error {
color:red;
font-size:13px;
margin-bottom:-15px
}</style>
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
  var dt1=$('#startdt').val();
  var dt2=$('#enddt').val();
//alert(dt1);
var date1 = new Date(dt1);
var date2 = new Date(dt2);
var timeDiff = Math.abs(date2.getTime() - date1.getTime())+1;
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
//alert(diffDays); 
$('#noofdays').val(diffDays);
});
});
</script>