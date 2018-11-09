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
        $this->load->model('diagnose/diagnoses');
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
    public function accept($order_id,$timeslotid='0',$userId=0,$deliveryId)
    {
        $data = array('time_slot_id'=>$timeslotid,'user_id'=>$userId);
        $this->deliveries->saveUserTimeSlotMap($data);
        $this->messages->flash("Thank you so much for your time confirmation.", "success");
        //echo "<h3><center>Thank you so much for your time your time slot block has been confirm.</center></h3>";
        //echo "<h4><center>Close this windows/tab.</center></h4>";
        //die;
        $redirctURL = base_url().'usercall_accept/index/'.$order_id."/".$deliveryId."/".$userId;
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
    
    //accept Time by assing user
    public function acceptbyresource($assignTimeId)
    {
        $assignTimeId = base64_decode($assignTimeId);
        $this->load->model('welcome/welcomes');
        //checking already accepted
        $status = $this->welcomes->getStatusOfAssingTimeById($assignTimeId);
        if(isset($status->status) && ($status->status==1)){
            ?>
                <html>
            <head>
            <script>
            function loaded()
            {
                alert("Sorry !!! You have already accepted.");
                window.setTimeout(CloseMe, 500);
            }

            function CloseMe() 
            {
                window.close();
            }
            </script>
            </head>
            <body onLoad="loaded()"><center>
            Sorry !!! You have already accepted.
            <input type="button" value="Close this window" onclick="self.close()">
            </center>
            </body>
            </html>
            <?php
        }
        else if(isset($status->status) && ($status->status==2)){
            ?>
                <html>
            <head>
            <script>
            function loaded()
            {
                alert("Sorry !!! You have already rejected.");
                window.setTimeout(CloseMe, 500);
            }

            function CloseMe() 
            {
                window.close();
            }
            </script>
            </head>
            <body onLoad="loaded()"><center>
            Sorry !!! You have already rejected.
            <input type="button" value="Close this window" onclick="self.close()">
            </center>
            </body>
            </html>
            <?php
        }
        else{
            $acceptArray = array('status'=>1);
            $whereAcrray = array('id'=>$assignTimeId);
            $this->welcomes->statusChange($acceptArray,$whereAcrray);
            
            //sending email to user for confirmation and sending document in email
            $this->load->library('email');
            $orderdetial = $this->welcomes->getOrderIdByAssignId($assignTimeId);
            //echo "<pre>12345";print_r($orderdetial);die;
            $allEmail = $this->orders->getSellerUserEmail($orderdetial['order_id']);
            $AllemailInComma = implode(",", $allEmail);
            
            
            //$this->email->to($AllemailInComma);
            $AllemailInComma = $orderdetial['email'] . "," . $AllemailInComma;
            //get email address and name of resource
            $AllInfoOfUser = $this->users->getUsersInfoById($orderdetial["manager_id"]);
            $this->email->to($AllInfoOfUser->email);
            $this->email->from('info@maynardleighonline.in');
            $this->email->set_mailtype("html");
            $maildata = $this->mails->getMailById(35);
            $link = site_url('user/resource_login');
            
            $startdttime = $orderdetial['tstartdatetime'];
            $enddttime = $orderdetial['tenddatetime'];
            
            
            if (date("jS F, Y", $startdttime) == date("jS F, Y", $enddttime)) {
                $datevalue = date("jS F, Y", $startdttime);
            } else {
                $datevalue = date("jS F, Y", $startdttime) . "-" . date("jS F, Y", $enddttime);
            }
            
            //get all information
            $where['order_type'] = $orderdetial['order_type'] ;
            $postalldata = (array)$this->diagnoses->getResourcesAssignDetails($orderdetial['diagnose_id'], $where);
            $information = array('name' => $AllInfoOfUser->name, 'client' => $postalldata['clientname'], 'job' => $postalldata['proname'], 'subproduct' => $postalldata['name'], 'location' => $postalldata['location'],
                'date' => $datevalue,
                'time' => date("h:i:s A", $startdttime) . "-" . date("h:i:s A", $enddttime),
                'link' => $link);
            
            
            
            
            
            $datainfo = $this->messages->mailData($information, $maildata->mailbody);
            //getting all document
            $allDocument = $this->orders->getDocById($orderdetial['order_id']);
            $documentLinks = "<br/><br/><div><div>Related Document(s)</div>";
            $pathfordocument = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/assests/itf_public/documents/";
            if(count($allDocument)>0){
                foreach($allDocument as $documentObj){
                    $documentLinks.= "<div><a href='".$pathfordocument.$documentObj->file_name."'>".$documentObj->file_name."</a></div>";
                }
               $documentLinks = $documentLinks."</div>"; 
            }else{
                $documentLinks = $documentLinks." N/A</div>";
            }
            $documentLinks.= "<br/>";
            //echo "<pre>";print_r($documentLinks);die;
            $datainfo .= $documentLinks;
            
            $bodymessage = $this->messages->mailTemplate($datainfo);
            $this->email->subject($maildata->mailsubject);
            $this->email->message($bodymessage);
            //echo "<pre>";print_r($this->email);die;
            $this->email->send();
            $this->email->clear();
            
            
            ?>
            <html>
            <head>
            <script>
            function loaded()
            {
                alert("Great !!! You have successfully accepted your date(s).");
                window.setTimeout(CloseMe, 500);
            }

            function CloseMe() 
            {
                window.close();
            }
            </script>
            </head>
            <body onLoad="loaded()"><center>
            Great !!! You have successfully accepted your date(s).
            <input type="button" value="Close this window" onclick="self.close()">
            </center>
            </body>
            </html>
        <?php
        }//else close
    }
    //Reject Time by assing user
    public function rejectbyresource($assignTimeId)
    {
        $assignTimeId = base64_decode($assignTimeId);
        $this->load->model('welcome/welcomes');
        //checking already accepted
        $status = $this->welcomes->getStatusOfAssingTimeById($assignTimeId);
        if(isset($status->status) && ($status->status==1)){
            ?>
            <html>
            <head>
            <script>
            function loaded()
            {
                alert("Sorry !!! You have already accepted.");
                window.setTimeout(CloseMe, 500);
            }

            function CloseMe() 
            {
                window.close();
            }
            </script>
            </head>
            <body onLoad="loaded()"><center>
            Sorry !!! You have already accepted.
            <input type="button" value="Close this window" onclick="self.close()">
            </center>
            </body>
            </html>
            <?php
        }
        else if(isset($status->status) && ($status->status==2)){
            ?>
            <html>
            <head>
            <script>
            function loaded()
            {
                alert("Sorry !!! You have already rejected.");
                window.setTimeout(CloseMe, 500);
            }

            function CloseMe() 
            {
                window.close();
            }
            </script>
            </head>
            <body onLoad="loaded()"><center>
            Sorry !!! You have already rejected.
            <input type="button" value="Close this window" onclick="self.close()">
            </center>
            </body>
            </html>
            <?php
        }
        else{
            $this->template->set_layout('contract_layout');
            $data = array('assignTimeId'=>$assignTimeId);
            $this->template->build('usercallReject', array("frmdata"=>$data)); 
        }
        
        

    }
    public function saverejectcomment() {
        $allPost = $this->input->post();
        $this->load->model('welcome/welcomes');
        $acceptArray = array('comment'=>$allPost['rejectreason'],'status'=>'2');
        $whereAcrray = array('id'=>$allPost['assigntimeid']);
        $this->welcomes->statusChange($acceptArray,$whereAcrray);
        $response = array('response'=>true);
        die(json_encode($response));
    }
    
}