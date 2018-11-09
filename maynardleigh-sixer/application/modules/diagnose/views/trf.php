<?php
//echo "<pre>"; print_r($frmdata);die;
 ?>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Resources</label>
                <div class="clearfix"></div>
                <?php echo form_dropdown('manager', $frmdata['allmanager'],'','onchange="selectresource(this.value)" class="selectpicker form-control" id="manager"');?>       
            </div>
        </div>
        <div class="add-pluse">
          <h3> <a id="popup" class="travel-pop" href=""><i class="fa fa-plus" aria-hidden="true"></i></a> </h3>
        </div>
        <div class="col-md-12 form-group" style="" id="test">
            <h1 class="page-head-line"> TRAVEL DETAILS: </h1>
          <div class="trf-droup" >
        <table class="table">
          <thead>
          <tr>      
            <th scope="col">Mode</th>
            <th scope="col">Journey / Check-in Date</th>
            <th scope="col">Return / Check-out Date</th>
            <th scope="col">Description</th>
            <th scope="col" colspan="2">
            
            <a id="clientmails" class='travel-pop' title='Send To Client' href='<?php echo site_url('admin/diagnose/mailTravelRequestFormNewClient/'.$frmdata['odered_id'].'/'.$frmdata['diagnose_id']); ?>'><i class='fa fa-envelope btn '></i></a>
<!--                <a target="_blank" id="vendermails" title="Send To Resource" href="<?php echo site_url('admin/diagnose/mailVenderRequestForm/'.$frmdata['odered_id'].'/'.$frmdata['diagnose_id']); ?>"><i class="fa fa-envelope-o btn"></i></a> -->
                <a id="vendermailspreview" title="Send To Resource" href="<?php echo site_url('admin/diagnose/newvendermailslinkspreview/'.$frmdata['odered_id'].'/'.$frmdata['diagnose_id']); ?>"><i class="fa fa-envelope-o btn"></i></a>
            </th> 
            
            
             
          </tr>
      </thead>
      <tbody id="resourcedetails">
      </tbody>
      </table>
     </div>
    </div>
</div>

<script type="text/javascript">
     //var resource_details_temp = "<tr><td>${mode}</td><td>${journey_date}</td><td>${return_date}</td><td>${description}</td><td><a class='fa fa-trash resource_act' href='#itf' rel='${id}'></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class='fa fa-pencil-square-o travel-pop btnwd' href='<?php echo site_url('admin/diagnose/trfPopUp/${order_id}/${diagnose_id}/${user_id}/${id}'); ?>' class='travel-pop'></a>&nbsp;{{if mode!='Venue'}}&nbsp;&nbsp<a class='fa fa-eye btnwd' href='<?php echo site_url('admin/diagnose/trfAllDetails/${order_id}/${diagnose_id}/${user_id}/${id}'); ?>' class='travel-pop'></a>&nbsp;&nbsp;{{/if}}<a  class='travel-pop' title='Send To Travel Agent' href='<?php echo site_url('admin/diagnose/mailTravelRequestFormNew/'.$frmdata['odered_id'].'/'.$frmdata['diagnose_id'].'/${user_id}'.'/${id}'); ?>'><i class='fa fa-envelope btn '></i></a></td></tr>";
     var resource_details_temp = "<tr> <td>${mode}</td><td>${journey_date}</td><td>${return_date}</td><td>${description}</td><td colspan='2' width='15%'> <a class='fa fa-trash resource_act' href='#itf' rel='${id}'></a>&nbsp;&nbsp;&nbsp;&nbsp; <a class='fa fa-pencil-square-o travel-pop btnwd' href='<?php echo site_url('admin/diagnose/trfPopUp/${order_id}/${diagnose_id}/${user_id}/${id}'); ?>' class='travel-pop'></a>&nbsp;{{if mode!='Venue'}}&nbsp;&nbsp <a class='fa fa-eye btnwd' href='<?php echo site_url('admin/diagnose/trfAllDetails/${order_id}/${diagnose_id}/${user_id}/${id}'); ?>' class='travel-pop'></a>&nbsp;&nbsp;{{/if}}{{if emailflag==1}}<a class='travel-pop' title='Send To Travel Agent' href='<?php echo site_url('admin/diagnose/mailTravelRequestFormNew/' . $frmdata['odered_id'] . '/' . $frmdata['diagnose_id'] . '/${user_id}' . '/${id}'); ?>'><i class='fa fa-envelope btn '></i> </a>{{/if}}</td></tr>";
     function selectresource(selectevalue){
      //alert("Hello");
       $('.add-pluse').show();
    var ids=selectevalue;  
    //alert(ids);
   
    var alinks="<?php echo $frmdata['odered_id'].'/'.$frmdata['diagnose_id']; ?>";
    var newalinks=ADMINURL+'diagnose/trfPopUp/'+alinks+'/'+ids;
    $('#popup').attr("href", newalinks); 
   var newmailslinks=ADMINURL+'diagnose/mailTravelRequestForm/'+alinks+'/'+ids;
    $('#clientmails').attr("href", newmailslinks);
    var newPrintslinks=ADMINURL+'diagnose/downloadTRForm/'+alinks+'/'+ids;
    $('#downloads').attr("href", newPrintslinks);
    var newvendermailslinks=ADMINURL+'diagnose/mailVenderRequestForm/'+alinks+'/'+ids;
    $('#vendermails').attr("href", newvendermailslinks);
    
    var newvendermailslinkspreview=ADMINURL+'diagnose/mailVenderRequestFormPreview/'+alinks+'/'+ids;
    $('#vendermailspreview').attr("href", newvendermailslinkspreview);
    
    var newvendermailslinksclient=ADMINURL+'diagnose/mailTravelRequestFormNewClient/'+alinks+'/'+ids;
    $('#clientmails').attr("href", newvendermailslinksclient);
    
    getResourceDetails("<?php echo $frmdata['odered_id']; ?>","<?php echo $frmdata['diagnose_id']; ?>",ids); 
     
    }

  $(document).ready(function (){
     $('#manager').val('<?php echo $frmdata['user_id']; ?>').trigger('change');
   //   $('.add-pluse').show();
    $.template("resourcesTemplates", resource_details_temp );
   
   // $('.selectpicker').on('change', function(){
 
  });

      function getResourceDetails(odered_id,diagnose_id,user_id){
             $.ajax({
                url:"<?php echo site_url('admin/diagnose/getResourceDetails'); ?>",
                data:{user_id:user_id,order_id:odered_id,diagnose_id:diagnose_id},
                method:"POST",
                sendBefore:function(){},
                success:function(res){
                        $("#resourcedetails").empty();
                        $.tmpl( "resourcesTemplates", res.results ).appendTo( "#resourcedetails" );

                        console.log(res.results);  
                }
            });
        }
      $(document).on("click",".resource_act",function(){ 
      if(confirm("Do you want to Delete?")){
        var id=$(this).attr("rel");
        $.ajax({
          url:"<?php echo site_url('admin/diagnose/deleteResources'); ?>",
          data:{id:id},
          method:"POST",
          success:function(res){
            if(res.results='true'){
          location.reload();
        }
          }
      })
      }
    });
</script>

</div>






