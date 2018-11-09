

<div class="row"  ng-controller="MainCtrl">
    <?php //$id = isset($frm_data['id']) ? $frm_data['id'] : ''; ?>
    <?php //$tdid = isset($frm_data['tdid']) ? $frm_data['tdid'] : ''; ?>
    <?php //$userid = isset($frm_data['view']->userid) ? $frm_data['view']->userid : ''; ?>
    <?php //echo "@@<pre>";print_r($frm_data);die; ?>
    <?php echo form_open(); ?>
    <div class="col-md-6">
        <label>Success Parameter </label>
        <div class="form-group">
             <?php $data=array(
               'name'=>'successpara',
               'class'=>'form-control',
               'value' =>((isset($frm_data['view']->successpara)) && (!empty($frm_data['view']->successpara))) ? $frm_data['view']->successpara:""
                 );
              echo form_textarea($data); ?>
         </div>
        
        
    </div>
     <div class="col-md-3">
         <label>Start Date </label>
    <div class="form-group">
             <?php $data=array(
               'name'=>'startdate',
               'class' => 'gui-input form-control datepicker',
                 'id'=>'startdt',
               'value' =>((isset($frm_data['view']->startdate)) && (!empty($frm_data['view']->startdate))) ? $frm_data['view']->startdate:""
                 );
              echo form_input($data); ?>
         </div>
     </div>
     <div class="col-md-3">
         <label>End Date</label>
    <div class="form-group">
             <?php $data=array(
               'name'=>'enddate',
              'class' => 'gui-input form-control datepicker',
                    'id'=>'enddt',
               'value' =>((isset($frm_data['view']->enddate)) && (!empty($frm_data['view']->enddate))) ? $frm_data['view']->enddate:""
                 );
              echo form_input($data); ?>
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



<script type="text/javascript">
    $(function () {
        $(".datepicker").datepicker({format: "yyyy-mm-dd"});
        
            
            
        // set default dates
        var start = new Date();
        // set end date to max one year period:
        var end = new Date(new Date().setYear(start.getFullYear()+1));

        $('#startdt').datepicker({
        startDate : start,
        endDate   : end
        // update "toDate" defaults whenever "fromDate" changes
        }).on('changeDate', function(){
        // set the "toDate" start to not be later than "fromDate" ends:
        $('#enddt').datepicker('setStartDate', new Date($(this).val()));
        }); 

        $('#enddt').datepicker({
        startDate : start,
        endDate   : end
        // update "fromDate" defaults whenever "toDate" changes
        })
//        .on('changeDate', function(){
//         set the "fromDate" end to not be later than "toDate" starts:
//        $('#startdt').datepicker('setEndDate', new Date($(this).val()));
//        });
            
            
    });
</script>

<style type="text/css">
    .error {
        color:red;
        font-size:13px;
        margin-bottom:-15px
    }</style>

