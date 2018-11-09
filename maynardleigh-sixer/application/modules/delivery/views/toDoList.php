<?php //echo "<pre>";print_r($tolist);die;  ?>

<div class="row">
<div class="col-md-6">
<?php echo form_open('', array("id" => "search")); ?>
    <div class="input-group form-group" style="margin-left: 3px;">
    <input type="text" name="q" placeholder="Search" class="form-control" value="<?php echo isset($frm_data['q'])?$frm_data['q']:''; ?>">
    <div class="input-group-btn">
    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
    </div>
    </div>
<?php form_close();?>
</div>
<?php //echo "<pre>";print_r(count($all));die; ?>

<div class="col-md-2 pull-right"> 
    <a class='btn btn-primary' href="<?php echo site_url('delivery/addTodo/'.$oid.'/'.$delvid.'/'.$uid.'/'.$goalid.'/'.$successParaid); ?>"><i class="fa fa-plus-circle"></i>&nbsp;Add To Do</a>
   </div>

<div class="col-md-12">                         
<div class="table-responsive">
<?php echo form_open("order/delete", array("id" => "frmitf")); 

if(count($tolist)>0){
?>      
  
<table class="table table-striped table-bordered table-hover">
<thead>
  <tr>
        <!-- <th><?php //echo form_checkbox(array('id' => 'itfactionevents', 'name' => 'itfactionevents', 'value' => 'all', 'checked' => false)); ?></th> -->
        <th>ID</th>
        <th>Todo</th>             
        <th colspan="3">Action</th>
    </tr>
</thead>
<tbody>
    <?php //echo '<pre>';print_r($tolist);die;
    foreach($tolist as $k=>$itfdata) { 
     //echo '<pre>';print_r($itfdata->status);die;
        ?>
    <tr>
        <!-- <td><?php //echo form_checkbox(array('class' => 'itfrowdatas', 'name' => 'itfrowdata[]', 'value' => $itfdata->id)); ?></td> -->
        <td><?php echo $k+1; ?></td>
        <td><?php echo $itfdata->todo; ?></td>
        <?php if(isset($itfdata->status)&&($itfdata->status==0)){?>
        <td><a type="button" href="<?php echo site_url('delivery/addTodo/'.$itfdata->orderid.'/'.$itfdata->deliveryid.'/'.$itfdata->user_id.'/'.$itfdata->goalid.'/'.$itfdata->successparaId.'/'.$itfdata->id); ?>" title="Update"><i class="fa fa-pencil"></i></a></td>
        <td><a type="button" href="<?php echo site_url('delivery/deleteTodo/'.$itfdata->orderid.'/'.$itfdata->deliveryid.'/'.$itfdata->user_id.'/'.$itfdata->goalid.'/'.$itfdata->successparaId.'/'.$itfdata->id); ?>" title="Delete" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash-o"></i></a></td>
        
        <td><?php echo 'Pending';?></td>
        <?php } else {?>
                <td><?php echo 'Done';?></td>
          <?php  }?>
    </tr>
    <?php  } ?>
</tbody>
</table><?php echo form_close(); ?>
<?php } else{ echo 'Todo Not found';}?>
</div><!-- table-responsive -->
</div><!-- col-md-6 -->     
<div class="col-xs-12">
<?php //echo $link; ?>
</div>

</div>
