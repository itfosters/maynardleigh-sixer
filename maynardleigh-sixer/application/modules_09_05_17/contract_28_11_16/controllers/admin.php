<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends ITFS_Controller 
{
	public function __construct() 
    {
        $this->load->helper('form','url');
        $this->load->library(array('form_validation','pagination'));
        $this->load->model('contracts');
		$this->load->model('order/orders');
		$this->load->model('client/clients');
		$this->load->model('diagnose/diagnoses');
		$this->load->model('design/designs');
		$this->load->model('delivery/deliveries');
		$this->load->model('discovery/discoveries');
		$this->load->model('product/products');
        $this->load->library('email');
    }
    public function index($orderid='') 
    {
            //die('vghujh');
            $all=$this->contracts->showAllRows();
           	
			//$where=1;
			$data['detail']=$this->orders->getOrderDetail(array("O.id"=>$orderid));
			$data['diagonoesdetail']=$this->diagnoses->getDiagonoesDetail($orderid);
			$data['getdesigndetail']=$this->designs->getdesignDetail($orderid);
			$data['getdeliverydetail']=$this->deliveries->getdeliveryDetail($orderid);
			$data['getdiscoveryDetail']=$this->discoveries->getdiscoveryDetail($orderid);
			$data['get_diagnose']=$this->contracts->get_diagnose($orderid);
			$data['get_design']=$this->contracts->get_design($orderid);
			$data['get_delivey']=$this->contracts->get_delivey($orderid);
			$data['get_discovery']=$this->contracts->get_discovery($orderid);
            //echo "<pre>zcse"; print_r($data);die;
			$this->template->set_layout('contract_layout');
			$this->template->build('show_contract', array("frmdata"=>$data));
			
    }
    public function sendMail($orderid="")
    { //echo "@@@@<pre>";print_r($_POST);die;
    			$data['detail']=$this->orders->getEcoEmail(array("O.id"=>$orderid));
    			//echo "####<pre>";print_r($data);die;
    			$ecoemail=$data['detail']->email_Id;
    			$ecofirstname=$data['detail']->first_name;
    			$ecolastname=$data['detail']->last_name;
                $link =site_url('contract_accept/index'.'/'.$orderid);
    			//die($link);
    				
                    $this->email->to($ecoemail);                
                    //$this->email->to('send2ranu@gmail.com');                
                    $this->email->from('info@maynardleighonline.in ');
                    $this->email->set_mailtype("html");
                    $maildata = $this->mails->getMailById(5);
                    //echo "<pre>";print_r($maildata);die;
                    $information = array(
                    					//'username'=>$ecoemail,
                    					'name'=>$ecofirstname,
                                        'link'=>$link
                                        );

                    $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
                    //echo "<pre>";print_r($datainfo);die;
                    $bodymessage = $this->messages->mailTemplate($datainfo);
                    $this->email->subject($maildata->mailsubject);
                    $this->email->message($bodymessage);
                    $this->email->send();
                    
                    if($this->email->_replyto_flag==1)
                        $this->messages->flash('Email has been sent');
                    $this->email->clear();
                    redirect('admin/order/details/'.$orderid);
                    
    }
    public function email($orderid='')
    {
        $allemialAddress = array();
        $emaildata=$this->orders->getEcoEmail(array("O.id"=>$orderid));
        $allemialAddress[] = $emaildata->email_Id;
        $allemialAddress[] = $emaildata->pmemail;
        $allemialAddress[] = $emaildata->salesemail;
        $resourceemail=$this->orders->getAllEmail(array("O.id"=>$orderid));
        foreach ($resourceemail as $key => $value) {
            $allemialAddress[] = $value->resourceemail;

        }
        //sending email
        foreach($resourceemail as $emailAddress)
        {
            
        }
        echo "%%<pre>";print_r($allemialAddress);die;
    }
}

