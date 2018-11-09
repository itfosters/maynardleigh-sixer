<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staticblock extends ITFS_Controller {

	 public function our_directory()
	{
		//$this->load->model("blocks");
		$this->load->view('block/our_directory');
	}
	
		
	 public function resent_adds()
	{	
		$this->load->model("places/place","place");
		$this->load->helper("text");
		$latestplace = $this->place->getLatestPlaces(5);
		$this->load->view('block/recent_adds',array("latestplace"=>$latestplace));
	}
	
	public function resent_news()
	{
		$this->load->model("news/announcement");
		$this->load->helper("text");
		$latestnews = $this->announcement->getActiveNews(5);
		
		$this->load->view('block/recent_news',array("latestnews"=>$latestnews));
	}
	
	public function footer_block()
	{
		
		$this->load->model("page/pages","pages");
		$this->load->helper("text");
		
		$pagename= (!empty($pagename))?$pagename:"about-us"; 
		$pageinfo = $this->pages->get_Page($pagename);
		
		$this->load->view('block/footer_block',array("pagedata"=>$pageinfo));
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */