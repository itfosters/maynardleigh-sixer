<?php
//$ids=isset($frm_data['resourceInfos']->id)?$frm_data['resourceInfos']->id:''; 
//echo "<pre>";print_r($frm_data);die;
?>
<div class="popup_boxes trail_periods_block">

    <div class="col-md-8 col-md-offset-2" style="background-color: #fff; padding-top: 40px;">
        <div class="trf-droup" >
<?php echo $frm_data['preview']; ?>
        </div>
        <div class="send-email-button">
         <?php    
            echo form_open('admin/delivery/mailTravelRequestFormClient');
        $data=array('name'=>'oid','value'=>$frm_data['order_id'],'class'=>'hidden');
        echo form_input($data);
        $data=array('name'=>'digid','value'=>$frm_data['diagnose_id'],'class'=>'hidden');
        echo form_input($data);
        $data=array('name'=>'user_id','value'=>$frm_data['user_id'],'class'=>'hidden');
        echo form_input($data);
        $data=array('name'=>'email','value'=>$frm_data['email'],'class'=>'hidden');
        echo form_input($data);
        //$data=array('name'=>'selection[]','value'=>$frm_data['selection'],'class'=>'hidden');
        //echo form_input($data);
                
       $data=array('class'=>'form-control hidden','id'=>'selectedcategory','multiple'=>'multiple');
        $dataselect = array('air'=>'Air','train'=>'Train','Hotel'=>'Hotel','Venue'=>'Venue','cab'=>'Cab');
         //$selected = array('air','train','Hotel','Venue','cab');
        echo form_dropdown('selection[]',$dataselect,$frm_data['selection'],$data);         
                
                
                
        echo form_submit('submit','Send','class="btn btn-primary" onclick="return confirm (Are you so sure for send this email for resource ?)"');
        echo form_close();
          //$data=array('name'=>'id','value'=>$where['id'],'class'=>'hidden');
        //echo form_input($data);
        ?>
            
            
            
        </div>
    </div>
</div>