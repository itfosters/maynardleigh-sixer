<?php
   //echo "@@@<pre>";print_r($dttrans); die;
   //echo "###<pre>";print_r($dtdoc['docview']);die;
   //echo "##<pre>";print_r($dttrans['transview']);die; 
     $yesno=array(''=>'Select NDA Required',
                  'Yes'=>'Yes',
                   'No'=>'No');
     $mod_ofpayment=array(''=>'Select Mode Of Payment',
                          'Cheque'=>'Cheque',
                           'NEFT'=>'NEFT',
                           'Online gateway'=>'Online Gateway');
     $noofcasting=array('0'=>'1',
                          '1'=>'2',
                          '2'=>'3',
                          '3'=>'4',
                          '4'=>'5',
                          '5'=>'6',
                          '6'=>'7',
                          '7'=>'8',
                          '8'=>'9');
     $payment=array(''=>'Select Payment Cycle',
                    'Monthly'=>'Monthly',
                    'Yearly'=>'Yearly');
      ?>
<div class="smart-wrap">
   <div class="smart-forms  wrap-1">
      <div class=" smart-steps">
         <?php $id=isset($frmdata['orderdata']->id)?$frmdata['orderdata']->id:'';?>
         <?php //echo form_open_multipart("",array("id"=>"order","class"=>"form-bordered")); ?>
         <?php 
         $attributes = array('id' => 'orderform');
         echo form_open_multipart("admin/order/add_order"."/".$id,$attributes); ?>
         <div class="" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-primary rose">
               <div class="panel-heading" role="tab" id="headingOne">
                  <a class="faq-links" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
                     <div class="panel-title">Welcome Order 
                        <span class="addingflip pull-right fa fa-minus fa-2x"></span>
                     </div>
                  </a>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                     <fieldset>
                        <div class="frm-row">
                           <!--<div class="section colm colm6">
                              <h4><label>Order Id</label></h4>
                              <label class="field prepend-icon">
                              
                                 <?php 
                                 $data=array(
                                               'name'=>'Order_Id',
                                               'class'=>'gui-input',
                                               'placeholder'=>'Order Id',
                                               'readonly'=>'true'
                                               
                                              );
                                            echo form_input($data);
                                 
                                 
                                 ?>
                              </label>
                              </div>-->
                           <!-- end section -->
                           <div class="section colm colm6">
                              <h4> <label>Name Of Client</label></h4>
                              <label class="field prepend-icon">
                              <?php //echo "<pre>";print_r($clients[0]);die;?>
                              <?php echo form_dropdown('client',$clients,isset($frmdata['orderdata']->client_id)?$frmdata['orderdata']->client_id:"", 'class="form-control" id="name_of_client"');
                              //echo "<pre>";print_r($r);die;
                              echo form_error('client');
                              ?>
                              </label>
                              <div id="add_name_of_client" class="plus margin_top20" style="display: none;" >
                                 <a data-target="#myModal" data-toggle="modal" href="#itf">
                                 <i class="fa fa-plus fa-2x text1"></i></a>
                              </div>
                           </div>
                           <div class="section colm colm6">
                              <h4> <label>Sales By</label></h4>
                              <label class="field prepend-icon">
                              <?php //echo "<pre>";print_r($salesBy);die;?>
                              <?php echo form_dropdown('Sales', $salesBy,isset($frmdata['orderdata']->sales_by_id)?$frmdata['orderdata']->sales_by_id:"", 'class="form-control" id="name_of_seller"');
                                  echo form_error('Sales');
                              ?>
                              </label>
                              <div class="plus margin_top20" id="add_select_sales_by" style="display: none;"> 
                                 <a href="#itf" data-toggle="modal" data-target="#myModal1">
                                 <i class="fa fa-plus fa-2x text1"></i></a> 
                              </div>
                              <!-- Modal --> 
                           </div>
                        </div>
                        <!-- Modal -->
                        <div class="frm-row">
                           <div class="section colm colm6">
                              <h4> <label>Project Manager</label></h4>
                              <label class="field prepend-icon">
                              <?php //echo "<pre>";print_r($manager);die;?>
                              <?php echo form_dropdown('manager',$manager,isset($frmdata['orderdata']->pm_id)?$frmdata['orderdata']->pm_id:"","class='form-control' id='name_of_manager'");
                                    echo form_error('manager');
                              ?>
                              </label>
                              <div id="add_select_project_manager" class="plus margin_top20" style="display: none;"> 
                                 <a href="#" data-toggle="modal" data-target="#myModal2">
                                 <i class="fa fa-plus fa-2x text1"></i></a> 
                              </div>
                              <!-- model --> 
                           </div>
                           <!-- model end --> 
                           <div class="section colm colm6">
                              <h4> <label>Team</label></h4>
                              <label class="field prepend-icon">
                              <?php //echo "<pre>";print_r($manager);die;?>
                              <?php 
                              $data=array(
                                               'name'=>'team',
                                               'class'=>'gui-input',
                                               'placeholder'=>'Team Name',
                                               'value'=>isset($frmdata['orderdata']->team)?$frmdata['orderdata']->team:""
                                               
                                              );
                                            echo form_input($data);
                              ?>
                              </label>
                              <div id="add_select_project_manager" class="plus margin_top20" style="display: none;"> 
                                 <a href="#" data-toggle="modal" data-target="#myModal2">
                                 <i class="fa fa-plus fa-2x text1"></i></a> 
                              </div>
                              <!-- model --> 
                           </div>
                        </div>
                        
                        <!-- Modal -->
                        
                     </fieldset>
                  </div>
               </div>
            </div>
            <div class="panel panel-primary rose">
               <div class="panel-heading" role="tab" id="headingTwo">
                  <a class="collapsed faq-links" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                     <div class="panel-title"> Economic Buyer
                        <span class="addingflip pull-right fa fa-plus fa-2x"></span>
                     </div>
                  </a>
               </div>
               <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                     <fieldset>
                        <div class="main_boxes" id="e_buyer">
                           <div class="rows">
                              <div class="frm-row"  >
                                 <div class="section colm colm6">
                                    <h4> <label>First Name</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <input type="text" name="first_name" id="first_name" class="gui-input" placeholder="First Name"> -->
                                       <?php
                                          $data=array('name'=>'efirst_name',
                                                      'class'=>'gui-input',
                                                      'placeholder'=>'First Name',
                                                      'value'=>isset($frmdata['orderdata']->first_name)?$frmdata['orderdata']->first_name:""
                                                   
                                                        );
                                           echo form_input($data);?><?php echo form_error('efirst_name');?>
                                    </label>
                                 </div>
                                 <!-- end section -->
                                 <div class="section colm colm6">
                                    <h4> <label>Last Name</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <input type="text" name="Last_Name" id="Last_Name" class="gui-input" placeholder="Last Name"> -->
                                       <?php
                                          $data=array('name'=>'eLast_Name',
                                                      'class'=>'gui-input',
                                                      'placeholder'=>'Last Name',
                                                      'value'=>isset($frmdata['orderdata']->last_name)?$frmdata['orderdata']->last_name:""
                                                    
                                            );
                                           echo form_input($data);?><?php echo form_error('eLast_Name');?>
                                    </label>
                                 </div>
                                 <!-- end section --> 
                              </div>
                              <!-- end frm-row section -->
                              <div class="frm-row">
                                 <div class="section colm colm6">
                                    <h4> <label>Location</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <input type="text" name="Location" id="Location" class="gui-input" placeholder="Location"> -->
                                       <?php 
                                          $data=array('name' =>'eLocation' ,
                                                      'class'=>'gui-input',
                                                      'placeholder'=>'Location',
                                                      'value'=>isset($frmdata['orderdata']->location)?$frmdata['orderdata']->location:""
                                                   
                                                      );
                                          echo form_input($data);
                                          
                                          ?><?php echo form_error('eLocation');?>
                                    </label>
                                 </div>
                                 <!-- end section -->
                                 <div class="section colm colm6">
                                    <h4> <label>Designation</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <input type="text" name="Designation" id="Designation" class="gui-input" placeholder="Designation"> -->
                                       <?php 
                                          $data=array('name'=>'eDesignation',
                                                      'class'=>'gui-input',
                                                      'placeholder'=>'Designation',
                                                      'value'=>isset($frmdata['orderdata']->designation)?$frmdata['orderdata']->designation:""
                                                  
                                                      );
                                            echo form_input($data);
                                          
                                          ?><?php echo form_error('eDesignation');?>
                                    </label>
                                 </div>
                                 <!-- end section --> 
                              </div>
                              <div class="frm-row">
                                 <div class="section colm colm6">
                                    <h4> <label>Contact No</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <input type="text" name="Contact" id="Contact" class="gui-input" placeholder="Contact No"> -->
                                       <?php
                                          $data=array('name'=>'eContact',
                                                      'class'=>'gui-input',
                                                      'placeholder'=>'Contact',
                                                      'value'=>isset($frmdata['orderdata']->contact_No)?$frmdata['orderdata']->contact_No:""
                                                 
                                            );
                                          
                                          echo form_input($data);
                                          
                                          ?><?php echo form_error('eContact');?>
                                    </label>
                                 </div>
                                 <!-- end section -->
                                 <div class="section colm colm6">
                                    <h4> <label>Email</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <input type="email" name="Email" id="Email" class="gui-input" placeholder="Email"> -->
                                       <?php
                                          $data=array('name'=>'eEmail',
                                                      'class'=>'gui-input',
                                                      'placeholder'=>'Email',
                                                       'value'=>isset($frmdata['orderdata']->email_Id)?$frmdata['orderdata']->email_Id:""
                                                   
                                            );
                                          echo form_input($data);
                                          
                                          
                                          
                                          ?><?php echo form_error('eEmail');?>
                                    </label>
                                 </div>
                                 <!-- end section --> 
                              </div>
                              
                              
                              
                              
                              <div class="frm-row">
                                 <div class="section colm colm6">
                                    <h4> <label>Co-Ordinator</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <input type="text" name="Contact" id="Contact" class="gui-input" placeholder="Contact No"> -->
                                       <?php
                                          $data=array(
                                               'name'=>'co_ordinator',
                                               'class'=>'gui-input',
                                               'placeholder'=>'Co-Ordinator',
                                               'value'=>isset($frmdata['orderdata']->co_ordinator)?$frmdata['orderdata']->co_ordinator:""
                                              );
                                            echo form_input($data);
                                          
                                          ?><?php echo form_error('co_ordinator');?>
                                    </label>
                                 </div>
                                 <!-- end section -->
                                 <div class="section colm colm6">
                                    <h4> <label>Email of Co-ordinator</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <input type="email" name="Email" id="Email" class="gui-input" placeholder="Email"> -->
                                       <?php
                                          $data=array(
                                               'name'=>'email_co_ordinator',
                                               'class'=>'gui-input',
                                               'placeholder'=>'Email',
                                               'value'=>isset($frmdata['orderdata']->email_co_ordinator)?$frmdata['orderdata']->email_co_ordinator:""
                                              );
                                            echo form_input($data);
                                          
                                          
                                          
                                          ?><?php echo form_error('email_co_ordinator');?>
                                    </label>
                                 </div>
                                 <!-- end section --> 
                              </div>
                              
                              
                              <div class="frm-row">
                                 <div class="section colm colm6">
                                    <h4> <label>Contact No(Co-ordinator)</label></h4>
                                    <label class="field prepend-icon">
                                       <!-- <input type="text" name="Contact" id="Contact" class="gui-input" placeholder="Contact No"> -->
                                       <?php
                                          $data=array(
                                               'name'=>'contact_no_co_ordinator',
                                               'class'=>'gui-input',
                                               'placeholder'=>'Contact No',
                                               'value'=>isset($frmdata['orderdata']->contact_no_co_ordinator)?$frmdata['orderdata']->contact_no_co_ordinator:""
                                               
                                              );
                                            echo form_input($data);
                                          
                                          ?><?php echo form_error('contact_no_co_ordinator');?>
                                    </label>
                                 </div>
                                 <!-- end section -->
                              </div>
                              
                              
                              
                           </div>
                        </div>
                        <!-- <h2><a href="#" id="addEco"><i class="fa fa-plus fa-1x text1"></i></a></h2> -->
                        <!-- end frm-row section -->
                     </fieldset>
                  </div>
               </div>
            </div>
            <div class="panel panel-primary rose">
               <div class="panel-heading" role="tab" id="headingThree">
                  <a class="collapsed faq-links" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                     <div class="panel-title"> Address For Billing
                        <span class="addingflip pull-right fa fa-plus fa-2x"></span>
                     </div>
                  </a>
               </div>
               <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                     <fieldset>
                        <div class="main_boxes" id="p_scents4">
                           <div class="rows">
                              <div class="frm-row">
                              <div class="section colm colm12">
                                    <h4> <label>Auto Select Address</label></h4>
                                    <input type="checkbox" id="checkbox" name="checkbox" class="clientval" value="<?php echo isset($frmdata['orderdata']->client_id)?$frmdata['orderdata']->client_id:"" ?>">
                                    
                                 </div>
                                 <div class="section colm colm6">
                                    <h4> <label>Street/Plot No.</label></h4>
                                    <?php
                                       $data=array('name'=>'astreet',
                                                   'class'=>'form-control',
                                                   'id'=>'street',
                                                   'placeholder'=>'Enter Street/plot no.',
                                                   'value'=>isset($frmdata['orderdata']->street)?$frmdata['orderdata']->street:""
                                       
                                                   );
                                       echo form_input($data);
                                       ?><?php echo form_error('astreet');?>
                                 </div>
                                 <!-- end section -->
                                 <div class="section colm colm6">
                                    <h4> <label>Location </label></h4>
                                    <?php
                                       $data=array('name'=>'alocation',
                                                   'class'=>'form-control',
                                                   'id'=>'location',
                                                   'placeholder'=>'Enter Location',
                                                   'value'=>isset($frmdata['orderdata']->alocation)?$frmdata['orderdata']->alocation:""
                                       
                                                   );
                                       echo form_input($data);
                                       ?><?php echo form_error('alocation');?>
                                 </div>
                                 <!-- end section --> 
                              </div>
                              <!-- end frm-row section -->
                              <div class="frm-row">
                                <div class="section colm colm6">
                                    <h4> <label>City </label></h4>
                                    <?php
                                       $data=array('name'=>'acity',
                                                   'class'=>'form-control',
                                                   'id'=>'city',
                                                   'placeholder'=>'Enter City',
                                                   'value'=>isset($frmdata['orderdata']->city)?$frmdata['orderdata']->city:""
                                       
                                                   );
                                       echo form_input($data);
                                       ?><?php echo form_error('acity');?>
                                 </div>
                                 <div class="section colm colm6">
                                    <h4> <label>State </label></h4>
                                    <?php
                                       $data=array('name'=>'astate',
                                                   'class'=>'form-control',
                                                   'id'=>'state',
                                                   'placeholder'=>'Enter State',
                                                   'value'=>isset($frmdata['orderdata']->state)?$frmdata['orderdata']->state:""
                                       
                                                   );
                                       echo form_input($data);
                                       ?><?php echo form_error('astate');?>
                                 </div>

                                 <!-- end section -->
                                
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
                                       <?php
                                          $data=array('name'=>'apincode',
                                                      'class'=>'gui-input',
                                                      'id'=>'pincode',
                                                      'placeholder'=>'Pin Code',
                                                      'value'=>isset($frmdata['orderdata']->pincode)?$frmdata['orderdata']->pincode:""
                                          
                                                      );
                                          echo form_input($data);
                                          ?><?php echo form_error('apincode');?>
                                    </label>
                                 </div>



  <!-- <div class="ui-widget">
  <input type="text" id="country" name="country" placeholder="Enter pincode" width="40%"><br/>
  <span style="color:red;"> Enter at least 3 digit to show auto-complete.
