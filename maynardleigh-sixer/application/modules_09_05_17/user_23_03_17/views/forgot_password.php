<div class="margin">         
 	<div class="pop-pup-right-form">
		 <div class="pop-pup-right-area">
 			<h3>Forgot Passsword</h3>
             <div class="pop-pup-right-area-form">
			<?php  echo form_open("user/fortgot_password",array("id"=>"frmuserlogin")); ?>
            <label for="emailid">Email Address</label>            
            <?php echo form_input(array("id"=>"emailid","name"=>"emailid","class"=>"text")); ?>  
            <?php echo form_error('emailid') ?>
            <a href="<?php echo site_url("user/user_login"); ?>" class="pop-white">Return to Login?</a>            
             <button type="submit">SUBMIT</button>             
			<?php echo form_close(); ?>
            </div>
		 </div>
 	</div>
     <div class="clear"></div>    
</div>
