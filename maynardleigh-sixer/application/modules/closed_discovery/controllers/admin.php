<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends ITFS_Controller {

   public function __construct() 
    {
    $this->load->helper(array('form','url'));
    $this->load->library(array('form_validation','pagination'));
    $this->load->model('discoveries');
      $this->load->model('product/products');
      $this->load->model('subproduct/subproducts');
        $this->load->model('casting_manager/casting_managers');
        $this->load->model('diagnose/diagnoses');
        $this->load->model('welcome/welcomes');
    }
    
    public function index($id) {
            
            $data['all']=$this->discoveries->showAllDiscovery($id);
            $data['ids']=$id;
            //Filter Data
        $conditions = array();

//        if(isset($_POST["q"])) {
//            $this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
//        } 
//
//        $searchfield = $this->session->userdata("SEARCHFIELD");
        $searchfield=array();
        if(isset($_POST["q"])) {
            $searchfield = $_POST;
            //$this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
        } 

        if(count($searchfield)>0)
        $data["frm_data"] = $searchfield;


        //$conditions["where"] = array("user_type"=>'CM');
        if(isset($searchfield["q"]) and !empty($searchfield["q"])){
            $conditions["like"] = array("SB.name"=>$searchfield["q"],"DIS.email_id"=>$searchfield["q"]); 
        }
    
        // End of Filter Data
            $totaldata=$this->discoveries->totalData($conditions,$id);
                //echo "##<pre>";print_r($totaldata);die;
            $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('admin/discovery/index/'.$id);
            $config['total_rows'] =$totaldata;
            $config['per_page'] = 10;
            $config["uri_segment"]=5;

            $this->pagination->initialize($config);
            $page =$this->uri->segment(5)? $this->uri->segment(5):0;

            $data['all']=$this->discoveries->findUser($conditions,$config["per_page"],$page,$id);
            foreach($data['all'] as &$dt){
                $dt->statusdata = $this->diagnoses->checkAssignData($dt->order_id,$dt->id,4);
            }
            $data['link']=$this->pagination->create_links();
            $this->template->headingtitle="DISCOVERY LISTING";
            $this->template->set_breadcrumb("ORDER LISTING",site_url("admin/order"));
            $this->template->set_breadcrumb("DISCOVERY LISTING","");
            //echo "<pre>";print_r($data);die;
            $this->template->build('admin_index',$data);
        
        
           }


    public function trfPopUp($oid="",$subproduct="", $user_id="", $id='')
    {
        //echo "<pre>##";print_r($id);die;
        $data=array();
        $data['order_id']=$oid;
        $data['diagnose_id']=$subproduct;
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
        if($this->input->post())
        {       
          if(empty($postalldata['ids']))
            {
                $assigndataid = $this->diagnoses->saveTrfInfo($postalldata);
                redirect("admin/discovery/trf/".$postalldata['order_id']."/".$postalldata['diagnose_id']."/".$postalldata['user_id']);
            }else{
                $assignd = $this->diagnoses->updateTrfInfo($postalldata,$postalldata['ids']);
                redirect("admin/discovery/trf/".$postalldata['order_id']."/".$postalldata['diagnose_id']."/".$postalldata['user_id']);
                }
        }

    }
   public function trf($oid="",$subproduct="", $user_id="")
    {
       //echo $subproduct;die;
        $where['order_type']=4;
        $data=array();
        $data['allmanager'] =single_array($this->diagnoses->getAllManagers($subproduct,$where),'id','name','Select Resource');
        //$data['travelname'] =single_array($this->diagnoses->getAllManagers($digid),'id','name','Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($subproduct,$where);
        //echo "@@<pre>";print_r($data['allmanager']);die;
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
                            "order_type"=>4
                );
                    $this->load->library('email');
                    
                    //echo $link;die;
                     //$this->email->to($data['userDetails']->email); 
                    $allEmail = $this->orders->getSellerUserEmail($oid);
                    $AllemailInComma  = implode(",",$allEmail);
                    //$this->email->to($AllemailInComma);
                    $AllemailInComma = $postalldata['cast_email'].",".$AllemailInComma;

                    //$this->email->to($email);                
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
            redirect("admin/design/calender/".$oid."/".$subproduct);
        }
        $data['diagnose_id']=$subproduct;
        $data['odered_id']=$oid;
        $data['user_id']=$user_id;
        $data['start_end']=$this->diagnoses->getDiagnoseStartEndDate($subproduct);
        $data['headingtitle']=$this->template->headingtitle="TRAVEL REQUEST FORM";

        $this->template->set_breadcrumb("ORDER LISTING",site_url("admin/order"));
        $this->template->set_breadcrumb("DISCOVERY LISTING",site_url("admin/discovery/index".'/'.$oid));
        $this->template->set_breadcrumb("TRAVEL LISTING ","");
        $this->template->build('trf',array('frmdata'=>$data));
    }
           

    

    public function form($id='',$subproduct='')
    {   
      
        $allProduct = array(''=>'Select Product')+single_array($this->products->getProductsForSelect(4),'id','name');
        $data['product']=$allProduct;
        $data['subproducts']=array(''=>'Select Sub-Product')+single_array($this->subproducts->getSubProductsForSelect(),'id','name');
        $data['castingmanager']=single_array($this->casting_managers->getCastingManagerForSelect(),'id','name');
        //echo "<pre>";print_r($data);die;
        if($this->input->post())
        {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                $this->form_validation->set_rules('dvyproducts', 'Product', 'required');
                $this->form_validation->set_rules('dsubproducts', 'Sub Product', 'required');
                $this->form_validation->set_rules('dvyweight', 'Weight.', 'required');
                $this->form_validation->set_rules('dvyunits', 'Units', 'required');
                $this->form_validation->set_rules('dvypax', 'Pax', 'required');
                $this->form_validation->set_rules('dvynoofdays', 'No of Days', 'required');
                $this->form_validation->set_rules('dvycunsulting', 'Cunsulting Days', 'required');
                $this->form_validation->set_rules('dvystartdate', 'Start Date', 'required');
                $this->form_validation->set_rules('dvyenddate', 'End Date', 'required');
                $this->form_validation->set_rules('dvylocation', 'Location', 'required');
                $this->form_validation->set_rules('dvypriceandunit', 'Price nd Units', 'required');
                //$this->form_validation->set_rules('dvycoordinator', 'Co Ordinator', 'required');
                //$this->form_validation->set_rules('dvyemail', 'Email', 'required');
                //$this->form_validation->set_rules('dvycontact', 'Contact No', 'required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]');
                if ($this->form_validation->run() == false) 
                {
                    $data['subdiscoveryid'] =(object)array(
                                                'order_Id'=>$id,
                                                'products'=>$this->input->post('dvyproducts'),
                                                'subproducts'=>$this->input->post('dsubproducts'),
                                                'weight'=>$this->input->post('dvyweight'),
                                                'units'=>$this->input->post('dvyunits'),
                                                'pax'=>$this->input->post('dvypax'),
                                                'no_ofdays'=>$this->input->post('dvynoofdays'),
                                                'cunsulting_days'=>$this->input->post('dvycunsulting'),
                                                'start_date'=>$this->input->post('dvystartdate'),
                                                'end_date'=>$this->input->post('dvyenddate'),
                                                'location'=>$this->input->post('dvylocation'),
                                                'price_unit'=>$this->input->post('dvypriceandunit'),
                                                //'coordinator'=>$this->input->post('dvycoordinator'),
                                                //'email_id'=>$this->input->post('dvyemail'),
                                                //'contact'=>$this->input->post('dvycontact'),
                                                'notconfirmed'=>$this->input->post('notconfirmed')
                                                );
                     $data['selectedmangers']=$this->input->post('dvynocasting');  
                     //echo "<pre>";print_r($data);die; 
                }
                else 
                {
                    if(empty($subproduct))
                    {
                        $discovery['order_Id']=$id;
                        $discovery['products']=$this->input->post('dvyproducts');
                        $discovery['subproducts']=$this->input->post('dsubproducts');
                        $discovery['weight']=$this->input->post('dvyweight');
                        $discovery['units']=$this->input->post('dvyunits');
                        $discovery['pax']=$this->input->post('dvypax');
                        $discovery['no_ofdays']=$this->input->post('dvynoofdays');
                        $discovery['cunsulting_days']=$this->input->post('dvycunsulting');
                        $discovery['start_date']=$this->input->post('dvystartdate');
                        $discovery['end_date']=$this->input->post('dvyenddate');
                        $discovery['location']=$this->input->post('dvylocation');
                        $discovery['price_unit']=$this->input->post('dvypriceandunit');
                        //$discovery['coordinator']=$this->input->post('dvycoordinator');
                        //$discovery['email_id']=$this->input->post('dvyemail');
                        //$discovery['contact']=$this->input->post('dvycontact');
                        $discovery['notconfirmed']=$this->input->post('notconfirmed');
                        //$casting_manager=$this->input->post('dvynocasting');
                        //echo "<pre>22222@@@@@@@@@@@";print_r($discovery);die;

                        $inserid=$this->discoveries->add_discovery($discovery);
                        // if(count($casting_manager)>1 && isset($casting_manager)) {
                        // $casts=array();  
                        // foreach ($casting_manager as $key => $value) 
                        // {
                        //     $casts[]=array('diagnose_id'=>$inserid,'casting_manager'=>$value,"type"=>4);
                        //     //
                        // }//echo "<pre>";print_r($casts);die;
                        // $this->diagnoses->addCasting($casts,array("diagnose_id"=>$inserid,'type'=>4));
                        // }
                        if (!empty($inserid)) 
                    $this->messages->flash('Data has been inserted');
                        redirect('admin/discovery/index/'.$id);
                    }
                    else
                    {
                        //echo "<pre>";print_r($_POST);die;
                        $discoverydata=array();
                        //$data=$this->input->post();
                        $discoverydata=array(
                        'order_Id'=>$id,
                        'products'=>$this->input->post('dvyproducts'),
                        'subproducts'=>$this->input->post('dsubproducts'),
                        'weight'=>$this->input->post('dvyweight'),
                        'units'=>$this->input->post('dvyunits'),
                        'pax'=>$this->input->post('dvypax'),
                        'no_ofdays'=>$this->input->post('dvynoofdays'),
                        'cunsulting_days'=>$this->input->post('dvycunsulting'),
                        'start_date'=>$this->input->post('dvystartdate'),
                        'end_date'=>$this->input->post('dvyenddate'),
                        'location'=>$this->input->post('dvylocation'),
                        'price_unit'=>$this->input->post('dvypriceandunit'),
                        //'coordinator'=>$this->input->post('dvycoordinator'),
                        //'email_id'=>$this->input->post('dvyemail'),
                        //'contact'=>$this->input->post('dvycontact'),
                        'notconfirmed'=>$this->input->post('notconfirmed')
                        );
                        //$casting_manager=$this->input->post('dvynocasting');
                        // $casting_manager=array();
                        // $casting_manager=is_array($this->input->post('dvynocasting'))?$this->input->post('dvynocasting'):array();
                        //echo "<pre>";print_r($discoverydata);
                        //echo "<pre>@@@".count($casting_manager);print_r($casting_manager);die;
                        $updata=$this->discoveries->update_Discovery($discoverydata,$subproduct,$id);
                        //echo "<pre>";print_r($designdata);die;
                        //if(!empty($casting_manager) && isset($casting_manager)) {
                            
                        // $casts=array();

                        // foreach ($casting_manager as $key => $value) 
                        // {

                        //     $casts[]=array('diagnose_id'=>$subproduct,'casting_manager'=>$value,'type'=>4);
                            
                        
                        // }//echo "##$!!!!<pre>";print_r($casts);die;
                        // $this->diagnoses->addCasting($casts,array("diagnose_id"=>$subproduct,'type'=>4));
                    //}
                        if($updata==1)
                        {
                            $this->messages->flash('Data Updated Successfully');
                        }
                        redirect('admin/discovery/index/'.$id);
                    }
                }
        }
        else
        {
            $data['subdiscoveryid']=$this->discoveries->getSubdiscoveryById($id,$subproduct);
            $data['selectedmangers']=array_keys(single_array($this->diagnoses->getCasting($subproduct,4),'casting_manager'));
            //echo "<pre>";print_r($data);die;
            //$this->template->add_js($modalViewi, "B", "embed");
        }
        if(empty($subproduct))
            $this->template->headingtitle="ADD DISCOVERY";
        else
            $this->template->headingtitle="Update DISCOVERY";
            $this->template->set_breadcrumb("DISCOVERY LISTING",site_url("admin/discovery/index/".$id));
            $this->template->set_breadcrumb("ADD DISCOVERY","");
            $this->template->build('admin_form',array("frmdata"=>$data));
    
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
   public function assingResource($orderid=0,$valueid=0){
        //die($orderid);
        $data = array();
        $data['orderid']=$orderid;
        $data['diaid']=$valueid;
        $data['castingmanager']=single_array($this->casting_managers->getcastingManagerForSelect(),'id','name');
        $data['selectedmangers']=array_keys(single_array($this->diagnoses->getCasting($valueid,4),'casting_manager'));
         $getDataForCunsulting = $this->discoveries->getdiscoveriesDayInfo($valueid);
        $data['noofresources']=$getDataForCunsulting->cunsulting_days;
        $this->template->set_layout("ajax");
       $this->template->build('resoucemap',array('frmdata'=>$data));  
    }
    public function setResouces(){
      if($this->input->post())
        {
            //die('hgfcvukgvihyu');
            $orderId = $this->input->post('orderid');
            $casting_manager=$this->input->post('dnocasting');
            $valueid= $this->input->post('diagnoseid');
            $casts=array();  
                         foreach ($casting_manager as $key => $value) {
                           $casts[]=array('diagnose_id'=>$valueid,'casting_manager'=>$value,'type'=>4);
                           //echo "<pre>";print_r($casts);
                        }//die;
                        $deleteIds = array_keys(single_array($this->diagnoses->getCurrentExsitenceResourceId($valueid),'casting_manager'));
                        $this->diagnoses->addCasting($casts,array("diagnose_id"=>$valueid,'type'=>4));
                    }
        
        //sate del states in assing date table for break the relationship
        foreach($deleteIds as $resourceid){
            $this->diagnoses->setStatusInAssingDate($orderId,$valueid,$resourceid);
        }
        
        $orderId = $orderId>0?$this->input->post('orderid'):0;
        $this->messages->flash('Resource has been assinged successfully.');
        redirect('admin/discovery/index/'.$orderId);  
    }
    

    public  function delete($id='',$oid='')
    {
            //$del=$this->input->post();
            $delete=$this->discoveries->deletedata($id,$oid);
            if($delete==1)
                        {
                            $this->messages->flash('Data Deleted Successfully');
                        }
        redirect('admin/discovery/index/'.$id);
    }
    public function details($id)
    {//die($id);
        $data['delview']=$this->discoveries->showDiscoveryDetails($id);

        //echo "<pre>";print_r($data);die;
        $this->template->build('show_detail',$data);
    }
    public function calender($oid="",$discoverid="",$resourceid='')
    {
        //$this->load->model("diagnoses");
       $where['order_type']=4;
        $data=array();
        $data['allmanager'] = single_array($this->diagnoses->getAllManagers($discoverid,$where),'id','name','Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($discoverid,$where);
        if($this->input->post())
        {
            //$diagnosedata=array();
            $postalldata=$this->input->post();
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
                            "order_type"=>4
                );
                    $this->load->library('email');
                    
                    //echo $link;die;
                    $allEmail = $this->orders->getSellerUserEmail($oid);
                    $AllemailInComma  = implode(",",$allEmail);
                    //$this->email->to($AllemailInComma);
                    $AllemailInComma = $postalldata['cast_email'].",".$AllemailInComma;
                    //$this->email->to($AllemailInComma);
                    //
                    // 
                    $AllInfoOfUser = $this->users->getUsersInfoById($postalldata["manager"]);
                    $this->email->to($AllInfoOfUser->email);
                    
                    
                    $datetimerange=$this->input->post('daterange');
                    $datetime=explode('-', $datetimerange);
                    $startdttime=strtotime($datetime['0']);
                    $enddttime=strtotime($datetime['1']);
                    
                    //$this->email->to($postalldata['cast_email']);                
                    //$this->email->to('send2ranu@gmail.com');                
                    $this->email->from('info@maynardleighonline.in');
                    $this->email->set_mailtype("html");
                    $maildata = $this->mails->getMailById(3);
                    $link =site_url('user/resource_login');
                    //$startdatenew=date('m/d/Y h:i A',$startdate);
//                    $information = array('name'=>$postalldata['cast_name'],'client'=>$postalldata['client_name'],'job'=>$postalldata['product_name'],'subproduct'=>$postalldata['subpro'],'location'=>$postalldata['location'],
//                                        'date'=>$postalldata['startdate']."-".$postalldata['enddate'],
//                                        'time'=>$postalldata['starttime']."-".$postalldata['endtime'],
//                                        'link'=>$link);
                    
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

                $mgid=$this->input->post('manager');
                $datetimerange=$this->input->post('daterange');
                $datetime=explode('-', $datetimerange);
                $startdttime=strtotime($datetime['0']);
                $enddttime=strtotime($datetime['1']);
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
            redirect("admin/discovery/calender/".$oid."/".$discoverid."/".$user_id);
        }
        
        $data['diagnose_id']=$discoverid;
        $data['start_end']=$this->discoveries->getDiscoveryStartEndDate($discoverid);
         $data['selectedResource'] = $resourceid>0?$resourceid:0; 
         $this->template->headingtitle="Assign Date Resources";

         $this->template->set_breadcrumb("ORDER LISTING",site_url("admin/order"));
        $this->template->set_breadcrumb("DISCOVERY LISTING",site_url("admin/discovery/index/".$oid));
        $this->template->set_breadcrumb("ASSIGN DATE ","");
        $this->template->build('calender',array('frmdata'=>$data));
    }
    function getAssignDate()
    {
        
        $diaid=$this->input->post('diagnoseid');
        $mgrid=$this->input->post('managerid');
        $discovery['d_view']=$this->diagnoses->getCalenderDetails($diaid,$mgrid);
        //echo "%%%<pre>";print_r($discovery);die;
       
        $results = array();
        $comment = '';
        $statusArray = array(0=>'Awaiting',1=>'Accepted',2=>'Rejected');
        foreach ($discovery['d_view'] as $k => $v)  {
            if($v->status == '2'){
               $comment = $v->comment;

            }

        
        
            $results[] = array("id"=>$v->id,
                "title" => "Booked"." ".$v->start_time."-".$v->end_time, 
                "statusvalue" => $statusArray[$v->status],
                "comments" => $comment,
                "className" => 'eventColor'.$statusArray[$v->status],
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
        $data['diagnose_detail']=$this->diagnoses->getDiagnosesInforationById($data['diagnose_id'],'discovery');      
       
        $whereArray = array('O.id'=>$data['order_id']);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray);
        
        $data['allmode'][] = $data['resourceInfos'];
    //  echo "<pre>";print_r($data);die;
        //PDF Generate
        $datainfo= $this->load->view("diagnose/mail/pdfresource",$data,true);
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH."upload/resourcepdf/SIXRES".time().".pdf";
        $this->impdf->mpdf->Output($fullpath);
        
      //  echo "<pre>";print_r($data);die;
        
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
        //echo $status;die;
        $this->email->clear(); 
        if($status)
        {
        $this->messages->flash("Your message has been sent");
        }
    redirect("admin/discovery/trf/".$data['order_id']."/".$data['diagnose_id']);
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

     public function mailVenderRequestForm($oid="",$digid="", $user_id="")
    {//die('hcgdyuchduhfc');
        $this->load->library('email');
        $this->load->library("IMpdf","impdf");
        $this->load->model('order/orders');
 //echo $user_id;die;
        $data=array();
        $data['order_id']=$oid;
        $data['diagnose_id']=$digid;
        $data['user_id']=$user_id;       
        $data['resourceInfos']=$this->diagnoses->getResourcesById($data);      
        $data['userDetails']=$this->diagnoses->getdetailsById($user_id); 
        $data['diagnose_detail']=$this->diagnoses->getDiagnosesInforationById($digid,'discovery'); 
        $whereArray = array('O.id'=>$oid);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray);
        //echo "<pre>pds".$data['userDetails']->email;die;
        $allDataByMode =  array();
        foreach($data['resourceInfos'] as $traindata){
           $allDataByMode[$traindata->mode][] = $traindata;
        }
        $data['allmode'] = $allDataByMode;
        //PDF Generate
        $datainfo= $this->load->view("diagnose/mail/pdfresources",$data,true);
        //echo "<pre>";print_r($datainfo);die;
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH."upload/resourcepdf/SIXRES".time().".pdf";
        $this->impdf->mpdf->Output($fullpath);
        
      //echo "<pre>";print_r($data);die;
        
        //$this->email->to('kanika@maynardeleigh.in'); 
        
        $allEmail = $this->orders->getSellerUserEmail($oid);
        $AllemailInComma  = implode(",",$allEmail);
        //$this->email->to($AllemailInComma);
        $AllemailInComma = $data['userDetails']->email.",".$AllemailInComma;
        $this->email->to($AllemailInComma);
        //$this->email->to($data['userDetails']->email);                
        $this->email->from('info@maynardleighonline.in');
        $this->email->set_mailtype("html");
       // $maildata = $this->mails->getMailById(3);
       // $information = array('name'=>$data['userDetails']->name,'contact'=>$data['userDetails']->contact_no);
       // $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
       // $bodymessage = $this->messages->mailTemplate($datainfo);
        $bodymessage = $this->load->view("diagnose/mail/pdfresources",array("frmdata"=>$data),true);
        $this->email->subject("Maynardeleigh || Your Travel Request Form" );
       // $this->email->subject($maildata->mailsubject);
        $this->email->message($bodymessage);
        $this->email->attach($fullpath);
        //echo "<pre>";print_r($this->email);die;
        $status=$this->email->send();
        $this->email->clear(); 
          if($status)
        {
        $this->messages->flash("Your message has been sent");
        }
    redirect("admin/discovery/trf/".$oid."/".$digid.'/'.$user_id);
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
       function trfAllDetails($oid='',$did='',$uid='',$id='')
          {
            //echo "<pre>";print_r($oid.''.$did.''.$uid.''.$id);die;
            $where=array('oid'=>$oid,'did'=>$did,'uid'=>$uid,'id'=>$id);
           // echo "<pre>";print_r($where);die;
                $data['record']=(array)$this->discoveries->trfAllRecords($where);
                 $this->template->set_breadcrumb("TRAVEL REQUEST FORM",site_url("admin/discovery/trf/".$where['oid'].'/'.$where['did']));
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
