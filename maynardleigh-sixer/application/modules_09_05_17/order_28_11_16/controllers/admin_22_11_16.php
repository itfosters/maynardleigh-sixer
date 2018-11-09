<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin extends ITFS_Controller {



    

    public function __construct() 
    {
        $this->load->helper('form','url');
        $this->load->library(array('form_validation','pagination'));
        $this->load->model('orders');
        $this->load->model('diagnose/diagnoses');
        $this->load->model('design/designs');
        $this->load->model('delivery/deliveries');
        $this->load->model('discovery/discoveries');
        $this->load->model('client/clients');
        $this->load->model('manager/managers');
        $this->load->model('seller/sellers');
        $this->load->model('document/documents');
        $this->load->model('transport/transports');
    }
    public function index() 
    {
        //Filter Data

        $conditions = array();

        if(isset($_POST["q"])) {
            $this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
        } 

        $searchfield = $this->session->userdata("SEARCHFIELD");
        if(count($searchfield)>0)
        $data["frm_data"] = $searchfield;


        //$conditions["where"] = array("user_type"=>'CM');
        if(isset($searchfield["q"]) and !empty($searchfield["q"])){
            $conditions["like"] = array(
                "O.order_id"=>$searchfield["q"],
                "U.name"=>$searchfield["q"],
                "U1.name"=>$searchfield["q"],
                "U2.name"=>$searchfield["q"]
                ); 
        }
    
        // End of Filter Data
        $totaldata=$this->orders->totalData($conditions);
       //echo "##<pre>";print_r($totaldata);die;
            $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('admin/order/index');
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
            //$this->template->set_breadcrumb("Add Order",site_url("admin/order/add_order"));
            $this->template->set_breadcrumb("ORDER LISTING","");
            $this->template->build('admin_index',$data);
    }
    
    
    public function add_order($id='')
    {  
        $data['clients'] = single_array($this->clients->getClientsForSelect(),'id','name');
        $data['clients']['']= 'Select Client';
        ksort($data['clients']);

        $data['salesBy'] = single_array($this->sellers->getSalesByForSelect(),'id','name');
        $data['salesBy']['']= 'Select Seller';
        ksort($data['salesBy']);

        $data['manager'] = single_array($this->managers->getManagerForSelect(),'id','name');
        $data['manager']['']= 'Select Manager';
        ksort($data['manager']);

        $alldocuments = single_array($this->documents->getDocumentsName(),'id','document_name');
        $data['document']=$alldocuments;
        //$alltransports = single_array($this->transports->getTransportsName(),'id','trans_name');
        $data['transports']=$this->transports->getTransportsName();
        
        if($this->input->post())

        {      
            //$abcd=$this->input->post('client');

            //echo "####<pre>";print_r($abcd);die;
            //echo "<pre>";print_r($this->input->post());die;
            // $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            // $this->form_validation->set_rules('client','Client Name','required|is_unique[users.name]');
            // $this->form_validation->set_rules('Sales','Sales Name','required');
            // $this->form_validation->set_rules('manager','Manager Name','required');
            // $this->form_validation->set_rules('efirst_name', 'First Name', 'required');
            // $this->form_validation->set_rules('eLast_Name', 'Last Name', 'required');
            // $this->form_validation->set_rules('eLocation', 'Location.', 'required');
            // $this->form_validation->set_rules('eDesignation', 'Designation', 'required');
            // $this->form_validation->set_rules('eContact', 'Contact', 'required');
            // $this->form_validation->set_rules('eEmail', 'Email.', 'required');
            // $this->form_validation->set_rules('astreet', 'Street Name', 'required');
            // $this->form_validation->set_rules('astate', 'State Name', 'required');
            // //$this->form_validation->set_rules('astate', 'State Name', 'required');
            // $this->form_validation->set_rules('alocation', 'Location Name', 'required');
            // $this->form_validation->set_rules('acity', 'City Name', 'required');
            // $this->form_validation->set_rules('apincode', 'Pin Code', 'required');
            // $this->form_validation->set_rules('tcpricevalid', 'Price Validity', 'required');
            // $this->form_validation->set_rules('tccancellation', 'Cancellation', 'required');
            // $this->form_validation->set_rules('tcspecialitem', 'Special Item.', 'required');
            // $this->form_validation->set_rules('tccontractno', 'Contract No', 'required');
            // $this->form_validation->set_rules('tcnote', 'Notes', 'required');
            // $this->form_validation->set_rules('tcndarequire', 'NDA', 'required');
            // $this->form_validation->set_rules('tcmodepayment', 'Mode of Payment', 'required');
            //$this->form_validation->set_rules('documents[1]', 'Document', 'required');
            //this->form_validation->set_rules('documents[]', 'Document', 'required');
            //$this->form_validation->set_rules('documents[1]','Document','required','callback_fileupload_check');
            //$this->form_validation->set_rules('documents[2]','Document','required','callback_fileupload_check');

            // $this->form_validation->set_rules('documents[3]','Document','required','callback_fileupload_check');
            // $this->form_validation->set_rules('documents[4]','Document','required','callback_fileupload_check');



            // if ($this->form_validation->run() == false) 
            //  {

            //     echo "!!@@<pre>";print_r($this->input->post());die;
            // $data['frm_data']['view'] = (object) $this->input->post();
            //      //die('ranu');
            //die("False");
            // }
            //else 
            //{
                if(empty($id))
                        {
                            $order_table = array();
                            $order_table['client_id'] = $this->input->post('client');
                            $order_table['sales_by_id'] = $this->input->post('Sales');
                            $order_table['pm_id'] = $this->input->post('manager');
                            $newOrderId = $this->orders->addOrder($order_table);
                            if(!empty($newOrderId))
                                $this->messages->flash("Order save successfully");
                            $newOderNo =date("dm").$newOrderId;
                            $data1['order_Id']=$newOderNo;
                            $this->orders->updateOrderno($newOrderId,$data1);
                            
                                //Econonic Buyer 
                                $economic_table=array();
                                $economic_table['order_Id']=$newOrderId;
                                $economic_table['first_Name']=$this->input->post('efirst_name');
                                $economic_table['last_Name']=$this->input->post('eLast_Name');
                                $economic_table['location']=$this->input->post('eLocation');
                                $economic_table['designation']=$this->input->post('eDesignation');
                                $economic_table['contact_No']=$this->input->post('eContact');
                                $economic_table['email_Id']=$this->input->post('eEmail');
                                $this->orders->add_EconomicBuyer($economic_table);
                                
                                //Billing Address

                                $addressbilling['order_Id']=$newOrderId;
                                $addressbilling['check']=$this->input->post('checkbox');
                                $addressbilling['street']=$this->input->post('astreet');
                                $addressbilling['location']=$this->input->post('alocation');
                                $addressbilling['state']=$this->input->post('astate');
                                $addressbilling['country']=$this->input->post('acountry');
                                $addressbilling['city']=$this->input->post('acity');
                                $addressbilling['pincode']=$this->input->post('apincode');
                                //echo "@@<pre>";print_r($addressbilling);die;
                                $this->orders->add_AddressBilling($addressbilling);

                                 //Term Condition

                                $termcondition['order_id']=$newOrderId;
                                $termcondition['price_validity']=$this->input->post('tcpricevalid');
                                $termcondition['cancellation_clouse']=$this->input->post('tccancellation');
                                $termcondition['special_item']=$this->input->post('tcspecialitem');
                                $termcondition['contract_no']=$this->input->post('tccontractno');
                                $termcondition['notes']=$this->input->post('tcnote');
                                $termcondition['nda_required']=$this->input->post('tcndarequire');
                                $termcondition['payment_cycle']=$this->input->post('tcpaymentcycle');
                                $termcondition['mode_ofpayment']=$this->input->post('tcmodepayment');
                                $termcondition['termsconditions']=$this->input->post('termsconditions');
                                $termcondition['transport_tax']=$this->input->post('transport_tax');
                                $termcondition['tax']=$this->input->post('tax');
                                //echo "%%%%<pre>";print_r($termcondition);die;
                                $this->orders->add_termcondition($termcondition);
                            
                            //Add Edit Transport
                            $trans=$this->input->post('transport');
                            //echo "%%%<pre>";print_r($trans);die;
                            if (!empty($trans)) 
                                {
                                    $transport=array();
                                    foreach($trans as $keyoftp=>$valueoftransport){
                                        //echo "<pre>";print_r($keyoftp.' '.$valueoftransport);die;
                                        $transport[]=array('order_Id' => $newOrderId,'transport_id' => $keyoftp,'value' => $valueoftransport);
                                    }//echo "<pre>";print_r($transport);die;

                                 if(count($transport)>0)
                                    $this->orders->add_UpdateTransport($transport,array('order_Id' => $id));
                                }
                                
                                //Document Upload
                            if($_FILES['documents'])
                            {
                                $uploadfiles = $_FILES['documents'];
                                //echo "<pre>";print_r($uploadfiles['name']);die;
                                foreach ($uploadfiles['name'] as $key => $value) 
                                {//echo '<br>'."###@@@@@<pre>";print_r([$key]);die; 
                                    //echo "!!!<pre>";print_r([$key]);
                                    if(empty($value)) continue;
                                    
                                    $uploadvalue['name'] = $uploadfiles['name'][$key];
                                    $uploadvalue['type'] =$uploadfiles['type'][$key];
                                    $uploadvalue['tmp_name'] =$uploadfiles['tmp_name'][$key];
                                    $uploadvalue['error'] = $uploadfiles['error'][$key];
                                    $uploadvalue['size'] = $uploadfiles['size'][$key];

                                    $_FILES['tmpdocuments']=$uploadvalue;
                                    //echo "!!!<pre>";print_r($_FILES['tmpdocuments']);
                                    $this->UploadImageDoc($_FILES['tmpdocuments']);
                                    $docarray['order_id']=$newOrderId;
                                    $docarray['document_id']=$key;
                                    $docarray['file_name']=$value;
                                    $this->orders->saveDocuments($docarray);
                                } //die;
                            }
                            redirect('admin/order/index');
                        }
                        


                        else
                        {

                            $order_table = array();
                            $order_table['client_id'] = $this->input->post('client');
                            $order_table['sales_by_id'] = $this->input->post('Sales');
                            $order_table['pm_id'] = $this->input->post('manager');
                            $where['id']=$id;
                            $update=$this->orders->addOrder($order_table,$where);
                            //echo "<pre>";print_r($update); die;
                                  if($update==0)
                                $this->messages->flash("Order updated successfully");
                            //Economic Buyer
                                $economic_table=array();
                                $economic_table['order_Id']=$id;
                                $economic_table['first_Name']=$this->input->post('efirst_name');
                                $economic_table['last_Name']=$this->input->post('eLast_Name');
                                $economic_table['location']=$this->input->post('eLocation');
                                $economic_table['designation']=$this->input->post('eDesignation');
                                $economic_table['contact_No']=$this->input->post('eContact');
                                $economic_table['email_Id']=$this->input->post('eEmail');
                                $whereeco['order_Id']=$id;
                                $this->orders->add_EconomicBuyer($economic_table,$whereeco);
                            
                            //Billing Address
                                $addressbilling['order_Id']=$id;
                                $addressbilling['street']=$this->input->post('astreet');
                                $addressbilling['location']=$this->input->post('alocation');
                                $addressbilling['state']=$this->input->post('astate');
                                $addressbilling['country']=$this->input->post('acountry');
                                $addressbilling['city']=$this->input->post('acity');
                                $addressbilling['pincode']=$this->input->post('apincode');
                                $whereadd['order_Id']=$id;
                                $this->orders->add_AddressBilling($addressbilling,$whereadd);

                                //Term And Condition
                                $termcondition['order_id']=$id;
                                $termcondition['price_validity']=$this->input->post('tcpricevalid');
                                $termcondition['cancellation_clouse']=$this->input->post('tccancellation');
                                $termcondition['special_item']=$this->input->post('tcspecialitem');
                                $termcondition['contract_no']=$this->input->post('tccontractno');
                                $termcondition['notes']=$this->input->post('tcnote');
                                $termcondition['handled_by']=$this->input->post('tchandledby');
                                $termcondition['nda_required']=$this->input->post('tcndarequire');
                                $termcondition['payment_cycle']=$this->input->post('tcpaymentcycle');
                                $termcondition['mode_ofpayment']=$this->input->post('tcmodepayment');
                                $termcondition['termsconditions']=$this->input->post('termsconditions');
                                $termcondition['transport_tax']=$this->input->post('transport_tax');
                                $termcondition['tax']=$this->input->post('tax');
                                $whereterm['order_id']=$id;
                                //echo "<pre>";print_r($termcondition);die;
                                $this->orders->add_termcondition($termcondition,$whereterm);
                            

                            //Add Edit Transport
                            $trans=$this->input->post('transport');
                            if (!empty($trans)) 
                                {
                                    $transport=array();
                                    foreach($trans as $keyoftp=>$valueoftransport){
                                        $transport[]=array('order_Id' => $id,'transport_id' => $keyoftp,'value' => $valueoftransport);

                                    }

                                 if(count($transport)>0)
                                    $this->orders->add_UpdateTransport($transport,array('order_Id' => $id));
                                }

                            //Document Upload
                            if($_FILES['documents'])
                                {
                                $uploadfiles = $_FILES['documents'];

                                

                                foreach ($uploadfiles['name'] as $key => $value) 
                                    {
                                       
                                        if(empty($value)) continue;

                                        $uploadvalue['name'] = $uploadfiles['name'][$key];
                                        $uploadvalue['type'] =$uploadfiles['type'][$key];
                                        $uploadvalue['tmp_name'] =$uploadfiles['tmp_name'][$key];
                                        $uploadvalue['error'] = $uploadfiles['error'][$key];
                                        $uploadvalue['size'] = $uploadfiles['size'][$key];
                                        $_FILES['tmpdocuments']=$uploadvalue;
                                        $this->UploadImageDoc($_FILES['tmpdocuments']);
                                        $docarray['order_id']=$id;
                                        $docarray['document_id']=$key;
                                        $docarray['file_name']=$value;
                                        $wheredoc['order_id']=$id;
                                        $wheredoc['document_id']=$key;

                                        $this->orders->saveDocuments($docarray,$wheredoc);
                                    }
                                }
                            redirect('admin/order/index');
                        }
            //}






        }
        elseif(!empty($id))
        {

            $data["frmdata"]['orderdata']=$this->orders->getSuborderById($id);
            $data["dtdoc"]['docview']=$this->orders->getDocById($id);
            $data["dttrans"]['transview']=single_array($this->orders->getTransById($id),'transport_id','value');
            //echo "@@@<pre>";print_r($data);die;
        }
            $this->template->headingtitle="Add Order";
            $this->template->set_breadcrumb("Order Listing",site_url("admin/order/index"));
            $this->template->set_breadcrumb("Add Order","");
            $this->template->build('admin_user_form',$data); 
    }
    public function requestPinCode()
    {
        $q = $_GET['q'];
        $data=$this->orders->getPinData($q);
        echo json_encode($data);
    }
    public function getClientAddress()
    {
        $clientid=$this->input->post('clientid');
        //echo "<pre>";print_r($clientid);die;
        $data=$this->orders->getClientAddress($clientid);
        //echo "<pre>";print_r($data);die;
        echo json_encode($data);
    }

        protected function UploadImageDoc(&$data,$id=0) 
        { 
            if(isset($_FILES["tmpdocuments"]["name"]) and !empty($_FILES["tmpdocuments"]["name"])) 
            {
                $config['upload_path'] = PUBLIC_UPLOADPATH."documents/";
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
                $config['max_size'] = '20000000';
                $config['max_width'] = '2024';
                $config['max_height'] = '2024';
                $this->load->library('upload');
                $this->upload->initialize($config);
                
                $result = $this->upload->do_upload('tmpdocuments');
                if($result>=1) 
                {
                    //$this->deleteImage($id);
                    $imageinfo = $this->upload->data();
                   
                    $data["image_name"] = $imageinfo["file_name"]; 
                    //echo "<pre>";print_r($data["image_name"]);
                    return true;
                }
                else{

                    $data["error_msg"]= $this->upload->display_errors('<span>','</span>');
                    return false;
                }
            }
        return true;
    }

    public function details($orderid="")
    {//die($orderid);
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
        //echo "<pre>";print_r($data);die;
        $this->template->headingtitle="Order Details";
        $this->template->set_breadcrumb("Order Listing",site_url("admin/order/index"));
        $this->template->set_breadcrumb("Order Details","");
        $this->template->build('show_details',array("frmdata"=>$data)); 
    }
     public function add_Seller()
    {   
        $data['view']=$this->orders->seller_Data();
        $this->template->build('add_order',$data);
    }
    public function add_Product()
    {   
        $data['view']=$this->orders->product_Data();
        $this->template->build('add_order',$data);
    }
    public function add_projectmanager()
    {
        $data['view']=$this->orders->projectmanager_Data();
        $this->template->build('add_order',$data);
    }
    public function add_EconomicBuyer($id='')
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('first_Name','First Name','required');
            $this->form_validation->set_rules('last_Name','Last Name','required');
            $this->form_validation->set_rules('location','Location','required');
            $this->form_validation->set_rules('designation','Designation','required');
            $this->form_validation->set_rules('contact_No','Contact No','required');
            $this->form_validation->set_rules('email_Id','Email Id ','required');
            if($this->form_validation->run()==false)
            {}
        else
        {
                $datas = array(
                        'first_Name' => $this->input->post('first_Name'),
                        'last_Name' => $this->input->post('last_Name'),
                        'location' => $this->input->post('location'),
                        'designation' => $this->input->post('designation'),
                        'contact_No' => $this->input->post('contact_No'),
                        'email_Id' => $this->input->post('email_Id'));
                }
                $this->orders->economicbuyer($datas);
                $this->template->build('add_client',$data);
        }        
    }
    public function add_AddressBilling($id='')
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('street','Street','required');
            $this->form_validation->set_rules('state','State','required');
            $this->form_validation->set_rules('country','Country','required');
            $this->form_validation->set_rules('city','City','required');
            $this->form_validation->set_rules('pin_code','Pin Code No','required');
            if($this->form_validation->run()==false)
            {}
                else
                {
                    $datas = array(
                        'street' => $this->input->post('street'),
                        'state' => $this->input->post('state'),
                        'country' => $this->input->post('country'),
                        'city' => $this->input->post('city'),
                        'pin_code' => $this->input->post('pin_code')
                        );
                 }
                $this->orders->addressbilling($datas);
                $this->template->build('add_client',$data);
        }        
    }
    public function add_Diagnose()
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('products','Products','required');
            $this->form_validation->set_rules('details','Details','required');
            $this->form_validation->set_rules('weight','Weight','required');
            $this->form_validation->set_rules('units','Units','required');
            $this->form_validation->set_rules('cunsultant','Cunsultant','required');
            $this->form_validation->set_rules('pax','Pax ','required');
            $this->form_validation->set_rules('no._Of_Casting','No. Of Casting ','required');
            $this->form_validation->set_rules('no._Of_Days','No. Of Days ','required');
            $this->form_validation->set_rules('cunsulting_Days','Cunsulting Days ','required');
            $this->form_validation->set_rules('start_Date','Start Date ','required');
            $this->form_validation->set_rules('end_Date','End Date ','required');
            $this->form_validation->set_rules('location','Location ','required');
            $this->form_validation->set_rules('price_And_Unit','Price And Unit ','required');
            $this->form_validation->set_rules('co-ordinator','Co-Ordinator ','required');
            $this->form_validation->set_rules('email_Id','Email Id ','required');
            $this->form_validation->set_rules('contact','Contact ','required');

            if($this->form_validation->run()==false)
            {}
        else{
                    $datas = array(
                        'products' => $this->input->post('products'),
                        'details' => $this->input->post('details'),
                        'weight' => $this->input->post('weight'),
                        'units' => $this->input->post('units'),
                        'cunsultant' => $this->input->post('cunsultant'),
                        'pax' => $this->input->post('pax'),
                        'no._Of_Casting' => $this->input->post('no._Of_Casting'),
                        'cunsulting_Days' => $this->input->post('cunsulting_Days'),
                        'start_Date' => $this->input->post('start_Date'),
                        'end_Date' => $this->input->post('end_Date'),
                        'location' => $this->input->post('location'),
                        'price_And_Unit' => $this->input->post('price_And_Unit'),
                        'co-ordinator' => $this->input->post('co-ordinator'),
                        'contact' => $this->input->post('contact'),
                        'email_Id' => $this->input->post('email_Id'));
                }
                $this->orders->diagnose($datas);
                $this->template->build('add_client',$data);
        }        
    }
    public  function delete($id='')
    {
            $delete=$this->orders->deletedata($id);
              if($delete==1)
            $this->messages->flash("Data Deleted Successfully");
            redirect('admin/order');
    }
     public  function autoCompletedPayment()
    {
        $autocomp=$this->input->post('request');
          $data=$this->orders->autoCompletedPayment($autocomp);
          echo json_encode($data);
    }
    // now the callback validation that deals with the upload of files
  public function fileupload_check()
  {
   echo "$$$$<pre>";print_r();die();
   return false;
    // we retrieve the number of files that were uploaded
    $number_of_files = sizeof($_FILES['documents']['tmp_name']);

    // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
    $files = $_FILES['documents'];

    // first make sure that there is no error in uploading the files
    for($i=0;$i<$number_of_files;$i++)
    {
      if($_FILES['documents']['error'][$i] != 0)
      {
        // save the error message and return false, the validation of uploaded files failed
        $this->form_validation->set_message('fileupload_check', 'Couldn\'t upload the file(s)');
        return false;
      }
    }
    
  return true;
    
  }

}