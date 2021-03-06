<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends ITFS_Controller {

    public function __construct() {
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'pagination','email'));
        $this->load->model('designs');
        $this->load->model('diagnose/diagnoses');
        $this->load->model('subproduct/subproducts');
        $this->load->model('welcome/welcomes');
        $this->load->model('casting_manager/casting_managers');
        $this->load->model('workreport/workreports');
    }

    public function index($id) {

        $data['all'] = $this->designs->showAllDesign($id);
        $data['ids'] = $id;
        //Filter Data
        $conditions = array();

//        if(isset($_POST["q"])) {
//            $this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
//        } 
        //$searchfield = $this->session->userdata("SEARCHFIELD");

        $searchfield = array();
        if (isset($_POST["q"])) {
            $searchfield = $_POST;
            //$this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
        }


        if (count($searchfield) > 0)
            $data["frm_data"] = $searchfield;


        //$conditions["where"] = array("user_type"=>'CM');
        if (isset($searchfield["q"]) and ! empty($searchfield["q"])) {
            $conditions["like"] = array("SB.name" => $searchfield["q"], "DS.email_id" => $searchfield["q"]);
        }

        // End of Filter Data
        $totaldata = $this->designs->totalData($conditions, $id);
        //echo "##<pre>";print_r($totaldata);die;
        $config = $this->paginationformat["back_page"];
        $config['base_url'] = base_url('admin/design/index/' . $id);
        $config['total_rows'] = $totaldata;
        $config['per_page'] = 10;
        $config["uri_segment"] = 5;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(5) ? $this->uri->segment(5) : 0;

        $data['all'] = $this->designs->findUser($conditions, $config["per_page"], $page, $id);
        foreach ($data['all'] as &$dt) {
            $dt->statusdata = $this->diagnoses->checkAssignData($dt->order_id, $dt->id, 2);
        }
        $data['link'] = $this->pagination->create_links();
        $this->template->headingtitle = "DESIGN LISTING";
        $this->template->set_breadcrumb("ORDER LISTING", site_url("admin/order"));
        $this->template->set_breadcrumb("DESIGN LISTING ", "");
        $this->template->build('admin_index', $data);
    }

    function trfAllDetails($oid = '', $did = '', $uid = '', $id = '') {
        //echo "<pre>";print_r($oid.''.$did.''.$uid.''.$id);die;
        $where = array('oid' => $oid, 'did' => $did, 'uid' => $uid, 'id' => $id);
        //echo "<pre>";print_r($where);die;
        $data['record'] = (array) $this->designs->trfAllRecords($where);
        $this->template->set_breadcrumb("TRAVEL REQUEST FORM", site_url("admin/design/trf/" . $where['oid'] . '/' . $where['did']));
        if ($data['record']['mode'] == 'Hotel') {
            $data['headingtitle'] = 'Hotel Details';
            // $this->template->set_breadcrumb("DESIGN LISTING",site_url("admin/design/index/".$id));
            // $this->template->set_breadcrumb("ADD DESIGN","");
            $this->template->build('sub_records', $data);
        } else if ($data['record']['mode'] == 'train') {
            //$this->template->set_breadcrumb("TRAVEL REQUEST FORM",site_url("admin/design/trf/".$where['oid'].'/'.$where['did']));
            //$this->template->set_breadcrumb("ADD DESIGN","");
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

    public function form($id = '', $subproduct = '') {
        $this->load->model('product/products');
        $this->load->model('casting_manager/casting_managers');

        $allProduct = array('' => 'Select Product') + single_array($this->products->getProductsForSelect(2), 'id', 'name');
        $data['product'] = $allProduct;
        $data['subproducts'] = array('' => 'Select Sub-Product') + single_array($this->subproducts->getSubProductsForSelect(), 'id', 'name', 'Select Sub-Product');
        $data['castingmanager'] = single_array($this->casting_managers->getcastingManagerForSelect(), 'id', 'name');
        //echo "<pre>1234"; print_r($data); die();
        if ($this->input->post()) {
            //echo "<pre>";print_r($this->input->post());die;
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('dgproducts', 'Product Name', 'required');
            $this->form_validation->set_rules('dsubproducts', 'Sub Product', 'required');
            $this->form_validation->set_rules('dgweight', 'Weight.', 'required');
            $this->form_validation->set_rules('dgunits', 'Units', 'required');
            $this->form_validation->set_rules('dgpax', 'Pax', 'required');
            $this->form_validation->set_rules('dgnoofdays', 'No of Days', 'required');
            $this->form_validation->set_rules('dgcunsulting', 'Cunsulting Days', 'required');
            $this->form_validation->set_rules('dgstartdate', 'Start Date', 'required');
            $this->form_validation->set_rules('dgenddate', 'End Date', 'required');
            $this->form_validation->set_rules('dglocation', 'Location', 'required');
            $this->form_validation->set_rules('dgpriceandunit', 'Price nd Units', 'required');
            //$this->form_validation->set_rules('dgcoordinator', 'Co Ordinator', 'required');
            //$this->form_validation->set_rules('dgemail', 'Email', 'required');
            //$this->form_validation->set_rules('dgcontact', 'Contact No', 'required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]');
            if ($this->form_validation->run() == false) {
                $data['subdesignid'] = (object) array(
                            'order_Id' => $id,
                            'products' => $this->input->post('dgproducts'),
                            'subproducts' => $this->input->post('dsubproducts'),
                            'weight' => $this->input->post('dgweight'),
                            'units' => $this->input->post('dgunits'),
                            'pax' => $this->input->post('dgpax'),
                            'no_ofdays' => $this->input->post('dgnoofdays'),
                            'cunsulting_days' => $this->input->post('dgcunsulting'),
                            'start_date' => $this->input->post('dgstartdate'),
                            'end_date' => $this->input->post('dgenddate'),
                            'location' => $this->input->post('dglocation'),
                            'price_unit' => $this->input->post('dgpriceandunit'),
                            //'coordinator'=>$this->input->post('dgcoordinator'),
                            //'email_id'=>$this->input->post('dgemail'),
                            //'contact'=>$this->input->post('dgcontact'),
                            'notconfirmed' => $this->input->post('notconfirmed')
                );
                $data['selectedmangers'] = $this->input->post('dgnocasting');
                //echo "<pre>";print_r($data);die;
            } else {//echo "<pre>";print_r($_POST);die;
                if (empty($subproduct)) {
                    $design['order_Id'] = $id;
                    $design['products'] = $this->input->post('dgproducts');
                    $design['subproducts'] = $this->input->post('dsubproducts');
                    $design['weight'] = $this->input->post('dgweight');
                    $design['units'] = $this->input->post('dgunits');
                    $design['pax'] = $this->input->post('dgpax');
                    $design['no_ofdays'] = $this->input->post('dgnoofdays');
                    $design['cunsulting_days'] = $this->input->post('dgcunsulting');
                    $design['start_date'] = $this->input->post('dgstartdate');
                    $design['end_date'] = $this->input->post('dgenddate');
                    $design['location'] = $this->input->post('dglocation');
                    $design['price_unit'] = $this->input->post('dgpriceandunit');
                    //$design['coordinator']=$this->input->post('dgcoordinator');
                    //$design['email_id']=$this->input->post('dgemail');
                    //$design['contact']=$this->input->post('dgcontact');
                    $design['notconfirmed'] = $this->input->post('notconfirmed');
                    //$casting_manager=$this->input->post('dgnocasting');
                    //echo "<pre>22222@@@@@@@@@@@";print_r($design);die;

                    $inserid = $this->designs->add_Design($design);
                    // if(count($casting_manager)>0 && isset($casting_manager)) {
                    // $casts=array();  
                    //          foreach ($casting_manager as $key => $value) {
                    //            $casts[]=array('diagnose_id'=>$inserid,'casting_manager'=>$value);
                    //         }
                    //         $this->diagnoses->addCasting($casts,array("diagnose_id"=>$inserid));
                    // }
                    if (!empty($inserid))
                        $this->messages->flash('Data has been inserted');
                    redirect('admin/design/index/' . $id);
                }
                else {

                    $designdata = array();
                    //$data=$this->input->post();
                    //echo "<pre>";print_r($this->input->post());die;
                    $designdata = array(
                        'order_Id' => $id,
                        'products' => $this->input->post('dgproducts'),
                        'subproducts' => $this->input->post('dsubproducts'),
                        'weight' => $this->input->post('dgweight'),
                        'units' => $this->input->post('dgunits'),
                        'pax' => $this->input->post('dgpax'),
                        'no_ofdays' => $this->input->post('dgnoofdays'),
                        'cunsulting_days' => $this->input->post('dgcunsulting'),
                        'start_date' => $this->input->post('dgstartdate'),
                        'end_date' => $this->input->post('dgenddate'),
                        'location' => $this->input->post('dglocation'),
                        'price_unit' => $this->input->post('dgpriceandunit'),
                        //'coordinator'=>$this->input->post('dgcoordinator'),
                        //'email_id'=>$this->input->post('dgemail'),
                        //'contact'=>$this->input->post('dgcontact'),
                        'notconfirmed' => $this->input->post('notconfirmed')
                    );

                    //$casting_manager=$this->input->post('dgnocasting');
                    // $casting_manager=array();
                    // $casting_manager=is_array($this->input->post('dgnocasting'))?$this->input->post('dgnocasting'):array();

                    $updata = $this->designs->update_Design($designdata, $subproduct, $id);

                    //  $casts=array();
                    //  foreach ($casting_manager as $key => $value) {
                    //    $casts[]=array('diagnose_id'=>$subproduct,'casting_manager'=>$value,'type'=>2);
                    // }
                    //  $this->diagnoses->addCasting($casts,array("diagnose_id"=>$subproduct,'type'=>2));
                    if ($updata == 1) {
                        $this->messages->flash('Data Updated Successfully');
                    }
                    redirect('admin/design/index/' . $id);
                }
                //echo "<pre>";print_r($designdata);die;
                //echo "<pre>";print_r($designdata);die;
            }//redirect('design/index/'.$id);
        } else {
            $data['subdesignid'] = $this->designs->getSubdesignById($id, $subproduct);
            //echo "<pre>";print_r($data);die;
            //$result = $this->diagnoses->getCasting($subproduct);

            $data['selectedmangers'] = array_keys(single_array($this->diagnoses->getCasting($subproduct, 2), 'casting_manager'));
            //echo "<pre>";print_r($data);die;
        }



        //echo "<pre>";print_r($data);die;
        //$this->template->add_js($modalViewi, "B", "embed");
        if (empty($subproduct))
            $this->template->headingtitle = "ADD DESIGN";
        else
            $this->template->headingtitle = "Update DESIGN";
        $this->template->set_breadcrumb("DESIGN LISTING", site_url("admin/design/index/" . $id));
        $this->template->set_breadcrumb("ADD DESIGN", "");
        $this->template->build('admin_form', array("frmdata" => $data));
    }

    public function assingResource($orderid = 0, $valueid = 0) {
        //die($orderid);
        $data = array();
        $data['orderid'] = $orderid;
        $data['diaid'] = $valueid;
        $data['castingmanager'] = single_array($this->casting_managers->getcastingManagerForSelect(), 'id', 'name');
        $data['selectedmangers'] = array_keys(single_array($this->diagnoses->getCasting($valueid, 2), 'casting_manager'));
        $getDataForCunsulting = $this->designs->getdesignedDayInfo($valueid);
        $data['noofresources'] = $getDataForCunsulting->cunsulting_days;
        $this->template->set_layout("ajax");
        //echo "<pre>";print_r($data);die;
        $this->template->build('resoucemap', array('frmdata' => $data));
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
                $casts[] = array('diagnose_id' => $valueid, 'casting_manager' => $value, 'type' => 2);
            }
            $deleteIds = array_keys(single_array($this->diagnoses->getCurrentExsitenceResourceId($valueid), 'casting_manager'));
            $this->diagnoses->addCasting($casts, array("diagnose_id" => $valueid, 'type' => 2));
        }

        //sate del states in assing date table for break the relationship
        //checking old resouces.
        //$deleteIdsarray = array_diff($casting_manager, $deleteIds);

        $deleteIdsarray = array_diff($deleteIds, $casting_manager);
//        echo "<pre>";print_r($deleteIds);
//        echo "<pre>";print_r($casting_manager);
        //echo "<pre>";print_r($deleteIdsarray);die;
        foreach ($deleteIdsarray as $resourceid) {
            //send email for cancellation of date
            //echo "<pre>4567";print_r($resourceid."****".$valueid);die;
            $this->diagnoses->deleteTimeSlotMaster($resourceid,$valueid);
            $singeInfo = $this->diagnoses->getResourcesAssignDetailsForUpdateResource($valueid, 2, $resourceid);
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
        redirect('admin/design/index/' . $orderId);
    }
    
    
    
    
    
    
    
    

    public function trfPopUp($oid = "", $subproduct = "", $user_id = "", $id = '') {
        //echo "<pre>##";print_r($this->input->post());die;
        $data = array();
        $data['order_id'] = $oid;
        $data['diagnose_id'] = $subproduct;
        $data['user_id'] = $user_id;
        $data['resourceInfos'] = $this->diagnoses->getResourceInfoById($id);
        $data['traveldata'] = single_array($this->diagnoses->getTravel(), 'id', 'name', 'Select Airlines');
        //echo "<pre>";print_r($data['resourceInfos']);die;
        $this->template->set_layout("ajax");
        $this->template->build('trf_pop_up', array('frm_data' => $data));
    }

    public function saveTrfInfos() {
        // echo "<pre>";print_r($this->input>post()->post());die;
        //echo "<pre>";print_r($this->input->post());die;
        $data = array();
        $postalldata = $this->input->post();
        if ($this->input->post()) {
            if (empty($postalldata['ids'])) {
                //echo "@@<pre>";print_r($postalldata );die;
                //$this->form_validation->set_rules('mode','Mode','required');
                //$this->form_validation->set_rules('mode','Mode','required');
                $assigndataid = $this->diagnoses->saveTrfInfo($postalldata);

                redirect("admin/design/trf/" . $postalldata['order_id'] . "/" . $postalldata['diagnose_id'] . "/" . $postalldata['user_id']);
            } else {
                $assignd = $this->diagnoses->updateTrfInfo($postalldata, $postalldata['ids']);
                redirect("admin/design/trf/" . $postalldata['order_id'] . "/" . $postalldata['diagnose_id'] . "/" . $postalldata['user_id']);
            }
        }
    }

    public function trf($oid = "", $subproduct = "", $user_id = "") {
        $where['order_type'] = 2;
        $data = array();
        $data['allmanager'] = single_array($this->diagnoses->getAllManagers($subproduct, $where), 'id', 'name', 'Select Resource');
        //$data['travelname'] =single_array($this->diagnoses->getAllManagers($digid),'id','name','Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($subproduct, $where);

        if ($this->input->post()) {
            $postalldata = $this->input->post();

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
                "order_type" => 2
            );
            $this->load->library('email');

            //echo $link;die;
            $allEmail = $this->orders->getSellerUserEmail($oid);
            $AllemailInComma = implode(",", $allEmail);
            //$this->email->to($AllemailInComma);
            $AllemailInComma = $postalldata['cast_email'] . "," . $AllemailInComma;
            $this->email->to($AllemailInComma);

            //$this->email->to($postalldata['cast_email']);                
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
            redirect("admin/design/calender/" . $oid . "/" . $subproduct);
        }
        $data['diagnose_id'] = $subproduct;
        $data['odered_id'] = $oid;
        $data['user_id'] = $user_id;
        $data['start_end'] = $this->diagnoses->getDiagnoseStartEndDate($subproduct);
        $data['headingtitle'] = $this->template->headingtitle = "TRAVEL REQUEST FORM";
//echo "<pre>";print_r($data['allmanager']);die;
        $this->template->set_breadcrumb("ORDER LISTING", site_url("admin/order"));
        $this->template->set_breadcrumb("DESIGN LISTING", site_url("admin/design/index" . '/' . $oid));
        $this->template->set_breadcrumb("TRAVEL LISTING ", "");
        $this->template->build('trf', array('frmdata' => $data));
    }

    public function getPriceByAjax() {
        $this->load->model('product/products');
        $ids = $this->input->post('ids');
        //echo "<pre>";print_r($ids);die;
        $proprice = $this->products->getProductPrice($ids);
        //echo "<pre>";print_r($t);die;
        echo json_encode(array('totalprice' => $proprice));
    }

    public function delete($id = '', $oid = '') {
        //$del=$this->input->post();
        $delete = $this->designs->deletedata($id, $oid);
        $this->diagnoses->assignUpdateStatus($id,$oid,2);
        if ($delete == 1)
            $this->messages->flash("Data Deleted Successfully");
        //echo "<pre>";print_r($del);die;
        // $deldata['frm_data']['view']=$this->clients->up_data($id);
        //echo "<pre>";print_r($deldata);die;
        //$this->template->build('del_client',$deldata);
        redirect('admin/design/index/' . $id);
    }

    public function details($id) {//die($id);
        $data['delview'] = $this->designs->showDesignDetails($id);

        //echo "<pre>";print_r($data);die;
        $this->template->build('show_detail', $data);
    }

    public function calender($oid = "", $digid = "", $resourceid = '') {//die('bvghb');
        $where['order_type'] = 2;
        $data = array();
        $data['allmanager'] = single_array($this->diagnoses->getAllManagers($digid, $where), 'id', 'name', 'Select Resource');
        $data['results']['assigndetails'] = $this->diagnoses->getResourcesAssignDetails($digid, $where);
        //echo "<pre>";print_r($data);die;
        if ($this->input->post()) {
            $postalldata = $this->input->post();
            //echo "<pre>";print_r($postalldata);die;
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
                "order_type" => 2
            );
            
            $this->load->library('email');
                       
            
        //echo $link;die;
            $mgid = $this->input->post('manager');
            $datetimerange = $this->input->post('daterange');
            $datetime = explode('-', $datetimerange);
            $startdttime = strtotime($datetime['0']);
            $enddttime = strtotime($datetime['1']);

            //checking time
            $invalidtime =0;
            if(strstr($datetime['0'], '12:00 AM')){
                $invalidtime = 1;
            } 
            if(strstr($datetime['1'], '12:00 AM')){
                $invalidtime = 1;
            }
            if($invalidtime){
              $this->messages->flash('Invalid start/end time', 'error');  
              redirect("admin/design/calender/" . $oid . "/" . $digid . "/" . $user_id);

            }

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
            $datas = $this->diagnoses->checkRestrictedDateTime($startdttime, $enddttime, $mgid, $digid);
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

                $usermapdata = $this->designs->getusermapData(array("D.order_id" => $oid, "D.id" => $digid));
                $id = $usermapdata->id;
                $user_id = $usermapdata->user_id;
                if (!empty($assigndataid))
                    $this->messages->flash('Assigned Date Successfully');
            }
            $user_id = isset($postalldata["manager"]) && (!empty($postalldata["manager"])) ? $postalldata["manager"] : 0;
            redirect("admin/design/calender/" . $oid . "/" . $digid . "/" . $user_id);
        }

        $data['diagnose_id'] = $digid;
        $data['start_end'] = $this->designs->getDeliveryStartEndDate($digid);
        $data['selectedResource'] = $resourceid > 0 ? $resourceid : 0;
        $this->template->headingtitle = "Assign Date Resources";
        $this->template->set_breadcrumb("ORDER LISTING", site_url("admin/order"));
        $this->template->set_breadcrumb("DESIGN LISTING", site_url("admin/design/index/" . $oid));
        $this->template->set_breadcrumb("ASSIGN DATE ", "");
        //echo "111<pre>";print_r($data);die;
        $this->template->build('calender', array('frmdata' => $data));    
            
            
    }

    function getAssignDate() {

        $diaid = $this->input->post('diagnoseid');
        $mgrid = $this->input->post('managerid');
        //echo "%%%<pre>";print_r($diaid);
        //echo "%%%<pre>";print_r($mgrid);die;

        $design['d_view'] = $this->diagnoses->getCalenderDetails($diaid, $mgrid);
        //echo "%%%<pre>";print_r($design);die;

        $results = array();
        $comment = '';
        $statusArray = array(0 => 'Awaiting', 1 => 'Accepted', 2 => 'Rejected');
        $this->load->model('workreport/workreports');
        foreach ($design['d_view'] as $k => $v) {
            if ($v->status == '2') {
                $comment = $v->comment;
            }


            /*$results[] = array("id" => $v->id, "title" => "Booked" . " " . $v->start_time . "-" . $v->end_time,
                "start" => date("Y-m-d", strtotime($v->start_date)),
                "statusvalue" => $statusArray[$v->status],
                "comments" => $comment,
                "className" => 'eventColor' . $statusArray[$v->status],
                "end" => date("Y-m-d", strtotime($v->end_date . " +1 day")),
            );*/
            //echo "%%%<pre>";print_r($v);
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
        }//die;

        return $this->output->set_content_type('application/json')->set_output(json_encode($results));
    }

    public function mailTravelRequestForm(){//die('fvrfvrv');
        $this->load->library('email');
        //$this->load->library("IMpdf", "impdf");

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
        $data['diagnose_detail'] = $this->diagnoses->getDiagnosesInforationById($data['diagnose_id'], 'design');

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
        redirect("admin/design/trf/" . $data['order_id'] . "/" . $data['diagnose_id']);
    }
    
    
    
    

    function mailTravelRequestFormNew($oid = "", $digid = "", $user_id = "", $id = "") {
        //die('zczdc');
        //echo $user_id;die;
        $this->template->set_layout("ajax");
        $data['where'] = array('oid' => $oid, 'digid' => $digid, 'user_id' => $user_id, 'id' => $id);
        //print_r($data);die;
        $this->template->build('mailform', $data);
    }

    public function mailVenderRequestForm($oid = "", $digid = "", $user_id = "") {//die('hcgdyuchduhfc');
        $this->load->library('email');
        $this->load->library("IMpdf", "impdf");
        $this->load->model('order/orders');
        //echo $user_id;die;
        $data = array();
        $data['order_id'] = $oid;
        $data['diagnose_id'] = $digid;
        $data['user_id'] = $user_id;
        $data['resourceInfos'] = $this->diagnoses->getResourcesById($data);
        $data['userDetails'] = $this->diagnoses->getdetailsById($user_id);
        $data['diagnose_detail'] = $this->diagnoses->getDiagnosesInforationById($digid, 'design');
        //echo "<pre>12345".$digid;print_r($data['diagnose_detail']);die;
        //echo "<pre>pds".$data['userDetails']->email;die;
        //PDF Generate

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
        $datainfo = $this->load->view("diagnose/mail/pdfresources", $data, true);

        //echo "<pre>";print_r($datainfo);die;
        $this->impdf->mpdf->SetDisplayMode('fullpage');
        $this->impdf->mpdf->WriteHTML($datainfo);
        $fullpath = PUBLIC_PATH . "upload/resourcepdf/SIXRES" . time() . ".pdf";
        $this->impdf->mpdf->Output($fullpath);

        // echo "<pre>";print_r($data['userDetails']->email);die;
        //$this->email->to('kanika@maynardeleigh.in');                
        $this->email->to($data['userDetails']->email);
        $this->email->from('info@maynardleighonline.in');
        $this->email->set_mailtype("html");
        // $maildata = $this->mails->getMailById(3);
        // $information = array('name'=>$data['userDetails']->name,'contact'=>$data['userDetails']->contact_no);
        // $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
        // $bodymessage = $this->messages->mailTemplate($datainfo);
        $bodymessage = $this->load->view("diagnose/mail/pdfresources", array("frmdata" => $data), true);
        $this->email->subject("Maynardeleigh || Your Travel Request Form");
        // $this->email->subject($maildata->mailsubject);
        $this->email->message($bodymessage);
        $this->email->attach($fullpath);
        //echo "<pre>";print_r($this->email);die;
        $status = $this->email->send();
        $this->email->clear();
        if ($status) {
            $this->messages->flash("Your message has been sent");
        } else {
            echo "not";
        }

        redirect("admin/design/trf/" . $oid . "/" . $digid . '/' . $user_id);
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
                foreach ($_FILES['train_ticket']['name'] as $key => $value) {
                //$uploadvalue['name'] = $uploadfiles['name'][$key];
                $name = $_FILES['train_ticket']['name'][$key];
                $ext = end((explode(".", $name))); # extra () to prevent notice
                $train_ticket_url = ((isset($_FILES['train_ticket']['name'][$key]))&&(!empty($_FILES['train_ticket']['name'][$key]))) ? "train_ticket".time().($key+1).".".$ext:'';
                //public url
                $train_ticket_url_global[] = ((isset($_FILES['train_ticket']['name'][$key]))&&(!empty($_FILES['train_ticket']['name'][$key]))) ? site_url().PUBLIC_ULR."/documents/".$train_ticket_url:"";
                //$uploadvalue['name'] = str_replace(array(' ', "'", ","), array('_', "_", "_"), $_FILES['participant_list']['name']);
                $uploadvalue['name'] = $train_ticket_url;
                //$uploadvalue['name'] = str_replace(array(' ', "'", ","), array('_', "_", "_"), $_FILES['train_ticket']['name']);
                $uploadvalue['type'] = $_FILES['train_ticket']['type'][$key];
                $uploadvalue['tmp_name'] = $_FILES['train_ticket']['tmp_name'][$key];
                $uploadvalue['error'] = $_FILES['train_ticket']['error'][$key];
                $uploadvalue['size'] = $_FILES['train_ticket']['size'][$key];
                $_FILES['tmpdocuments'] = $uploadvalue;
                $this->UploadImageDoc($_FILES['tmpdocuments']);
                //echo "<pre>";print_r($_FILES);die;
                //echo "<pre>123";print_r($this->UploadImageDoc($_FILES['tmpdocuments']));die;
                
                //$trainticket = !empty($uploadvalue['name']) ? PUBLIC_PATH . "documents/" . $uploadvalue['name'] : "";
            }
            //echo "<pre>";print_r($train_ticket_url_global);die;
            }
            unset($uploadvalue);
            if (isset($_FILES['participant_list'])) {
                //echo "<pre>";print_r($_FILES['participant_list']);die;
//echo "<pre>";print_r($_FILES['participant_list']['name'][$key]);die;
                //$uploadvalue['name'] = $uploadfiles['name'][$key];
                $name = $_FILES['participant_list']['name'];
                $ext = end((explode(".", $name))); # extra () to prevent notice
                //echo "<pre>";print_r($name);die;
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
            //echo "<pre>";print_r($partipant_url_global);die;
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
                foreach ($_FILES['air_ticket']['name'] as $key => $value) {
                $name = $_FILES['air_ticket']['name'][$key];
                $ext = end((explode(".", $name))); # extra () to prevent notice
                $air_ticket_url = "air_ticket".time().($key+1).".".$ext;
                //public url
                $air_ticket_global[] = ((isset($_FILES['air_ticket']['name'][$key]))&&(!empty($_FILES['air_ticket']['name'][$key]))) ? site_url().PUBLIC_ULR."/documents/".$air_ticket_url:"";
                //$uploadvalue['name'] = str_replace(array(' ', "'", ","), array('_', "_", "_"), $_FILES['air_ticket']['name']);
                $uploadvalue['name'] = $air_ticket_url;
                $uploadvalue['type'] = $_FILES['air_ticket']['type'][$key];
                $uploadvalue['tmp_name'] = $_FILES['air_ticket']['tmp_name'][$key];
                $uploadvalue['error'] = $_FILES['air_ticket']['error'][$key];
                $uploadvalue['size'] = $_FILES['air_ticket']['size'][$key];
                $_FILES['tmpdocuments'] = $uploadvalue;
                $this->UploadImageDoc($_FILES['tmpdocuments']);
                //$airticket = !empty($uploadvalue['name']) ? PUBLIC_PATH . "documents/" . $uploadvalue['name'] : "";
            }
            }

            //echo "<pre>11";print_r($trainticket);
            //echo "<pre>1122";print_r($cabticket);
            //echo "<pre>3333";print_r($airticket);die;
            

            //makeing train ticket link
