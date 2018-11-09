<?php //echo $frm_data['resourceInfos']->return_date;die; ?>
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
              <option value="Hotel" <?php if(isset($frm_data['resourceInfos']->mode) and $frm_data['resourceInfos']->mode == 'Hotel'){echo 'selected="selected"';} ?>> Hotel </option>
            </select>
          </div>
        </div>
        
<div class="travel" >
        <div  class="col-sm-1 return">
            <div class="form-group">
            <label> <b>Return </b></label>
            <div class="cheak">
             <input type="checkbox" class="rtn" name="cheak" id="lease"<?php echo isset($frm_data['resourceInfos']->return_date) && ($frm_data['resourceInfos']->return_date)>0 ? 'checked':'';?>>
             </div>
            </div>
        </div>

        <div  class="col-sm-4 jndate">
          <div class="form-group">
            <label><b> Journey Date</b> </label>
            <input type="text"  class="datepicker1 form-control" name="journey_date" id="stdate" value="<?php echo isset($frm_data['resourceInfos']->journey_date)?$frm_data['resourceInfos']->journey_date:''; ?>">
          </div>
        </div>
    
        <div  class="col-sm-4 add_hotel">
          <div class="form-group">
            <label><b>Cheak In Date</b> </label>
            <input type="text"  class="datepicker form-control" name="checkin_date" value="<?php echo isset($frm_data['resourceInfos']->checkin_date)?$frm_data['resourceInfos']->checkin_date:''; ?>">
          </div>
        </div>
         <div  class="col-sm-4 add_hotel">
          <div class="form-group">
            <label><b>Cheak Out Date</b> </label>
            <input type="text"  class="datepicker form-control " name="checkout_date" value="<?php echo isset($frm_data['resourceInfos']->checkout_date)?$frm_data['resourceInfos']->checkout_date:''; ?>">
          </div>
        </div>
      <!--  <div class="col-sm-4 add_hotel">
          <div class="form-group"> 
           <label><b>Preferred Hotel</b> </label>
            <input type="text"  class=" form-control " name="preferred_hotel" value="<?php echo isset($frm_data['resourceInfos']->preferred_hotel)?$frm_data['resourceInfos']->preferred_hotel:''; ?>">
        </div>
      </div> -->
       <div class="col-sm-4 add_hotel">
        <div class="form-group">
         <label><b>Diet Remark </b> </label>
         <input type="text" class="form-control" name="diet_remark" value="<?php echo isset($frm_data['resourceInfos']->diet_remark)?$frm_data['resourceInfos']->diet_remark:''; ?>" >
       </div>
     </div>
     <div class="col-sm-4 add_hotel">
      <div class="form-group "> 
        <label><b> Star Category </b> </label>
      
        <?php 
          $category=array(''=>'Select Category','1'=>'1 Star','2'=>'2 Star','3'=>'3 Star','4'=>'4 Star','5'=>'5 Star');

          echo form_dropdown('star_category',$category,isset($frm_data['resourceInfos']->star_category)?$frm_data['resourceInfos']->star_category:'','class="form-control"');
        ?>
      </div>
    </div>

     <div class="col-sm-4 add_hotel">
        <div class="form-group">
         <label><b> Budget </b> </label>
         <input type="text" class="form-control" name="budget" value="<?php echo isset($frm_data['resourceInfos']->budget)?$frm_data['resourceInfos']->budget:''; ?>" >
       </div>
     </div>

     
       <div class="col-sm-4 cabe" >
          <div class="form-group"> 
           <label><b>Room Preference</b> </label>
          
              <?php 
          $category=array(''=>'Select Room Preference','smoking'=>'Smoking','nonsmoking'=>'Non Smoking');

          echo form_dropdown('room_preference',$category,isset($frm_data['resourceInfos']->room_preference)?$frm_data['resourceInfos']->room_preference:'','class="form-control"');
        ?>
        </div>
      </div>

     <div class="col-sm-4 add_hotel">
        <div class="form-group">
         <label><b>Select Option</b></label>
         <div class="chek"> 
         <input type="checkbox" name="breakfast" value="1"<?php echo isset($frm_data['resourceInfos']->breakfast) && ($frm_data['resourceInfos']->breakfast)>0 ? 'checked':'';?>> <label><b> Include Breakfast </b></label>
         </div>
          <div class="chek"> 
         <input type="checkbox" name="meals" value="1"<?php echo isset($frm_data['resourceInfos']->meals) && ($frm_data['resourceInfos']->meals)>0 ? 'checked':'';?>>  <label><b> Include meals </b></label>
         </div>

       </div>
     </div>

         <div  class="col-sm-4 lease" style="display: none;">
          <div class="form-group">
            <label><b>Return Date</b> </label>
            <input type="text"  class="datepicker2 form-control " name="return_date" id="eddate" value="<?php echo isset($frm_data['resourceInfos']->return_date)?$frm_data['resourceInfos']->return_date:''; ?>">
          </div>
        </div>
        <div  class="col-sm-4 city">
          <div class="form-group">
            <label><b>City</b> </label>
            <input type="text"  class=" form-control " name="city" value="<?php echo isset($frm_data['resourceInfos']->city)?$frm_data['resourceInfos']->city:''; ?>">

          </div>
        </div>

        <div class="col-sm-4 Airlince preferred_air">
          <div class="form-group"> 
           <label><b>Preferred Airlines</b> </label>
           <?php echo form_dropdown('preferred',$frm_data['traveldata'],isset($frm_data['resourceInfos']->preferred)?$frm_data['resourceInfos']->preferred:'', 'class="form-control" id="name_of_client"');?>

        </div>
      </div>

       <div class="col-sm-4 tra">
          <div class="form-group"> 
           <label><b>Preferred Train</b> </label>
         
            <?php
           
        $data=array(
          'name'=>'preferred_train',
          'class'=>'form-control',
          'id'=>'name_of_client',
          'value'=>isset($frm_data['resourceInfos']->preferred_train)?$frm_data['resourceInfos']->preferred_train:''
          );
        echo form_input($data);
      ?>
       </div>
      </div>
      

      <div class="col-sm-4" >
     
          <div class="form-group precab"> 
           <label><b>Preferred Cab</b> </label>
           <?php
            $options=array(''=>'Select Cab','OLA Cabs'=>'OLA Cabs','Uber'=>'Uber','Meru Cabs'=>'Meru Cabs','Easy Cabs'=>'Easy Cabs','Savaari.com'=>'Savaari.com','Mega Cabse'=>'Mega Cabse','Tab Cab'=>'Tab Cab','Wings Radio Cab'=>'Wings Radio Cab','Cel Cabs'=>'Cel Cabs');
            echo form_dropdown('preferred_cab',$options,isset($frm_data['resourceInfos']->preferred_cab)?$frm_data['resourceInfos']->preferred_cab:'','class="form-control"');
           ?>

        </div>
      </div>

     
     

      <div class="col-sm-4 from">
        <div class="form-group">
         <label><b> From </b> </label>
         <input type="text" class="form-control" name="journey_from" value="<?php echo isset($frm_data['resourceInfos']->journey_from)?$frm_data['resourceInfos']->journey_from:''; ?>" >
       </div>
     </div>

     <div class="col-sm-4 to">
      <div class="form-group"> 
        <label><b> To </b> </label>
        <input type="text"  class="form-control" name="journey_destination"  value="<?php echo isset($frm_data['resourceInfos']->journey_destination)?$frm_data['resourceInfos']->journey_destination:''; ?>" >
      </div>
    </div>


    <div class="col-sm-4 clause">
      <div class="form-group"> 
        <label> <b>Clause</b> </label>
        <select name="clause" class="form-control">
          <option value="0"> Select Clause </option>
          <option value="after" <?php if(isset($frm_data['resourceInfos']->clause) and $frm_data['resourceInfos']->clause == 'after'){echo 'selected="selected"';} ?>>After</option>
          <option value="before" <?php if(isset($frm_data['resourceInfos']->clause) and $frm_data['resourceInfos']->clause == 'before'){echo 'selected="selected"';} ?>> Before </option>
        </select>
      </div>
    </div>

    <div class="col-sm-4 time">
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
     <label><b> Add Description</b> </label>
     <textarea class="form-control custom-control" rows="4" cols="10" name="description"><?php echo isset($frm_data['resourceInfos']->description)?$frm_data['resourceInfos']->description:''; ?> </textarea>
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
       if($('#type').val() == 'train') {
                $('.Airlince').hide(); 
                $('.cabe').hide(); 
               $('#detail').hide();
                $('.ram').hide();
                $('.add_hotel').hide();
                $('.add_hotel').hide();
                 $('.add_hotel').hide();
                 $('.jndate').show();
                 $('.preferred_air').hide();
                 $('.tra').show();
                 $('.precab').hide();
                 $('.from').show();
                 $('.to').show();
                 $('.clause').show();
                 $('.time').show();
                 $('.food').show();
                 $('.return').show();
                 $('.city').show();
                 $('#desc').show();
                  if($('.rtn').is(':checked'))
                   {
                    $('.lease').show();
                   }else
                   {
                    $('.lease').hide();
                   }
                
            } 
            else if($('#type').val() == 'air'){
              $('.cabe').hide(); 
              $('.tra').hide();
                $('.ram').hide();
               $('#detail').hide();
               $('.add_hotel').hide();
                  $('#detail').hide();
              $('.cabe').hide(); 
               $('.ram').hide();
               $('.add_hotel').hide();
                 $('.add_hotel').hide();
                 $('.jndate').show();
                 $('.preferred_air').show();
                 $('.tra').hide();
                 $('.precab').hide();
                 $('.from').show();
                 $('.to').show();
                 $('.clause').show();
                 $('.time').show();
                 $('.food').show();
                 $('.return').show();
                 $('.city').hide();
                 $('#desc').show();
                   $('.mb10').show();
                    if($('.rtn').is(':checked'))
                   {
                    $('.lease').show();
                   }else
                   {
                    $('.lease').hide();
                   }
            }
            else if($('#type').val() == 'cab'){
              $('.Airlince').hide(); 
              $('.tra').hide();
               $('#detail').hide();
               $('.add_hotel').hide();

                $('.jndate').show();
                 $('.preferred_air').hide();
                
                 $('.precab').show();
                 $('.from').show();
                 $('.to').show();
                 $('.clause').show();
                 $('.time').show();
                 $('.food').hide();
                 $('.return').hide();
                 $('#desc').show();
                 $('.city').show();
                 $('.cabe').hide();
                    $('.mb10').show();
              
            }
            else if($('#type').val() == 'Hotel'){
            
                 $('.add_hotel').show();
                 $('.jndate').hide();
                 $('.preferred_air').hide();
                 $('.tra').hide();
                 $('.precab').hide();
                 $('.from').hide();
                 $('.to').hide();
                 $('.clause').hide();
                 $('.time').hide();
                 $('.food').hide();
                 $('.return').hide();
                 $('.city').show();
                 $('#desc').show();
                  $('.mb10').show();
                  $('.lease').hide();
            
            }
            else if($('#type').val() == '0'){        
              $('.tra').hide();          
              $('#detail').hide();
              $('.cabe').hide(); 
               $('.ram').hide();
               $('.add_hotel').hide();
                 $('.add_hotel').hide();
                 $('.jndate').hide();
                 $('.preferred_air').hide();
                 $('.tra').hide();
                 $('.precab').hide();
                 $('.from').hide();
                 $('.to').hide();
                 $('.clause').hide();
                 $('.time').hide();
                 $('.food').hide();
                 $('.return').hide();
                 $('.city').hide();
                 $('#desc').hide();
                 $('.mb10').hide();
            }
            else {
           

      $('.tra').hide();
      $('.cabe').hide();
      $('#detail').hide();
      $('.ram').hide();
       $('.tra').hide();          
              $('#detail').hide();
              $('.cabe').hide(); 
               $('.ram').hide();
               $('.add_hotel').hide();
                 $('.add_hotel').hide();
                 $('.jndate').hide();
                 $('.preferred_air').hide();
                 $('.tra').hide();
                 $('.precab').hide();
                 $('.from').hide();
                 $('.to').hide();
                 $('.clause').hide();
                 $('.time').hide();
                 $('.food').hide();
                 $('.return').hide();
                 $('.city').hide();
                 $('#desc').hide();
                   $('.mb10').show();
               }
             

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
                $('.add_hotel').hide();
                $('.add_hotel').hide();
                 $('.add_hotel').hide();
                 $('.jndate').show();
                 $('.preferred_air').hide();
                 $('.tra').show();
                 $('.precab').hide();
                 $('.from').show();
                 $('.to').show();
                 $('.clause').show();
                 $('.time').show();
                 $('.food').show();
                 $('.return').show();
                 $('.city').show();
                 $('#desc').show();
                   $('.mb10').show();
                
            } 
            else if($('#type').val() == 'air'){
              $('.cabe').hide(); 
              $('.tra').hide();
                $('.ram').hide();
               $('#detail').hide();
               $('.add_hotel').hide();
                  $('#detail').hide();
              $('.cabe').hide(); 
               $('.ram').hide();
               $('.add_hotel').hide();
                 $('.add_hotel').hide();
                 $('.jndate').show();
                 $('.preferred_air').show();
                 $('.tra').hide();
                 $('.precab').hide();
                 $('.from').show();
                 $('.to').show();
                 $('.clause').show();
                 $('.time').show();
                 $('.food').show();
                 $('.return').show();
                 $('.city').hide();
                 $('#desc').show();
                   $('.mb10').show();
            }
            else if($('#type').val() == 'cab'){
              $('.Airlince').hide(); 
              $('.tra').hide();
               $('#detail').hide();
               $('.add_hotel').hide();

                $('.jndate').show();
                 $('.preferred_air').hide();
                
                 $('.precab').show();
                 $('.from').show();
                 $('.to').show();
                 $('.clause').show();
                 $('.time').show();
                 $('.food').hide();
                 $('.return').hide();
                 $('#desc').show();
                 $('.city').show();
                 $('.cabe').hide();
                   $('.mb10').show();

              
            }
            else if($('#type').val() == 'Hotel'){
            
                 $('.add_hotel').show();
                 $('.jndate').hide();
                 $('.preferred_air').hide();
                 $('.tra').hide();
                 $('.precab').hide();
                 $('.from').hide();
                 $('.to').hide();
                 $('.clause').hide();
                 $('.time').hide();
                 $('.food').hide();
                 $('.return').hide();
                 $('.city').show();
                 $('#desc').show();
                   $('.mb10').show();
                   $('.lease').hide();
            
            
            }
            else if($('#type').val() == '0'){        
              $('.tra').hide();          
              $('#detail').hide();
              $('.cabe').hide(); 
               $('.ram').hide();
               $('.add_hotel').hide();
                 $('.add_hotel').hide();
                 $('.jndate').hide();
                 $('.preferred_air').hide();
                 $('.tra').hide();
                 $('.precab').hide();
                 $('.from').hide();
                 $('.to').hide();
                 $('.clause').hide();
                 $('.time').hide();
                 $('.food').hide();
                 $('.return').hide();
                 $('.city').hide();
                 $('#desc').hide();
                   $('.mb10').hide();
            }
            else {
                $('.tra').show(); 

            } 
        });
    });


      $( function() {
        $( ".datepicker" ).datepicker();
              
              format:"dd/mm/yyyy"
      $( ".datepicker1" ).datepicker();
              
               $( ".datepicker2" ).datepicker();   

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