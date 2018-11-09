<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends ITFS_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model("workreports");
			$this->load->library('form_validation');
		//$data['id']=$this->input->post('id');
		$this->load->model('workreport/workreports');
		$this->load->helper('download');
	}

   public function index()
	{

		$info=$this->welcomes->getStatistic();		
		$this->template->build('admin_index');
	}
	function mydates()
	{
		$datas['property']=single_array($this->users->calender(),'id','name');
		$datas['property']['']="Select Resource";
		$datas['headingtitle']="work reports";
		ksort($datas['property']);
		            
		$this->template->set_breadcrumb("Work Reports ","");
	
		$this->template->build('admin_calender',$datas);
		
	}
	public function showAllDates()
	{
	
		$where['casting_id']=$this->input->post('id');
		$where['start_date']=$this->input->post('cal1');
		$where['end_date']=$this->input->post('cal2');
		//echo "<pre>";print_r($where);die;
        $data['view']=(array)$this->workreports->getAssignDateDetails($where);
        foreach($data['view'] as $key=>$record){
            $current_result = (array)$this->workreports->getMoreInfoForResource($record->diagnose_id,$record->order_type);
            $record->moreinfo=$current_result;
        				}
        				 $results = (array)$data['view'];
        		//echo "<pre>";print_r($results);die;
			return $this->output->set_content_type('application/json')->set_output(json_encode($results));
	}
	function getreport()
	{

		
        $this->load->helper('csv');
       
 		$where['casting_id']=$this->input->post('id');
		$where['start_date']=$this->input->post('cal1');
		$where['end_date']=$this->input->post('cal2');
	//echo "<pre>";print_r($where);die;
        $users=$this->workreports->getAssignDateDownload($where);

    $result=array_to_csv($users, 'Excel.xls');

      //echo "ggggggggggg";die;
   
	}
	function downloadExcel()
	{
		
		
        $this->load->helper('csv');
       
 		$where['casting_id']=$this->input->post('user_date');
		$where['start_date']=$this->input->post('calender1');
		$where['end_date']=$this->input->post('calender2');
		
		//echo "<pre>";print_r($where);die;
		$headings =  array('Name','JOB','Weightage','Subproducts','Location','Start Date','End Date','Start time','End time','Status');
		$users=$this->workreports->getAssignDateDownload($where);
		 foreach($users as &$record){
            $current_result = $this->workreports->getMoreDownloadResource($record['diagnose_id'],$record['order_type']);

            $record[]=$current_result;
        				}
            $newalldata = array();
               //
       foreach($users as $ukey=>$udata){
       	//echo "<pre>";print_r($udata);die;
       		$newalldata[$ukey]['clientname'] = $udata['clientname'];
       		$newalldata[$ukey]['name'] = isset($udata[0]['name'])?$udata[0]['name']:'';
       		$newalldata[$ukey]['weight'] = isset($udata[0]['weight'])?$udata[0]['weight']:'';
       		$newalldata[$ukey]['subname'] = isset($udata[0]['subname'])?$udata[0]['subname']:'';
       		
       		//$newalldata[$ukey]['weight'] = $udata['weight'];
       		$newalldata[$ukey]['location'] = isset($udata[0]['location'])?$udata[0]['location']:'';
       		$newalldata[$ukey]['start_date'] = $udata['start_date'];
       		$newalldata[$ukey]['end_date'] = $udata['end_date'];
       		
       		$newalldata[$ukey]['start_time'] = $udata['start_time'];
       		$newalldata[$ukey]['end_time'] = $udata['end_time'];
       		$newalldata[$ukey]['status'] = $udata['status'];
       		if($newalldata[$ukey]['status']==1)
       		{
       			$newalldata[$ukey]['status']="Approved";
       		}
       		else if($newalldata[$ukey]['status']==0)
       		{
       			$newalldata[$ukey]['status']="Awaiting";
       		}else
       		{
       			$newalldata[$ukey]['status']="Rejected";
       		}
	
       		unset($newalldata[$ukey][0]);
       }
       $resorce=$this->workreports->calender_resource($where['casting_id']);
       $name='work_reports'.'_'.$resorce->name.'.xls';
   			//echo "<pre>".$name;die;

       $result=array_to_csv($newalldata, $name,$headings);
   
	}
}
