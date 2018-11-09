<?php
//echo"<pre>pdf";print_r($userDetails);die; 
//echo $userDetails[0]->id;die;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Maynard</title>
        <style>
            body{ font-family:Verdana, Geneva, sans-serif;}
            th,td,tr {
                border:1px solid black;
                border-collapse:collapse;
            }

            table {
                border:2px solid black;
                border-collapse:collapse;
            }

            td {
                font-family:Arial;
                font-size:11px;
            }
        </style>

    </head>

    <body style="background:#FFFFFF; margin:0px auto; padding:0px; font-family:Arial, Helvetica, sans-serif;">

        <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#FFFFFF;box-shadow: 1px 5px 27px -4px #a7a7a7;min-width:332px;max-width:600px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px;">

            <tr>
                <td>
                    <table border="2" cellpadding="20" cellspacing="0" width="100%" height="600px" align="center" style="background-color:#fff; font-family:Arial, Helvetica, sans-serif; text-align:center;" >
                        <tbody>

                            <!-- img logo art -->
                            <tr>
                                <td  colspan="4" style="border: none!important">
                                    <img width="100px" height="100px" style="" src="<?php echo base_url() . '/assests/img/default.jpg'; ?>" />

                                </td>
                                <td colspan="24" style="border: none!important;font-size: 25px;">Travel Request Form</td>
                            </tr>
                            <!-- img logo art -->

                            <tr>
                                <th>Consultant Name</th> 
                                <td><?php echo isset($userDetails[0]->name) ? $userDetails[0]->name : 'N/A'; ?></td> 
                                <th colspan="2">Workshop - <?php echo isset($diagnose_detail->no_ofdays) ? $diagnose_detail->no_ofdays : ''; ?> day(s):</th> 
                                <td> <?php echo isset($diagnose_detail->start_date) ? $diagnose_detail->start_date : ''; ?>
                                <?php if($diagnose_detail->start_date != $diagnose_detail->end_date){ ?>
                                <?php echo "-".$diagnose_detail->end_date; } ?>
                                </td>

                            </tr>

                            <tr>
                                <th>Client Name & order Id:</th> 
                                <td colspan="4"><?php echo isset($order_detail->client_name) ? $order_detail->client_name." (".$order_detail->order_Id.")" : ''; ?> </td> 

                            </tr>


                            
                            <?php 
                            
                            foreach ($allmode as $key => $resources) { ?>
                            <tr>
                                <th colspan="5"><?php echo strtoupper($resources->mode)." INFORMATION"; ?></th> 
                            </tr>
                            
                            <?php 
                            $hideinforamtion = array('id','order_id','diagnose_id','user_id','mode','entry_date','status','preferred','order_type');
                            ?>
                            <?php 
                            //echo "<pre>1234";print_r($resources);die;
                            //foreach($resources as $basicdetail){
                                
                                ?>
                                    
                                        <?php foreach($resources as $infokey=>$innerPart){
                                            if(!empty($innerPart) && (!in_array($infokey, $hideinforamtion))){
                                                ?>
                                                <tr>
                                                <td colspan="2"><?php echo ucwords(str_replace("_", " ", $infokey)," "); ?></td>
                                                <td colspan="3"><?php echo strtoupper($innerPart); ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        <?php } ?>
                                        
                                        
                                    
                                <?php //} ?>
                            
                            
                             
                            
                            <?php } ?>
                                                
                           <?php if(isset($userDetails) && (count($userDetails)>0)){
    $k=1;
    ?>

<tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px; height: 50px;font-size: 14px;"><strong>Sl. No</strong></td>
    <td colspan="2" style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><strong>Membership Name</strong></td>
    <td colspan="2" style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><strong>Description</td>
        
</tr>
<?php foreach($userDetails as $memberdetails){ ?>
<tr style="border: 1px solid #000; padding: 5px">
    <td style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><?php echo $k; ?>.</td>
    <td colspan="2" style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><?php echo !empty($memberdetails->membershipname) ? $memberdetails->membershipname:''; ?></td>
    <td colspan="2" style="border: 1px solid #000; padding: 5px;height: 50px;font-size: 14px;"><?php echo !empty($memberdetails->detail) ? $memberdetails->detail:''; ?></td>
    
</tr>
 <?php 
 $k++;
 }//foreach close
}//if close ?>                     
                                                
                                                
                                                
                            
                            <tr>
                                <td colspan="24">
                                    <p>Thanks and Regards<br>
                                        Maynardleigh Team<br>
                                    </p>
                                </td>
                            </tr>

                            <tr>	
                                <td colspan="24" height="20"  align="center" valign="middle" style="background:#077d9f;box-shadow: 1px 5px 27px -4px #a7a7a7;"><a href="#" target="_blank" style="text-decoration:none;"><strong style="color:#fff;">Maynardleigh Associates</strong></a></td>
                            </tr>
                        </tbody>

                    </table>
                </td>
            </tr>
        </table>

    </body>

</html>