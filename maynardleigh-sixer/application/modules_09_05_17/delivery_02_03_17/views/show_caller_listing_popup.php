<?php //echo $frm_data['resourceInfos']->return_date;die; ?>
 <?php //$ids=isset($frm_data['resourceInfos']->id)?$frm_data['resourceInfos']->id:''; 
$asfgfg=array('1'=>'jjhjh',
  '2'=>'hjh');

 ?>
<div class="popup_boxes trail_periods_block">

  <div class="col-md-8 col-md-offset-2" style="background-color: #fff; padding-top: 40px;">
      <div class="row">
<?php //echo "<pre>";print_r($frmdata['showuserdata']);die; ?>
    <div class="col-md-12">
               <?php if(count($frmdata['showuserdata'])>0){ ?>              
        <div class="table-responsive">

                         <input name="itfid" value="" id="itfids" type="hidden">            
                         <input name="itfaction" value="" id="itfaction" type="hidden">            
                         <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="event_row">ID</th>
                        <th>Name</th>             
                        <th>Email Id</th>
                        <th>Contact No</th>
                        <th colspan="3">Action</th> 
                        
                        
                    </tr>
                </thead>
                <tbody>
                <?php //echo '<pre>';print_r($frmdata);die;?>
                <?php foreach ($frmdata['showuserdata'] as $key => $value) {?>
                    <tr>
                        <td><?php echo $value->id;?></td>
                        <td><?php echo $value->name;?></td>
                        <td><?php echo $value->email;?></td>
                        <td><?php echo $value->contact_no;?></td>
                        <!-- <td><a href="<?php //echo site_url('admin/user_manager/form/'.$value->id.'/'.$value->order_id.'/'.$value->delivery_id); ?>" title="Edit"><i class="fa fa-pencil"></i></a> </td> -->
                         <td><a href="<?php echo site_url('admin/delivery/userDelete/'.$value->order_id.'/'.$value->delivery_id.'/'.$value->id); ?>" onclick="return confirm('Are you sure?')" title="Delete"><i class="fa fa-trash-o"></i></a></td>
                        
                    </tr>
                     <?php }?>                   
                                       
                    </tbody>
            </table>
            
        </div>
        

        <!-- table-responsive -->
    </div><!-- col-md-6 -->     
    <div class="col-xs-12">
                
    </div>


</div><?php } else{echo 'No Record Found';}?>
  </div>
<!-- end dropdown menu -->

</div>

</div>

<script>

  $(function() {



    $(document).ready(function(){
        $("#venueclause").hide();
         $('.returnclause').hide();
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
                 $('.city').hide();
                 $('#desc').show();
                 $('#venueclause').hide();
                  if($('.rtn').is(':checked'))
                   {
                    //$('.lease').show();
                    $('.lease').css('visibility', 'visible');
                    $('.returnclause').show();
                   }else
                   {
                    //$('.lease').hide();
                    $('.lease').css('visibility', 'hidden');
                     $('.returnclause').hide();
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
                 $('#venueclause').hide();
                   $('.mb10').show();
                    if($('.rtn').is(':checked'))
                   {
                    //$('.lease').show();
                    $('.lease').css('visibility', 'visible');
                     $('.returnclause').show();
                   }else
                   {
                    //$('.lease').hide();
                    $('.lease').css('visibility', 'hidden');
                     $('.returnclause').hide();
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
                 $('.clause').hide();
                 $('.time').show();
                 $('.food').hide();
                 $('.return').hide();
                 $('#desc').show();
                $('#venueclause').hide();
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
                $('#venueclause').hide();
                  $('.mb10').show();
                  $('.lease').hide();
            
            }
            else if($('#type').val() == 'Venue'){ 
              $('.tra').hide();
                $('.ram').hide();
               $('#detail').hide();
               $('.add_hotel').hide();
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
                 $('#venueclause').show();
                   $('.mb10').show();
                    
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
                $('#venueclause').hide();
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
                 $('#venueclause').hide();
                   $('.mb10').show();
               }
             

    })

        $('#type').change(function(){
          $('.Airlince').show(); 
           //$('.cabe').show(); 
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
                 $('.city').hide();
                 $('#desc').show();
                 $('#venueclause').hide();
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
                $('#venueclause').hide();
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
                 $('.clause').hide();
                 $('.time').show();
                 $('.food').hide();
                 $('.return').hide();
                 $('#desc').show();
                 $('#venueclause').hide();
                 $('.city').show();
                 $('.cabe').hide();
                 $('.mb10').show();
                 $('.lease').css('visibility', 'hidden');
                  $('.returnclause').hide();
              
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
                $('#venueclause').hide();
                   $('.mb10').show();
                   //$('.lease').hide();
                   $('.lease').css('visibility', 'hidden');
                    $('.returnclause').hide();
            
            
            }
            else if($('#type').val() == 'Venue'){
            //alert('hello');
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
                 $('#venueclause').show();
                   $('.mb10').show();
                   //$('.lease').hide();
                   $('.lease').css('visibility', 'hidden');
                    $('.returnclause').hide();
            
            
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
                 //$('#venue').hide();
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

                    //$('.lease').show();
                    $('.lease').css('visibility', 'visible');
                     $('.returnclause').show();
                } else {
                    //$('.lease').hide();
                    $('.lease').css('visibility', 'hidden');
                     $('.returnclause').hide();
                }
            });

   
</script>

<script type="text/javascript">
  $(document).ready(function()
  {
    $('#basicExample').timepicker({ 'timeFormat': 'h:i A' });
    $('#basicExample1').timepicker({ 'timeFormat': 'h:i A' });
  })
</script>
    


