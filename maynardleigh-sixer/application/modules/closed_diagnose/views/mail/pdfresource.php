<?php //echo "<pre>";print_r($allmode);die; ?>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Maynard</title>
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
                    
<table style="border-collapse: collapse; width: 100%;border: 1px solid #000;font-family: Helvetica;"> <tr>
        <th style="border: 1px solid #000; padding: 5px;font-size: 14px;">Consultant Name</th>
    <th style="border: 1px solid #000; padding: 5px;font-size: 14px;" colspan="2"><?php echo isset($userDetails[0]->name) ? $userDetails[0]->name : 'N/A'; ?></th>
    <th style="border: 1px solid #000;padding: 5px;font-size: 14px;">Workshop Dates:</th>   	
    <th style="border: 1px solid #000; padding: 5px;font-size: 14px;"><?php echo isset($diagnose_detail->start_date) ? date('jS F, Y', strtotime($diagnose_detail->start_date)) : ''; ?>
                            <?php if ($diagnose_detail->start_date != $diagnose_detail->end_date) { ?>
                                <?php echo "-" . date('jS F, Y', strtotime($diagnose_detail->end_date));
                            } ?></th> </tr>
  <tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;">Client Name</td>
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;" colspan="2"><strong><?php echo isset($order_detail->client_name) ? $order_detail->client_name : ''; ?></strong></td>
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;">Workshop Name </td> 
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;"><?php echo $order_detail->subproductname."/".$order_detail->proname; ?></td>
  </tr>
  
  <tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;">Order ID.</td>
    <td style="border: 1px solid #000; padding: 5px;font-size: 14px;" colspan="2"><?php echo $order_detail->order_Id; ?></td>
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;"></td>
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;"></td>
  </tr>
  
  <?php if((isset($allmode[0]->mode) && ($allmode[0]->mode=='air')) || (isset($allmode[0]->mode) && ($allmode[0]->mode=='cab')) || (isset($allmode[0]->mode) && ($allmode[0]->mode=='train'))){ ?>
  <tr style="border: 1px solid #000; padding: 5px">
      <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;"><strong>Mode</strong></td>
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;"><strong>Date</strong></td>
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;"><strong>From</strong></td>
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;"><strong>To</strong></td>
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;"><strong>Time / Details</strong></td>
</tr>
<?php } ?>

<?php
if(isset($allmode[0]->mode) && ($allmode[0]->mode=='air')){
foreach ($allmode as $airinfo) {
    
    ?>


<tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px"><?php echo !empty($airinfo->air) ? $airinfo->air : $airinfo->air; ?>(Air)</td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo date('jS F, Y', strtotime($airinfo->journey_date)); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo ucfirst($airinfo->journey_from); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo ucfirst($airinfo->journey_destination); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo strtoupper($airinfo->clause) . " " . $airinfo->dept_time; ?><br><strong><?php echo $airinfo->description; ?></strong></td>
</tr>
<?php  if(!empty($airinfo->return_date)){ ?>
<tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px"><?php echo! empty($airinfo->air) ? $airinfo->air : $airinfo->air; ?>(Air) </td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo date('jS F, Y', strtotime($airinfo->return_date)); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo ucfirst($airinfo->journey_destination); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo ucfirst($airinfo->journey_from); ?></td> 
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo strtoupper($airinfo->return_claus) . " " . $airinfo->return_time; ?></td> 
</tr>
<?php }
}
}
?>



<?php
if(isset($allmode[0]->mode) && ($allmode[0]->mode=='train')){
foreach($allmode as $traininfo) {
    ?>


<tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px"><?php echo !empty($traininfo->preferred_train) ? $traininfo->preferred_train : $traininfo->preferred_train; ?>(Train)</td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo date('jS F, Y', strtotime($traininfo->journey_date)); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo ucfirst($traininfo->journey_from); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo ucfirst($traininfo->journey_destination); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo strtoupper($traininfo->clause) . " " . $traininfo->dept_time; ?></strong></td>
</tr>
<?php  if(!empty($traininfo->return_date)){ ?>
<tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px"><?php echo!empty($traininfo->preferred_train) ? $traininfo->preferred_train : $traininfo->preferred_train; ?>(Train) </td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo date('jS F, Y', strtotime($traininfo->return_date)); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo ucfirst($traininfo->journey_destination); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo ucfirst($traininfo->journey_from); ?></td> 
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px"><?php echo strtoupper($traininfo->return_claus) . " " . $traininfo->return_time; ?></td> 
</tr>
<?php }
}
}
?>

