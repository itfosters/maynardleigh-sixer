<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends ITFS_Controller {

	 function __construct() 
	 {
	 }
	
	public function slider()
	{		
        $this->load->model("banner/banners");
		$allbanner =  $this->banners->getActiveBanners();
		$this->load->view('banner/slider',array("banners"=>$allbanner));
	}
       
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
