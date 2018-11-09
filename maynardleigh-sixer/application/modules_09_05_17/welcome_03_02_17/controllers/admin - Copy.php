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
			
		$this->template->build('admin_calender',$datas);
		
	}
	public function showAllDates()
	{
		$data['id']=$this->input->post('id');
		$this->load->model('welcome/welcomes');

		$where['casting_id']=$this->input->post('id');
        //echo "<pre>";print_r($where);die;
        $data['view']=(array)$this->welcomes->getAssignDateDetails($where);
        //now getting inner datas
        //echo "<pre>11111#";print_r($data['view']);die;
        foreach($data['view'] as $key=>$record){
            //echo "<pre>";print_r($record);die;
            $current_result = (array)$this->welcomes->getMoreInfoForResource($record->diagnose_id,$record->order_type);
            $record->moreinfo=$current_result;
           // echo "<pre>11111#".$record->order_id;print_r($record);die;
            //$data['view'][$key]['moreinfo'] = $current_result;
        }
        $results = (array)$data['view'];

			return $this->output->set_content_type('application/json')->set_output(json_encode($results));
	}
}
