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
          <?php if (count($alldata)>0) { ?>
          <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover" summary="">
        <thead class="thead-inverse">
            
            <tr>
                <!--<th><input type="checkbox" name="" id="selecctall" value="1" title="Select All"></th>-->
                <th>S.No</th>
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
             foreach ($alldata as $key => $value) {?>
              <tr>
              <?php if($value->orderstatus=='2')
                  $i=0;
                else if($value->orderstatus=='1')
                  $i=1;
                else
                  $i=2;
              ?>
              <td class="colors<?php echo $i;?>"><?php echo $key+1;?></td>
              <td class="colors<?php echo $i;?>"><?php echo $value->order_Id;?></td>
              <td class="colors<?php echo $i;?>"><?php echo $value->clientname;?></td>
              <td class="colors<?php echo $i;?>"><?php echo $value->salesname;?></td>
              <td class="colors<?php echo $i;?>"><?php echo $value->managername;?></td>
              <td class="colors<?php echo $i;?>"><?php echo $value->location;?></td>            
              <td class="colors<?php echo $i;?>"><?php echo $value->contact_No;?></td>
              <td class="colors<?php echo $i;?>"><?php echo $value->email_Id;?></td>
              
              <td> 
              <a type="button" class="" value="view_details"  title="View Details" href="<?php echo site_url('admin/order/details/'.$value->id);?>">
              <i class="fa fa-eye"></i></a>
              </td>
              <?php 
                if(isset($value->statusdata[1])) {
                  if(isset($value->statusdata[1]["R"]) and $value->statusdata[1]["R"]>0){
                    $i=0;
                  }else if($value->statusdata[1]["R"]==0 and  $value->statusdata[1]["N"]==0){
                    $i=1;
                  }else{
                    $i=2;
                  } 
                }else{
                  $i=2;
                }
              ?>
              <td class="colors<?php echo $i;?>"> 
              <a type="button" class="" value="view_details"  title="Diagnose" href="<?php echo site_url('admin/diagnose/index/'.$value->id)?>">
              <i class="fa fa-search-plus"></i></a>
              </td>
              
              <?php 
                if(isset($value->statusdata[2])) {
                  if(isset($value->statusdata[2]["R"]) and $value->statusdata[2]["R"]>0){
                    $i=0;
                  }else if($value->statusdata[2]["R"]==0 and  $value->statusdata[2]["N"]==0){
                    $i=1;
                  }else{
                    $i=2;
                  } 
                }else{
                  $i=2;
                }
              ?>

              <td class="colors<?php echo $i;?>"> 
              <a type="button" class="" value="view_details" title="Design" href="<?php echo site_url('admin/design/index/'.$value->id);?>">
              <i class="fa fa-qrcode "></i></a>
              </td>
              
               <?php 
                if(isset($value->statusdata[3])) {
                  if(isset($value->statusdata[3]["R"]) and $value->statusdata[3]["R"]>0){
                    $i=0;
                  }else if($value->statusdata[3]["R"]==0 and  $value->statusdata[3]["N"]==0){
                    $i=1;
                  }else{
                    $i=2;
                  } 
                }else{
                  $i=2;
                }
              ?>

              <td class="colors<?php echo $i; ?>"> 
              <a type="button" class="" value="view_details" title="Delivery" href="<?php echo site_url('admin/delivery/index/'.$value->id);?>">
              <i class="fa fa-paper-plane "></i></a>
              </td>
               <?php 
                if(isset($value->statusdata[4])) {
                  if(isset($value->statusdata[4]["R"]) and $value->statusdata[4]["R"]>0){
                    $i=0;
                  }else if($value->statusdata[4]["R"]==0 and  $value->statusdata[4]["N"]==0){
                    $i=1;
                  }else{
                    $i=2;
                  } 
                }else{
                  $i=2;
                }
              ?>
              <td class="colors<?php echo $i; ?>"> 
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
        <?php }else{?>
        
                  <div class="page-head-line"></div>
                  <div class="notfound_text">Sorry!</div>
                  <div class="norecordfound">No order Found</div>
        <?php } ?>
        </div>
        
        <?php echo $links ; ?>
      </div>

    </div>
  </div>
  <script type="text/javascript">
             $(document).ready(function(){

            $('#clock').on('click', function() {
              //alert('hello');
            $('#modal').show('1000');
            //$('#modal').css('z-index', '1500');
            });
           
        });
      </script>
  
  