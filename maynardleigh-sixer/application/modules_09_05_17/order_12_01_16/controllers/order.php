<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class Order extends ITFS_Front_Controller 
{



    public function __construct() 
    {
        $this->load->helper('form','url');
        $this->load->library(array('form_validation','pagination'));
        $this->load->model('orders');
		$this->load->model('diagnose/diagnoses');
		$this->load->model('design/designs');
		$this->load->model('delivery/deliveries');
        $this->load->model('discovery/discoveries');
        $this->load->model('document/documents');
		$this->load->model('transport/transports');
    }
    public function index() 
    {
            $userid=$this->auth->getUserId();
            $all=$this->orders->showAllRows($userid);
            //echo $all;die;
            //$config=array();
             $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('order/index');
            $config['total_rows'] = $all;
            $config['per_page'] = 10;
            //$config['page_query_string'] = TRUE;
            $config["uri_segment"]=3;

            $this->pagination->initialize($config);
            //echo $this->pagination->create_links();
            $page =$this->uri->segment(3)? $this->uri->segment(3):0;

            $data['alldata']=$this->orders->showAllOrder($userid);
            
            //$data['ids']=$id;
            //echo "@@@@<pre>";print_r($data);die;
            $data['links'] = $this->pagination->create_links();
            //echo "<pre>12345";print_r($data);die;
            //echo "<pre>";print_r($this->template);die();

            $this->template->headingtitle="ORDER LISTING";
            $this->template->set_breadcrumb("Order Listing","");
            $this->template->build('my_order',$data);
    }
    public function orderCalenderGrid() 
    {//die('ffjf');
            $userid=$this->auth->getUserId();
            $date=strtotime(date('Y-m-d h:i:s'));

            $all=$this->orders->countAllRows($userid,$date);
            //echo $all;die;
            //$config=array();
             $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('order/orderCalenderGrid');
            $config['total_rows'] = $all;
            $config['per_page'] = 10;
            //$config['page_query_string'] = TRUE;
            $config["uri_segment"]=3;

            $this->pagination->initialize($config);
            //echo $this->pagination->create_links();
            $page =$this->uri->segment(3)? $this->uri->segment(3):0;

            $data['alldata']=$this->orders->showAcceptOrder($userid,$date);
            
            //$data['ids']=$id;
            //echo "@@@@<pre>";print_r($data);die;
            $data['links'] = $this->pagination->create_links();
            //echo "<pre>12345";print_r($data);die;
            //echo "<pre>";print_r($this->template);die();

            $this->template->headingtitle="MY WORK REPORT";
            $this->template->set_breadcrumb("My Work Report","");
            $this->template->build('my_ordergrid',$data);
    }
    
    public function details($orderid="")
    {
      //die($orderid);
      $data['userid']=$this->auth->getUserId();
     // echo $userid;die;
		$alldocuments = single_array($this->documents->getDocumentsName(),'id','document_name');
        $data['document']=$alldocuments;
        $alltransports = single_array($this->transports->getTransportsName(),'id','trans_name');
        $data['transports']=$alltransports;
        $data["dtdoc"]=single_array($this->orders->getDocById($orderid),'document_id','file_name');
        $data["dttrans"]=single_array($this->orders->getTransById($orderid),'transport_id','value');
		$data['detail']=$this->orders->getOrderDetail(array("O.id"=>$orderid));
		$data['diagonoesdetail']=$this->diagnoses->getDiagonoesDetail($orderid);
    $data['diagonoesresources']=$this->diagnoses->getDiagonoesResources($orderid);
		$data['getdesigndetail']=$this->designs->getdesignDetail($orderid);
    $data['getdesignresources']=$this->designs->getDesignResources($orderid);
		$data['getdeliverydetail']=$this->deliveries->getdeliveryDetail($orderid);
    foreach ($data['getdeliverydetail'] as $key => &$value) {
            $value->deliverdproduct =single_array($this->deliveries->getdeliveredProduct($value->id),'id','name');
            }
    $data['getdeliveryresources']=$this->deliveries->getDeliveryResources($orderid);
		$data['getdiscoverydetail']=$this->discoveries->getdiscoveryDetail($orderid);
    $data['getdiscoveryresources']=$this->discoveries->getDiscoveryResources($orderid);


		//echo "<pre>dfg";print_r($data);die;
		$this->template->headingtitle="Order Details";
    $this->template->set_breadcrumb("Order Listing",site_url('order'));
    $this->template->set_breadcrumb("View Details","");
		$this->template->build('order_details',array("frmdata"=>$data)); 
    }
    

    
    public  function delete($id='')
    {
            //$del=$this->input->post();
            $this->orders->deletedata($id);
            //echo "<pre>";print_r($del);die;
            // $deldata['frm_data']['view']=$this->clients->up_data($id);
            //echo "<pre>";print_r($deldata);die;
            //$this->template->build('del_client',$deldata);
            redirect('order');
    }
	
	 public  function resouces_form($id)
    {
     
		if($this->input->post())
		{
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
          //echo "<pre>";print_r($allvalue);die;
          $ecoemail='kanika@maynardleigh.in';
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
                                      'CLIENTNAME'=>$allvalue['clientname'],
                                      'JOBNAME'=>$allvalue['program_name'],
                                       'PROGRAMDATE'=>$allvalue['programdate'],
                                       'PARTICIPANTS_BRIEFED'=>$allvalue['participants_briefed'],
                                       'LEARNING_COMMUNITY'=>$allvalue['learning_community'],
                                       'LEARNING'=>$allvalue['learning'],
                                       'FEEDBACK'=>$allvalue['feedback'],
                                       'FEEDBACK_COMENT'=>$allvalue['feedback_coment'],
                                       'NOW_CARDS'=>$allvalue['now_cards'],
                                       'NEWCARDS'=>$allvalue['nowcards'],
                                       'TRUSTCONTRACT'=>$allvalue['trustContract'],
                                       'TRUST'=>$allvalue['trust'],
                                       'WORKSHOP_PICTURES'=>$allvalue['workshop_pictures'],
                                       'WORKSHOP'=>$allvalue['Workshop'],
                                       'BOOK_DATA'=>$allvalue['book_data'],
                                       'BOOK'=>$allvalue['book'],
                                       'ANY_OTHERS'=>$allvalue['any_others'],
                                       'ANYOTHERS'=>$allvalue['anyothers'],
                                       'PROGRESS_IT'=>$allvalue['progress_it'],
                                       'PROGRESSIT'=>$allvalue['progressit'],
                                       'OPTION_VALUE'=>$allvalue['option_value'],
                                       'CANI'=>$allvalue['CANI'],
                                       'GOBETTER'=>$allvalue['gobetter'],
                                       'ADDITIONAL'=>$allvalue['Additional'],
                                       'TRAINING'=>$allvalue['Training'],
                                       'BOOKS'=>$allvalue['Books'],
                                       'CARDS'=>$allvalue['Cards'],
                                       'BUSINESS'=>$allvalue['Business'],
                                        );

                    $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
                    //echo "<pre>";print_r($datainfo);die;
                    $bodymessage = $this->messages->mailTemplate($datainfo);
                    $this->email->subject($maildata->mailsubject);
                    $this->email->message($bodymessage);
                    //echo "<pre>";print_r($this->email);die;
                    $this->email->send();



                    $this->messages->flash('Email has been sent!');
                    $this->email->clear();
                    redirect('order/orderCalenderGrid');



        }


         $data['view']=$this->orders->resourceDetails($id);
		 $data['moreinfo']=$this->orders->moreResourceDetails($data['view']->id,$data['view']->order_type);
		 //echo "<pre>";print_r($data);die;
      $this->template->headingtitle="MY WORK REPORTS";
     $this->template->set_breadcrumb("Work Report Listing",site_url('order/orderCalenderGrid'));
     $this->template->set_breadcrumb("Submit Details","");
    $this->template->build('resoucesform',array('frmdata'=>$data));   
    }
    function ourTimeSlot($d_id,$o_id,$u_id)
    {
      //echo $d_id.$o_id.$u_id;die;
      $where=array('d_id'=>$d_id,'o_id'=>$o_id,'u_id'=>$u_id);
      $data['itf']=$this->orders->TimeSlot($where);
      $this->template->headingtitle="Time Slot";
     //$this->template->set_breadcrumb("Work Report Listing",site_url('order/orderCalenderGrid'));
     //$this->template->set_breadcrumb("Submit Details","");
   
      $this->template->build('timeslots',$data);
    }
     function ourUserCall($d_id,$o_id,$u_id)
    {
      //echo $d_id.$o_id.$u_id;die;
      $where=array('d_id'=>$d_id,'o_id'=>$o_id,'u_id'=>$u_id);
      $data['itf']=$this->orders->userCall($where);
      $this->template->headingtitle="User Call";
     //$this->template->set_breadcrumb("Work Report Listing",site_url('order/orderCalenderGrid'));
     //$this->template->set_breadcrumb("Submit Details","");
   
      $this->template->build('usercall',$data);
    }

}