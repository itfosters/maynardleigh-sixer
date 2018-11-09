<?php $profile=array("profile"=>"profile_image_data"); ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Profile Image</h4>
			</div>

			<?php  echo form_open_multipart("user/profile_image/",array("id"=>"frmfosters" ,"class"=>"form-bordered"),$profile); ?>
			<div class="panel-body">
				
				<div class="form-group col-md-4">
					<label class="control-label" for="your_image">Profile Image</label>
					<?php echo form_upload(array("id"=>"your_image","name"=>"your_image" )); ?>					
					<?php echo form_error('your_image') ?>
				</div>	
			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-5">
						<button class="btn btn-primary mr5"  type="submit">Update Image</button>
					</div>
				</div>
			</div>

			<?php echo form_close(); ?>
		</div>
	</div>
</div>