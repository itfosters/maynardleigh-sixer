<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class Order extends ITFS_Front_Controller {

    public function __construct() {
        $this->load->helper('form', 'url');
        $this->load->library(array('form_validation', 'pagination'));
        $this->load->model('orders');
        $this->load->model('diagnose/diagnoses');
        $this->load->model('design/designs');
        $this->load->model('delivery/deliveries');
        $this->load->model('discovery/discoveries');
        $this->load->model('document/documents');
        $this->load->model('transport/transports');
    }

    public function index() {//die('jbjnj');
        $userid = $this->auth->getUserId();
        $usertype = $this->auth->getUserType();
        //echo "<pre>";print_r($usertype);die;
        if ($usertype == 'CM') {
            $all = $this->orders->showAllRows($userid);
            //echo $all;die;
            //$config=array();
            $config = $this->paginationformat["back_page"];
            $config['base_url'] = base_url('order/index');
            $config['total_rows'] = $all;
            $config['per_page'] = 10;
            //$config['page_query_string'] = TRUE;
            $config["uri_segment"] = 3;

            $this->pagination->initialize($config);
            //echo $this->pagination->create_links();
            $page = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

            $data['alldata'] = $this->orders->showAllOrder($userid);
            foreach ($data['alldata'] as &$dt) {
                //$dt->statusdata = $this->orders->checkAssignData($dt->id);
                $dt->alldates = $this->orders->checkAllDates($dt->id);
            }
            //$data['ids']=$id;
            //echo "@@@@<pre>";print_r($data);die;
            $data['links'] = $this->pagination->create_links();
            //echo "<pre>12345";print_r($data);die;
            //echo "<pre>";print_r($this->template);die();

            $this->template->headingtitle = "ORDER LISTING";
            $this->template->set_breadcrumb("Order Listing", "");
            $this->template->build('my_order', $data);
        } else if ($usertype == 'N') {
            //die('ggggggggg');
            //$orderid = $this->orders->getOrderId($userid);
            //echo "<pre>";print_r($orderid->order_id);die;
            $all = $this->orders->showAllParticipantRows($userid);
            //echo '<pre>';print_r($all);die;
            //$config=array();
            $config = $this->paginationformat["back_page"];
            $config['base_url'] = base_url('order/index');
            $config['total_rows'] = $all;
            $config['per_page'] = 10;
            //$config['page_query_string'] = TRUE;
            $config["uri_segment"] = 3;

            $this->pagination->initialize($config);
            //echo $this->pagination->create_links();
            $page = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

            $data['alldata'] = $this->orders->showAllParticipantOrder($userid);
            //echo "<pre>";print_r($data);die;
            foreach ($data['alldata'] as &$dt) {
                //$dt->statusdata = $this->orders->checkAssignData($dt->id);
                $dt->alldates = $this->orders->checkDeliveryDates($dt->id);
            }
            //$data['ids']=$id;
            //echo "@@@@<pre>";print_r($data);die;
            $data['links'] = $this->pagination->create_links();
            //echo "<pre>12345";print_r($data);die;
            //echo "<pre>";print_r($this->template);die();

            $this->template->headingtitle = "ORDER LISTING";

            $this->template->set_breadcrumb("Goal Listing", site_url("order/goal"));
            $this->template->set_breadcrumb("Order Listing", "");
            $this->template->build('myparticipant_order', $data);
        }
    }

    public function orderCalenderGrid() {//die('ffjf');
        $userid = $this->auth->getUserId();
        $date = strtotime(date('Y-m-d h:i:s'));
        //echo "<pre>";print_r('date = '.$date   .' userid = '.$userid);die;

        $all = $this->orders->countAllRows($userid, $date);
        //echo $all;die;
        //$config=array();
        $config = $this->paginationformat["back_page"];
        $config['base_url'] = base_url('order/orderCalenderGrid');
        $config['total_rows'] = $all;
        $config['per_page'] = 10;
        //$config['page_query_string'] = TRUE;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);
        //echo $this->pagination->create_links();
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

        $data['alldata'] = $this->orders->showAcceptOrder($userid, $date);

        //$data['ids']=$id;
        //echo "@@@@<pre>";print_r($data);die;
        $data['links'] = $this->pagination->create_links();
        //echo "<pre>12345";print_r($data);die;
        //echo "<pre>";print_r($this->template);die();

        $this->template->headingtitle = "MY WORK REPORT";
        $this->template->set_breadcrumb("My Work Report", "");
        $this->template->build('my_ordergrid', $data);
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
        $this->template->set_breadcrumb("Order Listing", site_url('order'));
        $this->template->set_breadcrumb("View Details", "");
        $this->template->build('order_details', array("frmdata" => $data));
    }

    public function delete($id = '') {
        //$del=$this->input->post();
        $del = $this->orders->deletedata($id);
        if (!(empty($del)))
            $this->messages->flash('Data Deleted Successfully');
        redirect('order/goal');
    }

    public function resouces_form($assing_timeid, $id, $order_type) {
        //echo "<pre>";print_r($_SESSION);die;
        $userid = $this->auth->getUserId();
        $this->load->model('user/users');
        $userinfo = $this->users->getUsersById($userid);
        //echo "<pre>";print_r($userinfo);die;
        $data['diagnose_id'] = $id;
        $data['assign_date_id'] = $assing_timeid;
        $data['order_type'] = $order_type;
        $data['userinfo'] = $userinfo;
        $this->load->model('orders');
        if ($this->input->post()) {
            //          $this->load->library('form_validation');
            //          $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            //          $this->form_validation->set_rules('dntarget_dateame', 'target_date', 'required');
            //          $this->form_validation->set_rules('participants_briefed', 'participants_briefed', 'required');
            //          $this->form_validation->set_rules('feedback', 'feedback', 'required');
            //          $this->form_validation->set_rules('books', 'books', 'required');
            //          $this->form_validation->set_rules('deliverables', 'deliverables', 'required');
            //          $this->form_validation->set_rules('learningCommunity', 'learningCommunity', 'required');
            //          $this->form_validation->set_rules('cards', 'cards', 'required');
            //          $this->form_validation->set_rules('trustContract', 'trustContract', 'required');
            //          if ($this->form_validation->run() == FALSE) {
            // 	$data=array('clientname'=>$this->input->post('clientname'),
            // 				'program_name'=>$this->input->post('program_name'),
            // 				'programdate'=>$this->input->post('programdate'),
            // 				'target_date'=>$this->input->post('target_date'),
            // 				'participants_briefed'=>$this->input->post('participants_briefed'),
            // 				'deliverables'=>$this->input->post('deliverables'),
            // 				'learningCommunity'=>$this->input->post('learningCommunity'),
            // 				'feedback'=>$this->input->post('feedback'),
            // 				'cards'=>$this->input->post('cards'),
            // 				'trustContract'=>$this->input->post('trustContract'),
            // 				'workshopPictures'=>$this->input->post('workshopPictures'),
            // 				'books'=>$this->input->post('books'),
            // 				'progressIT'=>$this->input->post('progressIT'),
            // 				'cani'=>$this->input->post('cani'),
            // 				'better'=>$this->input->post('better'),
            // 				'logisticsWorkshopContent'=>$this->input->post('logisticsWorkshopContent'),
            // 				'trainingMaterials'=>$this->input->post('trainingMaterials'),
            // 				'anyOthers'=>$this->input->post('anyOthers'),
            // 				'logisticsRating'=>$this->input->post('logisticsRating'),
            // 	);//echo "<pre>";print_r($data);die;
            //  $this->orders->resouces_forme($data);
            //        redirect(site_url('order/orderCalenderGrid'));
            // 	//$data=array('logisticsRating'=>$this->input->post('logisticsRating'));
            // 	// 
            // }
            //$data['detail']=$this->orders->getEcoEmail(array("O.id"=>$orderid));
            $allvalue = $this->input->post();
            $answer = array(0 => 'No', 1 => "Yes");
            $logisticsRating = array(
                '0' => 'Excellent',
                '1' => 'Good',
                '2' => 'Average',
            );
            //echo "<pre>";print_r($allvalue);die;
            $where = array('diagnose_id' => $id,
                'assign_date_id' => $assing_timeid,
                'order_type' => $order_type);
            //echo "#####<pre>";print_r($where);die;
            $dataexist = $this->orders->checkLeadershipReport($where);
            //echo "<pre>111";print_r($dataexist);die;
            if ($dataexist > 0) {
                $this->orders->saveLeadershipReport($allvalue, $where);
            } else {

                //echo "<pre>1233";print_r($allvalue);die;
                $this->orders->saveLeadershipReport($allvalue);
                //$this->resouces_form($assign_date_id,$did,$order_type);
            }



            //$this->orders->saveLeadershipReport($allvalue);

            $ecoemail = 'teamindia@maynardleigh.in,kanika@maynardleigh.in';
            //$ecoemail='rahulsaxena.indian@gmail.com';
            //$ecofirstname=$data['detail']->first_name;
            //$ecolastname=$data['detail']->last_name;
            //$link =site_url('contract_accept/index'.'/'.$orderid);
            //die($link);
            $this->load->library('email');
            $this->email->to($ecoemail);
            //$this->email->to('send2ranu@gmail.com');                
            $this->email->from('info@maynardleighonline.in ');
            $this->email->set_mailtype("html");
            //$maildata = $this->mails->getMailById(21);
            $maildata = $this->mails->getMailById(22);
            //echo "<pre>";print_r($maildata);die;
            $information = array(
                //'username'=>$ecoemail,
                'CLIENTNAME' => $allvalue['clientname'],
                'RESOURCESNAME' => $allvalue['resource_name'],
                'JOB' => $allvalue['name'],
                'JOBNAME' => $allvalue['program_name'],
                'PROGRAMDATE' => $allvalue['programdate'],
                'PARTICIPANTS_BRIEFED' => $answer[$allvalue['participants_briefed']],
                'LEARNING_COMMUNITY' => $answer[$allvalue['learning_community_radio']],
                'LEARNING' => $allvalue['learning_community_text'],
                'FEEDBACK' => $answer[$allvalue['feedback_radio']],
                'FEEDBACK_COMENT' => $allvalue['feedback_text'],
                'NOW_CARDS' => $answer[$allvalue['do_it_now_cards_radio']],
                'NEWCARDS' => $allvalue['do_it_now_cards_text'],
                'TRUSTCONTRACT' => $answer[$allvalue['trust_contract_radio']],
                'TRUST' => $allvalue['trust_contract_text'],
                'WORKSHOP_PICTURES' => $answer[$allvalue['workshop_pictures_radio']],
                'WORKSHOP' => $allvalue['workshop_pictures_text'],
                'BOOK_DATA' => $answer[$allvalue['books_radio']],
                'BOOK' => $allvalue['books_text'],
                'ANY_OTHERS' => $answer[$allvalue['any_others_radio']],
                'ANYOTHERS' => $allvalue['any_others_text'],
                'PROGRESS_IT' => $answer[$allvalue['progress_it_radio']],
                'PROGRESSIT' => $allvalue['progress_it_text'],
                'OPTION_VALUE' => $logisticsRating[$allvalue['logistics_rating']],
                'WHY_WERE_WE_THERE' => $allvalue['why_were_we_there'],
                'WHAT_WAS_THE_SOLUTION' => $allvalue['what_was_the_solution'],
                'WHAT_WAS_THE_OUTCOME' => $allvalue['what_was_the_outcome'],
                'CANI' => $allvalue['cani'],
                'GOBETTER' => $allvalue['what_could_go_better'],
                'ADDITIONAL' => $allvalue['additional_comments'],
                'TRAINING' => $allvalue['training_materials_given'],
                'BOOKS' => $allvalue['books_name_and_quantity'],
                'CARDS' => $allvalue['cards_name_and_quantity'],
                'BUSINESS' => $allvalue['any_future_business_development_opportunities'],
            );


            $datainfo = $this->messages->mailData($information, $maildata->mailbody);
            //echo "<pre>";print_r($datainfo);die;
            $bodymessage = $this->messages->mailTemplate($datainfo);
            $this->email->subject($maildata->mailsubject);
            $this->email->message($bodymessage);
            //echo "<pre>";print_r($this->email);die;
            $this->email->send();



            $this->messages->flash('Email has been sent!');
            $this->email->clear();
            redirect('welcome/mydates');
        }

        $allData = $this->orders->getLeaderShipReport($assing_timeid, $id, $order_type);
        //echo "<pre>";print_r($allData);die;
        if (isset($allData->feedback_radio)) {
            $data['formdata'] = (array) $allData;
        }
        //echo "<pre>";print_r($allData);die;
        //$data['view']=$this->orders->resourceDetails($id);
        $this->load->model('diagnose/diagnoses');
        $order_type = array('order_type' => $order_type);
        $data['moreinfo'] = $this->diagnoses->getResourcesAssignDetails($id, $order_type);
        //echo "<pre>";print_r($data);die;
        //echo "<pre>";print_r($data);die;
        $this->template->headingtitle = "Submit Leadership Report";
        $this->template->set_breadcrumb("My Booking Dates", site_url('welcome/mydates'));
        $this->template->set_breadcrumb("Submit Details", "");


        //$this->template->add_js("assests/itfeditor/ckeditor.js");



        $this->template->build('resoucesform', array('frmdata' => $data));
    }

    function resourceFormAjax() {

        $data = $this->input->post('data');


        $strArray = explode("&", $data);
        foreach ($strArray as $item) {
            $array = explode("=", $item);
            $returndata[$array[0]] = $array[1];
        }
        //echo "<pre>";print_r($returndata);die;
        $assign_date_id = $returndata['assign_date_id'];
        $did = $returndata['diagnose_id'];
        $order_type = $returndata['order_type'];

        $allvalue = array();
        foreach ($returndata as $key => $value) {
            $allvalue[$key] = urldecode($value);
        }

        $where = array('diagnose_id' => $did,
            'assign_date_id' => $assign_date_id,
            'order_type' => $order_type);
        //echo "#####<pre>";print_r($where);
        $dataexist = $this->orders->checkLeadershipReport($where);
        //echo "<pre>";print_r($dataexist);die;
        if ($dataexist > 0) {
            $this->orders->saveLeadershipReport($allvalue, $where);
        } else {

            //echo "<pre>1233";print_r($allvalue);die;
            $this->orders->saveLeadershipReport($allvalue);
            //$this->resouces_form($assign_date_id,$did,$order_type);
        }
    }

    function ourTimeSlot($d_id, $o_id, $u_id) {
        //echo $d_id.$o_id.$u_id;die;
        $where = array('d_id' => $d_id, 'o_id' => $o_id, 'u_id' => $u_id);
        $data['itf'] = $this->orders->TimeSlot($where);
        $this->template->headingtitle = "Time Slot";
        //$this->template->set_breadcrumb("Work Report Listing",site_url('order/orderCalenderGrid'));
        //$this->template->set_breadcrumb("Submit Details","");

        $this->template->build('timeslots', $data);
    }

    function ourUserCall($d_id, $o_id, $u_id) {
        //echo $d_id.$o_id.$u_id;die;
        $where = array('d_id' => $d_id, 'o_id' => $o_id, 'u_id' => $u_id);
        $data['itf'] = $this->orders->userCall($where);
        $this->template->headingtitle = "User Call";
        //$this->template->set_breadcrumb("Work Report Listing",site_url('order/orderCalenderGrid'));
        //$this->template->set_breadcrumb("Submit Details","");

        $this->template->build('usercall', $data);
    }

    //Participant Goal Listing
    public function goal() {
        $userid = $this->auth->getUserId();
        $data['delvid']=$this->orders->getDeliveryIdByUser($userid);
        $delivery_id=  isset($data['delvid']->delivery_id)?$data['delvid']->delivery_id:'';
        //echo '<pre>';print_r($delivery_id);die;
        $data['all'] = $this->orders->getAllGoal($delivery_id,$userid);
        //echo "<pre>@@@";print_r($data['all']);die;
        $this->template->headingtitle = "GOAL LISTING";
        $this->template->set_breadcrumb("Order Listing", site_url("order"));
        $this->template->set_breadcrumb("GOAL LISTING", "");
        $this->template->build('goal', array('frmdata'=>$data));
    }
    
    ///Success Parameter 
    public function successParameter()
    {
        $successPara['view']=$this->orders->getTodo($id);
        //echo "<pre>";print_r($participantTodo);die;
        $this->template->headingtitle = "TODO LISTING";
        $this->template->set_breadcrumb("GOAL", site_url("order/goal"));
        $this->template->set_breadcrumb("TODO LISTING", "");
        $this->template->build('myTodo',array('frmtodo'=>$participantTodo));
    }

    //Add  Participant Goal 
    public function addGoal($id='') {
        $userid = $this->auth->getUserId();
        $data['delvid']=$this->orders->getDeliveryIdByUser($userid);
        $delivery_id=  isset($data['delvid']->delivery_id)?$data['delvid']->delivery_id:'';
        if ($this->input->post()) {
            if (empty($id)) {
                $data = array(
                    'userid' => $userid,
                    'deliveryid' => $delivery_id,
                    'goal' => $this->input->post('goal')
                );
                //echo "<pre>";print_r($data);die;
                
                $insert = $this->orders->addGoal($data);
                if (!empty($insert)) {
                    $this->messages->flash('Goal has been saved successfully');
                }
                redirect('order/goal');
            } else {
                $data = array(
                    'userid' => $userid,
                    'deliveryid' => $delivery_id,
                    'goal' => $this->input->post('goal')
                );
                $where['id'] = $id;
                //echo "<pre>";print_r($data);die;
                $update = $this->orders->addGoal($data, $where);
                if (!empty($update)) {
                    $this->messages->flash('Goal has been update successfully');
                }
                redirect('order/goal');
            }
        }
        else{
            $data=array();
        $data['view'] = $this->orders->getGoal($id);
        //echo '<pre>';print_r($data);die;
        }
        if(empty($id))
        $this->template->headingtitle = "ADD GOAL";
    else
        $this->template->headingtitle = "UPDATE GOAL";
        $this->template->set_breadcrumb("Goal Listing", site_url("order/goal"));
        if(empty($id))
        $this->template->set_breadcrumb("ADD GOAL", "");
        else
            $this->template->set_breadcrumb("UPDATE GOAL", "");
      $this->template->add_js("assests/itfeditor/ckeditor.js");
      $this->template->add_js(" $(document).ready(function(){
      CKEDITOR.replace('goal', {});
     

                });","B","embed");
        $this->template->build('goalform', array('frm_data' => $data));
    }

    //Participant Reject order
    public function reject($id) {
        redirect('order');
    }
    // My TO DO Listing
    public function myTodo($id)
    {
        $participantTodo['view']=$this->orders->getTodo($id);
        //echo "<pre>";print_r($participantTodo);die;
        $this->template->headingtitle = "TODO LISTING";
        $this->template->set_breadcrumb("GOAL", site_url("order/goal"));
        $this->template->set_breadcrumb("TODO LISTING", "");
        $this->template->build('myTodo',array('frmtodo'=>$participantTodo));
    }
     public function complateTodo(){
        
        $todoId =$this->input->post('todoId');
        // print_r($this->input->post());          die;
        print  $this->orders->complateTodo($todoId);
        exit();
    }

}
