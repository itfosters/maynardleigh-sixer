<?php // echo "<pre>";print_r($property);die;
$status = array(0=>'Awaiting..',1=>'Accepted',2=>'Rejected');
?>

<div class="row">
<div class="col-md-4">
<div class="form-group">
<label><h3></h3></label>
<?php
echo form_open('admin/workreport/downloadExcel');
   echo form_dropdown('user_date', $property,isset($frmdata['view']->parentid)?$frmdata['view']->parentid:"",  'class="required form-control user_date"');echo form_error('user_date');
?>
<span class="udate" style="color:red"></span>
                <table border='1px' style="width:100%">

                
              

<script type="text/javascript">
    
$(document).ready(function(){
   // $('.excel').hide();
    $('.detail').click(function(){
     var user=$('.user_date').val();
     var cal1=$('.cal1').val();
     var cal2=$('.cal2').val();
        /*if(user=='')
        {
            $('.udate').text("Please Select Resource");
        }else */
        if(cal1=='')
        {
     $('.sdate').text("Please Select Start Date");
        }else if(cal2=='')
        {
         $('.edate').text("Please Select End Date");
        }else {
                $('.edate').text("");
                $('.sdate').text("");
                $('.udate').text("");
       $.ajax({
                url: "<?=site_url()?>workreport/admin/showAllDates",
                type: "POST",
                
                //url: baseurl + 'sms/get_dept_employee',
                data:{"id":user,"cal1":cal1,"cal2":cal2},
               
              
                success: function (emp_list) {
                    //console.log(emp_list);
                    $(".table").empty();
                    //var headertext = "<tr><th>Name</th><th>Job</th><th>Weightage</th><th>Subproducts</th><th>Client</th><th>Location</th><th>Start Date</th><th>Start time</th><th>End Date</th><th>End time</th><th>Status</th></tr>";
                    var headertext = "<tr><th>Start Date</th><th>End Date</th><th>Client</th><th>Product</th><th>Subproduct</th><th>Resource</th><th>Location</th><th>Weightage</th><th>Status</th></tr>";
                    $(".table").append(headertext);
                    var txt = "";
                                                 //var prop = emp_list;
                   
                     //console.log(prop);
                     var resourse;
                       $.each(emp_list, function(index, item) {
                        //alert(item.order_id);
                       // console.log(item.moreinfo.weight);
                        var clientname='';
                        if(item.clientname==null)
                        {
                            clientname='';

                        }
                        else
                        {
                         clientname = item.clientname; 
                        }
                         var pname='';
                        if(item.moreinfo.name==null)
                        {
                            pname='';
                        }
                        else
                        {
                         pname = item.moreinfo.name;   
                        }
                    var spname='';
                        if(item.moreinfo.subname==null)
                        {
                            spname='';
                        }
                        else
                        {
                         spname = item.moreinfo.subname;   
                        }
                        var location='';
                        if(item.moreinfo.location==null)
                        {
                            location='';
                        }
                        else
                        {
                         location = item.moreinfo.location;   
                        }
                          var weight='';
                        if(item.moreinfo.weight==null)
                        {
                            weight='';
                        }
                        else
                        {
                         weight = ((item.moreinfo.weight*item.moreinfo.units)/item.moreinfo.cunsulting_days).toFixed(2);   
                        }

                     var status = 'Awaiting';
                     if(item.status=='0')
                        {
                        status = 'Awaiting';
                         if(item.status=='0'){
                        $('.excel').show();
                        }else{
                             $('.excel').hide();
                        }
                        }
                    else if (item.status=='1')
                    {
                        status="Approved";
                        //$("td").addClass('colors1'),
                        if(item.status='1'){
                        $('.excel').show();
                        }else{
                             $('.excel').hide();
                        }
                   
                    }
                    else{
                 	 if(item.status='2'){
                        $('.excel').show();
                        }else{
                             $('.excel').hide();
                        }
                        status='Rejected';
                    }
                    clientsname=''
                    if(item.clientsname==null)
                        {
                            clientsname='';
                        }
                        else
                        {
                         clientsname = item.clientsname;   
                        }
                        txt = "<tr><td>"+item.start_date+"</td><td>"+item.end_date+"</td><td>"+clientsname+"</td><td>"+pname+"</td><td>"+spname+"</td><td>"+clientname+"</td>"+
                         "<td>"+location+"</td>"+
                         "<td>"+weight+"</td>"+
                         "<td class='status'>"+status+"</td></tr>";
                        //alert(txt);
                        //console.log("Prem ji chill"+item.moreinfo)
                        $(".table").append(txt)
                         
                       
                     });


                }
                    
       });
   }
    })
})

</script>
</table>
</div></div>
<div class="col-md-3">
<div class="form-group">
<label>Start Date</label>
<?php 
$data=array('name'=>'calender1','class'=>'form-control cal1');
echo form_input($data);

echo form_error('calender1');
?>
<span class="sdate" style="color:red"></span>
</div>
</div>
<div class="col-md-3">
<label>End Date</label>
<div class="form-group">
<?php 
$data=array('name'=>'calender2','class'=>'form-control cal2');
echo form_input($data);

echo form_error('calender2');
?>
<span class="edate" style="color:red"></span>
</div>

</div>
<div class="col-md-2">
<div class="form-group">
<label><h1>&nbsp</h1></label>
<input type="button" id="download" class="btn btn-primary detail" value="View Report">
</div>
</div>
 </div>
 <div class="row">
<div class="col-md-12">
<table class="table"></table>
</div>
</div>
 <div class="row">
<div class="col-md-10">

</div>
<div class="col-md-2">
<?php 
echo form_submit('exceldownload','Download Excel','style="display:none"class="btn btn-success excel"');
?>

</div>
</div>
<?php echo form_close();?>
 <script type="text/javascript">
     $(function(){

            $('.cal1').datepicker({
                   format: 'yyyy-mm-dd',
                   
            });
            $('.cal2').datepicker({
                 format: 'yyyy-mm-dd',
                    
            });
           
           
     })

 </script>
 