<?php //echo "<pre>"; print_r($frm_data['resourceInfos']->preferred);die; ?>
 <?php //$ids=isset($frm_data['resourceInfos']->id)?$frm_data['resourceInfos']->id:''; 
$asfgfg=array('1'=>'jjhjh',
  '2'=>'hjh');

 ?>
<div class="popup_boxes trail_periods_block">

  <div class="col-md-8 col-md-offset-2" style="background-color: #fff; padding-top: 40px;">

    <form action="<?php echo site_url('admin/diagnose/saveTrfInfos');?>" method="post" accept-charset="utf-8" id="" name="" class="form-bordered ">  
    <input type="hidden" name="order_id" value="<?php echo isset($frm_data['order_id'])?$frm_data['order_id']:''; ?>">
    <input type="hidden" name="diagnose_id" value="<?php echo isset($frm_data['diagnose_id'])?$frm_data['diagnose_id']:''; ?>">
    <input type="hidden" name="user_id" value="<?php echo isset($frm_data['user_id'])?$frm_data['user_id']:''; ?>">
    <input type="hidden" name="ids" value="<?php echo isset($frm_data['resourceInfos']->id)?$frm_data['resourceInfos']->id:''; ?>">
      <div class="col-md-12 form-group" >

        <h1 class="page-head-line"> Add Details: </h1>
        <div class="trf-droup" >
          <div  class="col-sm-3">
            <div class="form-group">
             <label> <b>Mode</b> </label>
             <select name="mode" class="form-control" id="type">
              <option value="0"> Select Mode</option>
              <option value="air" <?php if(isset($frm_data['resourceInfos']->mode) and $frm_data['resourceInfos']->mode == 'air'){echo 'selected="selected"';} ?>> Air </option>
              <option value="train" <?php if(isset($frm_data['resourceInfos']->mode) and $frm_data['resourceInfos']->mode == 'train'){echo 'selected="selected"';} ?>> Train </option>
              <option value="cab" <?php if(isset($frm_data['resourceInfos']->mode) and $frm_data['resourceInfos']->mode == 'cab'){echo 'selected="selected"';} ?>> Cab </option>
              <option value="Hotel" <?php if(isset($frm_data['resourceInfos']->mode) and $frm_data['resourceInfos']->mode == 'cab'){echo 'selected="selected"';} ?>> Hotel </option>
            </select>
          </div>
        </div>
        
