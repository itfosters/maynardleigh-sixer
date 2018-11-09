

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
    <a type="button" class="btn btn-primary" value="view_details" href="<?php echo site_url('admin/diagnose/form/'.$ids)?>">Add Diagnose</a>
</div>
</div>
<div class="clearfix"></div>
<!-- Trigger the modal with a button -->
   <?php if (count($all)>0) { 
                  //$count=count($all->order_id);
                  //print_r($count);die;?>
                  <div class="table-responsive">
                   
                     <table class="table table-bordered table-hover  table-inverse" summary="">
                        <thead class="thead-inverse">
                           <tr>
                              <th>ID</th>
                              <th>Order Id</th>
                              <th>Details </th>
                              <th>Weight</th>
                              <th>Units</th>
                              
                             <!-- <th>No. Of Casting</th>-->
                              <th>Start Date </th>
                              <th>End Date</th>
                              <th>Email</th>
                              <th colspan="6">Action</th>
                           </tr> 

                        </thead>
                        <tbody>
                        	<?php 
                                ?>
                           <?php foreach ($all as $key => $value) {
							               $i=0;
							             $diagnose=explode(",",$value->status);
                           //echo "<pre>";print_r($all);die;
							             ?>
                        <?php if(in_array('2',$diagnose))
                              $i=0;
                           else if(in_array('1',$diagnose))
                              $i=1;
                            else
                              $i=2;
                              ?>
                           <tr>
                           

                              <td><?php echo $value->id;?></td>
                              <td><?php echo $value->order_id;?></td>
                              <td><?php echo $value->details;?></td>
                              <td><?php echo $value->weight;?></td>
                              <td><?php echo $value->units;?></td>
                              
                             <!-- <td><?php //echo $value->no_ofcasting;?></td>-->
                              <td><?php echo $value->start_date;?></td>
                              <td><?php echo $value->end_date;?></td>
                              <td><?php echo $value->email_id;?></td>
                             <!-- <td> <a type="button" value="view_details" title="View Details" href="<?php //echo site_url('diagnose/details/'.$value->order_id);?>">
                              <i class="fa fa-eye"></i></a></td>-->
                              <td class="colors<?php echo $i; ?>"><a type="button" value="view_details" title="Edit" href="<?php echo site_url('admin/diagnose/form/'.$value->order_id.'/'.$value->id);?>">
                               <i class="fa fa-pencil-square-o"></i></a></td>
                              <td class="colors<?php echo $i; ?>"> <a type="button"  value="view_details" title="Delete" href="<?php echo site_url('admin/diagnose/delete/'.$value->order_id.'/'.$value->id);?>" onclick="return confirm('Are you sure?')">
                              <i class="fa fa-trash-o"></i></a></td>
                              <td class="colors<?php echo $i; ?>"> <a type="button"  value="view_details" title="Assign Time" href="<?php echo site_url('admin/diagnose/calender/'.$value->order_id."/".$value->id);?>">
                              <i class="fa fa-clock-o" id="clock" aria-hidden="true"></i>
                                  </a></td>
                              
                           </tr>
                           <?php  }?>
                        </tbody>
                     </table>
                  </div><?php }else{?>
                  <div class="page-head-line"></div>
                  <div class="notfound_text">Sorry!</div>
                  <div class="norecordfound">Record Not found</div>
                     <?php } ?>
                    <div id="modal" style="border:1px;height:200px;width:400px">  
                    </div>
                  <?php //echo $links ; ?>
            <script type="text/javascript">
             $(document).ready(function(){

            $('#clock').on('click', function() {
              //alert('hello');
            $('#modal').show('1000');
            //$('#modal').css('z-index', '1500');
            });
           
        });
      </script> 