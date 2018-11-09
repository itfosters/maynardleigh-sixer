<?php
//echo "###<pre>";print_r($frmdata);die;
/* $selectedProductForDiagnose = array();
  foreach($frmdata['diagonoesdetail'] as $key =>$diagnose) {
  $selectedProductForDiagnose[] = $diagnose->products;
  } */
//echo "<pre>";print_r($selectedProductForDiagnose);die;

$cancellationClouseArray = array();
$cancellationClouseArray[0] = array(
    'Nothing Selected'
);
$cancellationClouseArray[1] = array(
    '50% of the professional fee – 15 to 3 working days of the confirmed date of delivery.',
    '100% of professional fee – 2 to 0 working days of the confirmed date of delivery.'
);
$cancellationClouseArray[2] = array(
    '50% of the professional fee – 20 to 3 working days of the confirmed date of delivery.',
    '100% of professional fee – 2 to 0 working days of the confirmed date of delivery.'
);
$cancellationClouseArray[3] = array(
    '50% of the professional fee – 24 to 4 hrs of the confirmed date and time of call.',
    '100% of professional fee – 4 to 0 hrs of the confirmed date and time of call.'
);

function moneyFormatIndia($num) {
    $explrestunits = "";
    if (strlen($num) > 3) {
        $lastthree = substr($num, strlen($num) - 3, strlen($num));
        $restunits = substr($num, 0, strlen($num) - 3); // extracts the last three digits
        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for ($i = 0; $i < sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if ($i == 0) {
                $explrestunits .= (int) $expunit[$i] . ","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i] . ",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}
?>
<table style="background-color:#ffffff; margin:0 auto;" width="75%" border="0" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="padding:0px 0px 15px 20px;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td height="50" valign="bottom" align="left">
                                <a target="#" title="Visit Pinterest">
                                    <img src="<?php echo IMG_URL . 'default.jpg'; ?>" />
                                </a>

                            </td>
                            <td width="450" align="center" style="padding: 10px;"><strong><p style="font-size: 16px; margin: 0; text-decoration: underline;">Contract for 
                                        "<?php
$totalpax = 0;
$totaldays = 0;
$totalunits = 0;
foreach ($frmdata['diagonoesdetail'] as $key => $diagnose) { //echo $diagnose->product .' ( '. $diagnose->name; echo ')'; 
    $totalpax += $diagnose->pax;
    $totaldays += $diagnose->no_ofdays;
    $totalunits += $diagnose->units;
}
?> 
                                        <?php
                                        foreach ($frmdata['getdesigndetail'] as $key => $design) { //echo $design->product .' ( '. $design->name; echo ')'; 
                                            $totalpax += $design->pax;
                                            $totaldays += $diagnose->no_ofdays;
                                            $totalunits += $diagnose->units;
                                        }
                                        ?> 
                                        <?php
                                        foreach ($frmdata['getdeliverydetail'] as $key => $delivery) { //echo $delivery->product .' ( '. $delivery->name; echo ')'; 
                                            $totalpax += $delivery->pax;
                                            $totaldays += $delivery->no_ofdays;
                                            $totalunits += $delivery->units;
                                        }
                                        ?> 
                                        <?php
                                        foreach ($frmdata['getdiscoveryDetail'] as $key => $discovery) { //echo $discovery->product .' ( '. $discovery->name; echo ')'; 
                                            $totalpax += $discovery->pax;
                                            $totaldays += $discovery->no_ofdays;
                                            $totalunits += $discovery->units;
                                        }
                                        ?> 
                                        <?php echo $frmdata['detail']->client_name ?>"</p>

                                    <p style="font-size: 16px; margin: 0;  text-decoration: underline;">Contract No - CO/LSHPL/<?php echo date('Y'); ?>/<?php echo $frmdata['detail']->order_Id; ?></p></strong>
                            </td>

                            <td align="left" width="100px" valign="bottom"></td>


                            <td align="right" width="400px" valign="bottom" >
                                <a target="#" title="Visit Pinterest">
                                    <img style="margin-bottom: 40px; height: 160px;" src="<?php echo IMG_URL . 'may.png'; ?>">
                                </a>


                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table cellspacing="0" cellpadding="0" border="0" width="75%" style="margin:0 auto">
    <tbody>
        <tr>
            <td valign="bottom" width="100%" align="left">
            <!--<p>This Contract, effective as of <span style="background-color:yellow;"><?php echo date('jS F, Y', strtotime($frmdata['detail']->entry_Time)); ?></span> is by and between Life Strategies Humancare Private Limited, a Private Limited Company, Incorporated under the Companies act 1956 having a place of business at 26A, Chelmsford Country Club, Mehrauli Gurgaon Road, Ghitorni, New Delhi - 110030, and <?php echo $frmdata['detail']->client_name; ?> , having a place of business at <?php echo $frmdata['detail']->street ?>&nbsp;<?php echo $frmdata['detail']->state ?>&nbsp;<?php echo $frmdata['detail']->city ?>&nbsp;<?php echo $frmdata['detail']->alocation ?>&nbsp;<?php echo $frmdata['detail']->pincode ?>
               
             </p>-->
                <?php //echo "<pre>";print_r($frmdata['detail']);die; ?>
                <p>This Contract, effective as of <span style="background-color:yellow;"><?php echo date('jS F, Y', strtotime($frmdata['detail']->entry_Time)); ?></span> is by and between Life Strategies Humancare Private Limited, a Private Limited Company, Incorporated under the Companies act 1956 having a place of business at 26A, Chelmsford Country Club, Mehrauli Gurgaon Road, Ghitorni, New Delhi - 110030(hereinafter "Service Provider"), and <?php echo $frmdata['detail']->client_name; ?> , having a place of business at <?php echo $frmdata['detail']->street ?>,&nbsp;<?php echo $frmdata['detail']->alocation ?>,&nbsp;<?php echo $frmdata['detail']->city ?>,&nbsp;<?php echo $frmdata['detail']->state ?>&nbsp;<?php echo $frmdata['detail']->pincode ?> (Hereinafter "Client").



                    <strong><p style="font-size: 16px; margin: 0; text-decoration: underline;">Scope of the Contract:</p></strong>


<!--<p>1. No. of participants – Up to <?php echo $totalpax; ?> participants per workshop.</p>-->
<!--<p>2. No of days – <?php echo $totaldays; ?> days</p>-->
<!--                <p>1. No of days – <?php echo $totalunits; ?> days</p>-->
                <table style="width:100%;  border: 1px solid black; border-collapse: collapse;">
                    <tr>
                        <td style=" border: 1px solid black; height: 45px; "></td>
                        <td style=" border: 1px solid black;  text-align: center; ">Particulars</td>		
                        <td style=" border: 1px solid black;  text-align: center;">Dates</td>
                        <td style=" border: 1px solid black;  text-align: center;">Participants</td>
                        <td style=" border: 1px solid black; text-align: center; ">Units</td>		
                        <td style=" border: 1px solid black;  text-align: center;">Rates</td>
                        <td style=" border: 1px solid black;  text-align: center;">Total</td>
                    </tr>
<?php
$counter = 1;
$sumoftotal = 0;
$sumtotal_O = 0;
$sumtotal_Te = 0;
$sumtotal_T = 0;

if (isset($frmdata['get_diagnose']) and ( count($frmdata['get_diagnose']) > 0)) {
    ?>
                        <tr>

                            <td style=" border: 1px solid black; height: 45px; padding:10px 0px 10px 10px;" valign="top">Diagnose</td>
                            <td style=" border: 1px solid black;  padding:10px 0px 10px 10px;"valign="top" >
                                <table width="100%">
    <?php
    if (isset($frmdata['get_diagnose']) and ( count($frmdata['get_diagnose']) > 0)) {
        foreach ($frmdata['get_diagnose'] as $key => $diagnose_product) {
            //echo "!<pre>";print_r($diagnose_product);
            //if(in_array($diagnose_product->id, $selectedProductForDiagnose)){
            //echo "@@<pre>";print_r($selectedProductForDiagnose);die;
            ?>
                                            <tr>
                                                <td>
                                            <?php echo $counter . '. ' . $diagnose_product->name . '(' . $diagnose_product->subpro . ')'; ?>
                                                </td>
                                            </tr>
                                                    <?php
                                                    $counter++;
                                                    //}
                                                }
                                            }
                                            ?>
                                </table>

                            </td>		
                            <td style=" border: 1px solid black; padding:10px 0px 10px 10px; text-align: center;" >
                                <table width="100%">
    <?php
    $counter = 1;
    if (isset($frmdata['diagonoesdetail']) and ( count($frmdata['diagonoesdetail']) > 0)) {
        foreach ($frmdata['diagonoesdetail'] as $key => $diagnose) {
            ?>
                                            <tr>
                                                <td>
                                            <?php
                                            $start = date('d-m-Y', strtotime($diagnose->start_date));
                                            $end = date('d-m-Y', strtotime($diagnose->end_date));
                                            
                                            
                                            
                                            
                                            if ($start == $end) {
                                            if ($diagnose->notconfirmed == 1)
                                            echo date('F, Y', strtotime($start));
                                            else
                                            echo date('F, Y', strtotime($start));
                                            }else {
                                            if ($diagnose->notconfirmed == 1)
                                            echo date('F, Y', strtotime($start));
                                            else
                                            echo date('jS F, Y', strtotime($start)) . ' - ' . date('jS F, Y', strtotime($end));
                                            }
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
//                                            if ($start == $end) {
//                                                echo date('jS F, Y', strtotime($start));
//                                            } else {
//                                                echo date('jS F, Y', strtotime($start)) . ' - ' . date('jS F, Y', strtotime($end));
//                                            }
                                            ?>
                                                </td>
                                            </tr>
                                                    <?php
                                                    $counter++;
                                                }
                                            } else {
                                                echo"N/A";
                                            }
                                            ?>
                                </table>
                            </td>
                            <td style=" border: 1px solid black; text-align: center;">
                                <table width="100%">

    <?php
    if (isset($frmdata['diagonoesdetail']) and ( count($frmdata['diagonoesdetail']) > 0)) {
        foreach ($frmdata['diagonoesdetail'] as $key => $diagnose) {
            ?>
                                            <tr>
                                                <td>

                                            <?php echo $diagnose->pax; ?>  
                                                </td>
                                            </tr>
            <?php
        }
    } else {
        echo"N/A";
    }
    ?>
                                </table>
                            </td>	
                            <td style=" border: 1px solid black; text-align: center;">
                                <table width="100%">

                                    <?php
                                    if (isset($frmdata['diagonoesdetail']) and ( count($frmdata['diagonoesdetail']) > 0)) {
                                        foreach ($frmdata['diagonoesdetail'] as $key => $diagnose) {
                                            ?>
                                            <tr>
                                                <td>

                                            <?php echo $diagnose->units; ?>  
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo"N/A";
                                    }
                                    ?>
                                </table>
                            </td>		

                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    if (isset($frmdata['diagonoesdetail']) and ( count($frmdata['diagonoesdetail']) > 0)) {
                                        foreach ($frmdata['diagonoesdetail'] as $key => $diagnose) {
                                            ?>
                                            <tr>
                                                <td>

                                            <?php //echo $diagnose->price_unit*$diagnose->units; ?>  
                                            <?php
                                            echo moneyFormatIndia($diagnose->price_unit);
                                            //echo ;
                                            ?>  
                                                </td>
                                            </tr>
            <?php
        }
    } else {
        echo"N/A";
    }
    ?>
                                </table>
                            </td>
                            
                            
                            
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    if (isset($frmdata['diagonoesdetail']) and ( count($frmdata['diagonoesdetail']) > 0)) {
                                        foreach ($frmdata['diagonoesdetail'] as $key => $diagnose) {
                                            ?>
                                            <tr>
                                                <td>

                                            <?php echo moneyFormatIndia($diagnose->price_unit*$diagnose->units); ?>  
                                            <?php
                                            //echo moneyFormatIndia($diagnose->price_unit);
                                            //echo ;
                                            ?>  
                                                </td>
                                            </tr>
            <?php
        }
    } else {
        echo"N/A";
    }
    ?>
                                </table>
                            </td>
                            
                                    <?php
                                    $sumoftotal = 0;
                                    if (isset($frmdata['diagonoesdetail']) and ( count($frmdata['diagonoesdetail']) > 0)) {
                                        foreach ($frmdata['diagonoesdetail'] as $key => $diagnose) {
                                            $sumofdiagnose = $diagnose->price_unit * $diagnose->units;
                                            $sumoftotal = $sumoftotal + $sumofdiagnose;
                                        } 
                                    } 
                                    ?>
                        </tr>
                        <?php } ?>
                                <?php
                                if (count($frmdata['getdesigndetail']) > 0) {
                                    ?>
                        <tr>
                            <td style=" border: 1px solid black; height: 45px;padding:10px 0px 10px 10px; " valign="top">Design</td>
                            <td style=" border: 1px solid black;padding:10px 0px 10px 10px; ">
                                <table width="100%">
                                    <?php
                                    $counter = 1;
                                    if (isset($frmdata['get_design']) and ( count($frmdata['get_design']) > 0)) {
                                        foreach ($frmdata['get_design'] as $key => $diagnose_product) {
                                            ?>
                                            <tr>
                                                <td>
                                                <?php echo $counter . '. ' . $diagnose_product->name . '(' . $diagnose_product->subpro . ')'; ?>
                                                </td>
                                            </tr>
                                        <?php
                                        $counter++;
                                    }
                                } else {
                                    echo"N/A";
                                }
                                ?>
                                </table>

                            </td>		
                            <td style=" border: 1px solid black; padding:10px 0px 10px 10px;  text-align: center;">
                                <table width="100%">

                                    <?php
                                    $counter = 1;
                                    if (isset($frmdata['getdesigndetail']) and ( count($frmdata['getdesigndetail']) > 0)) {
                                        foreach ($frmdata['getdesigndetail'] as $key => $design) {
                                            ?>
                                            <tr>
                                                <td>
                                            <?php
                                            $start = date('d-m-Y', strtotime($design->start_date));
                                            $end = date('d-m-Y', strtotime($design->end_date));
                                            
                                            
                                            
                                            if ($start == $end) {
                                            if ($design->notconfirmed == 1)
                                            echo date('F, Y', strtotime($start));
                                            else
                                            echo date('F, Y', strtotime($start));
                                            }else {
                                            if ($design->notconfirmed == 1)
                                            echo date('F, Y', strtotime($start));
                                            else
                                            echo date('jS F, Y', strtotime($start)) . ' - ' . date('jS F, Y', strtotime($end));
                                            }
                                            
                                            
                                            
                                            
                                            
//                                            if ($start == $end) {
//                                                echo date('jS F, Y', strtotime($start));
//                                            } else {
//                                                echo date('jS F, Y', strtotime($start)) . ' - ' . date('jS F, Y', strtotime($end));
//                                            }
                                            ?>
                                                </td>
                                            </tr>
            <?php
            $counter++;
        }
    } else {
        echo"N/A";
    }
    ?>
                                </table>
                            </td>
                            <td style=" border: 1px solid black ;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    if (isset($frmdata['getdesigndetail']) and ( count($frmdata['getdesigndetail']) > 0)) {
                                        foreach ($frmdata['getdesigndetail'] as $key => $design) {
                                            ?>
                                            <tr>
                                                <td>
                                            <?php echo $design->pax; ?>   
                                                </td>
                                            </tr>
            <?php
        }
    } else {
        echo"N/A";
    }
    ?>
                                </table>
                            </td>
                            <td style=" border: 1px solid black ;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    if (isset($frmdata['getdesigndetail']) and ( count($frmdata['getdesigndetail']) > 0)) {
                                        foreach ($frmdata['getdesigndetail'] as $key => $design) {
                                            ?>
                                            <tr>
                                                <td>
                                            <?php echo $design->units; ?>   
                                                </td>
                                            </tr>
            <?php
        }
    } else {
        echo"N/A";
    }
    ?>
                                </table>
                            </td>
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    //$counter=1;
                                    if (isset($frmdata['getdesigndetail']) and ( count($frmdata['getdesigndetail']) > 0)) {
                                        foreach ($frmdata['getdesigndetail'] as $key => $design) {
                                            ?>
                                            <tr>
                                                <td>
            <?php //echo $design->price_unit*$design->units; ?>  
            <?php echo moneyFormatIndia($design->price_unit); ?>  
                                                </td>
                                            </tr>
                                            <?php
                                            $counter++;
                                        }
                                    } else {
                                        echo"N/A";
                                    }
                                    ?>
                                </table>
                            </td>
                            
                            
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    //$counter=1;
                                    if (isset($frmdata['getdesigndetail']) and ( count($frmdata['getdesigndetail']) > 0)) {
                                        foreach ($frmdata['getdesigndetail'] as $key => $design) {
                                            ?>
                                            <tr>
                                                <td>
            <?php echo moneyFormatIndia($design->price_unit*$design->units); ?>  
            <?php //echo moneyFormatIndia($design->price_unit); ?>  
                                                </td>
                                            </tr>
                                            <?php
                                            $counter++;
                                        }
                                    } else {
                                        echo"N/A";
                                    }
                                    ?>
                                </table>
                            </td>
                            
                            
                            
                            
                            
                                    <?php
                                    $sumtotal_O = 0;
                                    if (isset($frmdata['getdesigndetail']) and ( count($frmdata['getdesigndetail']) > 0)) {
                                        foreach ($frmdata['getdesigndetail'] as $key => $design) {
                                            
            $sumtotaldesign = $design->price_unit * $design->units;
            $sumtotal_O = $sumtotal_O + $sumtotaldesign;
            
                                        }//echo moneyFormatIndia($sumtotal_O);
                                    } 
                                    ?>
                               
                        </tr>

                                <?php } ?>

                                <?php
                                if (count($frmdata['getdeliverydetail']) > 0) {
                                    ?>

                        <tr>
                            <td style=" border: 1px solid black; height: 45px; padding:10px 0px 10px 10px;" valign="top">Delivery</td>
                            <td style=" border: 1px solid black; padding:10px 0px 10px 10px;">
                                <table width="100%">
                        <?php
                        $counter = 1;
                        if (isset($frmdata['get_delivey']) and ( count($frmdata['get_delivey']) > 0)) {
                            foreach ($frmdata['get_delivey'] as $key => $diagnose_product) {
                                ?>
                                            <tr>
                                                <td>
            <?php echo $counter . '. ' . $diagnose_product->name . '(' . $diagnose_product->subpro . ')'; ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $counter++;
                                        }
                                    } else {
                                        echo"N/A";
                                    }
                                    ?>
                                </table>

                            </td>		
                            <td style=" border: 1px solid black;   text-align: center;">
                                <table width="100%">
                                    <?php
                                    $counter = 1;
                                    if (isset($frmdata['getdeliverydetail']) and ( count($frmdata['getdeliverydetail']) > 0)) {
                                        foreach ($frmdata['getdeliverydetail'] as $key => $delivey) {
                                            ?>
                                            <tr>
                                                <td><?php
                                $start = date('d-m-Y', strtotime($delivey->start_date));
                                $end = date('d-m-Y', strtotime($delivey->end_date));
                                if ($start == $end) {
                                    if ($delivey->notconfirmed == 1)
                                        echo date('F, Y', strtotime($start));
                                    else
                                        echo date('F, Y', strtotime($start));
                                }else {
                                    if ($delivey->notconfirmed == 1)
                                        echo date('F, Y', strtotime($start));
                                    else
                                        echo date('jS F, Y', strtotime($start)) . ' - ' . date('jS F, Y', strtotime($end));
                                }
                                            ?>

                                                </td>
                                            </tr>
                                                    <?php
                                                    $counter++;
                                                }
                                            }else {
                                                echo"N/A";
                                            }
                                            ?>
                                </table>
                            </td>
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    if (isset($frmdata['getdeliverydetail']) and ( count($frmdata['getdeliverydetail']) > 0)) {
                                        foreach ($frmdata['getdeliverydetail'] as $key => $delivey) {
                                            ?>
                                            <tr>
                                                <td>
            <?php echo $delivey->pax; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo"N/A";
                                    }
                                    ?>
                                </table>
                            </td>
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    if (isset($frmdata['getdeliverydetail']) and ( count($frmdata['getdeliverydetail']) > 0)) {
                                        foreach ($frmdata['getdeliverydetail'] as $key => $delivey) {
                                            ?>
                                            <tr>
                                                <td>
            <?php echo $delivey->units; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo"N/A";
                                    }
                                    ?>
                                </table>
                            </td>
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    //$counter=1; 
                                    if (isset($frmdata['getdeliverydetail']) and ( count($frmdata['getdeliverydetail']) > 0)) {
                                        foreach ($frmdata['getdeliverydetail'] as $key => $delivey) {
                                            ?>
                                            <tr>
                                                <td>
            <?php //echo $delivey->price_unit*$delivey->units; ?>
                                            <?php echo moneyFormatIndia($delivey->price_unit); ?>
                                                </td>
                                            </tr>
                                            <?php
                                            //$counter++;
                                        }
                                    } else {
                                        echo"N/A";
                                    }
                                    ?>
                                </table>
                            </td>
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    //$counter=1; 
                                    
                                    
                                    
                                     
                                    $sumtotal_Te = 0;
                                    if (isset($frmdata['getdeliverydetail']) and ( count($frmdata['getdeliverydetail']) > 0)) {
                                        foreach ($frmdata['getdeliverydetail'] as $key => $delivey) {
                                            $sumtotaldelivey = $delivey->price_unit * $delivey->units;
                                            $sumtotal_Te = $sumtotal_Te + $sumtotaldelivey;
                                            
                                    }//echo moneyFormatIndia($sumtotal_Te);
                                    } 
                                    
                                    
                                    
                                    if (isset($frmdata['getdeliverydetail']) and ( count($frmdata['getdeliverydetail']) > 0)) {
                                        foreach ($frmdata['getdeliverydetail'] as $key => $delivey) {
                                            ?>
                                            <tr>
                                                <td>
                                            <?php echo moneyFormatIndia($delivey->price_unit*$delivey->units); ?>
                                            <?php //echo moneyFormatIndia($delivey->price_unit); ?>
                                                </td>
                                            </tr>
                                            <?php
                                            //$counter++;
                                        }
                                    } else {
                                        echo"N/A";
                                    }
                                    ?>
                                </table>
                            </td>	
                            

                        </tr>
                                <?php } ?>
                                <?php
                                if (count($frmdata['getdiscoveryDetail']) > 0) {
                                    ?>
                        <tr>
                            <td style=" border: 1px solid black; height: 45px;padding:10px 0px 10px 10px;" valign="top">Discovery</td>
                            <td style=" border: 1px solid black;padding:10px 0px 10px 10px; ">
                                <table width="100%">
                        <?php
                        $counter = 1;
                        if (isset($frmdata['get_discovery']) and ( count($frmdata['get_discovery']) > 0)) {
                            foreach ($frmdata['get_discovery'] as $key => $diagnose_product) {
                                ?>
                                            <tr>
                                                <td>
                                            <?php echo $counter . '. ' . $diagnose_product->name . '(' . $diagnose_product->subpro . ')'; ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $counter++;
                                        }
                                    } else {
                                        echo"N/A";
                                    }
                                    ?>
                                </table>

                            </td>		
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    $counter = 1;
                                    if (isset($frmdata['getdiscoveryDetail']) and ( count($frmdata['getdiscoveryDetail']) > 0)) {
                                        foreach ($frmdata['getdiscoveryDetail'] as $key => $discovery) {
                                            ?>
                                            <tr>
                                                <td>
            <?php
            $start = date('d-m-Y', strtotime($discovery->start_date));
            $end = date('d-m-Y', strtotime($discovery->end_date));
            
        if ($start == $end) {
                if ($discovery->notconfirmed == 1)
                    echo date('F, Y', strtotime($start));
                else
                    echo date('F, Y', strtotime($start));
            }else {
                if ($discovery->notconfirmed == 1)
                    echo date('F, Y', strtotime($start));
                else
                    echo date('jS F, Y', strtotime($start)) . ' - ' . date('jS F, Y', strtotime($end));
            }
            
            
            
//            if ($start == $end) {
//                echo date('jS F, Y', strtotime($start));
//            } else {
//                echo date('jS F, Y', strtotime($start)) . ' - ' . date('jS F, Y', strtotime($end));
//            }
            ?>

                                                </td>
                                            </tr>
                                                    <?php
                                                    $counter++;
                                                }
                                            } else {
                                                echo"N/A";
                                            }
                                            ?>
                                </table>
                            </td>
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    if (isset($frmdata['getdiscoveryDetail']) and ( count($frmdata['getdiscoveryDetail']) > 0)) {
                                        foreach ($frmdata['getdiscoveryDetail'] as $key => $discovery) {
                                            ?>
                                            <tr>
                                                <td>
                                            <?php echo $discovery->pax; ?>
                                                </td>
                                            </tr>
            <?php
        }
    } else {
        echo"N/A";
    }
    ?>
                                </table>
                            </td>
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
                                    <?php
                                    if (isset($frmdata['getdiscoveryDetail']) and ( count($frmdata['getdiscoveryDetail']) > 0)) {
                                        foreach ($frmdata['getdiscoveryDetail'] as $key => $discovery) {
                                            ?>
                                            <tr>
                                                <td>
                                            <?php echo $discovery->units; ?>
                                                </td>
                                            </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo"N/A";
                                            }
                                            ?>
                                </table>
                            </td>
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
    <?php
    if (isset($frmdata['getdiscoveryDetail']) and ( count($frmdata['getdiscoveryDetail']) > 0)) {
        foreach ($frmdata['getdiscoveryDetail'] as $key => $discovery) {
            ?>
                                            <tr>
                                                <td>
                                            <?php //echo $discovery->price_unit*$discovery->units;?>
                                            <?php echo moneyFormatIndia($discovery->price_unit); ?>
                                                </td>
                                            </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo"N/A";
                                            }
                                            ?>
                                </table>
                            </td>
                            
                            
                            
                            
                            <td style=" border: 1px solid black;  text-align: center;">
                                <table width="100%">
    <?php
    if (isset($frmdata['getdiscoveryDetail']) and ( count($frmdata['getdiscoveryDetail']) > 0)) {
        foreach ($frmdata['getdiscoveryDetail'] as $key => $discovery) {
            ?>
                                            <tr>
                                                <td>
                                            <?php echo moneyFormatIndia($discovery->price_unit*$discovery->units);?>
                                            <?php //echo moneyFormatIndia($discovery->price_unit); ?>
                                                </td>
                                            </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo"N/A";
                                            }
                                            ?>
                                </table>
                            </td>
                            
                            
                            
                            
                            
                            
                            
                            
    <?php
    $sumtotal_T = 0;
    if (isset($frmdata['getdiscoveryDetail']) and ( count($frmdata['getdiscoveryDetail']) > 0)) {
        foreach ($frmdata['getdiscoveryDetail'] as $key => $discovery) {
            
                                            $sumtotaldiscovery = $discovery->price_unit * $discovery->units;
                                            $sumtotal_T = $sumtotal_T + $sumtotaldiscovery;
                                            
                                                }//echo moneyFormatIndia($sumtotal_T);
                                            } 
                                            ?>
                                
                        </tr>
<?php } ?>
                    <tr>
                        <td style=" border: 1px solid black; height: 45px;">Total Cost</td>
                        <td colspan="6"  style="height: 45px; text-align:right; padding:10px;">
<?php
$grand_total = $sumoftotal + $sumtotal_O + $sumtotal_Te + $sumtotal_T;
?>
                            <?php
                            echo moneyFormatIndia($grand_total);
                            ?>
                        </td>


                    </tr>

                </table>
        <tr>
            <td align="left">
                <strong><p style="font-size: 16px; margin: 0;">Incidental Costs:</p></strong>
                <ul>
                    <li>Relevant official communication expenses, if any.</li>
                    <li>Incidental expenses (travel) for the consultants to do pre-work and/or meetings at client site.</li>
                    <li>Travel for Delivery: For programs outside Delhi & NCR, Suitable Air Travel, accommodation, all meals and pick-up & drop-off facilities to be provided by client. Also, airport transfers in Delhi will be charged at Rs12per Km* actual kms if not provided by client. </li>
                    <li>For programs within Delhi NCR travel client will be charged at Rs 12 per Km* actual kms if not provided by client.</li>
                    <li>If any of the bookings related to workshop like Air travel, Accommodation, all meals & cab for the consultant & Venue for the workshop will be booked by Life Strategies Humancare Private Limited, then the same will be reimbursed by client on actuals without any TDS deduction.</li>
                    <li>Additional to the above cost, 15% of the total value of re-imbursement will be charged extra if the bookings are done by Life Strategies Humncare Private Limited as mentioned above.</li>
                    <li>Service tax @ 15% will be charged extra on the total cost including travel.</li>

                </ul>


                <strong><p style="font-size: 16px; margin: 0;">Payment Terms</p></strong>
                <ol>
                    <li>The payment will be payable within <b>"<?php echo $frmdata['detail']->termsconditions ?>"</b> of the program date.</li>
                    <li>In case of cancellation/rescheduling fees will be charged as follows –

                        <ol>
<?php
//echo "<pre>";print_r($cancellationClouseArray[$frmdata['detail']->cancellation_clouse]);die;

foreach ($cancellationClouseArray[$frmdata['detail']->cancellation_clouse] as $data) {
    ?>
                                <li><?php echo $data; ?></li>
                                <?php
                            }
                            ?>


                        </ol>
                    </li>
                    <li>Any one of the following methods may be considered as date confirmation:  email notification from Client

                        confirming delivery dates, a Purchase Order or a signed contract with specific dates.</li>
                        <!--<li>Payment Cycle <b>"<?php echo $frmdata['detail']->payment_cycle ?>"</b></li>
                        <li>Mode of Payment <b>"<?php echo $frmdata['detail']->mode_ofpayment ?>"</b></li>
                        <li>Payment Term & Condition<b>"<?php echo $frmdata['detail']->price_validity ?>"</b></li>-->
                    <li>The session cannot be recorded without a prior written consent from Maynardleigh Associates.</li>
                    <li> The above commercials are valid till the <?php echo $frmdata['detail']->price_validity ?>, after which there will be a 10% hike in the investment.</li>
                </ol>


                <strong><p style="font-size: 16px; margin: 0;">Other arrangements that Client will take care of:</p></strong>
                <ul>
                    <li>Hotel for consultants stay if workshop is outside Delhi NCR (minimum 4 star hotel)</li>
                    <li> Venue for the training programs (with a back-up generator) should have <b>natural lighting, enough space</b> to do exercise and <b>comfortable temperature</b> for the participants & consultant.</li>
                    <li>Conference facilities including meals.</li>
                    <li> Audio visual equipment – (LCD projector, flip chart board stand, 8*10 ft screen).</li>
<?php
$transportvalue = array('n' => 'N/A', 'c' => 'Client', 'm' => 'MLA');
$exid = $frmdata['detail']->tid;
$exvalue = $frmdata['detail']->tvalue;
$explodetransid = explode(',', $exid);
$explodetransvalue = explode(',', $exvalue);
$transidvalue = array_combine($explodetransid, $explodetransvalue);
?>
                    <?php foreach ($frmdata['transports'] as $key => $value) {
                        ?>
                        <li>The <?php echo $value ?> is on the <b><?php echo $transportvalue[$transidvalue[$key]]; ?></b> side</li>
                    <?php } ?>
                </ul>

                <strong><p style="font-size: 16px; margin: 0;">A Non-Disclosure Agreement for the scope of this contract is included as an annexure</p></strong><br>

                <strong><p style="font-size: 16px; margin: 0;">

                    </p></strong>
            </td>
        </tr>




    </tbody>



</table>

<table cellspacing="0" cellpadding="0" border="0" width="75%" style="margin:0 auto">

    <tbody>
        <tr>
            <td width="400" align="left" style="margin-top: 15px;">
                <strong><p style="font-size: 16px;">Life Strategies Humancare Pvt Ltd.
                    </p></strong>

                
                <table>
                    <tr>
                        <Td><strong>By</td><td>:</strong></td><td><strong> &nbsp;Steeve Gupta</strong></td>
                    </tr>
                    <tr>
                        <Td><strong>Name</td><td>:</strong></td><td><strong> &nbsp;Steeve Gupta</strong></td>
                    </tr>
                    <tr>
                        <Td><strong>Title</td><td>:</strong></td><td><strong> &nbsp;Director</strong></td>
                    </tr>
                    <tr>
                        <Td><strong>Witness</td><td>:</strong></td><td><strong>__________________________</strong></td>
                    </tr>
                </table>
                
                
            </td>
            <td width="400" align="left" style="margin-top: 15px;">
                <strong><p style="font-size: 16px;"><?php echo $frmdata['detail']->client_name ?>
                    </p>
                </strong>

                <table>
                    <tr>
                        <Td><strong>By</td><td>:</strong></td><td><strong> __________________________</strong></td>
                    </tr>
                    <tr>
                        <Td><strong>Name</td><td>:</strong></td><td><strong> __________________________</strong></td>
                    </tr>
                    <tr>
                        <Td><strong>Title</td><td>:</strong></td><td><strong> __________________________</strong></td>
                    </tr>
                    <tr>
                        <Td><strong>Witness</td><td>:</strong></td><td><strong>__________________________</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<?php if (isset($frmdata['detail']) && ($frmdata['detail']->nda_required) == 0) { ?>
    <!-- ranu second part started from here  -->

    <table style="background-color:#ffffff; margin:0 auto;" width="75%" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td style="padding:20px 0px 15px 0px; margin-top: 25px;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td height="50" valign="bottom" align="left">
                                    <a target="#" title="Visit Pinterest"><img src="<?php echo IMG_URL . 'default.jpg'; ?>"></a>

                                </td>
                                <td width="450" align="center" style="padding: 10px; position: relative;">
                                    <p style="font-size: 16px; margin: 0; position: absolute;top: 0; left: 55%;"></p>

                                </td>

                                <td align="left" width="100px" valign="bottom"></td>


                                <td align="right" width="400px" valign="bottom" >
                                    <a target="#" title="Visit Pinterest"><img style="margin-bottom: 40px; height: 160px;" src="<?php echo IMG_URL . 'may.png'; ?>" /></a>


                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- next part -->
    <table cellspacing="0" cellpadding="0" border="0" width="75%" style="margin:0 auto">
        <tbody>
            <tr>
                <td valign="bottom" width="100%">
                    <strong><p>Non-Disclosure agreement:</p></strong>


                    <strong><p style="font-size: 16px; margin: 0;"> <strong>WHEREAS,</strong> Client is willing to receive information from the service provider regarding the program, which information the Service Provider deems proprietary.</p></strong>

                    <p>NOW, THEREFORE, in consideration of the mutual covenants and conditions herein contained, the parties hereto 

                        agree as follows:</p>


                    <ul><li style="list-style: nomber; margin-top: 12px;">As used in this Agreement, the term Proprietary Information shall mean written, oral, documentary or

                            other information relating to the subject matter referenced above which is received by Client from the 

                            Service Provider. Proprietary Information includes notes, extracts, analyses or materials prepared by the 

                            Service Provider, which are copies of or derivative works of the Proprietary Information or from which the 

                            substance of the Proprietary Information can be inferred or otherwise understood. Information shall not 

                            be deemed Proprietary Information, and the Client shall have no obligation with respect to any such 

                            information, which the Client can prove by written records is approved for release by written authorization 

                            of the Service Provider.</li>
                        <li style="list-style: nomber; margin-top: 12px;">The Client shall not make any copies, in whole or in part, machine readable or otherwise, of the

                            Proprietary Information except for copies to be distributed to employees  

                            of the Client as part of the training seminar for which the Client is paying the Service Provider. This is on 

                            a need to know basis and on the basis that the Client has agreed to maintain the confidentiality of this 

                            Proprietary Information.</li>
                        <li style="list-style: nomber; margin-top: 12px;">Nothing contained in this Agreement shall be construed as: (i) requiring the Service Provider to disclose

                            to the Client any particular information; (ii) granting to the Client a license, either express or implied, 

                            under any patent, copyright, trade secret or other intellectual property right, now or hereafter owned, 

                            obtained or licensed by the Service Provider;</li>
                        <li style="list-style: nomber; margin-top: 12px;">The Client will not utilise any such Proprietary Information to develop products or produce articles for its 

                            own or another's use, or to develop products or produce articles sold or offered for sale or otherwise 

                            transferred or offered for transfer to anyone other than the Service Provider, without its written consent.</li>

                        <li style="list-style: nomber; margin-top: 12px;">This Agreement shall be interpreted and the rights of the parties determined under the laws of the

                            Republic of India and subject to the exclusive jurisdiction of the Courts of Delhi.</li>
                    </ul>
                    <p>This Agreement supersedes any prior oral or written understandings and constitutes the entire agreement 

                        between the parties with respect to its subject matter, and no modification, amendment or waiver thereof shall be 

                        effective unless in writing and signed by both parties.</p>
                    <p>Each person executing this Agreement warrants and represents that he or she has the authority to enter into this 

                        Agreement on behalf of the party whose name appears above their signature.</p>
                    <p>IN WITNESS WHEREOF, the duly authorized representatives of the parties hereto have executed this Agreement 

                        and caused it to be effective as of the date first written above.</p>


                </td>
            </tr>


        </tbody>



    </table>

    <table cellspacing="0" cellpadding="0" border="0" width="75%" style="margin:0 auto">

        <tbody>
            <tr>
                <td width="400" align="left" style="margin-top: 15px;">
                    <strong><p style="font-size: 16px;">Life Strategies Humancare Pvt Ltd.
                        </p></strong>

                    <strong>By:</strong>________________________________
                    <strong>Name:</strong>________________________________
                    <strong>Title:</strong>________________________________
                    <strong>Witness:</strong>________________________________
                </td>
                <td width="400" align="left" style="margin-top: 15px;">
                    <strong><p style="font-size: 16px;"><?php echo $frmdata['detail']->client_name ?>
                        </p>
                    </strong>

                    <strong>By:</strong>________________________________
                    <strong>Name:</strong>________________________________
                    <strong>Title:</strong>________________________________
                    <strong>Witness:</strong>________________________________
            </tr>
        </tbody>
    </table> 
<?php } ?>
<!-- ranu second part ended here  -->
<!-- Third part started from here  -->
<!-- kkkkkk -->
<table style="background-color:#ffffff; margin:0 auto;" width="75%" border="0" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="padding:20px 0px 15px 0px; margin-top: 25px;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td height="50" valign="bottom" align="left">
                                <a target="#" title="Visit Pinterest"><img src="<?php echo IMG_URL . 'default.jpg'; ?>"></a>

                            </td>
                            <td width="450" align="center" style="padding: 10px; position: relative;">
                                <p style="font-size: 16px; text-decoration: underline; margin: 0; position: absolute;bottom: 0; left: 55%;">Accounting Details</p>

                            </td>

                            <td align="left" width="100px" valign="bottom"></td>


                            <td align="right" width="400px" valign="bottom" >
                                <a target="#" title="Visit Pinterest"><img style="margin-bottom: 40px; height: 160px;" src="<?php echo IMG_URL . 'may.png'; ?>" /></a>


                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<!-- next part -->
<table cellspacing="0" cellpadding="0" border="0" width="75%" style="margin:0 auto">
    <tbody>
        <tr>
            <td valign="bottom" width="100%">
                <strong><p>Life Strategies Humancare Pvt. Ltd.</p></strong>




                <p>PAN No :  AABCL5885G</p>
                <p>Service Tax Code : AABCL5885GST001</p>
                <p>Cheque in favour of "Life Strategies Humancare Pvt. Ltd."</p>

                <p>Please deliver cheques and documents to the following address :</p>
                <p>Life Strategies Humancare Pvt. Ltd.</p>
                <p>26A, Chelmsford Country Club,</p>
                <p>MG Road, Ghitorni, New Delhi 110030</p>



                <p>For Direct Transfer:</p>
                <p>Bank Name : HDFC Bank Limited., A – 24, Hauz Khas, New Delhi 110016.</p>
                <p>Bank A/c No. : 04672560000537</p>

                <p>RTGS/ NEFT : HDFC0000467</p>

        </tr>


    </tbody>


</table>


<br>
<br>
<table cellspacing="0" cellpadding="0" border="0" width="75%" style="margin:0 auto">
    <tr>
        <td><u>Please fill in below</u> </td>
    </tr>
    <tr>
        <td>Invoice to be sent to the attention of </td>
    </tr>
    <tr>
        <td>__________________________________________ </td>
    </tr>

    <tr>
        <td>Address:  </td>
    </tr>
    <tr>
        <td>__________________________________________ </td>
    </tr>
    <tr>
        <td>__________________________________________ </td>
    </tr>
    <tr>
        <td>__________________________________________ </td>
    </tr>
    <tr>
        <td>Telephone: </td>
    </tr>
    <tr>
        <td>__________________________________________ </td>
    </tr>
    <tr>
        <td>Accounts Fax:  </td>
    </tr>
    <tr>
        <td>__________________________________________ </td>
    </tr>
    <tr>
        <td>E-mail to Accounts Payable : </td>
    </tr>
    <tr>
        <td>__________________________________________ </td>
    </tr>
    <tr>
        <td>Payment Cycle Details: (If any): </td>
    </tr>
    <tr>
        <td>__________________________________________ </td>
    </tr>
</table>