<div class="travel" >
        <div  class="col-sm-1">
            <div class="form-group">
            <label> <b>Return </b></label>
            <div class="cheak">
             <input type="checkbox" name="cheak" id="lease">
             </div>
            </div>
        </div>

        <div  class="col-sm-4">
          <div class="form-group">
            <label><b> Journey Date</b> </label>
            <input type="text"  class="datepicker form-control" name="journey_date" id="stdate" value="<?php echo isset($frm_data['resourceInfos']->journey_date)?$frm_data['resourceInfos']->journey_date:''; ?>">
          </div>
        </div>

         <div  class="col-sm-4 lease" style="display: none;">
          <div class="form-group">
            <label><b>Return Date</b> </label>
            <input type="text"  class="datepicker form-control " name="return_date" id="eddate" value="<?php echo isset($frm_data['resourceInfos']->return_date)?$frm_data['resourceInfos']->return_date:''; ?>">
          </div>
        </div>
        <div  class="col-sm-4">
          <div class="form-group">
            <label><b>City</b> </label>
            <input type="text"  class="datepicker form-control " name="city" id="eddate" value="<?php echo isset($frm_data['resourceInfos']->city)?$frm_data['resourceInfos']->city:''; ?>">
          </div>
        </div>

        <div class="col-sm-4 Airlince">
          <div class="form-group"> 
           <label><b>Preferred Airlines</b> </label>
           <?php echo form_dropdown('preferred',$frm_data['traveldata'],isset($frm_data['resourceInfos']->preferred)?$frm_data['resourceInfos']->preferred:'', 'class="form-control" id="name_of_client"');?>

        </div>
      </div>

       <div class="col-sm-4 tra">
          <div class="form-group"> 
           <label><b>Preferred Train</b> </label>
          <input type="text"  class="form-control " name="preferred_train" id="eddate" value="<?php echo isset($frm_data['resourceInfos']->preferred_train)?$frm_data['resourceInfos']->preferred_train:''; ?>">

        </div>
      </div>
      

      <div class="col-sm-4 cabe" >
     
          <div class="form-group"> 
           <label><b>Preferred Cab</b> </label>
           <input type="text" class="form-control" name="preferred_cab" value="<?php echo isset($frm_data['resourceInfos']->preferred_cab)?$frm_data['resourceInfos']->preferred_cab:''; ?>" >
        </div>
      </div>

     
     

      <div class="col-sm-4">
        <div class="form-group">
         <label><b> From </b> </label>
         <input type="text" class="form-control" name="journey_from" value="<?php echo isset($frm_data['resourceInfos']->journey_from)?$frm_data['resourceInfos']->journey_from:''; ?>" >
       </div>
     </div>

     <div class="col-sm-4">
      <div class="form-group"> 
        <label><b> To </b> </label>
        <input type="text"  class="form-control" name="journey_destination"  value="<?php echo isset($frm_data['resourceInfos']->journey_destination)?$frm_data['resourceInfos']->journey_destination:''; ?>" >
      </div>
    </div>


    <div class="col-sm-4">
      <div class="form-group"> 
        <label> <b>Clause</b> </label>
        <select name="clause" class="form-control">
          <option value="0"> Select Clause </option>
          <option value="after" <?php if(isset($frm_data['resourceInfos']->clause) and $frm_data['resourceInfos']->clause == 'after'){echo 'selected="selected"';} ?>>After</option>
          <option value="before" <?php if(isset($frm_data['resourceInfos']->clause) and $frm_data['resourceInfos']->clause == 'before'){echo 'selected="selected"';} ?>> Before </option>
        </select>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="form-group"> 
       <label><b> Time </b> </label>
       <input type="text"  class="form-control" name="dept_time" id="basicExample" value="<?php echo isset($frm_data['resourceInfos']->dept_time)?$frm_data['resourceInfos']->dept_time:''; ?>" />
     </div>
   </div>

   <div  class="col-sm-4 food">
    <div class="form-group"> 
      <label><b> Food </b> </label>
      <select name="food" class="form-control">
        <option value="0">Select food category</option>
         <option value="veg" <?php if(isset($frm_data['resourceInfos']->food) and $frm_data['resourceInfos']->food == 'veg'){echo 'selected="selected"';} ?>>Veg</option>
        <option value="non-veg" <?php if(isset($frm_data['resourceInfos']->food) and $frm_data['resourceInfos']->food == 'non-veg'){echo 'selected="selected"';} ?>>Non-Veg</option>
      </select>
    </div>
  </div>



  <div  class="col-sm-4" id="desc">
    <div class="form-group"> 
     <label><b> Add Description </b> </label>
     <textarea class="form-control custom-control" rows="4" cols="10" name="description"><?php echo isset($frm_data['resourceInfos']->description)?$frm_data['resourceInfos']->description:''; ?> </textarea>
   </div>
 </div>


