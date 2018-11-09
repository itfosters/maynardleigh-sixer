<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends ITFS_Controller {

   public function __construct() 
    {
    $this->load->helper(array('form','url','html'));
    $this->load->library(array('form_validation','pagination'));
    $this->load->model('diagnoses');
     $this->load->model('casting_manager/casting_managers');
        $this->load->model('product/products');
        $this->load->model('subproduct/subproducts');
            $this->load->model('welcome/welcomes');
            $this->load->model('mail/mails');
    }
    public function index($id) {
        
        $data['assignuser']=$this->diagnoses->assignUser($id);
         $data['ids']=$id;
         //Filter Data
        $conditions = array();

//        if(isset($_POST["q"])) {
//            $this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
//        } 

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
            $conditions["like"] = array("SB.name"=>$searchfield["q"],"D.email_id"=>$searchfield["q"]);
            //echo "!!<pre>";print_r($conditions);die; 
        }
    
        // End of Filter Data
            $totaldata=$this->diagnoses->totalData($conditions,$id);
                //echo "##<pre>";print_r($totaldata);die;
            $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('admin/diagnose/index/'.$id);
            $config['total_rows'] =$totaldata;
            $config['per_page'] = 10;
            $config["uri_segment"]=5;

            $this->pagination->initialize($config);
            $page =$this->uri->segment(5)? $this->uri->segment(5):0;

            $data['all']=$this->diagnoses->findUser($conditions,$config["per_page"],$page,$id);
            foreach($data['all'] as &$dt){
                $dt->statusdata = $this->diagnoses->checkAssignData($dt->order_id,$dt->id);
            }
            // $this->load->model('order/orders','orders');
            // foreach($data['all'] as $singledata){
            //     $response  = $this->orders->checkAssignData($id);
            //     echo "##<pre>".$id;print_r($response);die;
            // }
            $data['link']=$this->pagination->create_links();

            //$data['all']=$this->diagnoses->showAllDiagnose($id);
            //echo "<pre>";print_r($data);die;
           
          //echo "<pre>";print_r($data);die;
            $this->template->headingtitle="DIAGNOSE LISTING";
            $this->template->set_breadcrumb("ORDER LISTING",site_url("admin/order"));
             $this->template->set_breadcrumb("DIAGNOSE LISTING ","");
           
         
            $this->template->build('admin_index',$data);
        
                
           }
           

    public function form($id='',$subproduct='')
    {   
            
            $data['product']=single_array($this->products->getProductsForSelect(1),'id','name','Select Product');
            $data['subproducts']=single_array($this->subproducts->getSubProductsForSelect(),'id','name','Select Sub-Product');
            $data['castingmanager']=single_array($this->casting_managers->getcastingManagerForSelect(),'id','name');
            //$data['castingemail']=single_array($this->casting_managers->getcastingManagerEmail(),'id','email');
            //echo "<pre>";print_r($data['castingmanager']);die;
            
       
            if($this->input->post())
            {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                $this->form_validation->set_rules('dproducts', 'Product Name', 'required');
                $this->form_validation->set_rules('dweight', 'Weight.', 'required');
                $this->form_validation->set_rules('dunits', 'Units', 'required');
                $this->form_validation->set_rules('dpax', 'Pax', 'required');
                $this->form_validation->set_rules('dcunsulting', 'Cunsulting Days', 'required');
                $this->form_validation->set_rules('dstartdate', 'Start Date', 'required');
                $this->form_validation->set_rules('denddate', 'End Date', 'required');
                $this->form_validation->set_rules('dlocation', 'Location', 'required');
                $this->form_validation->set_rules('dpriceandunit', 'Price nd Units', 'required');
                $this->form_validation->set_rules('dcoordinator', 'Co Ordinator', 'required');
                $this->form_validation->set_rules('demail', 'Email', 'required');
                $this->form_validation->set_rules('dcontact', 'Contact No', 'required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]');
                //$this->form_validation->set_rules('dnocasting', 'Casting', 'required');
                if ($this->form_validation->run() == false) {
                    $data['subdiagnoseid']=(object)array(
                                        'order_Id'=>$id,
                                        'products'=>$this->input->post('dproducts'),
                                        'subproducts'=>$this->input->post('dsubproducts'),
                                        'weight'=>$this->input->post('dweight'),
                                        'units'=>$this->input->post('dunits'),
                                        'pax'=>$this->input->post('dpax'),
                                        'no_ofdays'=>$this->input->post('dnoofdays'),
                                        'cunsulting_days'=>$this->input->post('dcunsulting'),
                                        'start_date'=>$this->input->post('dstartdate'),
                                        'end_date'=>$this->input->post('denddate'),
                                        'location'=>$this->input->post('dlocation'),
                                        'price_unit'=>$this->input->post('dpriceandunit'),
                                        'coordinator'=>$this->input->post('dcoordinator'),
                                        'email_id'=>$this->input->post('demail'),
                                        'contact'=>$this->input->post('dcontact'),
                                        'notconfirmed'=>$this->input->post('notconfirmed')                           
                                        );
                    $data['selectedmangers']=$this->input->post('dnocasting');
                    //echo "<pre>";print_r($data);die;
                }
                else 
                { 
                    //die($subproduct);
                if (empty($subproduct)) 
                {
                $diagnose['order_Id']=$id;
                $diagnose['products']=$this->input->post('dproducts');
                $diagnose['subproducts']=$this->input->post('dsubproducts');
                $diagnose['weight']=$this->input->post('dweight');
                $diagnose['units']=$this->input->post('dunits');
                $diagnose['pax']=$this->input->post('dpax');
                $diagnose['no_ofdays']=$this->input->post('dnoofdays');
                $diagnose['cunsulting_days']=$this->input->post('dcunsulting');
                $diagnose['start_date']=$this->input->post('dstartdate');
                $diagnose['end_date']=$this->input->post('denddate');
                $diagnose['location']=$this->input->post('dlocation');
                $diagnose['price_unit']=$this->input->post('dpriceandunit');
                $diagnose['coordinator']=$this->input->post('dcoordinator');
                $diagnose['email_id']=$this->input->post('demail');
                $diagnose['contact']=$this->input->post('dcontact');
                $diagnose['notconfirmed']=$this->input->post('notconfirmed');
                
                //$casting_manager=$this->input->post('dnocasting');
                //echo "<pre>22222@@@@@@@@@@@";print_r($diagnose)."<hr>";
                //echo "<pre>";print_r($casting_manager);die;
                $inserid=$this->diagnoses->add_Diagnose($diagnose);
                //echo "###<pre>";print_r($casting_manager);die;
      //           if(count($casting_manager)>1 && isset($casting_manager)) {
      //               //echo "###<pre>".count($casting_manager);print_r($casting_manager);die;
      //           $casts=array();  
                        //  foreach ($casting_manager as $key => $value) {
                        //    $casts[]=array('diagnose_id'=>$inserid,'casting_manager'=>$value);
                        // }
                        // $this->diagnoses->addCasting($casts,array("diagnose_id"=>$inserid));
      //               }
                        if (!empty($inserid)) 
                    $this->messages->flash('Diagnose information has been saved successfully.');
                redirect('admin/diagnose/index/'.$id);
            }
            else
            {  
                        $diagnosedata=array();
                        $data=$this->input->post();
                        $diagnosedata=array(
                                        'order_Id'=>$id,
                                        'products'=>$this->input->post('dproducts'),
                                        'subproducts'=>$this->input->post('dsubproducts'),
                                        'weight'=>$this->input->post('dweight'),
                                        'units'=>$this->input->post('dunits'),
                                        'pax'=>$this->input->post('dpax'),
                                        'no_ofdays'=>$this->input->post('dnoofdays'),
                                        'cunsulting_days'=>$this->input->post('dcunsulting'),
                                        'start_date'=>$this->input->post('dstartdate'),
                                        'end_date'=>$this->input->post('denddate'),
                                        'location'=>$this->input->post('dlocation'),
                                        'price_unit'=>$this->input->post('dpriceandunit'),
                                        'coordinator'=>$this->input->post('dcoordinator'),
                                        'email_id'=>$this->input->post('demail'),
                                        'contact'=>$this->input->post('dcontact'),
                                        'notconfirmed'=>$this->input->post('notconfirmed')
                                        );
                        //echo "<pre>";print_r($diagnosedata);die;
                        //$casting_manager=$this->input->post('dnocasting');
                        // $casting_manager=array();
                        // $casting_manager=is_array($this->input->post('dnocasting'))?$this->input->post('dnocasting'):array();
                        //echo "<pre>22222@@@@@@@@@@@";print_r($diagnosedata)."<hr>";
                        //echo "<pre>";print_r($casting_manager);die;
                        $updata=$this->diagnoses->update_Diagnose($diagnosedata,$subproduct,$id);
                        //echo "$$$$<pre>";print_r($updata);die;
                        
                        // $casts=array();
                              
                        //  foreach ($casting_manager as $key => $value) {
                        //    $casts[]=array('diagnose_id'=>$subproduct,'casting_manager'=>$value,'type'=>1);
                        // }
                        //  $this->diagnoses->addCasting($casts,array("diagnose_id"=>$subproduct,'type'=>1));
                         if($updata==1)
                        {
                            $this->messages->flash('Information Updated Successfully');
                        }
                        redirect('admin/diagnose/index/'.$id);
                    
                }
            }
        }
            else{
                $data['subdiagnoseid']=$this->diagnoses->getSubdiagnoseById($id,$subproduct);
                $data['selectedmangers']=array_keys(single_array($this->diagnoses->getCasting($subproduct,1),'casting_manager'));
                }
           if(empty($subproduct))
            $this->template->headingtitle="ADD DIAGNOSE";
        else
            $this->template->headingtitle="Update DIAGNOSE";
            $this->template->set_breadcrumb("DIAGNOSE LISTING",site_url("admin/diagnose/index/".$id));
            $this->template->set_breadcrumb("ADD DIAGNOSE","");
            
            $this->template->build('admin_form',array("frmdata"=>$data));
         
}
public function getPriceByAjax()
{
    $ids=$this->input->post('ids');
    $proprice=$this->products->getProductPrice($ids);
    echo json_encode(array('totalprice'=>$proprice));
}

    
    public  function delete($id='',$oid='')
    {
        $delete=$this->diagnoses->deletedata($id,$oid);
        //echo "##<pre>";print_r($delete);die;
        if($delete==1)
            $this->messages->flash("Data Deleted Successfully");
        redirect('admin/diagnose/index/'.$id);
    }
    
    public function details($id)
    {

        $data['delview']=$this->diagnoses->showDiagnoseDetails($id);
        $this->template->build('show_detail',$data);
    }
    
    public function calender($oid="",$digid="",$resourceid='0')
    {
        $where['order_type']=1;
        $data=array();
        $data['allmanager'] =single_array($this->diagnoses->getAllManagers($digid,$where),'id','name','Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($digid,$where);
        //echo "#<pre>";print_r($data['results']['assigndetails']);die;
        //$data['alldate']=$this->diagnoses->allDateAssigned($digid);
        if($this->input->post())
        {       
            $postalldata=$this->input->post();
             //echo "<pre>";print_r($postalldata);die;
            $datainfo = explode(" ",$postalldata["daterange"]);
            $tstartdatetime=strtotime($datainfo[0].' '.$datainfo[1]." ".$datainfo[2]);
            $tenddatetime=strtotime($datainfo[4].' '.$datainfo[5]." ".$datainfo[6]);
            //echo "<pre>";print_r($tstartdatetime.' '.$tenddatetime.' '.$datainfo[0].' '.$datainfo[1]." ".$datainfo[2].' '.$datainfo[4].' '.$datainfo[5]." ".$datainfo[6]);die;
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
                            "order_type"=>1
                );
                    $this->load->library('email');
                    
                    //echo $link;die;
                    $allEmail = $this->orders->getSellerUserEmail($oid);
                    $AllemailInComma  = implode(",",$allEmail);
                    //$this->email->to($AllemailInComma);
                    $AllemailInComma = $postalldata['cast_email'].",".$AllemailInComma;
                    //$this->email->to($AllemailInComma); 
                    $AllemailInComma = $postalldata['cast_email'].",".$AllemailInComma;
                    $AllInfoOfUser = $this->users->getUsersInfoById($postalldata["manager"]);
                    $this->email->to($AllInfoOfUser->email);
                    
                    
                    $datetimerange=$this->input->post('daterange');
                    $datetime=explode('-', $datetimerange);
                    $startdttime=strtotime($datetime['0']);
                    $enddttime=strtotime($datetime['1']);
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
            //echo "<pre>";print_r($assigndata);die;
                
                $mgid=$this->input->post('manager');
                $datetimerange=$this->input->post('daterange');
                $datetime=explode('-', $datetimerange);
                $startdttime=strtotime($datetime['0']);
                $enddttime=strtotime($datetime['1']);
                //$managerstartdate=$this->diagnoses->getStartDateEndDate($mgid);
                $datas=$this->diagnoses->checkRestrictedDateTime($startdttime,$enddttime,$mgid);
                //echo "@@<pre>";print_r($managerstartdate);die;
            //if(count($datas)>0)
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
            //$data['alldate']=$this->diagnoses->allDateAssigned($user_id);
            redirect("admin/diagnose/calender/".$oid."/".$digid."/".$user_id);
        }
        $data['diagnose_id']=$digid;
        $data['start_end']=$this->diagnoses->getDiagnoseStartEndDate($digid);
        
        
           $data['selectedResource'] = $resourceid>0?$resourceid:0; 
        $this->template->headingtitle="Assign Date Resources";


        $this->template->set_breadcrumb("ORDER LISTING",site_url("admin/order"));
        $this->template->set_breadcrumb("DIAGNOSE LISTING",site_url("admin/diagnose/index/".$oid));
        $this->template->set_breadcrumb("ASSIGN DATE ","");
        $this->template->build('calender',array('frmdata'=>$data));
    }
    public function getResourceEmailAndName()
    {
        $mgid=$this->input->post('managerid');
        //echo $mgid;die;
        $data['resourceemailname'] =$this->diagnoses->getResourceEmailName($mgid);
        //echo "####<pre>";print_r($data);die;

        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    //TRF
    public function trf($oid="",$digid="", $user_id="")
    {
        $where['order_type']=1;
        $data=array();
        $data['allmanager'] =single_array($this->diagnoses->getAllManagers($digid,$where),'id','name','Select Resource');
        //$data['travelname'] =single_array($this->diagnoses->getAllManagers($digid),'id','name','Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($digid,$where);
        //echo "@@<pre>";print_r($data['results']['assigndetails']);die;
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
                            "order_type"=>1
                );
                    $this->load->library('email');
                    
                    //echo $link;die;
                    $allEmail = $this->orders->getSellerUserEmail($oid);
                    $AllemailInComma  = implode(",",$allEmail);
                    //$this->email->to($AllemailInComma);
                    $AllemailInComma = $postalldata['cast_email'].",".$AllemailInComma;
                    
                    
                    $this->email->to($AllemailInComma);               
                    //$this->email->to($postalldata['cast_email']);                
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
            redirect("admin/diagnose/calender/".$oid."/".$digid);
        }
        $data['diagnose_id']=$digid;
        $data['odered_id']=$oid;
        $data['user_id']=$user_id;
        $data['start_end']=$this->diagnoses->getDiagnoseStartEndDate($digid);
        $data['headingtitle']=$this->template->headingtitle="TRAVEL REQUEST FORM";
           // $this->template->set_breadcrumb("ADD DIAGNOSE",site_url("admin/diagnose/form/".$id));
            //$this->template->set_breadcrumb("DIAGNOSE LISTING ","");
        //$this->template->build('trf',array('frmdata'=>$data));
       // echo $oid;die;
        $this->template->set_breadcrumb("ORDER LISTING",site_url("admin/order"));
        $this->template->set_breadcrumb("DIAGNOSE LISTING",site_url("admin/diagnose/index".'/'.$oid));
        $this->template->set_breadcrumb("TRAVEL LISTING ","");
        $this->template->build('trf',array('frmdata'=>$data));
    }
    public function trfPopUp($oid="",$digid="", $user_id="", $id='')
    {
       //die('ranu');
        $data=array();
        $data['order_id']=$oid;
        $data['diagnose_id']=$digid;
        $data['user_id']=$user_id;
        $data['resourceInfos']=$this->diagnoses->getResourceInfoById($id);
        $data['traveldata']=single_array($this->diagnoses->getTravel(),'id','name','Select Airlines');
        //echo "<pre>";print_r($data['resourceInfos']);die;
        $this->template->set_layout("ajax");
        $this->template->build('trf_pop_up',array('frm_data'=>$data));  

    } 

    //assging time
    public function assingResource($orderid=0,$valueid=0){
        //die($orderid);
        $data = array();
        $data['orderid']=$orderid;
        $data['diaid']=$valueid;
        $data['castingmanager']=single_array($this->casting_managers->getcastingManagerForSelect(),'id','name');
        $data['selectedmangers']=array_keys(single_array($this->diagnoses->getCasting($valueid,1),'casting_manager'));
        $this->template->set_layout("ajax");
        $this->template->build('resoucemap',array('frmdata'=>$data));  
    }
    public function setResouces(){
      if($this->input->post())
        {
            $orderId = $this->input->post('orderid');
            $casting_manager=$this->input->post('dnocasting');
            $valueid= $this->input->post('diagnoseid');
            $casts=array();  
                         foreach ($casting_manager as $key => $value) {
                           $casts[]=array('diagnose_id'=>$valueid,'casting_manager'=>$value,'type'=>1);
                        }
                        $deleteIds = array_keys(single_array($this->diagnoses->getCurrentExsitenceResourceId($valueid),'casting_manager'));
                        $this->diagnoses->addCasting($casts,array("diagnose_id"=>$valueid,'type'=>1));
                    }
        
        //sate del states in assing date table for break the relationship
        foreach($deleteIds as $resourceid){
            $this->diagnoses->setStatusInAssingDate($orderId,$valueid,$resourceid);
        }
        
        $orderId = $orderId>0?$this->input->post('orderid'):0;
        $this->messages->flash('Resource has been assinged successfully.');
        redirect('admin/diagnose/index/'.$orderId);  
    }
    
    public function deleteAssignDate()
    {
        //echo "<pre>##";print_r($id);die;
        $id=$this->input->post('id');
    
        $this->diagnoses->deleteAssignDate($id);
      

    } 
    
    public function deleteResources()
    {
     $data=array();
      $id=$this->input->post('id');
     $data['status']= $this->diagnoses->deleteResources($id);

     $this->template->set_layout("ajax");
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array("results"=>$data)));
    }

    public function saveTrfInfos()
    {
        
       $data=array();
       $postalldata=$this->input->post();

        if($this->input->post())
        {    
         //die('shdshsuhdcsuhdcushushu');   
          if(empty($postalldata['ids']))
            {
                $assigndataid = $this->diagnoses->saveTrfInfo($postalldata);
                redirect("admin/diagnose/trf/".$postalldata['order_id']."/".$postalldata['diagnose_id']."/".$postalldata['user_id']);
            }else{
                $assignd = $this->diagnoses->updateTrfInfo($postalldata,$postalldata['ids']);
                redirect("admin/diagnose/trf/".$postalldata['order_id']."/".$postalldata['diagnose_id']."/".$postalldata['user_id']);
                }
        }

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
        //echo "<pre>";print_r($id['id']);die;
        //$data['resourceInfos']=$this->diagnoses->getResourcesById($data,$id);      
        $data['resourceInfos']=$this->diagnoses->getTRFById($id['id']);      
        $data['userDetails']=$this->diagnoses->getdetailsById($data['user_id']); 
        $this->load->model('order/orders');
        $data['diagnose_detail']=$this->diagnoses->getDiagnosesInforationById($data['diagnose_id']);      
       
        //PDF Generate
        
        $whereArray = array('O.id'=>$data['order_id']);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray);
        
        $data['allmode'][] = $data['resourceInfos'];
        //echo "<pre>";print_r($data);die;
        //PDF Generate
        $datainfo= $this->load->view("diagnose/mail/pdfresource",$data,true);
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH."upload/resourcepdf/SIXRES".time().".pdf";
        $this->impdf->mpdf->Output($fullpath);
        //echo "<pre>234";print_r($datainfo);die;
        
      //  echo "<pre>";print_r($data);die;
        
        //$this->email->to($data['userDetails']->email);   
        
        $allEmail = $this->orders->getSellerUserEmail($data['order_id']);
        $AllemailInComma  = implode(",",$allEmail);
        //$this->email->to($AllemailInComma);
        $AllemailInComma = $email.",".$AllemailInComma;
        
        //$this->email->to($email);                
        $this->email->to($AllemailInComma);                
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
    redirect("admin/diagnose/trf/".$data['order_id']."/".$data['diagnose_id']."/".$data['user_id']);
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
        $data['diagnose_detail']=$this->diagnoses->getDiagnosesInforationById($digid);      
        //echo "<pre>12345".$digid;print_r($data['diagnose_detail']);die;
        //echo "<pre>pds".$data['userDetails']->email;die;
        //PDF Generate
        
        $whereArray = array('O.id'=>$oid);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray);
        //echo "<pre>123";print_r($order_detail);die;
        //echo "<pre>";print_r($data);die;
        //now grouping information
        $allDataByMode =  array();
        foreach($data['resourceInfos'] as $traindata){
           $allDataByMode[$traindata->mode][] = $traindata;
        }
        $data['allmode'] = $allDataByMode;
        //echo "<pre>";print_r($allDataByMode);die;
        $datainfo= $this->load->view("diagnose/mail/pdfresources",$data,true);
        //echo "<pre>";print_r($datainfo);die;
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH."upload/resourcepdf/SIXRES".time().".pdf";
        $this->impdf->mpdf->Output($fullpath);
        
        //echo "<pre>";print_r($data);die;
        
        //$this->email->to('itf.premdutt@gmail.com');                
        $this->email->to($data['userDetails']->email);                
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
    redirect("admin/diagnose/trf/".$oid."/".$digid.'/'.$user_id);
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
  
   public function getResourceDetails()
   { 
    $postalldata=$this->input->post();
    //echo "<pre>@@@@@@";print_r($postalldata);die;
    $data=array();
     $data=$this->diagnoses->getResourceDetails($postalldata['order_id'],$postalldata['diagnose_id'],$postalldata['user_id']);
     //echo "<pre>";print_r($data);die;
     //just chaning the system
     $newUpdatedData = array();
     foreach($data as $timevalue){
         $tempvalue = $timevalue;
         $tempvalue->mode = ucfirst($tempvalue->mode);
         if(empty($tempvalue->journey_date)){
             $tempvalue->journey_date=$tempvalue->checkin_date;
         }
         if(empty($tempvalue->return_date)){
             $tempvalue->return_date=$tempvalue->checkout_date;
         }
        $newUpdatedData[]= $timevalue; 
     }
     //echo "<pre>";print_r($newUpdatedData);die;
    $this->template->set_layout("ajax");
        $this->output
            ->set_content_type('application/json')
            //->set_output(json_encode(array("results"=>$data)));
            ->set_output(json_encode(array("results"=>$newUpdatedData)));
   }
    
    public function viewCalender()
    {
        $this->template->build('viewCalender');
    }

    function getAssignDate()
    {//die('ranu');
        //$r=APPPATH.'/third_party/mpdf/mpdf.php';
        $diaid=$this->input->post('diagnoseid');
        //echo "%%%@@@@<pre>";print_r($diaid);die;

        $mgrid=$this->input->post('managerid');
        //echo "%%%<pre>";print_r($mgrid);die;
        $diagnose['d_view']=$this->diagnoses->getCalenderDetails($diaid,$mgrid);
        //        echo "%%%<pre>";print_r($diagnose);die;
        $results = array();
        //$link='asdfsdfdsf';
        $comment = '';
        $statusArray = array(0=>'Awaiting',1=>'Accepted',2=>'Rejected');
        foreach ($diagnose['d_view'] as $k => $v)  {
            if($v->status == '2'){
               $comment = $v->comment;

            }

            $results[] = array("id"=>$v->id,
                "title" => "Booked"." ".$v->start_time."-".$v->end_time, 
                "start" => date("Y-m-d", strtotime($v->start_date)),
                "statusvalue" => $statusArray[$v->status],
                "comments" => $comment,
                "className" => 'eventColor'.$statusArray[$v->status],
                "end" => date("Y-m-d", strtotime($v->end_date." +1 day")));
            //echo "<pre>";print_r($results);die;

        }
        
        return $this->output->set_content_type('application/json')->set_output(json_encode($results));
    }
    public function getAdminShowComment($id=0,$status=0,$ordertype=0,$comment)
    {
        $data['view']=(array)$this->diagnoses->getCommentPopUp($id,$ordertype);
        $data['status']=$status;
        $data['comment']=$comment;
    }
      function trfAllDetails($oid='',$did='',$uid='',$id='')
          {
            //echo "<pre>";print_r($oid.''.$did.''.$uid.''.$id);die;
            $where=array('oid'=>$oid,'did'=>$did,'uid'=>$uid,'id'=>$id);
           // echo "<pre>";print_r($where);die;
                $data['record']=(array)$this->diagnoses->trfAllRecords($where);
                 //echo "<pre>";print_r($data);die;
                 $this->template->set_breadcrumb("TRAVEL REQUEST FORM",site_url("admin/diagnose/trf/".$where['oid'].'/'.$where['did']));
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
