<?php $ids = isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""; ?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?php echo !empty($ids)?"Edit":"Add new"; ?> Category</h4>
			</div>

			<?php  echo form_open("admin/category/form/".$ids,array("id"=>"frmfosters" ,"class"=>"form-bordered")); ?>
			<div class="panel-body">

				<?php echo form_hidden("id" ,isset($frm_data["frm_data"]->id)?$frm_data["frm_data"]->id:""); ?>

				<div class="form-group col-sm-6">
				<label class="control-label" for="name">Name</label>
						<?php echo form_input(array("id"=>"name","name"=>"name" ,"class"=>"form-control"), isset($frm_data["frm_data"]->name)?$frm_data["frm_data"]->name:""); ?>
						<?php echo form_error('name') ?>
				</div>

				<div class="form-group col-sm-6">
					<label class="control-label" for="name">Order</label>
						<?php echo form_input(array("id"=>"orders","name"=>"orders" ,"class"=>"form-control"), isset($frm_data["frm_data"]->orders)?$frm_data["frm_data"]->orders:""); ?>
						<?php echo form_error('orders') ?>
				</div>


			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-5">
						<button class="btn btn-primary mr5"  type="submit">Save Category</button>
					</div>
				</div>
			</div>

			<?php echo form_close(); ?>
		</div>                                   

	</div>

</div>