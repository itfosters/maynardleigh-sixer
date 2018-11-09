<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends ITFS_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model("workreportclients");
			$this->load->library('form_validation');
		//$data['id']=$this->input->post('id');
		$this->load->model('workreportclient/workreportclients');
		$this->load->helper('download');
	}

   public function index()
	{

		$info=$this->welcomes->getStatistic();		
		$this->template->build('admin_index');
	}
	function mydates()
	{
		$datas['property']=single_array($this->workreportclients->calender(),'id','name');
		$datas['property']['']="Select Client";
		$datas['headingtitle']="work reports by client wise";
		ksort($datas['property']);
			
		$this->template->build('admin_calender',$datas);
		
	}
	public function showAllDates()
	{
	
		$where['casting_id']=$this->input->post('id');
		$where['start_date']=$this->input->post('cal1');
		$where['end_date']=$this->input->post('cal2');
		//echo "<pre>";print_r($where);die;
        $data['view']=(array)$this->workreportclients->getAssignDateDetails($where);
        foreach($data['view'] as $key=>$record){
            $current_result = (array)$this->workreportclients->getMoreInfoForResource($record->diagnose_id,$record->order_type);
            $record->moreinfo=$current_result;
        				}
        				 $results = (array)$data['view'];

			return $this->output->set_content_type('application/json')->set_output(json_encode($results));
	}
	function getreport()
	{

		
        $this->load->helper('csv');
       
 		$where['casting_id']=$this->input->post('id');
		$where['start_date']=$this->input->post('cal1');
		$where['end_date']=$this->input->post('cal2');
	//echo "<pre>";print_r($where);die;
        $users=$this->workreportclients->getAssignDateDownload($where);

    $result=array_to_csv($users, 'Excel.xls');

      //echo "ggggggggggg";die;
   
	}
	function downloadExcel()
	{
		//echo "<pre>";print_r($_REQUEST);die;
		
        $this->load->helper('csv');
       
 		$where['casting_id']=$this->input->post('user_date');
		$where['start_date']=$this->input->post('calender1');
		$where['end_date']=$this->input->post('calender2');
		
		
		$headings =  array('Order ID','JOB','Subproducts','Location','Start Date','End Date','Status');
		$users=$this->workreportclients->getAssignDateDownload($where);
		//echo "<pre>";print_r($users);die;
		 foreach($users as &$record){
            $current_result = $this->workreportclients->getMoreDownloadResource($record['diagnose_id'],$record['order_type']);

            $record[]=$current_result;
        				}
            $newalldata = array();
       foreach($users as $ukey=>$udata){
       	//echo "<pre>";print_r($udata);die;
       		$newalldata[$ukey]['order_id'] = $udata['order_id'];
       		$newalldata[$ukey]['name'] = isset($udata[0]['name'])?$udata[0]['name']:'';
       		$newalldata[$ukey]['subname'] = isset($udata[0]['subname'])?$udata[0]['subname']:'';
       		//$newalldata[$ukey]['weight'] = $udata['weight'];
       		$newalldata[$ukey]['location'] =isset($udata[0]['location'])?$udata[0]['location']:'';
       		$newalldata[$ukey]['start_date'] = $udata['start_date'];
       		$newalldata[$ukey]['end_date'] = $udata['end_date'];
       		
       		//$newalldata[$ukey]['start_time'] = $udata['start_time'];
       		//$newalldata[$ukey]['end_time'] = $udata['end_time'];
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
   $resorce=$this->workreportclients->calender_resource($where['casting_id']);
       $name='work_reports_client'.'_'.$resorce->name.'.xls';
       $result=array_to_csv($newalldata,$name,$headings);
   
	}
}
