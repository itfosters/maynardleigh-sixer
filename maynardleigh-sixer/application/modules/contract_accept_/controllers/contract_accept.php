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
        
        $this->impdf->mpdf->list_auto_mode = 'mpdf'; 
        $this->impdf->mpdf->list_marker_offset = '0.45em'; 
        $this->impdf->mpdf->list_symbol_size = '0.31em';
        
        //$this->impdf->mpdf->setAutoTopMargin=600;
        $this->impdf->mpdf->SetHTMLHeader('<table style="background-color:#ffffff; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                
                <tr>
                    <td valign="bottom" align="left" width=50%>
                        <a target="#" title="Maynardleigh Online"><img style="margin-bottom: 0px; height: 120px;" src="http://sixer.maynardleighonline.in/assests/img/default.png"></a>

                    </td>



                    <td width="50%" valign="bottom" align="right">
                        <a target="#" title="Maynardleigh Online"><img style="height: 90px;" src="http://sixer.maynardleighonline.in/assests/img/may.png"></a>
                    </td>
                </tr>
                            
            </tbody>
        </table>');
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        
        //adding nda required document.
        if($data['detail']->nda_required=='Yes'){
          $ndacontent = '<table class="nda_required" width="75%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td class="inner_nda">
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- next part -->
            <table cellspacing="0" cellpadding="0" border="0" width="100%" class="margineauto">
                <tbody>
                    <tr>
                        <td align="left" valign="bottom" width="100%">
                            <p class="pclass1"><b>Non-Disclosure agreement:</b></p>
                            <br/>
                            <br/>
                            <p class="moreinfo"> WHEREAS, Client is willing to receive information from the service provider regarding the program, which information the Service Provider deems proprietary.</p>

                            <p>NOW, THEREFORE, in consideration of the mutual covenants and conditions herein contained, the parties hereto 

                                agree as follows:</p>

                            <br/>
                            <br/>
                            <ul><li class="moreinfo">As used in this Agreement, the term Proprietary Information shall mean written, oral, documentary or

                                    other information relating to the </li><p>&nbsp;&nbsp;&nbsp;subject matter referenced above which is received by Client from the 

                                    Service Provider. Proprietary Information includes notes, </p><p>&nbsp;&nbsp;&nbsp;extracts, analyses or materials prepared by the 

                                    Service Provider, which are copies of or derivative works of the Proprietary Information </p> <p>&nbsp;&nbsp;&nbsp;or from which the 

                                    substance of the Proprietary Information can be inferred or otherwise understood. Information shall not 

                                    be deemed </p> <p>&nbsp;&nbsp;&nbsp;Proprietary Information, and the Client shall have no obligation with respect to any such 

                                    information, which the Client can prove by </p> <p>&nbsp;&nbsp;&nbsp;written records is approved for release by written authorization 

                                    of the Service Provider.</p><br/>
                                <li class="moreinfo">The Client shall not make any copies, in whole or in part, machine readable or otherwise, of the

                                    Proprietary Information except for </li><p>&nbsp;&nbsp;&nbsp;copies to be distributed to employees  

                                    of the Client as part of the training seminar for which the Client is paying the Service Provider. </p><p>&nbsp;&nbsp;&nbsp;This is on 

                                    a need to know basis and on the basis that the Client has agreed to maintain the confidentiality of this 

                                    Proprietary </p><p>&nbsp;&nbsp;&nbsp;Information.</p><br/>
                                <li class="moreinfo">Nothing contained in this Agreement shall be construed as: (i) requiring the Service Provider to disclose

                                    to the Client any particular </li><p>&nbsp;&nbsp;&nbsp;information; (ii) granting to the Client a license, either express or implied, 

                                    under any patent, copyright, trade secret or other </p><p>&nbsp;&nbsp;&nbsp;intellectual property right, now or hereafter owned, 

                                    obtained or licensed by the Service Provider;</li><br/>
                                <li class="moreinfo">The Client will not utilise any such Proprietary Information to develop products or produce articles for its 

                                    own or another\'s use use, or <p>&nbsp;&nbsp;&nbsp;to develop products or produce articles sold or offered for sale or otherwise 

                                        transferred or offered for transfer to anyone other than the </p><p>&nbsp;&nbsp;&nbsp;Service Provider, without its written consent.</p></li>

                                <br/><li class="moreinfo">This Agreement shall be interpreted and the rights of the parties determined under the laws of the

                                    Republic of India and subject to the  <p>&nbsp;&nbsp;&nbsp;exclusive jurisdiction of the Courts of Delhi.</p></li>
                            </ul><br/>
                            <p>This Agreement supersedes any prior oral or written understandings and constitutes the entire agreement 

                                between the parties with respect to its subject matter, and no modification, amendment or waiver thereof shall be 

                                effective unless in writing and signed by both parties.</p>
                            <br/>
                            <p>Each person executing this Agreement warrants and represents that he or she has the authority to enter into this 

                                Agreement on behalf of the party whose name appears above their signature.</p>
                            <p>IN WITNESS WHEREOF, the duly authorized representatives of the parties hereto have executed this Agreement 

                                and caused it to be effective as of the date first written above.</p>
                            
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>


                        </td>
                    </tr>


                </tbody>



            </table>

            <table cellspacing="0" cellpadding="0" border="0" width="75%" class="margineauto">

                <tbody>
                    <tr>
                        <td width="400" align="left" class="lifestrategies">
                            <p class="detail">Life Strategies Humancare Pvt Ltd.
                            </p>

                            <table>
                                <tr>
                                    <Td>By</td><td>:</td><td>__________________________</td>
                                </tr>
                                <tr>
                                    <Td>Name</td><td>:</td><td> &nbsp;Steeve Gupta</td>
                                </tr>
                                <tr>
                                    <Td>Title</td><td>:</td><td>&nbsp;Director</td>
                                </tr>
                                <tr>
                                    <Td>Witness</td><td>:</td><td>__________________________</td>
                                </tr>
                            </table>
                        </td>

                        <td width="400" align="left" class="innerinformation">
                            <p class="detail">'.$data["detail"]->client_name.'</p>


                            <table>
                                <tr>
                                    <Td>By</td><td>:</td><td> __________________________</td>
                                </tr>
                                <tr>
                                    <Td>Name</td><td>:</td><td> __________________________</td>
                                </tr>
                                <tr>
                                    <Td>Title</td><td>:</td><td> __________________________</td>
                                </tr>
                                <tr>
                                    <Td>Witness</td><td>:</td><td>__________________________</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table> ';
          $this->impdf->mpdf->addPage();
          $this->impdf->mpdf->WriteHTML($ndacontent);
        }
        
        
        
        //adding account page
        $this->impdf->mpdf->addPage();
        $Footercontent = '<table cellspacing="0" cellpadding="0" border="0" width="100%" class="margineauto">
            <tbody>
                <tr>
                    <td width="100%" align="center"><p class="pclass1"><strong><u>Accounting Details</u></strong></p></td>
                </tr>
                <tr>
                    <td width="100%" align="center"><p class="pclass1"><strong></strong></p></td>
                </tr>
                <tr>
                    <td width="100%" align="center"><p class="pclass1"><strong></strong></p></td>
                </tr>
                <tr>
                    <td align="left" valign="bottom" width="100%">
                        <p class="paddingbottom"><b>Life Strategies Humancare Pvt. Ltd.</b></p><br/>


                        <p class="paddingbottom">PAN No :  AABCL5885G</p><br/>
                        <p class="paddingbottom">Service Tax Code : AABCL5885GST001</p><br/>
                        <p class="paddingbottom">Cheque in favour of "Life Strategies Humancare Pvt. Ltd."</p><br/>

                        <p class="paddingbottom">Please deliver cheques and documents to the following address :</p><br/>
                        <p class="paddingbottom">Life Strategies Humancare Pvt. Ltd.</p><br/>
                        <p class="paddingbottom">26A, Chelmsford Country Club,</p><br/>
                        <p class="paddingbottom">MG Road, Ghitorni, New Delhi 110030</p><br/>



                        <p class="paddingbottom">For Direct Transfer:</p><br/>
                        <p class="paddingbottom">Bank Name : HDFC Bank Limited., A - 24, Hauz Khas, New Delhi 110016.</p><br/>
                        <p class="paddingbottom">Bank A/c No. : 04672560000537</p><br/>

                        <p class="paddingbottom">RTGS/ NEFT : HDFC0000467</p><br/>

                </tr>


            </tbody>


        </table>


        <br>
        <br>
        
                <p><u>Please fill in below</u> </p>
                <p>Invoice to be sent to the attention of </p>
                <p>____________________________________________________________________________________________________________________________ </p>
                <p>Address:  </td>
                <p> ____________________________________________________________________________________________________________________________ </p>
                <p> ____________________________________________________________________________________________________________________________ </p>
                <p> ____________________________________________________________________________________________________________________________ </p>
                <p>Telephone: </td>
                <p> ____________________________________________________________________________________________________________________________ </p>
                <p>Accounts Fax:  </td>
                <p> ____________________________________________________________________________________________________________________________ </p>
                <p>E-mail to Accounts Payable : </td>
                <p> ____________________________________________________________________________________________________________________________ </p>
                <p>Payment Cycle Details: (If any): </td>
                <p> ____________________________________________________________________________________________________________________________ </p>';
            
        $this->impdf->mpdf->WriteHTML($Footercontent);
        
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
