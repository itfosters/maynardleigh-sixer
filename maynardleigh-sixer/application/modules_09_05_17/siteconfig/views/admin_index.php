<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Configuration</h4>
			</div>
			<?php 
			echo form_open("admin/siteconfig/index",array("id"=>"frmfosters","class"=>"form-bordered")); ?>
			<div class="panel-body">



				<div class="form-group col-md-6">
				<label class="control-label" for="name">Site Title</label>
						<?php echo form_input(array("name"=>"site_title" ,"class"=>"form-control"), isset($frm_data["site_title"])?$frm_data["site_title"]:""); ?>
						<?php echo form_error("site_title") ?>
				</div>
				<div class="form-group col-md-6">
					<label class="control-label" for="name">Contact Email</label>
						<?php echo form_input(array("name"=>"contact_email" ,"class"=>"form-control"), isset($frm_data["contact_email"])?$frm_data["contact_email"]:""); ?>
						<?php echo form_error("contact_email") ?>
			</div>

				<div class="form-group col-md-6">
					<label class="control-label" for="name">Site Email</label>
						<?php echo form_input(array("name"=>"site_email" ,"class"=>"form-control"), isset($frm_data["site_email"])?$frm_data["site_email"]:""); ?>
						<?php echo form_error("site_email") ?>
				</div>

				<div class="form-group col-md-6">
					<label class="control-label" for="name">Site Phone</label>
						<?php echo form_input(array("name"=>"site_phone" ,"class"=>"form-control"), isset($frm_data["site_phone"])?$frm_data["site_phone"]:""); ?>
						<?php echo form_error("site_phone") ?>
				</div>

				<div class="form-group col-md-6">
					<label class="control-label" for="name">Google Code</label>
						<?php echo form_input(array("name"=>"google_code" ,"class"=>"form-control"), isset($frm_data["google_code"])?$frm_data["google_code"]:""); ?>
						<?php echo form_error("google_code") ?>
				</div>

				<div class="form-group col-md-12">
					<label class="control-label" for="name">Meta Keyword</label>
						<?php echo form_textarea(array("name"=>"site_keyword" ,"class"=>"form-control","rows"=>"5"), isset($frm_data["site_keyword"])?$frm_data["site_keyword"]:""); ?>
						<?php echo form_error("site_keyword") ?>
				</div>

				<div class="form-group col-md-12">
					<label class="control-label" for="name">Meta Content</label>
						<?php echo form_textarea(array("name"=>"site_content" ,"class"=>"form-control" ,"rows"=>"5"), isset($frm_data["site_content"])?$frm_data["site_content"]:""); ?>
						<?php echo form_error("site_content") ?>
				</div>
			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-6">
						<button class="btn btn-primary" type="submit">Save Configuration</button>
					</div>
				</div>
			</div><?php echo form_close(); ?>

		</div>
	</div>
</div>