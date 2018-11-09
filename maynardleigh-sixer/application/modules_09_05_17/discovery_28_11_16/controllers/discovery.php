<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class Discovery extends ITFS_Front_Controller {



    public function __construct() 
    {
    $this->load->helper('form','url');
    $this->load->library('form_validation');
    $this->load->model('discoveries');
      $this->load->model('product/products');
        $this->load->model('casting_manager/casting_managers');
        $this->load->model('diagnose/diagnoses');
    }
    public function index($id) {
            
            $data['all']=$this->discoveries->showAllDiscovery($id);
            //echo "<pre>";print_r($data);die;
			$data['ids']=$id;
			$this->template->headingtitle="DISCOVERY LISTING";
			 $this->template->set_breadcrumb("ADD DISCOVERY",site_url("discovery/form/".$id));
			$this->template->set_breadcrumb("DISCOVERY LISTING","");
			
            $this->template->build('show_discovery',$data);
        
        
           }
           

    

    public function form($id='',$subproduct='')
    {   
      
        $allProduct = single_array($this->products->getProductsForSelect(4),'id','name','Select Product');
        $data['product']=$allProduct;
        $data['castingmanager']=single_array($this->casting_managers->getCastingManagerForSelect(),'id','name');
        //echo "<pre>";print_r($data);die;
        if($this->input->post())
        {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                $this->form_validation->set_rules('dvyproducts', 'Product Name', 'required');
                $this->form_validation->set_rules('dvydetails', 'Details', 'required');
                $this->form_validation->set_rules('dvyweight', 'Weight.', 'required');
                $this->form_validation->set_rules('dvyunits', 'Units', 'required');
                $this->form_validation->set_rules('dvypax', 'Pax', 'required');
                $this->form_validation->set_rules('dvynoofdays', 'No of Days', 'required');
                $this->form_validation->set_rules('dvycunsulting', 'Cunsulting Days', 'required');
                $this->form_validation->set_rules('dvystartdate', 'Start Date', 'required');
                $this->form_validation->set_rules('dvyenddate', 'End Date', 'required');
                $this->form_validation->set_rules('dvylocation', 'Location', 'required');
                $this->form_validation->set_rules('dvypriceandunit', 'Price nd Units', 'required');
                $this->form_validation->set_rules('dvycoordinator', 'Co Ordinator', 'required');
                $this->form_validation->set_rules('dvyemail', 'Email', 'required');
                $this->form_validation->set_rules('dvycontact', 'Contact No', 'required');
                if ($this->form_validation->run() == false) 
                {
                    $data['subdiscoveryid'] =(object)array(
                                                'order_Id'=>$id,
                                                'products'=>$this->input->post('dvyproducts'),
                                                'details'=>$this->input->post('dvydetails'),
                                                'weight'=>$this->input->post('dvyweight'),
                                                'units'=>$this->input->post('dvyunits'),
                                                'pax'=>$this->input->post('dvypax'),
                                                'no_ofdays'=>$this->input->post('dvynoofdays'),
                                                'cunsulting_days'=>$this->input->post('dvycunsulting'),
                                                'start_date'=>$this->input->post('dvystartdate'),
                                                'end_date'=>$this->input->post('dvyenddate'),
                                                'location'=>$this->input->post('dvylocation'),
                                                'price_unit'=>$this->input->post('dvypriceandunit'),
                                                'coordinator'=>$this->input->post('dvycoordinator'),
                                                'email_id'=>$this->input->post('dvyemail'),
                                                'contact'=>$this->input->post('dvycontact')
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
                        $discovery['details']=$this->input->post('dvydetails');
                        $discovery['weight']=$this->input->post('dvyweight');
                        $discovery['units']=$this->input->post('dvyunits');
                        $discovery['pax']=$this->input->post('dvypax');
                        $discovery['no_ofdays']=$this->input->post('dvynoofdays');
                        $discovery['cunsulting_days']=$this->input->post('dvycunsulting');
                        $discovery['start_date']=$this->input->post('dvystartdate');
                        $discovery['end_date']=$this->input->post('dvyenddate');
                        $discovery['location']=$this->input->post('dvylocation');
                        $discovery['price_unit']=$this->input->post('dvypriceandunit');
                        $discovery['coordinator']=$this->input->post('dvycoordinator');
                        $discovery['email_id']=$this->input->post('dvyemail');
                        $discovery['contact']=$this->input->post('dvycontact');
                        $casting_manager=$this->input->post('dvynocasting');
                        //echo "<pre>22222@@@@@@@@@@@";print_r($discovery);die;

                        $inserid=$this->discoveries->add_discovery($discovery);
                        $casts=array();  
                        foreach ($casting_manager as $key => $value) 
                        {
                            $casts[]=array('diagnose_id'=>$inserid,'casting_manager'=>$value);
                        }
                        $this->diagnoses->addCasting($casts,array("diagnose_id"=>$inserid));
                        redirect('discovery/index/'.$id);
                    }
                    else
                    {
                        $discoverydata=array();
                        //$data=$this->input->post();
                        $discoverydata=array(
                        'order_Id'=>$id,
                        'products'=>$this->input->post('dvyproducts'),
                        'details'=>$this->input->post('dvydetails'),
                        'weight'=>$this->input->post('dvyweight'),
                        'units'=>$this->input->post('dvyunits'),
                        'pax'=>$this->input->post('dvypax'),
                        'no_ofdays'=>$this->input->post('dvynoofdays'),
                        'cunsulting_days'=>$this->input->post('dvycunsulting'),
                        'start_date'=>$this->input->post('dvystartdate'),
                        'end_date'=>$this->input->post('dvyenddate'),
                        'location'=>$this->input->post('dvylocation'),
                        'price_unit'=>$this->input->post('dvypriceandunit'),
                        'coordinator'=>$this->input->post('dvycoordinator'),
                        'email_id'=>$this->input->post('dvyemail'),
                        'contact'=>$this->input->post('dvycontact')
                        );
                        $casting_manager=$this->input->post('dvynocasting');
                        //echo "<pre>";print_r($designdata);die;
                        $this->discoveries->update_Discovery($discoverydata,$subproduct,$id);
                        //echo "<pre>";print_r($designdata);die;
                        $casts=array();

                        foreach ($casting_manager as $key => $value) 
                        {
                            $casts[]=array('diagnose_id'=>$subproduct,'casting_manager'=>$value);
                        }
                        $this->diagnoses->addCasting($casts,array("diagnose_id"=>$subproduct));
                        redirect('discovery/index/'.$id);
                    }
                }
        }
        else
        {
            $data['subdiscoveryid']=$this->discoveries->getSubdiscoveryById($id,$subproduct);
            $data['selectedmangers']=array_keys(single_array($this->diagnoses->getCasting($subproduct),'casting_manager'));
            //echo "<pre>";print_r($data);die;
            //$this->template->add_js($modalViewi, "B", "embed");
        }
            $this->template->headingtitle="ADD DISCOVERY";
            $this->template->set_breadcrumb("DISCOVERY LISTING",site_url("discovery/index/".$id));
            $this->template->set_breadcrumb("ADD DISCOVERY","");
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
            //$del=$this->input->post();
            $this->discoveries->deletedata($id,$oid);
            //echo "<pre>";print_r($del);die;
        // $deldata['frm_data']['view']=$this->clients->up_data($id);
        //echo "<pre>";print_r($deldata);die;
        //$this->template->build('del_client',$deldata);
        redirect('discovery/index/'.$id);
    }
    public function details($id)
    {//die($id);
        $data['delview']=$this->discoveries->showDiscoveryDetails($id);

        //echo "<pre>";print_r($data);die;
        $this->template->build('show_detail',$data);
    }
    public function calender($oid="",$discoverid="")
    {
        //$this->load->model("diagnoses");
       
        $data['allmanager'] = single_array($this->diagnoses->getAllManagers($discoverid),'id','name','Select Manager');
        
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
            redirect("discovery/calender/".$oid."/".$digid);
        }
        
        $data['diagnose_id']=$discoverid;
        
        $this->template->build('calender',$data);
    }
    function getAssignDate()
    {
        
        $diaid=$this->input->post('diagnoseid');
        $mgrid=$this->input->post('managerid');
        $discovery['d_view']=$this->diagnoses->getCalenderDetails($diaid,$mgrid);
        //echo "%%%<pre>";print_r($discovery);die;
       
        $results = array();
        
        foreach ($discovery['d_view'] as $k => $v) {
            $results[] = array("id"=>$v->id,"title" => "Booked", "start" => date("Y-m-d", strtotime($v->start_date)),"end" => date("Y-m-d", strtotime($v->end_date)));
            //echo "%%%<pre>";print_r($v);
        }//die;
        
        return $this->output->set_content_type('application/json')->set_output(json_encode($results));
    }
    
    
    
    public function viewCalender()
    {
        $this->template->build('viewCalender');
    }
    

}