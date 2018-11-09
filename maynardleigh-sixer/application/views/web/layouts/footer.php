            <div class="clearfix"></div>
            </div>
             <!-- /. PAGE WRAPPER  -->
         </div>
     </div>
     <!-- /. WRAPPER  -->
     
     <footer ><div class="text-center">&copy; <?php echo date('y');?> ITFosters Web Solutions Pvt. Ltd</div></footer>

    
     
     <script src="<?php echo ASSESTS_ULR."js/jquery.metisMenu.js"?>"></script>
     <script src="<?php echo ASSESTS_ULR."js/jquery-ui-1.11.1.js"?>"></script>
     <script src="<?php echo ASSESTS_ULR."js/moment.min.js"?>"></script>
     <script src="<?php echo ASSESTS_ULR."js/bootstrap.js"?>"></script>
     <script src="<?php echo ASSESTS_ULR."js/jquery-ui.multidatespicker.js"?>"></script> 
      <script src="<?php echo ASSESTS_ULR."js/fullcalendar.js"?>"></script> 
    <!-- <script src="<?php echo ASSESTS_ULR."js/bootstrap-datetimepicker.min.js"?>"></script>-->
     <script src="<?php echo ASSESTS_ULR."js/daterangepicker.js"?>"></script>
     <script src="<?php echo ASSESTS_ULR."js/bootstrap-select.js"?>"></script>
     <script src="<?php echo ASSESTS_ULR."js/jquery.formShowHide.min.js"?>"></script>
     <script src="<?php echo ASSESTS_ULR."js/jquery.steps.min.js"?>"></script>
     <script src="<?php echo ASSESTS_ULR."js/jquery.validate.js"?>"></script>
     <!--<script src="<?php echo ASSESTS_ULR."js/jquery-1.9.1.min.js"?>"></script>-->
     <script src="<?php echo ASSESTS_ULR."js/jquery-ui-custom.min.js"?>"></script>
     <script src="<?php echo ASSESTS_ULR."js/jquery-ui-slider-pips.min.js"?>"></script>
     <script src="<?php echo ASSESTS_ULR."js/jquery-ui-touch-punch.min.js"?>"></script>
     
     <script src="<?php echo ASSESTS_ULR."js/custom.js"?>"></script>


     <?php echo $template['jscss_footer']; ?>  
     
   <script>
$('#custom-date-format').multiDatesPicker({
	dateFormat: "y-m-d", 
	
});


$(function() {
    $('input[name="daterange"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
    });
});
</script>  
 </body>
 </html>