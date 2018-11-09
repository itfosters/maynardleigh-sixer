<?php //echo "<pre>@@@@@@@@";print_r($record);die; ?>

<div class="row">
   <div class="col-md-12">
     <table class="table table-bordered table-hover  table-inverse">
    <thead class="thead-inverse">
     
    
       </thead>
        <tbody>
          <tr>
          <th>ID</th><td><?php echo $record['id']; ?></td>
         </tr>
          <tr>
           <TH>CHECKIN DATE</TH><td><?php echo $record['checkin_date']; ?></td>
          </tr>
          <tr>
          <TH>CHECK OUT DATE</TH><td><?php echo $record['checkout_date']; ?></td>
          </tr>
          <tr>
         <TH>CITY</TH><td><?php echo $record['city']; ?></td>
          </tr>
          <tr>
          <TH>PREFERRED HOTEL</TH><td><?php echo $record['preferred_hotel']; ?></td>
          </tr>
          <tr>
          <TH>ROOM REFERENCE</TH><td><?php echo $record['room_preference']; ?></td>
          </tr>
          <tr>
          <TH>DIET REMARK</TH><td><?php echo $record['diet_remark']; ?></td>
         </tr>
          <tr>
          <TH>STAR CATEGORY</TH><td><?php echo $record['star_category']; ?></td>
          </tr>
          <tr>
          <TH>DESCRIPTIONS</TH><td><?php echo $record['description']; ?></td>
       
          </tr>
          </tbody>
     </table>
              
</div>
</div>
