<div>
</div>
<div>
	<?php 
		$proname=array();
		//isset($proname)?$proname:'';
		if(isset($frm_data['mrs']->name))
        $proname=explode(',', $frm_data['mrs']->name);
        //echo "###<pre>";print_r($proname);die;
		$product=array('1'=>'Diagnose',
						'2'=>'Design',
						'3'=>'Delivery',
						'4'=>'Discovery');
                

	?>
	<?php $id=isset($frm_data['view']->id)?$frm_data['view']->id:'';?>
	<?php //echo "<pre>";print_r($frm_data['view']->email_Id);die;?>
	<?php echo form_open('admin/product/form'.'/'.$id); ?>
    <div class="row">
	<div class="section col-md-6">
    <div class="form-group">
	<label>Name <span class="red_text">*</span></label>
	 <?php $data=array( 
	 			'name' => 'name',
				'class'=> 'form-control',
	 			'value'=>isset($frm_data['view']->name)?$frm_data['view']->name:''
	 			);
	 echo form_input($data);?><?php echo form_error('name'); ?> 
     </div>
	 </div>
     <div class="section col-md-6">
      <div class="form-group">
	<label>Price <span class="red_text">*</span></label>
	 
	 <?php $data=array( 
	 			'name' => 'price',
				'class'=> 'form-control',
	 			'value'=>isset($frm_data['view']->price)? $frm_data['view']->price:''
	 			);
	 echo form_input($data);?><?php echo form_error('price'); ?> 
     </div>
     </div>
     <div class="section col-md-6">
      <div class="form-group">
	 <label>Weight<span class="red_text">*</span></label>

	 <?php $data=array( 
	 			'name' => 'weight',
				'class'=> 'form-control',
	 			'value'=>isset($frm_data['view']->weight)? $frm_data['view']->weight:''
	 			);
	 echo form_input($data);?><?php echo form_error('weight'); ?> 
     </div>
     </div>
     <div class="section col-md-6">
      <div class="form-group">
	<label>Product Type <span class="red_text">*</span></label>
	 <?php echo form_dropdown('product_type',$product,isset($frm_data['view']->product_type)? $frm_data['view']->product_type:'', 'class="form-control deliveychange" '); ?>
 
	 
     </div>
	 </div>
	 <div class="section col-md-6" id="mySelect" style="display:<?php echo (isset($frm_data['view']->product_type) && ($frm_data['view']->product_type=='3'))?'inline':'none';?>;">
      <div class="form-group">
      	<?php //echo "####%%%<pre>";print_r($proname);die;?>
	<?php echo form_dropdown('mrs_list[]',$mrsproduct,$proname, 'multiple="multiple" class="selectpicker fixed form-control "'); ?>
      </div>
  </div>
	<div class="section col-md-6">
	 <?php $data=array('value' => 'submit',
	 			 'name'=>'submit',
				 'class'=> 'btn btn-primary',
	 			 );
		echo form_submit($data);?>
		</div>
	</div>	
	 <?php //echo form_submit(array('id' => 'update', 'value' => 'Update','name'=>'update'));?>
	 <?php //echo form_submit(array('id' => 'delete', 'value' => 'Delete','name'=>'delete')); ?>
	<?php echo form_close(); ?>

	 
</div>
<style type="text/css">
.error {
color:red;

}</style>

<script>
$( ".deliveychange" ).change(function() {
 var selectvalue = $(this).val();
 if(selectvalue==3){
 	$('#mySelect').show();
 }else{
 	$('#mySelect').hide();
 }
});
</script>