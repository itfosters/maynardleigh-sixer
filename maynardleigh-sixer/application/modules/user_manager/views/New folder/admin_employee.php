<div class="row mb10">
    <div class="col-sm-12">
        <?php echo form_open("admin/user/employee",array("id"=>"frmserach")); ?>
        <div class="input-group mb15 col-sm-5">
            <input type="text" name="q" id="txtsearch" class="form-control" value="<?php echo isset($frm_data["q"])?$frm_data["q"]:""; ?>" />
            <span class="input-group-btn">
                <button type="submit" name="btnsearch" id="btnsearch" class="btn btn-primary">Search</button>
            </span>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">                         
        <div class="table-responsive">

            <?php echo form_open("admin/user/delete",array("id"=>"frmitf"),array("itfids"=>"","itfaction"=>"")); ?>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="event_row">#</th>             
                        <th>Name</th>
                        <th>Email</th>
                        <th class="col-md-2">Group</th>
                        <th class="col-md-1">Status</th>
                        <th class="col-md-1">Modify</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($results as $k=>$itfdata) { ?>
                    <tr>
                        <td><?php echo $k+1;  ?></td>
                        <td><?php echo $itfdata->name; ?></td>
                        <td><?php echo $itfdata->email; ?></td>
                        <td><?php echo $this->config->item($itfdata->user_type,"user_type"); ?></td>
                        <td><a title="<?php echo ($itfdata->status=="1")?"Activeted":"Deactiveted" ?>" data-toggle="tooltip" class="tooltips" ><i class="fa <?php echo !empty($itfdata->status)?'fa-unlock':'fa-lock'; ?>"></i></a></td> 
                        <td><a href="<?php echo site_url("admin/user/detail/".$itfdata->id ); ?>" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a></td>

                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
            <?php echo form_close(); ?>
        </div><!-- table-responsive -->
    </div><!-- col-md-6 -->     
    <div class="col-xs-12">
            <?php echo $links; ?>
    </div>

</div>