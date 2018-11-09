<?php $noofcasting=range(0,5);

      //echo "<pre>2333";print_r($frmdata['subdiscoveryid']);
        //echo "<pre>";print_r($frmdata['selectedmangers']);die;
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
            <?php echo form_dropdown('dvyproducts',$frmdata['product'],isset($frmdata['subdiscoveryid']->products)?$frmdata['subdiscoveryid']->products:"", 'class="form-control" id="name_of_products"');?>
            <?php echo form_error('dvyproducts');?>
        </div>
    </div>

    <div class="col-md-6">
  <div class="form-group">
    <label>Sub-Products:</label>
    <?php echo form_dropdown('dsubproducts',$frmdata['subproducts'],isset($frmdata['subdiscoveryid']->subproducts)?$frmdata['subdiscoveryid']->subproducts:"", 'class="form-control" id="name_of_subproducts"');?> </div>

</div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Weight<span class="red_text">*</span></label>
            <?php $data=array('name'=>'dvyweight',
                'id'=>'weight',
            'class'=>'gui-input form-control',
            'placeholder'=>'Weight',
            'value'=>isset($frmdata['subdiscoveryid']->weight)?$frmdata['subdiscoveryid']->weight:""
            );
            echo form_input($data);
            ?><?php echo form_error('dvyweight');?>
        </div>
    </div>
     <div class="col-md-6">
         <div class="form-group">
            <label> Units</label>
            <?php $data=array('name'=>'dvyunits',
               'class'=>'gui-input form-control',
               'placeholder'=>'Units',
               'value'=>isset($frmdata['subdiscoveryid']->units)?$frmdata['subdiscoveryid']->units:"",
               'id'=>'no_of_units'
               );
               echo form_input($data);
               ?><?php echo form_error('dvlocation');?>
         </div>
 </div>  
  
    <div class="col-md-6">
        <div class="form-group">
            <label>Pax<span class="red_text">*</span></label>
            <?php $data=array('name'=>'dvypax',
                'id'=>'pax',
            'class'=>'gui-input form-control',
            'placeholder'=>'Pax',
            'value'=>isset($frmdata['subdiscoveryid']->pax)?$frmdata['subdiscoveryid']->pax:""
            );
            echo form_input($data);
            ?><?php echo form_error('dvypax');?>
        </div>
    </div>
    <!-- <div class="col-md-6">
        <div class="form-group">
            <label>Resources</label> 
            <?php echo form_dropdown('dvynocasting[]', $frmdata['castingmanager'],isset($frmdata['selectedmangers'])?$frmdata['selectedmangers']:array(), ' multiple="multiple" class="selectpicker form-control" id="no_of_casting"');?> 
   <?php echo form_error('dvynocasting');?>  
        </div>
    </div> -->
        <div class="col-md-6">
        <div class="form-group">
            <label>Start Date<span class="red_text">*</span>
            
                &nbsp;Not Confirm<?php
        $flag = isset($frmdata["subdiscoveryid"]->notconfirmed) && $frmdata["subdiscoveryid"]->notconfirmed == 1 ? TRUE : FALSE;
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
            <?php $data=array('name'=>'dvystartdate',
            'class'=>'gui-input datepicker form-control',
            'placeholder'=>'Start Date',
            'value'=>isset($frmdata['subdiscoveryid']->start_date)?$frmdata['subdiscoveryid']->start_date:"",
            'id'=>'startdt'
            );
            echo form_input($data);
            ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>End Date<span class="red_text">*</span></label>
            <?php $data=array('name'=>'dvyenddate',
            'class'=>'gui-input datepicker form-control',
            'placeholder'=>'End Date',
            'value'=>isset($frmdata['subdiscoveryid']->end_date)?$frmdata['subdiscoveryid']->end_date:"",
            'id'=>'enddt'
            );
            echo form_input($data);
            ?>
        </div>
    </div>
    <div class="col-md-6">
         <div class="form-group">
            <label>Days<span class="red_text">*</span></label>
            <?php $data=array('name'=>'dvynoofdays',
               'class'=>'gui-input form-control',
               'placeholder'=>'No Of Days',
               'value'=>isset($frmdata['subdiscoveryid']->no_ofdays)?$frmdata['subdiscoveryid']->no_ofdays:"",
               'id'=>'noofdays'
               );
               echo form_input($data);
               ?><?php echo form_error('dvynoofdays');?>
         </div>
      </div>  
   
    <div class="col-md-6">
        <div class="form-group">
            <label>No.Of Consultants</label> 
            <?php echo form_dropdown('dvycunsulting', $noofcasting,isset($frmdata['subdiscoveryid']->cunsulting_days)?$frmdata['subdiscoveryid']->cunsulting_days:"", 'class="form-control" id="cunsulting_days"');?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Location<span class="red_text">*</span></label>
            <?php $data=array('name'=>'dvylocation',
            'class'=>'gui-input form-control',
            'placeholder'=>'Location',
            'value'=>isset($frmdata['subdiscoveryid']->location)?$frmdata['subdiscoveryid']->location:""
            );
            echo form_input($data);
            ?><?php echo form_error('dvylocation');?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Price Per Unit<span class="red_text">*</span></label>                                
            <?php $data=array('name'=>'dvypriceandunit',
            'class'=>'gui-input form-control',
            'id'=>'price',
            'placeholder'=>'Price and Unit',
            'value'=>isset($frmdata['subdiscoveryid']->price_unit)?$frmdata['subdiscoveryid']->price_unit:""
            );
            echo form_input($data);
            ?><?php echo form_error('dvypriceandunit');?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Co-Ordinator<span class="red_text">*</span></label>   
            <?php $data=array('name'=>'dvycoordinator',
            'class'=>'gui-input form-control',
            'placeholder'=>'Co-ordinator',
            'value'=>isset($frmdata['subdiscoveryid']->coordinator)?$frmdata['subdiscoveryid']->coordinator:""
            );
            echo form_input($data);
            ?><?php echo form_error('dvycoordinator');?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Email<span class="red_text">*</span></label>                                             
            <?php $data=array('name'=>'dvyemail',
            'class'=>'gui-input form-control',
            'placeholder'=>'Email',
            'value'=>isset($frmdata['subdiscoveryid']->email_id)?$frmdata['subdiscoveryid']->email_id:""
            );
            echo form_input($data);
            ?><?php echo form_error('dvyemail');?>
        </div>
    </div>
    <div class="col-md-6"> 
        <div class="form-group"> 
            <label>Contact No<span class="red_text">*</span></label>                                               
            <?php $data=array('name'=>'dvycontact',
            'class'=>'gui-input form-control',
            'placeholder'=>'Contact No',
            'value'=>isset($frmdata['subdiscoveryid']->contact)?$frmdata['subdiscoveryid']->contact:""
            );
            echo form_input($data);
            ?><?php echo form_error('dvycontact');?>  
        </div>
    </div>
    <div class="col-md-12"> 
        <div class="form-group"> 
			<?php 
            echo form_submit('Submit', 'Save', 'class="btn btn-primary" ');
            ?>
        </div>
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
    $( ".datepicker" ).datepicker({format: "yyyy-mm-dd" });
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
                url: "<?php echo site_url('admin/discovery/getPriceByAjax'); ?>",
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

var date1 = new Date(dt1);
var date2 = new Date(dt2);
var timeDiff = Math.abs(date2.getTime() - date1.getTime())+1;
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
$('#noofdays').val(diffDays);
});

});
</script>