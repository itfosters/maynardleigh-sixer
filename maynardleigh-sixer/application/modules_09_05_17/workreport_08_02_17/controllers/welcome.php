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
    }

    function index() 
    {
         $userid=$this->auth->getUserId();
        //echo "<pre>";print_r($userid);die;
    
        // End of Filter Data
        $totaldata=$this->welcomes->totalData($userid);
            echo "##<pre>";print_r($totaldata);die;
            $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('welcome/index');
            $config['total_rows'] =$totaldata;
            $config['per_page'] = 10;
            $config["uri_segment"]=4;

            $this->pagination->initialize($config);
            //echo $this->pagination->create_links();
            $page =$this->uri->segment(4)? $this->uri->segment(4):0;

            $data['alldata']=$this->orders->findUser($conditions,$config["per_page"],$page);

            foreach($data['alldata'] as &$dt){
                $dt->statusdata = $this->orders->checkAssignData($dt->id);
            }
            //echo "<pre>";print_r($data['alldata']);die;
            $data['links'] = $this->pagination->create_links();
            $this->template->headingtitle="ORDER LISTING";
            $this->template->build('my_order',$data);
    }
    
    public function accept_Request()
    { 
        //$data["id"]=$this->auth->getUserId();

        $this->template->build('accept_request');
    }
    public function assignAllDate(){
        $userid=$this->auth->getUserId();
        // $posteddata = $this->input->post();
        $results=$this->welcomes->getAssignDate($userid);
        //echo "##<pre>";print_r($results);die;
       foreach($results as &$data)
        {
            $data->title="Assign".$data->start_time."-".$data->end_time;
        }
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
        $this->load->model('users');
        $this->load->model('diagnose/diagnoses','diagnoses');
        $data=array();
        $userid=$this->auth->getUserId();
        $data['allairlines']=single_array($this->diagnoses->getTravel(),'id','name');
       //echo "<pre>1234";print_r($data['allairlines']);die;
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
             redirect('welcome/myinfo');
        }else{
            $data['myinfos']= $this->users->getMyInfo($userid);
        }
              //echo "<pre>1234";print_r($data['myinfos']);die;
        //}
        
        //Condition for without submit
       $this->template->build('myinfo',array('frmdata'=>$data));
    }
    public function details()
    {//die('ddddd');
        $userid=$this->auth->getUserId();
        //echo "<pre>";print_r($userid);die;
        $results=$this->welcomes->getOrderIdAssignTable($userid);
        //echo "<pre>";print_r($results->order_id);die;
        $alldocuments = single_array($this->documents->getDocumentsName(),'id','document_name');
        $data['document']=$alldocuments;
        $alltransports = single_array($this->transports->getTransportsName(),'id','trans_name');
        $data['transports']=$alltransports;
        $data["dtdoc"]=single_array($this->orders->getDocById($results->order_id),'document_id','file_name');
        $data["dttrans"]=single_array($this->orders->getTransById($results->order_id),'transport_id','value');
        $data['detail']=$this->orders->getOrderDetail(array("O.id"=>$results->order_id));
        $data['diagonoesdetail']=$this->diagnoses->getDiagonoesDetail($results->order_id);
        $data['diagonoesresources']=$this->diagnoses->getDiagonoesResources($results->order_id);
        $data['getdesigndetail']=$this->designs->getdesignDetail($results->order_id);
        $data['getdesignresources']=$this->designs->getDesignResources($results->order_id);
        $data['getdeliverydetail']=$this->deliveries->getdeliveryDetail($results->order_id);
        $data['getdeliveryresources']=$this->deliveries->getDeliveryResources($results->order_id);
        $data['getdiscoverydetail']=$this->discoveries->getdiscoveryDetail($results->order_id);
        $data['getdiscoveryresources']=$this->discoveries->getDiscoveryResources($results->order_id);
        //echo "<pre>";print_r($data);die;
        $this->template->headingtitle="Order Details";
        $this->template->set_breadcrumb("Order Listing",site_url("admin/order/index"));
        $this->template->set_breadcrumb("Order Details","");
        $this->template->build('show_details',array("frmdata"=>$data)); 
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
    public function mydates()
    {
        //$ordertype=2;
        $where['casting_id']=$this->auth->getUserId();
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
        //echo "<pre>11111#".$record->order_id;print_r($data['view']);die;
        //die;
        //echo "<pre>";print_r($data);die;
        $this->template->build('mydates',$data);
    }
    
     

   
}