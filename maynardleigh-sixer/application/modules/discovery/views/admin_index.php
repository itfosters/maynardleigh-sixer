

<?php //echo "<pre>";print_r($all);die;?>

<div class="row">
<div class="col-md-6">
<?php echo form_open("admin/discovery/index/".$ids, array("id" => "search")); ?>
   <div class="input-group form-group" style="margin-left: 3px;">
      <input type="text" name="q" placeholder="Search" class="form-control" value="<?php echo isset($frm_data['q'])?$frm_data['q']:''; ?>">
      <div class="input-group-btn">
         <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
      </div>
   </div>
<?php form_close();?>
</div>
<div class="col-md-6 text-right">
   <a type="button" class="btn btn-primary" value="view_details" href="<?php echo site_url('admin/discovery/form/'.$ids)?>">Add Discovery</a>
   
</div>
</div>
<div class="clearfix"></div>
<!-- Trigger the modal with a button -->
 <?php if (count($all)>0) { ?>
                  <div class="table-responsive">
                     <table class="table table-bordered table-hover  table-inverse" summary="">
                        <thead class="thead-inverse">
                           <tr>
                              <th>ID</th>
                              <th>Order Id</th>
                              <th>Products </th>
                              <th>Sub-Products </th>
                              <th>Weight</th>
                              <th>Units</th>
                              <th>Start Date </th>
                              <th>End Date</th>
<!--                              <th>Email</th>-->
                              <th colspan="6">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($all as $key => $value) {
                                        $i=0;
                           $discovery=explode(",",$value->status);
                           //echo "<pre>";print_r($all);  
                           ?>
                        <?php if(in_array('2',$discovery))
                              $i=0;
                           else if(in_array('1',$discovery))
                              $i=1;
                            else
                              $i=2;
                              ?>
                           <tr>
                              <td><?php echo $value->id;?></td>
                              <td><?php echo $value->orders_id;?></td>
                              <td><?php echo $value->pname;?></td>
                              <td><?php echo $value->name;?></td>
                              <td><?php echo $value->weight;?></td>
                              <td><?php echo $value->units;?></td>
                              <td><?php echo $value->start_date;?></td>
                              <td><?php echo $value->end_date;?></td>
<!--                              <td><?php echo $value->email_id;?></td>-->
                               <?php
                            $i = 0;
                            if (isset($value->statusdata)) {
                                        if (isset($value->statusdata["R"]) and $value->statusdata["R"] > 0) {
                                            $i = 0;
                                        } else if ($value->statusdata["R"] == 0 and $value->statusdata["N"] == 0 and $value->statusdata["A"] > 0) {
                                            $i = 1;
                                        } else {
                                            $i = 2;
                                        }
                                    } else {
                                        $i = 2;
                                    }
                                 //$i=1;   //normal -2 1 acce 0 reject
                                      //echo "<pre>".$i;print_r($value->statusdata);
                            //echo "<hr>";
                            ?>
                              <td class="colors<?php echo $i; ?>"> <a type="button" value="view_details" title="Edit" href="<?php echo site_url('admin/discovery/form/'.$value->order_id.'/'.$value->id);?>">
                              <i class="fa fa-pencil-square-o"></i>
                              </a></td>
                              <td class="colors<?php echo $i; ?>"><a type="button" value="view_details" title="Assing Resource" class="travel-pop" href="<?php echo site_url('admin/discovery/assingresource/'.$value->order_id.'/'.$value->id);?>">
                               <i class="fa fa-user"></i></a></td>
                              
                              <td class="colors<?php echo $i; ?>"> <a type="button"  value="view_details" title="Assign Time" href="<?php echo site_url('admin/discovery/calender/'.$value->order_id."/".$value->id);?>">
                              <i class="fa fa-clock-o" id="clock" aria-hidden="true"></i>
                                  </a></td>
                              <td class="colors<?php echo $i; ?>"> <a type="button"  value="view_details" title="TRF Form" href="<?php echo site_url('admin/discovery/trf/'.$value->order_id."/".$value->id);?>">
                              <i class="fa fa-suitcase" id="travel" aria-hidden="true"></i>
                                  </a></td>  
                                  <td class="colors<?php echo $i; ?>"> <a type="button" value="view_details" title="Delete" href="<?php echo site_url('admin/discovery/delete/'.$value->order_id.'/'.$value->id);?>" onclick="return confirm('Are you sure?')">
                              <i class="fa fa-trash-o"></i></a></td>
                              <td class="colors<?php echo $i; ?>"> 
                              <a type="button" class="travel-pop" value="view_details" title="Close Order" href="<?php echo site_url('admin/delivery/archievePopUp/'.$value->order_id.'/'.$value->id."/4");?>">
                             <i class="fa fa-archive"></i></a></td>
                           </tr>
                           <?php  }//die;?>
                        </tbody>
                     </table>
                  </div>
                   <?php }else{?>
                  <div class="page-head-line"></div>
                  <div class="notfound_text">Sorry!</div>
                  <div class="norecordfound">No Record Available</div>
                     <?php } ?>
                  <?php echo $link ; ?>
              
<script type="text/javascript">
             $(document).ready(function(){

            $('#clock').on('click', function() {
              //alert('hello');
            $('#modal').show('1000');
            //$('#modal').css('z-index', '1500');
            });
           
        });
      </script>