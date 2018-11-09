
                                              
 <?php //echo "###<pre>";print_r($view);
//echo "###<pre>";print_r($casting_id);die;?>
                                  <div class="poplight">
                               
                                  <div class="col-md-12 mt20">
                               <div>
                                  Leave Reason &nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $view['title'];?>
                                </div>
								<div>
                                  Leave Title &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $view['leave_title'];?>
                                </div>
                                <div>
                                 Leave Timing &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $view['time_duration'];?>
                                </div>
                                <a href="deleteRequest/<?php echo $view['id']; ?>.html" class="btn btn-danger mt20" type="button" onclick="return confirm('Are You sure. You want to delete this record')">
								 Delete
								</a>
            
            
            
            </div> <div class="clearfix"></div></div>