
<script type="text/javascript">
$(document).ready(function(){
     $("#contact_no").mask("+999-99999999");
 });

</script>
<div>
</div>
<div class="row	">
	<?php $id=isset($frm_data['view']->id)?$frm_data['view']->id:'';?>
	<?php //echo "@@<pre>";print_r($frm_data);die; ?>
	<?php echo form_open('admin/client/form'.'/'.$id); ?>
	<div class="col-md-6">
        <div class="form-group">
             <label> Name </label>
             	
             <?php $data=array( 
                        'name' => 'name',
                        'class'=>'form-control',
                        'placeholder'=>'Client Name',
                        'value'=>isset($frm_data['view']->name)?$frm_data['view']->name:''
                        );
             echo form_input($data) ;?>
             <?php echo form_error('name'); ?>    
         </div>
     </div>
        <div class="col-md-6">
          <div class="form-group">
             <label> Email Id. </label>
             <?php 
			 	if(!empty($id)){
			 ?> 
            <?php $data=array( 
                        'name' => 'email',
                        'class'=>'form-control',
                        'readonly'=>'true',
                        'value'=>isset($frm_data['view']->email)? $frm_data['view']->email:''
                        );
            echo form_input($data); ?>
            <?php echo form_error('email'); ?>  
            <?php }else{
				 $data=array( 
                        'name' => 'email',
                        'class'=>'form-control',
                        'placeholder'=>'Email Id',
                        'value'=>isset($frm_data['view']->email)? $frm_data['view']->email:''
                        );
            echo form_input($data);
				echo form_error('email');
				
				}?>
            </div>
            </div>
        <div class="col-md-6">
          <div class="form-group">
             <label> Contact No. </label>
            <?php $data=array( 
                        'name' => 'contact_no',
                        'class'=>'form-control',
                        'id'=>'contact_no',
                        'placeholder'=>'+011-99999999',
                        'value'=>isset($frm_data['view']->contact_no)? $frm_data['view']->contact_no:''
                        );
            echo form_input($data); ?>
            <?php echo form_error('contact_no'); ?>  
            </div>
            </div>
    <div class="col-md-6">
      <div class="form-group">
        <label> Street/plot no. </label>
         
         <?php $data=array( 
                    'name' => 'street',
                    'class'=>'form-control',
                    'placeholder'=>'Street/Plot No',
                    'value'=>isset($frm_data['view']->street)? $frm_data['view']->street:''
                    );
         echo form_input($data); ?>
         <?php echo form_error('street'); ?>  
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label> Location </label>
         
         <?php $data=array( 
                    'name' => 'location',
                    'class'=>'form-control',
                    'placeholder'=>'Location',
                    'value'=>isset($frm_data['view']->location)? $frm_data['view']->location:''
                    );
         echo form_input($data); ?>
         <?php echo form_error('location'); ?>  
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label> City </label>
         
         <?php $data=array( 
                    'name' => 'city',
                    'class'=>'form-control',
                    'placeholder'=>'City',
                    'value'=>isset($frm_data['view']->city)? $frm_data['view']->city:''
                    );
         echo form_input($data); ?>
         <?php echo form_error('city'); ?>  
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label> State </label>
         
         <?php $data=array( 
                    'name' => 'state',
                    'class'=>'form-control',
                    'placeholder'=>'State',
                    'value'=>isset($frm_data['view']->state)? $frm_data['view']->state:''
                    );
         echo form_input($data); ?>
         <?php echo form_error('state'); ?>  
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label> Pin Code </label>
         
         <?php $data=array( 
                    'name' => 'pincode',
                    'class'=>'form-control',
                    'placeholder'=>'Pin Code',
                    'value'=>isset($frm_data['view']->pincode)? $frm_data['view']->pincode:''
                    );
         echo form_input($data); ?>
         <?php echo form_error('pincode'); ?>  
    </div>
    </div>

            <div class="clearfix"></div>
    <div class="col-md-6">
          <div class="form-group">
            <?php $data=array('value' => 'Submit',
            'class'=>'btn btn-primary',
                         'name'=>'submit'
                         );
                echo form_submit($data);
                ?>
                </div>
        </div>
		
	 <?php //echo form_submit(array('id' => 'update', 'value' => 'Update','name'=>'update')); ?>
	<?php  //echo form_submit(array('id' => 'delete', 'value' => 'Delete','name'=>'delete')); ?>
	 <?php echo form_close(); ?>
</div>
<style type="text/css">
.error {
color:red;
font-size:13px;
margin-bottom:-15px
}</style>
