<?php //echo "!!<pre>";print_r($frmdata);die;
		//echo "@@<pre>";print_r($frmdata['diagonoesdetail'])."<hr></hr>";
		
		//echo "^^<pre>";print_r($frmdata['getdesigndetail'])."<hr></hr>";
		//echo "##<pre>";print_r($frmdata['getdeliverydetail'])."<hr></hr>";
		//echo "&&<pre>";print_r($frmdata['getdiscoverydetail']);die;



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
                        <b>Pin Code: </b>
                        <?php echo (isset($frmdata['detail']->pincode) and !empty($frmdata['detail']->pincode))? $frmdata['detail']->pincode: 'N/A'?>
                    </div>
                </div>
                </div>
                 <div class="greyborder">
                <div class="panel-body">
                    <div class="sub-title"> 
                        Document Upload
                    </div>
                    <div class="col-md-6 mb10">
                        <b>Title </b>
                        <?php //echo (isset($frmdata['detail']->street)and !empty($frmdata['detail']->street))? $frmdata['detail']->street: 'N/A'?>
                    </div>
                    <div class="col-md-6 mb10">
                        <b>Download</b>
                        <?php //echo (isset($frmdata['detail']->pincode) and !empty($frmdata['detail']->pincode))? $frmdata['detail']->pincode: 'N/A'?>
                    </div>
                    <?php foreach ($frmdata['document'] as $key => $value) {?>
                        <div class="frm-row" id="p_scents">
                           <div class="rows clearfix">
                              <div class="section colm colm6">
                                 <div class="col-md-12">
                                    <div class="col-md-6">
                                       <label><?php echo $value;?></label>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="file_download_wrapper ">
                                          <input type="" id="file_browse" name='<?php echo "documents[".$key."]";?>'>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php }?>
                </div>
                </div>
                
                <div class="greyborder"	>
                <div class="panel-body">
                    <div class="sub-title">
                        Terms & Conditions
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Price Validity:</b>
                        <?php echo (isset($frmdata['detail']->price_validity) and !empty($frmdata['detail']->pincode))? $frmdata['detail']->pincode: 'N/A'?>
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
                        <?php echo (isset ($frmdata['detail']->mode_ofpayment) and !empty ($frmdata['detail']->payment_cycle))? $frmdata['detail']->payment_cycle:'N/A'?>
                    </div>
                 </div>
                </div>
                 <div class="greyborder">
                 <div class="panel-body">
                     <fieldset>
                        <div class="frm-row">
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <h4><label>Transportation Condition</label></h4>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <h4><label>N/A</label></h4>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <h4><label>Client</label></h4>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <h4><label>MLA</label></h4>
                           </div>
                        </div>
                        <?php //echo "<pre>";print_r($transports);die;?>
                        <?php foreach ($frmdata['transports'] as $key => $value) {
                           //echo "<pre>";print_r($value);die;?>
                        <div class="frm-row">
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <label><?php echo $value;?></label>
                           </div>
                           <!-- end section -->
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="areon">
                                 <input type="radio" name="<?php echo "transport[".$key."]"?>" value="n" 
                                    <?php //echo set_radio('',''); ?> />
                              </div>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="areon">
                                 <input type="radio" name="<?php echo "transport[".$key."]"?>" value="c" 
                                    <?php //echo set_radio('',''); ?> />
                              </div>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="areon">
                                 <input type="radio" name="<?php echo "transport[".$key."]"?>" value="m" 
                                    <?php //echo set_radio('','',true); ?> /> 
                              </div>
                           </div>
                        </div>
                        <?php }?>
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
					// echo "<pre>"; print_r($frmdata['diagonoesdetail']);die;
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
                           <b>Details:</b>
                            <?php echo $diagonoses->details;?>
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
                           <b>Cunsultant:</b>
                            <?php echo $diagonoses->cunsultant;?>
                        </div>
                        
                         <div class="col-md-4 mb10">
                           <b>Start Date:</b>
                            <?php echo $diagonoses->start_date;?>
                        </div>
                        <div class="col-md-4 mb10">
                           <b>End Date:</b>
                            <?php echo $diagonoses->end_date;?>
                        </div>
                        
                        <div class="col-md-4 mb10">
                           <b>Email:</b>
                            <?php echo $diagonoses->email_id;?>
                        </div>
                   <div class="clearfix"></div> 
                </div>
                </div>
                 	<?php } 
					 }else
					 {
						 echo "No Record Found";
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
                            <b>Details : </b>
                            <?php echo $design->details;?>
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
                            <b>Cunsultant: </b>
                            <?php echo $design->cunsultant;?>
                        </div>
                        
                        <div class="col-md-4 mb10">
                            <b>Start Date : </b>
                            <?php echo $design->start_date?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>End Date : </b>
                            <?php echo $design->end_date?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Email: </b>
                            <?php echo $design->email_id?>
                        </div>
                       <div class="clearfix"></div>  
                    </div>
                    </div>
                    <?php } 
					 }else
					 {
						 echo "No Record Found";
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
				  foreach($frmdata['getdeliverydetail'] as $k=>$delivery){?>
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
                            <b>Details: </b>
                            <?php echo $delivery->details;?>
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
                            <b>Cunsultant: </b>
                            <?php echo $delivery->cunsultant;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Start Date: </b>
                            <?php echo $delivery->start_date?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>End Date: </b>
                            <?php echo $delivery->end_date?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Email: </b>
                            <?php echo $delivery->email_id?>
                        </div>
                    <div class="clearfix"></div>  
                    </div>
                    </div>
                    <?php } 
					 }else
					 {
						 echo "No Record Found";
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
                            <b>Details: </b>
                            <?php echo $discovery->details;?>
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
                            <b>Cunsultant: </b>
                            <?php echo $discovery->cunsultant;?>
                        </div>
                       
                        <div class="col-md-4 mb10">
                            <b>Start Date: </b>
                            <?php echo $discovery->start_date?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>End Date: </b>
                            <?php echo $discovery->end_date?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Email: </b>
                            <?php echo $discovery->email_id?>
                        </div>
                        <div class="clearfix"></div>  
                    </div>
                    </div> 
                     <?php } 
					 }else
					 {
						 echo "No Record Found";
					 }
					 ?>
                </div>
                
            </div>
		</div>
     <a target='_blank' href="<?php echo site_url('contract_accept/index/'.$frmdata['detail']->id)?>" class="btn btn-primary" >View Contract</a>  
     
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