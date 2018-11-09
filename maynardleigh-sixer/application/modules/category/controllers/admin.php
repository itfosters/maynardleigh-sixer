<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends ITFS_Controller {

	 public function index()
	{
		
			$this->load->library("pagination");
			$this->load->model("categories");
			
                        //Filter Data
			$conditions = array();
			if(isset($_POST["q"])) {
				$this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
			} 
			$searchfield = $this->session->userdata("SEARCHFIELD");
			
			if(count($searchfield)>0)
			$data["frm_data"] = $searchfield;
			
			if(isset($searchfield["q"]) and !empty($searchfield["q"]))
				$conditions = array("name"=>$searchfield["q"]);
			// End of Filter Data
                        
			$totalpage = $this->categories->totalData($conditions);
			$config = $this->paginationformat["back_page"];
			$config["base_url"] = base_url()."admin/category/index";
			$config["total_rows"] = $totalpage;
			$config["per_page"] = $this->config->item("admin_perpage");
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			
			$current_page = ($this->uri->segment($config["uri_segment"]))?$this->uri->segment($config["uri_segment"]):0;
			$data["results"] = $this->categories->find($config["per_page"], $current_page,$conditions);
			$data["links"] = $this->pagination->create_links();
			

			$this->template->headingtitle="Category";
			$this->template->set_breadcrumb("Category","");

			$this->template->build('admin_index',$data);

	}
	
	
	public function delete()
	{
		
		if($this->input->post("itfaction") == "delete") {			
			$allids = $this->input->post("itfrowdata");
			$delds = array();
                        $this->load->model("categories");
            			
			$this->categories->deleteMulti($allids);
			$this->messages->flash("Page have been succesfully deleted.","success");
			redirect(array("admin","category","index"));
		}
		elseif($this->input->post("itfaction") == "publish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("categories");
			$this->categories->statusupdate($allids,"1");
			$this->messages->flash("Page have been succesfully publish.","success");
			redirect(array("admin","category","index"));		
		}
		elseif($this->input->post("itfaction") == "unpublish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("categories");
			$this->categories->statusupdate($allids,"0");
			$this->messages->flash("Page have been succesfully Unpublish.","success");
			redirect(array("admin","category","index"));		
		}else{
			$this->messages->flash("Invalid information.","error");
			redirect(array("admin","category","index"));		
		}
		
		
	}
	
	public function form($id='')
	{
		$this->load->model("categories");
		$this->load->library('form_validation');
		$data = array();
		if(count($_POST)>0) {
			
			//Validation rule	
			$this->form_validation->set_rules('name', 'Name', 'required|is_unique[category.name.'.$this->input->post("id").']');
			
			//form validate
			if($this->form_validation->run() == FALSE) {
				$data["frm_data"]["frm_data"] = (object)$this->input->post();
			}else{
				
				$_POST["seo_url"] = url_title(strtolower($_POST["name"]));
				$postdata = $this->input->post();

				if(!empty($id)) {
					$this->categories->update($postdata ,array("id"=>$id));
					$this->messages->flash("Category have been succesfully updated.","success");
				} else {
					$this->categories->save($postdata );
					$this->messages->flash("Category have been succesfully saved.","success");
				}
				
				redirect(array("admin","category"));
			}
		
		
		}elseif(!empty($id)) {
			$data["frm_data"]["frm_data"] = $this->categories->findById($id);
		}

		$this->template->headingtitle="Category";
		$this->template->set_breadcrumb("Category",site_url("admin/category"));
		$this->template->set_breadcrumb("Category Information","");

		$this->template->build('admin_form', $data);
	}
	
}