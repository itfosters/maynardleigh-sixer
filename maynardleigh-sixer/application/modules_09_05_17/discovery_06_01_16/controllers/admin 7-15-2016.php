<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends ITFS_Controller {

   public function index()
	{
		$this->load->model("welcomes");
		$info=$this->welcomes->getStatistic();		
		$this->template->build('admin_index');
	}
}
