

<?php //echo "<pre>";print_r($complainType);die;
   //$complane=array('x','y','z');
   ?>
<?php echo form_open(); //"welcome/index", array("id" => "search")  ?> 
<div class="row">
   <div class="col-md-12">
      <div class="form-group">
         <label for="cmp_title">Complain Type:</label>
         <!--    <input type="text" class="form-control" name="cmp_title" value="<?php //echo isset($cmp_title)?$cmp_title:'';?>" id="cmp_title">-->
         <?php 
            echo form_dropdown('cmp_type',$complainType,'','class="form-control"');
            
            
            ?>
      </div>
   </div>

   <div class="col-md-12">
      <div class="form-group">
         <label for="cmp_desc">Complain Description:</label>
         <textarea name="cmp_desc" class="form-control" id="complainDesc"><?php echo isset($cmp_desc)?$cmp_desc:'';?></textarea>
      </div>
      <input type="hidden" name="orderID" value="<?php  echo isset($ordId)?$ordId:''; ?>">
      <input type="hidden" name="cmp_id" value="<?php echo isset($cmp_id)?$cmp_id:''; ?>">
      <button type="submit" class="btn btn-primary detail">Submit</button>
   </div>
   <?php form_close();?>
</div>
<div class="row">
   <!-- <div class="clearfix"></div> -->
</div>
<script type="text/javascript" src="http://localhost/sixer/assests/itfeditor/ckeditor.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
    CKEDITOR.replace('complainDesc', {});
    
        $('#clock').on('click', function() {
             $('#modal').show('1000');
        });

        
        
      });
</script>
