<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contract_accept extends ITFS_Public_Controller {

    public function __construct() {
        $this->load->helper('form', 'url');
        $this->load->library(array('form_validation', 'pagination'));
        $this->load->model('contract_accepts');
        $this->load->model('contract/contracts');
        $this->load->model('order/orders');
        $this->load->model('diagnose/diagnoses');
        $this->load->model('design/designs');
        $this->load->model('delivery/deliveries');
        $this->load->model('discovery/discoveries');
        $this->load->model('product/products');
        $this->load->model('document/documents');
        $this->load->model('transport/transports');
    }

    public function index($orderid = '0') {
        $data['detail'] = $this->orders->getOrderDetail(array("O.id" => $orderid));
        $data['diagonoesdetail'] = $this->diagnoses->getDiagonoesDetail($orderid);
        $data['getdesigndetail'] = $this->designs->getdesignDetail($orderid);
        $data['getdeliverydetail'] = $this->deliveries->getdeliveryDetail($orderid);
        $data['getdiscoveryDetail'] = $this->discoveries->getdiscoveryDetail($orderid);
        $data['get_diagnose'] = $this->contracts->get_diagnose($orderid);
        $data['get_design'] = $this->contracts->get_design($orderid);
        $data['get_delivey'] = $this->contracts->get_delivey($orderid);
        $data['get_discovery'] = $this->contracts->get_discovery($orderid);
        //echo "%%%%%%%%%%%<pre>";print_r($data);die;
        $this->template->set_layout('contract_layout');
        $this->template->build('contractAccept', array("frmdata" => $data));
    }
    
    //generate pdf for contract
    public function printPdfIndex($orderid = '0') {
        $this->load->library("IMpdf","impdf");
        $data['detail'] = $this->orders->getOrderDetail(array("O.id" => $orderid));
        $data['diagonoesdetail'] = $this->diagnoses->getDiagonoesDetail($orderid);
        $data['getdesigndetail'] = $this->designs->getdesignDetail($orderid);
        $data['getdeliverydetail'] = $this->deliveries->getdeliveryDetail($orderid);
        $data['getdiscoveryDetail'] = $this->discoveries->getdiscoveryDetail($orderid);
        $data['get_diagnose'] = $this->contracts->get_diagnose($orderid);
        $data['get_design'] = $this->contracts->get_design($orderid);
        $data['get_delivey'] = $this->contracts->get_delivey($orderid);
        $data['get_discovery'] = $this->contracts->get_discovery($orderid);
        //echo "%%%%%%%%%%%<pre>";print_r($data);die;
        
        $datainfo= $this->load->view("contractAccept_print",array('frmdata'=>$data),true);
        echo $datainfo;die;
        //echo "<pre>";print_r($datainfo);die;
        //$datainfo="<html><body><h1>Rahul</h1></body></html>";
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $mpdf->impdf->debug = true;
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH."upload/resourcepdf/contract".time()."_".$orderid.".pdf";
        $this->impdf->mpdf->Output($fullpath);
        
        
        //$this->template->set_layout('contract_layout');
        //$this->template->build('contractAccept', array("frmdata" => $data));
    }

    public function sendnotification(){
        $this->load->library('email');
        $allrequest = $this->input->post();
        $this->email->to('kanika@maynardleigh.in');                
        $this->email->from('info@maynardleighonline.in');
        $this->email->set_mailtype("html");
        $maildata = $this->mails->getMailById(27);
        $information = array('ORDER_ID'=> $allrequest['order_id'],
                            'CLIENT_NAME'=>$allrequest['client_name'],
                            'LOCATION'=>$allrequest['client_location']
                        );
        $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
        $bodymessage = $this->messages->mailTemplate($datainfo);
        $this->email->subject($maildata->mailsubject);
        $this->email->message($bodymessage);
        //echo "<pre>";print_r($this->email);die;
        //$this->email->send();
        $this->email->clear();
        
        //Generate PDF for print
        
        
        $data['detail'] = $this->orders->getOrderDetail(array("O.id" => $allrequest['order_id']));
        $data['diagonoesdetail'] = $this->diagnoses->getDiagonoesDetail($allrequest['order_id']);
        $data['getdesigndetail'] = $this->designs->getdesignDetail($allrequest['order_id']);
        $data['getdeliverydetail'] = $this->deliveries->getdeliveryDetail($allrequest['order_id']);
        $data['getdiscoveryDetail'] = $this->discoveries->getdiscoveryDetail($allrequest['order_id']);
        $data['get_diagnose'] = $this->contracts->get_diagnose($allrequest['order_id']);
        $data['get_design'] = $this->contracts->get_design($allrequest['order_id']);
        $data['get_delivey'] = $this->contracts->get_delivey($allrequest['order_id']);
        $data['get_discovery'] = $this->contracts->get_discovery($allrequest['order_id']);
        
        
        
        //echo "<pre>";print_r($data);die;
        $datainfo = $this->load->view("contractAcceptPrint", array('frmdata'=>$data), true);
        //echo "<pre>";print_r($datainfo);die;
        //echo $datainfo;die;
        //$html = '';
        $this->load->library("IMpdf", "impdf");
        $this->impdf->mpdf->SetTitle("Maynardleigh Associates. - Contract");
        $this->impdf->mpdf->SetAuthor("Maynardleigh Associates.");
        $this->impdf->mpdf->setAutoTopMargin = 'stretch';
        //$this->impdf->mpdf->setAutoTopMargin=600;
        
        $this->impdf->mpdf->SetHTMLHeader('<table style="background-color:#ffffff; margin:0 auto;" width="75%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td style="padding:20px 0px 15px 0px; margin-top: 25px;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td valign="bottom" align="left">
                                        <a target="#" title="Maynardleigh Online"><img style="margin-bottom: 40px; height: 160px;" src="http://sixer.maynardleighonline.in/assests/img/default.png"></a>

                                    </td>
                                    <td style="padding: 10px; position: relative;" align="center">
                                        <p style="font-size: 16px; margin: 0; position: absolute;top: 0; left: 55%;"></p>

                                    </td>

                                    <td width="100px" valign="bottom" align="left"></td>


                                    <td width="400px" valign="bottom" align="right">
                                        <a target="#" title="Maynardleigh Online"><img style="margin-bottom: 40px; height: 160px;" src="http://sixer.maynardleighonline.in/assests/img/may.png"></a>


                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>');
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH."upload/resourcepdf/SIXRES".time().".pdf";
        $urlPath = site_url()."assests/itf_public/upload/resourcepdf/SIXRES".time().".pdf";
        $this->impdf->mpdf->Output($fullpath);
        
        
        echo json_encode(array('response'=>'success','filepath'=>$urlPath));
    }
    public function accept($orderid = '0') {
        $allemialAddress = array();
        $emaildata = $this->orders->getEcoEmail(array("O.id" => $orderid));
        $allemialAddress[] = $emaildata->email_Id;
        $allemialAddress[] = $emaildata->pmemail;
        $allemialAddress[] = $emaildata->salesemail;
        $resourceemail = $this->orders->getAllEmail(array("O.id" => $orderid));
        foreach ($resourceemail as $key => $value) {
            $allemialAddress[] = $value->resourceemail;
        }
        $where['id'] = $orderid;
        $data = array(
            'status' => 1
        );
        $this->orders->addOrder($data, $where);
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
            $information = array('name' => 'Maynardleigh Member');
            $datainfo = $this->messages->mailData($information, $maildata->mailbody);
            $bodymessage = $this->messages->mailTemplate($datainfo);
            $this->email->subject($maildata->mailsubject);
            $this->email->message($bodymessage);
            //echo "<pre>";print_r($this->email);die;
            $this->email->send();
            $this->email->clear();
        }
        $redirctURL = base_url() . 'contract_accept/index/' . $orderid;
        redirect($redirctURL);
    }

    

    //send email for leadership report
    public function sendmailforleadership() {
        $allFiles = date('Y-m-d');
        $allFilesStart = date('Y-m-d 00:00:00');
        $allFilesEnd = date('Y-m-d 23:59:59');
        $this->load->model('contract_accepts');
        $this->load->model('welcome/welcomes');

        $starttime = strtotime($allFilesStart);
        $endtime = strtotime($allFilesEnd);
        $allInformation = $this->contract_accepts->getTodayLeadershipListForSend($starttime, $endtime);
        foreach ($allInformation as $information) {
            $allMoreInformation = array();
            $allMoreInformation = (array) $this->welcomes->getMoreDataForResource($information->order_id, $information->order_type, $information->diagnose_id);
            $this->load->library('email');
            $this->email->to($information->email);
            $this->email->from('info@maynardleighonline.in ');
            $this->email->set_mailtype("html");
            $maildata = $this->mails->getMailById(24);
            $link = site_url('user/resource_login');
            if (date("jS F, Y", $information->tstartdatetime) == date("jS F, Y", $information->tenddatetime)) {
                $datevalue = date("jS F, Y", $information->tstartdatetime);
            } else {
                $datevalue = date("jS F, Y", $information->tstartdatetime) . "-" . date("jS F, Y", $information->tenddatetime);
            }

            $information = array('name' => $information->name, 
                'client' => $information->clientname . "(".$allMoreInformation['showorderid'].")",
                'job' => $allMoreInformation['name'], 
                'subproduct' => $allMoreInformation['subname'], 
                'location' => $allMoreInformation['location'],
                'date' => $datevalue,
                //'time' => date("h:i:s A", $information->start_time) . "-" . date("h:i:s A", $information->end_date),
                'link' => $link);
            $datainfo = $this->messages->mailData($information, $maildata->mailbody);
            $bodymessage = $this->messages->mailTemplate($datainfo);
            $this->email->subject($maildata->mailsubject);
            $this->email->message($bodymessage);
            //echo "<pre>";print_r($this->email);die;
            $this->email->send();
            $this->email->clear();
            $this->messages->flash('Email has been sent!');
            //redirect('welcome/mydates');
        }
        die ("Email Sent");
    }

}
