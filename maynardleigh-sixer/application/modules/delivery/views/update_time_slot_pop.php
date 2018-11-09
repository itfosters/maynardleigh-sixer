<?php //echo $frmdata['resourceInfos']->return_date;die;   ?>
<?php
//$ids=isset($frmdata['resourceInfos']->id)?$frmdata['resourceInfos']->id:''; 
$asfgfg = array('1' => 'jjhjh',
    '2' => 'hjh');
?>
<div class="popup_boxes trail_periods_block">

    <div class="col-md-8 col-md-offset-2" style="background-color: #fff; padding-top: 40px;">

        <form action="<?php echo site_url('admin/delivery/updateTimeSlotWithUser'); ?>" method="post" accept-charset="utf-8" id="" name="" class="form-bordered ">  
            <input type="hidden" name="order_id" value="<?php echo isset($frmdata['order_id']) ? $frmdata['order_id'] : ''; ?>">
            <input type="hidden" name="delivery_id" value="<?php echo isset($frmdata['delivery_id']) ? $frmdata['delivery_id'] : ''; ?>">
            <input type="hidden" name="resource_id" value="<?php echo isset($frmdata['resource_id']) ? $frmdata['resource_id'] : ''; ?>">
            <input type="hidden" name="timeslotid" value="<?php echo isset($frmdata['timeslotid']) ? $frmdata['timeslotid'] : ''; ?>">
            <input type="hidden" name="otimestampstart" value="<?php echo isset($frmdata["singlerecord"]->timestampstart) ? $frmdata["singlerecord"]->timestampstart : ''; ?>">
            <input type="hidden" name="otimestampend" value="<?php echo isset($frmdata["singlerecord"]->timestampend) ? $frmdata["singlerecord"]->timestampend : ''; ?>">
            <input type="hidden" name="userid" value="<?php echo isset($frmdata["user_id"]) ? $frmdata["user_id"]: ''; ?>">
            <div class="col-md-12 form-group" >

                <h1 class="page-head-line"> Edit Details: </h1>
                <div class="trf-droup" >

                    <div class="col-md-3">
                        <div class="form-group">
                            <label> Start Time </label>
                            <?php
                            $data = array('name' => 'starttime',
                                'class' => 'gui-input form-control',
                                'placeholder' => 'Start Time',
                                'id' => 'lunchstarttime',
                                'value' => isset($frmdata["singlerecord"]->timestampstart) ? date('h:i A', $frmdata["singlerecord"]->timestampstart) : ''
                            );
                            echo form_input($data);
                            ?> <?php echo form_error('lunchstarttime'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>End Time</label>
                            <?php
                            $data = array('name' => 'endtime',
                                'class' => 'gui-input form-control',
                                'placeholder' => 'End Time',
                                'id' => 'lunchendtime',
                                'value' => isset($frmdata["singlerecord"]->timestampend) ? date('h:i A', $frmdata["singlerecord"]->timestampend) : ''
                            );
                            echo form_input($data);
                            ?>  <?php echo form_error('lunchendtime'); ?>
                        </div>
                    </div>

                    <div class="col-md-3<?php echo $frmdata['singlerecord']->lunchflage==1 ? ' hide':'';  ?>" >
                        <div class="form-group">
                            <label> Select User </label>
                            <?php
                            if (isset($frmdata['userlist'])) {
                                $alloption = $frmdata['userlist'];
                                $selectedOption = isset($frmdata["user_id"])?$frmdata["user_id"]:array();
                                echo form_dropdown('selectuser', $alloption, $selectedOption, 'class="fixed form-control" id="name_of_dlvproducts"');
                            } else {
                                echo form_dropdown('selectuser', $proname, isset($frmdata['userlist']) ? $frmdata['userlist'] : array(), 'class="form-control" id="name_of_dlvproducts" ');
                            }
                            ?>
                            <?php echo form_error('lunchstarttime'); ?>
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

</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#lunchstarttime').timepicker({'timeFormat': 'h:i A'});
        $('#lunchendtime').timepicker({'timeFormat': 'h:i A'});
    })
</script>



