<?php
//$calview=$frmdata['calview'];
//echo "##<pre>"; print_r(count($frmdata['allTimeSlots']));die;
$startdate = strtotime($frmdata['start_end']->start_date);
$enddate = strtotime($frmdata['start_end']->end_date);
$startdatenew=date('m/d/Y h:i A',$startdate);
$enddatenew=date('m/d/Y h:i A',$enddate);
//echo "@@<pre>";print_r($startdatenew);die;
 ?>

<div class="col-md-12">
    <?php echo form_open('admin/delivery/timeslot/'.$frmdata['order_id']."/".$frmdata['diagnose_id'],array('id'=>'time_slot','name'=>'time_slot')); ?>
        
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Resources</label>
                <div class="clearfix"></div>
             
                <?php echo form_dropdown('manager',$frmdata['allmanager'],isset($frmdata['selectedResource'])?$frmdata['selectedResource']:'','class="selectpicker form-control" id="manager" onchange="changeCalender()"');?>
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <!--                <label>Date -Time</label>-->
                <div class="clearfix"></div>
                <!--                <input type="text" class="form-control" name="daterange" value="<?php echo $startdatenew.' '.'-'.' '.$enddatenew;?>" />-->
                <input type="hidden" class="form-control" name="diagnose_id" value="<?php echo isset($frmdata['diagnose_id'])?$frmdata['diagnose_id']:''; ?>" />
                <input type="hidden" class="form-control" id ="order_id" name="order_id" value="<?php echo isset($frmdata['order_id'])?$frmdata['order_id']:''; ?>" />
                <input type="hidden" id="remail" class="form-control" name="cast_email" value="<?php echo isset($frmdata['results']['assigndetails']->email)?$frmdata['results']['assigndetails']->email:''; ?>" />
                <input type="hidden" id="rname" class="form-control" name="cast_name" value="<?php echo isset($frmdata['results']['assigndetails']->resourcename)?$frmdata['results']['assigndetails']->resourcename:''; ?>" />
                <input type="hidden" class="form-control" name="product_name" value="<?php echo isset($frmdata['results']['assigndetails']->proname)?$frmdata['results']['assigndetails']->proname:''; ?>" />
                <input type="hidden" class="form-control" name="location" value="<?php echo isset($frmdata['results']['assigndetails']->location)?$frmdata['results']['assigndetails']->location:''; ?>" /> 
                <input type="hidden" class="form-control" name="subpro" value="<?php echo isset($frmdata['results']['assigndetails']->name)?$frmdata['results']['assigndetails']->name:''; ?>" />
                <input type="hidden" class="form-control" name="client_name" value="<?php echo isset($frmdata['results']['assigndetails']->clientname)?$frmdata['results']['assigndetails']->clientname:''; ?>" />
                <input type="hidden" class="form-control" name="startdate" value="<?php echo isset($frmdata['results']['assigndetails']->start_date)?$frmdata['results']['assigndetails']->start_date:''; ?>" />
                <input type="hidden" class="form-control" name="starttime" value="<?php echo isset($frmdata['results']['assigndetails']->start_time)?$frmdata['results']['assigndetails']->start_time:''; ?>" />
                <input type="hidden" class="form-control" name="enddate" value="<?php echo isset($frmdata['results']['assigndetails']->end_date)?$frmdata['results']['assigndetails']->end_date:''; ?>" />
                <input type="hidden" class="form-control" name="endtime" value="<?php echo isset($frmdata['results']['assigndetails']->end_time)?$frmdata['results']['assigndetails']->end_time:''; ?>" />

                <input type="hidden" class="form-control" name="productId" value="<?php echo isset($frmdata['results']['assigndetails']->products)?$frmdata['results']['assigndetails']->products:''; ?>" />

                <input type="hidden" class="form-control" name="lunchendtime" value="<?php echo isset($frmdata['results']['assigndetails']->lunchendtime)?$frmdata['results']['assigndetails']->lunchendtime:''; ?>" />

                <input type="hidden" class="form-control" name="lunchstarttime" value="<?php echo isset($frmdata['results']['assigndetails']->lunchstarttime)?$frmdata['results']['assigndetails']->lunchstarttime:''; ?>" />

                <input type="hidden" class="form-control" name="intervaltime" value="<?php echo isset($frmdata['results']['assigndetails']->intervaltime)?$frmdata['results']['assigndetails']->intervaltime:''; ?>" />

                <input type="hidden" class="form-control" name="timeduration" value="<?php echo isset($frmdata['results']['assigndetails']->timeduration)?$frmdata['results']['assigndetails']->timeduration:''; ?>" />
                <?php
                if(isset($frmdata['calluser']))
                     {
                     foreach ($frmdata['calluser'] as $key => $value) 
                     {?>
                       <input type="hidden" class="form-control" name="cemail[]" value="<?php echo isset($value->email)?$value->email:''; ?>" />
                     
                     <?php }
                     }
                    ?>
            </div>
        </div>
        <div class="col-md-6">
        	<input type="submit"  class="btn btn-primary mb10 hidden" value="submit" name="submit" id="submittimeslot">	
        </div>
        <div id='processing'></div>
        
    </div>
    <?php echo form_close(); ?>
</div>









<!-- <div class="col-md-6">
    
	<a href="<?php echo site_url('diagnose/viewCalender/');?>">View Calenders</a>
    
    </div> -->
<div class="col-md-12">
<?php if ((isset($frmdata['allTimeSlots'])) && (count($frmdata['allTimeSlots'])>0)) { 
          
    ?> 
                 
                  <div class="table-responsive"> 
                   <div style="padding-left: 200px;"><strong>Select Your Time Slot,<?php if(isset($frmdata['allTimeSlots'])){ print_r(substr($frmdata['allTimeSlots'][0]->time_slot_start,0, -8));  }   ?></strong></div>
                     <table class="table table-striped table-bordered table-hover" summary="">
                        <thead >
                           <tr>
                              <th>Session No.</th>
                              <th>Start Time</th>
                              <th>End Time </th>
                              <th>Resource Name </th>
                              <th colspan="10" align="center">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                           $i=0;
                           foreach ($frmdata['allTimeSlots'] as $key => $value){ 
                              //echo "<pre>";print_r($value);die; 
                    
                            //$i=0;
                           //echo "<pre>";print_r($all);die;  
                           ?>
                        
                           <tr>
                              <td><?php echo ++$i;?></td>
                              <td><?php  echo date('h :i A',$value->timestampstart);  ?></td>
                              <td><?php  echo date('h :i A',$value->timestampend);                              
                              ?> &nbsp;&nbsp;&nbsp;
                              <?php  if($value->lunchflage=='1'){ echo "(Lunch Time)";}   ?>
                            </td>
                            <td><?php  echo (isset($value->name) && !empty($value->name)) ? $value->name:'';  ?></td>
                               <!--<td><a type="button" value="view_details" title="Assing User" class="travel-pop" href="<?php //echo site_url('admin/delivery/assingresource/'.$value->order_id.'/'.$value->id);?>">
                               <i class="fa fa-user"></i></a></td>-->
                             <td> 
                              <a type="button" value="view_details" title="Delete" href="<?php echo site_url('admin/delivery/deletetimeslot/'.$value->id."/".$frmdata['order_id']."/".$frmdata['diagnose_id']."/".$frmdata['selectedResource']);?>" onclick="return confirm('Are you sure to delete this time slot?')">
                             <i class="fa fa-trash-o"></i></a></td>                        
                           </tr>
                           <?php  }?>
                        </tbody>
                     </table>
                  </div>
    
    <div class="col-md-12">
        <div class="col-md-6"><a href="<?php echo site_url('admin/delivery/showCallerList/'.$frmdata['order_id']."/".$frmdata['diagnose_id']) ?>" class="travel-pop btn btn-primary mb10">See List of Callers</a></div> 
        <div class="col-md-6"><a href="<?php echo site_url('admin/delivery/sendtimeslottoallcallers/'.$frmdata['order_id']."/".$frmdata['diagnose_id']."/".$frmdata['selectedResource']); ?>" onclick="return confirm('Are you sure for send email?')" class="btn btn-primary mb10">Send Time Slot as Mail to all Callers</a></div> 
    </div>
    
                  <?php }else{?>
                  <div class="page-head-line"></div>
                  <div class="notfound_text">Select</div>
                  <div class="norecordfound">No Record Available</div>
                     <?php } ?>
</div>

<script>
    var diagids="<?php echo $frmdata['diagnose_id'];  ?>";
    function  changeCalender()
    {
        var managerId  = jQuery('#manager').val();
        var orderid = '<?php echo $frmdata["order_id"]?>';
        //var delivery_id = '<?php echo $frmdata["diagnose_id"]?>';
        var url= ADMINURL+'/delivery/timeslot/'+orderid+"/"+diagids+"/"+managerId;
        //if(managerId>0)
        
        jQuery('#submittimeslot').click(); 
        
    }
</script>