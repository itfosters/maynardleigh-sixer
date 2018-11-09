<?php 
//echo "<pre>";print_r($frmdata);die;
   $logisticsRating = array(
            '0'=>'Excellent',
            '1'=>'Good',
            '2'=>'Average',
            );
            //echo "<pre>";print_r($view);die;
   
   ?>
<?php echo form_open();
echo form_hidden('diagnose_id', isset($frmdata['diagnose_id'])?$frmdata['diagnose_id']:"");
echo form_hidden('assign_date_id', isset($frmdata['assign_date_id'])?$frmdata['assign_date_id']:"");
echo form_hidden('order_type', isset($frmdata['order_type'])?$frmdata['order_type']:"");
echo form_hidden('resource_name', isset($frmdata['userinfo']->name)?$frmdata['userinfo']->name:"");
?>
<div class="row">
   <div class="col-md-12">
      <div class="col-md-3">
         <div class="form-group">
            <label for="clientname"> Client Name: 
            <b><?php echo isset($frmdata['moreinfo']->clientname)?$frmdata['moreinfo']->clientname:""?></b></label>
            <?php echo form_hidden('clientname', isset($frmdata['moreinfo']->clientname)?$frmdata['moreinfo']->clientname:"");?>
            <?php //echo form_error('clientname');?>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="program_name">Sub Product: 
            <b><?php echo (isset($frmdata['moreinfo']->name))?$frmdata['moreinfo']->name:""?></b></label>
            <?php echo form_hidden('name', (isset($frmdata['moreinfo']->name))?$frmdata['moreinfo']->name:"");?>
            <?php //echo form_error('program_name');?>
         </div>
      </div>
       <div class="col-md-3">
         <div class="form-group">
            <label for="program_name">Product: 
            <b><?php echo (isset($frmdata['moreinfo']->proname))?$frmdata['moreinfo']->proname:""?></b></label>
            <?php echo form_hidden('program_name', (isset($frmdata['moreinfo']->proname))?$frmdata['moreinfo']->proname:"");?>
            <?php //echo form_error('program_name');?>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="programdate">Program Date: 
            <b>
                <?php 
                
                $start = date('d-m-Y', strtotime($frmdata['moreinfo']->start_date));
                $end = date('d-m-Y', strtotime($frmdata['moreinfo']->end_date));
                if ($start == $end) 
                    echo date('jS F, Y', strtotime($start));
                else
                    echo date('jS F, Y', strtotime($start)) . ' - ' . date('jS F, Y', strtotime($end));
                
                
               // echo (isset($frmdata['moreinfo']->start_date)&&($frmdata['moreinfo']->end_date))?$frmdata['moreinfo']->start_date.' '.'&'.' '.$frmdata['moreinfo']->end_date:""?></b></label>
            <?php echo form_hidden('programdate', (isset($frmdata['moreinfo']->start_date)&&($frmdata['moreinfo']->end_date))?$frmdata['moreinfo']->start_date.' '.'&'.' '.$frmdata['moreinfo']->end_date:"");?>
            <?php echo form_error('programdate');?>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-6">
         <div class="form-group">
            <label for="programdate">Were the participants properly briefed? </label>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <div class="radio">
               <label class="radio-inline">
               <?php  $data=array(
                  'name'=>'participants_briefed',
                  'value'=>'1',
                   'checked' => (isset($frmdata['formdata']['participants_briefed']) && $frmdata['formdata']['participants_briefed']==1)?true:false
                  );
                  
                  echo form_radio($data);
                  ?>Yes
               </label>
               <label class="radio-inline">
               <?php  $data=array(
                  'name'=>'participants_briefed',
                  'value'=>'0',
                   'checked' =>(isset($frmdata['formdata']['participants_briefed']) && $frmdata['formdata']['participants_briefed']==0)?true:false
                    );
                  
                  echo form_radio($data);
                  ?>No
               </label>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <label><b>Deliverables:</b></label>
      </div>
      <div class="col-md-4">
         <label><b> Yes/No:</b></label>
      </div>
      <div class="col-md-4">
         <label><b>Details/Target Date:</b></label>
      </div>
      <div class="col-md-4">
         <label> Learning Community (with article details):</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'learning_community_radio',
               'value'=>'1',
                'checked' =>(isset($frmdata['formdata']['learning_community_radio']) && $frmdata['formdata']['learning_community_radio']==1)?true:false
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'learning_community_radio',
               'value'=>'0',
                'checked' =>(isset($frmdata['formdata']['learning_community_radio']) && $frmdata['formdata']['learning_community_radio']==0)?true:false
                 );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
             <?php 
              $data=array(
               'name'=>'learning_community_text',
               'class'=>'form-control',
                'type'  => 'text',
                'value' =>((isset($frmdata['formdata']['learning_community_text'])) && (!empty($frmdata['formdata']['learning_community_text']))) ? $frmdata['formdata']['learning_community_text']:""
                 );
              echo form_input($data);
             ?>
            
         </div>
      </div>
      <div class="col-md-4">
         <label>Feedback:</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'feedback_radio',
               'value'=>'1',
                'checked' =>(isset($frmdata['formdata']['feedback_radio']) && $frmdata['formdata']['feedback_radio']==1)?true:false
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'feedback_radio',
               'value'=>'0',
                'checked' =>(isset($frmdata['formdata']['feedback_radio']) && $frmdata['formdata']['feedback_radio']==0)?true:false
               );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <?php $data=array(
               'name'=>'feedback_text',
               'class'=>'form-control',
                  'type'  => 'text',
                'value' =>((isset($frmdata['formdata']['feedback_text'])) && (!empty($frmdata['formdata']['feedback_text']))) ? $frmdata['formdata']['feedback_text']:""
                 );
              echo form_input($data); ?>
         </div>
      </div>
      <div class="col-md-4">
         <label>Do it now cards:</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <div class="radio">
               <label class="radio-inline">
               <?php  $data=array(
                  'name'=>'do_it_now_cards_radio',
                  'value'=>'1',
                   'checked' =>(isset($frmdata['formdata']['do_it_now_cards_radio']) && $frmdata['formdata']['do_it_now_cards_radio']==1)?true:false
                  );
                  
                  echo form_radio($data);
                  ?>Yes
               </label>
               <label class="radio-inline">
               <?php  $data=array(
                  'name'=>'do_it_now_cards_radio',
                  'value'=>'0',
                   'checked' =>(isset($frmdata['formdata']['do_it_now_cards_radio']) && $frmdata['formdata']['do_it_now_cards_radio']==0)?true:false
                  );
                  echo form_radio($data);
                  ?>No
               </label>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <?php $data=array(
               'name'=>'do_it_now_cards_text',
               'class'=>'form-control',
                  'type'  => 'text',
                'value' =>((isset($frmdata['formdata']['do_it_now_cards_text'])) && (!empty($frmdata['formdata']['do_it_now_cards_text']))) ? $frmdata['formdata']['do_it_now_cards_text']:""
                 );
              echo form_input($data); ?>
         </div>
      </div>
      <div class="col-md-4">
         <label>  Trust Contract:</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <div class="radio">
               <label class="radio-inline">
               <?php  $data=array(
                  'name'=>'trust_contract_radio',
                  'value'=>'1',
                   'checked' =>(isset($frmdata['formdata']['trust_contract_radio']) && $frmdata['formdata']['trust_contract_radio']==1)?true:false
                  );
                  
                  echo form_radio($data);
                  ?>Yes
               </label>
               <label class="radio-inline">
               <?php  $data=array(
                  'name'=>'trust_contract_radio',
                  'value'=>'0',
                   'checked' =>(isset($frmdata['formdata']['trust_contract_radio']) && $frmdata['formdata']['trust_contract_radio']==0)?true:false
                  );
                  
                  echo form_radio($data);
                  ?>No
               </label>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <?php $data=array(
               'name'=>'trust_contract_text',
               'class'=>'form-control',
                  'type'  => 'text',
                'value' =>((isset($frmdata['formdata']['trust_contract_text'])) && (!empty($frmdata['formdata']['trust_contract_text']))) ? $frmdata['formdata']['trust_contract_text']:""
                 );
              echo form_input($data); ?>
         </div>
      </div>
      <div class="col-md-4">
         <label>Workshop pictures:</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'workshop_pictures_radio',
               'value'=>'1',
                'checked' =>(isset($frmdata['formdata']['workshop_pictures_radio']) && $frmdata['formdata']['workshop_pictures_radio']==1)?true:false
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'workshop_pictures_radio',
               'value'=>'0',
                'checked' =>(isset($frmdata['formdata']['workshop_pictures_radio']) && $frmdata['formdata']['workshop_pictures_radio']==0)?true:false
                
                 );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <?php $data=array(
               'name'=>'workshop_pictures_text',
               'class'=>'form-control',
                  'type'  => 'text',
                'value' =>((isset($frmdata['formdata']['workshop_pictures_text'])) && (!empty($frmdata['formdata']['workshop_pictures_text']))) ? $frmdata['formdata']['workshop_pictures_text']:""
                 );
              echo form_input($data); ?>
         </div>
      </div>
      <div class="col-md-4">
         <label> Books:</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'books_radio',
               'value'=>'1',
                'checked' =>(isset($frmdata['formdata']['books_radio']) && $frmdata['formdata']['books_radio']==1)?true:false
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'books_radio',
               'value'=>'0',
                'checked' =>(isset($frmdata['formdata']['books_radio']) && $frmdata['formdata']['books_radio']==0)?true:false
                 );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <?php $data=array(
               'name'=>'books_text',
               'class'=>'form-control',
                  'type'  => 'text',
                'value' =>((isset($frmdata['formdata']['books_text'])) && (!empty($frmdata['formdata']['books_text']))) ? $frmdata['formdata']['books_text']:""
                 );
              echo form_input($data); ?>
         </div>
      </div>
      <div class="col-md-4">
         <label>  Any Others  :</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'any_others_radio',
               'value'=>'1',
                'checked' =>(isset($frmdata['formdata']['any_others_radio']) && $frmdata['formdata']['any_others_radio']==1)?true:false
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'any_others_radio',
               'value'=>'0',
                'checked' =>(isset($frmdata['formdata']['any_others_radio']) && $frmdata['formdata']['any_others_radio']==0)?true:false
                 );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <?php $data=array(
               'name'=>'any_others_text',
               'class'=>'form-control',
                  'type'  => 'text',
                 'value' =>((isset($frmdata['formdata']['any_others_text'])) && (!empty($frmdata['formdata']['any_others_text']))) ? $frmdata['formdata']['any_others_text']:""
                 );
              echo form_input($data); ?>
         </div>
      </div>
      <div class="col-md-4">
         <label>  ProgressIT:</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'progress_it_radio',
               'value'=>'1',
                'checked' =>(isset($frmdata['formdata']['progress_it_radio']) && $frmdata['formdata']['progress_it_radio']==1)?true:false
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'progress_it_radio',
               'value'=>'0',
                'checked' =>(isset($frmdata['formdata']['progress_it_radio']) && $frmdata['formdata']['progress_it_radio']==0)?true:false
                 );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <?php $data=array(
               'name'=>'progress_it_text',
               'class'=>'form-control',
                  'type'  => 'text',
                'value' =>((isset($frmdata['formdata']['any_others_text'])) && (!empty($frmdata['formdata']['any_others_text']))) ? $frmdata['formdata']['any_others_text']:""
                 );
              echo form_input($data); ?>
         </div>
      </div>
      <div class="col-md-6">
         <label><b>Logistics Rating:</b></label>
      </div>
      <div class="col-md-4 form-group">
          <?php
              echo form_dropdown('logistics_rating',$logisticsRating,isset($frmdata['formdata']['logistics_rating'])?$frmdata['formdata']['logistics_rating']:array(), 'class="form-control selectpicker" id="name_of_dlvproducts" ');
              ?>
      </div>
      
      <div class="col-md-6">
         <div class="form-group">
            <label><b>Why were we there?:</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <?php $data=array(
               'name'=>'why_were_we_there',
               'class'=>'form-control',
                'value' =>((isset($frmdata['formdata']['why_were_we_there'])) && (!empty($frmdata['formdata']['why_were_we_there']))) ? $frmdata['formdata']['why_were_we_there']:""
                 );
              echo form_textarea($data); 
              ?>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>What was the solution? :</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <?php $data=array(
               'name'=>'what_was_the_solution',
               'class'=>'form-control',
                'value' =>((isset($frmdata['formdata']['what_was_the_solution'])) && (!empty($frmdata['formdata']['what_was_the_solution']))) ? $frmdata['formdata']['what_was_the_solution']:""
                 );
              echo form_textarea($data); 
              ?>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>What was the outcome?  :</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <?php $data=array(
               'name'=>'what_was_the_outcome',
               'class'=>'form-control',
                'value' =>((isset($frmdata['formdata']['what_was_the_outcome'])) && (!empty($frmdata['formdata']['what_was_the_outcome']))) ? $frmdata['formdata']['what_was_the_outcome']:""
                 );
              echo form_textarea($data); 
              ?>
         </div>
      </div>
      
      <div class="col-md-6">
         <div class="form-group">
            <label><b>CANI (what went well?):</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <?php $data=array(
               'name'=>'cani',
               'class'=>'form-control',
                'value' =>((isset($frmdata['formdata']['cani'])) && (!empty($frmdata['formdata']['cani']))) ? $frmdata['formdata']['cani']:""
                 );
              echo form_textarea($data); 
              ?>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>What could go be better?</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <?php $data=array(
               'name'=>'what_could_go_better',
               'class'=>'form-control',
                'value' =>((isset($frmdata['formdata']['what_could_go_better'])) && (!empty($frmdata['formdata']['what_could_go_better']))) ? $frmdata['formdata']['what_could_go_better']:""
                 );
              echo form_textarea($data); 
              ?>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>Additional Comments (MLA logistics; the workshop content etc.):</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
             <?php $data=array(
               'name'=>'additional_comments',
               'class'=>'form-control',
                 'value' =>((isset($frmdata['formdata']['additional_comments'])) && (!empty($frmdata['formdata']['additional_comments']))) ? $frmdata['formdata']['additional_comments']:""
                 );
              echo form_textarea($data); ?>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>Training Materials Given:</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
             <?php $data=array(
               'name'=>'training_materials_given',
               'class'=>'form-control',
                 'value' =>((isset($frmdata['formdata']['training_materials_given'])) && (!empty($frmdata['formdata']['training_materials_given']))) ? $frmdata['formdata']['training_materials_given']:""
                 );
              echo form_textarea($data); ?>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>1.  Books (Name & Quantity):</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
             <?php $data=array(
               'name'=>'books_name_and_quantity',
               'class'=>'form-control',
                 'value' =>((isset($frmdata['formdata']['books_name_and_quantity'])) && (!empty($frmdata['formdata']['books_name_and_quantity']))) ? $frmdata['formdata']['books_name_and_quantity']:""
                 );
              echo form_textarea($data); ?>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>2. Cards (Name & Quantity):</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
             <?php $data=array(
               'name'=>'cards_name_and_quantity',
               'class'=>'form-control',
                 'value' =>((isset($frmdata['formdata']['cards_name_and_quantity'])) && (!empty($frmdata['formdata']['cards_name_and_quantity']))) ? $frmdata['formdata']['cards_name_and_quantity']:""
                 );
              echo form_textarea($data); ?>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>Any future Business Development opportunities?</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
             <?php $data=array(
               'name'=>'any_future_business_development_opportunities',
               'class'=>'form-control',
                 'value' =>((isset($frmdata['formdata']['any_future_business_development_opportunities'])) && (!empty($frmdata['formdata']['any_future_business_development_opportunities']))) ? $frmdata['formdata']['any_future_business_development_opportunities']:""
                 );
              echo form_textarea($data); ?>
         </div>
      </div>
   </div>
</div>
<?php if(!(isset($frmdata['formdata']['any_future_business_development_opportunities']) && (!empty($frmdata['formdata']['any_future_business_development_opportunities'])))){
        ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php } ?>
<a class="btn btn-primary" href="<?php site_url('welcome/mydates') ?>">Cancel</a>
<?php form_close();?>