
<div id="page-inner">
<div class="row">
<?php echo form_open_multipart();?>
<div class="col-md-12 text-center jumbotron "> 
    <div class="col-md-2"><a href="<?php echo site_url().'assests/itf_public/sampleexcels/sample_catalyst_call_import_users.xls' ?>">Download Sample Excel for import</a></div>
    <div class="col-md-2"><b>Please Import your excel...</b></div>
    <div id="brw" class="col-md-4">
          <div>
             <input id="file_browse1" name="tmpdocuments" type="file">
          </div>
    </div>

    <div id="brw" class="col-md-4">
    <div>
       <input class="btn btn-primary" style=" float:right;" name='submit' value="Submit" type="submit">
    </div>
    </div>
</div>
     <?php echo form_close();?>
    </div>
              

<div class="row">
<div class="col-md-4">
<form action="#" method="post" accept-charset="utf-8" id="search">   <div class="input-group form-group" style="margin-left: 3px;">
      <input name="q" placeholder="Search" class="form-control" value="" type="text">
      <div class="input-group-btn">
         <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
      </div>
   </div>
</form>
</div>
<div class="col-md-4 pull-right"> 
                  <div class="col-md-4 ">
                      <p style="font-size: 15px">Assign User</p>
                  </div>
                    <a type="button" value="view_details" title="Assing User" class="travel-pop btn btn-primary" href="<?php echo site_url('admin/delivery/assignUser/'.$frmdata['oid'].'/'.$frmdata['dlvid']);?>">
                    <i class="fa fa-user"></i></a>
     <!-- <div class="dropdown text-right">
                        <a class="dropdown-toggle btn btn-primary" data-toggle="dropdown" href="#">
                            Action <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="#"><i class="fa fa-plus-circle"></i> Add</a></li>
                            <li class="divider"></li>
                            <li><a class="itfdelete" name="delete" href="#" disabled="disabled"><i class="fa fa fa-trash-o"></i> Delete</a>
                            </li>
                        </ul>
                    </div> -->

</div>
</div>
<div class="row">
<?php //echo "<pre>";print_r($frmdata['showuserdata']);die; ?>
    <div class="col-md-12">
               <?php if(count($frmdata['showuserdata'])>0){ ?>              
        <div class="table-responsive">

                         <input name="itfid" value="" id="itfids" type="hidden">            
                         <input name="itfaction" value="" id="itfaction" type="hidden">            
                         <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
<!--                        <th><input name="itfactionevents" value="all" id="itfactionevents" type="checkbox"></th>-->
                        <th></th>
                        <th class="event_row">ID</th>
                        <th>Participant(s)</th>             
                        <th>Email Id</th>
                        <th>Contact No</th>
                        <th colspan="3">Action</th> 
                        
                        
                    </tr>
                </thead>
                <tbody>
                <?php //echo '<pre>';print_r($frmdata);die;?>
                <?php foreach ($frmdata['showuserdata'] as $key => $value) {?>
                    <tr>
                        <td><input name="itfrowdata[]" value="103" class="itfrowdatas" type="checkbox"></td>
                        <td><?php echo $value->id;?></td>
                        <td><?php echo $value->name;?></td>
                        <td><?php echo $value->email;?></td>
                        <td><?php echo $value->contact_no;?></td>
                        <!-- <td><a href="<?php //echo site_url('admin/user_manager/form/'.$value->id.'/'.$value->order_id.'/'.$value->delivery_id); ?>" title="Edit"><i class="fa fa-pencil"></i></a> </td> -->
                         <td><a href="<?php echo site_url('admin/delivery/userDelete/'.$value->order_id.'/'.$value->delivery_id.'/'.$value->id); ?>" onclick="return confirm('Are you sure?')" title="Delete"><i class="fa fa-trash-o"></i></a></td>
                        
                    </tr>
                     <?php }?>                   
                                       
                    </tbody>
            </table>
            
        </div>
        

        <!-- table-responsive -->
    </div><!-- col-md-6 -->     
    <div class="col-xs-12">
                
    </div>


</div><?php } else{echo 'No Record Found';}?>

</div>