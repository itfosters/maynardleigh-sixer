<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends ITFS_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("workreports");
        $this->load->library('form_validation');
        //$data['id']=$this->input->post('id');
        $this->load->model('workreport/workreports');
        $this->load->helper('download');
    }

    public function index() {

        $info = $this->welcomes->getStatistic();
        $this->template->build('admin_index');
    }

    function mydates() {
        $datas['property'] = single_array($this->users->calender(), 'id', 'name');
        $datas['property'][''] = "Select Resource";
        $datas['headingtitle'] = "work reports";
        ksort($datas['property']);

        $this->template->set_breadcrumb("Work Reports ", "");

        $this->template->build('admin_calender', $datas);
        //echo "<pre>";print_r($datas);die;
    }

    public function showAllDates() {

        $where['casting_id'] = $this->input->post('id');
        $where['start_date'] = $this->input->post('cal1');
        $where['end_date'] = $this->input->post('cal2');
        //echo "<pre>";print_r($where);die;
        $data['view'] = (array) $this->workreports->getAssignDateDetails($where);
        foreach ($data['view'] as $key => $record) {
            $record->start_date = date('jS F, Y', strtotime($record->start_date));
            $record->end_date = date('jS F, Y', strtotime($record->end_date));
            $current_result = (array) $this->workreports->getMoreInfoForResource($record->diagnose_id, $record->order_type);
            $record->moreinfo = $current_result;
        }
        $results = (array) $data['view'];
        //echo "<pre>";print_r($results);die;
        return $this->output->set_content_type('application/json')->set_output(json_encode($results));
    }

    function getreport() {


        $this->load->helper('csv');

        $where['casting_id'] = $this->input->post('id');
        $where['start_date'] = $this->input->post('cal1');
        $where['end_date'] = $this->input->post('cal2');
        //echo "<pre>";print_r($where);die;
        $users = $this->workreports->getAssignDateDownload($where);

        $result = array_to_csv($users, 'Excel.xls');

        //echo "ggggggggggg";die;
    }

    function downloadExcel() {


        $this->load->helper('csv');

        $where['casting_id'] = $this->input->post('user_date');
        $where['start_date'] = $this->input->post('calender1');
        $where['end_date'] = $this->input->post('calender2');

        //echo "<pre>";print_r($where);die;
        //$headings = array('Resource', 'Product', 'Weightage', 'Subproducts', 'Client Name', 'Location', 'Start Date', 'End Date', 'Start time', 'End time', 'Status', 'Comment', 'Delete Comment');
        $headings =  array('Start Date','End Date','Client','Product','Subproduct','Resource','Location','Weightage','Status','Comments','Order Delete comment');
        //$users=$this->workreports->getAssignDateDownload($where);
        //$users=$this->workreports->getAssignDateDownload($where);
        $users = (array) $this->workreports->getAssignDateDetails($where);
        //echo "<pre>1234";print_r($users);die;
        foreach ($users as &$record) {
            $current_result = $this->workreports->getMoreDownloadResource($record->diagnose_id, $record->order_type);
            $record->start_date = date('jS F, Y', strtotime($record->start_date));
            $record->end_date = date('jS F, Y', strtotime($record->end_date));
            //echo "<pre>1234";print_r($record);
            //echo "<pre>1234";print_r($current_result);die;
            //$record[]=$current_result;
            $record->moreinformation = $current_result;
        }
        //echo "<pre>1234";print_r($users);die;
        $newalldata = array();
        //
        foreach ($users as $ukey => $udata) {
            //echo "<pre>";print_r($udata);die;
            $newalldata[$ukey]['start_date'] = $udata->start_date;
            $newalldata[$ukey]['end_date'] = $udata->end_date;
            
            $newalldata[$ukey]['clientsname'] = $udata->clientsname;
            $newalldata[$ukey]['name'] = isset($udata->moreinformation['name']) ? $udata->moreinformation['name'] : '';
            $newalldata[$ukey]['subname'] = isset($udata->moreinformation['subname']) ? $udata->moreinformation['subname'] : '';
            
            $newalldata[$ukey]['clientname'] = $udata->clientname;
            //$newalldata[$ukey]['weight'] = $udata['weight'];
            $newalldata[$ukey]['location'] = isset($udata->moreinformation['location']) ? $udata->moreinformation['location'] : '';
            $newalldata[$ukey]['weight'] = isset($udata->moreinformation['weight']) ? $udata->moreinformation['weight'] : '';
            $newalldata[$ukey]['status'] = $udata->status;
            if ($newalldata[$ukey]['status'] == 1) {
                $newalldata[$ukey]['status'] = "Approved";
            } else if ($newalldata[$ukey]['status'] == 0) {
                $newalldata[$ukey]['status'] = "Awaiting";
            } else {
                $newalldata[$ukey]['status'] = "Rejected";
            }
            $newalldata[$ukey]['comment'] = $udata->comment;
            $newalldata[$ukey]['del_comment'] = $udata->del_comment;
            unset($newalldata[$ukey]->moreinformation);
        }
        //echo "<pre>";print_r($newalldata);die;
        $resorce = $this->workreports->calender_resource($where['casting_id']);
        if (!empty($resorce))
            $name = 'work_reports' . '_' . $resorce->name . '.xls';
        else
            $name = 'work_reports' . '_' . date('Y_m_d') . '.xls';

        //echo "<pre>".$name;die;

        $result = array_to_csv($newalldata, $name, $headings);
    }

}
