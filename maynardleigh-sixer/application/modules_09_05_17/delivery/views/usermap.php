<div class="popup_boxes trail_periods_block">
  <div class="col-md-6 col-md-offset-3" style="background-color: #fff; padding-top: 40px;">
    <?php echo form_open('admin/delivery/setUser'); 
    //echo "<pre>";print_r('trdytfugfykt'.$frmdata['oid']);die;?>
    <?php echo form_hidden('orderid',$frmdata['oid']);?>
    <?php echo form_hidden('deliveryid',$frmdata['dlvid']);?>
        <div class="col-md-6 form-group" >
          <h1 class="page-head-line"> Add/Update Users: </h1>
          <div class="trf-droup" >
            <div  class="col-sm-3">
              <div class="form-group">
                <div class="col-md-12">
                  <div class="form-group"> 
                  <label>Users</label>
                  <?php echo form_dropdown('dnocasting[]',$frmdata['assignuser'],isset($frmdata['selecteduser'])?$frmdata['selecteduser']:array(), ' multiple="multiple" class="selectpicker form-control" id="no_of_casting"');?> 
                  </div>
                  <div class="form-group">
                     <input type="submit" class="btn btn-primary mb10" value="submit" name="submit">
                  </div>
                </div> 
              </div>
            </div>
          </div>
      </div>
    <?php echo form_close(); ?>
  </div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function(){$('#no_of_casting').selectpicker();});
</script>
