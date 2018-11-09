<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends ITFS_Front_Controller {

	public function index($pagename = "")
	{
		$this->load->model("pages");
		
		$this->load->helper("text");
		$pagename= (!empty($pagename))?$pagename:"not-found"; 

		//Latest News
		
		$pageinfo = $this->pages->findByUrl($pagename);
		
		if(!isset($pageinfo->id))
		{
			$pageinfo = $this->pages->findByUrl("not-found");
		}
		
		$this->template->set("pagetitle",$pageinfo->title);
		
		if(!empty($pageinfo->meta_title))
			$this->template->title($pageinfo->meta_title);

		if(!empty($pageinfo->meta_keyword))
		$this->template->set_metadata("keyword",$pageinfo->meta_keyword);
		
		if(!empty($pageinfo->meta_content))
		$this->template->set_metadata("description",$pageinfo->meta_content);

        if($this->input->is_ajax_request())
        {
            $this->template
                    ->set_layout("ajax")
					->build('page_popup',array("itfdata"=>(array)$pageinfo));
        }  else {
            $this->template
			//->set_partial('right', 'news/rightlatestnews',array("blocks"=>$blockdata))
			->build('index',array("itfdata"=>(array)$pageinfo));
        }
	}
	
	public function contact($pagename = "")
	{
		$this->template->add_js("assests/js/jquery.validate.js", "B");
		$validationscript = '$(document).ready(function(){    
		$("#frmcontact").validate({
					rules: {
						"name":"required",
						"last_name":"required",
						"email":{"email":true,"required":true},
						"contact":"required",
						"message":"required",
						},
						messages:{
						"name":"",
						"last_name":"",
						"email":{"email":"","required":""},
						"contact":"",
						"message":"",	
						
						}
				});
				
		});';
		$this->template->add_js($validationscript, "B","embed");                
        
        $data = array();
		if(count($_POST)>0) {
		$this->load->library('form_validation');

			$this->form_validation
				->set_rules('name', 'First name', 'required')
                                ->set_rules('last_name', 'Last name', 'required')
				->set_rules('email', 'Email', 'required|valid_email')
                                ->set_rules('contact', 'Contact', 'required')
                                ->set_rules('message', 'Message', 'required')
				->set_rules('captcha', 'Captcha', 'trim|required|callback_captcha|xss_clean');
			
			//form validate
			if($this->form_validation->run() == FALSE) {
				$data["frm_data"]["frm_data"] = (object)$this->input->post();
			}else{
			
				$this->load->library('email');
                $contactinfo =  array(
                                "name"=>$this->input->post("name"),
                                "last_name"=>$this->input->post("last_name"),
                                "email"=>$this->input->post("email"),
                                "contact"=>$this->input->post("contact"),
                                "message"=>$this->input->post("message"),
                                "captcha"=>$this->input->post("captcha")
                                );
                                               
                //now sending email for contact us
                $this->email->to($contactinfo["email"]);
                
                $this->email->from('cburr1022@yahoo.com');
				$this->email->set_mailtype("html");
				$maildata = $this->mails->getMailById(4);
				$datainfo = $this->messages->mailData($contactinfo,$maildata->mailbody);
                                 
				$bodymessage = $this->messages->mailTemplate($datainfo);
				$this->email->subject($maildata->mailsubject);
				$this->email->message($bodymessage);
				$this->email->send();
				$this->email->clear();
				
				
				
				//$this->email->to($configdata["contact_email"]);
				$this->email->to("priyanshusaurabh2007@gmail.com");
				$this->email->from('priyanshusaurabh2007@gmail.com');
				$this->email->set_mailtype("html");
				
				$maildata = $this->mails->getMailById(15);
				$datainfo = $this->messages->mailData($contactinfo,$maildata->mailbody);
                                
				$bodymessage = $this->messages->mailTemplate($datainfo);
				$this->email->subject($contactinfo["name"]." contact by ITFosters" );
				$this->email->message($bodymessage);
				
				$this->email->send();


                redirect(array("page","index","thanks"));
			
			}
		}
		
		$this->load->model("pages");
		$pagename= (!empty($pagename))?$pagename:"contact-us"; 
                $pageinfo = $this->pages->get_Page($pagename);
                $data["frm_data"]["pageinfo"] = $pageinfo;
		//load layout
		$this->template->build('contact',$data);
                
	}
	
}