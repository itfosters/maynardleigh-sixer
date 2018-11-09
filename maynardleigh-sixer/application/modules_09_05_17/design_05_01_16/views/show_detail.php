<?php //echo "<pre>";print_r($delview);die;?>
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
  
  
   
</div>
</div>
<div class="clearfix"></div>
<!-- Trigger the modal with a button -->

                  <div class="table-responsive">
                     <table class="table table-striped table-bordered table-hover" summary="">
                        <thead >
                           <tr>
                              <th>ID</th>
                              <th>Order Id</th>
                              <th>Product </th>
                              <th>Details </th>
                              <th>Weight</th>
                              <th>Units</th>
                              <th>Cunsultant</th>
                              <th>Pax</th>
                              <th>No. Of Casting</th>
                              <th>No. Of Days</th>
                              <th>Cunsultant Day </th>
                              <th>Start Date </th>
                              <th>End Date</th>
                              <th>Location</th>
                              <th>Price And Units</th>
                              <th>Co-Ordinator</th>
                              <th>Email</th>
                              <th>Contact</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($delview as $key => $value) {
                              ?>
                           <tr>
                              <td><?php echo $value->id;?></td>
                              <td><?php echo $value->order_id;?></td>
                              <td><?php echo $value->products;?></td>
                              <td><?php echo $value->details;?></td>
                              <td><?php echo $value->weight;?></td>
                              <td><?php echo $value->units;?></td>
                              <td><?php echo $value->cunsultant;?></td>
                               <td><?php echo $value->pax;?></td>
                              <td><?php echo $value->no_ofcasting;?></td>
                              <td><?php echo $value->no_ofdays;?></td>
                              <td><?php echo $value->cunsulting_days;?></td>
                              <td><?php echo $value->start_date;?></td>
                              <td><?php echo $value->end_date;?></td>
                              <td><?php echo $value->location;?></td>
                              <td><?php echo $value->price_unit;?></td>
                              <td><?php echo $value->coordinator;?></td> 
                              <td><?php echo $value->email_id;?></td>
                              <td><?php echo $value->contact;?></td>
                              
                           </tr>
                           <?php  }?>
                        </tbody>
                     </table>
                  </div>
                  <?php //echo $links ; ?>


