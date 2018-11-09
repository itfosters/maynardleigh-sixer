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
    '50% of the professional fee - 15 to 3 working days of the confirmed date of delivery.',
    '100% of professional fee - 2 to 0 working days of the confirmed date of delivery.'
);
$cancellationClouseArray[2] = array(
    '50% of the professional fee - 20 to 3 working days of the confirmed date of delivery.',
    '100% of professional fee - 2 to 0 working days of the confirmed date of delivery.'
);
$cancellationClouseArray[3] = array(
    '50% of the professional fee - 24 to 4 hrs of the confirmed date and time of call.',
    '100% of professional fee - 4 to 0 hrs of the confirmed date and time of call.'
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
<html lang="en-IN">
    <head>
        <meta charset="UTF-8">
        <title>Pdf of contractor</title>
        <style>
    .maintable{background-color:#ffffff; margin:0 auto;}
    .tdmain{padding:0px 0px 15px 20px;}
    .imgnew{margin-bottom: 40px; height: 160px;}
    .innertd{margin: 20px; padding: 20px;}
    .pclass{font-size: 14px; margin: 0;  text-decoration: underline;text-align: center;}
    .pclass1{font-size: 12px; margin: 0;  text-align: center;}
    .pclass11{font-size: 12px; margin: 0;  text-align: left;}
    .pclass111{font-size: 12px; padding-left: 12px;  text-align: left;}
    .logonew{margin-bottom: 40px; height: 160px;}
    .pspan{background-color:yellow;}
    .tdspan{font-size: 16px; margin: 0; text-decoration: underline;}
    .pprice{border: 1px solid black; height: 45px; padding:10px 0px 10px 10px;}
    .pprice1{border: 1px solid black;  padding:10px 0px 10px 10px;}
    .mainprice{border: 1px solid black; padding:10px 0px 10px 10px; text-align: center;}
    .dtdnew{border: 1px solid black; text-align: center;}
    .deliveryclass{ border: 1px solid black; text-align: center;}
    .deliveryclassleft{ border: 1px solid black; text-align: left;}
    .deliveryclassright{ border: 1px solid black; text-align: right;}
    .ttotal{border: 1px solid black; height: 20px;}
    .tableborder{border: 1px solid black;}
    .costinner{border: 1px solid black;height: 10px; text-align:right; padding:10px;}
    .incidentalcost{font-size: 16px; margin: 0px;}
    .paymentterms{font-size: 16px; margin: 0;}
    .lifestrategies{margin-top: 15px;}
    .detail{font-size: 13px;}
    .nda_required{background-color:#ffffff; margin:0 auto;}
    .inner_nda{padding:20px 0px 15px 0px; margin-top: 25px;}
    .ndaimg{margin-bottom: 40px; height: 160px;}
    .ndainfo{padding: 10px; position: relative;}
    .ndap{font-size: 16px; margin: 0; position: absolute;top: 0; left: 55%;}
    .nondisclosure{font-size: 16px; margin: 0;}
    .moreinfo{list-style:"1"; margin-top: 12px;}
    .innerinformation{margin-top: 15px;}
    .paddingbottom{padding: 15px 0;}

    a {

        color: #000066;

        text-decoration: none;

    }

    table {

        border-collapse: collapse;

    }

    thead {

        vertical-align: bottom;

        text-align: center;

        font-weight: bold;

    }

    tfoot {

        text-align: center;

        font-weight: bold;

    }

    th {

        text-align: left;

        padding-left: 0.35em;

        padding-right: 0.35em;

        padding-top: 0.35em;

        padding-bottom: 0.35em;

        vertical-align: top;

    }

    td {

        padding-left: 0.35em;

        padding-right: 0.35em;

        padding-top: 0.35em;

        padding-bottom: 0.35em;

        vertical-align: top;

    }

    img {

        margin: 0.2em;

        vertical-align: middle;

    }
    div#wrapper ul {
    list-style-type: none;
    }
    .hideli{padding-left: 125px;}
    ul{margin: 0; padding: 0;}
    ul li{margin: 0; padding: 0;}
    .pagebreaks
{
page-break-before: always;
}
</style>
        
    </head>
    <body style="border: none;font-size: 12px;colosr:#000;font-family: Times, Georgia, 'Times New Roman', serif !important;">
        <table class="maintable" width="100%" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    
                       
<!--                                    <td valign="bottom" align="left">
                                        <a target="#" title="Maynardleigh Online">
                                            <img class="imgnew" src="http://sixer.maynardleighonline.in/assests/img/default.png" />
                                        </a>

                                    </td>-->
                                    <td width='100%'  colspan="4" align="center" class="innertd"><p class="pclass"><b>Contract For 
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
                                                    $totaldays += $design->no_ofdays;
                                                    $totalunits += $design->units;
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
                                                <?php echo $frmdata['detail']->client_name; ?>"</b></p>
                                <!-- <p style="font-size: 16px; margin: 0;  text-decoration: underline;">For 
                                "<?php echo $frmdata['detail']->client_name ?>"</p> -->
                                        <p class="pclass"><b>Contract No - CO/LSHPL/<?php echo date('Y'); ?>/<?php echo $frmdata['detail']->order_Id; ?></b></p>
                                    </td>

<!--                                    <td align="left" width="200px" valign="bottom"></td>-->


<!--                                    <td align="right" valign="bottom" >
                                        <a target="#" title="Maynardleigh Online">
                                            <img class="logonew" src="http://sixer.maynardleighonline.in/assests/img/may.png">
                                        </a>


                                    </td>-->
                                
                    
                </tr>
            </tbody>
        </table>
        

                        <p>This Contract, effective as of <span class="pspan"><?php echo date('jS F, Y', strtotime($frmdata['detail']->entry_Time)); ?></span> is by and between Life Strategies Humancare Private Limited, a Private Limited Company, Incorporated under the Companies act 1956 having a place of business at 26A, Chelmsford Country Club, Mehrauli Gurgaon Road, Ghitorni, New Delhi - 110030(hereinafter "Service Provider"), and <?php echo $frmdata['detail']->client_name; ?> , having a place of business at <?php echo $frmdata['detail']->street ?>,&nbsp;<?php echo $frmdata['detail']->alocation ?>,&nbsp;<?php echo $frmdata['detail']->city ?>,&nbsp;<?php echo $frmdata['detail']->state ?>&nbsp;<?php echo $frmdata['detail']->pincode ?> (Hereinafter "Client").

                        </p>

                        <p class="pclass11"><b>Scope of the Contract:</b></p>

                        <table repeat_header="1" class="pdfprint" id="print_for_pdf">
                            <tr>
                                <td class="ttotal"></td>
                                <td class="deliveryclass">Particulars</td>		
                                <td class="deliveryclass">Dates</td>
                                <td class="deliveryclass">Participants</td>
                                <td class="deliveryclass">Units</td>		
                                <td class="deliveryclass">Rates</td>
                                <td class="deliveryclass">Total</td>
                            </tr>
                            <?php
                            $counter = 1;
                            $sumoftotal = 0;
                            $sumtotal_O = 0;
                            $sumtotal_Te = 0;
                            $sumtotal_T = 0;
                            if (count($frmdata['get_diagnose']) > 0){
                                if (isset($frmdata['get_diagnose']) and ( count($frmdata['get_diagnose']) > 0)) {
                                    foreach ($frmdata['get_diagnose'] as $key => $diagnose_product) {
                                       ?>
                                       <tr>
                                        <?php if($key==0){?>
                                           <td class="deliveryclass" valign="top" rowspan="<?php echo count($frmdata['get_diagnose']); ?>" >Diagnose</td>
                                                    <?php } ?>
<!--                                                    <td class="deliveryclass">Diagnose</td>-->
                                                    <td class="deliveryclassleft">
                                                    <?php echo $counter . '. ' . $diagnose_product->name . '(' . $diagnose_product->subpro . ')'; ?>
                                                 </td>
                                                 
                                                 <td class="deliveryclass"><?php
                                                        $diagnose=$frmdata['diagonoesdetail'][$key];
                                                        $start = date('d-m-Y', strtotime($diagnose->start_date));
                                                        $end = date('d-m-Y', strtotime($diagnose->end_date));
                                                        if ($start == $end) {
                                                            if ($diagnose->notconfirmed == 1)
                                                                echo date('F, Y', strtotime($start));
                                                            else
                                                                echo date('jS F, Y', strtotime($start));
                                                        }else {
                                                            if ($diagnose->notconfirmed == 1)
                                                                echo date('F, Y', strtotime($start));
                                                            else
                                                                echo date('jS ', strtotime($start)) . '-' . date('jS F, Y', strtotime($end));
                                                        }
                                                        ?>
                                                  </td>
                                                  
                                                  <td class="deliveryclass">
                                                    <?php 
                                                        
                                                        echo $diagnose->pax; 
                                                     ?>
                                                  </td>
                                                  
                                                  <td class="deliveryclass">
                                                    <?php 
                                                      
                                                    echo $diagnose->units; ?>
                                                </td>
                                                <td class="deliveryclassright">
                                                   
                                                    <?php  
                                                    echo moneyFormatIndia($diagnose->price_unit); ?>
                                                </td>
                                                <td class="deliveryclassright"><?php echo moneyFormatIndia($diagnose->price_unit*$diagnose->units); ?></td>
                                                  
                                                 </tr>  
                                       <?php
                                       $sumofdiagnose = $diagnose->price_unit * $diagnose->units;
                                       $sumoftotal = $sumoftotal + $sumofdiagnose;
                                       $counter++;
                                    }
                                    //$sumoftotal = 0;
                                }    
                                ?>
                                
                            <?php } ?>
                            <!-- design section start here -->                    
                            <?php
                            if (count($frmdata['getdesigndetail']) > 0) {
                                $counter = 1;
                                if (isset($frmdata['get_design']) and ( count($frmdata['get_design']) > 0)) {
                                    foreach ($frmdata['get_design'] as $key => $diagnose_product) {
                                    ?>
                                    <tr>
                                        <?php if($key==0){?>
                                           <td class="deliveryclass" valign="top" rowspan="<?php echo count($frmdata['get_design']); ?>" >Design</td>
                                                    <?php } ?>
<!--                                                    <td class="deliveryclass" valign="top">Design</td>-->
                                                    <td class="deliveryclassleft">
                                                    <?php echo $counter . '. ' . $diagnose_product->name . '(' . $diagnose_product->subpro . ')'; ?>
                                                 </td>
                                                 
                                                 <td class="deliveryclass"><?php
                                                        $design=$frmdata['getdesigndetail'][$key];
                                                        $start = date('d-m-Y', strtotime($design->start_date));
                                                        $end = date('d-m-Y', strtotime($design->end_date));
                                                        if ($start == $end) {
                                                            if ($design->notconfirmed == 1)
                                                                echo date('F, Y', strtotime($start));
                                                            else
                                                                echo date('jS F, Y', strtotime($start));
                                                        }else {
                                                            if ($design->notconfirmed == 1)
                                                                echo date('F, Y', strtotime($start));
                                                            else
                                                                echo date('jS ', strtotime($start)) . '-' . date('jS F, Y', strtotime($end));
                                                        }
                                                        ?>
                                                  </td>
                                                  
                                                  <td class="deliveryclass">
                                                    <?php 
                                                        
                                                        echo $design->pax; 
                                                     ?>
                                                  </td>
                                                  
                                                  <td class="deliveryclass">
                                                    <?php 
                                                      
                                                    echo $design->units; ?>
                                                </td>
                                                <td class="deliveryclassright">
                                                   
                                                    <?php  
                                                    echo moneyFormatIndia($design->price_unit); ?>
                                                </td>
                                                <td class="deliveryclassright"><?php echo moneyFormatIndia($design->price_unit*$design->units); ?></td>
                                                  
                                                 </tr> 
                                    <?php
                                    $sumofdesign = $design->price_unit * $design->units;
                                    $sumoftotal = $sumoftotal + $sumofdesign;
                                    $counter ++;
                                    }
                                }
                            }
                            ?>
                            <!-- design section start end -->
                            
                            
                            
                            <!-- delivery section start here -->                    
                            <?php
                            if (count($frmdata['getdeliverydetail']) > 0) {
                                $counter = 1;
                                if (isset($frmdata['get_delivey']) and ( count($frmdata['get_delivey']) > 0)) {
                                    //echo "<pre>".count($frmdata['get_delivey']);;print_r($frmdata['get_delivey']);die;
                                    foreach ($frmdata['get_delivey'] as $key => $diagnose_product) {
                                    ?>
                                    <tr>
                                        <?php if($key==0){?>
                                           <td class="deliveryclass" valign="top" rowspan="<?php echo count($frmdata['get_delivey']); ?>" >Delivery</td>
                                                    <?php } ?> 
                                                    <td class="deliveryclassleft">
                                                    <?php echo $counter . '. ' . $diagnose_product->name . '(' . $diagnose_product->subpro . ')'; ?>
                                                 </td>
                                                 
                                                 <td class="deliveryclass"><?php
                                                        $delivey=$frmdata['getdeliverydetail'][$key];
                                                        $start = date('d-m-Y', strtotime($delivey->start_date));
                                                        $end = date('d-m-Y', strtotime($delivey->end_date));
                                                        if ($start == $end) {
                                                            if ($delivey->notconfirmed == 1)
                                                                echo date('F, Y', strtotime($start));
                                                            else
                                                                echo date('jS F, Y', strtotime($start));
                                                        }else {
                                                            if ($delivey->notconfirmed == 1)
                                                                echo date('F, Y', strtotime($start));
                                                            else
                                                                echo date('jS ', strtotime($start)) . '-' . date('jS F, Y', strtotime($end));
                                                        }
                                                        ?>
                                                  </td>
                                                  
                                                  <td class="deliveryclass">
                                                    <?php 
                                                        
                                                        echo $delivey->pax; 
                                                     ?>
                                                  </td>
                                                  
                                                  <td class="deliveryclass">
                                                    <?php 
                                                      
                                                    echo $delivey->units; ?>
                                                </td>
                                                <td class="deliveryclass">
                                                   
                                                    <?php  
                                                    echo moneyFormatIndia($delivey->price_unit); ?>
                                                </td>
                                                <td class="deliveryclassright"><?php echo moneyFormatIndia($delivey->price_unit*$delivey->units); ?></td>
                                                  
                                                 </tr> 
                                    <?php
                                    $sumofdesign = $delivey->price_unit * $delivey->units;
                                    $sumoftotal = $sumoftotal + $sumofdesign;
                                    $counter ++;
                                    }
                                }
                            }
                            ?>
                            <!-- delivery section start end -->
                            
                                                 
                                                 
                           <!-- -------------------------discovery start here--------------------- -->  
                           <?php 
                           if (count($frmdata['getdiscoveryDetail']) > 0) {
                                $counter = 1;
                                if (isset($frmdata['get_discovery']) and ( count($frmdata['get_discovery']) > 0)) {
                                    foreach ($frmdata['get_discovery'] as $key => $diagnose_product) {
                                        ?>
                                        <tr>
                                                    <?php if($key==0){?>
                                                    <td class="deliveryclass" valign="top" rowspan="<?php echo count($frmdata['get_discovery']); ?>" >Discovery</td>
                                                    <?php } ?>
                                                    <td class="deliveryclassleft">
                                                    <?php echo $counter . '. ' . $diagnose_product->name . '(' . $diagnose_product->subpro . ')'; ?>
                                                 </td>
                                                 
                                                 <td class="deliveryclass"><?php
                                                        $discoveryvalue=$frmdata['getdiscoveryDetail'][$key];
                                                        $start = date('d-m-Y', strtotime($discoveryvalue->start_date));
                                                        $end = date('d-m-Y', strtotime($discoveryvalue->end_date));
                                                        if ($start == $end) {
                                                            if ($discoveryvalue->notconfirmed == 1)
                                                                echo date('F, Y', strtotime($start));
                                                            else
                                                                echo date('jS F, Y', strtotime($start));
                                                        }else {
                                                            if ($discoveryvalue->notconfirmed == 1)
                                                                echo date('F, Y', strtotime($start));
                                                            else
                                                                echo date('jS ', strtotime($start)) . '-' . date('jS F, Y', strtotime($end));
                                                        }
                                                        ?>
                                                  </td>
                                                  
                                                  <td class="deliveryclassright">
                                                    <?php 
                                                        
                                                        echo $discoveryvalue->pax; 
                                                     ?>
                                                  </td>
                                                  
                                                  <td class="deliveryclassright">
                                                    <?php 
                                                      
                                                    echo $discoveryvalue->units; ?>
                                                </td>
                                                <td class="deliveryclassright">
                                                   
                                                    <?php  
                                                    echo moneyFormatIndia($discoveryvalue->price_unit); ?>
                                                </td>
                                                <td class="deliveryclassright"><?php echo moneyFormatIndia($discoveryvalue->price_unit*$discoveryvalue->units); ?></td>
                                                  
                                                 </tr>
                                        <?php
                                        $counter++;
                                        $sumtotaldiscovery = $discoveryvalue->price_unit * $discoveryvalue->units;
                                        $sumtotal_T = $sumtotal_T + $sumtotaldiscovery;
                                    }
                                }
                           }
                           ?>
                        
                           <!-- -------------------------discovery start end---------------------   -->                      
                            <tr>
                                <td colspan="6" class="ttotal">Total Cost</td>
                                <td class="deliveryclassright">
                                    <?php
                                    $grand_total = $sumoftotal + $sumtotal_O + $sumtotal_Te + $sumtotal_T;
                                    ?>
                                    <?php
                                    echo moneyFormatIndia($grand_total);
                                    ?>
                                </td>
                            </tr>
                        </table>
        
        
<!--        <table>
            <tr>-->
<!--                    <td colspan="6" align="left">-->
                        <br/>
                        <p align="left" class="pclass11"><b>Incidental Costs:</b></p>
                        <div id="wrapper">
                            <ol id="costs">
                                <li>Relevant official communication expenses, if any.</li>
                                <li>Incidental expenses (travel) for the consultants to do pre-work and/or meetings at client site.</li>
                                <li>Travel for Delivery: For programs outside Delhi & NCR, Suitable Air Travel, accommodation, all meals and pick-up & drop-off facilities
                                    to be provided by client. Also, airport transfers in Delhi will be charged at Rs 12 per Km* actual kms if not provided by client. </li>
                                <li>For programs within Delhi NCR travel client will be charged at Rs 12 per Km* actual kms if not provided by client.</li>
                                <li>If any of the bookings related to workshop like Air travel, Accommodation, all meals & cab for the consultant & Venue for the workshop will be booked by Life Strategies Humancare Private Limited, then the same will be reimbursed by client on actuals without any TDS deduction.</li>
                                <li>Additional to the above cost, 15% of the total value of re-imbursement will be charged extra if the bookings are done by Life Strategies Humncare Private Limited as mentioned above.</li>
                                <li>GST @ 18% will be charged extra on the total cost including travel.</li>
                            </ol>
                        </div>
                        <br/>
                        <p class="pclass11"><b>Payment Terms</b></p>
                        <div id="wrapper">
                        <ol>
                            <li>The payment will be payable within "<?php echo $frmdata['detail']->termsconditions ?>" of the program date.</li>
                            <li>In case of cancellation/rescheduling fees will be charged as follows -
                                <ol>
                                    <?php
//echo "<pre>";print_r($cancellationClouseArray[$frmdata['detail']->cancellation_clouse]);die;
                                    if (isset($cancellationClouseArray[$frmdata['detail']->cancellation_clouse])) {
                                        foreach ($cancellationClouseArray[$frmdata['detail']->cancellation_clouse] as $data) {
                                            ?>
                                            <li><?php echo $data; ?></li>
                                            <?php
                                        }
                                    }
                                    ?>


                                </ol>
                            </li>
                            <li>Any one of the following methods may be considered as date confirmation:  email notification from Client

                                confirming delivery dates, a Purchase Order or a signed contract with specific dates.</li>
                            <li>The session cannot be recorded without a prior written consent from Maynardleigh Associates.</li>
                            <li> The above commercials are valid till the <?php echo $frmdata['detail']->price_validity ?>, after which there will be a 10% hike in the investment.</li>
                        </ol>
                        </div>
                        
                        <p class="pclass11"><b>Other arrangements that Client will take care of:</b></p>
                        <ol>
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
                            <?php
                            if (isset($frmdata['transports'])) {
                                foreach ($frmdata['transports'] as $key => $value) {
                                    ?>
                                    <li>The <?php echo $value ?> is on the <b><?php echo $transportvalue[$transidvalue[$key]]; ?></b> side</li>
                                    <?php
                                }
                            }
                            ?>
                        </ol>
                        <br>
                        <p ><b>A Non-Disclosure Agreement for the scope of this contract is included as an annexure</b></p><br>

                        <p class="paymentterms"></p>
<!--                    </td>-->
<!--                </tr>
        </table>-->
        
        
        <style type="text/css">
           .sign tr td{
                font-size: 20px
            }
        </style>

        <table cellspacing="0" cellpadding="0" border="0" width="100%" class="margineauto sign">
            <tbody>
                <tr>
                    <td width="50%" align="left" class="lifestrategies">
                        Life Strategies Humancare Pvt Ltd.
                       

                        <table>
                            <tr>
                                <td>By</td><td>:</td><td><img src="<?php echo site_url().ASSESTS_ULR.'admin/img/'. 'steve.png'; ?>" height='20px'></td>
                            </tr>
                            <tr>
                                <td>Name</td><td>:</td><td>&nbsp;Steeve Gupta</td>
                            </tr>
                            <tr>
                                <td>Title</td><td>:</td><td> &nbsp;Director</td>
                            </tr>
                            <tr>
                                <td>Witness</td><td>:</td><td><img src="<?php echo site_url().ASSESTS_ULR.'admin/img/'. 'knika.png'; ?>" height='20px'></td>
                            </tr>
                        </table>
                    </td>
                    <td width="400" align="left" style="margin-top: 15px;">
                    
                    <table>
                        <tr>
                            <td><img src="<?php echo site_url().ASSESTS_ULR.'admin/img/'. 'stamp.png'; ?>" ></td>
                        </tr>
                        
                    </table>
                </td>
                    <td width="50%" align="left" class="lifestrategies">
                        <p><?php echo $frmdata['detail']->client_name ?></p>

                        <table>
                            <tr>
                                <Td>By</td><td>:</td><td> __________________________</td>
                            </tr>
                            <tr>
                                <Td>Name</td><td>:</td><td> __________________________</td>
                            </tr>
                            <tr>
                                <Td>Title</td><td>:</td><td> __________________________</td>
                            </tr>
                            <tr>
                                <Td>Witness</td><td>:</td><td>__________________________</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        
        
        <!-- next part -->
        
        
    </body>
</html>



