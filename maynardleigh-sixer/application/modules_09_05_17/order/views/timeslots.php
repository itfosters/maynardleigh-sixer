
<div class="row">

<!-- <div class="clearfix"></div> -->
  <!-- Trigger the modal with a button -->
<div class="table-responsive">
<div id="accordion" role="tablist" aria-multiselectable="true">
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> </a>
         <div role="button"  class="thead-inverse deal">
          <?php // echo "<pre>";print_r($itf);die; ?>

          <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover" summary="">
        <thead class="thead-inverse">
            
            <tr>
                <!--<th><input type="checkbox" name="" id="selecctall" value="1" title="Select All"></th>-->
               
                <th>Time Slots </th>
               
                <th colspan="7">Action</th>
                 
            </tr>  
          
          </thead>
          <tbody>
            <?php
             foreach ($itf as $key => $value) {?>
              <tr>
              
           
              <td><?php echo $value->time_slot;?></td>
              <td><a>Booked</a></td>
             
          </tr>
           <?php  }?>

           
            
            
           
          </tbody>

          
        </table>
     
        </div>
        
        
      </div>

    </div>
  </div>
</div>

  
  