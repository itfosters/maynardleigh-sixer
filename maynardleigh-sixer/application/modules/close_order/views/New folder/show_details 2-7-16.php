<?php //echo "<pre>";print_r($frmdata['diagonoesdetail'][0]->order_id);die;?>
   

        <div class="" id="accordion" role="tablist" aria-multiselectable="true">    
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingOne">
                	<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
                    <div class="col-md-4 mb10">
                      <b> Name Of Client:</b>
                       <?php echo $frmdata['detail']->client_name?>
                      
                    </div>
                    <div class="col-md-4 mb10">
                        <b> Sales By:</b>
                        <?php echo $frmdata['detail']->seller_name?>
                    </div>
                    <div class="col-md-4 mb10">
                       <b>Project Manager:</b>
                        <?php echo $frmdata['detail']->manager_name?>
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
                        <?php echo $frmdata['detail']->first_name?>  
                    </div>                                    
                    <div class="col-md-4 mb10">
                        <b>Last Name: </b>
                        <?php echo $frmdata['detail']->last_name?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Location: </b>
                        <?php echo $frmdata['detail']->location?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Contact No: </b>
                        <?php echo $frmdata['detail']->contact_No?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Email: </b>
                        <?php echo $frmdata['detail']->email_Id?>
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
                        <?php echo $frmdata['detail']->street?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Pin Code: </b>
                        <?php echo $frmdata['detail']->pincode?>
                    </div>
                </div>
                </div>
                
                <div class="greyborder"	>
                <div class="panel-body">
                    <div class="sub-title">
                        Terms & Conditions
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Price Validity:</b>
                        <?php echo $frmdata['detail']->price_validity?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Cancellation Clouse: </b>
                        <?php echo $frmdata['detail']->cancellation_clouse?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Blanket Contract No: </b>
                        <?php echo $frmdata['detail']->contract_no?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Payment Cycle: </b>
                        <?php echo $frmdata['detail']->payment_cycle?>
                    </div>
                    <div class="col-md-4 mb10">
                        <b>Mode Of Payment: </b>
                        <?php echo $frmdata['detail']->mode_ofpayment?>
                    </div>
                 </div>
                </div>
                </div>
            </div>
            
            <div class="panel  panel-primary">
                <div class="title bluebg">
                   DIAGNOSE LISTING
                </div>
                <?php foreach($frmdata['diagonoesdetail'] as $k=>$diagonoses){ //echo "<pre>"; print_r($diagonoses->id);die;?>
                
                	<div class="panel-body">
                    <div class="greyborder">
                        <div class="col-md-4 mb10">
                          <b>Diagnose Id:</b>
                           <?php echo $diagonoses->id;?>
                          
                        </div>
                        <div class="col-md-4 mb10">
                            <b> Order Id:</b>
                            <?php echo $diagonoses->order_id;?>
                        </div>
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
                <?php } ?>
            </div>
                
            <div class="panel panel-primary">
                <div class="title bluebg"> 
                DESIGN LISTING
                </div>
                <div class="panel-body">
                 <?php foreach($frmdata['getdesigndetail'] as $k=>$design){?>
                	<div class="greyborder">
                        <div class="col-md-4 mb10">
                            <b>Design Id: </b>
                            <?php echo $design->id;?>  
                        </div>                                    
                        <div class="col-md-4 mb10">
                            <b>Order Id: </b>
                            <?php echo $design->order_id;?>
                        </div>
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
                            <b>No. Of Casting: </b>
                            <?php echo $design->no_ofcasting?>
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
                    <?php } ?>
                </div>
            </div>
                  
            <div class="panel panel-primary">
                <div class="title bluebg"> 
                    DELIVERY LISTING
                </div>
                <div class="panel-body">
                <?php foreach($frmdata['getdeliverydetail'] as $k=>$delivery){?>
                	<div class="greyborder">
                        <div class="col-md-4 mb10">
                            <b>Delivery id: </b>
                            <?php echo $delivery->id;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Order id: </b>
                            <?php echo $delivery->order_id;?>
                        </div>
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
                            <b>No. Of Casting: </b>
                            <?php echo $delivery->no_ofcasting;?>
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
                    <?php } ?>
                </div>
            </div>
            
            <div class="panel panel-primary">
                <div class="title bluebg">
                	DISCOVERY LISTING
                </div>
                <div class="panel-body">
                <?php foreach($frmdata['getdiscoverydetail'] as $k=>$discovery) { ?>
                    <div class="greyborder">
                        <div class="col-md-4 mb10">
                            <b>Delivery id: </b>
                            <?php echo $discovery->id;?>
                        </div>
                        <div class="col-md-4 mb10">
                            <b>Order id: </b>
                            <?php echo $discovery->order_id;?>
                        </div>
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
                            <b>No. Of Casting: </b>
                            <?php echo $discovery->no_ofcasting;?>
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
                    <?php }?>  
                </div>
            </div>
		</div>
                 
                 