<?php 
                $i=0;
                //echo "<pre>";print_r($allmode[0]);die;
                //$allmode[0]['cab'] = (array)$allmode[0]['cab'];
               //$all=count($allmode[0]['cab']);
               if(isset($allmode[0]->cab)){
               foreach ($allmode[0]->cab as $cabinfo) {?>

<tr style="border: 1px solid #000; padding: 5px">
    <?php //if($i==0){ ?>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;" rowspan="<?php echo $all ?>">Cab</td> 
    <?php //} ?>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><?php echo date('jS F', strtotime($cabinfo->journey_date)); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><?php echo ucfirst($cabinfo->journey_from); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><?php echo ucfirst($cabinfo->journey_destination); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><?php echo strtoupper($cabinfo->dept_time); ?></td>     
</tr>
               <?php 
               $i++;
    }
}
    ?>


<!--<tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;" colspan="2"></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;">&nbsp;</td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;">&nbsp;</td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;">Meals in the Air: <?php echo (isset($allmode['air'][0]->food) and !empty($allmode['air'][0]->food)) ? strtoupper($allmode['air'][0]->food):'N/A'; ?></td>     
</tr>-->

 <?php //if(isset($allmode['Hotel'])){
    //echo "<pre>1234";print_r($allmode);die;
     if(isset($allmode[0]->mode) && ($allmode[0]->mode=='Hotel')){
         //echo "<pre>";print_r($allmode);die;
         //$allmode = $allmode[0];
     ?>

<tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;"><strong>Preferred Hotel </strong></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><strong>Check IN </strong></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><strong>Check OUT</strong></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><strong>Room Type</strong></td>     
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><strong>City</strong></td>     
</tr>

<tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><?php echo !empty($allmode['Hotel'][0]->preferred_hotel) ? $allmode[0]->preferred_hotel:$allmode[0]->preferred_hotel; ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><?php echo date('jS F', strtotime($allmode[0]->checkin_date)); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><?php echo date('jS F', strtotime($allmode[0]->checkout_date)); ?></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><?php echo empty($allmode[0]->room_preference)?"N/A":$allmode[0]->room_preference; ?></td>     
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><strong><?php echo $allmode[0]->city; ?></strong><br></td> 
</tr>
 <?php } ?>


<tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><b>Resource Email</b></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><b><?php echo isset($userDetails[0]->email) ? $userDetails[0]->email : ''; ?></b></td>
    
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><b>Mobile</b></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><b><?php echo isset($userDetails[0]->contact_no) ? $userDetails[0]->contact_no : ''; ?></b></td>
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;">Meals Remarks: <?php echo (isset($allmode[0]->diet_remark) and !empty($allmode[0]->diet_remark)) ? strtoupper($allmode[0]->diet_remark):'N/A'; ?>
    <?php if($allmode[0]->breakfast==1) echo " (Included Breakfast)"; ?>
    <?php if($allmode[0]->meals==1) echo " (Included Meals)"; ?>
    </td>     
</tr>

</table>
 
<!-- Membership details -->
<?php if(isset($userDetails) && (count($userDetails)>0)){
    $k=1;
    ?>
<br>
<table>
<tr style="border: 0; padding: 5px">
    <td><strong>Sl. No</strong></td>
    <td><strong>Membership Name</strong></td>
    <td><strong>Description</td>
        
</tr>
<?php foreach($userDetails as $memberdetails){ ?>
<tr >
    <td ><?php echo $k; ?>.</td>
    <td><?php echo !empty($memberdetails->membershipname) ? $memberdetails->membershipname:''; ?></td>
    <td><?php echo !empty($memberdetails->detail) ? $memberdetails->detail:''; ?></td>
    
</tr>
 <?php 
 $k++;
 }//foreach close
 ?>

</table>
<?php
}//if close ?>
                    
                    
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

</body>

</html>


