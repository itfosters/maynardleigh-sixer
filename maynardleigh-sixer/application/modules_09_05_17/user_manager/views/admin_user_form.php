<?php 
//echo "<pre>";print_r($frm_data);die; ?>
<div class="row">
    <?php $id = isset($frm_data['view']->id) ? $frm_data['view']->id : ''; ?>
<?php //echo "<pre>";print_r($frm_data['view']->email_Id);die;  ?>
<?php echo form_open('admin/user_manager/form' . '/' . $id); ?>

    <div class="col-md-6">
        <div class="form-group">
            <label>Client </label> 	
            <?php
            echo form_dropdown('client', $clients, isset($frm_data['view']->client_id) ? $frm_data['view']->client_id : "", 'class="form-control" id="name_of_client"');
            //echo "<pre>";print_r($r);die;
            echo form_error('client');
            ?>

        </div>
    </div>



    <div class="col-md-6">
        <div class="form-group">
            <label>Name </label> 	
            <?php
            $data = array(
                'name' => 'name',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->name) ? $frm_data['view']->name : ''
            );
            echo form_input($data);
            ?><?php echo form_error('name'); ?>

        </div>
    </div>







    <div class="col-md-6">
        <div class="form-group">
            <label>Email Id</label>
            <?php
            $data = array(
                'name' => 'email',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->email) ? $frm_data['view']->email : ''
            );
            echo form_input($data);
            ?><?php echo form_error('email'); ?>
        </div>
    </div>
<?php //if (empty($id)) {  ?>
    <div class="col-md-6">
        <div class="form-group">
            <label>Password</label>
            <?php
            $data = array(
                'name' => 'password',
                'class' => 'form-control',
                    //'value'=>isset($frm_data['view']->password))? $frm_data['view']->password:''
            );
            echo form_input($data);
            ?><?php echo form_error('password'); ?>
        </div>
    </div>
<?php //}  ?>
    <div class="col-md-6">
        <div class="form-group">
            <label>Contact No.</label>
            <?php
            $data = array(
                'name' => 'contact_no',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->contact_no) ? $frm_data['view']->contact_no : ''
            );
            echo form_input($data);
            ?><?php echo form_error('contact_no'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Address.</label>
            <?php
            $data = array(
                'name' => 'address',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->address) ? $frm_data['view']->address : ''
            );
            echo form_input($data);
            ?><?php echo form_error('address'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Street.</label>
            <?php
            $data = array(
                'name' => 'street',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->street) ? $frm_data['view']->street : ''
            );
            echo form_input($data);
            ?><?php echo form_error('address'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Location.</label>
            <?php
            $data = array(
                'name' => 'location',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->location) ? $frm_data['view']->location : ''
            );
            echo form_input($data);
            ?><?php echo form_error('location'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>City.</label>
            <?php
            $data = array(
                'name' => 'city',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->city) ? $frm_data['view']->city : ''
            );
            echo form_input($data);
            ?><?php echo form_error('location'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Pincode.</label>
            <?php
            $data = array(
                'name' => 'pincode',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->pincode) ? $frm_data['view']->pincode : ''
            );
            echo form_input($data);
            ?><?php echo form_error('pincode'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Age.</label>
            <?php
            $data = array(
                'name' => 'age',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->age) ? $frm_data['view']->age : ''
            );
            echo form_input($data);
            ?><?php echo form_error('age'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Department.</label>
            <?php
            $data = array(
                'name' => 'department',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->department) ? $frm_data['view']->department : ''
            );
            echo form_input($data);
            ?><?php echo form_error('department'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Designation.</label>
            <?php
            $data = array(
                'name' => 'designation',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->designation) ? $frm_data['view']->designation : ''
            );
            echo form_input($data);
            ?><?php echo form_error('designation'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Reporting To.</label>
            <?php
            $data = array(
                'name' => 'reporting_to',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->reporting_to) ? $frm_data['view']->reporting_to : ''
            );
            echo form_input($data);
            ?><?php echo form_error('reporting_to'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Area of responsibility.</label>
            <?php
            $data = array(
                'name' => 'area_of_responsibility',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->area_of_responsibility) ? $frm_data['view']->area_of_responsibility : ''
            );
            echo form_input($data);
            ?><?php echo form_error('area_of_responsibility'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Current Organization Experience .</label>
            <?php
            $data = array(
                'name' => 'yrs_at_ey',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->yrs_at_ey) ? $frm_data['view']->yrs_at_ey : ''
            );
            echo form_input($data);
            ?><?php echo form_error('yrs_at_ey'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Total Experience.</label>
            <?php
            $data = array(
                'name' => 'total_experience',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->total_experience) ? $frm_data['view']->total_experience : ''
            );
            echo form_input($data);
            ?><?php echo form_error('total_experience'); ?>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label>Qualification.</label>
            <?php
            $data = array(
                'name' => 'qualification',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->qualification) ? $frm_data['view']->qualification : ''
            );
            echo form_input($data);
            ?><?php echo form_error('qualification'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Training attended in the past (Yes/No).</label>
            <?php
            $data = array(
                'name' => 'training_attended_in_the_past',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->training_attended_in_the_past) ? $frm_data['view']->training_attended_in_the_past : ''
            );
            echo form_input($data);
            ?><?php echo form_error('training_attended_in_the_past'); ?>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label>Previous Employer.</label>
            <?php
            $data = array(
                'name' => 'previous_employer',
                'class' => 'form-control',
                'value' => isset($frm_data['view']->previous_employer) ? $frm_data['view']->previous_employer : ''
            );
            echo form_input($data);
            ?><?php echo form_error('previous_employer'); ?>
        </div>
    </div>
    
    
    <div class="clearfix"></div>
    <div class="col-md-6">

        <?php
        $data = array('value' => 'Submit',
            'class' => 'btn btn-primary',
            'name' => 'submit'
        );
        echo form_submit($data);
        ?>
    </div>	
<?php echo form_close(); ?>

</div>
<style type="text/css">.error {
        color:red;
        font-size:13px;
        margin-bottom:-15px
    }</style>
