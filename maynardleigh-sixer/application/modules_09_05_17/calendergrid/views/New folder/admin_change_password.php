<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Change Password</h4>
			</div>

			<?php  echo form_open("admin/user/change_password",array("id"=>"frmfosters" ,"class"=>"form-bordered")); ?>
			<div class="panel-body">

				<div class="col-sm-6">
				<label class="control-label" for="name">Old Password</label> 
				<?php echo form_password(array("id"=>"opassword","name"=>"opassword","placeholder"=>"Old Password","class"=>"form-control"), isset($frm_data["frm_data"]->opassword) ? $frm_data["frm_data"]->opassword : ""); ?>
				<?php echo form_error('opassword') ?>
                </div>
                <div class="clearfix"></div>

                <div class="col-sm-6">
                <label class="control-label" for="name">New Password</label> 
                <?php echo form_password(array("id"=>"npassword","name"=>"npassword","placeholder"=>"New Password","class"=>"form-control"), isset($frm_data["frm_data"]->npassword) ? $frm_data["frm_data"]->npassword : ""); ?>
                <?php echo form_error('npassword') ?>
                </div>
                <div class="clearfix"></div>

                <div class="col-sm-6">
                <label class="control-label" for="name">Confirm Password</label> 
                <?php echo form_password(array("id"=>"cpassword","name"=>"cpassword","placeholder"=>"Confirm Password","class"=>"form-control"), isset($frm_data["frm_data"]->cpassword) ? $frm_data["frm_data"]->cpassword : ""); ?>
                <?php echo form_error('cpassword') ?>
                </div>


			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-5">
						<button class="btn btn-primary mr5"  type="submit">Submit</button>
					</div>
				</div>
			</div>

			<?php echo form_close(); ?>
		</div>                                   

	</div>

</div>