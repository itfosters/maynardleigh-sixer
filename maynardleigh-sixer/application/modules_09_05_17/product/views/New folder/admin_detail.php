<?php $ids = isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""; ?>
<div class="row">
	<div class="col-md-12">

		<div class="col-md-2">
			<ul id="tabs" class="nav nav-tabs tabs-left" data-tabs="tabs">
				<li class="active"><a href="#user_info" data-toggle="tab">User Info</a></li>
				<li><a href="#contact_info" data-toggle="tab">Contact Info</a></li>
				<li><a href="#personal_info" data-toggle="tab">Personal</a></li>
				<li><a href="#job_info" data-toggle="tab">Job</a></li>
			</ul>
		</div>

		<div class="col-md-9" id="panel_block">
			<div class="panel1 panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><?php echo !empty($ids)?"Edit":"Add new"; ?> Employee</h4>
				</div>

				<?php  echo form_open("admin/user/detail/".$ids,array("id"=>"frmfosters" ,"class"=>"form-bordered")); ?>

				<div class="panel-body">
						<?php echo form_hidden("id" ,isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""); ?>
		                <?php echo form_hidden("conact_id" ,isset($frm_data["frm_data"]->conact_id)?$frm_data["frm_data"]->conact_id:""); ?>
		                <?php echo form_hidden("personal_id" ,isset($frm_data["frm_data"]->personal_id)?$frm_data["frm_data"]->personal_id:""); ?>
		                <?php echo form_hidden("job_id" ,isset($frm_data["frm_data"]->job_id)?$frm_data["frm_data"]->job_id:""); ?>
					
						<div id="my-tab-content" class="tab-content">
							<div class="tab-pane active" id="user_info">
								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Employee Id</label>
									<?php echo form_input(array("id"=>"emp_id","name"=>"emp_id" ,"class"=>"form-control"), isset($frm_data["frm_data"]->emp_id)?$frm_data["frm_data"]->emp_id:""); ?>
									<?php echo form_error('name') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">First Name</label>
									<?php echo form_input(array("id"=>"name","name"=>"name" ,"class"=>"form-control"), isset($frm_data["frm_data"]->name)?$frm_data["frm_data"]->name:""); ?>
									<?php echo form_error('name') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Last Name</label>
									<?php echo form_input(array("id"=>"last_name","name"=>"last_name" ,"class"=>"form-control"), isset($frm_data["frm_data"]->last_name)?$frm_data["frm_data"]->last_name:""); ?>
									<?php echo form_error('last_name') ?>
								</div>


								<div class="form-group col-md-6">
									<label class="control-label" for="username">User Name</label>
									<?php echo form_input(array("id"=>"username","name"=>"username" ,"class"=>"form-control"), isset($frm_data["frm_data"]->username)?$frm_data["frm_data"]->username:""); ?>

									<?php echo form_error('name') ?>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="email">Email</label>
									<?php echo form_input(array("id"=>"email","name"=>"email" ,"class"=>"form-control"), isset($frm_data["frm_data"]->email)?$frm_data["frm_data"]->email:""); ?>
									<?php echo form_error('email') ?>
								</div>
							</div>

							<div class="tab-pane" id="contact_info">
								
								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Address1</label>
									<?php echo form_input(array("id"=>"address1","name"=>"address1" ,"class"=>"form-control"), isset($frm_data["frm_data"]->address1)?$frm_data["frm_data"]->address1:""); ?>
									<?php echo form_error('address1') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Address2</label>
									<?php echo form_input(array("id"=>"address2","name"=>"address2" ,"class"=>"form-control"), isset($frm_data["frm_data"]->address2)?$frm_data["frm_data"]->address2:""); ?>
									<?php echo form_error('address2') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">City</label>
									<?php echo form_input(array("id"=>"city","name"=>"city" ,"class"=>"form-control"), isset($frm_data["frm_data"]->city)?$frm_data["frm_data"]->city:""); ?>
									<?php echo form_error('city') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">State</label>
									<?php echo form_input(array("id"=>"state","name"=>"state" ,"class"=>"form-control"), isset($frm_data["frm_data"]->state)?$frm_data["frm_data"]->state:""); ?>
									<?php echo form_error('state') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Zip Code</label>
									<?php echo form_input(array("id"=>"zipcode","name"=>"zipcode" ,"class"=>"form-control"), isset($frm_data["frm_data"]->zipcode)?$frm_data["frm_data"]->zipcode:""); ?>
									<?php echo form_error('zipcode') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Country</label>
									<?php echo form_input(array("id"=>"country","name"=>"country" ,"class"=>"form-control"), isset($frm_data["frm_data"]->country)?$frm_data["frm_data"]->country:""); ?>
									<?php echo form_error('country') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Home Phone</label>
									<?php echo form_input(array("id"=>"home_phone","name"=>"home_phone" ,"class"=>"form-control"), isset($frm_data["frm_data"]->home_phone)?$frm_data["frm_data"]->home_phone:""); ?>
									<?php echo form_error('home_phone') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Mobile</label>
									<?php echo form_input(array("id"=>"mobile","name"=>"mobile" ,"class"=>"form-control"), isset($frm_data["frm_data"]->mobile)?$frm_data["frm_data"]->mobile:""); ?>
									<?php echo form_error('mobile') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Work Email</label>
									<?php echo form_input(array("id"=>"work_email","name"=>"work_email" ,"class"=>"form-control"), isset($frm_data["frm_data"]->work_email)?$frm_data["frm_data"]->work_email:""); ?>
									<?php echo form_error('work_email') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Other Email</label>
									<?php echo form_input(array("id"=>"other_email","name"=>"other_email" ,"class"=>"form-control"), isset($frm_data["frm_data"]->other_email)?$frm_data["frm_data"]->other_email:""); ?>
									<?php echo form_error('other_email') ?>
								</div>
							</div>

							<div class="tab-pane" id="personal_info">
								
								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Licence Number</label>
									<?php echo form_input(array("id"=>"licence_number","name"=>"licence_number" ,"class"=>"form-control"), isset($frm_data["frm_data"]->licence_number)?$frm_data["frm_data"]->licence_number:""); ?>
									<?php echo form_error('licence_number') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Licence Expire</label>
									<?php echo form_input(array("id"=>"licence_expire","name"=>"licence_expire" ,"class"=>"form-control"), isset($frm_data["frm_data"]->licence_expire)?$frm_data["frm_data"]->licence_expire:""); ?>
									<?php echo form_error('licence_expire') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Gender</label>
									<?php echo form_input(array("id"=>"gender","name"=>"gender" ,"class"=>"form-control"), isset($frm_data["frm_data"]->gender)?$frm_data["frm_data"]->gender:""); ?>
									<?php echo form_error('gender') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Marital Status</label>
									<?php echo form_input(array("id"=>"marital_status","name"=>"marital_status" ,"class"=>"form-control"), isset($frm_data["frm_data"]->marital_status)?$frm_data["frm_data"]->marital_status:""); ?>
									<?php echo form_error('marital_status') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Nationality</label>
									<?php echo form_input(array("id"=>"nationality","name"=>"nationality" ,"class"=>"form-control"), isset($frm_data["frm_data"]->nationality)?$frm_data["frm_data"]->nationality:""); ?>
									<?php echo form_error('nationality') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">DOB</label>
									<?php echo form_input(array("id"=>"dob","name"=>"dob" ,"class"=>"form-control"), isset($frm_data["frm_data"]->dob)?$frm_data["frm_data"]->dob:""); ?>
									<?php echo form_error('dob') ?>
								</div>
							</div>

							<div class="tab-pane" id="job_info">
								
								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Job Title</label>
									<?php  echo form_dropdown("job_type_id", $job_type_list, isset($frm_data["frm_data"]->job_type_id) ? $frm_data["frm_data"]->job_type_id : "0", array('id' => "job_type_id","class"=>"selectpicker form-control"));  ?>
									<?php echo form_error('job_type_id') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Salary</label>
									<?php echo form_input(array("id"=>"salary","name"=>"salary" ,"class"=>"form-control"), isset($frm_data["frm_data"]->salary)?$frm_data["frm_data"]->salary:""); ?>
									<?php echo form_error('salary') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Employment Status</label>
									<?php echo form_input(array("id"=>"emp_status","name"=>"emp_status" ,"class"=>"form-control"), isset($frm_data["frm_data"]->emp_status)?$frm_data["frm_data"]->emp_status:""); ?>
									<?php echo form_error('licence_expire') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Job Category</label>
									<?php  echo form_dropdown("job_category_id", $job_category_list, isset($frm_data["frm_data"]->job_category_id) ? $frm_data["frm_data"]->job_category_id : "0", array('id' => "job_category_id","class"=>"selectpicker form-control"));  ?>
									<?php echo form_error('job_category_id') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Joined Date</label>
									<?php echo form_input(array("id"=>"join_date","name"=>"join_date" ,"class"=>"form-control"), isset($frm_data["frm_data"]->join_date)?$frm_data["frm_data"]->join_date:""); ?>
									<?php echo form_error('join_date') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Location</label>
									<?php  echo form_dropdown("location_id", $location_list, isset($frm_data["frm_data"]->location_id) ? $frm_data["frm_data"]->location_id : "0", array('id' => "location_id","class"=>"selectpicker form-control"));  ?>
									<?php echo form_error('location_id') ?>

								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Start Date</label>
									<?php echo form_input(array("id"=>"contract_start_date","name"=>"contract_start_date" ,"class"=>"form-control"), isset($frm_data["frm_data"]->contract_start_date)?$frm_data["frm_data"]->contract_start_date:""); ?>
									<?php echo form_error('contract_start_date') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">End Date</label>
									<?php echo form_input(array("id"=>"contract_end_date","name"=>"contract_end_date" ,"class"=>"form-control"), isset($frm_data["frm_data"]->contract_end_date)?$frm_data["frm_data"]->contract_end_date:""); ?>
									<?php echo form_error('contract_end_date') ?>
								</div>

								<div class="form-group col-md-6">
									<label class="control-label"  for="name">Contract Details</label>
									<?php echo form_input(array("id"=>"contract_detail","name"=>"contract_detail" ,"class"=>"form-control"), isset($frm_data["frm_data"]->contract_detail)?$frm_data["frm_data"]->contract_detail:""); ?>
									<?php echo form_error('contract_detail') ?>
								</div>								
							</div>


						</div>

				</div>

				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-12 ">
							<button class="btn btn-primary mr5 pull-right"  type="submit">Save</button>
						</div>
					</div>
				</div>

				<?php echo form_close(); ?>
			</div>  
		</div>                                 

	</div>
</div>