<?php //echo "<pre>";print_r($itfdata);die;
$status = array(0=>'Awaiting..',1=>'Accepted',2=>'Rejected');
?>
<!DOCTYPE html>
<html>
<body>
<?php if(count($itfdata['view'])>0){?>
<table border='1px' style="width:100%">

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
    <th>Get Link</th>
  </tr>

<?php

foreach($itfdata['view'] as $value){
    //echo "<pre>";print_r($value);die;
    ?>
  <tr>
    <td><?php echo $value->clientname;?></td>
    <td><?php echo $value->moreinfo['name'];?></td>
    <td><?php echo $value->moreinfo['subname'];?></td>
    <td><?php echo $value->moreinfo['location'];?></td>
    <td><?php echo date("jS M, Y", strtotime($value->start_date));?></td>
    <td><?php echo $value->start_time;?></td>
    <td><?php echo date("jS M, Y", strtotime($value->end_date));?></td>
    <td><?php echo $value->end_time;?></td>
    <td><?php echo $status[$value->status];?></td>
    <td><a type="button" class="" value="view_details" title="Get URL" href="<?php echo site_url('welcome/generateurl/'.$value->id);?>">
                             &#128077;</a></td>
  </tr>
  <?php }?>
  
</table>
<?php }else{  echo "Order not found";}?>


</body>
</html>