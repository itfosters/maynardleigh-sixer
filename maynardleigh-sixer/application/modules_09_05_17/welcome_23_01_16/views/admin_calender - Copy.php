<?php //echo "<pre>";print_r($view);die;
$status = array(0=>'Awaiting..',1=>'Accepted',2=>'Rejected');
?>
<?php
   echo form_dropdown('user_date', $property,isset($frmdata['view']->parentid)?$frmdata['view']->parentid:"",  'class="required form-control user_date"');
?>
<div class="abcde" id="hints">No record found. Please Select other Resource</div>
<div class="hidden1 mt20" id="resourceused">
<table class="table able-striped table-bordered">
<thead  class=" table-inverse">
<tr><th>Name</th><th>Job</th><th>Subproducts</th><th>Location</th><th>Start Date</th><th>Start time</th><th>End Date</th><th>End time</th><th>Status</th></tr>
</thead>
<tbody id="rexourdedt">
</tbody>
</table>
</div>
<script type="text/javascript">
    
$(document).ready(function(){
    
    $('.user_date').change(function(){
     var user=$('.user_date').val();
   
       $.ajax({
                url: "<?php echo site_url("welcome/admin/showAllDates");?>",
                type: "POST",
                data:{"id":user},
                success: function (emp_list) {
                    //console.log(emp_list);
					$("#hints").hide();
					$("#resourceused").show();
					$("#rexourdedt").empty();
                   
                    var txt = "";
					 //var prop = emp_list;
				   
					 //console.log(prop);
					   $.each(emp_list, function(index, item) {
						item.clientname=(item.clientname==null)?'':item.clientname;
						item.moreinfo.name=(item.moreinfo.name==null)?'':item.moreinfo.name;
						item.moreinfo.subname=(item.moreinfo.subname==null)?'':item.moreinfo.subname;
						item.moreinfo.location=(item.moreinfo.location==null)?'':item.moreinfo.location;
					   

					 	var status = 'Awaiting';
						if (item.status=='1')
							status ="Approved";
						else if (item.status=='2')
							status='Rejected';
						
						
						txt = "<tr class='sts"+item.status+"rw'><td>"+item.clientname+"</td><td>"+item.moreinfo.name+"</td>"+
						 "<td>"+item.moreinfo.subname+"</td><td>"+item.moreinfo.location+"</td>"+
						 "<td>"+item.start_date+"</td><td>"+item.start_time+"</td>"+
						 "<td>"+item.end_date+"</td><td>"+item.end_time+"</td>"+
						 "<td class='status'>"+status+"</td></tr>";
						//alert(txt);
						//console.log("Prem ji chill"+item.moreinfo)
						$("#rexourdedt").append(txt)
						 
					   
					 });


				}
                    
       });
    })
})

</script>
