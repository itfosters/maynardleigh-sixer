
<html>
<head>
  <script src="<?php echo base_url('public/jquery.js') ?>" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<?php
//echo "<pre>";print_r($frmdata['itfall']);die;
//echo $frmdata['itfall']->user_current_location;die;
 ?>
 <!--<div class="col-md-12 ">

    <form method="post" action="<?php echo site_url('welcome/myinfo'); ?>" >
      <div class="col-md-6">
        <div class="form-group">
        <label> Your Current Location</label>
         <?php //echo'####<pre>';print_r($frmdata['itfall']->user_current_location);die;?>
            <input name="userlocation" type="text" value="<?php echo isset($frmdata['itfall1']->user_current_location)?$frmdata['itfall1']->user_current_location:set_value('userlocation'); ?>" class="form-control" id="inputEmail" placeholder="Current Location">

        </div>

</div>-->
        <!--<div class="col-md-6">
        <div class="form-group">

            <label>Preferred Airlines</label>

           <!--  <select class="form-control" name="preferedairlience">
                   <option value="10" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='10')){echo "selected='selected'";} ?>>Airlince</option>
                    <option value="1" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='1') ){echo "selected='selected' ";}  ?>>Jet Airways</option>
                     <option value="2" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='2') ){echo "selected='selected' ";}  ?>> Indian Airlince</option>
                      <option value="3" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='3') ){echo "selected='selected' ";}  ?>> Kingfisher </option>
                      <option value="4" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='4') ) {echo "selected='selected' ";} ?>> Air One </option>
                      <option value="5" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='5') ) {echo "selected='selected' ";} ?>> Premier Airways </option>
                      <option value="6" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='6') ) {echo "selected='selected' ";} ?>> Air Carnival </option>
                      <option value="7" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='7') ){echo "selected='selected' ";}  ?>> Turbo Megha Airways </option>
                      <option value="8" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='8') ){echo "selected='selected' ";}  ?>> Zav Airways </option>
                      <option value="9" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='9') ){echo "selected='selected' ";}  ?>> Zexus Air </option>
                  </select> 
                  <?php echo form_dropdown('preferedairlience', $frmdata['allairlines'],isset($frmdata['itfall1']->preferred_airlience)?$frmdata['itfall1']->preferred_airlience:'', ' class="required form-control "  ');?>
        </div>
</div>

       <div class="col-md-6">
        <div class="form-group">

            <label>Preferred Food</label>

            <select class="form-control" name="food">
                   <option value=""> Select Food </option>
                    <option value="veg" <?php  if(isset($frmdata['itfall1']->food) and ($frmdata['itfall1']->food =='veg') ){echo "selected='selected' ";}  ?>> Veg</option>
                     <option value="nonveg" <?php  if(isset($frmdata['itfall1']->food) and ($frmdata['itfall1']->food =='nonveg') ) {echo "selected='selected' ";} ?>> Non-Veg </option>
                  </select>
                  </div>
     
  </div>

   <div class="col-md-6">

          <input type="submit" class="btn btn-primary" style="margin-top: 33px;" value="Save"/>
</div>

 </div>
<div class="bdr_btn"></div>

<!-- new -->

 <!--<div class="col-md-12">

    <form method="post" action="<?php echo site_url('welcome/myinfo'); ?>" >
      <div class="col-md-6">

        <div class="member">
          <div class="form-group">
            <label> Membership Name</label>
            <input name="member_name[]" type="text" class="form-control" id="name" value="<?php echo isset($frmdata['myinfos']->member_name)?$frmdata['myinfos']->member_name:''; ?>">

          </div>
        </div>
      </div>
      <div class="col-md-6">
          <div class="form-group">
            <label> Membership Details</label>
            <input name="member_details[]" type="text" class="form-control" id="details" value="<?php echo isset($frmdata['myinfos']->member_details)?$frmdata['myinfos']->member_details:''; ?>">
        </div>
        
     </div>
        <div class="col-md-6">
            <label> <small>*&nbsp You can add multiple membership name  </small></label><br>
          <input type="submit" class="btn btn-primary" value="Save"/>
    </div>
       </form>
     </div>

<!-- new one -->
  <div class="col-md-12"></br>
    <?php 
      if(!empty($getinfo)){
    ?>
      <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                    <th>First Name</th> 
                    <th>Last Name</th> 
                    <th>Email Id</th>
                    <th>Designation</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Pin-Code</th>
                    <th>Contact No</th>
                    <th colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
      <?php //echo "<pre>";print_r($frmdata);die; ?>
      <?php foreach ($getinfo as $detail) { ?>
        <tr> 
         <td><?php echo isset($detail->name)?$detail->name:'';?></td> 
         <td><?php echo isset($detail->last_name)?$detail->last_name:'';?></td> 
         <td><?php echo isset($detail->email)? $detail->email:'';?></td>
         <td><?php echo isset($detail->designation)? $detail->designation:'';?></td>
         <td><?php echo isset($detail->street)? $detail->street:'';?></td>
         <td><?php echo isset($detail->city)?$detail->city:'';?></td>
         <td><?php echo isset($detail->state)?$detail->state:'';?></td>
         <td><?php echo isset($detail->pincode)?$detail->pincode:'';?></td>
         <td><?php echo isset($detail->contact_no)?$detail->contact_no:'';?></td>
         <td><a  href="<?php echo site_url().'welcome/editdetail'.'/?id='.$detail->id; ?>"><i class="fa fa-pencil"></i></a></td> 
        </tr> 
        <?php } ?>
        </tbody>
        </table>
        <?php } else {
              echo "No Any Membership Detail Mentioned.";
         } ?>

    </div>
    </form>
 </div>
 </body>
</html>