//echo "<pre>###";print_r($train_ticket_url_global);die;
            
        $trainticketlink='';
            foreach ($train_ticket_url_global as $key => $trainfilename) {
                //echo "<pre>###";print_r($trainfilename);die;
               // $trainticketlink=$trainticketlink.'<a target="_blank" href="'.$trainfilename.'" >Attachment '.($key+1).' </a>'
             //$trainticketlink= $trainticketlink.' <a target="_blank" href="'.$trainfilename.'">Attachment'.($key+1).'</a>';
             $trainticketlink=$trainticketlink.(((isset($trainfilename)) && (!empty($trainfilename)))?' <a target="_blank" href="'.$trainfilename.'">Attachment'.($key+1).'</a>':"N/A");
            }

            $airticketlink='';
            foreach ($air_ticket_global as $key => $airfilename) {
                //echo "<pre>###";print_r($trainfilename);die;
               // $trainticketlink=$trainticketlink.'<a target="_blank" href="'.$trainfilename.'" >Attachment '.($key+1).' </a>'
             //$airticketlink=' <a target="_blank" href="'.$airfilename.'">Attachment'.($key+1).'</a>';
                $airticketlink=$airticketlink.(((isset($airfilename)) && (!empty($airfilename)))?' <a target="_blank" href="'.$airfilename.'">Attachment'.($key+1).'</a>':"N/A");
             //$airticketlink=$airticketlink.(((isset($airfilename)) && (!empty($airfilename)))?' <a target="_blank" href="'.$airfilename.'">Attachment'.($key+1).'</a>':"N/A");
             //echo "<pre>###";print_r($airticketlink);die;
            }
            //echo "<pre>";print_r($air_ticket_global);die;
            
            

            



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
                'no_of_participant' => isset($allPost['no_of_participant'])?$allPost['no_of_participant'].'&nbsp;'.(((isset($partipant_url_global)) && (!empty($partipant_url_global)))?'  <a target="_blank" href="'.$partipant_url_global.'">Attachment</a>':"N/A"):'',
                'vms' => $allPost['vms'],
                'handouts' => $allPost['handouts'],
                'air' => //isset($allPost['air'])?$allPost['air'].$airticketlink:'',
               // isset($allPost['air'])?$allPost['air'].((isset($airticketlink) && !empty($airticketlink))  && (!empty($airticketlink))?$airticketlink:''):'N/A',


