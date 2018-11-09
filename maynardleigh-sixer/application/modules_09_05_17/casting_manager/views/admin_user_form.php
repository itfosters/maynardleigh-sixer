
<div class="row">
	<?php $id=isset($frm_data['view']->id)?$frm_data['view']->id:''; ?>
	<?php //echo "<pre>";print_r($frm_data['view']->email_Id);die; ?>
	<?php echo form_open('admin/casting_manager/form'.'/'.$id); ?>
	<div class="col-md-6">
    <div class="form-group">
	<label>Name </label> 	
	<?php $data=array( 
	 			'name' => 'name',
				'class'=> 'form-control',
	 			'value'=>isset($frm_data['view']->name)?$frm_data['view']->name:''
	 			);
	 echo form_input($data); ?><?php echo form_error('name'); ?>
	
     </div>
     </div>
     <div class="col-md-6">
     <div class="form-group">
	 <label>Email Id</label>
	<?php $data=array( 
	 			'name' => 'email',
				'class'=> 'form-control',
	 			'value'=>isset($frm_data['view']->email)? $frm_data['view']->email:''
	 			);
	 echo form_input($data); ?><?php echo form_error('email'); ?>
	 </div>
     </div>
     <?php if(empty($id)){?>
	 <div class="col-md-6">
     <div class="form-group">
	 <label>Password</label>
	<?php $data=array( 
	 			'name' => 'password',
				'class'=> 'form-control',
	 			//'value'=>isset($frm_data['view']->password))? $frm_data['view']->password:''
	 			);
	 echo form_input($data); ?><?php echo form_error('password'); ?>
 	</div>
     </div>
     <?php }?>
      <div class="col-md-6">
     <div class="form-group">
 <label>Contact No.</label>
 <?php $data=array( 
	 			'name' => 'contact_no',
				'class'=> 'form-control',
	 			'value'=>isset($frm_data['view']->contact_no)? $frm_data['view']->contact_no:''
	 			);
	 echo form_input($data); ?><?php echo form_error('contact_no'); ?>
	</div>
	 </div>
	<div class="clearfix"></div>
    <div class="col-md-6">
    
	 <?php $data=array('value' => 'Submit',
	 'class'=> 'btn btn-primary',
	 			 'name'=>'submit'
	 			 );
		echo form_submit($data); ?>
	</div>	
 <?php echo form_close(); ?>

</div>
<style type="text/css">.error {
color:red;
font-size:13px;
margin-bottom:-15px
}</style>
