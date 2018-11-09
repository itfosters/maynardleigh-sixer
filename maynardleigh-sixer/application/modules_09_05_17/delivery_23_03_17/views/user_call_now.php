<?php //echo "<pre>";print_r($frm_data);die; ?>
<div>
    <?php $id = isset($frmdata["subdelvid"]->id) ? $frmdata["subdelvid"]->id : ''; ?>
    <?php //echo form_open('delivary/insert/'.$subdelvid->id.'/'.$subdelvid->order_id);?>
<?php echo form_open();

        $data=array('name'=>'time_slot_id','value'=>$frm_data['time_slot_id'],'class'=>'hidden');
        echo form_input($data);
        $data=array('name'=>'order_id','value'=>$frm_data['order_id'],'class'=>'hidden');
        echo form_input($data);
        $data=array('name'=>'delivery_id','value'=>$frm_data['delivery_id'],'class'=>'hidden');
        echo form_input($data);
        $data=array('name'=>'user_id','value'=>$frm_data['user_id'],'class'=>'hidden');
        echo form_input($data);
?>
    
    <div class="col-md-12">
        <div class="col-md-3">Name</div>
        <div class="col-md-3"><strong><?php echo $frm_data['user_info']['name']; ?></strong></div>
        <div class="col-md-3">Email </div>
        <div class="col-md-3"><strong><?php echo $frm_data['user_info']['email']; ?></strong></div>
    </div>
    
    <div class="col-md-12">
        <div class="col-md-3">Contact No</div>
        <div class="col-md-3"><strong><?php echo isset($frm_data['user_info']['contact_no'])?$frm_data['user_info']['contact_no']:"N/A"; ?></strong></div>
        <div class="col-md-3">Department </div>
        <div class="col-md-3"><strong><?php echo isset($frm_data['user_info']['department'])?$frm_data['user_info']['department']:"N/A"; ?></strong></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-3">Designation</div>
        <div class="col-md-3"><strong><?php echo isset($frm_data['user_info']['designation'])?$frm_data['user_info']['designation']:"N/A"; ?></strong></div>
        <div class="col-md-3">Department </div>
        <div class="col-md-3"><strong><?php echo isset($frm_data['user_info']['department'])?$frm_data['user_info']['department']:"N/A"; ?></strong></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-3">Reporting To</div>
        <div class="col-md-3"><strong><?php echo isset($frm_data['user_info']['reporting_to'])?$frm_data['user_info']['reporting_to']:"N/A"; ?></strong></div>
        <div class="col-md-3">Area of Responsibility </div>
        <div class="col-md-3"><strong><?php echo isset($frm_data['user_info']['area_of_responsibility'])?$frm_data['user_info']['area_of_responsibility']:"N/A"; ?></strong></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-3">Total Experience</div>
        <div class="col-md-3"><strong><?php echo isset($frm_data['user_info']['total_experience'])?$frm_data['user_info']['total_experience']:"N/A"; ?></strong></div>
        <div class="col-md-3">Qualification </div>
        <div class="col-md-3"><strong><?php echo isset($frm_data['user_info']['qualification'])?$frm_data['user_info']['qualification']:"N/A"; ?></strong></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-3">Previous Employer</div>
        <div class="col-md-3"><strong><?php echo isset($frm_data['user_info']['previous_employer'])?$frm_data['user_info']['previous_employer']:"N/A"; ?></strong></div>
        <div class="col-md-3">Training attended in past </div>
        <div class="col-md-3"><strong><?php echo isset($frm_data['user_info']['training_attended_in_the_past'])?$frm_data['user_info']['training_attended_in_the_past']:"N/A"; ?></strong></div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Comment:</label>
        </div>
        <div class="form-group col-md-9">
            
            <?php
            $data = array('name' => 'comment',
                'class' => 'gui-input form-control',
                'placeholder' => 'Course Name',
                'id' => 'course'
            );
            echo form_input($data);
            ?>
        </div>
    </div>
    
    
    
    
    
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label><?php
echo form_submit('Submit', 'Save', 'class="btn btn-primary"');
?></label>
        </div>
        <div class="form-group col-md-6">
            
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <a href="#" title="Show History"><i class="fa fa-history" aria-hidden="true"></i> &nbsp;Show History</a>
        </div>
    </div>
    
    
    <div class="clearfix"></div>

<?php echo form_close(); ?>

</div>