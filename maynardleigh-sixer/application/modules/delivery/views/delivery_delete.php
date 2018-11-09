<?php //echo $frm_data['resourceInfos']->return_date;die;  ?>
<?php //$ids=isset($frm_data['resourceInfos']->id)?$frm_data['resourceInfos']->id:''; 
?>
<div class="popup_boxes trail_periods_block">

    <div class="col-md-8 col-md-offset-2" style="background-color: #fff; padding-top: 40px;">

        <form action="<?php echo site_url('admin/delivery/delete'); ?>" method="post" accept-charset="utf-8" id="" name="" class="form-bordered ">  
            <input type="hidden" name="order_id" value="<?php echo isset($frm_data['order_id']) ? $frm_data['order_id'] : ''; ?>">
            <input type="hidden" name="diagnose_id" value="<?php echo isset($frm_data['diagnose_id']) ? $frm_data['diagnose_id'] : ''; ?>">
            <input type="hidden" name="user_id" value="<?php echo isset($frm_data['user_id']) ? $frm_data['user_id'] : ''; ?>">
            <input type="hidden" name="ids" value="<?php echo isset($frm_data['resourceInfos']->id) ? $frm_data['resourceInfos']->id : ''; ?>">
            <div class="col-md-12 form-group" >

                <h1 class="page-head-line"> Add Reason for delete: </h1>
                <div class="trf-droup" >

                    <div class="col-sm-4 from">
                    <div class="form-group">
                    <label><b> Reason </b> </label>
                    <input required="required" type="text" class="form-control" name="deletereason" value="<?php echo isset($frm_data['resourceInfos']->journey_from)?$frm_data['resourceInfos']->journey_from:''; ?>" >
                    </div>
                    </div>


                </div>

                <div class="col-md-6">
                    <input type="submit" class="btn btn-primary mb10" value="submit" name="submit"> 
                </div>
                <?php echo form_close(); ?>
            </div>
    </div>
    <!-- end dropdown menu -->

</div>





