<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends ITFS_Controller {

   public function __construct() 
    {
    $this->load->helper(array('form','url'));
    $this->load->library(array('form_validation','pagination'));
    //$this->load->model('deliveries');
    $this->load->model('product/products');
    $this->load->model('subproduct/subproducts');
         $this->load->model('delivery/deliveries'); 
     $this->load->model('diagnose/diagnoses'); 
         $this->load->model('casting_manager/casting_managers');
          $this->load->model('welcome/welcomes');  
          $this->load->model('user/users');  
        
    }
    public function index($id) 
    {//die($id);
            
        //$data['all']=$this->deliveries->showAllDelivery($id);
           
        $data['ids']=$id;
        //Filter Data
        $conditions = array();

        //if(isset($_POST["q"])) {
            //$this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
        //} 
        $searchfield=array();
        if(isset($_POST["q"])) {
            $searchfield = $_POST;
            //$this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
        } 

        //$searchfield = $this->session->userdata("SEARCHFIELD");
        if(count($searchfield)>0)
        $data["frm_data"] = $searchfield;


        //$conditions["where"] = array("user_type"=>'CM');
        if(isset($searchfield["q"]) and !empty($searchfield["q"])){
            $conditions["like"] = array("SB.name"=>$searchfield["q"],"DV.email_id"=>$searchfield["q"]); 
        }
    
        // End of Filter Data
            $totaldata=$this->deliveries->totalData($conditions,$id);
              
            $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('admin/delivery/index/'.$id);
            $config['total_rows'] =$totaldata;
            $config['per_page'] = 10;
            $config["uri_segment"]=5;

            $this->pagination->initialize($config);
            $page =$this->uri->segment(5)? $this->uri->segment(5):0;

            $data['all']=$this->deliveries->findUser($conditions,$config["per_page"],$page,$id);
             foreach($data['all'] as &$dt){
                $dt->statusdata = $this->diagnoses->checkAssignData($dt->order_id,$dt->id,3);
            }
            $data['link']=$this->pagination->create_links();
               //echo "##<pre>";print_r($data['all']);die;
             $this->template->headingtitle="DELIVERY LISTING";
             $this->template->set_breadcrumb("ORDER LISTING",site_url("admin/order"));
            $this->template->set_breadcrumb("DELIVERY LISTING","");
            //echo "<pre>";print_r($data);die;
            $this->template->build('admin_index',$data);
    }

     //assging time
    public function assingResource($orderid=0,$valueid=0){
        //die($orderid);
        $data = array();
        $data['orderid']=$orderid;
        $data['diaid']=$valueid;
        $data['castingmanager']=single_array($this->casting_managers->getcastingManagerForSelect(),'id','name');
        $data['selectedmangers']=array_keys(single_array($this->diagnoses->getCasting($valueid,3),'casting_manager'));
        //echo "<pre>";print_r($data);die;
        $getDataForCunsulting = $this->deliveries->getdeliveredDayInfo($valueid);
        $data['noofresources']=$getDataForCunsulting->cunsulting_days;
        $this->template->set_layout("ajax");
        $this->template->build('resoucemap',array('frmdata'=>$data));  
    }
    public function assingTimeUser($oid=0,$dvyid=0){
        $data['accepttime']=$this->deliveries->getUserAcceptTime($oid,$dvyid);
        
        $this->template->headingtitle="Time Slot By User";
        $this->template->set_breadcrumb("ORDER LISTING",site_url("admin/order"));
        $this->template->set_breadcrumb("DELIVERY LISTING",site_url("admin/delivery/index/".$oid));
        $this->template->set_breadcrumb("TIME SLOT ","");
        $this->template->build('user_booked_time',array('frmdata'=>$data));
    }
    public function setResouces(){
      if($this->input->post())
        {
            $orderId = $this->input->post('orderid');
            $casting_manager=$this->input->post('dnocasting');
            $valueid= $this->input->post('diagnoseid');
            $casts=array();  
                         foreach ($casting_manager as $key => $value) {
                           $casts[]=array('diagnose_id'=>$valueid,'casting_manager'=>$value,'type'=>3);
                        }
                        $deleteIds = array_keys(single_array($this->diagnoses->getCurrentExsitenceResourceId($valueid),'casting_manager'));
                        $this->diagnoses->addCasting($casts,array("diagnose_id"=>$valueid,'type'=>3));
                    }
        
        //sate del states in assing date table for break the relationship
        foreach($deleteIds as $resourceid){
            $this->diagnoses->setStatusInAssingDate($orderId,$valueid,$resourceid);
        }
        
        $orderId = $orderId>0?$this->input->post('orderid'):0;
        $this->messages->flash('Resource has been assinged successfully.');
        redirect('admin/delivery/index/'.$orderId);  
    }


    public function trfPopUp($oid="",$subproducts="", $user_id="", $id='')
    {
        //echo "<pre>##";print_r($id);die;
        $data=array();
        $data['order_id']=$oid;
        $data['diagnose_id']=$subproducts;
        $data['user_id']=$user_id;
        $data['resourceInfos']=$this->diagnoses->getResourceInfoById($id);
        $data['traveldata']=single_array($this->diagnoses->getTravel(),'id','name','Select Airlines');
        //echo "<pre>";print_r($data['resourceInfos']);die;
        $this->template->set_layout("ajax");
        $this->template->build('trf_pop_up',array('frm_data'=>$data));  

    } 
    public function saveTrfInfos()
    {
       $data=array();
       $postalldata=$this->input->post();
       //echo "<pre>";print_r($postalldata);die;
        if($this->input->post())
        {       
          if(empty($postalldata['ids']))
            {
                $assigndataid = $this->diagnoses->saveTrfInfo($postalldata);
                redirect("admin/delivery/trf/".$postalldata['order_id']."/".$postalldata['diagnose_id']."/".$postalldata['user_id']);
            }else{
                $assignd = $this->diagnoses->updateTrfInfo($postalldata,$postalldata['ids']);
                redirect("admin/delivery/trf/".$postalldata['order_id']."/".$postalldata['diagnose_id']."/".$postalldata['user_id']);
                }
        }

    }
   public function trf($oid="",$subproduct="", $user_id="")
    {
       //echo "<pre>";print_r($oid);die;
        $where['order_type']=3;
        $data=array();
        $data['allmanager'] =single_array($this->diagnoses->getAllManagers($subproduct,$where),'id','name','Select Resource');
        //$data['travelname'] =single_array($this->diagnoses->getAllManagers($digid),'id','name','Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($subproduct,$where);
        if($this->input->post())
        {       
            $postalldata=$this->input->post();
            //echo "<pre>";print_r($postalldata);die;
            $datainfo = explode(" ",$postalldata["daterange"]);
            $startdata = trim($datainfo[0]);
            $starttime = trim($datainfo[1]." ".$datainfo[2]);
            $enddata = trim($datainfo[4]);
            $endtime = trim($datainfo[5]." ".$datainfo[6]);
            
            $assigndata = array(
                            "order_id"=>$oid,
                            "diagnose_id"=>$postalldata["diagnose_id"],
                            "manager_id"=>$postalldata["manager"],
                            "start_date"=>$startdata,
                            "start_time"=>$starttime,
                            "end_date"=>$enddata,
                            "end_time"=>$endtime,
                            "order_type"=>3
                );
                    $this->load->library('email');
                    
                    //echo $link;die;
                    $allEmail = $this->orders->getSellerUserEmail($oid);
                    $AllemailInComma  = implode(",",$allEmail);
                    //$this->email->to($AllemailInComma);
                    $AllemailInComma = $postalldata['cast_email'].",".$AllemailInComma;
                    $this->email->to($AllemailInComma); 
                    //$this->email->to($postalldata['cast_email']);                
                    //$this->email->to('send2ranu@gmail.com');                
                    $this->email->from('info@maynardleighonline.in');
                    $this->email->set_mailtype("html");
                    $maildata = $this->mails->getMailById(3);
                    $link =site_url('user/resource_login');
                    //$startdatenew=date('m/d/Y h:i A',$startdate);
                    $information = array('name'=>$postalldata['cast_name'],'client'=>$postalldata['client_name'],'job'=>$postalldata['product_name'],'details'=>$postalldata['details'],
                                        'date'=>$postalldata['startdate']."-".$postalldata['enddate'],
                                        'time'=>$postalldata['starttime']."-".$postalldata['endtime'],
                                        'link'=>$link);
                    $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
                    $bodymessage = $this->messages->mailTemplate($datainfo);
                    $this->email->subject($maildata->mailsubject);
                    $this->email->message($bodymessage);
                    //echo "<pre>";print_r($this->email);die;
                    $this->email->send();
                    $this->email->clear();
            //echo "<pre>";print_r($assigndata);die;
            $assigndataid = $this->diagnoses->addAssignDate($assigndata);
            if(!empty($assigndataid))
                $this->messages->flash('Assign Date Successfully');
            redirect("admin/delivery/calender/".$oid."/".$subproduct);
        }
        $data['diagnose_id']=$subproduct;
        $data['odered_id']=$oid;
        $data['user_id']=$user_id;
        $data['start_end']=$this->diagnoses->getDiagnoseStartEndDate($subproduct);
        $data['headingtitle']=$this->template->headingtitle="TRAVEL REQUEST FORM";
        $this->template->set_breadcrumb("ORDER LISTING",site_url("admin/order"));
        $this->template->set_breadcrumb("DELIVERY LISTING",site_url("admin/delivery/index".'/'.$oid));
        $this->template->set_breadcrumb("TRAVEL LISTING ","");
        $this->template->build('trf',array('frmdata'=>$data));
    }




    
    public function form($id='',$subproduct='')
    {  

 
        //echo "333@@@<pre>";print_r($subproduct);die; 
        $data['product']=single_array($this->products->getProductsForSelect(3),'id','name','Select Product');;
        $data['subproducts']=single_array($this->subproducts->getSubProductsForSelect(),'id','name','Select Sub-Product');
        $data['castingmanager']=single_array($this->casting_managers->getCastingManagerForSelect(),'id','name');
        //$data['dlvproduct']=$this->products->getDeliyverProductsForSelect(3);

        
        
        //echo "@@@<pre>";print_r($data['product']);die;
        //$this->template->build('show_view',$data); 
        if($this->input->post())
        {
            
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                $this->form_validation->set_rules('dvproducts', 'Product Name', 'required');
                $this->form_validation->set_rules('dvweight', 'Weight.', 'required');
                //$this->form_validation->set_rules('intervaltime', 'Interval Time.', 'required');
                //$this->form_validation->set_rules('lunchstarttime', 'Lunch Start Time.', 'required');
                //$this->form_validation->set_rules('lunchendtime', 'Lunch End Time.', 'required');
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
                $this->form_validation->set_rules('dvcontact', 'Contact No', 'required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]');
                if ($this->form_validation->run() == false) 
                {
                    $data['subdelvid']=(object)array(
                                        'order_Id'=>$id,
                                        'products'=>$this->input->post('dvproducts'),
                                        'subproducts'=>$this->input->post('dsubproducts'),
                                        'intervaltime'=>$this->input->post('intervaltime'),
                                        'lunchstarttime'=>$this->input->post('lunchstarttime'),
                                        'lunchendtime'=>$this->input->post('lunchendtime'),
                                        'weight'=>$this->input->post('dvweight'),
                                        'units'=>$this->input->post('dvunits'),
                                        'pax'=>$this->input->post('dvpax'),
                                        'notconfirmed'=>$this->input->post('notconfirmed'),
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
                    $data['selecteddeliveredproduct']=$this->input->post('ddlvproducts');
                    //$data['selecteddeliveredproduct']
                    //echo "<pre>";print_r($data);die;
                }
                else 
                {
                    
                    if(empty($subproduct))
                    {
                        //die('fggyh');
                        $delivery['order_Id']=$id;
                        $delivery['products']=$this->input->post('dvproducts');
                        $delivery['subproducts']=$this->input->post('dsubproducts');
                        $delivery['lunchstarttime']=$this->input->post('lunchstarttime');
                        $delivery['lunchendtime']=$this->input->post('lunchendtime');
                        $delivery['intervaltime']=$this->input->post('intervaltime');
                        $delivery['notconfirmed']=$this->input->post('notconfirmed');
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
                        //$casting_manager=$this->input->post('dvnocasting');
                        $delivered=$this->input->post('ddlvproducts');
                        //echo "<pre>22222@@@@@@@@@@@";print_r($delivery);die;

                        $inserid=$this->deliveries->add_delivery($delivery);
                        //$selecteddeliveredproduct =  array();
                        // if(count($casting_manager)>1 && isset($casting_manager)) 
                        // {
                        //         //echo "<pre>22222@@@@@@@@@@@";print_r(count($casting_manager));die;
                        //     $casts=array();  
                        //     foreach ($casting_manager as $key => $value) 
                        //     {
                        //     $casts[]=array('diagnose_id'=>$inserid,'casting_manager'=>$value,'type'=>3);
                        //     }
                        //     $this->diagnoses->addCasting($casts,array("diagnose_id"=>$inserid,'type'=>3));
                        // }
                        if(count($delivered)>1 && isset($delivered)) 
                        {
                                //echo "<pre>22222@@@@@@@@@@@";print_r(count($casting_manager));die;
                            $deliv=array();  
                            foreach ($delivered as $key => $value) 
                            {
                            $deliv[]=array('delivery_id'=>$inserid,'delivery_pro_id'=>$value);
                            }
                            $this->diagnoses->addDeliveredProduct($deliv,array("delivery_id"=>$inserid));
                        }
                        if (!empty($inserid)) 
                           $this->messages->flash('Data has been inserted');
                        redirect('admin/delivery/index/'.$id);
                    }
               
            
                    else
                    {//die('vgvhu');
                        
                        $deliverydata=array();
                        //$data=$this->input->post();
                        $deliverydata=array(
                        'order_Id'=>$id,
                        'products'=>$this->input->post('dvproducts'),
                        'subproducts'=>$this->input->post('dsubproducts'),
                        'lunchstarttime'=>$this->input->post('lunchstarttime'),
                        'lunchendtime'=>$this->input->post('lunchendtime'),
                        'intervaltime'=>$this->input->post('intervaltime'),
                        'notconfirmed'=>$this->input->post('notconfirmed'),
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
                        // $casting_manager=array();
                        // $casting_manager=is_array($this->input->post('dvnocasting'))?$this->input->post('dvnocasting'):array();
                        $delivered=array();
                        $delivered=is_array($this->input->post('ddlvproducts'))?$this->input->post('ddlvproducts'):array();
                        //echo "<pre>";print_r(count($casting_manager));die;
                        $updata=$this->deliveries->update_Delivery($deliverydata,$subproduct,$id);
                        
                        
                        //echo "<pre>55555cx";var_dump($casting_manager);die;
                        //if(!empty($casting_manager) && isset($casting_manager) || count($casting_manager)>1) {
                            //echo "@@@<pre>";print_r(count($casting_manager));die;
                        // $casts=array();

                        // foreach ($casting_manager as $key => $value) 
                        // {
                        //     $casts[]=array('diagnose_id'=>$subproduct,'casting_manager'=>$value,'type'=>3);
                        // }
                        // //die($subproduct);
                        // $this->diagnoses->addCasting($casts,array("diagnose_id"=>$subproduct,'type'=>3));
                    //}

                        $deliv=array();

                        foreach ($delivered as $key => $value) 
                        {
                            $deliv[]=array('delivery_id'=>$subproduct,'delivery_pro_id'=>$value);
                        }
                        //die($subproduct);
                        $this->diagnoses->addDeliveredProduct($deliv,array("delivery_id"=>$subproduct));
            
                        if($updata==1)
                        {
                            $this->messages->flash('Data Updated Successfully');
                        }
                        redirect('admin/delivery/index/'.$id);
                    }
                }
            }
            else
            {
                if(!empty($subproduct)){
                    $selecteProductId = $this->deliveries->getSelectedProductId($subproduct);
                    $selecteProductId=$selecteProductId->subproducts;
                    $allProductsSelectOption =(single_array($this->products->getDeliyverProductsForSelect($selecteProductId),'id','name'));
                    //echo "<pre>chill@@";print_r($allProductsSelectOption);die;
                    $data['allProductsSelectOption'] = $allProductsSelectOption;
                }
                $data['subdelvid']=$this->deliveries->getSubdelevaryById($id,$subproduct);
                
                $data['selectedmangers']=array_keys(single_array($this->diagnoses->getCasting($subproduct,3),'casting_manager'));
                $data['selecteddeliveredproduct']=array_keys(single_array($this->diagnoses->getDeliveredPro($subproduct),'delivery_pro_id'));
                //echo "@@@!!<pre>";print_r($data['selecteddeliveredproduct']);die;
                //die('dsfedf');
                //echo "<pre>111";print_r();die;
                // $data['parrentid']=$id;
                //$this->template->add_js($modalViewi, "B", "embed");
            }
            //echo "<pre>111";print_r($data['selecteddeliveredproduct']);die;
            if(empty($subproduct))
            $this->template->headingtitle="ADD DELIVERY";
        else
            $this->template->headingtitle="Update DELIVERY";
            $this->template->set_breadcrumb("DELIVERY LISTING",site_url("admin/delivery/index/".$id));
            $this->template->set_breadcrumb("ADD DELIVERY","");
            //echo "<pre>";print_r($data);die;
            $this->template->build('admin_form',array("frmdata"=>$data));
    }
    // public function userForm($oid='',$dlvid='',$id='')
    // {
    //             if($this->input->post())
    //             {
    //                 if(empty($id))
    //                 {
                        
    //                     $userform['products']=$this->input->post('dvproducts');
    //                     $userform['subproducts']=$this->input->post('dsubproducts');
    //                     $userform['weight']=$this->input->post('dvweight');
    //                     $userform['units']=$this->input->post('dvunits');
    //                     $userform['pax']=$this->input->post('dvpax');
    //                     $userform['no_ofdays']=$this->input->post('dvnoofdays');
    //                     $userform['cunsulting_days']=$this->input->post('dvcunsulting');
    //                     $userform['start_date']=$this->input->post('dvstartdate');
    //                     $userform['end_date']=$this->input->post('dvenddate');
    //                     $userform['location']=$this->input->post('dvlocation');
    //                     $userform['price_unit']=$this->input->post('dvpriceandunit');
    //                     $userform['coordinator']=$this->input->post('dvcoordinator');
    //                     $userform['email_id']=$this->input->post('dvemail');
    //                     $userform['contact']=$this->input->post('dvcontact');

    //                 }
               
            
    //                 else
    //                 {
    //                     $deliverydata=array();
    //                     $deliverydata=array(
    //                     'order_Id'=>$id,
    //                     'products'=>$this->input->post('dvproducts'),
    //                     'subproducts'=>$this->input->post('dsubproducts'),
    //                     'weight'=>$this->input->post('dvweight'),
    //                     'units'=>$this->input->post('dvunits'),
    //                     'pax'=>$this->input->post('dvpax'),
    //                     'no_ofdays'=>$this->input->post('dvnoofdays'),
    //                     'cunsulting_days'=>$this->input->post('dvcunsulting'),
    //                     'start_date'=>$this->input->post('dvstartdate'),
    //                     'end_date'=>$this->input->post('dvenddate'),
    //                     'location'=>$this->input->post('dvlocation'),
    //                     'price_unit'=>$this->input->post('dvpriceandunit'),
    //                     'coordinator'=>$this->input->post('dvcoordinator'),
    //                     'email_id'=>$this->input->post('dvemail'),
    //                     'contact'=>$this->input->post('dvcontact')
    //                     );
                      

                        
    //                 }
    //             }
    //             $this->template->build('user_form')
                
    // }
    public function getPriceByAjax()
    {
        //$this->load->model('product/products');
        //$type['product_type']=3;
        $ids=$this->input->post('ids');
  
        $data['proprice']=$this->products->getProductPrice($ids);
        $data['delivered']=$this->products->getDeliyverProductsForSelect($ids);
        //echo "@@@<pre>";print_r($data);die;
            echo json_encode(array('totalprice'=>$data));
    }
    public function getProductByAjax()
    {
            $ids=$this->input->post('ids');
            $results=$this->deliveries->getSubProducts($ids);
//echo "<pre>";print_r($results);die;
            return $this->output->set_content_type('application/json')->set_output(json_encode($results));
            //echo "<pre>";print_r($ids);die;
    }
    
    public  function delete($id='',$oid='')
    {
      
        $delete=$this->deliveries->deletedata($id,$oid);
        if($delete==1)
            $this->messages->flash("Data Deleted Successfully");
       redirect('admin/delivery/index/'.$id);
    }
    public function details($id)
    {//die($id);
        $data['delview']=$this->deliveries->showDeliveryDetails($id);

        //echo "<pre>";print_r($data);die;
        $this->template->build('show_detail',$data);
    }
    public function calender($oid="",$dvyid="",$resourceid='')
    {
        $where['order_type']=3;
        $data['allmanager'] = single_array($this->diagnoses->getAllManagers($dvyid,$where),'id','name','Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($dvyid,$where);
        //echo "<pre>";print_r($data);die;
        
        if($this->input->post())
        {
            //$diagnosedata=array();
            $postalldata=$this->input->post();
            //echo "<pre>";print_r($postalldata);die;
            $datainfo = explode(" ",$postalldata["daterange"]);
            $tstartdatetime=strtotime($datainfo[0].' '.$datainfo[1]." ".$datainfo[2]);
            $tenddatetime=strtotime($datainfo[4].' '.$datainfo[5]." ".$datainfo[6]);
            $startdata = trim($datainfo[0]);
            $starttime = trim($datainfo[1]." ".$datainfo[2]);
            $enddata = trim($datainfo[4]);
            $endtime = trim($datainfo[5]." ".$datainfo[6]);
            
            $assigndata = array(
                            "order_id"=>$oid,
                            "diagnose_id"=>$postalldata["diagnose_id"],
                            "manager_id"=>$postalldata["manager"],
                            "start_date"=>$startdata,
                            "start_time"=>$starttime,
                            "end_date"=>$enddata,
                            "end_time"=>$endtime,
                            "tstartdatetime"=>$tstartdatetime,
                            "tenddatetime"=>$tenddatetime,
                            "order_type"=>3
                );
                   $this->load->library('email');
                    
                    //echo $link;die;
                    $mgid=$this->input->post('manager');
                    $datetimerange=$this->input->post('daterange');
                    $datetime=explode('-', $datetimerange);
                    $startdttime=strtotime($datetime['0']);
                    $enddttime=strtotime($datetime['1']);
                    
                    $allEmail = $this->orders->getSellerUserEmail($oid);
                    $AllemailInComma  = implode(",",$allEmail);
                    //$this->email->to($AllemailInComma);
                    $AllemailInComma = $postalldata['cast_email'].",".$AllemailInComma;
                    //get email address and name of resource
                    $AllInfoOfUser = $this->users->getUsersInfoById($postalldata["manager"]);
                    $this->email->to($AllInfoOfUser->email);
                    
                    $this->email->from('info@maynardleighonline.in');
                    $this->email->set_mailtype("html");
                    $maildata = $this->mails->getMailById(3);
                    $link =site_url('user/resource_login');
                    if(date("jS F, Y",$startdttime)==date("jS F, Y",$enddttime)){
                        $datevalue = date("jS F, Y",$startdttime); 
                    }else{
                       $datevalue = date("jS F, Y",$startdttime)."-".date("jS F, Y",$enddttime);  
                    }
                    
                    $information = array('name'=>$AllInfoOfUser->name,'client'=>$postalldata['client_name'],'job'=>$postalldata['product_name'],'subproduct'=>$postalldata['subpro'],'location'=>$postalldata['location'],
                                        'date'=>$datevalue,
                                        'time'=>date("h:i:s A",$startdttime)."-".date("h:i:s A",$enddttime),
                                        'link'=>$link);
                    $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
                    $bodymessage = $this->messages->mailTemplate($datainfo);
                    $this->email->subject($maildata->mailsubject);
                    $this->email->message($bodymessage);
                    //echo "<pre>";print_r($this->email);die;
                    $this->email->send();
                    $this->email->clear();
                    //echo "<pre>";print_r($assigndata);die;
                
                //$managerstartdate=$this->diagnoses->getStartDateEndDate($mgid);
                $datas=$this->diagnoses->checkRestrictedDateTime($startdttime,$enddttime,$mgid);
                //echo "@@<pre>";print_r(count($datas));die;
            if($datas)
            {
                $this->messages->flash('Resource is busy on this date','error');
            }
            else{
                    $assigndataid = $this->diagnoses->addAssignDate($assigndata);
                    if(!empty($assigndataid))
                        $this->messages->flash('Assigned Date Successfully');
            }
            $user_id=isset($postalldata["manager"])&&(!empty($postalldata["manager"]))?$postalldata["manager"]:0;
            redirect("admin/delivery/calender/".$oid."/".$dvyid."/".$user_id);
        }
        
        $data['diagnose_id']=$dvyid;
        $data['start_end']=$this->deliveries->getDeliveryStartEndDate($dvyid);
        $data['selectedResource'] = $resourceid>0?$resourceid:0;
        $this->template->headingtitle="Assign Date Resources";
        $this->template->set_breadcrumb("ORDER LISTING",site_url("admin/order"));
        $this->template->set_breadcrumb("DELIVERY LISTING",site_url("admin/delivery/index/".$oid));
        $this->template->set_breadcrumb("ASSIGN DATE ","");
        //echo "111<pre>";print_r($data);die;
        $this->template->build('calender',array('frmdata'=>$data));
    }
    function getAssignDate()
    {
        
        $diaid=$this->input->post('diagnoseid');
        $mgrid=$this->input->post('managerid');
        $delivery['d_view']=$this->diagnoses->getCalenderDetails($diaid,$mgrid);
        //echo "%%%<pre>";print_r($delivery);die;
       
        $results = array();
        $comment = '';
        $statusArray = array(0=>'Awaiting',1=>'Accepted',2=>'Rejected');
        foreach ($delivery['d_view'] as $k => $v)  {
            if($v->status == '2'){
               $comment = $v->comment;

            }

        
        
            $results[] = array("id"=>$v->id,
                "title" => "Booked"." ".$v->start_time."-".$v->end_time,
                "statusvalue" => $statusArray[$v->status],
                "comments" => $comment, "className" => 'eventColor'.$statusArray[$v->status],
                "start" => date("Y-m-d", strtotime($v->start_date)),
                "end" => date("Y-m-d", strtotime($v->end_date." +1 day")));
            //echo "%%%<pre>";print_r($v);
        }//die;
        
        return $this->output->set_content_type('application/json')->set_output(json_encode($results));
    }
    
    public function viewCalender()
    {
        $this->template->build('viewCalender');
    }
    public function mailTravelRequestForm()
    {//die('fvrfvrv');
        $this->load->library('email');
        $this->load->library("IMpdf","impdf");

        $data=array();
        $data['order_id']=$this->input->post('oid');
        $data['diagnose_id']=$this->input->post('digid');
        $data['user_id']=$this->input->post('user_id'); 
        $id['id']=$this->input->post('id'); 
          $email=$this->input->post('email'); 
        //echo "<pre>";print_r($id);die;
        //$data['resourceInfos']=$this->diagnoses->getResourcesById($data,$id);      
        $data['userDetails']=$this->diagnoses->getdetailsById($data['user_id']);    
        
        
        //$data['userDetails']=$this->diagnoses->getdetailsById($data['user_id']);
        
        
        
        $data['resourceInfos']=$this->diagnoses->getTRFById($id['id']);      
        $this->load->model('order/orders');
        $data['diagnose_detail']=$this->diagnoses->getDiagnosesInforationById($data['diagnose_id'],'delivery');      
       
        $whereArray = array('O.id'=>$data['order_id']);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray);
        
        $data['allmode'][] = $data['resourceInfos'];
    // echo "<pre>";print_r($data);die;
        //PDF Generate
        $datainfo= $this->load->view("diagnose/mail/pdfresource",$data,true);
        //echo "<pre>";print_r($datainfo);die;
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH."upload/resourcepdf/SIXRES".time().".pdf";
        $this->impdf->mpdf->Output($fullpath);
        
     // echo "<pre>";print_r($email);die;
        
        //$this->email->to($data['userDetails']->email);    
         //$this->email->to($data['userDetails']->email); 
        $allEmail = $this->orders->getSellerUserEmail($data['order_id']);
        $AllemailInComma  = implode(",",$allEmail);
        //$this->email->to($AllemailInComma);
        $AllemailInComma = $email.",".$AllemailInComma;
        
        //$this->email->to($email);                
        $this->email->to($AllemailInComma);
        //$this->email->to($email);                  
        $this->email->from('info@maynardleighonline.in');
        $this->email->set_mailtype("html");
       // $maildata = $this->mails->getMailById(3);
       // $information = array('name'=>$data['userDetails']->name,'contact'=>$data['userDetails']->contact_no);
       // $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
       // $bodymessage = $this->messages->mailTemplate($datainfo);
        $bodymessage = $this->load->view("diagnose/mail/pdfresource",array("frmdata"=>$data),true);
        $this->email->subject("Maynardeleigh || Your Travel Request Form" );
       // $this->email->subject($maildata->mailsubject);
        $this->email->message($bodymessage);
        $this->email->attach($fullpath);
       // echo "<pre>";print_r($this->email);die;
        $status=$this->email->send();
        $this->email->clear(); 
          if($status)
        {
        $this->messages->flash("Your message has been sent");
        }
   redirect("admin/delivery/trf/".$data['order_id']."/".$data['diagnose_id']);
    }

    public function mailVenderRequestForm($oid="",$digid="", $user_id="")
    {//die('hcgdyuchduhfc');
        $this->load->library('email');
        $this->load->library("IMpdf","impdf");

        $data=array();
        $data['order_id']=$oid;
        $data['diagnose_id']=$digid;
        $data['user_id']=$user_id;  
        $this->load->model('order/orders');
        //$data['resourceInfos']=$this->diagnoses->getResourcesById($data);      
        //$data['userDetails']=$this->diagnoses->getdetailsById($user_id); 
        
        
        $data['resourceInfos']=$this->diagnoses->getResourcesById($data);      
        $data['userDetails']=$this->diagnoses->getdetailsById($user_id); 
        $data['diagnose_detail']=$this->diagnoses->getDiagnosesInforationById($digid,'delivery'); 
        $whereArray = array('O.id'=>$oid);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray);
       
        //echo "<pre>pds".$data['userDetails']->email;die;
        //PDF Generate
        //echo "<pre>12345";print_r($data);die;
        $allDataByMode =  array();
        foreach($data['resourceInfos'] as $traindata){
           $allDataByMode[$traindata->mode][] = $traindata;
        }
        $data['allmode'] = $allDataByMode;
        $datainfo= $this->load->view("diagnose/mail/pdfresources_new",$data,true);
        //echo "<pre>";print_r($datainfo);die;
        //PDF Generate
        
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH."upload/resourcepdf/SIXRES".time().".pdf";
        $this->impdf->mpdf->Output($fullpath);
        
       //echo "<pre>";print_r($data);die;
        
        //$this->email->to('kanika@maynardeleigh.in');                
        $this->email->to($data['userDetails']->email); 
        $this->email->set_mailtype("html");
       // $maildata = $this->mails->getMailById(3);
       // $information = array('name'=>$data['userDetails']->name,'contact'=>$data['userDetails']->contact_no);
       // $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
       // $bodymessage = $this->messages->mailTemplate($datainfo);
        $bodymessage = $this->load->view("diagnose/mail/pdfresource",array("frmdata"=>$data),true);
        $this->email->subject("Maynardeleigh || Your Travel Request Form" );
       // $this->email->subject($maildata->mailsubject);
        $this->email->message($bodymessage);
        $this->email->attach($fullpath);
        //echo "<pre>";print_r($this->email);die;
        $this->email->send();
        $this->email->clear(); 
        $this->messages->flash("Your message has been sent");

    redirect("admin/delivery/trf/".$oid."/".$digid.'/'.$user_id);
    }
    function mailTravelRequestFormNew($oid="",$digid="", $user_id="",$id='')
    {
        //die('zczdc');
        //echo $user_id;die;
         $this->template->set_layout("ajax");
         $data['where']=array('oid'=>$oid,'digid'=>$digid,'user_id'=>$user_id,'id'=>$id);
        //print_r($data);die;
        $this->template->build('mailform',$data);  
    }
    public function downloadTRForm($oid="",$digid="", $user_id="")
    {
        $this->load->library('email');
        $this->load->library("IMpdf","impdf");

        $data=array();
        $data['order_id']=$oid;
        $data['diagnose_id']=$digid;
        $data['user_id']=$user_id;       
        $data['resourceInfos']=$this->diagnoses->getResourcesById($data);      
        $data['userDetails']=$this->diagnoses->getdetailsById($oid);      
        //echo "####<pre>";print_r($data['userDetails']);die;
        
        //PDF Generate
        $datainfo= $this->load->view("diagnose/mail/pdfresource",$data,true);
    //echo "<pre>";print_r($datainfo);die;
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH."upload/resourcepdf/SIXRES".time().".pdf";
        $displaypdf=$this->impdf->mpdf->Output($fullpath);

        $filename=explode('/', $fullpath);
       
            $filename = $filename[9];

            header('Content-type: application/pdf');
          // header('Cache-Control: public'); // needed for i.e.
            //header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
            header("Content-Type: application/force-download");
            header('Content-Transfer-Encoding: binary');
            header("Connection: close");
            readfile($fullpath);

        redirect($downloadtrfs,'refresh');
  
            $this->template->build('diagnose/mail/pdfresource',$data); 
    }
    function excelEmport($oid='',$dlvid='')
    {
      //die('dfsdsfsd');

         $this->load->library('Excel');
         $this->load->library('upload');
         //die("asdf");
          if($_FILES['tmpdocuments'])
            {   
                $config['upload_path'] = PUBLIC_UPLOADPATH."importusers/";
                $config['allowed_types'] = 'xlsx';
                $config['max_size'] = '20000000';
                $config['max_width'] = '2024';
                $config['max_height'] = '2024';
                $this->load->library('upload');
                $this->upload->initialize($config);
                
                $result=$this->upload->do_upload('tmpdocuments');
                if($result>=1) 
                {
                    $imageinfo = $this->upload->data();
                   
                     $filename = $imageinfo['full_path'];
  
                     $objPHPExcel = PHPExcel_IOFactory::load($filename);
                     
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                    $failed=0;
                    $success=0;
                    $id=array();
                    foreach ($allDataInSheet as $key => $value) {
                        //echo "<pre>";print_r($)
                        if($key<4)
                            continue;
                        $userdata=array();
                        $userdata['name']=$value['B'];
                        $userdata['contact_no']=$value['C'];
                        $userdata['age']=$value['D'];
                        $userdata['department']=$value['E'];
                        $userdata['designation']=$value['F'];
                        $userdata['reporting_to']=$value['G'];
                        $userdata['area_of_responsibility']=$value['H'];
                        $userdata['yrs_at_ey']=$value['I'];
                        $userdata['total_experience']=$value['J'];
                        $userdata['qualification']=$value['K'];
                        $userdata['training_attended_in_the_past']=$value['L'];
                        $userdata['previous_employer']=$value['M'];
                        $userdata['email']=$value['N'];
                        $userdata['password']=123456;
                        $userdata['user_type']='N';
                        //echo "$$$@@@@<pre>";print_r($userdata);die;
                        $usermapdata=array();
                        if(isset($userdata['email']))
                        { 
                            $email=$userdata['email'];
                            //echo  $email;die;
                            $id=array_keys(single_array($this->users->isUserExist($email),'id'));
                            //echo'<pre>'; print_r($id);die;
                            //$lastinsertedId=array();
                            $lastinsertedId[]= $this->users->addUsers($userdata);
                            if($lastinsertedId)
                                    $this->messages->flash('Data inserted successfully');
                            //     $success++;
                            // if($id)
                            //     $failed++;
                        }
                        $user_id = array_merge($id, $lastinsertedId);
                        //echo "###<pre>";print_r($user_id);die;
                        
                        
                     }//echo "#####<pre>";print_r($user_id);die;
                        foreach ($user_id as $key => $value) {
                            
                        $usermapdata['order_id']=$oid;
                        $usermapdata['delivery_id']=$dlvid;
                        $usermapdata['user_id']=$value;

                        $this->users->addUsersmap($usermapdata);
                    }
                }
                else{

                    $data["error_msg"]= $this->upload->display_errors('<span>','</span>');
                    return false;
                }
                   //echo "##<pre>";print_r($lastinsertedId);die;
            }
            //echo "##<pre>";print_r($lastinsertedId);die;
            if($this->input->post('submit')){
                //die('ghvh');
            $data['showuserdata']=$this->users->showAllUsersForCalling($lastinsertedId);
            //echo "####<pre>";print_r($data);die;
        }
            
        //$data['headingtitle']="Front user Listing ";
        $this->template->headingtitle="User LISTING";
        $this->template->set_breadcrumb("user Listing","");
        $this->template->build('admin_index_excel_import',array('frmdata'=>$data));
    }
    //assging time
    public function assignUser($orderid=0,$dlvid=0){
        //die($orderid);
        $data = array();
        $data['orderid']=$orderid;
        $data['diaid']=$dlvid;
        $data['assignuser']=single_array($this->users->getcallingUserForSelect(),'id','name');
        $data['selectedmangers']=array_keys(single_array($this->diagnoses->getCasting($dlvid,1),'casting_manager'));
        $this->template->set_layout("ajax");
       $this->template->build('usermap',array('frmdata'=>$data));  
    }
       function trfAllDetails($oid='',$did='',$uid='',$id='')
          {
            //echo "<pre>";print_r($oid.''.$did.''.$uid.''.$id);die;
            $where=array('oid'=>$oid,'did'=>$did,'uid'=>$uid,'id'=>$id);
           // echo "<pre>";print_r($where);die;
                $data['record']=(array)$this->deliveries->trfAllRecords($where);
                if($data['record']['mode']=='Hotel')
                {
                    $data['headingtitle']='Hotel Details';
                    $this->template->build('sub_records',$data);
                }else if($data['record']['mode']=='train')
                {
                    $data['headingtitle']='Train Details';
                $this->template->build('sub_records_train',$data);
                }else if($data['record']['mode']=='cab')
                {
                          $data['headingtitle']='cab details';
                    $this->template->build('sub_records_cab',$data);
                }

                else{
                          $data['headingtitle']='air details';
                  $this->template->build('sub_records_air',$data);
                }
          //    echo "<pre>controller";print_r($data);die;

            //
          } 

}
