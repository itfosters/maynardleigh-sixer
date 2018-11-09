<page size="A4" id="content">
    <table style="background-color:#ffffff; margin:0 auto;" width="75%" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td style="padding:0px 0px 15px 20px;">
                    <table  border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td valign="bottom" align="left">
                                    <a target="#" title="Maynardleigh Online">
                                        <img style="margin-bottom: 40px; height: 160px;" src="http://sixer.maynardleighonline.in/assests/img/default.png" />
                                    </a>

                                </td>
                                <td align="center" >
                                    
                                </td>

                                <td width = '20%' align="right" valign="bottom"  >


                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    
                                    
                                    
                                    
                                    <?php 
$attributes = array('id' => 'myform');
//echo form_open('email/send', $attributes);
echo form_open('',$attributes);
echo form_hidden('diagnose_id', isset($frmdata['diagnose_id'])?$frmdata['diagnose_id']:"");
echo form_hidden('assign_date_id', isset($frmdata['assign_date_id'])?$frmdata['assign_date_id']:"");
echo form_hidden('order_type', isset($frmdata['order_type'])?$frmdata['order_type']:"");
echo form_hidden('resource_name', isset($frmdata['moreinfo']->resourcename)?$frmdata['moreinfo']->resourcename:"");
echo form_hidden('clientname', isset($frmdata['moreinfo']->clientname )?$frmdata['moreinfo']->clientname:"");
echo form_hidden('name', isset($frmdata['moreinfo']->name )?$frmdata['moreinfo']->name:"");
?>
<div class="row">
   <div class="col-md-12">
       <div class="col-md-3">
         <div class="form-group">
            <label for="program_name">Product: 
            <b><?php echo (isset($frmdata['moreinfo']->proname))?$frmdata['moreinfo']->proname:""?></b></label>
            <?php echo form_hidden('program_name', (isset($frmdata['moreinfo']->proname))?$frmdata['moreinfo']->proname:"");?>
            <?php //echo form_error('program_name');?>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="programdate">Program Date: 
            <b>
                <?php 
                
                $start = date('d-m-Y', strtotime($frmdata['moreinfo']->start_date));
                $end = date('d-m-Y', strtotime($frmdata['moreinfo']->end_date));
                if ($start == $end) 
                    echo date('jS F, Y', strtotime($start));
                else
                    echo date('jS F, Y', strtotime($start)) . ' - ' . date('jS F, Y', strtotime($end));
                
                
               // echo (isset($frmdata['moreinfo']->start_date)&&($frmdata['moreinfo']->end_date))?$frmdata['moreinfo']->start_date.' '.'&'.' '.$frmdata['moreinfo']->end_date:""?></b></label>
            <?php echo form_hidden('programdate', (isset($frmdata['moreinfo']->start_date)&&($frmdata['moreinfo']->end_date))?$frmdata['moreinfo']->start_date.' '.'&'.' '.$frmdata['moreinfo']->end_date:"");?>
            <?php echo form_error('programdate');?>
         </div>
      </div>
      <div class="clearfix"></div>

      
      <div class="col-md-3">
         <div class="form-group">
            <label><b>Feedback for this session:</b></label>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <?php $data=array(
               'name'=>'why_were_we_there',
               'class'=>'form-control', 'placeholder'=>'Type Here...',
                'value' =>((isset($frmdata['formdata']['why_were_we_there'])) && (!empty($frmdata['formdata']['why_were_we_there']))) ? $frmdata['formdata']['why_were_we_there']:""
                 );
              echo form_textarea($data); 
              ?>
         </div>
      </div>
   </div>
</div>
<?php //if(!(isset($frmdata['formdata']['any_future_business_development_opportunities']) && (!empty($frmdata['formdata']['any_future_business_development_opportunities'])))){
        ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php //} ?>
<a class="btn btn-primary" href="<?php site_url('welcome/mydates') ?>">Cancel</a>
<?php form_close();?>
                                    
                                    
                                    
                                    
                                    
                                    
                                    

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
 



  
</page>

 <script src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay_progress.min.js"></script>
<style>
    @media print {
        body, #print_for_pdf{
            margin: 0px auto;
            width: 1400px;
            height: auto;
            font-size: 18px;

        }

        .hidden-print {
            display: none !important;
        }
    }
</style>





























<script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
CKEDITOR.plugins.addExternal( 'confighelper', 'https://martinezdelizarrondo.com/ckplugins/confighelper/' );
var config = { extraPlugins: 'confighelper', toolbar:'Basic'};
CKEDITOR.replace('why_were_we_there', config);
</script>

<!--<script src="<?php //echo ASSESTS_ULR."itfeditor/ckeditor.js"?>"></script>-->




<script>
$(document).ready(function(){
    
});

(function(){
    // do some stuff
    
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    var frmdata1=$('#myform').serialize();
    
})();


</script> 