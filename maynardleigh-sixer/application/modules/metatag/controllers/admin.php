<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends ITFS_Controller {

	
	public function index()
	{
			$this->load->library("pagination");
			$this->load->model("metatags");

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

			
			$totalmetatag = $this->metatags->totalMetatags($conditions);
			//echo "<pre>";print_r($totalmetatag);die;
			$config = $this->paginationformat["back_page"];
			$config["base_url"] = base_url()."admin/metatag/index";
			$config["total_rows"] = $totalmetatag;
			$config["per_page"] = $this->config->item("admin_perpage");
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			
			$current_page = ($this->uri->segment($config["uri_segment"]))?$this->uri->segment($config["uri_segment"]):0;
			$data["results"] = $this->metatags->getMetatags($conditions,$config["per_page"], $current_page);
			$data["links"] = $this->pagination->create_links();
			$data["metatag_type"] = $this->config->item('metatag_type');
			//echo "<pre>"; print_r($data); die;
			$this->template->headingtitle="Metatag";
			$this->template->set_breadcrumb("Metatag","");
			
			$this->template->build('admin_index',$data);
			
	}
	
	public function delete()
	{
		
		if($this->input->post("itfaction") == "delete") {			
			$allids = $this->input->post("itfrowdata");
			$delds = array();
                        $this->load->model("metatag/metatags");
            			
			$this->metatags->deleteMulti($allids);
			$this->messages->flash("Metatag have been succesfully deleted.","success");
			redirect(array("admin","metatag","index"));
		}
		elseif($this->input->post("itfaction") == "publish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("metatag/metatags");
			$this->metatags->statusupdate($allids,"1");
			$this->messages->flash("Metatag member have been succesfully publish.","success");
			redirect(array("admin","metatag","index"));		
		}
		elseif($this->input->post("itfaction") == "unpublish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("metatag/metatags");
			$this->metatags->statusupdate($allids,"0");
			$this->messages->flash("Metatag member have been succesfully Unpublish.","success");
			redirect(array("admin","metatag","index"));		
		}else{
			$this->messages->flash("Invalid information.","error");
			redirect(array("admin","metatag","index"));		
		}
	}
	public function form($id='')
	{
		$this->load->model("metatags");
		$this->load->library('form_validation');
		$this->template->add_js("assests/itfeditor/ckeditor.js");
		$this->template->add_js(" $(document).ready(function(){
			CKEDITOR.replace('jobdescription', {
				filebrowserBrowseUrl: '".site_url("itfmanager")."',
				filebrowserImageBrowseUrl: '".site_url("itfmanager")."',
				filebrowserFlashBrowseUrl: '".site_url("itfmanager")."',
				filebrowserUploadUrl: '".site_url("itfmanager")."',
				filebrowserImageUploadUrl: '".site_url("itfmanager")."',
				filebrowserFlashUploadUrl: '".site_url("itfmanager")."'
			});
			CKEDITOR.replace('eligibilitycriteria', {
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
			$this->form_validation->set_rules('name', 'Metatag', 'required|valid_name|is_unique[metatags.name.'.$id.']');
			//form validate
			if($this->form_validation->run() == FALSE) {
			
			$data["frm_data"]["frm_data"] = (object)$this->input->post();
			}else{
				
				if(!empty($id)) {
					$this->metatags->updateMetatag($this->input->post(),array("id"=>$id));
					$this->messages->flash("Metatag have been succesfully updated.","success");
				} else {
					$this->metatags->register($this->input->post());
					$this->messages->flash("Metatag have been succesfully saved.","success");
				}
				
				redirect(array("admin","metatag"));
			}
		}elseif(!empty($id)) {
			$data["frm_data"]["frm_data"] = $this->metatags->getMetatagsById($id);
        
		}

		$data["metatag_type"] = $this->config->item('metatag_type');
		$data["sex"] = array("male"=>"Male","female"=>"Female");
		//echo "<pre>"; print_r($data); die;
		
		$this->template->headingtitle="Metatag";
		$this->template->set_breadcrumb("Metatag",site_url("admin/metatag"));
		$this->template->set_breadcrumb("Experience Information","");
		$this->template->build('admin_metatag_form', $data);
	}
	 public function status()
	{
            if($this->input->post("itfaction") == "status") 
                {
                    $this->load->model("metatags");
                    $recid = $this->input->post("recid");
                    $res = $this->metatags->statuchange($recid);
                    echo json_encode(array("status"=>$res));
               }
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
