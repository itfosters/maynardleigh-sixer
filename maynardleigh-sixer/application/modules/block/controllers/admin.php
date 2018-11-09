<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends ITFS_Controller {

	 public function index()
	{
		
			$this->load->library("pagination");
			$this->load->model("blocks");
			                        //Filter Data
			$conditions = array();
			if(isset($_POST["q"])) {
				$this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
			} 
			$searchfield = $this->session->userdata("SEARCHFIELD");
			
			if(count($searchfield)>0)
			$data["frm_data"] = $searchfield;
			
			if(isset($searchfield["q"]) and !empty($searchfield["q"]))
				$conditions = array("title"=>$searchfield["q"]);
			// End of Filter Data

			$totalpage = $this->blocks->totalBlocks($conditions);
			$config = $this->paginationformat["back_page"];
			$config["base_url"] = base_url()."admin/block/index";
			$config["total_rows"] = $totalpage;
			$config["per_page"] = $this->config->item("admin_perpage");
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			
			$current_page = ($this->uri->segment($config["uri_segment"]))?$this->uri->segment($config["uri_segment"]):0;
			$data["results"] = $this->blocks->getBlocks($config["per_page"], $current_page, $conditions);
			$data["links"] = $this->pagination->create_links();
			
			$this->template->headingtitle="Block";
			$this->template->set_breadcrumb("Block","");

			$this->template->build('admin_index',$data);
	}
	
		
		
	public function delete()
	{
		if($this->input->post("itfaction") == "delete") {			
			$allids = $this->input->post("itfrowdata");
			//print_r($allids); die;
			$delds = array();
                        $this->load->model("block/blocks");
            			
			$this->blocks->deleteMulti($allids);
			$this->messages->flash("Block have been succesfully deleted.","success");
			redirect(array("admin","block","index"));
		}

		elseif($this->input->post("itfaction") == "publish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("block/blocks");
			$this->blocks->statusupdate($allids,"1");
			$this->messages->flash("Block member have been succesfully publish.","success");
			redirect(array("admin","block","index"));		
		}
		elseif($this->input->post("itfaction") == "unpublish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("block/blocks");
			$this->blocks->statusupdate($allids,"0");
			$this->messages->flash("Block member have been succesfully Unpublish.","success");
			redirect(array("admin","block","index"));		
		}else{
			$this->messages->flash("Invalid information.","error");
			redirect(array("admin","block","index"));		
		}
	}	
	
	
	public function form($id='')
	{
		$this->load->model("blocks");
		$this->load->library('form_validation');
		
		$this->template->add_js("assests/itfeditor/ckeditor.js");
		$this->template->add_js(" $(document).ready(function(){
			CKEDITOR.replace('description', {
				filebrowserBrowseUrl: '".site_url("itfmanager")."',
				filebrowserImageBrowseUrl: '".site_url("itfmanager")."',
				filebrowserFlashBrowseUrl: '".site_url("itfmanager")."',
				filebrowserUploadUrl: '".site_url("itfmanager")."',
				filebrowserImageUploadUrl: '".site_url("itfmanager")."',
				filebrowserFlashUploadUrl: '".site_url("itfmanager")."'
			}); });","B","embed");
		
		
		$data = array();
		if(count($_POST)>0) {
			
			//Validation rule	
			$this->form_validation->set_rules('title', 'block title', 'required')
				->set_rules('name', 'block name', 'required|is_unique[blocks.name.'.$this->input->post("id").']');
			
			//form validate
			if($this->form_validation->run() == FALSE) {
				$data["frm_data"]["frm_data"] = (object)$this->input->post();
			}else{
				
				if(!empty($id)) {
					$this->blocks->updateBlock($this->input->post(),array("id"=>$id));
					$this->messages->flash("Block have been succesfully updated.","success");
				} else {
					$this->blocks->addBlock($this->input->post());
					$this->messages->flash("Block have been succesfully saved.","success");
				}
				
				redirect(array("admin","block"));
			}
		
		
		}elseif(!empty($id)) {
			$data["frm_data"]["frm_data"] = $this->blocks->getBlockById($id);
		}

		$this->template->headingtitle="Block";
		$this->template->set_breadcrumb("Block",site_url("admin/block"));
		$this->template->set_breadcrumb("Block Information","");

		$this->template->build('admin_form', $data);
	}
	public function status()
	{
            if($this->input->post("itfaction") == "status") 
                {
                    $this->load->model("blocks");
                    $recid = $this->input->post("recid");
                    $res = $this->blocks->statuchange($recid);
                    echo json_encode(array("status"=>$res));
               }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
