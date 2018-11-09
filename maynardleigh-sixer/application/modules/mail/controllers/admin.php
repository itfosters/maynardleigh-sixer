<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends ITFS_Controller {

	 public function index()
	{
		
			$this->load->library("pagination");
			$this->load->model("mails");
			
			//Filter Data
			$conditions = array();
			if(isset($_POST["q"])) {
				$this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
			} 
			$searchfield = $this->session->userdata("SEARCHFIELD");
			
			if(count($searchfield)>0)
			$data["frm_data"] = $searchfield;
			
			if(isset($searchfield["q"]) and !empty($searchfield["q"]))
				$conditions = array("mailtitle"=>$searchfield["q"]);
			// End of Filter Data
			
			
			
			$totalpage = $this->mails->totalMails($conditions);
			$config = $this->paginationformat["back_page"];
			$config["base_url"] = base_url()."admin/mail/index";
			$config["total_rows"] = $totalpage;
			$config["per_page"] = $this->config->item("admin_perpage");
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			
			$current_page = ($this->uri->segment($config["uri_segment"]))?$this->uri->segment($config["uri_segment"]):0;
			$data["results"] = $this->mails->find($conditions,$config["per_page"], $current_page);
			$data["links"] = $this->pagination->create_links();
			$this->template->headingtitle="Mail";
			$this->template->set_breadcrumb("Mail","");

			$this->template->build('admin_index',$data);
	}
	
	public function delete()
	{
		
		if($this->input->post("itfaction") == "delete") {			
			$allids = $this->input->post("itfrowdata");
			$delds = array();
                        $this->load->model("mail/mails");
            			
			$this->mails->deleteMulti($allids);
			$this->messages->flash("Mail have been succesfully deleted.","success");
			redirect(array("admin","mail","index"));
		}
		elseif($this->input->post("itfaction") == "publish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("mail/mails");
			$this->mails->statusupdate($allids,"1");
			$this->messages->flash("Mail have been succesfully publish.","success");
			redirect(array("admin","mail","index"));		
		}
		elseif($this->input->post("itfaction") == "unpublish") {
			$allids = $this->input->post("itfrowdata");
			$this->load->model("mail/mails");
			$this->mails->statusupdate($allids,"0");
			$this->messages->flash("Mail have been succesfully Unpublish.","success");
			redirect(array("admin","mail","index"));		
		}else{
			$this->messages->flash("Invalid information.","error");
			redirect(array("admin","mail","index"));		
		}
		
		
	}
	
	public function form($id='')
	{
		$this->load->model("mails");
		$this->load->library('form_validation');
		
		$this->template->add_js("assests/itfeditor/ckeditor.js");
		$this->template->add_js(" $(document).ready(function(){
			CKEDITOR.replace('mailbody', {
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
			$this->form_validation->set_rules('mailtitle', 'mails name', 'required|is_unique[mails.mailtitle.'.$this->input->post("id").']');
			
			//form validate
			if($this->form_validation->run() == FALSE) {
				$data["frm_data"]["frm_data"] = (object)$this->input->post();
			}else{
				
				if(!empty($id)) {
					$this->mails->updateMail($this->input->post(),array("id"=>$id));
					$this->messages->flash("Mail have been succesfully updated.","success");
				} else {
					$this->mails->addMail($this->input->post());
					$this->messages->flash("Mail have been succesfully saved.","success");
				}
				
				redirect(array("admin","mail"));
			}
		
		
		}elseif(!empty($id)) {
			$data["frm_data"]["frm_data"] = $this->mails->getMailById($id);
		}
		$this->template->headingtitle="Mail";
		$this->template->set_breadcrumb("Mail",site_url("admin/mail"));
		$this->template->set_breadcrumb("Mail Information","");

		$this->template->build('admin_form', $data);
	}
	public function status()
	{
            if($this->input->post("itfaction") == "status") 
                {
                    $this->load->model("mails");
                    $recid = $this->input->post("recid");
                    $res = $this->mails->statuchange($recid);
                    echo json_encode(array("status"=>$res));
               }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
