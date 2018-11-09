<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends ITFS_Controller {

    public function __construct() {
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'pagination', 'email'));
        //$this->load->model('deliveries');
        $this->load->model('product/products');
        $this->load->model('subproduct/subproducts');
        $this->load->model('closed_delivery/deliveries');
        $this->load->model('closed_diagnose/diagnoses');
        $this->load->model('casting_manager/casting_managers');
        $this->load->model('welcome/welcomes');
        $this->load->model('user/users');
        $this->load->model('order/orders');
    }

    //public function index($id=0,$closed=0) {//die($id);
    public function index($id=0) {//die($id);
        $closed=0;
        $searchdeddata= explode("-", $id);
        if(isset($searchdeddata[1])){
            $searchedid             =   $searchdeddata[1];
            $data['searchedid']   =   $searchedid;
        }
        //$data['all']=$this->deliveries->showAllDelivery($id);
        $data['ids'] = $id;
        //Filter Data
        $conditions = array();

        if(isset($_POST["q"])) {
            $this->session->set_userdata(array("CLOSEDDELIVERYSEARCHFIELD"=>$this->input->post()));
        } 

        $searchfield = $this->session->userdata("CLOSEDDELIVERYSEARCHFIELD");
        if(count($searchfield)>0)
        $data["frm_data"] = $searchfield;


        //$conditions["where"] = array("user_type"=>'CM');
        if (isset($searchfield["q"]) and ! empty($searchfield["q"])) {
            $conditions["like"] = array("SB.name" => $searchfield["q"], "DV.email_id" => $searchfield["q"]);
        }

        // End of Filter Data
        $totaldata = $this->deliveries->totalData($conditions, $id);
        //echo "<pre>";print_r($totaldata);die;
        $config = $this->paginationformat["back_page"];
        $config['base_url'] = base_url('admin/delivery/index/' . $id);
        $config['total_rows'] = $totaldata;
        $config['per_page'] = 10;
        $config["uri_segment"] = 5;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
        $data['all'] = $this->deliveries->findUser($conditions, $config["per_page"], $page, $id);
        //echo "<pre>";print_r($data);die;
        foreach ($data['all'] as &$dt) {
            $dt->statusdata = $this->diagnoses->checkAssignData($dt->order_id, $dt->id, 3);
        }
        $data['link'] = $this->pagination->create_links();
        //echo "##<pre>";print_r($data['all']);die;
        $this->template->headingtitle = "CLOSED DELIVERY LISTING";
        $this->template->set_breadcrumb("CLOSED ORDER LISTING", site_url("admin/close_order"));
        $this->template->set_breadcrumb("DELIVERY LISTING", "");
        //echo "<pre>";print_r($data);die;
        $data['page']=$page;
        $this->template->build('admin_index', $data);
    }

    protected function UploadImageDoc(&$data, $id = 0) {
        //echo "<pre>";print_r($data);die;
        if (isset($_FILES["tmpdocuments"]["name"]) and ! empty($_FILES["tmpdocuments"]["name"])) {
            $config['upload_path'] = PUBLIC_UPLOADPATH . "documents/";
            //echo "<pre>";print_r($config['upload_path']);die;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|csv|zip|mp3|mpeg|m4a|pptx';
            //$config['max_size'] = '9000000000000000000000000';
            //$config['max_width'] = '2024';
            //$config['max_height'] = '2024';
            ini_set('post_max_size', '254M');
            ini_set('upload_max_filesize', '254M');
            $this->load->library('upload');
            $this->upload->initialize($config);
            ini_set('display_errors', 1);
            $result = $this->upload->do_upload('tmpdocuments');
            $errors = $this->upload->display_errors();
            //echo "<pre>";print_r($errors);die;
            if ($result >= 1) {
                //$this->deleteImage($id);
                $imageinfo = $this->upload->data();

                $data["image_name"] = $imageinfo["file_name"];
                //echo "<pre>";print_r($data["image_name"]);
                return true;
            } else {

                $data["error_msg"] = $this->upload->display_errors('<span>', '</span>');
                return false;
            }
        }
        return true;
    }

    //assging time
    public function assingResource($orderid = 0, $valueid = 0) {
        //die($orderid);
        $data = array();
        $data['orderid'] = $orderid;
        $data['diaid'] = $valueid;
        $data['castingmanager'] = single_array($this->casting_managers->getcastingManagerForSelect(), 'id', 'name');
        $data['selectedmangers'] = array_keys(single_array($this->diagnoses->getCasting($valueid, 3), 'casting_manager'));
        //echo "<pre>";print_r($data);die;
        $getDataForCunsulting = $this->deliveries->getdeliveredDayInfo($valueid);
        $data['noofresources'] = $getDataForCunsulting->cunsulting_days;
        $this->template->set_layout("ajax");
        $this->template->build('resoucemap', array('frmdata' => $data));
    }

    public function assingTimeUser($oid = 0, $dvyid = 0) {
        $data['accepttime'] = $this->deliveries->getUserAcceptTime($oid, $dvyid);

        $this->template->headingtitle = "Time Slot By User";
        $this->template->set_breadcrumb("ORDER LISTING", site_url("admin/order"));
        $this->template->set_breadcrumb("DELIVERY LISTING", site_url("admin/delivery/index/" . $oid));
        $this->template->set_breadcrumb("TIME SLOT ", "");
        $this->template->build('user_booked_time', array('frmdata' => $data));
    }

    public function setResouces() {
        $this->load->library('email');
        $deleteIds = array();
        $casting_manager = array();
        if ($this->input->post()) {
            $orderId = $this->input->post('orderid');
            $casting_manager = $this->input->post('dnocasting');
            if (!is_array($casting_manager)) {
                $casting_manager[] = $casting_manager;
            }
            $valueid = $this->input->post('diagnoseid');
            $casts = array();
            foreach ($casting_manager as $key => $value) {
                $casts[] = array('diagnose_id' => $valueid, 'casting_manager' => $value, 'type' => 3);
            }
            $deleteIds = array_keys(single_array($this->diagnoses->getCurrentExsitenceResourceId($valueid), 'casting_manager'));
            $this->diagnoses->addCasting($casts, array("diagnose_id" => $valueid, 'type' => 3));
        }

        //sate del states in assing date table for break the relationship
        //checking old resouces.
        //$deleteIdsarray = array_diff($casting_manager, $deleteIds);

        $deleteIdsarray = array_diff($deleteIds, $casting_manager);
//        echo "<pre>";print_r($deleteIds);
//        echo "<pre>";print_r($casting_manager);
        // echo "<pre>";print_r($deleteIdsarray);die;
        foreach ($deleteIdsarray as $resourceid) {
            //send email for cancellation of date
            $singeInfo = $this->diagnoses->getResourcesAssignDetailsForUpdateResource($valueid, 3, $resourceid);
            //echo "<pre>";print_r($deleteDetails);die;
            $this->email->to($singeInfo->email);
            $this->email->from('info@maynardleighonline.in');
            $this->email->set_mailtype("html");
            $maildata = $this->mails->getMailById(23);
            $link = site_url('user/resource_login');
            if (date("jS F, Y", $singeInfo->tstartdatetime) == date("jS F, Y", $singeInfo->tenddatetime)) {
                $datevalue = date("jS F, Y", $singeInfo->tstartdatetime);
            } else {
                $datevalue = date("jS F, Y", $singeInfo->tstartdatetime) . "-" . date("jS F, Y", $singeInfo->tenddatetime);
            }

            $information = array('name' => ucfirst($singeInfo->resourcename), 'client' => ucfirst($singeInfo->clientname), 'job' => $singeInfo->proname, 'subproduct' => $singeInfo->name, 'location' => $singeInfo->location,
                'date' => $datevalue,
                'time' => date("h:i A", $singeInfo->tstartdatetime) . "-" . date("h:i A", $singeInfo->tenddatetime),
                'link' => $link);
            $datainfo = $this->messages->mailData($information, $maildata->mailbody);
            $bodymessage = $this->messages->mailTemplate($datainfo);
            $this->email->subject($maildata->mailsubject);
            $this->email->message($bodymessage);
            if (!empty($singeInfo->resourcename)) {
                //echo "<pre>";print_r($this->email);die;
                $this->email->send();
                $this->email->clear();
            }
            $this->diagnoses->setStatusInAssingDate($orderId, $valueid, $resourceid);
        }

        $orderId = $orderId > 0 ? $this->input->post('orderid') : 0;
        $this->messages->flash('Resource has been assinged successfully.');
        redirect('admin/delivery/index/' . $orderId);
    }

    public function trfPopUp($oid = "", $subproducts = "", $user_id = "", $id = '') {
        //echo "<pre>##";print_r($id);die;
        $data = array();
        $data['order_id'] = $oid;
        $data['diagnose_id'] = $subproducts;
        $data['user_id'] = $user_id;
        $data['resourceInfos'] = $this->diagnoses->getResourceInfoById($id);
        $data['traveldata'] = single_array($this->diagnoses->getTravel(), 'id', 'name', 'Select Airlines');
        //echo "<pre>";print_r($data['resourceInfos']);die;
        $this->template->set_layout("ajax");
        $this->template->build('trf_pop_up', array('frm_data' => $data));
    }

    //
    public function deletePopUp($oid = "", $diagnose_id = "", $type_id = '3') {
        //echo "<pre>##";print_r($id);die;
        $data = array();
        $data['order_id'] = $oid;
        $data['diagnose_id'] = $diagnose_id;
        $data['type_id'] = $type_id;
        $this->template->set_layout("ajax");
        $this->template->build('delivery_delete', array('frm_data' => $data));
    }
    
    //archive order
    public function archievePopUp($oid = "", $diagnose_id = "", $type_id = '3') {
        //echo "<pre>##";print_r($id);die;
        if ($this->input->post()) {
            $postalldata = $this->input->post();
            //echo "<pre>";print_r($postalldata);die;
            $updatedresponse = $this->diagnoses->updateInvoice($postalldata['order_id'],$postalldata['diagnose_id'],$order_type=3,$postalldata['invoice_no']);
            if($updatedresponse)
                $this->messages->flash('Order moved in to achieve!');
            else
                $this->messages->flash('Failed ! Check resource is properly assinged and respective dates are correct.','error');
            redirect("admin/delivery/index/" . $postalldata['order_id']);
        }
        
        
        $data = array();
        $data['order_id'] = $oid;
        $data['diagnose_id'] = $diagnose_id;
        $data['type_id'] = $type_id;
        $this->template->set_layout("ajax");
        $this->template->build('archieve_popup', array('frm_data' => $data));
    }

    public function saveTrfInfos() {
        $data = array();
        $postalldata = $this->input->post();
        //echo "<pre>";print_r($postalldata);die;
        if ($this->input->post()) {
            if (empty($postalldata['ids'])) {
                $assigndataid = $this->diagnoses->saveTrfInfo($postalldata);
                redirect("admin/delivery/trf/" . $postalldata['order_id'] . "/" . $postalldata['diagnose_id'] . "/" . $postalldata['user_id']);
            } else {
                $assignd = $this->diagnoses->updateTrfInfo($postalldata, $postalldata['ids']);
                redirect("admin/delivery/trf/" . $postalldata['order_id'] . "/" . $postalldata['diagnose_id'] . "/" . $postalldata['user_id']);
            }
        }
    }

    public function trf($oid = "", $subproduct = "", $user_id = "") {
        //echo "<pre>";print_r($oid);die;
        $where['order_type'] = 3;
        $data = array();
        $data['allmanager'] = single_array($this->diagnoses->getAllManagers($subproduct, $where), 'id', 'name', 'Select Resource');
        //$data['travelname'] =single_array($this->diagnoses->getAllManagers($digid),'id','name','Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($subproduct, $where);
        if ($this->input->post()) {
            $postalldata = $this->input->post();
            //echo "<pre>";print_r($postalldata);die;
            $datainfo = explode(" ", $postalldata["daterange"]);
            $startdata = trim($datainfo[0]);
            $starttime = trim($datainfo[1] . " " . $datainfo[2]);
            $enddata = trim($datainfo[4]);
            $endtime = trim($datainfo[5] . " " . $datainfo[6]);

            $assigndata = array(
                "order_id" => $oid,
                "diagnose_id" => $postalldata["diagnose_id"],
                "manager_id" => $postalldata["manager"],
                "start_date" => $startdata,
                "start_time" => $starttime,
                "end_date" => $enddata,
                "end_time" => $endtime,
                "order_type" => 3
            );
            $this->load->library('email');

            //echo $link;die;
            $allEmail = $this->orders->getSellerUserEmail($oid);
            $AllemailInComma = implode(",", $allEmail);
            //$this->email->to($AllemailInComma);
            $AllemailInComma = $postalldata['cast_email'] . "," . $AllemailInComma;
            $this->email->to($AllemailInComma);
            //$this->email->to($postalldata['cast_email']);                
            //$this->email->to('send2ranu@gmail.com');                
            $this->email->from('info@maynardleighonline.in');
            $this->email->set_mailtype("html");
            $maildata = $this->mails->getMailById(3);
            $link = site_url('user/resource_login');
            //$startdatenew=date('m/d/Y h:i A',$startdate);
            $information = array('name' => $postalldata['cast_name'], 'client' => $postalldata['client_name'], 'job' => $postalldata['product_name'], 'details' => $postalldata['details'],
                'date' => $postalldata['startdate'] . "-" . $postalldata['enddate'],
                'time' => $postalldata['starttime'] . "-" . $postalldata['endtime'],
                'link' => $link);
            $datainfo = $this->messages->mailData($information, $maildata->mailbody);
            $bodymessage = $this->messages->mailTemplate($datainfo);
            $this->email->subject($maildata->mailsubject);
            $this->email->message($bodymessage);
            //echo "<pre>";print_r($this->email);die;
            $this->email->send();
            $this->email->clear();
            //echo "<pre>";print_r($assigndata);die;
            $assigndataid = $this->diagnoses->addAssignDate($assigndata);
            if (!empty($assigndataid))
                $this->messages->flash('Assign Date Successfully');
            redirect("admin/delivery/calender/" . $oid . "/" . $subproduct);
        }
        $data['diagnose_id'] = $subproduct;
        $data['odered_id'] = $oid;
        $data['user_id'] = $user_id;
        $data['start_end'] = $this->diagnoses->getDiagnoseStartEndDate($subproduct);
        $data['headingtitle'] = $this->template->headingtitle = "TRAVEL REQUEST FORM";
        $this->template->set_breadcrumb("ORDER LISTING", site_url("admin/order"));
        $this->template->set_breadcrumb("DELIVERY LISTING", site_url("admin/delivery/index" . '/' . $oid));
        $this->template->set_breadcrumb("TRAVEL LISTING ", "");
        $this->template->build('trf', array('frmdata' => $data));
    }

    public function form($id = '', $subproduct = '',$page=0) {
        $data['product'] = array(''=>'Select Product')+single_array($this->products->getProductsForSelect(3), 'id', 'name');
        $data['subproducts'] = array(''=>'Select Sub-Product')+single_array($this->subproducts->getSubProductsForSelect(), 'id', 'name');
        $data['castingmanager'] = single_array($this->casting_managers->getCastingManagerForSelect(), 'id', 'name');
        //$data['dlvproduct']=$this->products->getDeliyverProductsForSelect(3);
        //echo "@@@<pre>";print_r($data['product']);die;
        //$this->template->build('show_view',$data); 
        if ($this->input->post()) {
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('dvproducts', 'Product Name', 'required');
            $this->form_validation->set_rules('dsubproducts', 'Sub-Products', 'required');
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
            //$this->form_validation->set_rules('dvcoordinator', 'Co Ordinator', 'required');
            //$this->form_validation->set_rules('dvemail', 'Email', 'required');
            //$this->form_validation->set_rules('dvcontact', 'Contact No', 'required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]');
            if ($this->form_validation->run() == false) {
                $data['subdelvid'] = (object) array(
                            'order_Id' => $id,
                            'products' => $this->input->post('dvproducts'),
                            'subproducts' => $this->input->post('dsubproducts'),
                            'intervaltime' => $this->input->post('intervaltime'),
                            'lunchstarttime' => $this->input->post('lunchstarttime'),
                            'lunchendtime' => $this->input->post('lunchendtime'),
                            'weight' => $this->input->post('dvweight'),
                            'units' => $this->input->post('dvunits'),
                            'pax' => $this->input->post('dvpax'),
                            'notconfirmed' => $this->input->post('notconfirmed'),
                            'no_ofdays' => $this->input->post('dvnoofdays'),
                            'cunsulting_days' => $this->input->post('dvcunsulting'),
                            'start_date' => $this->input->post('dvstartdate'),
                            'end_date' => $this->input->post('dvenddate'),
                            'location' => $this->input->post('dvlocation'),
                            'price_unit' => $this->input->post('dvpriceandunit'),
                            //'coordinator' => $this->input->post('dvcoordinator'),
                            //'email_id' => $this->input->post('dvemail'),
                            //'contact' => $this->input->post('dvcontact')
                );
                $data['selectedmangers'] = $this->input->post('dvnocasting');
                $data['selecteddeliveredproduct'] = $this->input->post('ddlvproducts');
                //$data['selecteddeliveredproduct']
                //echo "<pre>";print_r($data);die;
            } else {

                if (empty($subproduct)) {
                    $delivery['order_Id'] = $id;
                    $delivery['products'] = $this->input->post('dvproducts');
                    $delivery['subproducts'] = $this->input->post('dsubproducts');
                    $delivery['lunchstarttime'] = $this->input->post('lunchstarttime');
                    $delivery['lunchendtime'] = $this->input->post('lunchendtime');
                    $delivery['intervaltime'] = $this->input->post('intervaltime');
                    $delivery['notconfirmed'] = $this->input->post('notconfirmed');
                    $delivery['weight'] = $this->input->post('dvweight');
                    $delivery['units'] = $this->input->post('dvunits');
                    $delivery['pax'] = $this->input->post('dvpax');
                    $delivery['no_ofdays'] = $this->input->post('dvnoofdays');
                    $delivery['cunsulting_days'] = $this->input->post('dvcunsulting');
                    $delivery['start_date'] = $this->input->post('dvstartdate');
                    $delivery['end_date'] = $this->input->post('dvenddate');
                    $delivery['location'] = $this->input->post('dvlocation');
                    $delivery['price_unit'] = $this->input->post('dvpriceandunit');
                    //$delivery['coordinator'] = $this->input->post('dvcoordinator');
                    //$delivery['email_id'] = $this->input->post('dvemail');
                    //$delivery['contact'] = $this->input->post('dvcontact');
                    //$casting_manager=$this->input->post('dvnocasting');
                    $delivered = $this->input->post('ddlvproducts');
                    //echo "<pre>22222@@@@@@@@@@@";print_r($delivery);die;

                    $inserid = $this->deliveries->add_delivery($delivery);
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
                    if (count($delivered) > 1 && isset($delivered)) {
                        //echo "<pre>22222@@@@@@@@@@@";print_r(count($casting_manager));die;
                        $deliv = array();
                        foreach ($delivered as $key => $value) {
                            $deliv[] = array('delivery_id' => $inserid, 'delivery_pro_id' => $value);
                        }
                        $this->diagnoses->addDeliveredProduct($deliv, array("delivery_id" => $inserid));
                    }
                    if (!empty($inserid))
                        $this->messages->flash('Data has been inserted');
                    redirect('admin/delivery/index/' . $id);
                }


                else {
                    $deliverydata = array();
                    //$data=$this->input->post();
                    $deliverydata = array(
                        'order_Id' => $id,
                        'products' => $this->input->post('dvproducts'),
                        'subproducts' => $this->input->post('dsubproducts'),
                        'lunchstarttime' => $this->input->post('lunchstarttime'),
                        'lunchendtime' => $this->input->post('lunchendtime'),
                        'intervaltime' => $this->input->post('intervaltime'),
                        'notconfirmed' => $this->input->post('notconfirmed'),
                        'weight' => $this->input->post('dvweight'),
                        'units' => $this->input->post('dvunits'),
                        'pax' => $this->input->post('dvpax'),
                        'no_ofdays' => $this->input->post('dvnoofdays'),
                        'cunsulting_days' => $this->input->post('dvcunsulting'),
                        'start_date' => $this->input->post('dvstartdate'),
                        'end_date' => $this->input->post('dvenddate'),
                        'location' => $this->input->post('dvlocation'),
                        'price_unit' => $this->input->post('dvpriceandunit'),
                        //'coordinator' => $this->input->post('dvcoordinator'),
                        //'email_id' => $this->input->post('dvemail'),
                        //'contact' => $this->input->post('dvcontact')
                    );
                    // $casting_manager=array();
                    // $casting_manager=is_array($this->input->post('dvnocasting'))?$this->input->post('dvnocasting'):array();
                    $delivered = array();
                    $delivered = is_array($this->input->post('ddlvproducts')) ? $this->input->post('ddlvproducts') : array();
                    //echo "<pre>";print_r(count($casting_manager));die;
                    //match with old date and send email
                    //echo "<pre>";print_r($data);die;
                    /* $currentinfo = $this->deliveries->getSubdelevaryById($id,$subproduct);
                      if((isset($currentinfo->start_date) && ($currentinfo->start_date!=$deliverydata['start_date'])) || (isset($currentinfo->end_date) && ($currentinfo->end_date!=$deliverydata['end_date']))){
                      // die("Date changed");
                      } */



                    $updata = $this->deliveries->update_Delivery($deliverydata, $subproduct, $id);


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

                    $deliv = array();

                    foreach ($delivered as $key => $value) {
                        $deliv[] = array('delivery_id' => $subproduct, 'delivery_pro_id' => $value);
                    }
                    //die($subproduct);
                    $this->diagnoses->addDeliveredProduct($deliv, array("delivery_id" => $subproduct));

                    if ($updata == 1) {
                        $this->messages->flash('Data Updated Successfully');
                    }
                    redirect('admin/delivery/index/' . $id."/".$page);
                }
            }
        } else {
            if (!empty($subproduct)) {
                $selecteProductId = $this->deliveries->getSelectedProductId($subproduct);
                $selecteProductId = $selecteProductId->subproducts;
                $allProductsSelectOption = (single_array($this->products->getDeliyverProductsForSelect($selecteProductId), 'id', 'name'));
                //echo "<pre>chill@@";print_r($allProductsSelectOption);die;
                $data['allProductsSelectOption'] = $allProductsSelectOption;
            }
            $data['subdelvid'] = $this->deliveries->getSubdelevaryById($id, $subproduct);

            $data['selectedmangers'] = array_keys(single_array($this->diagnoses->getCasting($subproduct, 3), 'casting_manager'));
            $data['selecteddeliveredproduct'] = array_keys(single_array($this->diagnoses->getDeliveredPro($subproduct), 'delivery_pro_id'));
            //echo "@@@!!<pre>";print_r($data['selecteddeliveredproduct']);die;
            //die('dsfedf');
            //echo "<pre>111";print_r();die;
            // $data['parrentid']=$id;
            //$this->template->add_js($modalViewi, "B", "embed");
        }
        //echo "<pre>111";print_r($data['selecteddeliveredproduct']);die;
        if (empty($subproduct))
            $this->template->headingtitle = "ADD DELIVERY";
        else
            $this->template->headingtitle = "Update DELIVERY";
        $this->template->set_breadcrumb("DELIVERY LISTING", site_url("admin/delivery/index/" . $id));
        $this->template->set_breadcrumb("ADD DELIVERY", "");
        //echo "<pre>";print_r($data);die;
        $this->template->build('admin_form', array("frmdata" => $data));
    }

    public function getPriceByAjax() {
        //$this->load->model('product/products');
        //$type['product_type']=3;
        $ids = $this->input->post('ids');

        $data['proprice'] = $this->products->getProductPrice($ids);
        $data['delivered'] = $this->products->getDeliyverProductsForSelect($ids);
        //echo "@@@<pre>";print_r($data);die;
        echo json_encode(array('totalprice' => $data));
    }

    public function getProductByAjax() {
        $ids = $this->input->post('ids');
        $results = $this->deliveries->getSubProducts($ids);
//echo "<pre>";print_r($results);die;
        return $this->output->set_content_type('application/json')->set_output(json_encode($results));
        //echo "<pre>";print_r($ids);die;
    }

    //public  function delete($id='',$oid='')
    public function delete() {
        $this->load->library('email');
        $postalldata = $this->input->post();
        $id = $postalldata['order_id'];
        $oid = $postalldata['diagnose_id'];
        //get all list of resouces who has assing date
        $order_type['order_type'] = 3;
        $this->load->model('diagnose/diagnoses');
        $deleteDetails = $this->diagnoses->getResourcesAssignDetailsForDelete($oid, $order_type);
        //echo "<pre>";print_r($deleteDetails);die;
        foreach ($deleteDetails as $singeInfo) {
            $this->email->to($singeInfo->email);
            $this->email->from('info@maynardleighonline.in');
            $this->email->set_mailtype("html");
            $maildata = $this->mails->getMailById(23);
            $link = site_url('user/resource_login');
            if (date("jS F, Y", $singeInfo->tstartdatetime) == date("jS F, Y", $singeInfo->tenddatetime)) {
                $datevalue = date("jS F, Y", $singeInfo->tstartdatetime);
            } else {
                $datevalue = date("jS F, Y", $singeInfo->tstartdatetime) . "-" . date("jS F, Y", $singeInfo->tenddatetime);
            }

            $information = array('name' => ucfirst($singeInfo->resourcename), 'client' => ucfirst($singeInfo->clientname), 'job' => $singeInfo->proname, 'subproduct' => $singeInfo->name, 'location' => $singeInfo->location,
                'date' => $datevalue,
                'time' => date("h:i A", $singeInfo->tstartdatetime) . "-" . date("h:i A", $singeInfo->tenddatetime),
                'link' => $link);
            $datainfo = $this->messages->mailData($information, $maildata->mailbody);
            $bodymessage = $this->messages->mailTemplate($datainfo);
            $this->email->subject($maildata->mailsubject);
            $this->email->message($bodymessage);
            //echo "<pre>";print_r($bodymessage);die;
            $this->email->send();
            $this->email->clear();
        }
        $delete = $this->deliveries->deletedata($id, $oid, $postalldata);
        if ($delete == 1)
            $this->messages->flash("Data Deleted Successfully");
        redirect('admin/delivery/index/' . $id);
    }

    public function details($id) {//die($id);
        $data['delview'] = $this->deliveries->showDeliveryDetails($id);

        //echo "<pre>";print_r($data);die;
        $this->template->build('show_detail', $data);
    }

    public function calender($oid = "", $dvyid = "", $resourceid = '') {
        $where['order_type'] = 3;
        $data['allmanager'] = single_array($this->diagnoses->getAllManagers($dvyid, $where), 'id', 'name', 'Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($dvyid, $where);
        $data['calluser'] = $this->diagnoses->getCallUserEmail($oid, $dvyid);
        //echo "<pre>";print_r($data);die;
        $array_of_call = array(28, 29, 20, 21, 22, 27, 25);
        if ($this->input->post()) {
            //$diagnosedata=array();
            $postalldata = $this->input->post();
            $datainfo = $this->deliveries->deliveryTiming(array("D.order_id" => $oid, "D.id" => $dvyid));
            //echo "<pre>1234";print_r($datainfo);die;
            //Date Range

            $datatiming = explode("-", $postalldata["daterange"]);
            $datatiming[0] = explode(" ", trim($datatiming[0]));
            $datatiming[1] = explode(" ", trim($datatiming[1]));
            $datatiming['startdate'] = DateTime::createFromFormat('m/d/Y h:i A', $datatiming[0][0] . " " . $datatiming[0][1] . " " . $datatiming[0][2]);
            $datatiming['enddate'] = DateTime::createFromFormat('m/d/Y h:i A', $datatiming[1][0] . " " . $datatiming[1][1] . " " . $datatiming[1][2]);

            $dteDiff = $datatiming['startdate']->diff($datatiming['enddate']);
            $totalminutesintv = ($dteDiff->days * 24 * 60) + ($dteDiff->h * 60) + $dteDiff->i;
            $ii = 0;
            $allintervals = array();

            //echo "<pre>";print_r($totalminutesintv);
            //echo "<pre>";print_r($datainfo);die;

            if (in_array($datainfo->products, $array_of_call)) {
                $counttimeslots = 0;
                $lunchupdate = "0";
                while ($ii <= $totalminutesintv) {

                    $strgdata['st'] = DateTime::createFromFormat("Y-m-d h:i A", $datatiming['startdate']->format("Y-m-d") . " " . $datatiming[0][1] . " " . $datatiming[0][2]);
                    $strgdata['en'] = DateTime::createFromFormat("Y-m-d h:i A", $datatiming['startdate']->format("Y-m-d") . " " . $datatiming[1][1] . " " . $datatiming[1][2]);


                    $lunchst = DateTime::createFromFormat("Y-m-d H:i A", $datatiming['startdate']->format("Y-m-d") . " " . $datainfo->lunchstarttime);
                    $lunchen = DateTime::createFromFormat("Y-m-d H:i A", $datatiming['startdate']->format("Y-m-d") . " " . $datainfo->lunchendtime);



                    $lunchtimedata['st'] = clone $lunchst;
                    $lunchtimedata['st']->modify('+29 minutes');
                    $lunchtimedata['en'] = clone $lunchen;

                    //echo "<pre>"; print_r($lunchtimedata); echo "<hr>";


                    $sttime = clone $datatiming['startdate'];
                    $datatiming['startdate']->modify('+' . $datainfo->timeduration . ' minutes');
                    $endtime = clone $datatiming['startdate'];
                    $datatiming['startdate']->modify('+' . $datainfo->intervaltime . ' minutes');


                    if (
                            ($strgdata['st']->getTimestamp() <= $endtime->getTimestamp() and
                            $strgdata['en']->getTimestamp() >= $endtime->getTimestamp() and
                            $strgdata['st']->getTimestamp() <= $sttime->getTimestamp())
                    )
                        if (
                                !( $lunchtimedata['st']->getTimestamp() < $sttime->getTimestamp() and $lunchtimedata['en']->getTimestamp() >= $sttime->getTimestamp() or
                                $lunchtimedata['st']->getTimestamp() < $endtime->getTimestamp() and $lunchtimedata['en']->getTimestamp() >= $endtime->getTimestamp()
                                ) or $lunchupdate == "1"
                        ) {
                            $counttimeslots++;
                            $allintervals[] = array("start" => $sttime, 'endtime' => $endtime, 'lunchflage' => 0);
                            $ii += ($datainfo->timeduration + $datainfo->intervaltime);
                            $lunchupdate = "0";
                        } else {
                            $sttime->modify('-' . $datainfo->intervaltime . ' minutes');
                            $allintervals[] = array("start" => $sttime, 'endtime' => $lunchen, 'lunchflage' => 1);
                            $datatiming['startdate']->setTime($lunchen->format("H"), $lunchen->format("i"));
                            $lunchupdate = "1";
                        }
                }

                //Get no of particpant list of call
                //echo "<pre>";print_r($allintervals);
                //echo "<pre>";print_r($allintervals);die;
                if ((count($data['calluser'])) > ($counttimeslots)) {
                    $this->messages->flash("Sorry !!!! No of User is " . count($data['calluser']) . " and time slot is available only " . ($counttimeslots) . " excluding lunch time slot ", 'error');
                    redirect('admin/delivery/calender/' . $oid . "/" . $dvyid . "/" . $resouces_id);
                }
                //echo "<pre>12345";print_r($allintervals);die;
                foreach ($allintervals as $slot_data) {
                    //echo date('jS F, Y H:i:A',$slot_data["start"]->getTimestamp());die;
                    //echo "<pre>111";print_r($slot_data["start"]->getTimestamp());die;
                    $newtimeslotarray = array(
                        'resource_id' => $postalldata["manager"],
                        'order_id' => $oid,
                        'delivery_id' => $postalldata["diagnose_id"],
                        'time_slot_start' => date('jS F, Y H:i:A', $slot_data["start"]->getTimestamp()),
                        'timestampstart' => $slot_data["start"]->getTimestamp(),
                        'time_slot_end' => date('jS F, Y H:i:A', $slot_data["endtime"]->getTimestamp()),
                        'timestampend' => $slot_data["endtime"]->getTimestamp(),
                        'lunchflage' => $slot_data["lunchflage"]
                    );
                    $this->deliveries->addTimeSlot($newtimeslotarray);
                    //echo "<pre>1234";print_r($newtimeslotarray);die;
                }
                //echo "<pre>";
                //print_r($datatiming); print_r($lunchtimedata); 
                //print_r($allintervals); print_r($datainfo); print_r($postalldata); die;
                //End DateRange
            }



            $datainfo = explode(" ", $postalldata["daterange"]);
            $tstartdatetime = strtotime($datainfo[0] . ' ' . $datainfo[1] . " " . $datainfo[2]);
            $tenddatetime = strtotime($datainfo[4] . ' ' . $datainfo[5] . " " . $datainfo[6]);
            $startdata = trim($datainfo[0]);
            $starttime = trim($datainfo[1] . " " . $datainfo[2]);
            $enddata = trim($datainfo[4]);
            $endtime = trim($datainfo[5] . " " . $datainfo[6]);

            $assigndata = array(
                "order_id" => $oid,
                "diagnose_id" => $postalldata["diagnose_id"],
                "manager_id" => $postalldata["manager"],
                "start_date" => $startdata,
                "start_time" => $starttime,
                "end_date" => $enddata,
                "end_time" => $endtime,
                "tstartdatetime" => $tstartdatetime,
                "tenddatetime" => $tenddatetime,
                "order_type" => 3
            );
            $this->load->library('email');

            //echo $link;die;
            $mgid = $this->input->post('manager');
            $datetimerange = $this->input->post('daterange');
            $datetime = explode('-', $datetimerange);
            $startdttime = strtotime($datetime['0']);
            $enddttime = strtotime($datetime['1']);

            $allEmail = $this->orders->getSellerUserEmail($oid);
            $AllemailInComma = implode(",", $allEmail);
            //$this->email->to($AllemailInComma);
            $AllemailInComma = $postalldata['cast_email'] . "," . $AllemailInComma;
            //get email address and name of resource
            $AllInfoOfUser = $this->users->getUsersInfoById($postalldata["manager"]);
            $this->email->to($AllInfoOfUser->email);

            $this->email->from('info@maynardleighonline.in');
            $this->email->set_mailtype("html");
            $maildata = $this->mails->getMailById(3);
            $link = site_url('user/resource_login');
            if (date("jS F, Y", $startdttime) == date("jS F, Y", $enddttime)) {
                $datevalue = date("jS F, Y", $startdttime);
            } else {
                $datevalue = date("jS F, Y", $startdttime) . "-" . date("jS F, Y", $enddttime);
            }

            $information = array('name' => $AllInfoOfUser->name, 'client' => $postalldata['client_name'], 'job' => $postalldata['product_name'], 'subproduct' => $postalldata['subpro'], 'location' => $postalldata['location'],
                'date' => $datevalue,
                'time' => date("h:i:s A", $startdttime) . "-" . date("h:i:s A", $enddttime),
                'link' => $link);




            //echo "<pre>";print_r($assigndata);die;
            //$managerstartdate=$this->diagnoses->getStartDateEndDate($mgid);
            $datas = $this->diagnoses->checkRestrictedDateTime($startdttime, $enddttime, $mgid, $dvyid);
            //echo "@@<pre>";print_r(count($datas));die;
            if ($datas) {
                $this->messages->flash('Resource is busy on this date', 'error');
            } else {
                //echo "<pre>";print_r($this->email);die;

                $assigndataid = $this->diagnoses->addAssignDate($assigndata);

                $datainfo = $this->messages->mailData($information, $maildata->mailbody);
                $accept_url = site_url('usercall_accept/acceptbyresource/' . base64_encode($assigndataid));
                $reject_url = site_url('usercall_accept/rejectbyresource/' . base64_encode($assigndataid));
                $acceptorrejectlink = "<div>"
                        . "<div style='float:left'><a style='display: block;width: 115px;height: 20px;background: #4E9CAF;padding: 10px;text-align: center;border-radius: 5px;color: white;font-weight: bold;' href='" . $accept_url . "'>Accept</a>&nbsp;"
                        . "<a style='display: block;width: 115px;height: 20px;background: red;padding: 10px;text-align: center;border-radius: 5px;color: white;font-weight: bold;' href='" . $reject_url . "'>Reject</a></div>"
                        . "</div>";
                $datainfo .= $acceptorrejectlink;
                //echo "<pre>111";print_r($datainfo);die;
                $bodymessage = $this->messages->mailTemplate($datainfo);
                $this->email->subject($maildata->mailsubject);
                $this->email->message($bodymessage);
                $this->email->send();
                $this->email->clear();

                $usermapdata = $this->deliveries->getusermapData(array("D.order_id" => $oid, "D.id" => $dvyid));
                $id = $usermapdata->id;
                $user_id = $usermapdata->user_id;
                //echo "<pre>";print_r($user_id.' '.$id);die;
                //$this->email->to($AllInfoOfUser->email);
                //if(in_array($postalldata['productId'], $array_of_call))
//		            {	
//                       foreach ($postalldata['cemail'] as $key => $value) 
//                        {$link1=site_url('usercall_accept/index/'.$oid.'/'.$dvyid.'/'.$id.'/'.$user_id);
//                        //echo $link1;
//                            $this->email->to($value);
//                            $this->email->from('info@maynardleighonline.in');
//                            $this->email->set_mailtype("html");
//                                $maildata = $this->mails->getMailById(24);
//                                 
//                                $information = array('name'=>$AllInfoOfUser->name,
//                                'link'=>$link1);
//                                $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
//                                $bodymessage = $this->messages->mailTemplate($datainfo);
//                                $this->email->subject($maildata->mailsubject);
//                                $this->email->message($bodymessage);
//                                //echo "<pre>";print_r($this->email);
//                                $this->email->send();
//                                $this->email->clear();
//                                //echo "<pre>";print_r($value);die;
//                        }
//                        $datetimeslot = explode(" ",$postalldata["daterange"]);
//		        		
//		        			$starttime=$datetimeslot['1'].' '.$datetimeslot['2'];
//		        			$endtime =$datetimeslot['5'].' '.$datetimeslot['6'];
//		        			$timedura=$postalldata['timeduration'];
//		        			$interval=$postalldata['intervaltime'];
//                            //echo "<pre>";print_r($timedura);die;
//		        			$i=0;
//		        			do{
//		        				if($i==0){
//		        					//insert in table
//		        					$timeslot=array(
//	            						'order_id'=>$oid,
//	            						'delivery_id'=>$postalldata["diagnose_id"],
//	            						'resource_id'=>$postalldata["manager"],
//	            						'start_time_slot'=>$starttime,
//	            						'end_time_slot'=>$timedura,
//	            						);
//			            			$this->deliveries->timeSlotMaster($timeslot);
//			        				}else{
//    			$starttime = isset($lasttimeduration)?$lasttimeduration:$starttime;
//    			//$lasttime = $starttime+$interval+$timedura;
//				$lasttimeinterval = strtotime($interval, strtotime($starttime));
//                //echo "#######<pre>";print_r($timedura);die;
//				$lasttimeduration = strtotime($timedura, strtotime($lasttimeinterval));
//					
//		        					$timeslot=array(
//	            						'order_id'=>$oid,
//	            						'delivery_id'=>$postalldata["diagnose_id"],
//	            						'resource_id'=>$postalldata["manager"],
//	            						'start_time_slot'=>$starttime,
//	            						'end_time_slot'=>$timedura,
//	            						);
//		            				//$this->deliveries->timeSlotMaster($timeslot);	
//		        					}
//		        					$i++;
//		        				}while($starttime<=$endtime);
//		            		
//		            }

                if (!empty($assigndataid))
                    $this->messages->flash('Assigned Date Successfully');
            }
            $user_id = isset($postalldata["manager"]) && (!empty($postalldata["manager"])) ? $postalldata["manager"] : 0;
            redirect("admin/delivery/calender/" . $oid . "/" . $dvyid . "/" . $user_id);
        }

        $data['diagnose_id'] = $dvyid;
        $data['start_end'] = $this->deliveries->getDeliveryStartEndDate($dvyid);
        $data['selectedResource'] = $resourceid > 0 ? $resourceid : 0;
        $this->template->headingtitle = "Assign Date Resources";
        $this->template->set_breadcrumb("ORDER LISTING", site_url("admin/order"));
        $this->template->set_breadcrumb("DELIVERY LISTING", site_url("admin/delivery/index/" . $oid));
        $this->template->set_breadcrumb("ASSIGN DATE ", "");
        //echo "111<pre>";print_r($data);die;
        $this->template->build('calender', array('frmdata' => $data));
    }

    //TIME SLOT MANAGER
    public function timeslot($oid = "", $dvyid = "", $resourceid = '') {
        $where['order_type'] = 3;
        $data['allmanager'] = single_array($this->diagnoses->getAllManagers($dvyid, $where), 'id', 'name', 'Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($dvyid, $where);
        $data['calluser'] = $this->diagnoses->getCallUserEmail($oid, $dvyid);
        if(!empty($resourceid)){
            $data['selectedResource']=$resourceid;
        }
        //echo "<pre>";print_r($data);die;
        $array_of_call = array(28, 29, 20, 21, 22, 27, 25);
        if ($this->input->post()) {
            //$diagnosedata=array();
            $postalldata = $this->input->post();
            $data['allTimeSlots'] = (array) $this->deliveries->getAllTimeSlotsByResouceIdDiagnoseId($postalldata['order_id'], $postalldata['diagnose_id'], $postalldata['manager']);
            $data['selectedResource'] = $postalldata['manager'];
            // echo "<pre>";print_r($data);die;
            if ($data['selectedResource'] > 0) {
                
            }
            //echo "<pre>";print_r($postalldata);die;
            if (!empty($assigndataid))
                $this->messages->flash('Assigned Date Successfully');
            //$user_id=isset($postalldata["manager"])&&(!empty($postalldata["manager"]))?$postalldata["manager"]:0;
            //redirect("admin/delivery/calender/".$oid."/".$dvyid."/".$user_id);
            //echo "<pre>1234";print_r($data);die;
        }

        $data['diagnose_id'] = $dvyid;
        $data['order_id'] = $oid;
        $data['start_end'] = $this->deliveries->getDeliveryStartEndDate($dvyid);

        //$data['selectedResource'] = $resourceid>0?$resourceid:0;
        if (isset($data['selectedResource']) && $data['selectedResource'] > 0) {
            $data['allTimeSlots'] = (array) $this->deliveries->getAllTimeSlotsByResouceIdDiagnoseId($oid, $dvyid, $data['selectedResource']);
        }
        //echo "<pre>123";print_r($data);die;
        //if($resourceid>0)
        //$data['allTimeSlots'] = (array)$this->deliveries->getAllTimeSlotsByResouceIdDiagnoseId($oid,$dvyid,$resourceid);

        $this->template->headingtitle = "Time Slots";
        $this->template->set_breadcrumb("ORDER LISTING", site_url("admin/order"));
        $this->template->set_breadcrumb("DELIVERY LISTING", site_url("admin/delivery/index/" . $oid));
        $this->template->set_breadcrumb("TIME SLOTS ", "");
        $this->template->build('time_slots', array('frmdata' => $data));
    }

    
    public function updateTimeSlotpop($id=0,$order_id=0,$delivery_id=0,$resource_id=0,$user_id=0) {
        //$current_id =
        $this->template->set_layout("ajax");
        $singleRecord = $this->deliveries->getTimeSlotDetailById($id);
        $allUserlist = single_array($this->users->showAllUsersForCalling($order_id,$delivery_id),'id', 'name', 'Select User');
        //echo "<pre>";print_r($allUserlist);die;
        $data=array('timeslotid'=>$id,'order_id'=>$order_id,'delivery_id'=>$delivery_id,'resource_id'=>$resource_id,'user_id'=>$user_id,'singlerecord'=>$singleRecord,'userlist'=>$allUserlist);
        $this->template->build('update_time_slot_pop', array('frmdata' => $data));
    }
    
    //updating information with timeslot and user
    
    public function updateTimeSlotWithUser() {
        $postalldata = $this->input->post();
        //echo "<pre>";print_r($postalldata);die;
        
        //now calulating time
        $getdayStart = date('d',$postalldata['otimestampstart']);
        $getMonthStart = date('m',$postalldata['otimestampstart']);
        $getYearStart = date('Y',$postalldata['otimestampstart']);
        $dateStart=date_create($getYearStart."-".$getMonthStart."-".$getdayStart." ".$postalldata['starttime']);
        $startdate =  date_format($dateStart,"Y/m/d h:i A");
        $currentStartTime =strtotime($startdate);
        $currentStartTimeOld = $postalldata['otimestampstart'];
        
        $getdayEnd = date('d',$postalldata['otimestampend']);
        $getMonthEnd = date('m',$postalldata['otimestampend']);
        $getYearEnd = date('Y',$postalldata['otimestampend']);
        $dateEnd=date_create($getYearEnd."-".$getMonthStart."-".$getdayEnd." ".$postalldata['endtime']);
        $Enddate =  date_format($dateEnd,"Y/m/d h:i A");
        $currentEndTime =strtotime($Enddate);
        $currentEndTimeOld = $postalldata['otimestampend'];
        
        //echo $currentStartTime."******".$currentStartTimeOld."<hr>";
        //echo $currentEndTime."******".$currentEndTimeOld;die;
        if(($currentStartTime!=$currentStartTimeOld) || ($currentEndTime!=$currentEndTimeOld)){
            $dataforupdate = array(
                                    'time_slot_start'=>date('jS F, Y h:i A', $currentStartTime),
                                    'time_slot_end'=>date('jS F, Y h:i A', $currentEndTime),
                                    'timestampstart'=>$currentStartTime,
                                    'timestampend'=>$currentEndTime
                                  );
            $whereArray = array('id'=>$postalldata['timeslotid']);
            $this->deliveries->updateTimeSlotTimeBySlotId($dataforupdate,$whereArray);
            $this->messages->flash('Time Slot Information Updated.');
        }        
        //$starttime = $getYear
        if(isset($postalldata['selectuser']) && !empty($postalldata['selectuser'])){
            //check preexising
            $time_slot_id = $this->deliveries->getInfoByTimeSlotid($postalldata['timeslotid']);
            if(isset($time_slot_id->id)){
                $this->deliveries->updateTimeSlotWithUser($postalldata['timeslotid'],$postalldata['selectuser']);
                //update
            }else{
                //now update user map
                $data['time_slot_id']=$postalldata['timeslotid'];
                $data['user_id']=$postalldata['selectuser'];
                $this->deliveries->saveUserTimeSlotMap($data);
            }
        $this->messages->flash('User Information Updated.');
        }
        redirect('admin/delivery/timeslot/'. $postalldata['order_id'] . "/" . $postalldata['delivery_id']."/".$postalldata['resource_id']);
    }
    
    //fetch all time slots 
    public function sendTimeSlotToAllCallers($order_id = 0, $delivery_id = 0, $resource_id = 0) {

        $allUsersList = $this->deliveries->getCallerData($order_id, $delivery_id);
        //echo "<pre>123";print_r($allUsersList);die;
        //now send email to these users
        //$this->load->library('email');
        // echo "<pre>1234";print_r($allUsersList);die;
        foreach ($allUsersList as $userInfo) {
            //echo "<pre>";print_r($userInfo);die;
            $userid = $userInfo->id;
            $uname = $userInfo->name;
            $email = $userInfo->email;
            $product = $userInfo->productname;
            $subproduct = $userInfo->subproduct;
            //$Time=substr($userInfo->Time,0,-8);
            $location = $userInfo->location;
            // $email="anujmn@gemailmail.com";
            $link1 = site_url('usercall_accept/index/' . $order_id . '/' . $delivery_id . '/' . $userid);
            $this->email->to($email);
            //$this->email->to($ecoemail);                
            //$this->email->to('send2ranu@gmail.com');                
            $this->email->from('info@maynardleighonline.in ');
            $this->email->set_mailtype("html");
            $maildata = $this->mails->getMailById(25);
            //echo "<pre>1234";print_r($maildata);die;
            $information = array(
                //'username'=>$ecoemail,
                'NAME' => ucfirst($uname),
                'LINK' => $link1,
                'JOB' => $product,
                'SUBPRODUCT' => $subproduct,
                'DATE' => $Time,
                'LOCATION' => $location
            );

            $datainfo = $this->messages->mailData($information, $maildata->mailbody);
            //echo "<pre>";print_r($datainfo);die;
            $bodymessage = $this->messages->mailTemplate($datainfo);
            $this->email->subject($maildata->mailsubject);
            $this->email->message($bodymessage);
            $this->email->send();

            //if($this->email->_replyto_flag==1)

            $this->email->clear();
        }
        $this->messages->flash('Email has been sent');
        redirect('admin/delivery/timeslot/' . $order_id . "/" . $delivery_id);
        //echo "<pre>22222";print_r($allUsersList);die;
        //$allTimeSlots = $this->deliveries->getAllTimeSlotsByResouceIdDiagnoseId($order_id,$delivery_id,$resource_id);
        //$allTimeSlots = (array)$this->deliveries->getAllTimeSlotsByResouceIdDiagnoseId($allpostvalues['managerid'],$allpostvalues['diagnoseid']);
        //echo json_encode($allTimeSlots);die;
    }

    public function deleteTimeslot($id = 0, $order_id = 0, $delivery_id = 0, $resouces_id = 0) {
        $delete = $this->deliveries->deleteTimeSlotById($id);
        if ($delete == 1)
            $this->messages->flash("Time Slot deleted successfully !");
        redirect('admin/delivery/timeslot/' . $order_id . "/" . $delivery_id . "/" . $resouces_id);
    }

    public function calenderbydateshift($oid = "", $dvyid = "", $resourceid = '') {
        $where['order_type'] = 3;
        $data['allmanager'] = single_array($this->diagnoses->getAllManagers($dvyid, $where), 'id', 'name', 'Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($dvyid, $where);
        $data['calluser'] = $this->diagnoses->getCallUserEmail($oid, $dvyid);
        //echo "<pre>";print_r($data);die;
        $array_of_call = array(28, 29, 20, 21, 22, 27, 25);
        if ($this->input->post()) {
            //$diagnosedata=array();
            $postalldata = $this->input->post();
            $datainfo = $this->deliveries->deliveryTiming(array("D.order_id" => $oid, "D.id" => $dvyid));
            //Date Range
            $datatiming = explode("-", $postalldata["daterange"]);
            $datatiming[0] = explode(" ", trim($datatiming[0]));
            $datatiming[1] = explode(" ", trim($datatiming[1]));
            $datatiming['startdate'] = DateTime::createFromFormat('m/d/Y h:i A', $datatiming[0][0] . " " . $datatiming[0][1] . " " . $datatiming[0][2]);
            $datatiming['enddate'] = DateTime::createFromFormat('m/d/Y h:i A', $datatiming[1][0] . " " . $datatiming[1][1] . " " . $datatiming[1][2]);

            $dteDiff = $datatiming['startdate']->diff($datatiming['enddate']);
            $totalminutesintv = ($dteDiff->days * 24 * 60) + ($dteDiff->h * 60) + $dteDiff->i;
            $ii = 0;
            $allintervals = array();







            $datainfo = explode(" ", $postalldata["daterange"]);
            $tstartdatetime = strtotime($datainfo[0] . ' ' . $datainfo[1] . " " . $datainfo[2]);
            $tenddatetime = strtotime($datainfo[4] . ' ' . $datainfo[5] . " " . $datainfo[6]);
            $startdata = trim($datainfo[0]);
            $starttime = trim($datainfo[1] . " " . $datainfo[2]);
            $enddata = trim($datainfo[4]);
            $endtime = trim($datainfo[5] . " " . $datainfo[6]);

            $assigndata = array(
                "order_id" => $oid,
                "diagnose_id" => $postalldata["diagnose_id"],
                "manager_id" => $postalldata["manager"],
                "start_date" => $startdata,
                "start_time" => $starttime,
                "end_date" => $enddata,
                "end_time" => $endtime,
                "tstartdatetime" => $tstartdatetime,
                "tenddatetime" => $tenddatetime,
                "order_type" => 3
            );
            $this->load->library('email');

            //echo $link;die;
            $mgid = $this->input->post('manager');
            $datetimerange = $this->input->post('daterange');
            $datetime = explode('-', $datetimerange);
            $startdttime = strtotime($datetime['0']);
            $enddttime = strtotime($datetime['1']);

            $allEmail = $this->orders->getSellerUserEmail($oid);
            $AllemailInComma = implode(",", $allEmail);
            //$this->email->to($AllemailInComma);
            $AllemailInComma = $postalldata['cast_email'] . "," . $AllemailInComma;
            //get email address and name of resource
            $AllInfoOfUser = $this->users->getUsersInfoById($postalldata["manager"]);
            $this->email->to($AllInfoOfUser->email);

            $this->email->from('info@maynardleighonline.in');
            $this->email->set_mailtype("html");
            $maildata = $this->mails->getMailById(3);
            $link = site_url('user/resource_login');
            if (date("jS F, Y", $startdttime) == date("jS F, Y", $enddttime)) {
                $datevalue = date("jS F, Y", $startdttime);
            } else {
                $datevalue = date("jS F, Y", $startdttime) . "-" . date("jS F, Y", $enddttime);
            }

            $information = array('name' => $AllInfoOfUser->name, 'client' => $postalldata['client_name'], 'job' => $postalldata['product_name'], 'subproduct' => $postalldata['subpro'], 'location' => $postalldata['location'],
                'date' => $datevalue,
                'time' => date("h:i:s A", $startdttime) . "-" . date("h:i:s A", $enddttime),
                'link' => $link);
            $datainfo = $this->messages->mailData($information, $maildata->mailbody);
            $bodymessage = $this->messages->mailTemplate($datainfo);
            $this->email->subject($maildata->mailsubject);
            $this->email->message($bodymessage);


            //echo "<pre>";print_r($assigndata);die;
            //$managerstartdate=$this->diagnoses->getStartDateEndDate($mgid);
            $datas = $this->diagnoses->checkRestrictedDateTime($startdttime, $enddttime, $mgid, $dvyid);
            //echo "@@<pre>";print_r(count($datas));die;
            if ($datas) {
                $this->messages->flash('Resource is busy on this date', 'error');
            } else {
                //echo "<pre>";print_r($this->email);die;
                $this->email->send();
                $this->email->clear();
                $assigndataid = $this->diagnoses->addAssignDate($assigndata);

                $usermapdata = $this->deliveries->getusermapData(array("D.order_id" => $oid, "D.id" => $dvyid));
                $id = $usermapdata->id;
                $user_id = $usermapdata->user_id;
                if (!empty($assigndataid))
                    $this->messages->flash('Assigned Date Successfully');
            }
            $user_id = isset($postalldata["manager"]) && (!empty($postalldata["manager"])) ? $postalldata["manager"] : 0;
            redirect("admin/delivery/calender/" . $oid . "/" . $dvyid . "/" . $user_id);
        }

        $data['diagnose_id'] = $dvyid;
        $data['start_end'] = $this->deliveries->getDeliveryStartEndDate($dvyid);
        $data['selectedResource'] = $resourceid > 0 ? $resourceid : 0;
        $this->template->headingtitle = "Assign Date Resources";
        $this->template->set_breadcrumb("ORDER LISTING", site_url("admin/order"));
        $this->template->set_breadcrumb("DELIVERY LISTING", site_url("admin/delivery/index/" . $oid));
        $this->template->set_breadcrumb("ASSIGN DATE ", "");
        //echo "111<pre>";print_r($data);die;
        $this->template->build('calender', array('frmdata' => $data));
    }

    function getAssignDate() {

        $diaid = $this->input->post('diagnoseid');
        $mgrid = $this->input->post('managerid');
        $delivery['d_view'] = $this->diagnoses->getCalenderDetails($diaid, $mgrid);
        //echo "%%%<pre>";print_r($delivery);die;

        $results = array();
        $comment = '';
        $statusArray = array(0 => 'Awaiting', 1 => 'Accepted', 2 => 'Rejected');
        $this->load->model('workreport/workreports');
        foreach ($delivery['d_view'] as $k => $v) {
            $comment = "";
            if ($v->status == '2') {
                $comment = $v->comment;
            } else {
                $comment = "";
            }

            $allInternalInfo = $this->workreports->getMoreInfoForResource($v->diagnose_id, $v->order_type);
            //echo "<pre>12345";print_r($v);echo "<hr>";
            //echo "<pre>12345";print_r($allInternalInfo);die;

            $results[] = array("id" => $v->id,
                "time_duration" => $v->start_time . "-" . $v->end_time,
                "title" => $allInternalInfo->subname,
                "location" => ucfirst($allInternalInfo->location),
                "name" => ucfirst($allInternalInfo->name),
                "statusvalue" => $statusArray[$v->status],
                "comments" => $comment, "className" => 'eventColor' . $statusArray[$v->status],
                "start" => date("Y-m-d", strtotime($v->start_date)),
                "end" => date("Y-m-d", strtotime($v->end_date . " +1 day")));
            //echo "%%%<pre>";print_r($v);
        }//die;
        //echo "<pre>";print_r($results);die;
        return $this->output->set_content_type('application/json')->set_output(json_encode($results));
    }

    public function viewCalender() {
        $this->template->build('viewCalender');
    }

    public function mailTravelRequestForm() {//die('fvrfvrv');
        $this->load->library('email');
        $this->load->library("IMpdf", "impdf");

        $data = array();
        $data['order_id'] = $this->input->post('oid');
        $data['diagnose_id'] = $this->input->post('digid');
        $data['user_id'] = $this->input->post('user_id');
        $id['id'] = $this->input->post('id');
        $email = $this->input->post('email');
        //echo "<pre>";print_r($id);die;
        //$data['resourceInfos']=$this->diagnoses->getResourcesById($data,$id);      
        $data['userDetails'] = $this->diagnoses->getdetailsById($data['user_id']);


        //$data['userDetails']=$this->diagnoses->getdetailsById($data['user_id']);



        $data['resourceInfos'] = $this->diagnoses->getTRFById($id['id']);
        //echo "<pre>";print_r($data);die;
        //for cab get all information
        //if($data['resourceInfos'])

        $this->load->model('order/orders');
        $data['diagnose_detail'] = $this->diagnoses->getDiagnosesInforationById($data['diagnose_id'], 'delivery');

        $whereArray = array('O.id' => $data['order_id']);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray);



        //special case for cab
        if ($data['resourceInfos']->mode == 'cab') {
            $data['resourceInfos']->cab = (array) $this->diagnoses->getTRFByIdForCab($data['diagnose_id'], $data['order_id'], $data['user_id']);
            //echo "<pre>";print_r($data['resourceInfos']);die;
        }
        $data['allmode'][] = $data['resourceInfos'];
        $datainfo = $this->load->view("diagnose/mail/pdfresource", $data, true);

        //PDF Generate
        //echo "<pre>11";print_r($data);die;
        //echo "<pre>";print_r($datainfo);die;
        /* $this->impdf->mpdf->SetDisplayMode('fullpage');
          $this->impdf->mpdf->WriteHTML($datainfo);
          $fullpath = PUBLIC_PATH."upload/resourcepdf/SIXRES".time().".pdf";
          $this->impdf->mpdf->Output($fullpath); */

        // echo "<pre>";print_r($email);die;
        //$this->email->to($data['userDetails']->email);    
        //$this->email->to($data['userDetails']->email); 
        $allEmail = $this->orders->getSellerUserEmail($data['order_id']);
        $AllemailInComma = implode(",", $allEmail);
        //$this->email->to($AllemailInComma);
        $AllemailInComma = $email . "," . $AllemailInComma;

        //$this->email->to($email);                
        $this->email->to($AllemailInComma);
        //$this->email->to($email);                  
        $this->email->from('info@maynardleighonline.in');
        $this->email->set_mailtype("html");
        // $maildata = $this->mails->getMailById(3);
        // $information = array('name'=>$data['userDetails']->name,'contact'=>$data['userDetails']->contact_no);
        // $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
        // $bodymessage = $this->messages->mailTemplate($datainfo);
        $bodymessage = $this->load->view("diagnose/mail/pdfresource", array("frmdata" => $data), true);
        $this->email->subject("Maynardeleigh || Travel Request Form");
        // $this->email->subject($maildata->mailsubject);
        $this->email->message($bodymessage);
        //$this->email->attach($fullpath);
        //echo "<pre>";print_r($this->email);die;
        $status = $this->email->send();
        $this->email->clear();
        if ($status) {
            $this->messages->flash("Your message has been sent");
        }
        redirect("admin/delivery/trf/" . $data['order_id'] . "/" . $data['diagnose_id']);
    }

    public function mailTravelRequestFormClient($oid = "", $digid = "", $user_id = "") {//die('hcgdyuchduhfc');
        $this->load->library('email');
        $this->load->library("IMpdf", "impdf");

        $data = array();
        $postalldata = $this->input->post();
        //echo "<pre>";print_r($postalldata);die;
        $data['order_id'] = $postalldata['oid'];
        $data['diagnose_id'] = $postalldata['digid'];
        $data['user_id'] = $postalldata['user_id'];
        $oid = $data['order_id'];
        $digid = $data['diagnose_id'];
        $user_id = $data['user_id'];

        $this->load->model('order/orders');
        //$data['resourceInfos']=$this->diagnoses->getResourcesById($data);      
        //$data['userDetails']=$this->diagnoses->getdetailsById($user_id); 


        $data['resourceInfos'] = $this->diagnoses->getResourcesById($data);
        $data['userDetails'] = $this->diagnoses->getdetailsById($data['user_id']);
        $data['diagnose_detail'] = $this->diagnoses->getDiagnosesInforationById($data['diagnose_id'], 'delivery');
        $whereArray = array('O.id' => $data['order_id']);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray);

        //echo "<pre>pds".$data['userDetails']->email;die;
        //PDF Generate
        //echo "<pre>12345";print_r($data);die;
        $allDataByMode = array();
        foreach ($data['resourceInfos'] as $traindata) {
            $allDataByMode[$traindata->mode][] = $traindata;
        }

        $data['allmode'] = $allDataByMode;
        //echo "<pre>123";print_r($data);die;
        $data['email'] = $postalldata['email'];
        $data['selection'] = $postalldata['selection'];
        //echo "<pre>";print_r($data);die;
        $datainfo = $this->load->view("diagnose/mail/pdfresources_client", $data, true);
        //$datainfo= $this->load->view("diagnose/mail/pdfresources_new",$data,true);
        //echo "<pre>";print_r($datainfo);die;
        //PDF Generate

        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH . "upload/resourcepdf/SIXRES" . time() . ".pdf";
        $this->impdf->mpdf->Output($fullpath);
        //echo "<pre>";print_r($data);die;
        //$this->email->to('kanika@maynardeleigh.in');  
        //die($data['userDetails']->email);

        $this->email->to($data['email']);
        $this->email->from('info@maynardleighonline.in');
        $this->email->set_mailtype("html");
        // $maildata = $this->mails->getMailById(3);
        // $information = array('name'=>$data['userDetails']->name,'contact'=>$data['userDetails']->contact_no);
        //$datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
        // $bodymessage = $this->messages->mailTemplate($datainfo);
        //$bodymessage = $this->load->view("diagnose/mail/pdfresources_client",array("frmdata"=>$data),true);
        //$bodymessage = $this->load->view("diagnose/mail/pdfresource",array("frmdata"=>$data),true);
        $bodymessage = $datainfo;
        $this->email->subject("Maynardleigh || Travel Request Form");
        // $this->email->subject($maildata->mailsubject);
        //$this->email->message($datainfo);
        $this->email->message($bodymessage);
        //$this->email->attach($fullpath);

        $this->email->send();
        //echo "<pre>".$fullpath;print_r($this->email);die;
        $this->email->clear();
        $this->messages->flash("Your message has been sent");

        redirect("admin/delivery/trf/" . $oid . "/" . $digid . '/' . $user_id);
    }

    public function mailTravelRequestFormClientPreview($oid = "", $digid = "", $user_id = "") {
        //die('hcgdyuchduhfc');
        $this->load->library('email');
        $this->load->library("IMpdf", "impdf");
        $data = array();
        $postalldata = $this->input->post();
        $data['order_id'] = $postalldata['oid'];
        $data['diagnose_id'] = $postalldata['digid'];
        $data['user_id'] = $postalldata['user_id'];
        $this->load->model('order/orders');
        $data['resourceInfos'] = $this->diagnoses->getResourcesById($data);
        $data['userDetails'] = $this->diagnoses->getdetailsById($data['user_id']);
        $data['diagnose_detail'] = $this->diagnoses->getDiagnosesInforationById($data['diagnose_id'], 'delivery');
        $whereArray = array('O.id' => $data['order_id'], 'D.id' => $data['diagnose_id']);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray, 3);

        $allDataByMode = array();
        foreach ($data['resourceInfos'] as $traindata) {
            $allDataByMode[$traindata->mode][] = $traindata;
        }
        $data['allmode'] = $allDataByMode;
        $data['email'] = $postalldata['email'];
        $data['selection'] = $postalldata['selection'];
        $datainfo = $this->load->view("diagnose/mail/pdfresources_client", $data, true);
        $data['preview'] = $datainfo;
        //echo "<pre>";print_r($data);die;
        $this->template->set_layout('contract_layout');
        $this->template->build('mailclientpreview', array('frm_data' => $data));
    }

    public function mailVenderRequestForm($oid = "", $digid = "", $user_id = "") {//die('hcgdyuchduhfc');
        $this->load->library('email');
        $this->load->library("IMpdf", "impdf");

        $data = array();
        $data['order_id'] = $oid;
        $data['diagnose_id'] = $digid;
        $data['user_id'] = $user_id;
        $this->load->model('order/orders');
        //$data['resourceInfos']=$this->diagnoses->getResourcesById($data);      
        //$data['userDetails']=$this->diagnoses->getdetailsById($user_id); 


        $data['resourceInfos'] = $this->diagnoses->getResourcesById($data);
        $data['userDetails'] = $this->diagnoses->getdetailsById($user_id);
        $data['diagnose_detail'] = $this->diagnoses->getDiagnosesInforationById($digid, 'delivery');
        $whereArray = array('O.id' => $oid);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray);

        //echo "<pre>pds".$data['userDetails']->email;die;
        //PDF Generate
        //echo "<pre>12345";print_r($data);die;
        $allDataByMode = array();
        foreach ($data['resourceInfos'] as $traindata) {
            $allDataByMode[$traindata->mode][] = $traindata;
        }

        $data['allmode'] = $allDataByMode;
        //echo "<pre>123";print_r($data);die;
        $datainfo = $this->load->view("diagnose/mail/pdfresources_d", $data, true);
        //$datainfo= $this->load->view("diagnose/mail/pdfresources_new",$data,true);
        //echo "<pre>";print_r($datainfo);die;
        //PDF Generate

        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH . "upload/resourcepdf/SIXRES" . time() . ".pdf";
        $this->impdf->mpdf->Output($fullpath);

        //echo "<pre>";print_r($data);die;
        //$this->email->to('kanika@maynardeleigh.in');  
        //die($data['userDetails']->email);
        $this->email->to($data['userDetails'][0]->email);
        $this->email->from('info@maynardleighonline.in');
        $this->email->set_mailtype("html");
        // $maildata = $this->mails->getMailById(3);
        // $information = array('name'=>$data['userDetails']->name,'contact'=>$data['userDetails']->contact_no);
        //$datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
        // $bodymessage = $this->messages->mailTemplate($datainfo);
        $bodymessage = $this->load->view("diagnose/mail/pdfresources_d", array("frmdata" => $data), true);
        //$bodymessage = $this->load->view("diagnose/mail/pdfresource",array("frmdata"=>$data),true);
        $this->email->subject("Maynardeleigh || Logistics Email");
        // $this->email->subject($maildata->mailsubject);
        //$this->email->message($datainfo);
        $this->email->message($bodymessage);
        $this->email->attach($fullpath);

        $this->email->send();
        //echo "<pre>".$fullpath;print_r($this->email);die;
        $this->email->clear();
        $this->messages->flash("Your message has been sent");

        redirect("admin/delivery/trf/" . $oid . "/" . $digid . '/' . $user_id);
    }

    //sending email to resource
    public function mailVenderRequestFormPreview($oid = "", $digid = "", $user_id = "") {//die('hcgdyuchduhfc');
        //send email start ********************************************
        if ($this->input->post()) {
            $allPost = $this->input->post();
            $this->email->to($allPost['user_email_id']);
            $this->email->from('info@maynardleighonline.in');
            $this->email->set_mailtype("html");
            $maildata = $this->mails->getMailById(26);

            //save file on server at local level
            //echo "<pre>";print_r($_FILES);die;
            $trainticket = "";
            $cabticket  =   "";
            $airticket  =   "";
            $participant_list = "";
            $partipant_url_global   =   "";
            $air_ticket_global   =   "";
            $cab_ticket_url_global  =   "";
            $train_ticket_url_global  =   "";
            
            $uploadvalue = array();
            
            unset($uploadvalue);
            if (isset($_FILES['train_ticket'])) {
                //$uploadvalue['name'] = $uploadfiles['name'][$key];
                $name = $_FILES['train_ticket']['name'];
                $ext = end((explode(".", $name))); # extra () to prevent notice
                $train_ticket_url = ((isset($_FILES['train_ticket']['name']))&&(!empty($_FILES['train_ticket']['name']))) ? "train_ticket".time().".".$ext:'';
                //public url
                $train_ticket_url_global = ((isset($_FILES['train_ticket']['name']))&&(!empty($_FILES['train_ticket']['name']))) ? site_url().PUBLIC_ULR."/documents/".$train_ticket_url:"";
                //$uploadvalue['name'] = str_replace(array(' ', "'", ","), array('_', "_", "_"), $_FILES['participant_list']['name']);
                $uploadvalue['name'] = $train_ticket_url;
                //$uploadvalue['name'] = str_replace(array(' ', "'", ","), array('_', "_", "_"), $_FILES['train_ticket']['name']);
                $uploadvalue['type'] = $_FILES['train_ticket']['type'];
                $uploadvalue['tmp_name'] = $_FILES['train_ticket']['tmp_name'];
                $uploadvalue['error'] = $_FILES['train_ticket']['error'];
                $uploadvalue['size'] = $_FILES['train_ticket']['size'];
                $_FILES['tmpdocuments'] = $uploadvalue;
                $this->UploadImageDoc($_FILES['tmpdocuments']);
                //echo "<pre>";print_r($_FILES);die;
                //echo "<pre>123";print_r($this->UploadImageDoc($_FILES['tmpdocuments']));die;
                
                //$trainticket = !empty($uploadvalue['name']) ? PUBLIC_PATH . "documents/" . $uploadvalue['name'] : "";
            }
            unset($uploadvalue);
            if (isset($_FILES['participant_list'])) {
                //$uploadvalue['name'] = $uploadfiles['name'][$key];
                $name = $_FILES['participant_list']['name'];
                $ext = end((explode(".", $name))); # extra () to prevent notice
                $participant_url = "participantlist".time().".".$ext;
                //public url
                $partipant_url_global = ((isset($_FILES['participant_list']['name']))&&(!empty($_FILES['participant_list']['name']))) ? site_url().PUBLIC_ULR."/documents/".$participant_url:"";
                //$uploadvalue['name'] = str_replace(array(' ', "'", ","), array('_', "_", "_"), $_FILES['participant_list']['name']);
                $uploadvalue['name'] = $participant_url;
                $uploadvalue['type'] = $_FILES['participant_list']['type'];
                $uploadvalue['tmp_name'] = $_FILES['participant_list']['tmp_name'];
                $uploadvalue['error'] = $_FILES['participant_list']['error'];
                $uploadvalue['size'] = $_FILES['participant_list']['size'];
                $_FILES['tmpdocuments'] = $uploadvalue;

                $this->UploadImageDoc($_FILES['tmpdocuments']);
                //$participant_list = !empty($uploadvalue['name']) ? PUBLIC_PATH . "documents/" . $uploadvalue['name'] : "";
                
            }
            $uploadvalue = array();
            unset($uploadvalue);
            if (isset($_FILES['cab_ticket'])) {
                $name = $_FILES['cab_ticket']['name'];
                $ext = end((explode(".", $name))); # extra () to prevent notice
                $cab_ticket_url = "cab_ticket".time().".".$ext;
                //public url
                $cab_ticket_url_global = ((isset($_FILES['cab_ticket']['name']))&&(!empty($_FILES['cab_ticket']['name']))) ? site_url().PUBLIC_ULR."/documents/".$cab_ticket_url:"";
                $uploadvalue['name'] = $cab_ticket_url;
                //$uploadvalue['name'] = str_replace(array(' ', "'", ","), array('_', "_", "_"), $_FILES['cab_ticket']['name']);
                $uploadvalue['type'] = $_FILES['cab_ticket']['type'];
                $uploadvalue['tmp_name'] = $_FILES['cab_ticket']['tmp_name'];
                $uploadvalue['error'] = $_FILES['cab_ticket']['error'];
                $uploadvalue['size'] = $_FILES['cab_ticket']['size'];
                $_FILES['tmpdocuments'] = $uploadvalue;
                $this->UploadImageDoc($_FILES['tmpdocuments']);

                //$cabticket = !empty($uploadvalue['name']) ? PUBLIC_PATH . "documents/" . $uploadvalue['name'] : '';
            }
            unset($uploadvalue);
            $uploadvalue = array();
            if (isset($_FILES['air_ticket'])) {
                $name = $_FILES['air_ticket']['name'];
                $ext = end((explode(".", $name))); # extra () to prevent notice
                $air_ticket_url = "air_ticket".time().".".$ext;
                //public url
                $air_ticket_global = ((isset($_FILES['air_ticket']['name']))&&(!empty($_FILES['air_ticket']['name']))) ? site_url().PUBLIC_ULR."/documents/".$air_ticket_url:"";
                //$uploadvalue['name'] = str_replace(array(' ', "'", ","), array('_', "_", "_"), $_FILES['air_ticket']['name']);
                $uploadvalue['name'] = $air_ticket_url;
                $uploadvalue['type'] = $_FILES['air_ticket']['type'];
                $uploadvalue['tmp_name'] = $_FILES['air_ticket']['tmp_name'];
                $uploadvalue['error'] = $_FILES['air_ticket']['error'];
                $uploadvalue['size'] = $_FILES['air_ticket']['size'];
                $_FILES['tmpdocuments'] = $uploadvalue;
                $this->UploadImageDoc($_FILES['tmpdocuments']);
                //$airticket = !empty($uploadvalue['name']) ? PUBLIC_PATH . "documents/" . $uploadvalue['name'] : "";
            }

            //echo "<pre>11";print_r($trainticket);
            //echo "<pre>1122";print_r($cabticket);
            //echo "<pre>3333";print_r($airticket);die;
            
            $information = array(
                'client_name' => $allPost['client_name'],
                'course' => $allPost['course'],
                'workshopdate' => $allPost['workshopdate'],
                'workshop_time' => $allPost['workshop_time'],
                'leader' => $allPost['leader'],
                'leader_arrival' => $allPost['leader_arrival'],
                'venue' => $allPost['venue'],
                'accommodation' => $allPost['accommodation'],
                'roomlayout' => $allPost['roomlayout'],
                'no_of_participant' => $allPost['no_of_participant'].(((isset($partipant_url_global)) && (!empty($partipant_url_global)) && (!empty($partipant_url_global)))?'  <a target="_blank" href="'.$partipant_url_global.'">Attachment</a>':""),
                'vms' => $allPost['vms'],
                'handouts' => $allPost['handouts'],
                'air' => isset($allPost['air'])?$allPost['air'].(((isset($air_ticket_global)) && (!empty($air_ticket_global)) && (!empty($air_ticket_global)))?'  <a target="_blank" href="'.$air_ticket_global.'">Attachment</a>':''):'N/A',
                'train' => isset($allPost['train'])?$allPost['train'].((isset($train_ticket_url_global) && !empty($train_ticket_url_global))  && (!empty($train_ticket_url_global))?'  <a target="_blank" href="'.$train_ticket_url_global.'">Attachment</a>':''):"N/A",
                'cab' => isset($allPost['cab'])?$allPost['cab'].((isset($cab_ticket_url_global) && !empty($cab_ticket_url_global))  && (!empty($cab_ticket_url_global))?'  <a target="_blank" href="'.$cab_ticket_url_global.'">Attachment</a>':''):'N/A',
                'contact_person' => $allPost['contact_person'],
            );
           
            $datainfo = $this->messages->mailData($information, $maildata->mailbody);
            $bodymessage = $this->messages->mailTemplate($datainfo);
             $this->email->subject($maildata->mailsubject);
            $this->email->message($bodymessage);
            
            
            //echo "<pre>";print_r($this->email);die;
            $this->email->send();
            $this->email->clear();
            if (!empty($trainticket)) {
                unlink($trainticket);
            }
            if (!empty($airticket)) {
                unlink($airticket);
            }
            if (!empty($cabticket)) {
                //$this->email->attach($cabticket);
                unlink($cabticket);
            }
            $this->messages->flash('Email sent successfully!.');
            redirect("admin/delivery/trf/" . $allPost['oid'] . "/" . $allPost['digid'] . '/' . $allPost['user_id']);
        }
        //send email end ********************************************** 


        $this->load->library('email');
        $this->load->library("IMpdf", "impdf");
        
        if(function_exists('date_default_timezone_set')) date_default_timezone_set("Asia/Calcutta");
        
        $data = array();
        $data['order_id'] = $oid;
        $data['diagnose_id'] = $digid;
        $data['user_id'] = $user_id;
        $this->load->model('order/orders');
        $this->load->model('welcome/welcomes');
        $this->load->model('diagnose/diagnoses');
        //$data['resourceInfos']=$this->diagnoses->getResourcesById($data);      
        //$data['userDetails']=$this->diagnoses->getdetailsById($user_id); 


        $data['resourceInfos'] = $this->diagnoses->getResourcesById($data);
        $data['userDetails'] = $this->diagnoses->getdetailsById($user_id);
        $data['diagnose_detail'] = $this->diagnoses->getDiagnosesInforationById($digid, 'delivery');
        $whereArray = array('O.id' => $oid);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray);
        //echo "<pre>";print_r($data);die;
        $data['time_detail'] = $this->welcomes->getAssignDateDetails(array('casting_id'=>$user_id,'order_id'=>$oid,'diagnose_id'=>$digid));
        //$data['time_detail'][0] = $this->diagnoses->getResourcesAssignDetailsForUpdateResource($digid,3,$user_id);

        //echo "<pre>pds".$data;die;
        //PDF Generate
        $strtotime = $data['time_detail'][0]->tstartdatetime;
