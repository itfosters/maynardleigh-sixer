<div>
</div>
<div>
<?php //echo "<pre>";print_r($property);die;?>
	<?php 
		$subproduct=array('1'=>'Diagnose',
						'2'=>'Design',
						'3'=>'Delivery',
						'4'=>'Discovery');

	?>
	<?php $id=isset($frm_data['view']->id)?$frm_data['view']->id:'';?>
	<?php //echo "<pre>";print_r($frm_data['view']->email_Id);die;?>
	<?php echo form_open('admin/subproduct/form'.'/'.$id); ?>
    <div class="row">
	<div class="section col-md-6">
    <div class="form-group">
	<label>Name </label>
	 <?php $data=array( 
	 			'name' => 'name',
				'class'=> 'form-control',
	 			'value'=>isset($frm_data['view']->name)?$frm_data['view']->name:''
	 			);
	 echo form_input($data);?><?php echo form_error('name'); ?> 
     </div>
      <label>Do you want select parent</label><input type="checkbox" name="parenttype" value="1" id="parenttype" <?php echo isset($frm_data['view']->parent_id) && ($frm_data['view']->parent_id)>0 ? 'checked':'';?>>
      	  <div class="form-group">
	  	<?php
	  	//echo $frmdata['view']->parentid;die;
	  		$viewoption = isset($frm_data['view']->parent_id) && ($frm_data['view']->parent_id)>0 ? 'inline':'none';	
	  		echo form_dropdown('parent_name', $property,isset($frm_data['view']->parent_id)?$frm_data['view']->parent_id:"", 'style="display:'.$viewoption.'" class="required form-control hiddendiv"');
	  	
	  	
	  	
	  	?>


	 
     
	</div>
	 </div>
    <div class="clearfix"></div>
	<div class="section col-md-6">
	 <?php $data=array('value' => 'submit',
	 			 'name'=>'submit',
				 'class'=> 'btn btn-primary',
	 			 );
		echo form_submit($data);?>
		</div>
	</div>	
	 <?php //echo form_submit(array('id' => 'update', 'value' => 'Update','name'=>'update'));?>
	 <?php //echo form_submit(array('id' => 'delete', 'value' => 'Delete','name'=>'delete')); ?>
	<?php echo form_close(); ?>

	 
</div>
<style type="text/css">
.error {
color:red;
font-size:13px;
margin-bottom:-15px
}</style>
<script type="text/javascript">
 $(document).ready(function(){
  $('#parenttype').click(function () {
   var $this = $(this);
  if($this.is(':checked'))
  {
   //alert('dfsdfs');
   $('.hiddendiv').show();
  }
   else
   {
    $('.hiddendiv').hide();
   }
  });
 })

</script>