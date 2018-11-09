<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends ITFS_Front_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('welcomes');    
        $this->load->model('order/orders');    
        $this->load->model('document/documents');    
        $this->load->model('transport/transports');    
        $this->load->model('diagnose/diagnoses');    
        $this->load->model('design/designs');    
        $this->load->model('delivery/deliveries');    
        $this->load->model('discovery/discoveries');
        $this->load->library('pagination');    
        $this->load->model('user/users');    
    }

    function index() 
    {
         $this->template->build('index');
    }
    public function deleteRequest($id=''){
        $this->welcomes->deleteRequest($id);
        $this->messages->flash('Leave Request Delete successfully.', 'success');
        redirect("welcome/accept_Request");
    }
    public function accept_Request()
    { 
        if ($this->input->post()){
            $datainfo = explode(" ",$this->input->post("daterange"));
            $tstartdatetime = strtotime($datainfo[0] . ' ' . $datainfo[1] . " " . $datainfo[2]);
            $tenddatetime = strtotime($datainfo[4] . ' ' . $datainfo[5] . " " . $datainfo[6]);
            $postdata = $this->input->post();
            //echo "<pre>";print_r($postdata['manager_id']);die;
            $i=0;
            if(isset($postdata['manager_id']) && count($postdata['manager_id'])>0){
                foreach($postdata['manager_id'] as $mnid){
                    $Acpdata=array(
                        "recource_id"=>$mnid,
                        "leave_reason"=>$this->input->post('leave_reason'),
                        "tstartdatetime" => $tstartdatetime,
                        "tenddatetime" => $tenddatetime,
                        "leave_title"=>$this->input->post('leave_title')
                    );
                    if(!$this->welcomes->IsLeaveRequest($Acpdata) > 0){
                        $this->welcomes->saveLeaveRequest($Acpdata);
                    }
                    // code for Email //
                    $this->load->library('email');
                    
                    //echo $link;die;
                    $userInfo = $this->welcomes->getOtherUserDetails($mnid);
					$users = $this->welcomes->getOtherUserDetails($this->auth->getUserId());
                    $leave_reason = $this->welcomes->getLeaveReasonText($Acpdata['leave_reason'])->reason;
                    //print '####<pre>'; print_r($leave_reason);print_r($userInfo); die;
//                    $this->email->to($A$userInfollemailInComma);
                    $this->email->to($userInfo->email);
                    $this->email->from('info@maynardleighonline.in');
                    $this->email->set_mailtype("html");
                    $maildata = $this->mails->getMailById(28);
                    ///{NAME}{TITLE}"({LEAVETYPE}) from {DATERENGE} {LINK}
                    $information = array('name' => $userInfo->name,'user'=>$users->name, 'title' => ucfirst($Acpdata['leave_title']),
                        'leavetype' => $leave_reason,
                        'daterenge' => $this->input->post("daterange") );
                    //print "####<pre>"; print_r($information); die;
                    $datainfo = $this->messages->mailData($information, $maildata->mailbody);
                    $bodymessage = $this->messages->mailTemplate($datainfo);
                    $this->email->subject($maildata->mailsubject);
                    $this->email->message($bodymessage);
                    $this->email->send();
                    $this->email->clear();
                    
                }
            }
            $Acpdata=array(
                "recource_id"=>$this->auth->getUserId(),
                "leave_reason"=>$this->input->post('leave_reason'),
                "tstartdatetime" => $tstartdatetime,
                "tenddatetime" => $tenddatetime,
                "leave_title"=>$this->input->post('leave_title')
            );
            //echo '@@@@<pre>';print_r($Acpdata);die;
            if($this->welcomes->IsLeaveRequest($Acpdata) > 0){
                $this->messages->flash('Request have already process for the day', 'error');
            }else{
                $results=$this->welcomes->saveLeaveRequest($Acpdata);
                redirect("welcome/accept_Request");
            }             
        }
        $data['property']=single_array($this->users->calender(),'id','name','Select Resource');
        //print_r($this->welcome->getAllLeaveReasons()); 
        $data['reasonsData'] =single_array($this->welcomes->getAllLeaveReasons(),'id','reason','Select Reason');
        $this->template->headingtitle="My Calender";
        $this->template->set_breadcrumb("My Calender","");
        
        $this->template->build('accept_request',array('frmdata'=>$data));

    }
    public function assignAllDate(){
        $allrequest =  $this->input->post();;
        $date=$allrequest['start'];
	$userid=$this->auth->getUserId();
	$resultsRequest = array();
        if(isset($allrequest['tentative']) && $allrequest['tentative']==1 ){
            $d = date_parse_from_format("Y-m-d", $date);
            
            $resultsRequest=$this->welcomes->getLeaveRequest($userid);
             //print '<pre>'; print_r($resultsRequest[4]->start); print '-----------------------------------------------------';
            foreach($resultsRequest as $key=> $data){                
                //$resultsRequest[$key]->leave_title=$resultsRequest[$key]->leave_title.($resultsRequest[$key]->leave_title!="")?"<span class='pull-right'>".$resultsRequest[$key]->leave_title."</span>":"";
                //print '<pre>'; print_r($data->leave_title);die;
                $resultsRequest[$key]->leave_title=$resultsRequest[$key]->leave_title!=""?$resultsRequest[$key]->leave_title:"";
                if($resultsRequest[$key]->leave_title!="")
                    //$resultsRequest[$key]->title = $resultsRequest[$key]->title.$resultsRequest[$key]->leave_title;
                $data->id=$data->diagnose_id ;   
                $data->start=date("Y-m-d", strtotime($data->start.'-1 day'));
                $data->title = $data->leave_title;
            }
            //print_r($resultsRequest); die;
            //<span class="pull-right">title</span>
             //foreach($resultsRequest as $key=> &$data) {
                 //$resultsRequest[$key]['time_duration']=date("H:j:A", strtotime($data->tstartdatetime." +1 day"))."-".date("H:j:A", strtotime($data->tenddatetime." +1 day"));
           // } 
            //die;
            ////tstartdatetime,T1.tenddatetime tenddatetime
            //print_r($resultsRequest);die();
            //sum($resultsRequest,array("title"=>"Leave Request"));
        }//else{
            $results=$this->welcomes->getAssignDate($userid);
            //echo "##<pre>";print_r($results);die;
           foreach($results as &$data)
            {
                $allInfo = $this->welcomes->getDiagnosePopUpDetails($data->diagnose_id,$data->order_type);
                //echo "<pre>1234";print_r($allInfo);die;
                //$data->title="Assign".$data->start_time."-".$data->end_time;
                $data->title=(isset($allInfo->sproducts) && !empty($allInfo->sproducts))?$allInfo->sproducts:'N/A';
                $data->end=date("Y-m-d", strtotime($data->end." +1 day"));
                $data->className='eventColor'.$data->status;
           // }
        }
		foreach($resultsRequest as &$data){
                $data->start=date("Y-m-d", strtotime($data->start." +1 day"));
            }
        $results=array_merge($resultsRequest,$results);
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($results));
    }
    public function acceptrequest()
    { 
        $where['id']=$this->input->post('diagnose_id');
        $data=array(
                'manager_id'=>$this->auth->getUserId(),
                'status'=>1
                );
            //echo "<pre>";print_r($data);die;
        $this->welcomes->statusChange($data,$where);
        redirect('welcome/accept_request');
        
    }

    //my info
    public function myinfo()
    { //die('mmmmm');
        $userid=$this->auth->getUserId();
        $usertype=$this->welcomes->getUserType($userid);
        //load model user
       if($usertype->user_type=='CM'){
        $this->load->model('diagnose/diagnoses','diagnoses');
        $data=array();
        
        //echo "<pre>";print_r($usertype);die;
        $data['allairlines']=single_array($this->diagnoses->getTravel(),'id','name');
       //echo "<pre>1234";print_r($data['allairlines']);die;
        $alldata = $this->input->post();
       // echo "<pre>1234";print_r($alldata);die;
        if($this->input->post()){
            //condition for after form submit  
            
            $allRequest = $this->input->post();
            //echo "<pre>1234";print_r($allRequest);die;
            
            //now getting current user id
             $inserData = array();
             $inserData['userid']=$userid;
             $inserData['user_current_location']=$allRequest['userlocation'];
             $inserData['preferred_airlience']=$allRequest['preferedairlience'];
             $inserData['food']=$allRequest['food'];

             //echo "<pre>1234";print_r($inserData);die;
             $updateFlage=0;
             $this->messages->flash("Your information have been succesfully saved.","success");
             $where = array();
             $data['myinfos']= $this->users->getMyInfo($userid);
             if(count($data['myinfos'])>0){
                $updateFlage=1;
                $this->messages->flash("Your information have been succesfully updated.","success");
                $where['userid']=$userid;
             }
                
             $this->users->saveMyInfo($inserData,$where,$updateFlage);
             //now saving informaton for membership
             $savemembershipdata = array();
             foreach($alldata['member_name'] as $mkey=>$membershipdetail){
                $savemembershipdata['user_id'] =  $this->users->getMyInfo($userid)->userid;
                $savemembershipdata['name'] = $membershipdetail;
                $savemembershipdata['detail'] =  $alldata['member_details'][$mkey];
                //$this->users->saveMembershipInfo($savemembershipdata,$where,$updateFlage);
                //echo "<pre>";print_r($savemembershipdata);die;
                if(!empty($savemembershipdata['name']))
                    $this->users->saveMembershipInfo($savemembershipdata);

             }
             redirect('welcome/myinfo');
        }else{
            $data['itfall']= $this->users->getMemberDetails($userid);
        }
              //echo "<pre>1234";print_r($data);die;
        //}
         $data['itfall1']= $this->users->getMyInfo($userid);
        //echo "<pre>";print_r($usertype->user_type);die;
         
        //Condition for without submit
          $this->template->headingtitle="My Information";
          $this->template->set_breadcrumb("My Information","");
          
            $this->template->build('myinfo',array('frmdata'=>$data));
        }
        else if($usertype->user_type=='N')
        {



            $this->load->model('diagnose/diagnoses','diagnoses');
            $data=array();
        
        //echo "<pre>";print_r($usertype);die;
        //$data['allairlines']=single_array($this->diagnoses->getTravel(),'id','name');
       //echo "<pre>1234";print_r($data['allairlines']);die;
        //$alldata = $this->input->post();
       // echo "<pre>1234";print_r($alldata);die;
        if($this->input->post()){
            //condition for after form submit  
            
            $allRequest = $this->input->post();
            //echo "<pre>1234";print_r($allRequest['email']);die;
            
            //now getting current user id
             $inserData = array();
             $inserData['name']=$allRequest['name'];
             $inserData['age']=$allRequest['age'];
             $inserData['department']=$allRequest['department'];
             $inserData['designation']=$allRequest['designation'];
             $inserData['reporting_to']=$allRequest['reporting_to'];
             $inserData['area_of_responsibility']=$allRequest['area_of_responsibility'];
             $inserData['yrs_at_ey']=$allRequest['yrs_at_ey'];
             $inserData['total_experience']=$allRequest['total_experience'];
             $inserData['qualification']=$allRequest['qualification'];
             $inserData['training_attended_in_the_past']=$allRequest['training_attended_in_the_past'];
             $inserData['previous_employer']=$allRequest['previous_employer'];
             $inserData['email']=$allRequest['email'];
             $inserData['contact_no']=$allRequest['contact_no'];

             //echo "<pre>1234";print_r($inserData);die;
             $info=$this->users->saveParticepantMyInfo($inserData);
        }else{
            $data['participantlist']= $this->users->getParticepantMyInfo($userid);
            //echo "<pre>";print_r($data);die;
        }
         //$data['itfall1']= $this->users->getParticepantMyInfo($userid);
        //Condition for without submit
          $this->template->headingtitle="My Information";
          $this->template->set_breadcrumb("My Information","");
          $this->template->build('myinfouser',array('frmdata'=>$data));
        }
    














    }

    //Condition for delete membershipdetails..
    public function deletemembership($id)

    {//die($id);
        $del=$this->users->memberDelete($id);
        if($del)
            $this->messages->flash('Data has been deleted');
        redirect('welcome/myinfo');
    }

    
    public function rejected()
    {
        $id=$this->auth->getUserId();

        if (!empty($this->input->post('diagnose_id'))) 
        {

            $data=@array(
                'manager_id'=>$id,

                'id'=>$this->input->post('diagnose_id'),
                'comment'=>$this->input->post('comment'),
                'status'=>2);

            $this->welcomes->updateReject($data);
        }
        
        redirect('welcome/accept_request');

        
    }
    
    public function getFullDetailByDiagnoseId($id=0,$status=0,$mainid=0,$ordertype=0)
    {
        //die('dfdff');
        if($ordertype==7){
            $data['view']=(array)$this->welcomes->getLeavesPopUpDetails($id);
            @$data['view']['time_duration']=@isset($data['view']['tstartdatetime'])?date("H:i A", ($data['view']['tstartdatetime']." +1 day"))."-".date("h:i A", ($data['view']['tenddatetime']." +1 day")):"";
            $this->template->set_layout('ajax');
            $this->template->build('leaveRequest',$data);
        }else{
            $data['view']=(array)$this->welcomes->getDiagnosePopUpDetails($id,$ordertype);
            $data['casting_id']=$this->auth->getUserId();
            $data['status']=$status;
            $data['mainid']=$mainid;
            $this->template->set_layout('ajax');
            $this->template->build('diagnose_detail',$data);
        }
    }
    public function mydates()
    {
        //$ordertype=2;
        $where['casting_id']=$this->auth->getUserId();
        //echo "<pre>";print_r($where);die;
        $data['view']=(array)$this->welcomes->getAssignDateDetails($where);
        //now getting inner datas
        foreach($data['view'] as $key=>$record){
            $date = $this->welcomes->checkDeliveryDates($record->order_id);
            $record->date = $date;
            $current_result = (array)$this->welcomes->getMoreInfoForResource($record->diagnose_id,$record->order_type);
            $record->moreinfo=$current_result;
        }
        $this->template->headingtitle="My booking dates";
        $this->template->set_breadcrumb("My Dates",site_url("welcome/mydates"));
       // $this->template->set_breadcrumb("DELIVERY LISTING",site_url("admin/delivery/index/".$oid));
        $this->template->set_breadcrumb("Booking dates ","");
        $this->template->build('mydates',array("itfdata"=>$data));
    }
    public function details($orderid = "") {

        //die($orderid);
        $data['userid'] = $this->auth->getUserId();
        $data['user_type']=$this->auth->getUserType();
        // echo $userid;die;
        $alldocuments = single_array($this->documents->getDocumentsName(), 'id', 'document_name');
        $data['document'] = $alldocuments;
        $alltransports = single_array($this->transports->getTransportsName(), 'id', 'trans_name');
        $data['transports'] = $alltransports;
        $data["dtdoc"] = single_array($this->orders->getDocById($orderid), 'document_id', 'file_name');
        $data["dttrans"] = single_array($this->orders->getTransById($orderid), 'transport_id', 'value');
        $data['detail'] = $this->orders->getOrderDetail(array("O.id" => $orderid));
        $data['diagonoesdetail'] = $this->diagnoses->getDiagonoesDetail($orderid);
        $data['diagonoesresources'] = $this->diagnoses->getDiagonoesResources($orderid);
        $data['getdesigndetail'] = $this->designs->getdesignDetail($orderid);
        $data['getdesignresources'] = $this->designs->getDesignResources($orderid);
        $data['getdeliverydetail'] = $this->deliveries->getdeliveryDetail($orderid);
        foreach ($data['getdeliverydetail'] as $key => &$value) {
            $value->deliverdproduct = single_array($this->deliveries->getdeliveredProduct($value->id), 'id', 'name');
        }
        $data['getdeliveryresources'] = $this->deliveries->getDeliveryResources($orderid);
        $data['getdiscoverydetail'] = $this->discoveries->getdiscoveryDetail($orderid);
        $data['getdiscoveryresources'] = $this->discoveries->getDiscoveryResources($orderid);


        //echo "<pre>dfg";print_r($data);die;
        $this->template->headingtitle = "Order Details";
        $this->template->set_breadcrumb("My Dates", site_url('welcome/mydates'));
        $this->template->set_breadcrumb("View Details", "");
        $this->template->build('order_details', array("frmdata" => $data));
    }
    public function generateURL($id) {
        //echo "<pre>1234";print_r($id."ddd");die;
        //get client_name
        $result = $this->welcomes->getClientName($id);
        $name =  $result->name;
        $finalname = str_replace(array('.',',',' ','  '), array('','','_','_'),$name);
        if(strlen($finalname)>5){
                $finalname = substr($finalname,0,5);
        }
        $finalurl = site_url().'engagement/index/'.$finalname."/".$id;
        $data['url_value'] = $finalurl;
        $this->load->model('engagement/engagements');
        $result = $this->engagements->getEngagementByAssignId($id);
        //echo "<pre>";print_r($result);die;
        $data['alldata']=$result;
        $this->template->headingtitle="My URL an Feedback";
        $this->template->set_breadcrumb("My Dates",site_url("welcome/mydates"));
        $this->template->set_breadcrumb("My Feedback URL","");
        $this->template->build('myurl',array("itfdata"=>$data));
    }
    public function leaverequest(){
        
        $data['property']=single_array($this->users->calender(),'id','name','Select Resource');
        //print_r($this->welcome->getAllLeaveReasons());
        $data['reasonsData'] =single_array($this->welcomes->getAllLeaveReasons(),'id','reason','Select Reason');
        $this->template->set_layout("ajax");
        $this->template->build('resource_leave_request',array("frmdata"=>$data));
    }
  
}