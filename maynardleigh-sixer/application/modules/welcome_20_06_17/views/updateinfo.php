<html>
<head>
  <script src="<?php echo base_url('public/jquery.js') ?>" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<form method="post" action="<?php echo site_url('welcome/myinfo'); ?>" >
<?php echo  form_open('welcome/myinfo');  ?>
 <div class="col-md-12">
    <?php   
     $data = array(
        'type'  => 'hidden',
        'name'  => 'id',
        'value' => isset($frmdata['details']->id)? $frmdata['details']->id:''
        );

       echo form_input($data);
     ?>
    <div class="col-md-6">
        <div class="member">
          <div class="form-group">
            <label> First Name</label>
            <?php 

             $data = array(
                'name'          => 'name',
                'id'            => 'name',
                'class'         => 'form-control',
                'value'         =>isset($frmdata['details']->name)? $frmdata['details']->name:''
              );

               echo form_input($data); 
         ?>
            
          </div>
        </div>
      </div>
      <div class="col-md-6">
          <div class="form-group">
          <label> Last Name</label>
            <?php
            $data = array(
                'name'          => 'last_name',
                'id'            => 'details',
                'class'         => 'form-control',
                'value'         =>isset($frmdata['details']->last_name)? $frmdata['details']->last_name:''
              );

               echo form_input($data); 
          ?>
           
        </div>
       </div>
        <div class="col-md-6">
        <div class="member">
          <div class="form-group">
            <label> Email Id</label>
            <?php
              $data = array(
                'name'          => 'email',
                'id'            => 'name',
                'class'         => 'form-control',
                'readonly'      => 'readonly',
                'value'         => isset($frmdata['details']->email)? $frmdata['details']->email:''
              );

               echo form_input($data); 
          ?>
           
          </div>
        </div>
      </div>
       <div class="col-md-6">
        <div class="member">
          <div class="form-group">
            <label> Street</label>
             <?php

              $data = array(
                'name'          => 'street',
                'id'            => 'name',
                'class'         => 'form-control',
                'value'         => isset($frmdata['details']->street)? $frmdata['details']->street:''
              );

              echo form_input($data); 
          ?>
        </div>
        </div>
      </div>
       <div class="col-md-6">
        <div class="member">
          <div class="form-group">
            <label> Location</label>
             <?php
             
              $data = array(
                'name'          => 'location',
                'id'            => 'name',
                'class'         => 'form-control',
                'value'         => isset($frmdata['details']->location)? $frmdata['details']->location:''
              );

              echo form_input($data); 
          ?>
            
          </div>
        </div>
      </div>
       <div class="col-md-6">
        <div class="member">
          <div class="form-group">
            <label> City</label>
             <?php
             
              $data = array(
                'name'          => 'city',
                'id'            => 'name',
                'class'         => 'form-control',
                'value'         => isset($frmdata['details']->city)? $frmdata['details']->city:''
              );

              echo form_input($data); 
          ?>
            
          </div>
        </div>
      </div>
       <div class="col-md-6">
        <div class="member">
          <div class="form-group">
            <label> State</label>
             <?php
             
              $data = array(
                'name'          => 'state',
                'id'            => 'name',
                'class'         => 'form-control',
                'value'         => isset($frmdata['details']->state)? $frmdata['details']->state:''
              );

              echo form_input($data); 
          ?>
            
          </div>
        </div>
      </div>
       <div class="col-md-6">
        <div class="member">
          <div class="form-group">
            <label> Pin-Code</label>
            <?php
             
              $data = array(
                'name'          => 'pincode',
                'id'            => 'name',
                'class'         => 'form-control',
                'value'         => isset($frmdata['details']->pincode)? $frmdata['details']->pincode:''
              );

              echo form_input($data); 
          ?>
            
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="member">
          <div class="form-group">
            <label> Contact No</label>
             <?php
             
              $data = array(
                'name'          => 'contact_no',
                'id'            => 'name',
                'class'         => 'form-control',
                'value'         => isset($frmdata['details']->contact_no)? $frmdata['details']->contact_no:''
              );

              echo form_input($data); 
          ?>
            
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="member">
          <div class="form-group">
            <label> Designation</label>
             <?php
              $data = array(
                'name'          => 'designation',
                'id'            => 'name',
                'class'         => 'form-control',
                'value'         => isset($frmdata['details']->designation)? $frmdata['details']->designation:''
              );

              echo form_input($data); 
          ?>
          </div>
        </div>
      </div>
        <div class="col-md-6">
            <br>
          <?php  echo form_submit('submit', 'Update','class="btn btn-primary"'); 
           ?>
      </div>
  </div>
  <?php echo form_close();?>
  </body>
</html>