</div>
<div> Taluka: <span id="taluka"></span><br/>
 Division Name: <span id="divison"></span><br/>
  Region Name: <span id="reg"></span><br/>
  Circle Name: <span id="cir"></span><br/>
   State Name: <span id="state"></span><br/>
</div> -->
                                 


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
            <div class="panel panel-primary rose">
               <div class="panel-heading" role="tab" id="headingTwo">
                  <a class="collapsed faq-links" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapseTwo">
                     <div class="panel-title">Documents Upload
                        <span class="addingflip pull-right fa fa-plus fa-2x"></span> 
                     </div>
                  </a>
               </div>
               <div style="height: 0px;" aria-expanded="false" id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                     <fieldset>
                        <div class="col-md-12 form-group">
                           <h5>Please Select Documents</h5>
                        </div>
                        <?php
                        if(isset($dtdoc['docview']))
                          $availabeDoc= single_array($dtdoc['docview'],'document_id','file_name');
                        else
                          $availabeDoc=array();
                        //$availabeDocvalue=array_values($dtdoc['docview']);
                        //echo "@@@@@<pre>";print_r($availabeDoc);die;
                        ?>
                        <?php foreach ($document as $key => $value) {
                          
                            //echo "####<pre>";print_r($availabeDoc[$key]);die;?>
                        <div class="frm-row" id="p_scents">
                           <div class="rows clearfix">
                              <div class="section colm colm6">
                                 <div class="col-md-12">
                                    <div class="col-md-3">
                                       <label><?php echo $value;?></label>
                                    </div>
                                    <div class="col-md-6">
                                       <div id="file_browse_wrapper1">
                                          <input type="file" id="file_browse1" name='<?php echo "documents[".$key."]";?>'>
                                            <?php //echo form_error('documents['.$key.']');?>
                                       </div>
                                    </div>
                                    <?php if(isset($availabeDoc) and isset($availabeDoc[$key])){?>
                                    <div class="col-md-3"><a href="<?php echo PUBLIC_ULR ?>documents/<?php echo $availabeDoc[$key];?>" target="_blank">View Upload File</a></div>
                                    <?php }?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <?php }
                        ?>
                     </fieldset>
                  </div>
               </div>
            </div>
            <!-- terms and condition part started -->
            <div class="panel panel-primary rose">
               <div class="panel-heading" role="tab" id="headingThree">
                  <a class="collapsed faq-links" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapseThree">
                     <div class="panel-title">Term & Conditions
                        <span class="addingflip pull-right fa fa-plus fa-2x"></span> 
                     </div>
                  </a>
               </div>
               <div aria-expanded="false" id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                     <fieldset>
                        <div class="frm-row">
                           <div class="section colm colm6">
                              <h4><label>Price Validity</label></h4>
                              <div class="input-group date" id="example3">
                                 <!-- <input type="text" class="form-control" placeholder="Price Validity" /> -->
                                 <?php 
                                    $data=array('name'=>'tcpricevalid',
                                                'class'=>'gui-input',
                                                'placeholder'=>'Price Validity',
                                                'value'=>isset($frmdata['orderdata']->price_validity)?$frmdata['orderdata']->price_validity:""
                                     
                                                 );
                                    echo form_input($data);
                                    ?><?php echo form_error('tcpricevalid');?>
                                <!--  <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>  -->
                              </div>
                           </div>
                           <!-- end section -->
                            <div class="section colm colm6">
                              <h4><label>Special Items</label></h4>
                              <label class="field prepend-icon">
                                 <!-- <input type="text" name="Location" id="Location" class="gui-input" placeholder="Special items"> -->
                                 <?php $data=array('name'=>'tcspecialitem',
                                    'class'=>'gui-input',
                                    'placeholder'=>'Special Items',
                                    'value'=>isset($frmdata['orderdata']->special_item)?$frmdata['orderdata']->special_item:""
                                    
                                    );
                                    echo form_input($data);
                                    ?><?php echo form_error('tcspecialitem');?>
                                 <span class="field-icon"></span> 
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
                                 <?php $data=array('name'=>'tccontractno',
                                    'class'=>'gui-input',
                                    'placeholder'=>'Blanket contract No',
                                    'value'=>isset($frmdata['orderdata']->contract_no)?$frmdata['orderdata']->contract_no:""
                                    
                                    );
                                    echo form_input($data);
                                    ?><?php //echo form_error('tccontractno');?>
                              </label>
                           </div>
                            <div class="section colm colm6 hight">
                              <h4><label>Payment Cycle</label></h4>
                              <!-- <input type="text"  placeholder="Payment cycle" name="payment cycle" class="form-control" /> -->
                              <?php //echo form_dropdown('tcpaymentcycle', $payment,isset($frmdata['orderdata']->payment_cycle)?$frmdata['orderdata']->payment_cycle:"", 'class="form-control datepicker" id="name_of_required"');?>
                              <?php 
                                    $data=array('name'=>'tcpaymentcycle',
                                                'class'=>'gui-input',
                                                'placeholder'=>'Payment Cycle',
                                                'value'=>isset($frmdata['orderdata']->payment_cycle)?$frmdata['orderdata']->payment_cycle:"",
                                                'id'=>'tcpaymentcycle'
                                     
                                                 );
                                    echo form_input($data);
                                    ?><?php echo form_error('tcpricevalid');?>
                           </div>
                           <!-- end section --> 
                        </div>
                        <!-- end frm-row section -->
                        <div class="frm-row">
                           <div class="section hight colm colm6">
                              <h4><label>Notes</label></h4>
                              <!-- <textarea class="form-control" placeholder="Notes:"></textarea> -->
                              <?php $data=array('name'=>'tcnote',
                                 'class'=>'form-control',
                                 'placeholder'=>'Notes',
                                 'rows'=>10,
                                 'cols'=>53,
                                 'style'=>'resize:none',
                                 'value'=>isset($frmdata['orderdata']->notes)?$frmdata['orderdata']->notes:""
                                 
                                 );
                                 echo form_textarea($data);
                                 ?><?php echo form_error('tcnote');?>
                           </div>
                           <div class="section colm colm6">

                              <h4><label class="field prepend-icon" name="">Cancellation / Postponement: &nbsp;</label></h4>
                             <input type="radio" name="tccancellation" value="1" <?php  if(isset($frmdata['orderdata']->cancellation_clouse) and ($frmdata['orderdata']->cancellation_clouse== '1')){ echo "checked='checked'";} ?> /> First: <ul><li> 50% of the professional fee – 15 to 3 working days of the confirmed date of delivery.</li><li> 100% of professional fee – 2 to 0 working days of the confirmed date of delivery.</li></ul>
                             <input type="radio" name="tccancellation" value="2" <?php if(isset($frmdata['orderdata']->cancellation_clouse) and ($frmdata['orderdata']->cancellation_clouse == '2')) echo "checked='checked'"; ?> /> Second: <ul><li> 50% of the professional fee – 20 to 3 working days of the confirmed date of delivery.</li><li> 100% of professional fee – 2 to 0 working days of the confirmed date of delivery.</li></ul>  
                           <input type="radio" name="tccancellation" value="3" <?php if(isset($frmdata['orderdata']->cancellation_clouse) and ($frmdata['orderdata']->cancellation_clouse == '3')) echo "checked='checked'"; ?> /> Third: <ul><li> 50% of the professional fee – 24 to 4 hrs of the confirmed date and time of call.</li><li> 100% of professional fee – 4 to 0 hrs of the confirmed date and time of call.</li></ul> 
                                
                           </div>
                        </div>
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
                              <h4><label>NDA Required</label></h4>
                              <label class="field prepend-icon">
                                 <!-- <select class="form-control" id="name_of_client">
                                    <option selected="selected" value="">NDA Required</option>
                                    <option value="Yes">Yes </option>
                                    <option value="No">No</option>
                                    </select> -->
                                 <?php echo form_dropdown('tcndarequire', $yesno,isset($frmdata['orderdata']->nda_required)?$frmdata['orderdata']->nda_required:"", 'class="form-control" id="name_of_required"');
                                 echo form_error('tcndarequire');?>
                              </label>
                           </div>
                               <div class="section colm colm6 hight">
                              <h4><label>Mode Of Payment</label></h4>
                              <label class="field prepend-icon">
                                 <!-- <select class="form-control" id="name_of_client">
                                    <option selected="selected" value="">Mode of Payment</option>
                                    <option value="cheque">Cheque </option>
                                    <option value="neft">NEFT</option>
                                    </select> -->
                                 <?php echo form_dropdown('tcmodepayment', $mod_ofpayment,isset($frmdata['orderdata']->mode_ofpayment)?$frmdata['orderdata']->mode_ofpayment:"", 'class="form-control" id="name_of_required"');?>
                                 <?php echo form_error('tcmodepayment');?>
                              </label>
                           </div>
                        </div>
                        <div class="frm-row">
                           <div class="section colm colm6 ">
                              <h4><label class="field prepend-icon" name="charges">Service Tax: &nbsp;</label></h4>
                              Yes&nbsp;<input type="radio" name="tax" value="Yes" <?php echo (isset($frmdata["orderdata"]->tax) and $frmdata["orderdata"]->tax=="Yes")?"checked='checked'":''; ?>/>&nbsp;
                              No&nbsp;<input type="radio" name="tax" value="No" <?php echo (isset($frmdata["orderdata"]->tax) and $frmdata["orderdata"]->tax=="No")?"checked='checked'":''; ?>/>
                           </div>
                           <!-- <div class="section colm colm6">
                              <label class="field prepend-icon" name="payment">Payment Terms: &nbsp; Net 30</label>
                              </div> -->
                       
                             <div class="section colm colm6 hight">
                            <h4><label>Payment Terms:</label></h4>

                              <?php 
                                    $data=array('name'=>'termsconditions',
                                                'class'=>'gui-input',
                                                'placeholder'=>'Terms & Conditions',
                                                'value'=>isset($frmdata['orderdata']->termsconditions)?$frmdata['orderdata']->termsconditions:""
                                     
                                                 );
                                    echo form_input($data);
                                    ?><?php echo form_error('tcpricevalid');?>
                           </div>
                           <!-- end section --> 
                        </div>
                        <div class="frm-row">
                        </div>
                     </fieldset>
                  </div>
               </div>
            </div>
            <!-- terms end here -->
            <div class="panel panel-primary ">
               <div class="panel-heading" role="tab" id="headingseven">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="false" aria-controls="collapseThree">
                     <div class="panel-title">Transportation
                        <span class="addingflip pull-right fa fa-plus fa-2x"></span> 
                     </div>
                  </a>
               </div>
               <div aria-expanded="false" id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingseven">
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
                        <?php //echo "####<pre>";print_r($transports);die;?>
                        <?php foreach ($transports as $key => $value) {
                          //echo "####<pre>";print_r($dttrans["transview"][$value->id]);die;?>
                        <div class="frm-row">
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <label><?php echo $value->trans_name;?></label>
                           </div>
                           <!-- end section -->
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="areon">
                                 <input type="radio" name="transport[<?php echo $value->id; ?>]" value="N" <?php echo (isset($dttrans["transview"][$value->id]) and $dttrans["transview"][$value->id]=="n")?"checked='checked'":''; ?>/>
                              </div>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="areon">
                                 <input type="radio" name="transport[<?php echo $value->id; ?>]" value="C" <?php echo (isset($dttrans["transview"][$value->id]) and $dttrans["transview"][$value->id]=="c")?"checked='checked'":''; ?>/>
                              </div>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="areon">
                                 <input type="radio" name="transport[<?php echo $value->id; ?>]" value="M" <?php echo (isset($dttrans["transview"][$value->id]) and $dttrans["transview"][$value->id]=="m")?"checked='checked'":''; ?>/> 
                              </div>
                           </div>
                        </div>
                        <?php //}

                        }?>
                        <div class="section colm colm6 ">
                              <h4><label class="field prepend-icon" name="charges">Transport(15%): &nbsp;</label></h4>
                              Yes&nbsp;<input type="radio" name="transport_tax" value="Yes" <?php echo (isset($frmdata["orderdata"]->transport_tax) and $frmdata["orderdata"]->transport_tax=="Yes")?"checked='checked'":''; ?>/>&nbsp;
                                 
                              No&nbsp;<input type="radio" name="transport_tax" value="No" <?php echo (isset($frmdata["orderdata"]->transport_tax) and $frmdata["orderdata"]->transport_tax=="No")?"checked='checked'":''; ?>/>
                        </div>
                        <!-- end section --> 
                        <!-- end frm-row section -->
                        <!-- end frm-row section -->
                        <!-- end section -->
                     </fieldset>
                  </div>
               </div>
            </div>
         </div>
         <input class="btn btn-primary" style=" float:right;" type="submit" value="Submit">
         <!--third feilset ended from here-->
         <div id="myModal2" class="modal fade" role="dialog">
            <div class="modal-dialog form1">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Add New Sales by</h4>
                  </div>
                  <div class="modal-body">
                     <fieldset class="form-group">
                        <label for="exampleInputfirstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" placeholder="First Name">
                     </fieldset>
                     <fieldset class="form-group">
                        <label for="exampleInputlastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Last Name">
                     </fieldset>
                     <fieldset class="form-group">
                        <label for="exampleInputemail">Email Id</label>
                        <input type="Email" class="form-control" id="exampleInputPassword1" placeholder="Email Id">
                     </fieldset>
                     <button type="button" class="btn btn-primary">Submit</button>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
         <div id="myModal1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog form1">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Add New Sales By</h4>
                  </div>
                  <div class="modal-body">
                     <fieldset class="form-group">
                        <label for="exampleInputfirstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" placeholder="First Name">
                     </fieldset>
                     <fieldset class="form-group">
                        <label for="exampleInputlastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Last Name">
                     </fieldset>
                     <fieldset class="form-group">
                        <label for="exampleInputemail">Email Id</label>
                        <input type="Email" class="form-control" id="exampleInputPassword1" placeholder="Email Id">
                     </fieldset>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
         <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog form1">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Add New Client.</h4>
                  </div>
                  <div class="modal-body">
                     <fieldset class="form-group">
                        <label for="exampleInputfirstname">Company Name</label>
                        <input type="text" class="form-control" id="companyname" placeholder="Company Name">
                     </fieldset>
                     <fieldset class="form-group">
                        <label for="exampleInputlastname">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Address">
                     </fieldset>
                     <fieldset class="form-group">
                        <label for="exampleInputemail">Contact No</label>
                        <input type="text" class="form-control" id="conatctno" placeholder="Contact No">
                     </fieldset>
                     <button type="button" class="btn btn-primary">Submit</button>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
   $(document).ready(function() {
     $( ".datepicker" ).datepicker({dateFormat:'yy-mm-dd'});
   });
   $('#name_of_client').on('change', function() {
       if ( this.value == 'others')
       {
         $("#add_name_of_client").show();
       }
       else
       {
         $("#add_name_of_client").hide();
       }
     });
   
    $('#name_of_seller').on('change', function() {
       if ( this.value == 'others')
       {
         $("#add_select_sales_by").show();
       }
       else
       {
         $("#add_select_sales_by").hide();
       }
     });
   $('#name_of_manager').on('change', function() {
       if ( this.value == 'others')
       {
         $("#add_select_project_manager").show();
       }
       else
       {
         $("#add_select_project_manager").hide();
       }
     });
   
   
   
   
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
<style type="text/css">
   .error {
   color:red;
   font-size:13px;
   margin-bottom:-15px
   }
