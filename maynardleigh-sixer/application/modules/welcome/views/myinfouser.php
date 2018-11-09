
 <!-- bkp of sixer myinfo.php -->

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


 <div class="col-md-12 ">

    <form method="post" action="<?php echo site_url('welcome/myinfo'); ?>" >
      <div class="col-md-6">

        <div class="form-group">

            <label>Name</label>
         <?php //echo'####<pre>';print_r($frmdata['itfall']);die;?>
            <input name="name" type="text" value="<?php echo isset($frmdata['participantlist']->name)?$frmdata['participantlist']->name:set_value('name'); ?>" class="form-control" id="inputEmail" placeholder="Name">

        </div>
        </div>
         <div class="col-md-6">
         <div class="form-group">

            <label>Age</label>
         
            <input name="age" type="text" value="<?php echo isset($frmdata['participantlist']->age)?$frmdata['participantlist']->age:set_value('age'); ?>" class="form-control" id="inputEmail" placeholder="Age">

        </div>
        </div>
         <div class="col-md-6">
         <div class="form-group">

            <label>Department</label>
         
            <input name="department" type="text" value="<?php echo isset($frmdata['participantlist']->department)?$frmdata['participantlist']->department:set_value('department'); ?>" class="form-control" id="inputEmail" placeholder="Department">

        </div>
        </div>
         <div class="col-md-6">
        <div class="form-group">

            <label>Designation</label>
         
            <input name="designation" type="text" value="<?php echo isset($frmdata['participantlist']->designation)?$frmdata['participantlist']->designation:set_value('designation'); ?>" class="form-control" id="inputEmail" placeholder="Designation">

        </div>
        </div>
         <div class="col-md-6">
        <div class="form-group">

            <label>Reporting to</label>
         
            <input name="reporting_to" type="text" value="<?php echo isset($frmdata['participantlist']->reporting_to)?$frmdata['participantlist']->reporting_to:set_value('reporting_to'); ?>" class="form-control" id="inputEmail" placeholder="Reporting to">

        </div>
        </div>
         <div class="col-md-6">
        <div class="form-group">

            <label>Area of Responsibility</label>
         
            <input name="area_of_responsibility" type="text" value="<?php echo isset($frmdata['participantlist']->area_of_responsibility)?$frmdata['participantlist']->area_of_responsibility:set_value('area_of_responsibility'); ?>" class="form-control" id="inputEmail" placeholder="Area of Responsibility">

        </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">

            <label>Yrs at EY</label>
         
            <input name="yrs_at_ey" type="text" value="<?php echo isset($frmdata['participantlist']->yrs_at_ey)?$frmdata['participantlist']->yrs_at_ey:set_value('yrs_at_ey'); ?>" class="form-control" id="inputEmail" placeholder="Yrs at EY">

        </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">

            <label>Total Experience</label>
         
            <input name="total_experience" type="text" value="<?php echo isset($frmdata['participantlist']->total_experience)?$frmdata['participantlist']->total_experience:set_value('total_experience'); ?>" class="form-control" id="inputEmail" placeholder="Total Experience">

        </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">

            <label>Qualification</label>
         
            <input name="qualification" type="text" value="<?php echo isset($frmdata['participantlist']->qualification)?$frmdata['participantlist']->qualification:set_value('qualification'); ?>" class="form-control" id="inputEmail" placeholder="Qualification">

        </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">

            <label>Trainings attended in the past</label>
         
            <input name="training_attended_in_the_past" type="text" value="<?php echo isset($frmdata['participantlist']->training_attended_in_the_past)?$frmdata['participantlist']->training_attended_in_the_past:set_value('training_attended_in_the_past'); ?>" class="form-control" id="inputEmail" placeholder="Trainings attended in the past">

        </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">

            <label>Previous Employer</label>
         <?php //echo'####<pre>';print_r($frmdata['itfall']->user_current_location);die;?>
            <input name="previous_employer" type="text" value="<?php echo isset($frmdata['itfall1']->previous_employer)?$frmdata['itfall1']->previous_employer:set_value('previous_employer'); ?>" class="form-control" id="inputEmail" placeholder="Previous Employer">

        </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">

            <label>E-mail Address</label>
         
            <input name="email" type="text" value="<?php echo isset($frmdata['participantlist']->email)?$frmdata['participantlist']->email:set_value('email'); ?>" class="form-control" disabled="disabled" id="inputEmail" placeholder="E-mail Address">

        </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">

            <label>Contact No.</label>
         
            <input name="contact_no" type="text" value="<?php echo isset($frmdata['participantlist']->contact_no)?$frmdata['participantlist']->contact_no:set_value('contact_no'); ?>" class="form-control"  id="inputEmail" placeholder="Contact No.">

        </div>
        </div>

<!--         <div class="col-md-6">
        <div class="form-group">

            <label>Preferred Airlines</label>
                  <?php echo form_dropdown('preferedairlience', $frmdata['allairlines'],
                  isset($frmdata['participantlist']->preferred_airlience)?$frmdata['participantlist']->preferred_airlience:'', ' class="required form-control "  ');?>
        </div>
</div> -->

 <!--       <div class="col-md-6">
        <div class="form-group">

            <label>Preferred Food</label>

            <select class="form-control" name="food">
                   <option value=""> Select Food </option>
                    <option value="veg" <?php  if(isset($frmdata['participantlist']->food) and ($frmdata['participantlist']->food =='veg') ){echo "selected='selected' ";}  ?>> Veg</option>
                     <option value="nonveg" <?php  if(isset($frmdata['participantlist']->food) and ($frmdata['participantlist']->food =='nonveg') ) {echo "selected='selected' ";} ?>> Non-Veg </option>
                  </select>
                  </div>
     
  </div> -->

   <div class="col-md-6">

          <input type="submit" class="btn btn-primary" style="margin-top: 33px;" value="Save"/>
</div>

</div>

<script>


 /*This coding use for add multipal membership
 $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var membership         = $(".member"); //Fields wrapper
    var add_button      = $("#add"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(membership).append('<div><input type="text" name="member_name[]" class="form-control"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
            $(membership).append('<div><input type="text" name="member_details[]" class="form-control"/><a href="#" class="remove_field">Remove</a></div>'); //add input box

        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});




// $(document).ready(function(){
//     $("#add").click(function(){
//       //alert("ghghgh");
//         $("input").append ("<input>Appended item</input>");
//     });
// });
</script>
</body>
</html>