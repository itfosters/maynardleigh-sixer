<?php $ids = isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""; ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?php echo !empty($ids)?"Edit":"Add new"; ?> Banner</h4>
			</div>

			<?php echo form_open_multipart("admin/banner/form/".$ids,array("id"=>"frmfosters" ,"class"=>"form-bordered")); ?>
			<div class="panel-body">

				<?php echo form_hidden("id" ,isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""); ?>


				<div class="form-group col-md-4">
					<label class="control-label" for="name">Title</label>
					<?php echo form_input(array("id"=>"title","name"=>"title" ,"class"=>"form-control"), isset($frm_data["frm_data"]->title)?$frm_data["frm_data"]->title:""); ?>
					<?php echo form_error('title') ?>
				</div>
				
				<div class="form-group col-md-4">
					<label class="control-label" for="name">Link</label>
					<?php echo form_input(array("id"=>"url_link","name"=>"url_link" ,"class"=>"form-control"), isset($frm_data["frm_data"]->url_link)?$frm_data["frm_data"]->url_link:""); ?>
				</div>

				<div class="form-group col-md-4">
					<label class="control-label" for="name">Banner Image</label>
					<?php echo form_upload(array("id"=>"bannerimage","name"=>"bannerimage" ,"class"=>"")); ?>					
				</div>

				<div class="form-group col-md-12">
					<label class="control-label" for="name">Content</label>
					<?php echo form_textarea(array("id"=>"description","name"=>"description","class"=>"form-control"), isset($frm_data["frm_data"]->description)?$frm_data["frm_data"]->description:""); ?>
				</div>

				
			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-6">
						<button class="btn btn-primary mr5" type="submit">Save</button>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>                            
		</div>
	</div>

</div>