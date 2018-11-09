	<div class="row mb10">
		<div class="col-sm-10">
			<?php echo form_open("admin/mail",array("id"=>"frmserach")); ?>
			<div class="input-group mb15 col-sm-5">
				<input type="text" name="q" id="txtsearch" class="form-control" value="<?php echo isset($frm_data["q"])?$frm_data["q"]:""; ?>" />
				<span class="input-group-btn">
					<button type="submit" name="btnsearch" id="btnsearch" class="btn btn-primary">Search</button>
				</span>
			</div>
			<?php echo form_close(); ?>
		</div>


		<div class="col-md-2">
			<div class="btn-group">
				<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action <span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a  href="<?php echo site_url("admin/banner/form"); ?>">Add Banner</a></li>
					<li class="divider"></li>
					<li><a href="#itf" class="itfdelete" name="delete">Delete</a></li>
					<li><a href="#itf" class="itfdelete" name="publish">Activate</a></li>
					<li><a href="#itf" class="itfdelete" name="unpublish">Deactivate</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">							
			<div class="table-responsive">

				<?php echo form_open("admin/banner/delete",array("id"=>"frmitf"),array("itfids"=>"","itfaction"=>"")); ?>


				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="event_row"><?php echo form_checkbox(array('id'=>'itfactionevents','name'=>'itfactionevents', 'value'=>'all', 'checked'=>false)); ?></th>

							<th >Banner</th>
							<th >Banner Name</th>
							<th class="col-md-1">Status</th>
							<th class="col-md-1">Modify</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach($results as $k=>$itfdata) { ?>
						<tr>
							<td ><?php echo form_checkbox(array('class'=>'itfrowdatas','name'=>'itfrowdata[]', 'value'=>$itfdata->id)); ?></td>

							<td><a href="<?php echo base_url("assests/itf_public/banner")."/".$itfdata->banner_image; ?>" class="image_popup"><img src="<?php echo base_url("assests/itf_public/banner")."/".$itfdata->banner_image; ?>" width="25" height="25" /></a></td>
							<td><?php echo $itfdata->title; ?></td>
							<td><a title="<?php echo ($itfdata->status=="1")?"Activeted":"Deactiveted" ?>" data-toggle="tooltip" class="tooltips" ><i class="fa <?php echo !empty($itfdata->status)?'fa-unlock':'fa-lock'; ?>"></i></a></td>
							<td>
								<a href="<?php echo site_url("admin/banner/form/".$itfdata->id ); ?>" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>
							</td>

						</tr>
						<?php  } ?>
					</tbody>
				</table>
				<?php echo form_close(); ?>
			</div><!-- table-responsive -->
		</div><!-- col-md-6 -->

		<div class="col-xs-12">
			<div class="pagination">
				<?php echo $links; ?>
			</div>

		</div>
	</div>