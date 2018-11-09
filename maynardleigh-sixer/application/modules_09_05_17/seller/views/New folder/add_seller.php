<div>
<h3>Add Seller</h3>
</div>
<div class="row">
	<?php $id=isset($frm_data['view']->id)?$frm_data['view']->id:'';?>
	<?php //echo "<pre>";print_r($frm_data['view']->email_Id);die; ?>
	<?php echo form_open('admin/seller/form'.'/'.$id); ?>
	<div class="col-md-6">
      <div class="form-group">
	 <label>Name </label>
	 <?php  $data=array( 
	 			'name' => 'name',
				'class'=>'form-control',
	 			'value'=>isset($frm_data['view']->name)?$frm_data['view']->name:''
	 			);
	 echo form_input($data);?><?php echo form_error('name'); ?>
     </div>
     </div>
     <div class="col-md-6">
      <div class="form-group">
	 <label> Email Id </label>
     <?php
	 if(!empty($id)){
	 ?>
	 <?php $data=array( 
	 			'name' => 'email',
				'class'=>'form-control',
				'readonly'=>'true',
	 			'value'=>isset($frm_data['view']->email)? $frm_data['view']->email:''
	 			);
	 echo form_input($data); ?><?php echo form_error('email'); 
	 }else{?>
	 <?php $data=array( 
	 			'name' => 'email',
				'class'=>'form-control',
	 			'value'=>isset($frm_data['view']->email)? $frm_data['view']->email:''
	 			);
	 echo form_input($data); ?><?php echo form_error('email'); 
	 }
	 ?>
     
</div>
	 </div>
	<div class="col-md-6">
      <div class="form-group">
	 <?php  $data=array('value' => 'submit',
	 			'class'=>'btn btn-primary',
	 			 'name'=>'submit'
	 			 );
		echo form_submit($data);?>
		</div>
        </div>	
		
	 <?php  //echo form_submit(array('id' => 'update', 'value' => 'Update','name'=>'update'));?>
	<?php  //echo form_submit(array('id' => 'delete', 'value' => 'Delete','name'=>'delete')); ?>
	<?php  echo form_close();  ?>

	
</div>
<style type="text/css">
.error {
color:red;
font-size:13px;
margin-bottom:-15px
}</style>