<?php //echo "<pre>@@@@@@@@";print_r($record);die; ?>

<div class="row">
   <div class="col-md-12">
     <table class="table table-bordered table-hover  table-inverse">
    <thead class="thead-inverse">
     <th>ID</th>
     <TH>CHECKIN DATE</TH><TH>CHECK OUT DATE</TH><TH>CITY</TH><TH>PREFERRED HOTEL</TH><TH>ROOM REFERENCE</TH><TH>DIET REMARK</TH><TH>STAR CATEGORY</TH><TH>DESCRIPTIONS</TH>
       </thead>
        <tbody>
          <tr>
          <td><?php echo $record['id']; ?></td>
      
          <td><?php echo $record['checkin_date']; ?></td>
          <td><?php echo $record['checkout_date']; ?></td>
          <td><?php echo $record['city']; ?></td>
       
          <td><?php echo $record['preferred_hotel']; ?></td>
          <td><?php echo $record['room_preference']; ?></td>
          <td><?php echo $record['diet_remark']; ?></td>
          <td><?php echo $record['star_category']; ?></td>
      
        
          <td><?php echo $record['description']; ?></td>
       
          </tr>
          </tbody>
     </table>
              
</div>
</div>
