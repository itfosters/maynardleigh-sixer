<?php //echo "<pre>";print_r($frmdata['detail']);die;?>
   <div class="smart-wrap">
      <div class="smart-forms  wrap-1">
         <div class=" smart-steps">
                <div class="" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-primary rose">
                     <div class="panel-heading" role="tab" id="headingOne">
                     <div class="panel-title">Welcome Order 
                              <span class="addingflip pull-right fa fa-plus fa-2x"></span>
                              </div>
                           </a>
                       </div>
                     <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                         <fieldset>
                           <div class="frm-row">
                             
                              <div class="section colm colm6">
                                 <h4> <label>Name Of Client</label></h4>
                                 <label class="field prepend-icon">
                                 
                                 <div><?php echo $frmdata['detail']->client_name?></div>
                              </div>
                              
                              <div class="section colm colm6">
                                 <h4> <label>Sales By</label></h4>
                                 <label class="field prepend-icon">
                                  <div><?php echo $frmdata['detail']->seller_name?></div>
                                 <!-- Modal --> 
                              </div>
                           </div>
                           <!-- Modal -->
                           <div class="frm-row">
                              
                              <div class="section colm colm6">
                                 <h4> <label>Project Manager</label></h4>
                                 <label class="field prepend-icon">
                                 
                                 <div><?php echo $frmdata['detail']->manager_name?></div>
                              <!-- model end --> 
                           </div>
                           </fieldset>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-primary rose">
                     <div class="panel-heading" role="tab" id="headingTwo">
                        
                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> 
                          <div class="panel-title"> Economic Buyer
                              <span class="addingflip pull-right fa fa-plus fa-2x"></span>
                              </div>
                           </a>
                        
                     </div>
                     <!-- <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo"> -->
                        <div class="panel-body">
                           <fieldset>
                              <div class="main_boxes" id="e_buyer">
                                 <div class="rows">
                                    <div class="frm-row"  >
                                       <div class="section colm colm6">
                                          <h4> <label>First Name</label></h4>
                                          <label class="field prepend-icon">
                                         <div><?php echo $frmdata['detail']->first_name?></div>                                        
                                                                                     </label>
                                       </div>
                                       <!-- end section -->
                                       <div class="section colm colm6">
                                          <h4> <label>Last Name</label></h4>
                                          <label class="field prepend-icon">
                                             <!-- <input type="text" name="Last_Name" id="Last_Name" class="gui-input" placeholder="Last Name"> -->
                                             <div><?php echo $frmdata['detail']->last_name?></div>
                                          </label>
                                       </div>
                                       <!-- end section --> 
                                    </div>
                                    <!-- end frm-row section -->
                                    <div class="frm-row">
                                       <div class="section colm colm6">
                                          <h4> <label>Location</label></h4>
                                          <label class="field prepend-icon">
                                            <div><?php echo $frmdata['detail']->location?></div>
                                          </label>
                                       </div>
                                      
                                       <!-- end section --> 
                                    </div>
                                    <div class="frm-row">
                                       <div class="section colm colm6">
                                          <h4> <label>Contact No</label></h4>
                                          <label class="field prepend-icon">
                                            <div><?php echo $frmdata['detail']->contact_No?></div>
                                          </label>
                                       </div>
                                       <!-- end section -->
                                       <div class="section colm colm6">
                                          <h4> <label>Email</label></h4>
                                          <label class="field prepend-icon">
                                             <!-- <input type="email" name="Email" id="Email" class="gui-input" placeholder="Email"> -->
                                            <div><?php echo $frmdata['detail']->email_Id?></div>
                                          </label>
                                       </div>
                                       <!-- end section --> 
                                    </div>
                                 </div>
                              </div>
                            
                           </fieldset>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-primary rose">
                     <div class="panel-heading" role="tab" id="headingThree">
                        
                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                             <div class="panel-title"> Address For Billing
                              <span class="addingflip pull-right fa fa-plus fa-2x"></span>
                               </div>
                           </a>
                       
                     </div>
                     <!-- <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree"> -->
                        <div class="panel-body">
                           <fieldset>
                              <div class="main_boxes" id="p_scents4">
                                 <div class="rows">
                                    <div class="frm-row">
                                       <div class="section colm colm6">
                                          <h4> <label>Street</label></h4>
                                          <div><?php echo $frmdata['detail']->street?></div>
                                       </div>
                                       <!-- end section -->
                                       <div class="section colm colm6">
                                          <!-- <h4> <label>State</label></h4> -->
                                          <label class="field prepend-icon">
                                                             </label>
                                       </div>
                                       <!-- end section --> 
                                    </div>
                                    <!-- end frm-row section -->
                                    <div class="frm-row">
                                       <div class="section colm colm6">
                                         <!--  <h4> <label>Country</label></h4> -->
                                          <label class="field prepend-icon">
                                             <!-- <select class="form-control">
                                                <option selected="selected">Country </option>
                                                <option>India</option>
                                                <option>Pakistan</option>
                                                <option>Australia</option>
                                                <option>Hong Kong</option>
                                                </select> -->
                                             <?php //echo form_dropdown('acountry', $country,'', 'class="form-control" id="name_of_state"');?>
                                          </label>
                                       </div>
                                       <!-- end section -->
                                       <div class="section colm colm6">
                                          <!-- <h4> <label>City</label></h4> -->
                                          <label class="field prepend-icon">
                                             <!-- <select class="form-control">
                                                <option selected="selected">City</option>
                                                <option>Allahabad</option>
                                                <option>Noida</option>
                                                <option>Delhi</option>
                                                <option>bhopal</option>
                                                </select> -->
                                             <?php //echo form_dropdown('acity', $salesBy,'', 'class="form-control" id="name_of_state"');?>
                                          </label>
                                       </div>
                                       <!-- end section --> 
                                    </div>
                                    <!-- end frm-row section -->
                                    <div class="section spacer-b40">
                                       <div class="spacer-b15"> </div>
                                       <!-- end .spacer -->
                                       <div class="section colm colm6 hight">
                                          <h4> <label>Pin Code</label></h4>
                                          <label class="field prepend-icon">
                                             <!-- <input type="text" name="Pin_code" id="Pin_code" class="gui-input" placeholder="Pin code"> -->
                                             <div><?php echo $frmdata['detail']->pincode?></div>
                                          </label>
                                       </div>
                                       <!-- end .slider-wrapper --> 
                                    </div>
                                    <!-- end section --> 
                                    <!-- end section --> 
                                 </div>
                              </div>
                              <!-- <h2><a href="#" id="addScnt4"><i class="fa fa-plus fa-1x text1"></i></a></h2> -->
                           </fieldset>
                        </div>
                     </div>
                  </div>
               </div>
            
            <!-- first feildset ended -->
            <!-- second feildset started from here -->
            
               <div aria-multiselectable="true" role="tablist" id="accordion" class="">
                  
                  
                  <!-- terms and condition part started -->
                  <div class="panel panel-primary rose">
                     <div class="panel-heading" role="tab" id="headingThree">
                       
                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapseThree">
                              <div class="panel-title">Terms & Conditions
                              <span class="addingflip pull-right fa fa-plus fa-2x"></span> </div>
                           </a>
                     </div>
                     <!-- <div aria-expanded="false" id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree"> -->
                        <div class="panel-body">
                           <fieldset>
                              <div class="frm-row">
                                 <div class="section colm colm6">
                                  <h4><label>Price Validity</label></h4>
                                    <div class="input-group date" id="example3">
                                       <!-- <input type="text" class="form-control" placeholder="Price Validity" /> -->
                                       <div><?php echo $frmdata['detail']->price_validity?></div>
                                    </div>
                                 </div>
                                 <!-- end section -->
                                 <div class="section colm colm6">
                                   <h4> <label>Cancellation Clouse</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <input type="text" name="Last_Name" id="Last_Name" class="gui-input" placeholder="Cancellation clouse"> -->
                                       <div><?php echo $frmdata['detail']->cancellation_clouse?></div>
                                    </label>
                                 </div>
                                 <!-- end section --> 
                              </div>
                              <!-- end frm-row section -->
                              <div class="frm-row">
                              
                                 <!-- end section -->
                                 <div class="section colm colm6">
                                    <h4><label>Blanket Contract No</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <input type="text" name="Designation" id="Designation" class="gui-input" placeholder="Blanket contract No"> -->
                                       
                                       <div><?php echo $frmdata['detail']->contract_no?></div>
                                    </label>
                                 </div>
                                 <!-- end section --> 
                              </div>
                              <!-- end frm-row section -->
                              
                              <!-- end section -->
                              <div class="frm-row">
                                 <!-- <div class="section colm colm6 hight">
                                   <label>Logistice handled By</label>
                                    <label class="field prepend-icon">
                                       <select class="form-control" id="name_of_client">
                                          <option selected="selected" value="">Logistice handled By</option>
                                          <option value="Mia">Mia </option>
                                          <option value="Client">Client</option>
                                          </select>
                                       <?php $data=array('name'=>'tchandledby',
                                          'class'=>'gui-input',
                                          'placeholder'=>'Logistice handled By'
                                 
                                          );
                                          echo form_input($data);
                                          ?>
                                    </label>
                                 </div> -->
                                 <div class="section colm colm6 hight">
                                    <h4><label>Payment Cycle</label></h4>
                                    <!-- <input type="text"  placeholder="Payment cycle" name="payment cycle" class="form-control" /> -->
                                     
                                    <div><?php echo $frmdata['detail']->payment_cycle?></div>
                                    
                                 </div>
                                 
                              <div class="frm-row">
                                 
                                 <!-- <div class="section colm colm6">
                                    <label class="field prepend-icon" name="payment">Payment Terms: &nbsp; Net 30</label>
                                 </div> -->
                                 
                                 <div class="section colm colm6 hight">
                                   <h4><label>Mode Of Payment</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <select class="form-control" id="name_of_client">
                                          <option selected="selected" value="">Mode of Payment</option>
                                          <option value="cheque">Cheque </option>
                                          <option value="neft">NEFT</option>
                                          </select> -->
                                        <div><?php echo $frmdata['detail']->mode_ofpayment?></div>
                                    </label>
                                 </div>
                              </div>
                              <div class="frm-row">
                                 
                                 
                              </div>
                           </fieldset>
                        </div>
                     </div>
                  </div>
                  <!-- terms end here -->
                 
                 




