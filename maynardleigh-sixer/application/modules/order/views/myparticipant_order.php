<?php //echo "!!!!!!!!!!!!<pre>";print_r($alldata);die;?>
<div class="row">
    <div class="col-md-6">

<?php echo form_open("welcome/index", array("id" => "search")); ?> 
        <div class="input-group form-group" style="margin-left: 3px;">
            <input type="text" name="q" placeholder="Search" class="form-control" value="<?php echo isset($frm_data['q'])?$frm_data['q']:''; ?>">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
    <?php form_close();?>
    </div> 
</div>
<div class="row">

<!-- <div class="clearfix"></div> -->
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
                <th>Order Dates</th>
                <th colspan="7">Action</th>
                 
            </tr>  
          
          </thead>
          <tbody>
            <?php
             foreach ($alldata as $key => $value) {?>
              <tr>
              <td ><?php echo $key+1;?></td>
              <td ><?php echo $value->order_Id;?></td>
                        
              <td>
                                            <?php
                                            //echo $value->email_Id;
                                            foreach ($value->alldates as $singleDate) {
                                                if(empty($singleDate['dstartdate']))
                                                    continue;
                                                if ($singleDate['dstartdate'] == $singleDate['denddate']) {
                                                    echo date('jS F ', strtotime($singleDate['dstartdate']));
                                                } else {
                                                    echo date('jS F ', strtotime($singleDate['dstartdate'])) . ' - ' . date('jS F ', strtotime($singleDate['denddate']));
                                                }
                                                echo "<br>";
                                            }
                                            ?>
                                        </td>
              
              <td> 
              <a type="button" class="" value="view_details"  title="View Details" href="<?php echo site_url('order/details/'.$value->id);?>">
              <i class="fa fa-eye"></i></a>
              
<!--              <a type="button" class="" value="view_details"  title="My Call" 
               href="<?php echo site_url('order/resouces_form/'.$value->id);?>">
              <i class="fa fa-phone-square"></i></a>-->


              </td>
              <td>
              <a type="button" class="" value="view_details"  title="Goal" href="<?php echo site_url('order/goal');?>">
              <i class="fa fa-line-chart" aria-hidden="true"></i></a>
                

              </td>
<!--              <td>
                <a type="button" class="" value="view_details"  title="Reject" href="<?php //echo site_url('order/reject/'.$value->id);?>">
              <i class="fa fa-minus-circle" aria-hidden="true"></i></a>


              </td>-->
          </tr>
           <?php  }?>
         </tbody>
       </table>
        <?php echo $links ; ?>
        <?php }else{?>
        
                  <div class="page-head-line"></div>
                  <div class="notfound_text">Sorry!</div>
                  <div class="norecordfound">No Order Available</div>
        <?php } ?>
        </div>
        
        
      </div>

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
  
  