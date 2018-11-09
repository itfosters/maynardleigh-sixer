<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends ITFS_Controller {

	 public function index()
	{
		
			$this->load->library("pagination");
			$this->load->model("locations");
			
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
                        
			$totalpage = $this->locations->totalData($conditions);
			$config = $this->paginationformat["back_page"];
			$config["base_url"] = base_url()."admin/location/index";
			$config["total_rows"] = $totalpage;
			$config["per_page"] = $this->config->item("admin_perpage");
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			
			$current_page = ($this->uri->segment($config["uri_segment"]))?$this->uri->segment($config["uri_segment"]):0;
			$data["results"] = $this->locations->find($config["per_page"], $current_page,$conditions);
			$data["links"] = $this->pagination->create_links();
			

			$this->template->headingtitle="Location";
			$this->template->set_breadcrumb("Location","");

			$this->template->build('admin_index',$data);

	}
	
	
	public function delete()
	{
		
		if($this->input->post("itfaction") == "delete") {			
			$allids = $this->input->post("itfrowdata");
			$delds = array();
            $this->load->model("locations");
            			
			$this->locations->deleteMulti($allids);
			$this->messages->flash("Location have been succesfully deleted.","success");
			redirect(array("admin","location","index"));
		}
		elseif($this->input->post("itfaction") == "publish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("locations");
			$this->locations->statusupdate($allids,"1");
			$this->messages->flash("Location have been succesfully publish.","success");
			redirect(array("admin","location","index"));		
		}
		elseif($this->input->post("itfaction") == "unpublish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("locations");
			$this->locations->statusupdate($allids,"0");
			$this->messages->flash("Location have been succesfully Unpublish.","success");
			redirect(array("admin","location","index"));		
		}else{
			$this->messages->flash("Invalid information.","error");
			redirect(array("admin","location","index"));		
		}
		
		
	}
	
	public function form($id='')
	{
		$this->load->model("locations");
		$this->load->library('form_validation');
		$data = array();
		if(count($_POST)>0) {
			
			//Validation rule	
			$this->form_validation->set_rules('name', 'Name', 'required|is_unique[category.name.'.$this->input->post("id").']');
			
			//form validate
			if($this->form_validation->run() == FALSE) {
				$data["frm_data"]["frm_data"] = (object)$this->input->post();
			}else{
				
				$postdata = $this->input->post();
				unset($postdata["id"]);
				if(!empty($id)) {
					$this->locations->update($postdata ,array("id"=>$id));
					$this->messages->flash("Location have been succesfully updated.","success");
				} else {
					$this->locations->save($postdata );
					$this->messages->flash("Location have been succesfully saved.","success");
				}
				
				redirect(array("admin","location"));
			}
		
		
		}elseif(!empty($id)) {
			$data["frm_data"]["frm_data"] = $this->locations->findById($id);
		}

		$this->template->headingtitle="Location";
		$this->template->set_breadcrumb("Location",site_url("admin/location"));
		$this->template->set_breadcrumb("Location Information","");

		$this->template->build('admin_form', $data);
	}
	
}