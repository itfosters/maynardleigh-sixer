<?php 
   //$logisticsRating = array(
            //'0'=>'Excellent',
            //'1'=>'Good',
            //'2'=>'Average',
            //);
            //echo "<pre>";print_r($view);die;
   
   ?>
<?php echo form_open();?>
<div class="row">
   <div class="col-md-12">
      <div class="col-md-4">
         <div class="form-group">
            <label for="clientname"> Client Name: 
            <b><?php echo isset($frmdata['view']->clientname)?$frmdata['view']->clientname:""?></b></label>
            <?php echo form_hidden('clientname', isset($frmdata['view']->clientname)?$frmdata['view']->clientname:"");?>
            <?php echo form_error('clientname');?>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="program_name">Job Name: 
            <b><?php echo (isset($frmdata['moreinfo']->name))?$frmdata['moreinfo']->name:""?></b></label>
            <?php echo form_hidden('program_name', (isset($frmdata['moreinfo']->name))?$frmdata['moreinfo']->name:"");?>
            <?php //echo form_error('program_name');?>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="programdate">Program Date: 
            <b><?php echo (isset($frmdata['moreinfo']->start_date)&&($frmdata['moreinfo']->end_date))?$frmdata['moreinfo']->start_date.' '.'&'.' '.$frmdata['moreinfo']->end_date:""?></b></label>
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
                  'value'=>'yes',
                  );
                  
                  echo form_radio($data);
                  ?>Yes
               </label>
               <label class="radio-inline">
               <?php  $data=array(
                  'name'=>'participants_briefed',
                  'value'=>'No',
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
         <label><b> Yes/NO:</b></label>
      </div>
      <div class="col-md-4">
         <label><b>Target Date:</b></label>
      </div>
      <div class="col-md-4">
         <label> Learning Community (with article details):</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'learning_community',
               'value'=>'yes',
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'learning_community',
               'value'=>'No',
                 );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <input type="text" name="learning" class="form-control">
         </div>
      </div>
      <div class="col-md-4">
         <label>Feedback:</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'feedback',
               'value'=>'yes',
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'feedback',
               'value'=>'No',
                 );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <input type="text" name="feedback_coment" class="form-control">
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
                  'name'=>'now_cards',
                  'value'=>'yes',
                  );
                  
                  echo form_radio($data);
                  ?>Yes
               </label>
               <label class="radio-inline">
               <?php  $data=array(
                  'name'=>'now_cards',
                  'value'=>'No',
                  );
                  
                  echo form_radio($data);
                  ?>No
               </label>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <input type="text" name="nowcards" class="form-control">
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
                  'name'=>'trustContract',
                  'value'=>'yes',
                  );
                  
                  echo form_radio($data);
                  ?>Yes
               </label>
               <label class="radio-inline">
               <?php  $data=array(
                  'name'=>'trustContract',
                  'value'=>'No',
                    );
                  
                  echo form_radio($data);
                  ?>No
               </label>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <input type="text" name="trust" class="form-control">
         </div>
      </div>
      <div class="col-md-4">
         <label>Workshop pictures:</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'workshop_pictures',
               'value'=>'yes',
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'workshop_pictures',
               'value'=>'No',
                 );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <input type="text" name="Workshop" class="form-control">
         </div>
      </div>
      <div class="col-md-4">
         <label> Books:</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'book_data',
               'value'=>'yes',
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'book_data',
               'value'=>'No',
                 );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <input type="text" name="book" class="form-control">
         </div>
      </div>
      <div class="col-md-4">
         <label>  Any Others  :</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'any_others',
               'value'=>'yes',
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'any_others',
               'value'=>'No',
                 );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <input type="text" name="anyothers" class="form-control">
         </div>
      </div>
      <div class="col-md-4">
         <label>  ProgressIT:</label>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'progress_it',
               'value'=>'yes',
               );
               
               echo form_radio($data);
               ?>Yes
            </label>
            <label class="radio-inline">
            <?php  $data=array(
               'name'=>'progress_it',
               'value'=>'No',
                 );
               
               echo form_radio($data);
               ?>No
            </label>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <input type="text" name="progressit" class="form-control" value="">
         </div>
      </div>
      <div class="col-md-6">
         <label><b>Logistics Rating:</b></label>
      </div>
      <div class="col-md-4 form-group">
         <select  name="option_value" class="form-control">
            <option value="0"> A (Excellent)</option>
            <option value="1">B (Good)</option>
            <option value="2">C (Average)</option>
            <option value="3"> (Your Ratings) …… A</option>
         </select>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>CANI:</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <textarea name="CANI" class="form-control"></textarea>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>What could go better?</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <textarea name="gobetter" class="form-control"></textarea>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>Additional Comments (MLA logistics; the workshop content etc.):</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <textarea name="Additional" class="form-control"></textarea>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>Training Materials Given:</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <textarea name="Training" class="form-control"></textarea>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>1.  Books (Name & Quantity)</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <textarea name="Books" class="form-control"></textarea>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>2. Cards (Name & Quantity)</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <textarea name="Cards" class="form-control"></textarea>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label><b>Any future Business Development opportunities?</b></label>
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <textarea name="Business" class="form-control"></textarea>
         </div>
      </div>
   </div>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php form_close();?>