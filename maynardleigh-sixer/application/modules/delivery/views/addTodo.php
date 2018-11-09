

<div class="row"  ng-controller="MainCtrl">
    
    <?php //$userid = isset($frm_data['view']->userid) ? $frm_data['view']->userid : ''; ?>
    <?php //echo "@@<pre>";print_r($frm_data);die; ?>
    <?php echo form_open(); ?>
    <div class="col-md-6">
        <label> TO DO </label>
        <div class="form-group">
             <?php $data=array(
               'name'=>'todo',
               'class'=>'form-control',
                 'value' =>((isset($frm_data['view']->todo)) && (!empty($frm_data['view']->todo))) ? $frm_data['view']->todo:""
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