//        echo "<pre>12345".$strtotime;print_r($data['time_detail']);echo "<hr>";
  //      echo "<pre>12345".date('H:i A',$strtotime);print_r($data['time_detail']);die;
        $allDataByMode = array();
        foreach ($data['resourceInfos'] as $traindata) {
            $allDataByMode[$traindata->mode][] = $traindata;
        }

        //echo "<pre>";print_r($data);die;
        $data['allmode'] = $allDataByMode;
        $datainfo = $this->load->view("diagnose/mail/pdfresources_d", $data, true);
        //echo "<pre>";print_r($datainfo);die;
        $data['preview'] = $datainfo;

        $this->template->headingtitle = "Logistics Email Preview";
        $this->template->set_breadcrumb("ORDER LISTING", site_url("admin/order/index"));
        $this->template->set_breadcrumb("DELIVERY LISTING", site_url("admin/delivery/index/" . $oid));
        $this->template->set_breadcrumb("TRAVEL REQUEST FORM", site_url("admin/delivery/trf/" . $oid . "/" . $digid . "/" . $user_id));
        $this->template->set_breadcrumb("LOGISTICS EMAIL ", "");


        //echo "<pre>";print_r($data);die;
        //$this->template->set_layout('contract_layout');
        $this->template->add_js("assests/itfeditor/ckeditor.js");
        $this->template->add_js(" $(document).ready(function(){
			CKEDITOR.replace('cab', {});
			CKEDITOR.replace('train', {});
			CKEDITOR.replace('air', {});
                        
                });", "B", "embed");
        $this->template->build('mailformpreview', array('frm_data' => $data));
        //redirect("admin/delivery/trf/".$oid."/".$digid.'/'.$user_id);
    }

    function mailTravelRequestFormNew($oid = "", $digid = "", $user_id = "", $id = '') {
        //die('zczdc');
        //echo $user_id;die;
        $this->template->set_layout("ajax");
        $data['where'] = array('oid' => $oid, 'digid' => $digid, 'user_id' => $user_id, 'id' => $id);
        //print_r($data);die;mailTravelRequestForm
        $this->template->build('mailform', $data);
    }

    function mailTravelRequestFormNewClient($oid = "", $digid = "", $user_id = "") {
        //die('zczdc');
        //echo $user_id;die;
        $data['where'] = array('oid' => $oid, 'digid' => $digid, 'user_id' => $user_id);
        $this->template->set_layout("ajax");
        //$data['where']=array('oid'=>$oid,'digid'=>$digid);
        //print_r($data);die;mailTravelRequestForm
        $this->template->build('mailformclient', $data);
    }

    public function downloadTRForm($oid = "", $digid = "", $user_id = "") {
        $this->load->library('email');
        $this->load->library("IMpdf", "impdf");

        $data = array();
        $data['order_id'] = $oid;
        $data['diagnose_id'] = $digid;
        $data['user_id'] = $user_id;
        $data['resourceInfos'] = $this->diagnoses->getResourcesById($data);
        $data['userDetails'] = $this->diagnoses->getdetailsById($oid);
        //echo "####<pre>";print_r($data['userDetails']);die;
        //PDF Generate
        $datainfo = $this->load->view("diagnose/mail/pdfresource", $data, true);
        //echo "<pre>";print_r($datainfo);die;
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH . "upload/resourcepdf/SIXRES" . time() . ".pdf";
        $displaypdf = $this->impdf->mpdf->Output($fullpath);

        $filename = explode('/', $fullpath);

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

        redirect($downloadtrfs, 'refresh');

        $this->template->build('diagnose/mail/pdfresource', $data);
    }

    function excelEmport($oid = '', $dlvid = '') {
        //die('dfsdsfsd');
        $this->load->model('order/orders');
        $this->load->library('Excel');
        $this->load->library('upload');
        $client_id = $this->orders->getClientIdByOrderId($oid);
        $client_id = $client_id->client_id;
        if ($_FILES['tmpdocuments']) {
            $config['upload_path'] = PUBLIC_UPLOADPATH . "importusers/";
            $config['allowed_types'] = 'xlsx';
            $config['max_size'] = '20000000';
            $config['max_width'] = '2024';
            $config['max_height'] = '2024';
            $this->load->library('upload');
            $this->upload->initialize($config);

            $result = $this->upload->do_upload('tmpdocuments');
            //die("as222df".$result);
            if ($result >= 1) {
                $imageinfo = $this->upload->data();

                $filename = $imageinfo['full_path'];

                $objPHPExcel = PHPExcel_IOFactory::load($filename);

                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                $failed = 0;
                $success = 0;
                $id = array();
                //echo "<pre>";print_r($allDataInSheet);die;
                foreach ($allDataInSheet as $key => $value) {
                    //echo "<pre>";print_r($)
                    if ($key < 4 || empty($value['B']))
                        continue;
                    $userdata = array();
                    $userdata['name'] = $value['B'];
                    $userdata['contact_no'] = $value['C'];
                    $userdata['age'] = $value['D'];
                    $userdata['department'] = $value['E'];
                    $userdata['designation'] = $value['F'];
                    $userdata['reporting_to'] = $value['G'];
                    $userdata['area_of_responsibility'] = $value['H'];
                    $userdata['yrs_at_ey'] = $value['I'];
                    $userdata['total_experience'] = $value['J'];
                    $userdata['qualification'] = $value['K'];
                    $userdata['training_attended_in_the_past'] = $value['L'];
                    $userdata['previous_employer'] = $value['M'];
                    $userdata['email'] = $value['N'];
                    $userdata['username'] = $value['N'];
                    $userdata['password'] = md5(123456);
                    $userdata['user_type'] = 'N';
                    $userdata['client_id'] = $client_id;
                    //echo "$$$@@@@<pre>";print_r($userdata);die;
                    $email = $userdata['email'];
                    $id = array_keys(single_array($this->users->isUserExist($email), 'id'));
                    if ((isset($id[0])) && ($id[0] > 0)) {
                        //echo "<pre>";print_r($id);die;
                        $user_id = $id[0];
                    } else {
                        $lastinsertedId = $this->users->addUsers($userdata);
                        $user_id = $lastinsertedId;
                    }
                    //$user_id = $id>0?$id:$lastinsertedId;
                    //echo "###<pre>";print_r($user_id);die;
                    if ($usermapdata)
                        unset($usermapdata);
                    $usermapdata = array();
                    //now instert in user map table
                    $usermapdata['order_id'] = $oid;
                    $usermapdata['delivery_id'] = $dlvid;
                    $usermapdata['user_id'] = $user_id;
                    //echo "<pre>";print_r($usermapdata);
                    $checkExistenceInMapTableFlage = $this->users->checkExistenceInMapTableFlage($oid, $dlvid, $user_id);
                    //die("Hell");
                    if (!$checkExistenceInMapTableFlage->id > 0)
                        $this->users->addUsersmap($usermapdata);
                }//echo "#####<pre>";print_r($user_id);die;
                $this->messages->flash('Excel imported successfully.');
            }
            else {

                $data["error_msg"] = $this->upload->display_errors('<span>', '</span>');
                return false;
            }
            //echo "##<pre>";print_r($lastinsertedId);die;
        }
        //echo "##<pre>";print_r($lastinsertedId);die;
        //if($this->input->post('submit')){
        //die('ghvh');
        $data['oid'] = $oid;
        $data['dlvid'] = $dlvid;
        $data['showuserdata'] = $this->users->showAllUsersForCalling($oid, $dlvid);
        //echo "####<pre>";print_r($data);die;
        //}
        //$data['headingtitle']="Front user Listing ";
        $this->template->headingtitle = "User LISTING";
        $this->template->set_breadcrumb("ORDER LISTING", site_url("admin/order/index"));
        $this->template->set_breadcrumb("DELIVERY LISTING", site_url("admin/delivery/index/" . $oid));
        $this->template->set_breadcrumb("USER LISTING", "");
        $this->template->build('admin_index_excel_import', array('frmdata' => $data));
    }

    //show caller list in pop up
    function showCallerList($oid = '', $dlvid = '') {
        $data['oid'] = $oid;
        $data['dlvid'] = $dlvid;
        $data['showuserdata'] = $this->users->showAllUsersForCalling($oid, $dlvid);
        //echo "####<pre>";print_r($data);die;
        //}
        //$data['headingtitle']="Front user Listing ";
        $this->template->headingtitle = "User LISTING";
        $this->template->set_breadcrumb("ORDER LISTING", site_url("admin/order/index"));
        $this->template->set_breadcrumb("DELIVERY LISTING", site_url("admin/delivery/index/" . $oid));
        $this->template->set_breadcrumb("USER LISTING", "");
        //$this->template->build('admin_index_excel_import',array('frmdata'=>$data));
        $this->template->set_layout("ajax");
        $this->template->build('show_caller_listing_popup', array('frmdata' => $data));
    }

    //assging time
    public function assignUser($orderid = 0, $dlvid = 0) {

        $data = array();
        $data['oid'] = $orderid;
        $data['dlvid'] = $dlvid;
        $this->load->model('order/orders');
        $client_id = $this->orders->getClientIdByOrderId($orderid);
        $client_id = $client_id->client_id;
        $data['assignuser'] = single_array($this->users->getcallingUserForSelect($client_id), 'id', 'name');
        $data['selecteduser'] = array_keys(single_array($this->deliveries->getUser($orderid, $dlvid), 'user_id'));
        //echo "####<pre>";print_r($data);die;
        $this->template->set_layout("ajax");
        $this->template->build('usermap', array('frmdata' => $data));
    }

    public function setUser() {
        if ($this->input->post()) {
            $orderId = $this->input->post('orderid');
            $casting_manager = $this->input->post('dnocasting');
            $valueid = $this->input->post('deliveryid');
            //echo "<pre>";print_r($casting_manager);
            //echo "<pre>";print_r($orderId);
            //echo "<pre>";print_r($valueid);die;
            $casts = array();
            foreach ($casting_manager as $key => $value) {
                $casts[] = array("order_id" => $orderId, "delivery_id" => $valueid, 'user_id' => $value);
            }
            //$deleteIds = array_keys(single_array($this->diagnoses->getCurrentExsitenceResourceId($valueid),'casting_manager'));
            $this->deliveries->addUsersmap($casts, array("order_id" => $orderId, "delivery_id" => $valueid));
        }

        //sate del states in assing date table for break the relationship
        foreach ($deleteIds as $resourceid) {
            $this->diagnoses->setStatusInAssingDate($orderId, $valueid, $resourceid);
        }

        $orderId = $orderId > 0 ? $this->input->post('orderid') : 0;
        $valueid = $valueid > 0 ? $this->input->post('deliveryid') : 0;
        $this->messages->flash('User has been assinged successfully.');
        redirect('admin/delivery/excelemport/' . $orderId . '/' . $valueid);
    }

    //delete users
    public function userDelete($oid = '', $did = '', $uid) {

        $delete = $this->deliveries->deleteUser($oid, $did, $uid);
        if ($delete == 1)
            $this->messages->flash("Data Deleted Successfully");


        redirect('admin/delivery/excelEmport/' . $oid . '/' . $did);
    }

    function trfAllDetails($oid = '', $did = '', $uid = '', $id = '') {
        //echo "<pre>";print_r($oid.''.$did.''.$uid.''.$id);die;
        $where = array('oid' => $oid, 'did' => $did, 'uid' => $uid, 'id' => $id);
        // echo "<pre>";print_r($where);die;
        $data['record'] = (array) $this->deliveries->trfAllRecords($where);
        if ($data['record']['mode'] == 'Hotel') {
            $data['headingtitle'] = 'Hotel Details';
            $this->template->build('sub_records', $data);
        } else if ($data['record']['mode'] == 'train') {
            $data['headingtitle'] = 'Train Details';
            $this->template->build('sub_records_train', $data);
        } else if ($data['record']['mode'] == 'cab') {
            $data['headingtitle'] = 'cab details';
            $this->template->build('sub_records_cab', $data);
        } else {
            $data['headingtitle'] = 'air details';
            $this->template->build('sub_records_air', $data);
        }
        //    echo "<pre>controller";print_r($data);die;
    //
          }

}
