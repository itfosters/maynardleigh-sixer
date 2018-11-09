<?php 
//echo "!!<pre>";print_r($frmdata);die;
?>
   

        <div id="accordion" role="tablist" aria-multiselectable="true">    
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingOne">
                	<a class="faq-links1" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                   	<div class="panel-title">
                        ORDER DETAILS
                        <span class="addingflip pull-right fa fa-plus fa-2x"></span>
                    </div>
                   </a>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="greyborder">
                	<div class="panel-body">
                    <div class="sub-title">
                        Welcome Order 
                    </div>
                    <div class="col-md-3 mb10">

                      <b> Order No:</b>
                     <?php echo (isset($frmdata['detail']->order_Id) and !empty($frmdata['detail']->order_Id))?$frmdata['detail']->order_Id:'N/A'; ?>
                      
                    </div>
                    <div class="col-md-3 mb10">

                      <b> Name Of Client:</b>
                       <?php echo (isset($frmdata['detail']->client_name) and !empty($frmdata['detail']->client_name)) ?$frmdata['detail']->client_name:'N/A';?>
                      
                    </div>
                    <div class="col-md-3 mb10">
                        <b> Sales By:</b>
                        <?php echo (isset($frmdata['detail']->seller_name)and !empty($frmdata['detail']->seller_name))? $frmdata['detail']->seller_name:'N/A' ?>
                    </div>
                    <div class="col-md-3 mb10">
                       <b>Project Manager:</b>
                        <?php echo (isset($frmdata['detail']->manager_name) and !empty($frmdata['detail']->manager_name))? $frmdata['detail']->manager_name:'N/A'?>
                    </div>
                </div>
                </div>
                    
                  <div class="greyborder">
                	<div class="panel-body">
                    <div class="sub-title">
                        Co-ordinator 
                    </div>
                    <div class="col-md-4 mb10">
                       <b>Name:</b>
                        <?php echo (isset($frmdata['detail']->co_ordinator) and !empty($frmdata['detail']->co_ordinator))? $frmdata['detail']->co_ordinator:'N/A'?>
                    </div>
                    <div class="col-md-4 mb10">
                       <b>Email Address:</b>
                        <?php echo (isset($frmdata['detail']->email_co_ordinator) and !empty($frmdata['detail']->email_co_ordinator))? $frmdata['detail']->email_co_ordinator:'N/A'?>
                    </div>
                    <div class="col-md-4 mb10">
                       <b>Contact Number:</b>
                        <?php echo (isset($frmdata['detail']->contact_no_co_ordinator) and !empty($frmdata['detail']->contact_no_co_ordinator))? $frmdata['detail']->contact_no_co_ordinator:'N/A'?>
                    </div>
                </div>
                 
                </div>     
                    
                
                <div class="greyborder">
                <div class="panel-body">
                	<div class="sub-title"> 
                    Economic Buyer
                    </div>
                    <div class="col-md-4 mb10">
                        <b>First Name: </b>
                        <?php echo (isset($frmdata['detail']->first_name) and !empty($frmdata['detail']->first_name))? $frmdata['detail']->first_name:'N/A' ?>  
                    </div>                                    
                    <div class="col-md-4 mb10">
                        <b>Last Name: </b>
                        <?php echo (isset($frmdata['detail']->last_name) and !empty($frmdata['detail']->last_name))? $frmdata['detail']->last_name:'N/A' ?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Location: </b>
                        <?php echo (isset($frmdata['detail']->location) and !empty($frmdata['detail']->location))? $frmdata['detail']->location:'N/A'?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Contact No: </b>
                        <?php echo (isset($frmdata['detail']->contact_No) and !empty($frmdata['detail']->contact_No))?$frmdata['detail']->contact_No: 'N/A' ?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Email: </b>
                        <?php echo (isset($frmdata['detail']->email_Id) and !empty($frmdata['detail']->email_Id))?$frmdata['detail']->email_Id :'N/A'  ?>
                    </div>
                </div>
                </div>
                
                <div class="greyborder">
                <div class="panel-body">
                	<div class="sub-title"> 
                    	Address For Billing
                	</div>
                    <div class="col-md-4 mb10">
                        <b>Street: </b>
                        <?php echo (isset($frmdata['detail']->street)and !empty($frmdata['detail']->street))? $frmdata['detail']->street: 'N/A'?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Location : </b>
                        <?php echo (isset($frmdata['detail']->location)and !empty($frmdata['detail']->street))? $frmdata['detail']->location: 'N/A'?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>City: </b>
                        <?php echo (isset($frmdata['detail']->city)and !empty($frmdata['detail']->street))? $frmdata['detail']->city: 'N/A'?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>State: </b>
                        <?php echo (isset($frmdata['detail']->state)and !empty($frmdata['detail']->street))? $frmdata['detail']->state: 'N/A'?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Pin Code: </b>
                        <?php echo (isset($frmdata['detail']->pincode) and !empty($frmdata['detail']->pincode))? $frmdata['detail']->pincode: 'N/A'?>
                    </div>
                </div>
                </div>
                 <div class="greyborder">
                <div class="panel-body">
                    <div class="sub-title"> 
                        Documents Uploaded
                    </div>
                    <div class="col-md-6 mb10">
                        <b>Title </b>
                        <?php //echo (isset($frmdata['detail']->street)and !empty($frmdata['detail']->street))? $frmdata['detail']->street: 'N/A'?>
                    </div>
                    <div class="col-md-6 mb10">
                        <b>Download </b>
                        <?php //echo (isset($frmdata['detail']->pincode) and !empty($frmdata['detail']->pincode))? $frmdata['detail']->pincode: 'N/A'?>
                    </div>
                    <?php 
                    //echo "!!!<pre>";print_r($frmdata['dtdoc']);die
                    //$availabeDoc= array_keys($frmdata['dtdoc']);
                    //$availabeDocvalue=array_values($frmdata['dtdoc']);
                   
                    foreach ($frmdata['document'] as $key => $value) {
                      
                      if(isset($frmdata['dtdoc']) and isset($frmdata['dtdoc'][$key])){
                      //if(!in_array($key,$availabeDoc))
                        //echo"##<pre>";print_r($frmdata['dtdoc'][$key]);die;
                        //continue;

                      ?>
                        <div class="frm-row" id="p_scents">
                           <div class="rows clearfix">
                              <div class="section colm colm6">
                                 <div class="col-md-12">
                                    <div class="col-md-6">
                                       <label><?php echo $value;?></label>
                                    </div>
                                    <div class="col-md-6">
                                       <?php //echo '<pre>';print_r(PUBLIC_PATH);?>
                                          <a class="file_download_wrapper" href="<?php echo base_url().PUBLIC_ULR ?>documents/<?php echo $frmdata['dtdoc'][$key];?>" target="_blank"></a>                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php 
                        }
                      }?>
                </div>
                </div>
                
                <div class="greyborder"	>
                <div class="panel-body">
                    <div class="sub-title">
                        Term & Conditions
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Price Validity:</b>
                        <?php echo (isset($frmdata['detail']->price_validity) and !empty($frmdata['detail']->price_validity))? $frmdata['detail']->price_validity: 'N/A'?>
                    </div>
                     <div class="col-md-4 mb10">
                        <b>Special Items:</b>
                        <?php echo (isset($frmdata['detail']->special_items) and !empty($frmdata['detail']->price_validity))? $frmdata['detail']->special_items: 'N/A'?>
                    </div>    
                    <div class="col-md-4 mb10">
                        <b>Cancellation Clouse: </b>
                        <?php echo (isset ($frmdata['detail']->cancellation_clouse) and !empty($frmdata['detail']->cancellation_clouse))? $frmdata['detail']->cancellation_clouse : 'N/A'?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Blanket Contract No: </b>
                        <?php echo (isset($frmdata['detail']->contract_no) and !empty($frmdata['detail']->contract_no))? $frmdata['detail']->contract_no:'N/A'?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Payment Cycle: </b>
                        <?php echo (isset ($frmdata['detail']->payment_cycle) and !empty($frmdata['detail']->payment_cycle))?$frmdata['detail']->payment_cycle:'N/A'?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Mode Of Payment: </b>
                        <?php echo (isset ($frmdata['detail']->mode_ofpayment) and !empty ($frmdata['detail']->mode_ofpayment))? $frmdata['detail']->mode_ofpayment:'N/A'?>
                    </div>
                     <div class="col-md-4 mb10">
                        <b>Notes: </b>
                        <?php echo (isset ($frmdata['detail']->notes) and !empty ($frmdata['detail']->mode_ofpayment))? $frmdata['detail']->notes:'N/A'?>
                    </div>
                     <div class="col-md-4 mb10">
                        <b>NDA Required:</b>
                        <?php echo (isset ($frmdata['detail']->nda_required) and !empty ($frmdata['detail']->mode_ofpayment))? $frmdata['detail']->nda_required:'N/A'?>
                    </div>
                     <div class="col-md-4 mb10">
                        <b>Term & Conditions:</b>
                        <?php echo (isset ($frmdata['detail']->term_conditions) and !empty ($frmdata['detail']->mode_ofpayment))? $frmdata['detail']->term_conditions:'N/A'?>
                    </div>
                     <div class="col-md-4 mb10">
                        <b>Service Tax Charges: </b>
                        <?php echo (isset ($frmdata['detail']->service_tax_charges) and !empty ($frmdata['detail']->mode_ofpayment))? $frmdata['detail']->service_tax_charges:'N/A'?>
                    </div>
                 </div>
                </div>
                 <div class="greyborder">
                 <div class="panel-body">
                     <fieldset>
                        <div class="frm-row">
                           <div class="col-md-4 col-sm-4 col-xs-12">
                              <h4><label><b>Transportation Condition</b></label></h4>
                           </div>
                           <!-- <div class="col-md-3 col-sm-3 col-xs-12">
                              <h4><label>N/A</label></h4>
                           </div> -->
                           <div class="col-md-4 col-sm-4 col-xs-12">
                              <h4><label><b>Client</b></label></h4>
                           </div>
                           <div class="col-md-4 col-sm-4 col-xs-12">
                              <h4><label><b>MLA</b></label></h4>
                           </div>
                        </div>
                        <?php //echo "<pre>";print_r($frmdata['transports']);
                        //print_r($frmdata['dttrans']);die;?>
                        <?php foreach ($frmdata['transports'] as $key => $value) {

                          if(isset($frmdata['dttrans']) and isset($frmdata['dttrans'][$key]) and $frmdata['dttrans'][$key]!='n'){
                           //echo "<pre>";print_r($value);die;?>
                        <div class="frm-row">
                           <div class="col-md-4 col-sm-4 col-xs-12">
                              <?php echo $value;?>
                           </div>
                           <!-- end section -->
                           <!-- <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="areon">
                                 <?php //echo ($frmdata['dttrans'][$key]=='n')?'YES':'--';?>
                              </div>
                           </div> -->
                           <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="areon">
                                 <?php echo ($frmdata['dttrans'][$key]=='c')?'YES':'--';;?>
                              </div>
                           </div>
                           <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="areon">
                                 <?php echo ($frmdata['dttrans'][$key]=='m')?'YES':'--';;?>
                              </div>
                           </div>
                        </div>
                        <?php }
                        }?>
                        <!-- end section --> 
                        <!-- end frm-row section -->
                        <!-- end frm-row section -->
                        <!-- end section -->
                     </fieldset>
                  </div>
                </div>
                </div>
            </div>
            
            <div class="panel panel-primary">
                 <div class="panel-heading" role="tab" id="headingTwo">
                 	<a class="collapsed faq-links" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <div class="panel-title"> 
                            DIAGNOSE LISTING
                            <span class="addingflip pull-right fa fa-plus fa-2x"></span>
                          </div>
                     </a>
                </div>
               
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                
                
          <?php 

					 if(isset($frmdata['diagonoesdetail']) and (count($frmdata['diagonoesdetail'])>0)){
					 foreach($frmdata['diagonoesdetail'] as $k=>$diagonoses){ //echo "<pre>"; print_r($diagonoses->id);die;?>
                    	<div class="greyborder">
                        <div class="panel-body">
                        <!--<div class="col-md-4 mb10">
                          <b>Diagnose Id:</b>
                           <?php echo $diagonoses->id;?>
                          
                        </div>-->
                        <!--<div class="col-md-4 mb10">
                            <b> Order Id:</b>
                            <?php echo $diagonoses->order_id;?>
                        </div>-->
                        <div class="col-md-4 mb10">
                           <b>Sub-Product:</b>
                            <?php echo $diagonoses->name;?>
                        </div>
                        
                        <div class="col-md-4 mb10">
                           <b>Weight:</b>
                            <?php echo $diagonoses->weight;?>
                        </div>
                        <div class="col-md-4 mb10">
                           <b>Units:</b>
                            <?php echo $diagonoses->units;?>
                        </div>
                        
                        <div class="col-md-4 mb10">
                           <b>Co-Ordinator:</b>
                            <?php echo $diagonoses->coordinator;?>
                        </div>
                        
                         <div class="col-md-4 mb10">
                           <b>Start Date:</b>
                            <?php echo date("jS M, Y", strtotime($diagonoses->start_date));?>
                        </div>
                        <div class="col-md-4 mb10">
                           <b>End Date:</b>
                            <?php echo date("jS M, Y", strtotime($diagonoses->end_date));?>
                        </div>
                        
                        <div class="col-md-4 mb10">
                           <b>Email:</b>
                            <?php echo $diagonoses->email_id;?>
                        </div>
                        <div class="col-md-4 mb10">
                           <b>Resources:</b>
                          <?php 
                           if(count($frmdata['diagonoesresources'])>0){
                             $i=1;
                            foreach($frmdata['diagonoesresources'] as $k=>$resources){

                            if( $diagonoses->id == $resources->id)
                               {
                                  echo $resources->resources; 
                                  if(count($frmdata['diagonoesresources'])>$i){ echo ',';}
                               }
                             $i++;
                            } } 
                          ?>
                        </div> 
                   <div class="clearfix"></div> 
                </div>
                </div>
                <?php } 
					 }else
					 {
						 echo '<div class="text-center">No Any Record Available Here!</div>';
					 }
					 ?>
             
               </div>
            </div>
                
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingThree">
                	<a class="collapsed faq-links" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                   	 <div class="panel-title"> 
                         DESIGN LISTING
                         <span class="addingflip pull-right fa fa-plus fa-2x"></span>
                     </div>
                    </a>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                	
                 <?php 
               
              
				 	 if(isset($frmdata['getdesigndetail']) and (count($frmdata['getdesigndetail'])>0)){
				   foreach($frmdata['getdesigndetail'] as $k=>$design){?>
                	<div class="greyborder">
                    <div class="panel-body">
                        <!--<div class="col-md-4 mb10">
                            <b>Design Id: </b>
                            <?php echo $design->id;?>  
                        </div>                                    
                        <div class="col-md-4 mb10">
                            <b>Order Id: </b>
                            <?php echo $design->order_id;?>
                        </div>-->
                        <div class="col-md-4 mb10">
                            <b>Sub-Product : </b>
                            <?php echo $design->name;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Weight: </b>
                            <?php echo $design->weight;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Units: </b>
                            <?php echo $design->units;?>
                        </div>
                        
                        <div class="col-md-4 mb10">
                            <b>Co-Ordinator: </b>
                            <?php echo $design->coordinator;?>
                        </div>
                        
                        <div class="col-md-4 mb10">
                            <b>Start Date : </b>
                            <?php echo date("jS M, Y", strtotime($design->start_date))?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>End Date : </b>
                            <?php echo date("jS M, Y", strtotime($design->end_date))?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Email: </b>
                            <?php echo $design->email_id?>
                        </div>
                         <div class="col-md-4 mb10">
                            <b>Resources: </b>
                         <?php 
                           if(count($frmdata['getdesignresources'])>0){
                            
                            foreach($frmdata['getdesignresources'] as $k=>$resources){
                               $i=1;
                            if( $design->id == $resources->id)
                               {
                                  echo $resources->resources; 
                                  if(count($frmdata['getdesignresources'])>$i){ echo ',';}
                                  //rtrim(echo ',');
                               }
                             $i++;
                            } } 
                          ?>
                          </div>
                       <div class="clearfix"></div>  
                    </div>
                    </div>
                    <?php } 
					 }else
					 {
						 echo '<div class="text-center">No Any Record Available Here!</div>';
					 }
					 ?>
             
                </div>
            </div>
                  
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingFour">
                	<a class="collapsed faq-links" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                         <div class="panel-title"> 
                             DELIVERY LISTING
                             <span class="addingflip pull-right fa fa-plus fa-2x"></span>
                         </div>
                    </a>
                </div>
                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                	
                <?php 
               
                
					if(isset($frmdata['getdeliverydetail']) and (count($frmdata['getdeliverydetail'])>0)){
          
				  foreach($frmdata['getdeliverydetail'] as $k=>$delivery){
            //echo "<pre>";print_r($delivery);
            //echo "<pre>";print_r($this->auth->getUserId());
            //foreach($frmdata['getdeliveryresources'] as $k=>$resources){
            if($delivery->uid==$this->auth->getUserId()){
              //die('hgbyuhiuh');

            ?>

                	<div class="greyborder">
                    <div class="panel-body">
                        <!--<div class="col-md-4 mb10">
                            <b>Delivery id: </b>
                            <?php echo $delivery->id;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Order id: </b>
                            <?php echo $delivery->order_id;?>
                        </div>-->
                        <div class="col-md-4 mb10">
                            <b>Sub-Products: </b>
                            <?php echo $delivery->name;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Weight: </b>
                            <?php echo $delivery->weight?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Units: </b>
                            <?php echo $delivery->units;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Co-Ordinator: </b>
                            <?php echo $delivery->coordinator;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Start Date: </b>
                            <?php echo date("jS M, Y", strtotime($delivery->start_date))?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>End Date: </b>
                            <?php echo date("jS M, Y", strtotime($delivery->end_date))?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Email: </b>
                            <?php echo $delivery->email_id?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Resources: </b>
                         <?php 
                           if(count($frmdata['getdeliveryresources'])>0){
                            
                            foreach($frmdata['getdeliveryresources'] as $k=>$resources){
                               $i=1;
                               //echo "___<pre>";print_r($resources);die;
                            if( $delivery->id == $resources->id)
                               {
                                  echo $resources->resources; 
                                  if(count($frmdata['getdeliveryresources'])>$i){ echo ',';}
                               }
                             $i++;
                            } 
                          } 
                          ?>
                          </div>
                          <div class="col-md-4 mb10">
                           <b>Delivered Product:</b>
                          <?php 
                          if(isset($delivery->deliverdproduct) and count($delivery->deliverdproduct)>0)
                          echo implode(",",$delivery->deliverdproduct);
                          else
                            echo "N/A";
                           
                          ?>
                        </div>  
<!--                        <div class="col-md-4 mb10">
                            <b><a class="btn btn-success" href="<?php echo site_url('order/ourTimeSlot'.'/'.$delivery->id.'/'.$delivery->order_id.'/'.$delivery->uid) ?>">Time Slot</a><a class="btn btn-success" href="<?php echo site_url('order/ourUserCall'.'/'.$delivery->id.'/'.$delivery->order_id.'/'.$delivery->uid) ?>">Call User</a>
                           
                        </div>-->
                         <div class="col-md-4 mb10">
                            <b>
                           
                        </div>
                    <div class="clearfix"></div>  
                    </div>
                    </div>
                    <?php } }
					 }else
					 {
						 echo '<div class="text-center">No Any Record Available Here!</div>';
					 }
					 ?>
                </div>
                
            </div>
            
            <div class="panel panel-primary">
            	<div class="panel-heading" role="tab" id="headingFive">
                	<a class="collapsed faq-links" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                         <div class="panel-title"> 
                             DISCOVERY LISTING
                             <span class="addingflip pull-right fa fa-plus fa-2x"></span>
                         </div>
                    </a>
                </div>
                 <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
               
                <?php 
                // echo "<pre>"; print_r($frmdata['getdiscoveryresources']);
              //  echo "<pre>"; print_r($frmdata['getdeliverydetail']);die;
                
					if(isset($frmdata['getdiscoverydetail']) and (count($frmdata['getdiscoverydetail'])>0)){
				 foreach($frmdata['getdiscoverydetail'] as $k=>$discovery) { ?>
                    <div class="greyborder">
                     <div class="panel-body">
                       <!-- <div class="col-md-4 mb10">
                            <b>Delivery id: </b>
                            <?php echo $discovery->id;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Order id: </b>
                            <?php echo $discovery->order_id;?>
                        </div>-->
                        <div class="col-md-4 mb10">
                            <b>Sub-Products: </b>
                            <?php echo $discovery->name;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Weight: </b>
                            <?php echo $discovery->weight?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Units: </b>
                            <?php echo $discovery->units;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Co-Ordinator: </b>
                            <?php echo $discovery->coordinator;?>
                        </div>
                       
                        <div class="col-md-4 mb10">
                            <b>Start Date: </b>
                            <?php echo date("jS M, Y", strtotime($discovery->start_date));?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>End Date: </b>
                            <?php echo date("jS M, Y", strtotime($discovery->end_date));?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Email: </b>
                            <?php echo $discovery->email_id?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Resources: </b>
                         <?php 
                           if(count($frmdata['getdiscoveryresources'])>0){
                            
                            foreach($frmdata['getdiscoveryresources'] as $k=>$resources){
                               $i=1;
                            if( $discovery->id == $resources->id)
                               {
                                  echo $resources->resources; 
                                  if(count($frmdata['getdiscoveryresources'])>$i){ echo ',';}
                               }
                             $i++;
                            } } 
                          ?>
                          </div>
                        <div class="clearfix"></div>  
                    </div>
                    </div> 
                     <?php } 
					 }else
					 {
						 echo '<div class="text-center">No Any Record Available Here!</div>';
					 }
					 ?>
                </div>
                
            </div>
		</div>
    <script>
$(document).ready(function () {
	 $('.faq-links').click(function(){
		 var collapsed=$(this).find('.panel-title > span').hasClass('fa-plus');
		$('.faq-links').find('.panel-title > span').removeClass('fa-minus');
	
	   $('.faq-links').find('.panel-title > span').addClass('fa-plus');
		
		 if(collapsed)
		$(this).find('.panel-title > span').toggleClass('fa-plus fa-2x fa-minus fa-2x')
     });
});

	 </script>        