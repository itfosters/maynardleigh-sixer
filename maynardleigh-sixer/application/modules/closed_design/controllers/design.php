<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class Design extends ITFS_Front_Controller {



    public function __construct() 
    {
    $this->load->helper('form','url');
    $this->load->library('form_validation');
    $this->load->model('designs');
    $this->load->model('diagnose/diagnoses');
    }
    public function index($id) {
            
            $data['all']=$this->designs->showAllDesign($id);
            $data['ids']=$id;
            //echo "<pre>";print_r($data);die;
			$this->template->headingtitle="DESIGN LISTING";
			$this->template->set_breadcrumb("ADD DESIGN",site_url("design/form/".$id));
			$this->template->set_breadcrumb("DESIGN LISTING ","");
            $this->template->build('show_design',$data);
        
        
           }
           

    

    public function form($id='',$subproduct='')
    {   
        //die($id);
        $this->load->model('product/products');
        $this->load->model('casting_manager/casting_managers');
        
        $allProduct = single_array($this->products->getProductsForSelect(2),'id','name','Select Product');
        $data['product']=$allProduct;
        $data['castingmanager']=single_array($this->casting_managers->getcastingManagerForSelect(),'id','name');
		//echo "<pre>1234"; print_r($data); die();
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                $this->form_validation->set_rules('dgproducts', 'Product Name', 'required');
                $this->form_validation->set_rules('dgdetails', 'Details', 'required');
                $this->form_validation->set_rules('dgweight', 'Weight.', 'required');
                $this->form_validation->set_rules('dgunits', 'Units', 'required');
                $this->form_validation->set_rules('dgpax', 'Pax', 'required');
                $this->form_validation->set_rules('dgnoofdays', 'No of Days', 'required');
                $this->form_validation->set_rules('dgcunsulting', 'Cunsulting Days', 'required');
                $this->form_validation->set_rules('dgstartdate', 'Start Date', 'required');
                $this->form_validation->set_rules('dgenddate', 'End Date', 'required');
                $this->form_validation->set_rules('dglocation', 'Location', 'required');
                $this->form_validation->set_rules('dgpriceandunit', 'Price nd Units', 'required');
                $this->form_validation->set_rules('dgcoordinator', 'Co Ordinator', 'required');
                $this->form_validation->set_rules('dgemail', 'Email', 'required');
                $this->form_validation->set_rules('dgcontact', 'Contact No', 'required');
                if ($this->form_validation->run() == false) {
                $data['subdesignid']=(object)array(
                                        'order_Id'=>$id,
                                        'products'=>$this->input->post('dgproducts'),
                                        'details'=>$this->input->post('dgdetails'),
                                        'weight'=>$this->input->post('dgweight'),
                                        'units'=>$this->input->post('dgunits'),
                                        'pax'=>$this->input->post('dgpax'),
                                        'no_ofdays'=>$this->input->post('dgnoofdays'),
                                        'cunsulting_days'=>$this->input->post('dgcunsulting'),
                                        'start_date'=>$this->input->post('dgstartdate'),
                                        'end_date'=>$this->input->post('dgenddate'),
                                        'location'=>$this->input->post('dglocation'),
                                        'price_unit'=>$this->input->post('dgpriceandunit'),
                                        'coordinator'=>$this->input->post('dgcoordinator'),
                                        'email_id'=>$this->input->post('dgemail'),
                                        'contact'=>$this->input->post('dgcontact')
                                        );
                    $data['selectedmangers']=$this->input->post('dgnocasting');
                    //echo "<pre>";print_r($data);die;
                }
                else 
                {
              
            if (empty($subproduct)) 
            {
                $design['order_Id']=$id;
                $design['products']=$this->input->post('dgproducts');
                $design['details']=$this->input->post('dgdetails');
                $design['weight']=$this->input->post('dgweight');
                $design['units']=$this->input->post('dgunits');
                $design['pax']=$this->input->post('dgpax');
                $design['no_ofdays']=$this->input->post('dgnoofdays');
                $design['cunsulting_days']=$this->input->post('dgcunsulting');
                $design['start_date']=$this->input->post('dgstartdate');
                $design['end_date']=$this->input->post('dgenddate');
                $design['location']=$this->input->post('dglocation');
                $design['price_unit']=$this->input->post('dgpriceandunit');
                $design['coordinator']=$this->input->post('dgcoordinator');
                $design['email_id']=$this->input->post('dgemail');
                $design['contact']=$this->input->post('dgcontact');
                $casting_manager=$this->input->post('dgnocasting');
                //echo "<pre>22222@@@@@@@@@@@";print_r($design);die;

                $inserid=$this->designs->add_Design($design);
                $casts=array();  
                         foreach ($casting_manager as $key => $value) {
                           $casts[]=array('diagnose_id'=>$inserid,'casting_manager'=>$value);
                        }
                        $this->diagnoses->addCasting($casts,array("diagnose_id"=>$inserid));
                redirect('design/index/'.$id);
            }
            else
            {
                $designdata=array();
                //$data=$this->input->post();
                $designdata=array(
                                        'order_Id'=>$id,
                                        'products'=>$this->input->post('dgproducts'),
                                        'details'=>$this->input->post('dgdetails'),
                                        'weight'=>$this->input->post('dgweight'),
                                        'units'=>$this->input->post('dgunits'),
                                        'pax'=>$this->input->post('dgpax'),
                                        'no_ofdays'=>$this->input->post('dgnoofdays'),
                                        'cunsulting_days'=>$this->input->post('dgcunsulting'),
                                        'start_date'=>$this->input->post('dgstartdate'),
                                        'end_date'=>$this->input->post('dgenddate'),
                                        'location'=>$this->input->post('dglocation'),
                                        'price_unit'=>$this->input->post('dgpriceandunit'),
                                        'coordinator'=>$this->input->post('dgcoordinator'),
                                        'email_id'=>$this->input->post('dgemail'),
                                        'contact'=>$this->input->post('dgcontact')
                                        );
                       
                        $casting_manager=$this->input->post('dgnocasting');
                         $this->designs->update_Design($designdata,$subproduct,$id);
                         $casts=array();
                              
                         foreach ($casting_manager as $key => $value) {
                           $casts[]=array('diagnose_id'=>$subproduct,'casting_manager'=>$value);
                        }
                         $this->diagnoses->addCasting($casts,array("diagnose_id"=>$subproduct));
                            redirect('design/index/'.$id);
                    
                }
                //echo "<pre>";print_r($designdata);die;
               
                //echo "<pre>";print_r($designdata);die;
                
            }//redirect('design/index/'.$id);
        }
        
            
            else
            {
                $data['subdesignid']=$this->designs->getSubdesignById($id,$subproduct);
                //echo "<pre>";print_r($data);die;
                //$result = $this->diagnoses->getCasting($subproduct);
				
                $data['selectedmangers']=array_keys(single_array($this->diagnoses->getCasting($subproduct),'casting_manager'));
                //echo "<pre>";print_r($data);die;
            }
        
        
            
            //echo "<pre>";print_r($data);die;
            //$this->template->add_js($modalViewi, "B", "embed");
            $this->template->headingtitle="ADD DESIGN";
            $this->template->set_breadcrumb("DESIGN LISTING",site_url("design/index/".$id));
            $this->template->set_breadcrumb("ADD DESIGN","");
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
            $this->designs->deletedata($id,$oid);
            //echo "<pre>";print_r($del);die;
        // $deldata['frm_data']['view']=$this->clients->up_data($id);
        //echo "<pre>";print_r($deldata);die;
        //$this->template->build('del_client',$deldata);
        redirect('design/index/'.$id);
    }
    public function details($id)
    {//die($id);
        $data['delview']=$this->designs->showDesignDetails($id);

        //echo "<pre>";print_r($data);die;
        $this->template->build('show_detail',$data);
    }
    public function calender($oid="",$designid="")
    {
        $data['allmanager'] = single_array($this->diagnoses->getAllManagers($designid),'id','name','Select Manager');
        //echo "<pre>";print_r($data);die;
        if($this->input->post())
        {       
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
            redirect("design/calender/".$oid."/".$designid);
        }
        $data['diagnose_id']=$designid;
        $this->template->build('calender',$data);
    

}
function getAssignDate()
    {
        
        $diaid=$this->input->post('diagnoseid');
        $mgrid=$this->input->post('managerid');
        $design['d_view']=$this->diagnoses->getCalenderDetails($diaid,$mgrid);
        //echo "%%%<pre>";print_r($design);die;
       
        $results = array();
        
        foreach ($design['d_view'] as $k => $v) {
            $results[] = array("id"=>$v->id,"title" => "Booked", "start" => date("Y-m-d", strtotime($v->start_date)),"end" => date("Y-m-d", strtotime($v->end_date)));
            //echo "%%%<pre>";print_r($v);
        }//die;
        
        return $this->output->set_content_type('application/json')->set_output(json_encode($results));
    }
}