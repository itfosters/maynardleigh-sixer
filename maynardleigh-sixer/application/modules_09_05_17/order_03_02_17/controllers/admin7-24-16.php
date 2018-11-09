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
            //die('vghujh');
            $all=$this->orders->showAllRows();
             //echo print_r($all);die();
            //$config=array();
            $config['base_url'] =base_url('order/index');
            $config['total_rows'] = $all;
            $config['per_page'] = 50;
            //$config['page_query_string'] = TRUE;
            $config["uri_segment"]=3;

            $this->pagination->initialize($config);
            //echo $this->pagination->create_links();
            $page =$this->uri->segment(3)? $this->uri->segment(3):0;

            $data['alldata']=$this->orders->showAllOrder($config["per_page"],$page);
            
            //$data['ids']=$id;
            //echo "@@@@<pre>";print_r($data);die;
            $data['links'] = $this->pagination->create_links();
            //echo "<pre>12345";print_r($data);die;
            //echo "<pre>";print_r($this->template);die();

            $this->template->headingtitle="ORDER LISTING";
            $this->template->set_breadcrumb("Add Order",site_url("admin/order/add_order"));
            $this->template->set_breadcrumb("ORDER LISTING","");
            $this->template->build('show_view',$data);
    }
    public function add_order($id='')
    {  
            $allClients = single_array($this->clients->getClientsForSelect(),'id','name','Select client');
            $data['clients']=$allClients;
            $allSeller = single_array($this->sellers->getSalesByForSelect(),'id','name','Select Seller');
            $data['salesBy']=$allSeller;
            $allManager = single_array($this->managers->getManagerForSelect(),'id','name','Select Manager');
            $data['manager']=$allManager;
            $alldocuments = single_array($this->documents->getDocumentsName(),'id','document_name');
            $data['document']=$alldocuments;
            //$alltransports = single_array($this->transports->getTransportsName(),'id','trans_name');
            $data['transports']=$this->transports->getTransportsName();
            
            if($this->input->post())

            {
                    //echo "####<pre>";print_r($_FILES);die;
                    //echo "<pre>";print_r($this->input->post());die;
                   //  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                   //  $this->form_validation->set_rules('efirst_name', 'First Name', 'required');
                   //  $this->form_validation->set_rules('eLast_Name', 'Last Name', 'required');
                   //  $this->form_validation->set_rules('eLocation', 'Location.', 'required');
                   //  $this->form_validation->set_rules('eDesignation', 'Designation', 'required');
                   //  $this->form_validation->set_rules('eContact', 'Contact', 'required');
                   //  $this->form_validation->set_rules('eEmail', 'Email.', 'required');
                   //  $this->form_validation->set_rules('astreet', 'Street Name', 'required');
                   //  $this->form_validation->set_rules('astate', 'State Name', 'required');
                   //  $this->form_validation->set_rules('apincode', 'Pin Code', 'required');
                   //  $this->form_validation->set_rules('tcpricevalid', 'Price Validity', 'required');
                   //  $this->form_validation->set_rules('tccancellation', 'Cancellation', 'required');
                   //  $this->form_validation->set_rules('tcspecialitem', 'Special Item.', 'required');
                   //  $this->form_validation->set_rules('tccontractno', 'Contract No', 'required');
                   //  $this->form_validation->set_rules('tcnote', 'Notes', 'required');
               
                   // if ($this->form_validation->run() == false) 
                   //  {
                   //      //echo "!!@@<pre>";print_r($this->input->post());die;
                   //  $data['frm_data']['view'] = (object) $this->input->post();
                   //      //die('ranu');
                   //  }
                   //  else 
                   //  {
                        if(empty($id))
                        {
                            $order_table = array();
                            $order_table['client_id'] = $this->input->post('client');
                            $order_table['sales_by_id'] = $this->input->post('Sales');
                            $order_table['pm_id'] = $this->input->post('manager');
                            $newOrderId = $this->orders->addOrder($order_table);
                            $newOderNo = 'MAYNARD'.$newOrderId;
                            $data1['order_Id']=$newOderNo;
                            $this->orders->updateOrderno($newOrderId,$data1);
                            $ename = $this->input->post('efirst_name');
                            $eorder['order_Id']=$newOrderId;
                            if(!empty($ename))
                            { 
                                $economic_table=array();
                                $economic_table['order_Id']=$newOrderId;
                                $economic_table['first_Name']=$this->input->post('efirst_name');
                                $economic_table['last_Name']=$this->input->post('eLast_Name');
                                $economic_table['location']=$this->input->post('eLocation');
                                $economic_table['designation']=$this->input->post('eDesignation');
                                $economic_table['contact_No']=$this->input->post('eContact');
                                $economic_table['email_Id']=$this->input->post('eEmail');
                                //echo "<pre>";print_r($economic_table);die;
                                $this->orders->add_EconomicBuyer($economic_table);
                            }
                            $street=$this->input->post('astreet');
                            if (!empty($street)) 
                            {
                                $addressbilling['order_Id']=$newOrderId;
                                $addressbilling['street']=$this->input->post('astreet');
                                $addressbilling['state']=$this->input->post('astate');
                                $addressbilling['country']=$this->input->post('acountry');
                                $addressbilling['city']=$this->input->post('acity');
                                $addressbilling['pincode']=$this->input->post('apincode');
                                $this->orders->add_AddressBilling($addressbilling);
                            }             

                                $tcpricevalid=$this->input->post('tcpricevalid');

                            if (!empty($tcpricevalid)) 
                            {//die('ranu');
                                $termcondition['order_id']=$newOrderId;
                                $termcondition['price_validity']=$this->input->post('tcpricevalid');
                                $termcondition['cancellation_clouse']=$this->input->post('tccancellation');
                                $termcondition['special_item']=$this->input->post('tcspecialitem');
                                $termcondition['contract_no']=$this->input->post('tccontractno');
                                $termcondition['notes']=$this->input->post('tcnote');
                                $termcondition['nda_required']=$this->input->post('tcndarequire');
                                $termcondition['payment_cycle']=$this->input->post('tcpaymentcycle');
                                $termcondition['mode_ofpayment']=$this->input->post('tcmodepayment');
                                //echo "%%%%<pre>";print_r($termcondition);die;
                                $this->orders->add_termcondition($termcondition);
                            }
                            
                            //Add Edit Transport
                            $trans=$this->input->post('transport');
                            //echo "<pre>";print_r($trans);die;
                            if (!empty($trans)) 
                                {
                                    $transport=array();
                                    foreach($trans as $keyoftp=>$valueoftransport){
                                        $transport[]=array('order_Id' => $newOrderId,'transport_id' => $keyoftp,'value' => $valueoftransport);
                                    }

                                 if(count($transport)>0)
                                    $this->orders->add_UpdateTransport($transport,array('order_Id' => $id));
                                }
                                

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
                                    $docarray['order_id']=$newOrderId;
                                    $docarray['document_id']=$key;
                                    $docarray['file_name']=$value;
                                    $this->orders->saveDocuments($docarray);
                                }  
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
                            $this->orders->addOrder($order_table,$where);
                            $ename = $this->input->post('efirst_name');
                            if(!empty($ename))
                            { 
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
                            }
                            $street=$this->input->post('astreet');
                            if (!empty($street)) 
                            {
                                $addressbilling['order_Id']=$id;
                                $addressbilling['street']=$this->input->post('astreet');
                                $addressbilling['state']=$this->input->post('astate');
                                $addressbilling['country']=$this->input->post('acountry');
                                $addressbilling['city']=$this->input->post('acity');
                                $addressbilling['pincode']=$this->input->post('apincode');
                                $whereadd['order_Id']=$id;
                                $this->orders->add_AddressBilling($addressbilling,$whereadd);
                            }             

                            $tcpricevalid=$this->input->post('tcpricevalid');

                            if (!empty($tcpricevalid)) 
                            {
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
                                $whereterm['order_id']=$id;
                                $this->orders->add_termcondition($termcondition,$whereterm);
                            }

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
                                    }//die('yes');
                                }
                            redirect('admin/order/index');
                        }
                                 
                    //}
        }elseif(!empty($id))
        {

            $data["frmdata"]['orderdata']=$this->orders->getSuborderById($id);
            
            $data["dtdoc"]['docview']=$this->orders->getDocById($id);
            $data["dttrans"]['transview']=single_array($this->orders->getTransById($id),'transport_id','value');
            //echo "@@@<pre>";print_r($data);die;
        }
            $this->template->headingtitle="Add Order";
            $this->template->set_breadcrumb("Order Listing",site_url("admin/order/index"));
            $this->template->set_breadcrumb("Add Order","");
            $this->template->build('add_order',$data); 
    }
    public function requestPinCode()
    {
        $q = $_GET['q'];
        //print_r($q);die;
        $data=$this->orders->getPinData($q);
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
                    //echo "<pre>";print_r($imageinfo);die;
                    $data["image_name"] = $imageinfo["file_name"];
                    return true;
                }else{

                    $data["error_msg"]= $this->upload->display_errors('<span>','</span>');
                    return false;
                }
            }
            return true;
    }

    public function details($orderid="")
    {//die('ddddd');
		$alldocuments = single_array($this->documents->getDocumentsName(),'id','document_name');
        $data['document']=$alldocuments;
        $alltransports = single_array($this->transports->getTransportsName(),'id','trans_name');
        $data['transports']=$alltransports;
        $data["dtdoc"]=single_array($this->orders->getDocById($orderid),'document_id','file_name');
        $data["dttrans"]=single_array($this->orders->getTransById($orderid),'transport_id','value');
		$data['detail']=$this->orders->getOrderDetail(array("O.id"=>$orderid));
		$data['diagonoesdetail']=$this->diagnoses->getDiagonoesDetail($orderid);
		$data['getdesigndetail']=$this->designs->getdesignDetail($orderid);
		$data['getdeliverydetail']=$this->deliveries->getdeliveryDetail($orderid);
		$data['getdiscoverydetail']=$this->discoveries->getdiscoveryDetail($orderid);
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
            $this->orders->deletedata($id);
            redirect('admin/order');
    }

}