<?php //echo "<pre>";print_r($itfdata);die;
$status = array(0=>'Awaiting..',1=>'Accepted',2=>'Rejected');
?>
<?php if(count($itfdata['view'])>0){?>
<table class="table table-striped table-bordered table-hover">

  <tr>
    <th>Client Name</th>
    <th>Products</th>
    <th>Sub Products</th>
    <th>Location</th>
    <th>Start Date</th>
    <th>Start time</th>
    <th>End Date</th>
    <th>End time</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

<?php

foreach($itfdata['view'] as $value){
    ?>
  <tr>
    <td><?php echo $value->clientname;?></td>
    <td><?php echo isset($value->moreinfo['name']) ? $value->moreinfo['name']:'N/A';?></td>
    <td><?php echo isset($value->moreinfo['subname']) ? $value->moreinfo['subname']:'N/A';?></td>
    <td><?php echo isset($value->moreinfo['location'])?$value->moreinfo['location']:'';?></td>
    <td><?php echo date("jS M, Y", strtotime($value->start_date));?></td>
    <td><?php echo $value->start_time;?></td>
    <td><?php echo date("jS M, Y", strtotime($value->end_date));?></td>
    <td><?php echo $value->end_time;?></td>
    <td><?php echo (isset($value->moreinfo['subname'])) ? $status[$value->status]: "Deleted" ;?></td>
    <td>
        <?php if(isset($value->moreinfo['subname']) && ($status[$value->status]!=='Rejected')){ ?>
<!--        <a type="button" class="" value="view_details" title="Get URL" href="<?php echo site_url('welcome/generateurl/'.$value->id);?>">
                             &#128077;</a>-->
        
        
        
        <a type="button" class="" value="view_details"  title="Get URL" 
               href="<?php echo site_url('welcome/generateurl/'.$value->id);?>">
              <i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
        
        
        <a type="button" class="" value="view_details"  title="Submit Leadership Report" 
               href="<?php echo site_url('order/resouces_form/'.$value->id."/".$value->diagnose_id."/".$value->order_type);?>">
              <i class="fa fa-book" aria-hidden="true"></i></a>
        
        <?php } ?>
    </td>
  </tr>
  <?php } //die;?>
  
</table>
<?php }else{  echo "Order not found";}?>
