<?php $ids = isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""; ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?php echo !empty($ids)?"Edit":"Add new"; ?> mail</h4>
			</div>
			<?php 
			echo form_open("admin/mail/form/".$ids,array("id"=>"frmfosters","class"=>"form-bordered")); ?>
			<div class="panel-body">

				<?php echo form_hidden("id" ,isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""); ?>


				<div class="form-group col-sm-4">
					<label class="control-label" for="name">Title</label>
				
						<?php echo form_input(array("id"=>"mailtitle","name"=>"mailtitle" ,"class"=>"form-control"), isset($frm_data["frm_data"]->mailtitle)?$frm_data["frm_data"]->mailtitle:""); ?>
						<?php echo form_error('mailtitle') ?>
				</div>

				<div class="form-group col-sm-4">
					<label class="control-label" for="name">Subject</label>
					
						<?php echo form_input(array("id"=>"mailsubject","name"=>"mailsubject" ,"class"=>"form-control"), isset($frm_data["frm_data"]->mailsubject)?$frm_data["frm_data"]->mailsubject:""); ?>
						<?php echo form_error('mailsubject') ?>
				</div>


				<div class="form-group col-sm-4">
					<label class="control-label" for="name">From Name</label>
						<?php echo form_input(array("id"=>"fromname","name"=>"fromname","class"=>"form-control"), isset($frm_data["frm_data"]->fromname)?$frm_data["frm_data"]->fromname:""); ?>
				</div>


				<div class="form-group col-sm-12">
					<label class="control-label" for="name">Mail Body</label>
						<?php echo form_textarea(array("id"=>"mailbody","name"=>"mailbody","class"=>"form-control"), isset($frm_data["frm_data"]->mailbody)?$frm_data["frm_data"]->mailbody:""); ?>
				</div>


			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-5">
						<button class="btn btn-primary mr5" type="submit">Save Configuration</button>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>                              
		</div>
	</div>

</div>