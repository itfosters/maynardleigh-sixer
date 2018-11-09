<?php //echo "<pre>";print_r($view);die;
$statusarr = array("0"=>'Awaiting',"1"=>'Accepted',"2"=>'Rejected');
?>
<!DOCTYPE html>
<html>
<body>

<table border='1px' style="width:100%">

  <tr>
    <th>Client Name</th>
    <th>Job</th>
    <th>Subproducts</th>
    <th>Location</th>
    <th>Start Date</th>
<!--    <th>Start time</th>-->
    <th>End Date</th>
<!--    <th>End time</th>-->
    <th>Client Name</th>
    <th>Status</th>
  </tr>

<?php 
//echo "<pre>";print_r($view);die;
foreach($view as $value){?>
  <tr>
    <td><?php echo $value->clientname;?></td>
    <td><?php echo $value->moreinfo['name'];?></td>
    <td><?php echo $value->moreinfo['subname'];?></td>
    <td><?php echo $value->moreinfo['location'];?></td>
    <td><?php echo $value->start_date;?></td>
<!--    <td><?php echo $value->start_time;?></td>-->
    <td><?php echo $value->end_date;?></td>
    <td><?php echo "Waiting";?></td>
    <td><?php echo $statusarr[$value->status];?></td>
  </tr>
  <?php }?>
  
</table>

</body>
</html>