<?php $ids = isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""; ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?php echo !empty($ids)?"Edit":"Add new"; ?> Location</h4>
			</div>

			<?php  echo form_open("admin/location/form/".$ids,array("id"=>"frmfosters" ,"class"=>"form-bordered")); ?>
			<div class="panel-body">

				<?php echo form_hidden("id" ,isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""); ?>

				<div class="form-group col-sm-6">
				<label class="control-label" for="name">Name</label>
						<?php echo form_input(array("id"=>"name","name"=>"name" ,"class"=>"form-control"), isset($frm_data["frm_data"]->name)?$frm_data["frm_data"]->name:""); ?>
						<?php echo form_error('name') ?>
				</div>

				<div class="form-group col-sm-6">
				<label class="control-label" for="name">City</label>
						<?php echo form_input(array("id"=>"city","name"=>"city" ,"class"=>"form-control"), isset($frm_data["frm_data"]->city)?$frm_data["frm_data"]->city:""); ?>
						<?php echo form_error('city') ?>
				</div>

				<div class="form-group col-sm-6">
				<label class="control-label" for="name">State</label>
						<?php echo form_input(array("id"=>"state","name"=>"state" ,"class"=>"form-control"), isset($frm_data["frm_data"]->state)?$frm_data["frm_data"]->state:""); ?>
						<?php echo form_error('state') ?>
				</div>

				<div class="form-group col-sm-6">
				<label class="control-label" for="name">Pin Code</label>
						<?php echo form_input(array("id"=>"pincode","name"=>"pincode" ,"class"=>"form-control"), isset($frm_data["frm_data"]->pincode)?$frm_data["frm_data"]->pincode:""); ?>
						<?php echo form_error('pincode') ?>
				</div>

				<div class="form-group col-sm-6">
				<label class="control-label" for="name">Phone</label>
						<?php echo form_input(array("id"=>"phone","name"=>"phone" ,"class"=>"form-control"), isset($frm_data["frm_data"]->phone)?$frm_data["frm_data"]->phone:""); ?>
						<?php echo form_error('phone') ?>
				</div>

				<div class="form-group col-sm-6">
				<label class="control-label" for="name">Address</label>
						<?php echo form_input(array("id"=>"address","name"=>"address" ,"class"=>"form-control"), isset($frm_data["frm_data"]->address)?$frm_data["frm_data"]->address:""); ?>
						<?php echo form_error('address') ?>
				</div>



			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-5">
						<button class="btn btn-primary mr5"  type="submit">Save</button>
					</div>
				</div>
			</div>

			<?php echo form_close(); ?>
		</div>                                   

	</div>

</div>