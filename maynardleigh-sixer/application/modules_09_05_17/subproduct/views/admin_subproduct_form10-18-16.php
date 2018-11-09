<div>
</div>
<div>
	<?php 
		$subproduct=array('1'=>'Diagnose',
						'2'=>'Design',
						'3'=>'Delivery',
						'4'=>'Discovery');

	?>
	<?php $id=isset($frm_data['view']->id)?$frm_data['view']->id:'';?>
	<?php //echo "<pre>";print_r($frm_data['view']->email_Id);die;?>
	<?php echo form_open('admin/subproduct/form'.'/'.$id); ?>
    <div class="row">
	<div class="section col-md-6">
    <div class="form-group">
	<label>Name </label>
	 <?php $data=array( 
	 			'name' => 'name',
				'class'=> 'form-control',
	 			'value'=>isset($frm_data['view']->name)?$frm_data['view']->name:''
	 			);
	 echo form_input($data);?><?php echo form_error('name'); ?> 
     </div>
	 </div>
    <div class="clearfix"></div>
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
font-size:13px;
margin-bottom:-15px
}</style>