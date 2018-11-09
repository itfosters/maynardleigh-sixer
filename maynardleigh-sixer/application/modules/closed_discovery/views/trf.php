<?php
//echo "<pre>"; print_r($frmdata);die;
 ?>
<div class="col-md-12">
    <div class="row">
        
        <div class="col-md-12">
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
            <th scope="col">Journy Date</th>
        
            <th scope="col">Description</th>
            <th scope="col">Action</th> 
            
            <th scope="col"><a id="vendermails" title="Send To Resource" href="<?php echo site_url('admin/design/mailVenderRequestForm/'.$frmdata['odered_id'].'/'.$frmdata['diagnose_id']); ?>"><i class="fa fa-envelope-o btn"></i></a></th>
           
            <th scope="col"><a download ="" id="downloads" target="_blank"  title="Print File" href="<?php echo site_url('admin/design/downloadTRForm/'.$frmdata['odered_id'].'/'.$frmdata['diagnose_id']); ?>"><i class="fa fa-print btn"></i></a></th> 
          </tr>
      </thead>
      <tbody id="resourcedetails">
      </tbody>
      </table>
     </div>
    </div>
</div>

<script type="text/javascript">
     var resource_details_temp = "<tr><td>${mode}</td><td>${journey_date}</td><td>${description}</td><td><a class='fa fa-trash resource_act' href='#itf' rel='${id}'></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class='fa fa-pencil-square-o travel-pop btnwd' href='<?php echo site_url('admin/discovery/trfPopUp/${order_id}/${diagnose_id}/${user_id}/${id}'); ?>' class='travel-pop'></a>&nbsp;&nbsp;&nbsp<a class='fa fa-eye btnwd' href='<?php echo site_url('admin/discovery/trfAllDetails/${order_id}/${diagnose_id}/${user_id}/${id}'); ?>' class='travel-pop'></a>&nbsp;&nbsp;<a  class='travel-pop' title='Send To Travel Agent' href='<?php echo site_url('admin/discovery/mailTravelRequestFormNew/'.$frmdata['odered_id'].'/'.$frmdata['diagnose_id'].'/${user_id}'.'/${id}'); ?>'><i class='fa fa-envelope btn '></i></a></td></tr>";
   
   
     function selectresource(selectevalue){
      //alert("Hello");
       $('.add-pluse').show();
    var ids=selectevalue;  
    //alert(ids);
   
    var alinks="<?php echo $frmdata['odered_id'].'/'.$frmdata['diagnose_id']; ?>";
    var newalinks=ADMINURL+'discovery/trfPopUp/'+alinks+'/'+ids;
    $('#popup').attr("href", newalinks); 
   var newmailslinks=ADMINURL+'discovery/mailTravelRequestForm/'+alinks+'/'+ids;
    $('#clientmails').attr("href", newmailslinks);
    var newPrintslinks=ADMINURL+'discovery/downloadTRForm/'+alinks+'/'+ids;
    $('#downloads').attr("href", newPrintslinks);
    var newvendermailslinks=ADMINURL+'discovery/mailVenderRequestForm/'+alinks+'/'+ids;
    $('#vendermails').attr("href", newvendermailslinks);
    getResourceDetails("<?php echo $frmdata['odered_id']; ?>","<?php echo $frmdata['diagnose_id']; ?>",ids); 
     
    }

  $(document).ready(function (){
     $('#manager').val('<?php echo $frmdata['user_id']; ?>').trigger('change');
   //   $('.add-pluse').show();
    $.template( "resourcesTemplates", resource_details_temp );
   
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send mail</h4>
        </div>
        <div class="modal-body">
        <div class="form-group">
          <label>Enter Mail Id</label>
          <input type="text" name="rmail" class="form-control">
        </div>
        <div class="form-group">
         <input type="submit" name="smail" value="Send" class="btn btn-primary">
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!--close Modal-->
</div>
