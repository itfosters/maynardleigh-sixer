<?php //echo $frm_data['resourceInfos']->return_date;die; ?>
 <?php //$ids=isset($frm_data['resourceInfos']->id)?$frm_data['resourceInfos']->id:''; 
//echo "<pre>";print_r($where);die;
 ?>
<div class="popup_boxes trail_periods_block">

  <div class="col-md-8 col-md-offset-2" style="background-color: #fff; padding-top: 40px;">
    <div class="trf-droup" >
      <div class="travel" >
       <div class="popup_boxes trail_periods_block">
        <?php
        //echo form_open('admin/delivery/mailTravelRequestFormClient');
        echo form_open('admin/delivery/mailTravelRequestFormClientPreview');
        $data=array('name'=>'oid','value'=>$where['oid'],'class'=>'hidden');
        echo form_input($data);
        $data=array('name'=>'digid','value'=>$where['digid'],'class'=>'hidden');
        echo form_input($data);
        $data=array('name'=>'user_id','value'=>$where['user_id'],'class'=>'hidden');
        echo form_input($data);
          //$data=array('name'=>'id','value'=>$where['id'],'class'=>'hidden');
        //echo form_input($data);
        ?>
        <label>Enter Email ID</label>
        <div class="form-group">
          
          <?php
            $data=array('name'=>'email','class'=>'form-control');
            echo form_input($data);
       
          ?>
        </div>
        <div class="form-group">
            <label>Select Option</label>
        <?php
        $data=array('class'=>'form-control','id'=>'selectedcategory','multiple'=>'multiple');
        $dataselect = array('air'=>'Air','train'=>'Train','Hotel'=>'Hotel','Venue'=>'Venue','cab'=>'Cab');
        $selected = array('air','train','Hotel','Venue','cab');
        echo form_dropdown('selection[]',$dataselect,$selected,$data);
        ?>
        </div>
        <div class="form-group">
        <?php
     echo form_submit('submit','Preview Email','class="btn btn-primary"');
     echo form_close();
        ?>
        </div>
          
        </div>
    </div>
    </div>
   </div>
 </div>
<script type="text/javascript">
  jQuery(document).ready(function(){$('#selectedcategory').selectpicker()});
</script>
