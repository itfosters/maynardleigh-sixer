<?php //echo "<pre>"; print_r($itfdata["jobinfo"]); die;?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Job Detail</h4>
			</div>

			
			<div class="panel-body">

				<div class="col-sm-2"><label class="control-label" for="name">Employee Id</label></div>
				<div class="col-sm-10"><span class="control-label" for="name"><?php echo $itfdata["jobinfo"]->emp_id; ?></span></div>
				<div class="clearfix"></div>

				<div class="col-sm-2"><label class="control-label" for="name">Joining Date</label></div>
				<div class="col-sm-10"><span class="control-label" for="name"><?php echo $itfdata["jobinfo"]->join_date; ?></span></div>
				<div class="clearfix"></div>

				<div class="col-sm-2"><label class="control-label" for="name">Contract Start</label></div>
				<div class="col-sm-10"><span class="control-label" for="name"><?php echo $itfdata["jobinfo"]->contract_start_date; ?></span></div>
				<div class="clearfix"></div>

				<div class="col-sm-2"><label class="control-label" for="name">Contract End</label></div>
				<div class="col-sm-10"><span class="control-label" for="name"><?php echo $itfdata["jobinfo"]->contract_end_date; ?></span></div>
				<div class="clearfix"></div>

				<div class="col-sm-2"><label class="control-label" for="name">Salary</label></div>
				<div class="col-sm-10"><span class="control-label" for="name"><?php echo $itfdata["jobinfo"]->salary; ?></span></div>
				<div class="clearfix"></div>

				<div class="col-sm-2"><label class="control-label" for="name">Job Title</label></div>
				<div class="col-sm-10"><span class="control-label" for="name"><?php echo $itfdata["jobinfo"]->job_title; ?></span></div>
				<div class="clearfix"></div>

				<div class="col-sm-2"><label class="control-label" for="name">Job Category</label></div>
				<div class="col-sm-10"><span class="control-label" for="name"><?php echo $itfdata["jobinfo"]->job_category; ?></span></div>
				<div class="clearfix"></div>

				<div class="col-sm-2"><label class="control-label" for="name">Address</label></div>
				<div class="col-sm-10"><span class="control-label" for="name">
							<?php echo $itfdata["jobinfo"]->address; ?><br>
							<?php echo $itfdata["jobinfo"]->city; ?><br>
							<?php echo $itfdata["jobinfo"]->state; ?><br>
							<?php echo $itfdata["jobinfo"]->pincode; ?>
							</span></div>
				<div class="clearfix"></div>

				<div class="col-sm-2"><label class="control-label" for="name">Company Phone</label></div>
				<div class="col-sm-10"><span class="control-label" for="name"><?php echo $itfdata["jobinfo"]->company_phone; ?></span></div>
				<div class="clearfix"></div>

			</div>


		</div>                                   

	</div>

</div>