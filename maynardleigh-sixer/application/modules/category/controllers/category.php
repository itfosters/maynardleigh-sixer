<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends ITFS_Controller {

	 function __construct() {
	 
	
	 }
	 public function index()
	 {
		
		$this->load->library("pagination");
		$this->load->model("categories");
		
		$totalpage = $this->categories->totalCategory();
		$config = array();
		$config["base_url"] = base_url()."category/index";
		$config["total_rows"] = $totalpage;
		$config["per_page"] = $this->config->item("admin_perpage");
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		
		$current_page = ($this->uri->segment($config["uri_segment"]))?$this->uri->segment($config["uri_segment"]):0;
		$data["results"] = $this->categories->getCategory($config["per_page"], $current_page);
		$data["links"] = $this->pagination->create_links();
		$this->template->build('index',$data);

	 }
	 
	 
	  public function view($caturl = "")
	  {
	  
			$this->load->helper("text");
			$this->load->library("pagination");
			$this->load->model("categories");
			$this->load->model("business/places","places");
			
			$categoryinfo = $this->categories->getCategoryByUrl($caturl);
			$categoryid = isset($categoryinfo->id)?$categoryinfo->id:"0";
			$data["categoryname"] = isset($categoryinfo->catname)?$categoryinfo->catname:"No Category";
			
			$totalpage = $this->places->totalPlaceByCategory($categoryid);
			
			$config = array();
			$config["base_url"] = base_url()."category/view/".$caturl;
			$config["total_rows"] = $totalpage;
			$config["per_page"] = $this->config->item("admin_perpage");
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			
			$current_page = ($this->uri->segment($config["uri_segment"]))?$this->uri->segment($config["uri_segment"]):0;
			$data["results"] = $this->places->getPlaceByCategory($categoryid, $config["per_page"], $current_page);
			$data["links"] = $this->pagination->create_links();
			$this->template->build('view',$data);

	  }
	  
	  public function categorylist() 
	  {
			$this->load->model("category/categories","categories");
			$data["results"] = $this->categories->getAllCategorys();
			$this->load->view("category/top_category",$data);
	  }
	  
	  public function searchblock() 
	  {
			$category_ids = $this->input->post("category_ids");
			
			$this->load->model("category/categories","categories");
			$results = array("0"=>"All Category");
			foreach($this->categories->getAllCategoryInfo() as $res) {
				$results[$res->id] = $res->name;
			}
			$data["results"] = $results;
			$data["category_ids"]= $category_ids;
			$this->load->view("category/searchblock",$data);
	  }
	
}