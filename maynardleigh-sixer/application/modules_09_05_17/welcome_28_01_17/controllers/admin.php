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
		$datas['property']=single_array($this->users->calender(),'id','name','Select Resource');
			
			//echo json_encode($details);
		$datas['headingtitle']="Calender Grid";
		$this->template->set_breadcrumb("Calender Grid ","");	
		$this->template->build('admin_calender',$datas);
		
	}
	public function showAllDates()
	{
		//$data['id']=$this->input->post('managerid');
		//echo "<pre>";print_r($data['id']);die;
		$this->load->model('welcome/welcomes');

		$where['casting_id']=$this->input->post('managerid');
        //echo "<pre>";print_r($where);die;
        $data['view']=(array)$this->welcomes->getAssignDateDetails($where);
        
        //now getting inner datas
        //echo "<pre>11111#";print_r($data['view']);die;
        $statusArray = array(0=>'Awaiting',1=>'Accepted',2=>'Rejected');
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
                "comment"=>isset($v->comment)?"Rejection Reason: ".$v->comment:'',
                "end" => date("Y-m-d", strtotime($v->end_date." +1 day")));
                //echo "<pre>";print_r($results);die;
            }
			return $this->output->set_content_type('application/json')->set_output(json_encode($results));
	}
}
