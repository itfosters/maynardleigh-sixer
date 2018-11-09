<?php
//echo "<pre>"; print_r($frmdata);die;
 ?>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label></label>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="add-pluse">
          
        </div>
        <div class="col-md-12 form-group" style="" id="test">
            <h1 class="page-head-line"> My Call List: (<?php echo date('jS F, Y',$frmdata[0]->timestampstart);?>) </h1>
          <div class="trf-droup" >
        <table class="table">
          <thead>
          <tr>      
            <th scope="col">Sl. No.</th>
            <th scope="col">Start Time</th>
            <th scope="col">End Time</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th> 
            
          </tr>
      </thead>
      <tbody id="resourcedetails">
          <?php 
          $slno=1;
          foreach ($frmdata as $frmkey => $value) {
              if(!isset($value->timestampstart))
                  continue;
              ?>
            <tr>
                <td><?php echo $slno;?></td>
                <td><?php echo isset($value->timestampstart)?date('h:i A',$value->timestampstart):'';?></td>
                <td><?php echo isset($value->timestampend) ? date('h:i A',$value->timestampend):""; ?><?php echo (isset($value->lunchflage) && $value->lunchflage==1) ?' <b>(Lunch Time)</b>':'';?></td>
                <td><?php echo isset($value->name)?$value->name:'';?></td>
                <td><?php echo  isset($value->email)?$value->email:'';?></td>
                <td>
                    <?php if(!empty($value->email)){ ?>
                    <a href="<?php echo site_url('delivery/userCallNow/' . $value->id. "/" . $frmdata['order_id'] . "/" . $frmdata['delivery_id']."/".$value->user_id); ?>" title="Call Now"><i class="fa fa-phone" aria-hidden="true"></i></a>
                    <?php } ?>
                </td>
                <tr/>
              <?php
              $slno++;
           } ?>
      </tbody>
      </table>
     </div>
    </div>
</div>
</div>
