<?php //echo "<pre>";print_r($frmdata);die;?>

<div class="row">
<div class="col-md-6">
<?php echo form_open("order/goal", array("id" => "search")); ?>
    <div class="input-group form-group" style="margin-left: 3px;">
    <input type="text" name="q" placeholder="Search" class="form-control" value="<?php echo isset($frm_data['q'])?$frm_data['q']:''; ?>">
    <div class="input-group-btn">
    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
    </div>
    </div>
<?php form_close();?>
</div>
<?php //echo "<pre>";print_r($frmdata['all']);die; ?>
<?php if(count($frmdata['all'])!=3) {?>
<div class="col-md-2 pull-right"> 


    <a class='btn btn-primary' href="<?php echo site_url('order/addGoal'); ?>"><i class="fa fa-plus-circle"></i>&nbsp;Add Goal</a>
   </div>
   <?php } else{?>
   <div class="col-md-2 pull-right"> 
    <a class='btn btn-primary' href="<?php echo site_url('order'); ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
&nbsp;Go To Order Listing</a>
   </div>
   <?php }?>

<div class="col-md-12">
    <?php if(count($frmdata['all'])>0){?>
<div class="table-responsive">
<?php echo form_open("order/delete", array("id" => "frmitf")); ?>      
  
<table class="table table-striped table-bordered table-hover">
<thead>
  <tr>
        <!-- <th><?php //echo form_checkbox(array('id' => 'itfactionevents', 'name' => 'itfactionevents', 'value' => 'all', 'checked' => false)); ?></th> -->
        <th>ID</th>
        <th>Goal</th>             
        <th colspan="3">Action</th>
    </tr>
</thead>
<tbody>
    <?php foreach($frmdata['all'] as $k=>$itfdata) { ?>
    <tr>
        <!-- <td><?php //echo form_checkbox(array('class' => 'itfrowdatas', 'name' => 'itfrowdata[]', 'value' => $itfdata->id)); ?></td> -->
        <td><?php echo $k+1; ?></td>
        <td><?php echo $itfdata->goal; ?></td>
        <td><a type="button" href="<?php echo site_url('order/addGoal/'.$itfdata->id); ?>" title="Update"><i class="fa fa-pencil"></i></a></td>
        <td><a type="button" href="<?php echo site_url('order/delete/'.$itfdata->id); ?>" title="Delete" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash-o"></i></a></td>
        <!--<td><a type="button" href="<?php //echo site_url('order/myTodo/'.$itfdata->id); ?>" title="My TO DO" " ><i class="fa fa-file-text-o" aria-hidden="true"></i>-->
        <td><a type="button" href="<?php echo site_url('order/successParameter/'.$itfdata->id); ?>" title="Success Parameter" " ><i class="fa fa-bullseye" aria-hidden="true"></i>
</a></td>
    </tr>
    <?php  } ?>
</tbody>
</table><?php echo form_close(); ?>
    <?php } else{ echo 'Goals not found';}?> 
</div><!-- table-responsive -->
</div><!-- col-md-6 -->     
<div class="col-xs-12">
<?php //echo $link; ?>
</div>

</div>
<script type="text/javascript">
$(document).ready(function(){
    // alert('ghghghg')
    //  $(':input[type="submit"]').prop('disabled', true);
    //  $('input[type="text"]').keyup(function() {
    //     if($(this).val() != '') {
    //        $(':input[type="submit"]').prop('disabled', false);
    //     }
    //  });
     })

</script>
