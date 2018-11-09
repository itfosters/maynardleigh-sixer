 <?php //$ids=isset($frm_data['resourceInfos']->id)?$frm_data['resourceInfos']->id:''; 
//echo "<pre>";print_r($frm_data);die;
 ?>
<div class="popup_boxes trail_periods_block">

  <div class="col-md-8 col-md-offset-2" style="background-color: #fff; padding-top: 40px;">
    <div class="trf-droup" >
      <?php echo $frm_data['preview']; ?>
    </div>
      <div class="send-email-button">
          <a class="btn btn-primary mb10" onclick="return confirm ('Are you so sure for send this email for resource ?')" title="Send To Resource" href="<?php echo site_url('admin/delivery/mailVenderRequestForm/'.$frm_data['order_id'].'/'.$frm_data['diagnose_id'].'/'.$frm_data['user_id']); ?>">Send Mail</i></a> 
      </div>
   </div>
 </div>