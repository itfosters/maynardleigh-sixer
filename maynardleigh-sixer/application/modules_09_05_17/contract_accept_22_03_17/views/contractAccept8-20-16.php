
<?php  //echo "###<pre>";print_r($frmdata);die; ?>
 <table style="background-color:#ffffff" width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="padding:20px 20px 15px 20px">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td height="50" valign="bottom" align="left">
<a target="#" title="Visit Pinterest">
<img src="<?php echo IMG_URL.'default.jpg'; ?>" />
</a>

</td>
<td width="450" align="center" style="padding: 10px;"><strong><p style="font-size: 16px; margin: 0; text-decoration: underline;">Contract for 
"<?php echo $frmdata['detail']->first_name; ?>&nbsp;<?php echo $frmdata['detail']->last_name; ?>"</p>
	<p style="font-size: 16px; margin: 0;  text-decoration: underline;">For 
	'<?php echo $frmdata['detail']->client_name; ?>'</p>
	<p style="font-size: 16px; margin: 0;  text-decoration: underline;">Contract No - CO/LSHPL/<?php echo date('Y');?>/<?php echo $frmdata['detail']->order_Id;?></p></strong>
	</td>

	<td align="left" width="100px" valign="bottom"></td>


<td align="right" width="400px" valign="bottom" >
<a target="#" title="Visit Pinterest">
<img style="width: 400px; height: 160px;" src="<?php echo IMG_URL.'may.png'; ?>">
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
<td valign="bottom" width="100%">
<p>This Contract, effective as of <?php echo $frmdata['detail']->entry_Time; ?>(date of order - OE) is by and between Life Strategies Humancare Private Limited, a Private Limited Company, Incorporated under the Companies act 1956 having a place of business at 26 A, Chelmsford Country Club, Club Drive, Mehrauli Gurgaon Road, Ghitorni, New Delhi - 110030 <?php echo $frmdata['detail']->client_name; ?>  (name of the client&ndash;; OE), having a place of business at <?php echo $frmdata['detail']->street ?>&nbsp;<?php echo $frmdata['detail']->location ?>&nbsp;<?php echo $frmdata['detail']->pincode  ?>
 (Hereinafter <strong>“Client”).</strong></p>


<strong><p style="font-size: 16px; margin: 0; text-decoration: underline;">Scope of the Contract:</p></strong>