</div>
<div class="hotel_detail" id="detail">
    
    
        <div  class="col-sm-3">
          <div class="form-group">
            <label><b>Cheak In Date</b> </label>
            <input type="text"  class="datepicker form-control" name="checkin_date" value="<?php echo isset($frm_data['resourceInfos']->checkin_date)?$frm_data['resourceInfos']->checkin_date:''; ?>">
          </div>
        </div>

         <div  class="col-sm-3">
          <div class="form-group">
            <label><b>Cheak Out Date</b> </label>
            <input type="text"  class="datepicker form-control " name="checkout_date" value="<?php echo isset($frm_data['resourceInfos']->checkout_date)?$frm_data['resourceInfos']->checkout_date:''; ?>">
          </div>
        </div>

         <div  class="col-sm-3">
          <div class="form-group">
            <label><b>City</b> </label>
            <input type="text"  class=" form-control " name="city" value="<?php echo isset($frm_data['resourceInfos']->city)?$frm_data['resourceInfos']->city:''; ?>">
          </div>
        </div>

       <div class="col-sm-4 ">
          <div class="form-group"> 
           <label><b>Preferred Hotel</b> </label>
            <input type="text"  class=" form-control " name="preferred_hotel" value="<?php echo isset($frm_data['resourceInfos']->preferred_hotel)?$frm_data['resourceInfos']->preferred_hotel:''; ?>">
        </div>
      </div>

      <div class="col-sm-4 cabe" >
          <div class="form-group"> 
           <label><b>Room Preference</b> </label>
           <select class="form-control">
             <option value="0">Select Room </option>
             <option value="Smoking" <?php echo isset($frm_data['resourceInfos']->room_preference)?$frm_data['resourceInfos']->room_preference:'';?>>Smoking </option>
             <option value="Non Smoking" <?php echo isset($frm_data['resourceInfos']->room_preference)?$frm_data['resourceInfos']->room_preference:'';?>> Non Smoking </option>
             
           </select>

        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
         <label><b>Dite Remarks </b> </label>
         <input type="text" class="form-control" name="dite_remark" value="<?php echo isset($frm_data['resourceInfos']->dite_remark)?$frm_data['resourceInfos']->dite_remark:''; ?>" >
       </div>
     </div>

     <div class="col-sm-4">
      <div class="form-group"> 
        <label><b> Star Category </b> </label>
        <select class="form-control">
             <option value="Select Hotel Type">Select Hotel Type </option>
             <option value="1 star"<?php if(isset($frm_data['resourceInfos']->star_category) and $frm_data['resourceInfos']->star_category == '1 star'){echo 'selected="selected"';} ?>>1 Star</option>
             <option value="2 star"<?php if(isset($frm_data['resourceInfos']->star_category) and $frm_data['resourceInfos']->star_category == '1 star'){echo 'selected="selected"';} ?>>2 Star</option> 
             <option value="3 star"<?php if(isset($frm_data['resourceInfos']->star_category) and $frm_data['resourceInfos']->star_category == '1 star'){echo 'selected="selected"';} ?>>3 Star</option> 
             <option value="4 star"<?php if(isset($frm_data['resourceInfos']->star_category) and $frm_data['resourceInfos']->star_category == '1 star'){echo 'selected="selected"';} ?>>4 Star</option> 
             <option value="5 star"<?php if(isset($frm_data['resourceInfos']->star_category) and $frm_data['resourceInfos']->star_category == '1 star'){echo 'selected="selected"';} ?>>5 Star </option>
           </select>
      </div>
    </div>

     <div class="col-sm-4">
        <div class="form-group">
         <label><b> Budget </b> </label>
         <input type="text" class="form-control" name="journey_from" value="<?php echo isset($frm_data['resourceInfos']->budget)?$frm_data['resourceInfos']->budget:''; ?>" >
       </div>
     </div>

     <div class="col-sm-4">
        <div class="form-group">
         <label><b>Select Option</b></label>
         <div class="chek"> 
         <input type="checkbox" name="chek" value="">  <label><b> Include Breakfast </b></label>
         </div>
          <div class="chek"> 
         <input type="checkbox" name="chek" value="">  <label><b> Include meals </b></label>
         </div>

       </div>
     </div>

  <div  class="col-sm-5">
    <div class="form-group"> 
     <label><b> Add Description </b> </label>
     <textarea class="form-control custom-control" rows="4" cols="10" name="description" style="resize: none;"><?php echo isset($frm_data['resourceInfos']->description)?$frm_data['resourceInfos']->description:''; ?> </textarea>
   </div>
 </div>
</div>
  
</div>

<div class="col-md-6">
  <input type="submit" class="btn btn-primary mb10" value="submit" name="submit"> 
</div>
<?php echo form_close(); ?>
</div>
</div>
<!-- end dropdown menu -->

</div>

</div>

<script>

  $(function() {



    $(document).ready(function(){
      $('.tra').hide();
      $('.cabe').hide();
      $('#detail').hide();
      $('.ram').hide();

    })

        $('#type').change(function(){
          $('.Airlince').show(); 
           $('.cabe').show(); 
           $('.tra').show(); 
            $('.travel').show();
            $('#detail').show();
             $('.ram').show();

            if($('#type').val() == 'train') {
                $('.Airlince').hide(); 
                $('.cabe').hide(); 
               $('#detail').hide();
                $('.ram').hide();
                
            } 
            else if($('#type').val() == 'air'){
              $('.cabe').hide(); 
              $('.tra').hide();
                $('.ram').hide();
               $('#detail').hide();
            }
            else if($('#type').val() == 'cab'){
              $('.Airlince').hide(); 
              $('.tra').hide();
               $('#detail').hide();
              
            }
            else if($('#type').val() == 'Hotel'){
              $('.Airlince').hide(); 
              $('.tra').hide();          
              $('.travel').hide();
               $('.ram').hide();
            }
            else if($('#type').val() == '0'){        
              $('.tra').hide();          
              $('#detail').hide();
              $('.cabe').hide(); 
               $('.ram').hide();
            }
            else {
                $('.tra').show(); 

            } 
        });
    });


      $( function() {
        $( ".datepicker" ).datepicker();
              
              format:"dd/mm/yyyy"


      } );


        $('#lease').click(function() {
                var $this = $(this);
                if ($this.is(':checked')) {

                    $('.lease').show();
                } else {
                    $('.lease').hide();
                }
            });

   
</script>

<script type="text/javascript">
  $(document).ready(function()
  {
    $('#basicExample').timepicker({ 'timeFormat': 'h:i A' });
  })
</script>

    



  



