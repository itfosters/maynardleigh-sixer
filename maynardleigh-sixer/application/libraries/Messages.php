<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class ITFS_Messages {
	protected $itf;
	protected $templatedata = "";
	
	function __construct($params = array()) {
		$this->itf = & get_instance();
	}
	
	function check($type = "") {
		
		if($this->itf->session->userdata('itfmessages')) {
			$message = $this->itf->session->userdata('itfmessages');
			if(isset($message["type"]) and $message["type"] == $type)
				return true;
			else
				return false;
		} else { 
			return false;
		}
			
	}
	
	function flash($message= "", $type = 'success') {
	
		if(!empty($message)) {
			$this->itf->session->unset_userdata(array("itfmessages"=>array()));
			$this->itf->session->set_userdata(array("itfmessages"=>array("message"=>$message,"type"=>$type)));
			return true;
		} else {
			if($this->itf->session->userdata('itfmessages')) {
				$message = $this->itf->session->userdata('itfmessages');
				$this->itf->session->unset_userdata(array("itfmessages"=>array()));
				return $message["message"];
			} else { return ""; }
		}
	}
	
	function mailData($datas=array(),$templatedata = "")
	{
		
		$allkeys = array_keys($datas);

		$allvalues = array_values($datas);

		foreach($allkeys as $k=>&$d)
//echo "<pre>";print_r($d);
			$d = strtoupper("{".$d."}");

		$updatedata = str_replace($allkeys,$allvalues,$templatedata);
		return $updatedata;
	}
	
	function mailTemplate($templatedata="",$templatename = "mail_layout")
	{
		return $this->itf->load->view("mail/".$templatename,array("itfdatas"=>$templatedata),true);
		//return $this->itf->output->get_output();
	}
	
}  