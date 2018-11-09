<div>
<h3>Add Product</h3>
</div>
<div>
	<?php 
        //echo '<pre>';print_r($frm_data['mrs']->name);die;
		$product=array('1'=>'Diagnose',
						'2'=>'Design',
						'3'=>'Delivery',
						'4'=>'Discovery');
                

	?>
	<?php $id=isset($frm_data['view']->id)?$frm_data['view']->id:'';?>
	<?php //echo "<pre>";print_r($frm_data['view']->email_Id);die;?>
	<?php echo form_open('admin/product/form'.'/'.$id); ?>
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
	 </div>
     <div class="section col-md-6">
      <div class="form-group">
	<label>Price </label>
	 
	 <?php $data=array( 
	 			'name' => 'price',
				'class'=> 'form-control',
	 			'value'=>isset($frm_data['view']->price)? $frm_data['view']->price:''
	 			);
	 echo form_input($data);?><?php echo form_error('price'); ?> 
     </div>
     </div>
     <div class="section col-md-6">
      <div class="form-group">
	 <label>Weight</label>

	 <?php $data=array( 
	 			'name' => 'weight',
				'class'=> 'form-control',
	 			'value'=>isset($frm_data['view']->weight)? $frm_data['view']->weight:''
	 			);
	 echo form_input($data);?><?php echo form_error('weight'); ?> 
     </div>
     </div>
     <div class="section col-md-6">
      <div class="form-group">
	<label>Product Type </label>
	 <?php echo form_dropdown('product_type',$product,isset($frm_data['view']->product_type)? $frm_data['view']->product_type:'', 'class="form-control deliveychange" '); ?>
 
	 
     </div>
	 </div>
	 <div class="section col-md-6" id="mySelect" style="display:none;">
      <div class="form-group">
<?php  



	 echo form_dropdown('mrs_list',$mrsproduct,isset($frm_data['mrs']->name)? $frm_data['mrs']->name:'', 'multiple="multiple" class="selectpicker form-control "'); ?>
	 
<!--      	<select class="form-control"  >
      <option value="select delivey">select deliveyy</option>
      <option value="Character Profile">Character Profile  </option>
      <option value="Informal encounter">Informal encounter</option>
      <option value="3.	Emotional expression">3.	Emotional expression</option>
      <option value="4.	Personal impact It’s reciprocal ">4.	Personal impact It’s reciprocal </option>
      <option value="5.	Quick warm up ">5.	Quick warm up </option>
      <option value="sohan">sohan</option>
      <option value="sohan">sohan</option>
      <option value="sohan">sohan</option>
      <option value="sohan">sohan</option>
      <option value="sohan">sohan</option>
      <option value="sohan">sohan</option>
      <option value="sohan">sohan</option>
      <option value="sohan">sohan</option>
      <option value="sohan">sohan</option>

      <option value="sohan">sohan</option>
      <option value="sohan">sohan</option>

	 </select>-->
      </div>
  </div>
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

<script>
$( ".deliveychange" ).change(function() {
 var selectvalue = $(this).val();
 if(selectvalue==3){
 	$('#mySelect').show();
 }else{
 	$('#mySelect').hide();
 }
});
</script>