<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class Delivery extends ITFS_Front_Controller 
{

    

    public function __construct() 
    {
    $this->load->helper('form','url');
    $this->load->library('form_validation');
    $this->load->model('deliveries');
    $this->load->model('product/products');
    $this->load->model('delivery/deliveries'); 
     $this->load->model('diagnose/diagnoses'); 
         $this->load->model('casting_manager/casting_managers'); 
        
    }
    public function index($id) 
    {
            
            $data['all']=$this->deliveries->showAllDelivery($id);
           
            $data['ids']=$id;
             //echo "<pre>";print_r($data);die;
			 
			 $this->template->headingtitle="DELIVERY LISTING";
			 $this->template->set_breadcrumb("ADD DELIVERY",site_url("delivery/form/".$id));
			 $this->template->set_breadcrumb("DELIVERY LISTING","");
             $this->template->build('show_delivery',$data);
    }
    
    public function form($id='',$subproduct='')
    {  

 
        //echo "333@@@<pre>";print_r($subproduct);die;
        $allProduct = single_array($this->products->getProductsForSelect(3),'id','name','Select Product');
        $data['product']=$allProduct;
        $data['castingmanager']=single_array($this->casting_managers->getCastingManagerForSelect(),'id','name');
        
        
        //echo "<pre>";print_r($allProduct);die;
        //$this->template->build('show_view',$data); 
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                $this->form_validation->set_rules('dvproducts', 'Product Name', 'required');
                $this->form_validation->set_rules('dvdetails', 'Details', 'required');
                $this->form_validation->set_rules('dvweight', 'Weight.', 'required');
                $this->form_validation->set_rules('dvunits', 'Units', 'required');
                $this->form_validation->set_rules('dvpax', 'Pax', 'required');
                $this->form_validation->set_rules('dvnoofdays', 'No of Days', 'required');
                $this->form_validation->set_rules('dvcunsulting', 'Cunsulting Days', 'required');
                $this->form_validation->set_rules('dvstartdate', 'Start Date', 'required');
                $this->form_validation->set_rules('dvenddate', 'End Date', 'required');
                $this->form_validation->set_rules('dvlocation', 'Location', 'required');
                $this->form_validation->set_rules('dvpriceandunit', 'Price nd Units', 'required');
                $this->form_validation->set_rules('dvcoordinator', 'Co Ordinator', 'required');
                $this->form_validation->set_rules('dvemail', 'Email', 'required');
                $this->form_validation->set_rules('dvcontact', 'Contact No', 'required');
                if ($this->form_validation->run() == false) 
                {
                    $data['subdelvid']=(object)array(
                                        'order_Id'=>$id,
                                        'products'=>$this->input->post('dvproducts'),
                                        'details'=>$this->input->post('dvdetails'),
                                        'weight'=>$this->input->post('dvweight'),
                                        'units'=>$this->input->post('dvunits'),
                                        'pax'=>$this->input->post('dvpax'),
                                        'no_ofdays'=>$this->input->post('dvnoofdays'),
                                        'cunsulting_days'=>$this->input->post('dvcunsulting'),
                                        'start_date'=>$this->input->post('dvstartdate'),
                                        'end_date'=>$this->input->post('dvenddate'),
                                        'location'=>$this->input->post('dvlocation'),
                                        'price_unit'=>$this->input->post('dvpriceandunit'),
                                        'coordinator'=>$this->input->post('dvcoordinator'),
                                        'email_id'=>$this->input->post('dvemail'),
                                        'contact'=>$this->input->post('dvcontact')
                                        );
                    $data['selectedmangers']=$this->input->post('dvnocasting');
                    //echo "<pre>";print_r($data);die;
                }
                else 
                {
                    if(empty($subproduct))
                    {
                        //die('fggyh');
                        $delivery['order_Id']=$id;
                        $delivery['products']=$this->input->post('dvproducts');
                        $delivery['details']=$this->input->post('dvdetails');
                        $delivery['weight']=$this->input->post('dvweight');
                        $delivery['units']=$this->input->post('dvunits');
                        $delivery['pax']=$this->input->post('dvpax');
                        $delivery['no_ofdays']=$this->input->post('dvnoofdays');
                        $delivery['cunsulting_days']=$this->input->post('dvcunsulting');
                        $delivery['start_date']=$this->input->post('dvstartdate');
                        $delivery['end_date']=$this->input->post('dvenddate');
                        $delivery['location']=$this->input->post('dvlocation');
                        $delivery['price_unit']=$this->input->post('dvpriceandunit');
                        $delivery['coordinator']=$this->input->post('dvcoordinator');
                        $delivery['email_id']=$this->input->post('dvemail');
                        $delivery['contact']=$this->input->post('dvcontact');
                        $casting_manager=$this->input->post('dvnocasting');
                        //echo "<pre>22222@@@@@@@@@@@";print_r($delivery);die;

                        $inserid=$this->deliveries->add_delivery($delivery);
                        $casts=array();  
                        foreach ($casting_manager as $key => $value) 
                        {
                        $casts[]=array('diagnose_id'=>$inserid,'casting_manager'=>$value);
                        }
                        $this->diagnoses->addCasting($casts,array("diagnose_id"=>$inserid));
                        redirect('delivery/index/'.$id);
                    }
               
            
                    else
                    {//die('vgvhu');
                        $deliverydata=array();
                        //$data=$this->input->post();
                        $deliverydata=array(
                        'order_Id'=>$id,
                        'products'=>$this->input->post('dvproducts'),
                        'details'=>$this->input->post('dvdetails'),
                        'weight'=>$this->input->post('dvweight'),
                        'units'=>$this->input->post('dvunits'),
                        'pax'=>$this->input->post('dvpax'),
                        'no_ofdays'=>$this->input->post('dvnoofdays'),
                        'cunsulting_days'=>$this->input->post('dvcunsulting'),
                        'start_date'=>$this->input->post('dvstartdate'),
                        'end_date'=>$this->input->post('dvenddate'),
                        'location'=>$this->input->post('dvlocation'),
                        'price_unit'=>$this->input->post('dvpriceandunit'),
                        'coordinator'=>$this->input->post('dvcoordinator'),
                        'email_id'=>$this->input->post('dvemail'),
                        'contact'=>$this->input->post('dvcontact')
                        );
                        $casting_manager=$this->input->post('dvnocasting');
                        //echo "<pre>";print_r($deliverydata);die;
                        $this->deliveries->update_Delivery($deliverydata,$subproduct,$id);
                        //echo "<pre>";print_r($deliverydata);die;
                        $casts=array();

                        foreach ($casting_manager as $key => $value) 
                        {
                            $casts[]=array('diagnose_id'=>$subproduct,'casting_manager'=>$value);
                        }
                        $this->diagnoses->addCasting($casts,array("diagnose_id"=>$subproduct));
                        redirect('delivery/index/'.$id);
                    }
                }
            }
            else
            {
       
                $data['subdelvid']=$this->deliveries->getSubdelevaryById($id,$subproduct);
                //echo "<pre>";print_r($data);die;
                $data['selectedmangers']=array_keys(single_array($this->diagnoses->getCasting($subproduct),'casting_manager'));
                //echo "@@@<pre>";print_r($data);die;
                //die('dsfedf');
                //echo "<pre>111";print_r();die;
                // $data['parrentid']=$id;
                //$this->template->add_js($modalViewi, "B", "embed");
            }
                $this->template->headingtitle="ADD DELIVERY";
                $this->template->set_breadcrumb("DELIVERY LISTING",site_url("delivery/index/".$id));
                $this->template->set_breadcrumb("ADD DELIVERY","");
                $this->template->build('show_view',array("frmdata"=>$data));
    }
    public function getPriceByAjax()
    {
        $this->load->model('product/products');
        $ids=$this->input->post('ids');
        //echo "<pre>";print_r($ids);die;
        $proprice=$this->products->getProductPrice($ids);
        //echo "<pre>";print_r($t);die;
            echo json_encode(array('totalprice'=>$proprice));
    }

    
    public  function delete($id='',$oid='')
    {
      
        $this->deliveries->deletedata($id,$oid);
       redirect('delivery/index/'.$id);
    }
    public function details($id)
    {//die($id);
        $data['delview']=$this->deliveries->showDeliveryDetails($id);

        //echo "<pre>";print_r($data);die;
        $this->template->build('show_detail',$data);
    }
    //Delete Todo
    public function deleteTodo($goalid,$todoid)
    {
        $this->deliveries->deleteTodoData($goalid,$todoid);
        redirect('delivery/todoList/'.$goalid);
    }
    public function calender($oid="",$dvyid="")
    {
        
        $data['allmanager'] = single_array($this->diagnoses->getAllManagers($dvyid),'id','name','Select Manager');
        //echo "<pre>";print_r($data);die;
        
        if($this->input->post())
        {
            //$diagnosedata=array();
            $postalldata=$this->input->post();
            $datainfo = explode("-",$postalldata["daterange"]);
            $startdata = trim($datainfo[0]);
            $enddata = trim($datainfo[1]);
            
            $assigndata = array(
                            "diagnose_id"=>$postalldata["diagnose_id"],
                            "manager_id"=>$postalldata["manager"],
                            "start_date"=>$startdata,
                            "end_date"=>$enddata,
                );
            $assigndataid = $this->diagnoses->addAssignDate($assigndata);
            redirect("delivery/calender/".$oid."/".$dvyid);
        }
        
        $data['diagnose_id']=$dvyid;
        
        $this->template->build('calender',$data);
    }
    function getAssignDate()
    {
        
        $diaid=$this->input->post('diagnoseid');
        $mgrid=$this->input->post('managerid');
        $delivery['d_view']=$this->diagnoses->getCalenderDetails($diaid,$mgrid);
        //echo "%%%<pre>";print_r($delivery);die;
       
        $results = array();
        
        foreach ($delivery['d_view'] as $k => $v) {
            $results[] = array("id"=>$v->id,"title" => "Booked", "start" => date("Y-m-d", strtotime($v->start_date)),"end" => date("Y-m-d", strtotime($v->end_date)));
            //echo "%%%<pre>";print_r($v);
        }//die;
        
        return $this->output->set_content_type('application/json')->set_output(json_encode($results));
    }
    
    public function viewCalender()
    {
        $this->template->build('viewCalender');
    }

    function user_call($order_id,$delivery_id,$ordertype=3) {
        $allValues = $this->deliveries->getAllTimeSlotsWithUsers($order_id,$delivery_id);
        $this->template->headingtitle="USER CALL SCREEN";
        $allValues['order_id']=$order_id;
        $allValues['delivery_id']=$delivery_id;
        $this->template->set_breadcrumb("My Dates",site_url("welcome/mydates"));
        //echo "<pre>";print_r($allValues);die;
        $this->template->build('user_call',array("frmdata"=>$allValues));
    }
    //now save call information
    function userCallNow($time_slot_id,$order_id,$delivery_id,$user_id) {
        
        if($this->input->post())
        {
            //$diagnosedata=array();
            $postalldata=$this->input->post();
            
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('comments', 'Comments', 'required');
            
             if ($this->form_validation->run() == false) 
             { 
                 $data["frm_data"]["frm_data"] = (object)$this->input->post();
             }
            else 
                {
            //echo "<pre>www";print_r($postalldata);die;
            //$this->deliveries->saveUserCallInformation($postalldata);
            $data = array(
                'time_slot_id'=>$postalldata['time_slot_id'],
                'order_id'=>$postalldata['order_id'],
                'delivery_id'=>$postalldata['delivery_id'],
                'user_id'=>$postalldata['user_id'],
                'comment'=>$postalldata['comments']
            );
            $lastId = $this->deliveries->saveCommentsByResource($data);
            //echo "<pre>";print_r($lastId);die;
            $this->messages->flash('Your comment has been save successfully.');
            redirect('delivery/userCallNow/'.$postalldata['time_slot_id']."/".$postalldata['order_id']."/".$postalldata['delivery_id']."/".$postalldata['user_id']); 
        } 
        }
        $getInfo = array(
                            'time_slot_id' =>$time_slot_id,
                            'order_id' =>$order_id,
                            'delivery_id' =>$delivery_id,
                            'user_id' =>$user_id
                        );
        $this->load->model('user/users');
        $allInformationofusers = $this->users->getUsersInfoById($user_id);
        //echo "<pre>";print_r($allInformationofusers);die;
        $getInfo['user_info']= (array)$allInformationofusers;
        $this->template->set_breadcrumb("My Dates",site_url("welcome/mydates/".$order_id."/".$delivery_id));
        $this->template->add_js("assests/itfeditor/ckeditor.js");
		$this->template->add_js(" $(document).ready(function(){
			CKEDITOR.replace('comments', {});
                });","B","embed");
        $this->template->build('user_call_now',array("frm_data"=>$getInfo));
    }
    function getUserHistory() {
        $user_id = $this->input->post('user_id');
        $result = array('success'=>$user_id);
        //die(json_encode($result));
       $alldata = (array)$this->deliveries->getUserHistory($user_id); 
       echo json_encode($alldata);die;
    }

    function getParticipantDetails($order_id,$delivery_id)
    {
        //$userid=$this->auth->getUserId();
        //echo $userid;die;
        $participantAllInfo=$this->deliveries->getParticipantDetails($order_id,$delivery_id);
//echo "<pre>";print_r($participantAllInfo);die;
        $this->template->headingtitle="PARTICIPANT DETAILS";
        $this->template->set_breadcrumb("MY BOOKING DATE",site_url("welcome/mydates"));
             $this->template->set_breadcrumb("PARTICIPANT DETAILS","");
        $this->template->build('participant_details',array('frmdata'=>$participantAllInfo));
    }
    function participantGoal($orderid,$deliveryid,$userid)
    {

        $participantGoals=$this->deliveries->participantGoal($deliveryid,$userid);
       //echo "<pre>";print_r($participantGoals);die;
        $this->template->headingtitle="PARTICIPANT GOAL";
        $this->template->set_breadcrumb("Participant Details",site_url("delivery/getParticipantDetails/".$orderid.'/'.$deliveryid.'/'.$userid));
        $this->template->set_breadcrumb("PARTICIPANT GOAL","");

        $this->template->build('participantGoal',array('frmdata'=>$participantGoals));
    }
    function addTodo($id='',$todoid='')
    {
        $data['id']=$id;
        $data['tdid']=$todoid;
       //echo $todoid.'ffdfd';
        //echo 'ranu'.$id;
        if ($this->input->post()) {
            
                $data = array(
                    'goal_id' => $id,
                    'todo' => $this->input->post('todo')
                );
                //echo "<pre>";print_r($data);die;
                if (empty($todoid)) {
                    //die('nnnn');
                $insert = $this->deliveries->addTodo($data);
                if (!empty($insert)) {
                    $this->messages->flash('Todo has been saved successfully');
                }
                redirect('delivery/toDoList/'.$id);
            } else {
                $data = array(
                    'goal_id' => $id,
                    'todo' => $this->input->post('todo')
                );
                $where['id'] = $todoid;
                //echo "<pre>";print_r($where);die;
                $update = $this->deliveries->addTodo($data, $where);
                if (!empty($update)) {
                    $this->messages->flash('Todo has been update successfully');
                }
                redirect('delivery/toDoList/'.$id);
            }
        }
      else{
      $data['view'] = $this->deliveries->getTodo($id,$todoid);
      //echo '<pre>';print_r($data);die;
      }
      if(empty($todoid))
       $this->template->headingtitle="ADD TO DO";
      else
          $this->template->headingtitle="UPDATE TO DO";
        $this->template->set_breadcrumb("TO DO LIST",site_url("delivery/toDoList/".$id));
         if(empty($todoid))
        $this->template->set_breadcrumb("ADD TO DO","");
         else 
             $this->template->set_breadcrumb("UPDATE TO DO","");
              $this->template->add_js("assests/itfeditor/ckeditor.js");
      $this->template->add_js(" $(document).ready(function(){
      CKEDITOR.replace('todo', {});
     

                });","B","embed");
      
        $this->template->build('addTodo',array('frm_data'=>$data));
    }
    function toDoList($id='')
    {
        $allIds=$this->deliveries->getOrderAndDeliveryId($id);
        //echo '<pre>';print_r($allIds);die;
        $orderid=  isset($allIds->order_id)?$allIds->order_id:'';
        $deliverid=  isset($allIds->delivery_id)?$allIds->delivery_id:'';
        $userid=  isset($allIds->user_id)?$allIds->user_id:'';
        $data['id']=$id;
        $data['tolist']=$this->deliveries->getTodoList($id);
        //echo '<pre>';print_r($data);die;
        $this->template->headingtitle="TO DO LIST";
        $this->template->set_breadcrumb("PARTICIPANT GOAL",site_url("delivery/participantGoal/".$orderid.'/'.$deliverid.'/'.$userid));
                
        $this->template->set_breadcrumb("TO DO LIST","");
        $this->template->build('toDoList',$data);
    }
}