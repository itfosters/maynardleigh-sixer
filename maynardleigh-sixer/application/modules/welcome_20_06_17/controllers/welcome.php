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
    
    public function accept_Request()
    { 
        if ($this->input->post()) {
            $datainfo = explode(" ",$this->input->post("daterange"));
            $tstartdatetime = strtotime($datainfo[0] . ' ' . $datainfo[1] . " " . $datainfo[2]);
            $tenddatetime = strtotime($datainfo[4] . ' ' . $datainfo[5] . " " . $datainfo[6]);
            $Acpdata=array(
                "recource_id"=>$this->auth->getUserId(),
                "leave_reason"=>$this->input->post('leave_reason'),
                "tstartdatetime" => $tstartdatetime,
                "tenddatetime" => $tenddatetime,
            );
            $results=$this->welcomes->saveLeaveRequest($Acpdata);
            redirect("welcome/accept_Request");
        }
        //print_r($this->welcome->getAllLeaveReasons()); 
        $data['reasonsData'] =single_array($this->welcomes->getAllLeaveReasons(),'id','reason','Select Reason');
        $this->template->headingtitle="My Calender";
        $this->template->set_breadcrumb("My Calender","");
        $this->template->build('accept_request',array('frmdata'=>$data));

    }
    public function assignAllDate(){
        $allrequest =  $this->input->post();;
        $date=$allrequest['start'];
        $userid = $this->auth->getUserId();
        $resultsRequest = array();
        //if(isset($allrequest['tentative']) && $allrequest['tentative']==1 ){
            $d = date_parse_from_format("Y-m-d", $date);
            //$userid=$this->auth->getUserId();

            $resultsRequest=$this->welcomes->getLeaveRequest($userid);
             //foreach($resultsRequest as $key=> &$data) {
                 //$resultsRequest[$key]['time_duration']=date("H:j:A", strtotime($data->tstartdatetime." +1 day"))."-".date("H:j:A", strtotime($data->tenddatetime." +1 day"));
           // } 
            //die;
            ////tstartdatetime,T1.tenddatetime tenddatetime
            //print_r($resultsRequest);die();
            //sum($resultsRequest,array("title"=>"Leave Request"));
        //}//else{
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
    { 

        //load model user
       
        $this->load->model('diagnose/diagnoses','diagnoses');
        $data=array();
        $userid=$this->auth->getUserId();
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
        
        //Condition for without submit
          $this->template->headingtitle="My Information";
          $this->template->set_breadcrumb("My Information","");
       $this->template->build('myinfo',array('frmdata'=>$data));
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

            $data=array(
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
        if($ordertype==7){
            $data['view']=(array)$this->welcomes->getLeavesPopUpDetails($id);
            $data['view']['time_duration']=isset($data['view']['tstartdatetime'])?date("H:i A", ($data['view']['tstartdatetime']." +1 day"))."-".date("h:i A", ($data['view']['tenddatetime']." +1 day")):"";
            //print_r($data);
            $this->template->set_layout('ajax');
            $this->template->build('leaveRequest',$data);
            
            //print_r($data);die;
        }else{
        $data['view']=(array)$this->welcomes->getDiagnosePopUpDetails($id,$ordertype);
        //$data['assigntime']=(array)$this->welcomes->getAssignTimeResource($id,$managerid);
        
        //echo "@@@<pre>";print_r($data);die;
        $data['casting_id']=$this->auth->getUserId();
        $data['status']=$status;
        $data['mainid']=$mainid;


        //
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
            $current_result = (array)$this->welcomes->getMoreInfoForResource($record->diagnose_id,$record->order_type);
            $record->moreinfo=$current_result;
        }
        $this->template->headingtitle="My booking dates";
        $this->template->set_breadcrumb("My Dates",site_url("welcome/mydates"));
       // $this->template->set_breadcrumb("DELIVERY LISTING",site_url("admin/delivery/index/".$oid));
        $this->template->set_breadcrumb("Booking dates ","");
        $this->template->build('mydates',array("itfdata"=>$data));
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
  
}