<?php $ids = isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""; ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?php echo !empty($ids)?"Edit":"Add new"; ?> User</h4>
			</div>

			<?php  echo form_open("admin/user/form/".$ids,array("id"=>"frmfosters" ,"class"=>"form-bordered")); ?>
			<div class="panel-body">
				<?php echo form_hidden("id" ,isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""); ?>
				<div class="form-group col-md-4">
					<label class="control-label"  for="name">First Name</label>
					<?php echo form_input(array("id"=>"name","name"=>"name" ,"class"=>"form-control"), isset($frm_data["frm_data"]->name)?$frm_data["frm_data"]->name:""); ?>
					<?php echo form_error('name') ?>
				</div>

				<div class="form-group col-md-4">
					<label class="control-label"  for="name">Last Name</label>
					<?php echo form_input(array("id"=>"last_name","name"=>"last_name" ,"class"=>"form-control"), isset($frm_data["frm_data"]->last_name)?$frm_data["frm_data"]->last_name:""); ?>
					<?php echo form_error('last_name') ?>
				</div>


				<div class="form-group col-md-4">
					<label class="control-label" for="username">User Name</label>
					<?php echo form_input(array("id"=>"username","name"=>"username" ,"class"=>"form-control"), isset($frm_data["frm_data"]->username)?$frm_data["frm_data"]->username:""); ?>

					<?php echo form_error('name') ?>
				</div>
				<div class="form-group col-md-4">
					<label class="control-label" for="email">Email</label>
					<?php echo form_input(array("id"=>"email","name"=>"email" ,"class"=>"form-control"), isset($frm_data["frm_data"]->email)?$frm_data["frm_data"]->email:""); ?>
					<?php echo form_error('email') ?>
				</div>

				<div class="form-group col-md-4">
					<label class="control-label" for="emp_id">Company User ID</label>
					<?php echo form_input(array("id"=>"emp_id","name"=>"emp_id" ,"class"=>"form-control"), isset($frm_data["frm_data"]->emp_id)?$frm_data["frm_data"]->emp_id:""); ?>
					<?php echo form_error('emp_id') ?>
				</div>


				<div class="form-group col-md-4">
					<label class="control-label" for="name">User type</label>        
					<?php echo form_dropdown("user_type", $user_type,isset($frm_data["frm_data"]->user_type)?$frm_data["frm_data"]->user_type:"",array("class"=>"form-control")); ?>
					<?php echo form_error('user_type') ?>
				</div>
			
				<div class="form-group col-md-4">
					<label class="control-label" for="name">Password</label>
					<?php echo form_password(array("id"=>"password","name"=>"password","class"=>"form-control")); ?>
					<?php echo form_error('password') ?>
				</div>

				<div class="form-group col-md-4">
					<label class="control-label" for="name">Confirm Password</label>
					<?php echo form_password(array("id"=>"cpassword","name"=>"cpassword","class"=>"form-control")); ?>
					<?php echo form_error('cpassword') ?>		
				</div>
			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-5">
						<button class="btn btn-primary mr5"  type="submit">Save</button>
					</div>
				</div>
			</div>

			<?php echo form_close(); ?>
		</div>                                   

	</div>
</div>