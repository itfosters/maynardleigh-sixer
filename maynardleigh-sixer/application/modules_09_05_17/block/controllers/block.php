<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Block extends ITFS_Front_Controller {

	public function show($block_name="") {
	 
		$this->load->model("blocks","blocks");
		$blockInfo = $this->blocks->getBlockByName($block_name);
		if(count($blockInfo)){
		 	return $this->load->view("blocks",array("blockdata"=>$blockInfo),true);
		}
		
	}
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */