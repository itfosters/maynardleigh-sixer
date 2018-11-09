
<div class="row"  ng-controller="MainCtrl">
    <?php //$id = isset($frm_data['delvid']) ? $frm_data['delvid'] : ''; ?>
    <?php //echo "@@<pre>";print_r($frm_data);die; ?>
    <?php echo form_open(); ?>
    <div class="col-md-6">
        <!-- <div class="form-group">
            

            <?php
//            $data = array(
//                'name' => 'goal',
//                'class' => 'form-control',
//                'placeholder' => 'Goal',
//                'value' => isset($frm_data['view']->goal) ? $frm_data['view']->goal : ''
//            );
//            echo form_input($data);
            ?>
            <?php echo form_error('goal'); ?>    
        </div> -->
        <label> Goal </label>
        <div class="form-group">
             <?php $data=array(
               'name'=>'goal',
               'class'=>'form-control',
                 'value' =>((isset($frm_data['view']->goal)) && (!empty($frm_data['view']->goal))) ? $frm_data['view']->goal:""
                 );
              echo form_textarea($data); ?>
         </div>
    </div>
    <div class="clearfix"></div>
     <div class="col-md-6">
            

            <?php $data=array('value' => 'Submit',
     'class'=> 'btn btn-primary',
                 'name'=>'submit'
                 );
        echo form_submit($data); ?>
   
    </div>
    
    
</div>





<style type="text/css">
    .error {
        color:red;
        font-size:13px;
        margin-bottom:-15px
    }</style>