<p>1. No. of participants – Up to 25 participants(OE) per workshop. (Any addition to this number has to be communicated 

& approved by Maynard Leigh atleast 15 days before the workshop).</p>
<p>2. No of days – 2 days(OE) (1 day per workshop)</p>
<table style="width:100%;  border: 1px solid black; border-collapse: collapse;">
  <tr>
    <td style=" border: 1px solid black; height: 45px; "></td>
    <td style=" border: 1px solid black;  text-align: center; ">Particulars</td>		
    <td style=" border: 1px solid black;  text-align: center;">Dates</td>
     <td style=" border: 1px solid black; text-align: center; ">Units</td>		
    <td style=" border: 1px solid black;  text-align: center;">Rates</td>
     <td style=" border: 1px solid black;  text-align: center;">Total</td>
  </tr>
  <tr>
  
    <td style=" border: 1px solid black; height: 45px;">Diagnose</td>
    <td style=" border: 1px solid black; ">
        <table width="100%">
			<?php  
			
			$counter=1;
			if(isset($frmdata['get_diagnose']) and (count($frmdata['get_diagnose'])>0)){
			foreach($frmdata['get_diagnose'] as $key =>$diagnose_product) 
				
			{//echo "###<pre>";print_r($diagnose_product);die;?>
                <tr>
                    <td>
                    	<?php echo $counter.'. '. $diagnose_product->name;?>
                    </td>
                </tr>
            <?php 
			$counter++;
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
    
    </td>		
    <td style=" border: 1px solid black;  text-align: center;">
        <table width="100%">
			<?php  
			
			$counter=1;
			if(isset($frmdata['diagonoesdetail']) and (count($frmdata['diagonoesdetail'])>0)){
			foreach($frmdata['diagonoesdetail'] as $key =>$diagnose) 
				
			{?>
                <tr>
                    <td>
                    	<?php echo $counter.'. '. $diagnose->start_date;?>-<?php echo $diagnose->end_date;?>
                    </td>
                </tr>
            <?php 
			$counter++;
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
    </td>
     <td style=" border: 1px solid black; text-align: center;">
     	<table width="100%">
        	
			<?php  
			
				if(isset($frmdata['diagonoesdetail']) and (count($frmdata['diagonoesdetail'])>0)){
				foreach($frmdata['diagonoesdetail'] as $key =>$diagnose) 
				
				{?>
                <tr>
                    <td>
                    
                         <?php echo $diagnose->units;?>  
                    </td>
                </tr>
             <?php
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
     </td>		
    <td style=" border: 1px solid black;  text-align: center;">
		<table width="100%">
			<?php  
			
				if(isset($frmdata['diagonoesdetail']) and (count($frmdata['diagonoesdetail'])>0)){
				foreach($frmdata['diagonoesdetail'] as $key =>$diagnose) 
				
				{?>
                <tr>
                    <td>
                    
                         <?php echo $diagnose->price_unit;?>  
                    </td>
                </tr>
             <?php 
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
	</td>
     <td style=" border: 1px solid black;  text-align: center;">
     <table width="100%">
			<?php  
			
				 $sumoftotal=0;
				if(isset($frmdata['diagonoesdetail']) and (count($frmdata['diagonoesdetail'])>0)){
				foreach($frmdata['diagonoesdetail'] as $key =>$diagnose) 
				
				{?>
                <tr>
                    <td>
                    
                         <?php
						 $sumofdiagnose=$diagnose->price_unit;
						 $sumoftotal=$sumoftotal+$sumofdiagnose;
						?>  
                    </td>
                </tr>
             <?php 
			
			}  echo $sumoftotal;
			}else{
				echo"N/A";	
			}
			?>
        </table>
     </td>
  </tr>
  <tr>
     <td style=" border: 1px solid black; height: 45px; ">Design</td>
    <td style=" border: 1px solid black; ">
    <table width="100%">
			<?php  
			
			$counter=1;
			if(isset($frmdata['get_design']) and (count($frmdata['get_design'])>0)){
			foreach($frmdata['get_design'] as $key =>$diagnose_product) 
				
			{?>
                <tr>
                    <td>
                    	<?php echo $counter.'. '. $diagnose_product->name;?>
                    </td>
                </tr>
            <?php 
			$counter++;
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
    
    </td>		
    <td style=" border: 1px solid black;  text-align: center;">
		<table width="100%">
        	
			<?php  
			$counter=1;
			if(isset ($frmdata['getdesigndetail']) and (count($frmdata['getdesigndetail'])>0)){
			foreach($frmdata['getdesigndetail'] as $key =>$design) {?>
                <tr>
                    <td>
                    	<?php echo $counter.'. '.$design->start_date;?>- <?php echo $design->end_date;?>
                    </td>
                </tr>
             <?php 
			$counter++;
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
     </td>
     <td style=" border: 1px solid black;  text-align: center;">
	 	<table width="100%">
			<?php
			if(isset ($frmdata['getdesigndetail']) and (count($frmdata['getdesigndetail'])>0)){
			foreach($frmdata['getdesigndetail'] as $key =>$design) 
			{?>
                <tr>
                    <td>
                        <?php echo $design->units;?>   
                    </td>
                </tr>
             <?php
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
     </td>
     <td style=" border: 1px solid black;  text-align: center;">
	 	<table width="100%">
			<?php  
			$counter=1;
			if(isset ($frmdata['getdesigndetail']) and (count($frmdata['getdesigndetail'])>0)){
			foreach($frmdata['getdesigndetail'] as $key =>$design) 
			{?>
                <tr>
                    <td>
                    	<?php echo $counter.'. '.$design->price_unit;?>  
                    </td>
                </tr>
             <?php 
			$counter++;
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
	 </td>		
    <td style=" border: 1px solid black;  text-align: center;">
    	<table width="100%">
			<?php  
			$sumtotal_O=0;
			if(isset ($frmdata['getdesigndetail']) and (count($frmdata['getdesigndetail'])>0)){
			foreach($frmdata['getdesigndetail'] as $key =>$design) 
			{?>
                <tr>
                    <td>
                    	<?php $sumtotaldesign=$design->price_unit;
						$sumtotal_O=$sumtotal_O+$sumtotaldesign;
						?>  
                    </td>
                </tr>
             <?php 
			}echo $sumtotal_O;
			}else{
				echo"N/A";	
			}
			?>
        </table>
    
    </td>
  </tr>

   <tr>
     <td style=" border: 1px solid black; height: 45px; ">Delivey</td>
    <td style=" border: 1px solid black; ">
    	 <table width="100%">
			<?php  
			
			$counter=1;
			if(isset($frmdata['get_delivey']) and (count($frmdata['get_delivey'])>0)){
			foreach($frmdata['get_delivey'] as $key =>$diagnose_product) 
				
			{?>
                <tr>
                    <td>
                    	<?php echo $counter.'. '. $diagnose_product->name;?>
                    </td>
                </tr>
            <?php 
			$counter++;
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
    
    </td>		
    <td style=" border: 1px solid black;  text-align: center;">
		<table width="100%">
			<?php 
			$counter=1; 
			if(isset($frmdata['getdeliverydetail']) and (count($frmdata['getdeliverydetail'])>0)){
			foreach($frmdata['getdesigndetail'] as $key =>$delivey) {?>
                <tr>
                    <td>
                    	<?php echo $counter.'. '.$delivey->start_date;?>- <?php echo $delivey->end_date;?>
                    </td>
                </tr>
           <?php 
			$counter++;
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
	 </td>
     <td style=" border: 1px solid black;  text-align: center;">
	 	<table width="100%">
			<?php  
				
				if(isset($frmdata['getdeliverydetail']) and (count($frmdata['getdeliverydetail'])>0)){
				foreach($frmdata['getdeliverydetail'] as $key =>$delivey) {?>
                <tr>
                    <td>
                    	<?php echo $delivey->units;?>
                    </td>
                </tr>
             <?php 
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
	</td>
     <td style=" border: 1px solid black;  text-align: center;">
	 	<table width="100%">
			<?php  
			//$counter=1; 
			if(isset($frmdata['getdeliverydetail']) and (count($frmdata['getdeliverydetail'])>0)){
			foreach($frmdata['getdeliverydetail'] as $key =>$delivey) {?>
                <tr>
                    <td>
                    	<?php echo $delivey->price_unit;?>
                    </td>
                </tr>
            <?php 
			//$counter++;
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
    </td>		
    <td style=" border: 1px solid black;  text-align: center;">
    <table width="100%">
			<?php  
			$sumtotal_Te=0;
			if(isset ($frmdata['getdeliverydetail']) and (count($frmdata['getdeliverydetail'])>0)){
			foreach($frmdata['getdeliverydetail'] as $key =>$delivey) 
			{?>
                <tr>
                    <td>
                    	<?php $sumtotaldelivey=$delivey->price_unit;
						$sumtotal_Te=$sumtotal_Te+$sumtotaldelivey;
						?>  
                    </td>
                </tr>
             <?php 
			}echo $sumtotal_Te;
			}else{
				echo"N/A";	
			}
			?>
        </table>

    </td>
    
  </tr>

   <tr>
     <td style=" border: 1px solid black; height: 45px; ">Discovery</td>
    <td style=" border: 1px solid black; ">
    	<table width="100%">
			<?php  
			
			$counter=1;
			if(isset($frmdata['get_discovery']) and (count($frmdata['get_discovery'])>0)){
			foreach($frmdata['get_discovery'] as $key =>$diagnose_product) 
				
			{?>
                <tr>
                    <td>
                    	<?php echo $counter.'. '. $diagnose_product->name;?>
                    </td>
                </tr>
            <?php 
			$counter++;
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
    
    </td>		
    <td style=" border: 1px solid black;  text-align: center;">
		<table width="100%">
			<?php 
			 $counter=1;
			 if(isset($frmdata['getdiscoveryDetail']) and (count($frmdata['getdiscoveryDetail'])>0)){
			 foreach($frmdata['getdiscoveryDetail'] as $key =>$discovery) {?>
                <tr>
                    <td>
                    	<?php echo $counter.'.'. $discovery->start_date;?>- <?php echo $discovery->end_date;?>
                    </td>
                </tr>
             <?php 
			$counter++;
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
    </td>
     <td style=" border: 1px solid black;  text-align: center;">
	 	<table width="100%">
			<?php
			 if(isset($frmdata['getdiscoveryDetail']) and (count($frmdata['getdiscoveryDetail'])>0)){
			 foreach($frmdata['getdiscoveryDetail'] as $key =>$discovery) {?>
                <tr>
                    <td>
                    	<?php echo $discovery->units;?>
                    </td>
                </tr>
            <?php 
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
	 </td>
     <td style=" border: 1px solid black;  text-align: center;">
	 	<table width="100%">
			<?php  
			 
			 if(isset($frmdata['getdiscoveryDetail']) and (count($frmdata['getdiscoveryDetail'])>0)){
			 foreach($frmdata['getdiscoveryDetail'] as $key =>$discovery) {?>
                <tr>
                    <td>
                    	<?php echo $discovery->price_unit;?>
                    </td>
                </tr>
             <?php
			}
			}else{
				echo"N/A";	
			}
			?>
        </table>
	</td>		
    <td style=" border: 1px solid black;  text-align: center;">
    <table width="100%">
			<?php  
			$sumtotal_T=0;
			if(isset ($frmdata['getdiscoveryDetail']) and (count($frmdata['getdiscoveryDetail'])>0)){
			foreach($frmdata['getdiscoveryDetail'] as $key =>$discovery) 
			{?>
                <tr>
                    <td>
                    	<?php $sumtotaldiscovery=$discovery->price_unit;
						$sumtotal_T=$sumtotal_T+$sumtotaldiscovery;
						?>  
                    </td>
                </tr>
             <?php 
			}echo $sumtotal_T;
			}else{
				echo"N/A";	
			}
			?>
        </table>
    
    </td>
  </tr>

   <tr>
     <td style=" border: 1px solid black; height: 45px;">Total Cost</td>
  	 <td colspan="5"  style="height: 45px; text-align:right; padding:10px;">
     <?php 
	 $grand_total = $sumoftotal + $sumtotal_O + $sumtotal_Te + $sumtotal_T ;
	 
	 ?>
     <?php 
	 echo $grand_total;
	 
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
	<li>Travel for Delivery: For programs outside Delhi & NCR, all travel to be booked by client. Suitable Air travel to be arranged by Client. Suitable Lodging, all meals and pick-up & drop-off facilities to be provided by client. </li>
	<li>For Delhi & NCR area travel & airport transfers client will be charged at Rs12per Km* actual kms if not provided by client.</li>
	<li>For all the workshops Air travel of the consultant will be booked by Life Strategies Humancare Private Limited and it will be reimbursed by client on actuals without any TDS deduction on the same.</li>
	<li>The stay for the consultant to be booked by Client (minimum 4 star hotels). Suitable Lodging, all meals and pick-up & drop-off facilities to be provided by client. But, the payment to the same will be made by Life Strategies Humancare Private Limited and same will be reimbursed by client on actuals without any TDS deduction on the same.</li>
	<li>Service tax @ 14.5% will be charged extra on the total cost.</li>
	
</ul>


<strong><p style="font-size: 16px; margin: 0;">Payment Terms</p></strong>
<ol>
<li>The payment will be payable within 45 days (OE) of the program date.</li>
<li>In case of cancellation/rescheduling fees will be charged as follows –
	<ol>
    	<li></li>
        <li></li>
    </ol>
</li>
<li>Any one of the following methods may be considered as date confirmation:  email notification from Client

confirming delivery dates, a Purchase Order or a signed contract with specific dates.</li>
</ol>


<strong><p style="font-size: 16px; margin: 0;">Other arrangements that Client will take care of:</p></strong>
<ul>
<li>Hotel for consultants stay(with breakfast & in-room dinning) if workshop is outside Delhi NCR</li>
<li>Hotel for consultants stay(with breakfast & in-room dinning) if workshop is outside Delhi NCR</li>
<li>Hotel for consultants stay(with breakfast & in-room dinning) if workshop is outside Delhi NCR</li>
</ul>

<strong><p style="font-size: 16px; margin: 0;">A Non-Disclosure Agreement for the scope of this contract is included as an annexure</p></strong>

<strong><p style="font-size: 16px; margin: 0;">Life Strategies Humancare Pvt Ltd.
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

<strong>by:</strong>________________________________
<strong>name:</strong>________________________________
<strong>Title:</strong>________________________________
<strong>Witness:</strong>________________________________
</td>
<td width="400" align="left" style="margin-top: 15px;">
<strong><p style="font-size: 16px;">Life Strategies Humancare Pvt Ltd.
</p>
</strong>

<strong>by:</strong>________________________________
<strong>name:</strong>________________________________
<strong>Title:</strong>________________________________
<strong>Witness:</strong>________________________________
</tr>
</tbody>
</table>


<!-- second part started from here  -->

<table style="background-color:#ffffff" width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="padding:40px 20px 15px 20px; margin-top: 25px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td height="50" valign="bottom" align="left">
<a target="#" title="Visit Pinterest"><img src="<?php echo IMG_URL.'default.jpg'; ?>"></a>

</td>
<td width="450" align="center" style="padding: 10px; position: relative;">
<p style="font-size: 16px; margin: 0; position: absolute;top: 0; left: 55%;">(To be sent only when it is ticked)</p>

	</td>

	<td align="left" width="100px" valign="bottom"></td>


<td align="right" width="400px" valign="bottom" >
<a target="#" title="Visit Pinterest"><img style="width: 400px; height: 160px;" src="<?php echo IMG_URL.'may.png'; ?>" /></a>


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


<strong><p style="font-size: 16px; margin: 0;"> <strong>WHEREAS,</strong> Client is willing to receive information from the service provider regarding the <strong>“Vital Leader(product 

name- OE)”</strong> program, which information the Service Provider deems proprietary.</p></strong>

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

Proprietary Information except for copies to be distributed to employees (attending the training program) 

of the Client as part of the training seminar for which the Client is paying the Service Provider. This is on 

a need to know basis and on the basis that the Client has agreed to maintain the confidentiality of this 

Proprietary Information.</li>
<li style="list-style: nomber; margin-top: 12px;">Nothing contained in this Agreement shall be construed as: (i) requiring the Service Provider to disclose

to the Client any particular information; (ii) granting to the Client a license, either express or implied, 

under any patent, copyright, trade secret or other intellectual property right, now or hereafter owned, 

obtained or licensed by the Service Provider;</li>
<li style="list-style: nomber; margin-top: 12px;">The Client will not utilise any such Proprietary Information to develop products or produce articles for its 

own or another’s use, or to develop products or produce articles sold or offered for sale or otherwise 

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

<strong>by:</strong>________________________________
<strong>name:</strong>________________________________
<strong>Title:</strong>________________________________
<strong>Witness:</strong>________________________________
</td>
<td width="400" align="left" style="margin-top: 15px;">
<strong><p style="font-size: 16px;">Life Strategies Humancare Pvt Ltd.
</p>
</strong>

<strong>by:</strong>________________________________
<strong>name:</strong>________________________________
<strong>Title:</strong>________________________________
<strong>Witness:</strong>________________________________
</tr>
</tbody>
</table> 
<!-- second part ended here  -->
<!-- Third part started from here  -->
<!-- kkkkkk -->
<table style="background-color:#ffffff" width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td style="padding:40px 20px 15px 20px; margin-top: 25px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td height="50" valign="bottom" align="left">
<a target="#" title="Visit Pinterest"><img src="<?php echo IMG_URL.'default.jpg'; ?>"></a>

</td>
<td width="450" align="center" style="padding: 10px; position: relative;">
<p style="font-size: 16px; text-decoration: underline; margin: 0; position: absolute;bottom: 0; left: 55%;">Accounting Details</p>

	</td>

	<td align="left" width="100px" valign="bottom"></td>


<td align="right" width="400px" valign="bottom" >
<a target="#" title="Visit Pinterest"><img style="width: 400px; height: 160px;" src="<?php echo IMG_URL.'may.png'; ?>" /></a>


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
<p>Cheque in favour of “Life Strategies Humancare Pvt. Ltd.”</p>

<p>Please deliver cheques and documents to the following address :</p>
<p>Life Strategies Humancare Pvt. Ltd.</p>
<p>26A, Chelmsford Country Club,</p>
<p>MG Road, Ghitorni, New Delhi 110030</p>



<p>For Direct Transfer:</p>
<p>Bank Name : HDFC Bank Limited., A – 24, Hauz Khas, New Delhi 110016.</p>
<p>Bank A/c No. : 04672560000537</p>

<p>RTGS/ NEFT : HDFC0000467</p>
<p style="font-size: 16px; text-decoration: underline; margin: 0;">Please fill in below
</p>
<p>Invoice to be sent to the attention of</p>
</tr>


</tbody>


</table>

<table cellspacing="0" cellpadding="0" border="0" width="75%" style="margin:0 auto">
	
	<tbody>
<tr>
<td width="400" align="left" style="margin-top: 15px;">
<strong><p style="font-size: 16px;">Life Strategies Humancare Pvt Ltd.
</p></strong>

<strong>by:</strong>________________________________
<strong>name:</strong>________________________________
<strong>Title:</strong>________________________________
<strong>Witness:</strong>________________________________
</td>
<td width="400" align="left" style="margin-top: 15px;">
<strong><p style="font-size: 16px;">Life Strategies Humancare Pvt Ltd.
</p>
</strong>

<strong>by:</strong>________________________________
<strong>name:</strong>________________________________
<strong>Title:</strong>________________________________
<strong>Witness:</strong>________________________________
</tr>
</tbody>
</table>
 
 <button class="btn btn-primary" onClick="window.print()">Print</button>
		<?php
		//echo "!!!!!!!!<pre>";print_r($frmdata['detail']->status);die;
		if((isset($frmdata['detail']->status)) && ($frmdata['detail']->status==0)){
		?>
		<?php echo form_open("contract_accept/accept/".$frmdata['detail']->id,array("id"=>"accept")); ?>
		<input type="submit" value="Accept" onclick='return confirm("Are you sure to confirm this date ?")' class="btn btn-success mt20" />
		<!-- <input type="hidden" id="currentDiagnoseid" class="form-control" name="diagnose_id" value="<?php echo $mainid;?>" />  -->
		<?php echo form_close();?>
		<button class="btn btn-danger mt20" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		Reject
		</button>
		<?php } else { ?>
		<div class="status"><?php echo $frmdata['detail']->status=="1"?"You have accepted this request.":"You have rejected this request."?></div>
		<?php }?>
		<div class="collapse" id="collapseExample">
		<div class="well mt10">
		<?php echo form_open("contract_accept/reject/".$frmdata['detail']->id); ?>
		<div class="form-group">
		<label for="exampleInputEmail1">Comment</label>
		<textarea class="form-control" rows="3" name='comment'></textarea>
		<!-- <input type="hidden" id="currentDiagnoseid" class="form-control" name="diagnose_id" value="<?php echo $mainid;?>" />  -->
		</div>
		<input type="submit" value="Submit" onclick='return confirm("Are you sure to reject this date ?")' class="btn btn-success mt20" />
		<?php echo form_close();?>
		</div>
		</div>