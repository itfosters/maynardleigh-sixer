<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends ITFS_Controller {

	 public function index()
	{
			$this->load->library("pagination");
			$this->load->model("banners");

			


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
                        
			$totalpage = $this->banners->totalData($conditions);
			$config = array();
			$config["base_url"] = base_url()."admin/banner/index";
			$config["total_rows"] = $totalpage;
			$config["per_page"] = $this->config->item("admin_perpage");
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			
			$current_page = ($this->uri->segment($config["uri_segment"]))?$this->uri->segment($config["uri_segment"]):0;
			$data["results"] = $this->banners->find($config["per_page"], $current_page, $conditions);
			$data["links"] = $this->pagination->create_links();
			
			$this->template->headingtitle="Banner";
			$this->template->set_breadcrumb("Banner","");
			$this->template->build('admin_index',$data);
	}
	
	public function delete()
	{
		
		if($this->input->post("itfaction") == "delete") {			
			$allids = $this->input->post("itfrowdata");
			$delds = array();
            $this->load->model("banner/banners");
            			
			$this->banners->deleteMulti($allids);
			$this->messages->flash("Banner have been succesfully deleted.","success");
			redirect(array("admin","banner","index"));
		}
		elseif($this->input->post("itfaction") == "publish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("banner/banners");
			$this->banners->statusupdate($allids,"1");
			$this->messages->flash("Banner have been succesfully publish.","success");
			redirect(array("admin","banner","index"));		
		}
		elseif($this->input->post("itfaction") == "unpublish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("banner/banners");
			$this->banners->statusupdate($allids,"0");
			$this->messages->flash("Banner have been succesfully Unpublish.","success");
			redirect(array("admin","banner","index"));		
		}else{
			$this->messages->flash("Invalid information.","error");
			redirect(array("admin","banner","index"));		
		}
		
		
	}
	
	//Deleted File
	function deleteImage($ids="0") {	
			$bannerinfo = $this->banners->findById($ids);
			@unlink($this->config->item('public_path')."banner/".$bannerinfo->banner_image);
	}
	
	public function form($id='')
	{
		$this->load->model("banners");
		$this->load->library('form_validation');

		
			
		$this->template->add_js("assests/itfeditor/ckeditor.js");
		$this->template->add_js(" $(document).ready(function(){CKEDITOR.replace('description'); });","B","embed");
		
		$data = array();

		

		if(count($_POST)>0) {
			
			//Validation rule	
			$this->form_validation->set_rules('title', 'page title', 'required');
			
			//form validate
			if($this->form_validation->run() == FALSE) {
				$data["frm_data"]["frm_data"] = $this->input->post();
			}else{
				
				$status = true;
				$data = $this->input->post();
				
				if($this->UploadImage($data,$id)===false) { 
					$data["frm_data"]["frm_data"] = (object)$this->input->post();
					$status = false;
				}
				
				if($status == true) {				
					if(!empty($id)) {
						$this->banners->update($data,array("id"=>$id));
						$this->messages->flash("Banner have been succesfully updated.","success");
					} else {
						$this->banners->save($data);
						$this->messages->flash("Banner have been succesfully saved.","success");
					}
					redirect(array("admin","banner","index"));
					
				} else {
					$this->messages->flash($this->upload->display_errors("",""),"error");
				}
				
			}
		
		
		}elseif(!empty($id)) {
			$data["frm_data"]["frm_data"] = $this->banners->findById($id);
		}
		
		$this->template->headingtitle="Banner";
		$this->template->set_breadcrumb("Banner",site_url("admin/banner"));
		$this->template->set_breadcrumb("Banner Information","");

		
		$this->template->build('admin_page_form', $data);
	}
	
	
	protected function UploadImage(&$data,$id) {
	
			if(isset($_FILES["bannerimage"]["name"]) and !empty($_FILES["bannerimage"]["name"])) {
					$config['upload_path'] = PUBLIC_PATH."banner/";
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '20000000';
					$config['max_width'] = '2024';
					$config['max_height'] = '2024';
					$this->load->library('upload');
					$this->upload->initialize($config);
					$result = $this->upload->do_upload('bannerimage');
					
					
					if($result>=1) {
						$this->deleteImage($id);
						$imageinfo = $this->upload->data();
						$data["banner_image"] = $imageinfo["file_name"];
						return true;
					}else {
						return false;
					}
				}
				return true;
	}
	public function status()
	{
	    if($this->input->post("itfaction") == "status") 
	        {
	            $this->load->model("banners");
	            $recid = $this->input->post("recid");
	            $res = $this->banners->statuchange($recid);
	            echo json_encode(array("status"=>$res));
	       }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
