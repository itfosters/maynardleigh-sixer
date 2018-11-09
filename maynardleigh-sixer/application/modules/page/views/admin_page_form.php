<?php $ids = isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:"";?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?php echo !empty($ids)?"Edit":"Add new"; ?> page</h4>
			</div>

			<?php echo form_open("admin/page/form/".$ids,array("id"=>"frmfosters","class"=>"")); ?>   
			<div class="panel-body">


				<?php echo form_hidden("id" ,isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""); ?>




				<div class="form-group col-sm-6">
					<label for="title">Title</label>
						<?php echo form_input(array("id"=>"title","name"=>"title" ,"class"=>"form-control"), isset($frm_data["frm_data"]->title)?$frm_data["frm_data"]->title:""); ?>
						<?php echo form_error('title') ?>					
				</div>

				<div class="form-group col-sm-6">
					<label for="name">Alias Name</label>
						<?php echo form_input(array("id"=>"name","name"=>"name" ,"class"=>"form-control"), isset($frm_data["frm_data"]->name)?$frm_data["frm_data"]->name:""); ?>
						<?php echo form_error('name') ?>
				</div>


				<div class="form-group col-sm-12">
					<label for="description">Content</label>
						<?php echo form_textarea(array("id"=>"description","name"=>"description","class"=>"form-control"), isset($frm_data["frm_data"]->description)?$frm_data["frm_data"]->description:""); ?>
				</div>


				<div class="form-group col-sm-12">
					<label for="meta_title">Meta Title</label>
					<?php echo form_input(array("id"=>"meta_title","name"=>"meta_title" ,"class"=>"form-control"), isset($frm_data["frm_data"]->meta_title)?$frm_data["frm_data"]->meta_title:""); ?>
				</div>

				<div class="form-group col-sm-6">
					<label for="meta_keyword">Meta keyword</label>
					<?php echo form_textarea(array("id"=>"meta_keyword","name"=>"meta_keyword","class"=>"form-control"), isset($frm_data["frm_data"]->meta_keyword)?$frm_data["frm_data"]->meta_keyword:""); ?>
				</div>

				<div class="form-group col-sm-6">
					<label  for="meta_content">Meta content</label>
					<?php echo form_textarea(array("id"=>"meta_content","name"=>"meta_content","class"=>"form-control"), isset($frm_data["frm_data"]->meta_content)?$frm_data["frm_data"]->meta_content:""); ?>
				</div>

			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-5">
						<button class="btn btn-primary mr5" type="submit">Save</button>
					</div>
				</div>
			</div>

			<?php echo form_close(); ?>
		</div>
	</div>

</div>