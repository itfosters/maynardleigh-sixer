<?php //echo "<pre>@@@@@@@@";print_r($record);die; ?>

<div class="row">
   <div class="col-md-12">
     <table class="table table-bordered table-hover  table-inverse">
    <thead class="thead-inverse">
     <th>ID</th>
     <th>JOURNEY DATE</th><TH>RETURN DATE</TH><TH>CHECKIN DATE</TH><TH>CHECK OUT DAET</TH><TH>CITY</TH><TH>PREFERRED TRAIN</TH><TH>PREFERRED CAB</TH><TH>PREFERRED HOTEL</TH><TH>ROOM REFERENCE</TH><TH>DIET REMARK</TH><TH>SATER CATEGORY</TH><TH>JOURNEY FROM</TH><TH>JOURNEY DESTINATION</TH><TH>DEPT TIME</TH><TH>DESCRIPTIONS</TH><TH>ENTRY DATE</TH>
       </thead>
        <tbody>
          <tr>
          <td><?php echo $record['id']; ?></td>
          <td><?php echo $record['journey_date']; ?></td>
          <td><?php echo $record['return_date']; ?></td>
          <td><?php echo $record['checkin_date']; ?></td>
          <td><?php echo $record['checkout_date']; ?></td>
          <td><?php echo $record['city']; ?></td>
          <td><?php echo $record['preferred_train']; ?></td>
          <td><?php echo $record['preferred_cab']; ?></td>
          <td><?php echo $record['preferred_hotel']; ?></td>
          <td><?php echo $record['room_preference']; ?></td>
          <td><?php echo $record['diet_remark']; ?></td>
          <td><?php echo $record['star_category']; ?></td>
          <td><?php echo $record['journey_from']; ?></td>
          <td><?php echo $record['journey_destination']; ?></td>
          <td><?php echo $record['dept_time']; ?></td>
          <td><?php echo $record['description']; ?></td>
          <td><?php echo $record['entry_date']; ?></td>
          </tr>
          </tbody>
     </table>
              
</div>
</div>