</style>
<style>
  .ui-autocomplete-loading {
    background: white url("<?php echo IMG_URL ?>/ui-anim_basic_16x16.gif") right center no-repeat;
  }
   .ui-autocomplete {
    max-height: 300px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 100px;
  }
  </style>
  <script> 
  $('#name_of_client').on('change', function() {
  var clinetid=$(this).val();
  $('.clientval').val(clinetid);
  });
  $(document).ready(function() {
 
   $( "#checkbox" ).click(function() {
        if($(this). prop("checked") == true){
          var cid= $(this).val();
          $.ajax({
          url: "<?php echo site_url('admin/order/getClientAddress'); ?>",
          dataType: "json",
          type:"post",
          data: {
            clientid: cid
          },
          success: function( data ) {
            //response( data );
            //console.log('ranu');
            //console.log(data);
            $('#street').val(data.street);
            $('#location').val(data.location);
            $('#state').val(data.state);
            $('#city').val(data.city);
            $('#pincode').val(data.pincode);
          }
        });
        }
        else
        {
         $('#street').val('');
            $('#location').val('');
            $('#state').val('');
            $('#city').val('');
            $('#pincode').val('');
        }
            
       //alert(cid);

        
      
     
    });
  });
  </script>
 <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script type="text/javascript">

  $(function() {
               $( "#tcpaymentcycle" ).autocomplete({
                   source: function(request, response) {
                       $.ajax({ url: ADMINURL+'order/autoCompletedPayment',
                       data:{'request':$("#tcpaymentcycle").val()},
                       dataType: "json",
                       type: "POST",
               success: function(data){
                        response( $.map( data, function( item ) {
                          return {
                            value: item.payment_cycle
                          }
                        }));
                       }
                   });
               },
               autoFocus: true,
            minLength: 0 
               });


        $('#orderform').submit(function() {
          $('#gif').css('display', 'block');
          //  return false;
          return true;
        });


           });
 
</script>
<div class="toppart" style="display:none;position: fixed; top: 50%; left: 50%; margin-top: -50px; margin-left: -100px; z-index: 1000;" id="gif" style="display:inline;"><img src="<?php echo site_url().'/assests/img/save.gif';?>"/></div>
