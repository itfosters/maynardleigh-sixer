<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/facebook/facebook.php';

class Socialuser extends ITFS_Controller {

   public function __construct(){
	    parent::__construct();
		$this->config->load('facebook');
    }
	
	public function facbooklogin()
	{
		$this->load->view("socialuser/facbooklogin");
	}
	
	public function facbooklogout()
	{
		$loginby = $this->session->userdata("loginby");
		$this->load->view("socialuser/facbooklogout",array("fbstatus"=>$loginby));
	}
	
	
	function logout(){
		$this->session->sess_destroy();
		redirect(array("user","logout"));
	}

	function fblogin(){

		$this->load->model("socialusers");
		
		$facebook = new Facebook(array(
		'appId'		=>  $this->config->item('appID'), 
		'secret'	=> $this->config->item('appSecret'),
		));

		$user = $facebook->getUser();
		
		if($user){
			
			try{
				$user_profile = $facebook->api('/me');
				$params = array('next' => site_url('socialuser/logout'));
				$ses_user=array('User'=>$user_profile,'logout' =>$facebook->getLogoutUrl($params));
		       	$this->session->set_userdata($ses_user);
				
			   $userinformation = $this->socialusers->getUsersByEmail($user_profile["email"]);
			   
			   if(isset($userinformation->id,$userinformation->fbid))
			   {
				   	if(empty($userinformation->fbid))
						$this->socialusers->update(array("fbid"=>$user_profile["id"]),array("id",$userinformation->id));

					//Facebook login
					$userinfo = array("userid"=>$userinformation->id , "username"=>$userinformation->username,"loginby"=>"FB");
					$this->session->set_userdata($userinfo);
					
			   } else {
			   
					$fbdata = array(
							"name"=>$user_profile["name"],
							"gender"=>$user_profile["gender"],
							"password"=>md5("A".time()."BP"),
							"email"=>$user_profile["email"],
							"fbid"=>$user_profile["id"],
							"user_type"=>"N",
							"notify_place"=>"1"
						);
					$this->socialusers->register_fbuser($fbdata);

					//login with facebook
					$userinformation = $this->socialusers->getUsersByEmail($user_profile["email"]);
					$userinfo = array("userid"=>$userinformation->id , "username"=>$userinformation->username,"loginby"=>"FB");
					$this->session->set_userdata($userinfo);
			   }
				redirect(array("user","profile"));
				
			}catch(FacebookApiException $e){
				redirect(array("user","user_login"));
			}		
		} else {
			redirect(array("user","user_login"));
		}
	}
	
}

/* End of file fbci.php */
/* Location: ./application/controllers/Socialuser.php */