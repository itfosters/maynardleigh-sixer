<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class Usercall_accept extends ITFS_Public_Controller 
{
    public function __construct() 
    {
        $this->load->helper('form','url');
        $this->load->library(array('form_validation','pagination'));
        $this->load->model('usercall_accepts');
        $this->load->model('contract/contracts');
        $this->load->model('order/orders');
        $this->load->model('delivery/deliveries');
    }
    public function index($oid='0',$did=0,$user_id=0) 
    {
           $data['oid'] = $oid;
           $data['did'] = $did;
           $data['user_id'] = $user_id;
           
           //now get confirmed session time slot by user
           $currenttimeslotId = $this->deliveries->getConfirmedSessionTimeByDeliveryIDUserId($user_id,$did);
           //$alltimeslotId = $this->deliveries->getConfirmedSessionTimeByOrderIdDeliveryId($oid,$did);
           $alltimeslotId = single_array($this->deliveries->getConfirmedSessionTimeByOrderIdDeliveryId($oid,$did),'id','id');
           //echo "<pre>";print_r($alltimeslotId);die;
           //now get all confirmed session
           
           
           //echo "<pre>";print_r($currenttimeslotId);die;
           if(isset($currenttimeslotId['time_slot_id']))
               $data['selectedtimeslot'] = $currenttimeslotId['time_slot_id'];
           if(count($alltimeslotId)>0){
               $data['allid'] = $alltimeslotId;
           }
           $data['timeassign'] = $this->deliveries->getAllTimeSlotsByResouceIdDiagnoseId($oid,$did);
           /*echo "<pre>";print_r($currenttimeslotId);
           echo "<hr>";
           echo "<pre>";print_r($alltimeslotId);
           */
           //echo "<pre>";print_r($data);die;
           $this->template->set_layout('contract_layout');
           $this->template->build('usercallAccept', array("frmdata"=>$data));   
    }
    public function accept($timeslotid='0',$userId=0)
    {
        $data = array('time_slot_id'=>$timeslotid,'user_id'=>$userId);
        $this->deliveries->saveUserTimeSlotMap($data);
        echo "<h3><center>Thank you so much for your time your time slot block has been confirm.</center></h3>";
        echo "<h4><center>Close this windows/tab.</center></h4>";
        die;
        $redirctURL = base_url().'usercallAccept/index/'.$orderid;
        redirect($redirctURL);

    }
    public function reject($orderid='0')
    {
        $allemialAddress = array();
        $emaildata=$this->orders->getEcoEmail(array("O.id"=>$orderid));
        $allemialAddress[] = $emaildata->email_Id;
        $allemialAddress[] = $emaildata->pmemail;
        $allemialAddress[] = $emaildata->salesemail;
        $resourceemail=$this->orders->getAllEmail(array("O.id"=>$orderid));
        foreach ($resourceemail as $key => $value) 
        {
            $allemialAddress[] = $value->resourceemail;
        }       
        $where['id']=$orderid;
        $data=array(
                'comment'=>$this->input->post('comment'),
                'status'=>2
                );
        $this->orders->addOrder($data,$where);
        $this->load->library('email');
        foreach ($allemialAddress as $key => $toEmailAddress) 
        {
            $this->email->to($toEmailAddress);                
            $this->email->from('info@maynardleighonline.in');
            $this->email->set_mailtype("html");
            $maildata = $this->mails->getMailById(21);
            //$information = array('name'=>$emaildata->first_name);
            $information = array('name'=>'Maynardleigh Member');
            $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
            $bodymessage = $this->messages->mailTemplate($datainfo);
            $this->email->subject($maildata->mailsubject);
            $this->email->message($bodymessage);
            //echo "<pre>";print_r($this->email);die;
            $this->email->send();
            $this->email->clear();
        }
        $redirctURL = base_url().'contract_accept/index/'.$orderid;
        redirect($redirctURL);
    }
    
}