<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends ITFS_Controller {

   public function index()
	{
		$this->load->model("welcomes");
		$info=$this->welcomes->getStatistic();		
		$this->template->build('admin_index');
	}
	function mydates()
	{
		$this->load->model('welcome/welcomes');
		$datas['property']=single_array($this->users->calender(),'id','name','Select Resource');
		$datas['reasonsData'] =single_array($this->welcomes->getAllLeaveReasons(),'id','reason','Select Reason');
		//print_r($datas); die;
		//echo json_encode($details);
		$datas['headingtitle']="Calender Grid";
		$this->template->set_breadcrumb("Calender Grid ","");	
		$this->template->build('admin_calender',$datas);
		
	}
	
	public function clientsleave( $ids='' )
	{
	    $this->load->model('welcome/welcomes');	    
	    if ($this->input->post()){
	        $postdata = $this->input->post();
	        $i=0;
	        //print '<pre>'; print_r($postdata); die("test"); 
	        $datainfo = explode(" ",$this->input->post("daterange"));
	        $tstartdatetime = strtotime($datainfo[0] . ' ' . $datainfo[1] . " " . $datainfo[2]);
	        $tenddatetime = strtotime($datainfo[4] . ' ' . $datainfo[5] . " " . $datainfo[6]);
	        $id=$this->input->post('manager_id');
	        
	        /* if($this->welcomes->IsLeaveRequest($Acpdata) > 0){
	            $this->messages->flash('Request have already process for the day', 'error');
	        }else{ */
	            if(isset($postdata['managerId']) && count($postdata['managerId'])>0){
	                foreach($postdata['managerId'] as $mnid){
	                    $Acpdata=array(
	                        "recource_id"=>$mnid,
	                        "leave_reason"=>$this->input->post('leave_reason'),
	                        "tstartdatetime" => $tstartdatetime,
	                        "tenddatetime" => $tenddatetime,
	                        "leave_title"=>$this->input->post('leave_title')
	                    );
	                    // Local this code is not working 
	                   /*  $this->load->library('email');
	                    $userInfo = $this->welcomes->getOtherUserDetails($mnid);
	                    $users = $this->welcomes->getOtherUserDetails( $id );
	                    $leave_reason = $this->welcomes->getLeaveReasonText($Acpdata['leave_reason'])->reason;
	                    $this->email->to($userInfo->email);
	                    $this->email->from('info@maynardleighonline.in');
	                    $this->email->set_mailtype("html");
	                    $maildata = $this->mails->getMailById(28);
	                    $information = array('name' => $userInfo->name,'user'=>"Super Admin", 'title' => ucfirst($Acpdata['leave_title']),
	                        'leavetype' => $leave_reason,
	                        'daterenge' => $this->input->post("daterange") );
	                    $datainfo = $this->messages->mailData($information, $maildata->mailbody);
	                    $bodymessage = $this->messages->mailTemplate($datainfo);
	                    $this->email->subject($maildata->mailsubject);
	                    $this->email->message($bodymessage);
	                    $this->email->send();
	                    $this->email->clear(); */
	                    $results=$this->welcomes->saveLeaveRequest($Acpdata);
	                    
	                }
	           // }
	            /* $Acpdata=array(
	                "recource_id"=>$id,
	                "leave_reason"=>$this->input->post('leave_reason'),
	                "tstartdatetime" => $tstartdatetime,
	                "tenddatetime" => $tenddatetime,
	                "leave_title"=>$this->input->post('leave_title')
	            );
	            $results=$this->welcomes->saveLeaveRequest($Acpdata); */
	            redirect("admin/welcome/clientsleave/".$id);
	        }
	    }
	    $datas['ids']=$ids;
	    $this->load->model('user/users'); 
	    //$data['property2']=single_array($this->users->calender(),'id','name');
	    $datas['property']=single_array($this->users->calender(),'id','name','Select Resource');
	    $datas['property2']=single_array($this->users->calender(),'id','name');
	    $datas['reasonsData'] =single_array($this->welcomes->getAllLeaveReasons(),'id','reason','Select Reason');
	    $data["pageName"]="Clientsleave";
	    $this->template->headingtitle="Resource leave ";
	    $this->template->set_breadcrumb("Resources Leave","");
	   // $this->template->set_layout("ajax");
	    $this->template->build('admin_calender',$datas);	    
	} 
	public function showAllDates()
	{
		//$data['id']=$this->input->post('managerid');
		//echo "<pre>";print_r($data['id']);die;
		$this->load->model('welcome/welcomes');

		$where['casting_id']=$this->input->post('managerid');
        //echo "<pre>";print_r($where);die;
		$resultsRequest=array();
		$resultsRequest=$this->welcomes->getLeaveRequest($where['casting_id']);
        $data['view']=(array)$this->welcomes->getAssignDateDetails($where);
        
        //now getting inner datas
        //echo "<pre>11111#";print_r($data['view']);die;
        $statusArray = array(0=>'Awaiting',1=>'Accepted',2=>'Rejected');
        $results=array();
        foreach($data['view'] as $key=>$v){
        	//$more = $this->welcomes->getMoreDataForResource($v->order_id,$v->order_type);

        	$v->moredetails=(array)$this->welcomes->getMoreDataForResource($v->order_id,$v->order_type,$v->diagnose_id);
        	//echo "##<pre>".$v->order_id;print_r($more);die;
                $results[] = array("id"=>$v->id,
                "interval" => $v->start_time."-".$v->end_time, 
                "title" => isset($v->moredetails['subname'])?$v->moredetails['subname']:'N/A',  
                "start" => date("Y-m-d", strtotime($v->start_date)),
                "clientname"=>$v->clientname,
                "location"=>isset($v->moredetails['location'])?$v->moredetails['location']:'',
                "job"=>isset($v->moredetails['name'])?$v->moredetails['name']:'',
                "className" => 'eventColor'.$statusArray[$v->status],
                "Subproduct"=>isset($v->moredetails['subname'])?$v->moredetails['subname']:'',
                "orderid"=>isset($v->moredetails['showorderid'])?$v->moredetails['showorderid']:'',
                "main_orderid"=>isset($v->order_id)?$v->order_id:'',
                "diagnose_id"=>isset($v->diagnose_id)?$v->diagnose_id:'',
                "ordertype"=>isset($v->order_type)?$v->order_type:'',
                "comment"=>isset($v->comment)?"Rejection Reason: ".$v->comment:'',
                "end" => date("Y-m-d", strtotime($v->end_date." +1 day")));
                //echo "<pre>";print_r($results);die;
            }
            foreach($resultsRequest as &$data){
                $data->start=date("Y-m-d", strtotime($data->start." +1 day"));
				$data->starts=date("Y-m-d h:j s", strtotime($data->start." +1 day"));
            }        
            $results=array_merge($resultsRequest,$results); 
			return $this->output->set_content_type('application/json')->set_output(json_encode($results));
	}
}
