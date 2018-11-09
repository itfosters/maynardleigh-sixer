<?php //echo "<pre>";print_r($alldata);die;?>
<div class="row">
    <div class="col-md-6"> 
        <div class="input-group form-group" style="margin-left: 3px;">
            <input type="text" name="q" placeholder="Search" class="form-control">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
    </div> 
  <div class="col-md-6 text-right"> 
  <a href="<?php echo site_url('admin/order/add_order');?>" target="" value="Add New" class="btn btn-primary" type="button">Add New</a>
</div>
</div>

<div class="clearfix"></div>
  <!-- Trigger the modal with a button -->
 <div class="table-responsive">
<div id="accordion" role="tablist" aria-multiselectable="true">
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> </a>
         <div role="button"  class="thead-inverse deal">
          <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover" summary="">
        <thead class="thead-inverse">
            
            <tr>
                <!--<th><input type="checkbox" name="" id="selecctall" value="1" title="Select All"></th>-->
                <th>Id</th>
                <th>Order Id</th>
                <th>Client </th>
                <th>Sales</th>
                <th>Manager</th>
                <!-- <th>Economic Buyer </th> -->
                
                <th>Location</th>
                <th>Contact</th>
                <th>Email</th>
                <th colspan="7">Action</th>
                 
            </tr>  
          
          </thead>
          <tbody>
            <?php
              //echo "<pre>";print_r($alldata[0]->id);die;
             foreach ($alldata as $key => $value) {
              //echo "<pre>";print_r($value);die;?>
              <tr>
              <!--<td><?php //echo form_checkbox(array('name'=>'id','class'=>'checkbox1','value'=>'accept','checked'=>FALSE));?></td>-->
              <td><?php echo $value->id;?></td>
              <td><?php echo $value->order_Id;?></td>
              <td><?php echo $value->clientname;?></td>
              <td><?php echo $value->salesname;?></td>
              <td><?php echo $value->managername;?></td>
              <td><?php echo $value->location;?></td>            
              <td><?php echo $value->contact_No;?></td>
              <td><?php echo $value->email_Id;?></td>
              
              <td> 
              <a type="button" class="" value="view_details"  title="View Details" href="<?php echo site_url('admin/order/details/'.$value->id);?>">
              <i class="fa fa-eye "></i></a>
              </td>
             
           
              <td> 
              <a type="button" class="" value="view_details"  title="Diagnose" href="<?php echo site_url('admin/diagnose/index/'.$value->id)?>">
              <i class="fa fa-search-plus"></i></a>
              </td>
              <td> 
              <a type="button" class="" value="view_details" title="Design" href="<?php echo site_url('admin/design/index/'.$value->id);?>">
              <i class="fa fa-qrcode "></i></a>
              </td>
              <td> 
              <a type="button" class="" value="view_details" title="Delivery" href="<?php echo site_url('admin/delivery/index/'.$value->id);?>">
              <i class="fa fa-paper-plane "></i></a>
              </td>
              <td> 
              <a type="button" class="" value="view_details" title="Discovery"  href="<?php echo site_url('admin/discovery/index/'.$value->id);?>">
               <i class="fa fa-arrows-alt"></i></a>
              </td>
              <td> 
              <a type="button" class="" value="view_details"  title="Delete" href="<?php echo site_url('admin/order/delete/'.$value->id)?>"onclick="return confirm('Are you sure?')">
              <i class="fa fa fa-trash-o"></i></a>
              </td>
              <td> 
              <a type="button" class="" value="view_details"  title="Update" href="<?php echo site_url('admin/order/add_order/'.$value->id)?>">
              <i class="fa fa-pencil"></i></a>
              </td>
          </tr>
           <?php  }?>

           
            
            
           
          </tbody>

          
        </table>

        
        </div>
        <?php echo $links ; ?>
          </div>

    </div>
  </div>
  