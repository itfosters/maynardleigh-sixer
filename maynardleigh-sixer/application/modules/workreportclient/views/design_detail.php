                                  
 <?php //echo "###<pre>";print_r($view);
//echo "###<pre>";print_r($casting_id);die;?>
                                  <div class="poplight">
                               
                                  <div class="col-md-12 mt20">
                                <div>
                                  Order No&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $view['Order_No'];?>
                                </div>
                                <div>
                                  Client Name&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $view['ClientName'];?>
                                </div>
                                <div>
                                  Client Address&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $view['ClientAddress'];?>
                                </div>
                                <div>
                                  First Name&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $view['first_Name'];?>
                                </div>
                                <div>
                                Last Name&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $view['last_Name'];?>
                                </div>
                                <?php
                                if((isset($status)) && ($status==0)){
                                ?>
                                
        <?php echo form_open("welcome/acceptrequest/".$casting_id,array("id"=>"accept")); ?>
 
          <input type="submit" value="Accept" onclick='return confirm("Are you sure to confirm this date ?")' class="btn btn-success mt20" />
          <input type="hidden" id="currentDiagnoseid" class="form-control" name="diagnose_id" value="<?php echo $mainid;?>" /> 

        <?php echo form_close();?>
            <button class="btn btn-danger mt20" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
             Reject
            </button>
            <?php  }else{

              ?>
              <div class="status"><?php echo $status=="1"? "You have accepted this request.":"You have rejected this request."?></div>
              <?php
            } ?>
            
            <div class="collapse" id="collapseExample">
              <div class="well mt10">
                 <?php echo form_open("welcome/rejected"); ?>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Comment</label>
                        <textarea class="form-control" rows="3" name='comment'></textarea>
                        <input type="hidden" id="currentDiagnoseid" class="form-control" name="diagnose_id" value="<?php echo $mainid;?>" /> 
                      </div>
                      <input type="submit" value="Submit" onclick='return confirm("Are you sure to reject this date ?")' class="btn btn-success mt20" />
                      <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                  <?php echo form_close();?>
              </div>
            </div>
            
            </div> <div class="clearfix"></div></div>