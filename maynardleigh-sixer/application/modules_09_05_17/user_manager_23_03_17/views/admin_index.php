<?php //echo "@@@<pre>";print_r($frm_data["q"]);die;?>
<div class="row">
<div class="col-md-6">
<?php echo form_open("admin/user_manager", array("id" => "search")); ?>
   <div class="input-group form-group" style="margin-left: 3px;">
      <input type="text" name="q" placeholder="Search" class="form-control" value="<?php echo isset($frm_data['q'])?$frm_data['q']:''; ?>"/>
      <div class="input-group-btn">
         <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
      </div>
   </div>
<?php form_close();?>
</div>
<div class="col-md-2 pull-right"> 
  
   <!--<a type="button" class="btn btn-primary" value="view_details" href="<?php //echo site_url('delivery/insert'.'/'.$ids)?>">Add Delivery</a>-->
                 <div class="dropdown text-right">
                        <a class="dropdown-toggle btn btn-primary" data-toggle="dropdown" href="#">
                            Action <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="<?php echo site_url('admin/user_manager/form'); ?>"><i class="fa fa-plus-circle"></i> Add</a></li>
                            <li class="divider"></li>
                            <li><a class="itfdelete" name="delete" href="#"><i class="fa fa fa-trash-o"></i> Delete</a>
                            </li>
                        </ul>
                    </div>
</div>
</div>
<div class="row">
    <div class="col-md-12">                         
        <div class="table-responsive">
            <?php echo form_open("admin/user_manager/deleted", array("id" => "frmitf")); ?>
             <?php echo form_input(array('type'=>'hidden','name'=>'itfid','id'=>'itfids'));?>
            <?php echo form_input(array('type'=>'hidden','name'=>'itfaction','id'=>'itfaction'));?>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th><?php echo form_checkbox(array('id' => 'itfactionevents', 'name' => 'itfactionevents', 'value' => 'all', 'checked' => false)); ?></th>
                        <th class="event_row">ID</th>
                        <th>Name</th>             
                        <th>Email Id</th>
                        <th>Contact No</th>
                        <th colspan="3">Action</th> 
                        
                        
                    </tr>
                </thead>
                <tbody>
                    <?php //echo "!!!@@<pre>";print_r($frmdata['searchdata']);die;?>
                    <?php foreach($all as $k=>$itfdata) { 
                        //if(isset($searchdata) and ($frmdata['searchdata']->email==$itfdata->email) or ($frmdata['searchdata']->name==$itfdata->name) ) {?>
                    <tr>
                        <td><?php echo form_checkbox(array('class' => 'itfrowdatas', 'name' => 'itfrowdata[]', 'value' => $itfdata->id)); ?></td>
                        <td><?php echo $itfdata->id;?></td>
                        <td><?php echo $itfdata->name; ?></td>
                        <td><?php echo $itfdata->email; ?></td>
                        <td><?php echo $itfdata->contact_no; ?></td>
                        <td><a href="<?php echo site_url('admin/user_manager/form/'.$itfdata->id); ?>" title="Edit"><i class="fa fa-pencil"></i></a> </td>
                         <td><a href="<?php echo site_url('admin/user_manager/deleted/'.$itfdata->id); ?>" onclick="return confirm('Are you sure?')" title="Delete"><i class="fa fa-trash-o"></i></a></td>
                        
                    </tr>
                    <?php  }?>
                </tbody>
            </table>
            
        </div><!-- table-responsive -->
    </div><!-- col-md-6 -->     
    <div class="col-xs-12">
            <?php echo $link; //echo "@@@<pre>";print_r($frmdata['searchdata']->name);die;?>
    
    </div>


</div>
<?php if(isset($frmdata['searchdata'])){?>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <td><?php echo $frmdata['searchdata']->id;?></td>
            <td><?php echo $frmdata['searchdata']->name;?></td>
            <td><?php echo $frmdata['searchdata']->email;?></td>
            <td><?php echo $frmdata['searchdata']->contact_no;?></td>
        </tr>
    </table>
<?php }?>

<script type="text/javascript">
            $(document).ready(function(){
            //Active and delete

            $('#itfactionevents').click(function(event) {
            if (this.checked) {
            $('.itfrowdatas').each(function() {
            this.checked = true;
            });
            } else {
            $('.itfrowdatas').each(function() {
            this.checked = false;
            });
            }
            });

            var checkboxes = $("#frmitf input[type='checkbox']"),
            submitButt = $(".itfdelete");

            submitButt.unbind("click");
            submitButt.attr("disabled", true);

            checkboxes.click(function() {
            if (!checkboxes.is(":checked")) {
            submitButt.unbind("click");
            } else {
            submitButt.bind("click");
            }
            submitButt.attr("disabled", !checkboxes.is(":checked"));
            });
            //End Active and delete

            $(".itfdelete").click(function() {

            var ids = $(this).attr("name");

            if (ids == "delete") {
            if (confirm("Do you want to delete ?")) {
            $("#itfaction").val("delete");

            $("#frmitf").submit();
            }
            } else {
            $("#itfaction").val(ids);
            $("#frmitf").submit();
            }

            });


            });

</script>