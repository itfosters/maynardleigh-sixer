<?php 
if($fbstatus=="FB")
echo '<li><a href="'.$this->session->userdata('logout').'">Logout</a></li>';
else
echo '<li><a href="'.site_url("user/logout").'">Logout</a></li>';
//echo '<img src="https://graph.facebook.com/'. $ses_user['id'] .'/picture" width="30" height="30"/><div>'.$ses_user['name'].'</div>';	
//echo '<div class="fblogins" >&nbsp;</div>';
?>