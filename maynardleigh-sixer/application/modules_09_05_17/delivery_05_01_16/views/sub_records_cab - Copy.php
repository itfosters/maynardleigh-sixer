<?php //echo "<pre>@@@@@@@@";print_r($record);die; ?>

<div class="row">
   <div class="col-md-12">
     <table class="table table-bordered table-hover  table-inverse">
    <thead class="thead-inverse">
     <th>ID</th>
     <th>JOURNEY DATE</th><TH>RETURN DATE</TH><TH>CITY</TH><TH>PREFERRED CAB</TH><TH>JOURNEY FROM</TH><TH>JOURNEY DESTINATION</TH><TH>ClAUSE</TH><TH>DEPT TIME</TH><TH>DESCRIPTIONS</TH>
       </thead>
        <tbody>
          <tr>
          <td><?php echo $record['id']; ?></td>
          <td><?php echo $record['journey_date']; ?></td>
          <td><?php echo $record['return_date']; ?></td>
     
          <td><?php echo $record['city']; ?></td>
   
          <td><?php echo $record['preferred_cab']; ?></td>
       

          <td><?php echo $record['journey_from']; ?></td>
          <td><?php echo $record['journey_destination']; ?></td>
          <td><?php echo $record['clause']; ?></td>
          <td><?php echo $record['dept_time']; ?></td>
          <td><?php echo $record['description']; ?></td>
       
          </tr>
          </tbody>
     </table>
              
</div>
</div>