isset($allPost['air'])?$allPost['air'].'&nbsp;'.$airticketlink:'',



                'train' =>//isset($allPost['train'])?$allPost['train'].$trainticketlink:'',
                 //isset($allPost['train'])?$allPost['train'].((isset($trainticketlink) && !empty($trainticketlink))  && (!empty($trainticketlink))?$trainticketlink:''):'N/A',

isset($allPost['train'])?$allPost['train'].'&nbsp;'.$trainticketlink:'',

                'cab' => //isset($allPost['cab'])?$allPost['cab'].((isset($cab_ticket_url_global) && !empty($cab_ticket_url_global))  && (!empty($cab_ticket_url_global))?'  <a target="_blank" href="'.$cab_ticket_url_global.'">Attachment</a>':''):'N/A',

isset($allPost['cab'])?$allPost['cab'].'&nbsp;'.(((isset($cab_ticket_url_global)) && (!empty($cab_ticket_url_global)))?'  <a target="_blank" href="'.$cab_ticket_url_global.'">Attachment</a>':"N/A"):'',


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
            redirect("admin/design/trf/" . $allPost['oid'] . "/" . $allPost['digid'] . '/' . $allPost['user_id']);
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
        $data['diagnose_detail'] = $this->diagnoses->getDiagnosesInforationById($digid, 'design');
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
        $this->template->set_breadcrumb("DELIVERY LISTING", site_url("admin/design/index/" . $oid));
        $this->template->set_breadcrumb("TRAVEL REQUEST FORM", site_url("admin/design/trf/" . $oid . "/" . $digid . "/" . $user_id));
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
        //redirect("admin/design/trf/".$oid."/".$digid.'/'.$user_id);
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
        $data['diagnose_detail'] = $this->diagnoses->getDiagnosesInforationById($data['diagnose_id'], 'design');
        $whereArray = array('O.id' => $data['order_id'], 'D.id' => $data['diagnose_id']);
        $data['order_detail'] = $this->orders->getOrderDetail($whereArray, 2);

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
        $data['diagnose_detail'] = $this->diagnoses->getDiagnosesInforationById($data['diagnose_id'], 'design');
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

        redirect("admin/design/trf/" . $oid . "/" . $digid . '/' . $user_id);
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

}
