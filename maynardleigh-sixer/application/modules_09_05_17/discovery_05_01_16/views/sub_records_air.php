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
          <th>JOURNEY DATE</th><td><?php echo $record['journey_date']; ?></td>
        </tr>
        <tr>
          <TH>RETURN DATE</TH><td><?php echo $record['return_date']; ?></td>
        </tr>
        
        <tr>
         <TH>PREFERRED AIRLINES</TH> <td><?php echo $record['preferred']; ?></td>
       </tr>
       <tr>
           <TH>JOURNEY FROM</TH><td><?php echo $record['journey_from']; ?></td>
        </tr>
        <tr>
          <TH>JOURNEY DESTINATION</TH><td><?php echo $record['journey_destination']; ?></td>
        </tr>
        <tr>
          <TH>CLAUSE</TH><td><?php echo $record['clause']; ?></td>
        </tr>
        <tr>
          <TH>DEPT TIME</TH><td><?php echo $record['dept_time']; ?></td>
        </tr>
        <tr>
          <TH>DESCRIPTIONS</TH> <td><?php echo $record['description']; ?></td>
                   </tr>
          </tbody>
     </table>
              
</div>
</div>
