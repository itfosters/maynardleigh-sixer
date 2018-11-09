<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends ITFS_Controller {

	 public function index()
	{
		
		$this->load->model("siteconfiguration");
		$this->load->library('form_validation');
		$data = array();
		$validatedata = $this->siteconfiguration->getSiteConfig();
	
		if(count($_POST)>0) {
		
			//Validation rule
			foreach($validatedata as $datas) {	
				$this->form_validation->set_rules($datas->field_code, $datas->field_name, 'required');
			}
			//form validate
			if($this->form_validation->run() == FALSE) {
				$this->template->set("frm_data", $this->input->post());
			}else{
				$this->siteconfiguration->updateSiteConfig($this->input->post());
                                
				$this->messages->flash("Your configuration have succesfully updated.","success");
				redirect(array("admin","siteconfig"));
			}
		
		
		}else {
		
			$alldt = array();
			foreach($validatedata as $dt) {
			$alldt[$dt->field_code] = $dt->field_value;
			}
			$this->template->headingtitle="Site Configuration";
			$this->template->set_breadcrumb("Site Configuration","");
			$this->template->set("frm_data", $alldt);
		}

		$this->template->build('admin_index');
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */