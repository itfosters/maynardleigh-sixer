<?php  $ids = isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""; ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?php echo !empty($ids)?"Edit":"Add new"; ?> mail</h4>
			</div>

			<?php  echo form_open("admin/block/form/".$ids,array("id"=>"frmfosters" ,"class"=>"fform-bordered")); ?>
			<div class="panel-body">

				<?php echo form_hidden("id" ,isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""); ?>

				<div class="form-group col-md-6">
				<label class="control-label" for="name">Name</label>
						<?php echo form_input(array("id"=>"name","name"=>"name" ,"class"=>"form-control"), isset($frm_data["frm_data"]->name)?$frm_data["frm_data"]->name:""); ?>
						<?php echo form_error('name') ?>					
				</div>


				<div class="form-group col-md-6">
					<label class="control-label" for="title">Title</label>
					<?php echo form_input(array("id"=>"title","name"=>"title" ,"class"=>"form-control"), isset($frm_data["frm_data"]->title)?$frm_data["frm_data"]->title:""); ?>
						<?php echo form_error('title') ?>
				</div>

				<div class="form-group col-md-12">
					<label class="control-label" for="description">Content</label>
						<?php echo form_textarea(array("id"=>"description","name"=>"description","class"=>"textarea"), isset($frm_data["frm_data"]->description)?$frm_data["frm_data"]->description:""); ?>
					<?php echo form_error('description') ?>
				</div>
			</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-6">
					<button class="btn btn-primary"  type="submit">Save</button>
				</div>
			</div>
		</div>

		<?php echo form_close(); ?>
	</div>                                   

</div>
</div>
