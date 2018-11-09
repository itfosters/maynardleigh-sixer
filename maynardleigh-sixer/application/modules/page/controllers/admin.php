<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends ITFS_Controller {

	 public function index()
	{
		
			$this->load->library("pagination");
			$this->load->model("pages");
			
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
			
			$totalpage = $this->pages->totalData($conditions);
			$config = $this->paginationformat["back_page"];
			$config["base_url"] = base_url()."admin/page/index";
			$config["total_rows"] = $totalpage;
			$config["per_page"] = $this->config->item("admin_perpage");
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			
			$current_page = ($this->uri->segment($config["uri_segment"]))?$this->uri->segment($config["uri_segment"]):0;
			$data["results"] = $this->pages->find($conditions,$config["per_page"], $current_page);
			$data["links"] = $this->pagination->create_links();
			
			$this->template->headingtitle="Page";
			$this->template->set_breadcrumb("Page","");

			$this->template->build('admin_index',$data);
	}
	
		
		
	public function delete()
	{
		
		if($this->input->post("itfaction") == "delete") {			
			$allids = $this->input->post("itfrowdata");
			$delds = array();
                        $this->load->model("page/pages");
            			
			$this->pages->deleteMulti($allids);
			$this->messages->flash("Page have been succesfully deleted.","success");
			redirect(array("admin","page","index"));
		}
		elseif($this->input->post("itfaction") == "publish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("page/pages");
			$this->pages->statusupdate($allids,"1");
			$this->messages->flash("Page have been succesfully publish.","success");
			redirect(array("admin","page","index"));		
		}
		elseif($this->input->post("itfaction") == "unpublish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("page/pages");
			$this->pages->statusupdate($allids,"0");
			$this->messages->flash("Page have been succesfully Unpublish.","success");
			redirect(array("admin","page","index"));		
		}else{
			$this->messages->flash("Invalid information.","error");
			redirect(array("admin","page","index"));		
		}
		
		
	}
	
	
	public function form($id='')
	{
		$this->load->model("pages");
		$this->load->library('form_validation');
		
		$this->template->add_js("assests/itfeditor/ckeditor.js");
		$this->template->add_js(" $(document).ready(function(){
			CKEDITOR.replace('description', {
				filebrowserBrowseUrl: '".base_url("itfmanager")."',
				filebrowserImageBrowseUrl: '".base_url("itfmanager")."',
				filebrowserFlashBrowseUrl: '".base_url("itfmanager")."',
				filebrowserUploadUrl: '".base_url("itfmanager")."',
				filebrowserImageUploadUrl: '".base_url("itfmanager")."',
				filebrowserFlashUploadUrl: '".base_url("itfmanager")."'
			}); });","B","embed");
		
		
		$data = array();
		if(count($_POST)>0) {
			$_POST["name"] = url_title($_POST["name"]);
			
			//Validation rule	
			$this->form_validation->set_rules('title', 'page title', 'required')
				->set_rules('name', 'page name', 'required|is_unique[pages.name.'.$this->input->post("id").']');
			
			//form validate
			if($this->form_validation->run() == FALSE) {
				$data["frm_data"]["frm_data"] = (object)$this->input->post();
			}else{
				$postdata = $this->input->post();
				
				if(!empty($id)) {
					$this->pages->update($postdata,array("id"=>$id));
					$this->messages->flash("Page have been succesfully updated.","success");
				} else {
					$this->pages->save($postdata);
					$this->messages->flash("Page have been succesfully saved.","success");
				}
				
				redirect(array("admin","page"));
			}
		
		
		}elseif(!empty($id)) {
			$data["frm_data"]["frm_data"] = $this->pages->findById($id);
		}
		$this->template->headingtitle="Page";
		$this->template->set_breadcrumb("Page",site_url("admin/page"));
		$this->template->set_breadcrumb("Page Information","");

		$this->template->build('admin_page_form', $data);
	}
	
}