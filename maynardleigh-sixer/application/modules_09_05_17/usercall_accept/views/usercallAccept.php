
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Maynardleigh Online Book your time slot</title>
<style>
body{ font-family:Verdana, Geneva, sans-serif;}


</style>

</head>



<body style="background:#FFFFFF; margin:0px auto; padding:0px; font-family:Arial, Helvetica, sans-serif;">



<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#FFFFFF;box-shadow: 1px 5px 27px -4px #a7a7a7;min-width:332px;max-width:600px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px;">

 <tr>
     <td align="center" valign="top" style="background-color:#077d9f; padding:10px;">
     <div style="width:230px; height:230px; border-radius:100%; border: 1px solid #fff; background-color:#fff;  display:block;">
     <img style="width:170px; height:190px;border-radius: 19%; margin:17px;" src="<?php echo base_url("assests/img/default.jpg");?>"/>
     </div>
     </td>
   

  </tr>
 
  <tr>

    <td>
    <table cellpadding="20" cellspacing="0" width="100%" height="600px" align="center" style="background-color:#fafafa; font-family:Arial, Helvetica, sans-serif; text-align:center;" >
    	<tr>
        	<td>
<?php  //echo "###<pre>";print_r($frmdata['timeassign']);die;?>
<div class="row">
  <div class="col-md-6">
  
</div>
<div class="col-md-6 text-right">
    <!-- <a type="button" class="btn btn-primary" value="view_details" href="<?php //echo site_url('admin/diagnose/form/'.$ids)?>">Add Diagnose</a> -->
</div>
</div>
<div class="clearfix"></div>
<!-- Trigger the modal with a button -->
   <?php if(count($frmdata['timeassign'])>0) { 
                  //$count=count($all->order_id);
                  //print_r($count);die;?>
                  <div class="table-responsive">
                      <div><strong>Select Your Time Slot,<?php if(isset($frmdata['timeassign'])){ print_r(substr($frmdata['timeassign'][0]->time_slot_start,0, -8));  }   ?></strong></div>
                     <table class="table table-bordered table-hover  table-inverse" summary="">
                        <thead class="thead-inverse">
                           <tr>
                              <th>Sl. No</th>
                              <th>Start Time Slot</th>
                              <th>End Time Slot</th>
                              <th>Action</th>
                           </tr> 

                        </thead>
                        <tbody>
                           <?php 
                           $i=0;
                           foreach ($frmdata['timeassign'] as $key => $value) {
                            //echo "<pre>";print_r($value);die;
                        ?>
                           <tr>
                           

                              <td><?php echo ++$i;?></td>

                              <td><?php  
                               echo date('h :i A',$value->timestampstart); 
                             ?></td>
                              
                              <td>
                                  <?php echo date('h :i A',$value->timestampend);?></td>
                              <td>
                              <?php if(isset($frmdata['selectedtimeslot']) && ($frmdata['selectedtimeslot']==$value->id)){
                                  echo "<strong>Your Time</strong>";
                              }else if(isset($frmdata['allid']) && (in_array($value->id, $frmdata['allid']))){  ?>

                                  <strong>Already Booked</strong>
                             <?php }else if($value->lunchflage==1){?>
                                 <strong>Lunch Time</strong>
                              <?php  }elseif(!(isset($frmdata['selectedtimeslot']))){ ?>

                                  <a onclick="return confirm ('Are you so sure for book this time slot for you ?')" href="<?php echo site_url('usercall_accept/accept/'.$value->id."/".$frmdata['user_id']) ?>" class="btn btn-primary mb10">Book This One!</a>
                              
                               <?php  } ?>            
                              </td>                              
                           </tr>
                           <?php  }?>
                        </tbody>
                     </table>
                  </div><?php }else{?>
                  <div class="page-head-line"></div>
                  <div class="notfound_text">Sorry!</div>
                  <div class="norecordfound">No Record Available</div>
                     <?php } ?>
                     <?php //echo $link ; ?>
                  
            
                  </td>
        </tr>
        <tr>
        	<td>

   

    <p>Thanks and Regards<br>

      Maynardleigh Team<br>

    </p></td>
        </tr>
        
 
  <tr>	
    <td height="20"  align="center" valign="middle" style="background:#077d9f;box-shadow: 1px 5px 27px -4px #a7a7a7;"><a href="#" target="_blank" style="text-decoration:none;"><strong style="color:#fff;">Maynardleigh Associates</strong></a></td>

  </tr>
    </table>
    </td>

  </tr>


</table>
    <script type="text/javascript">
             $(document).ready(function(){

            $('#clock').on('click', function() {
              //alert('hello');
            $('#modal').show('1000');
            //$('#modal').css('z-index', '1500');
            });
           
        });
      </script> 

</body>

</html>



