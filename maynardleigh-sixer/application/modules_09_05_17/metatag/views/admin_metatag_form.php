<?php $ids = isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:"";?>
<div class="row">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
		<h4 class="panel-title"><?php echo !empty($ids)?"Edit":"Add new"; ?> mail</h4>
		</div>
		
		<?php  echo form_open("admin/metatag/form/".$ids,array("id"=>"frmfosters" ,"class"=>"form-bordered")); ?>
		<div class="panel-body">
	
		<?php echo form_hidden("id" ,isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""); ?>
	
		<div class="form-group col-md-4">
			<label class="control-label" for="name">Name</label>     
			<?php echo form_input(array("id"=>"name","name"=>"name" ,"class"=>"form-control"), isset($frm_data["frm_data"]->name)?$frm_data["frm_data"]->name:""); ?>
			<?php echo form_error('name') ?>
        </div>
        
        <div class="form-group col-md-4">
			<label class="control-label" for="name">URL</label>
			<?php echo form_input(array("id"=>"urlname","name"=>"urlname" ,"class"=>"form-control"), isset($frm_data["frm_data"]->urlname)?$frm_data["frm_data"]->urlname:""); ?>
			
			<?php echo form_error('urlname') ?>
        </div>
        <div class="form-group col-md-4">
			<label class="control-label" for="name">Title</label>
        
			<?php echo form_input(array("id"=>"title","name"=>"title" ,"class"=>"form-control"), isset($frm_data["frm_data"]->title)?$frm_data["frm_data"]->title:""); ?>
			
			<?php echo form_error('title') ?>
        </div>
        <div class="form-group col-md-12">
			<label class="control-label" for="name">Metakeywords</label>        
			<?php echo form_input(array("id"=>"metakeywords","name"=>"metakeywords" ,"class"=>"form-control"), isset($frm_data["frm_data"]->metakeywords)?$frm_data["frm_data"]->metakeywords:""); ?>
			<?php echo form_error('metakeywords') ?>
        </div>
        <div class="form-group col-md-12">
			<label class="control-label" for="name">Meta Discription</label>
			<?php echo form_textarea(array("id"=>"metadiscryption","name"=>"metadiscryption" ,"class"=>"form-control"), isset($frm_data["frm_data"]->metadiscryption)?$frm_data["frm_data"]->metadiscryption:""); ?>
			<?php echo form_error('metadiscryption') ?>
		
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