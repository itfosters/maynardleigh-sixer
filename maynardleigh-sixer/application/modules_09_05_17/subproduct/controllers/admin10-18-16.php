<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin extends ITFS_Controller 
{
    public function __construct() 
    {
    $this->load->helper('form','url');
    $this->load->library(array('form_validation','pagination'));
    $this->load->model('subproducts');
    }
    public function index() {
        //Filter Data

        $conditions = array();

        if(isset($_POST["q"])) {
            $this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));
        } 

        $searchfield = $this->session->userdata("SEARCHFIELD");
        if(count($searchfield)>0)
        $data["frm_data"] = $searchfield;


        if(isset($searchfield["q"]) and !empty($searchfield["q"])){
            $conditions["like"] = array("name"=>$searchfield["q"]); 
        }
    
        // End of Filter Data
        
            $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('admin/subproduct/index');
            $config['total_rows']=$this->subproducts->totalData($conditions);
            $config['per_page'] =10;
            $config["uri_segment"]=4;
            $this->pagination->initialize($config);
            $page =$this->uri->segment(4)? $this->uri->segment(4):0;
            $data['all']=$this->subproducts->findSubProduct($conditions,$config["per_page"],$page);
            $data['link']=$this->pagination->create_links();

            $this->template->headingtitle="SubProduct Listing";
            $this->template->set_breadcrumb("Add SubProduct",site_url("admin/subproduct/form"));
            $this->template->set_breadcrumb("SubProduct Listing","");
            $this->template->build('admin_index',$data);
        
           }
          

    public function form($id='')
    {  
		if($this->input->post())
        {
            //die('gfguh');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'subproduct name', 'required');
       
            if ($this->form_validation->run() == false) 
            {
 
            } 
                else 
                {
                if(!empty($id)){
                     $datas = array(
                        'name' => $this->input->post('name')
                        );
                  $where = array('id' => $id );
                  
                 $updata=$this->subproducts->updateProduct($datas,$where);
                 if($updata==1)
                        {
                            $this->messages->flash('Data Updated Successfully');
                        }
                 redirect("admin/subproduct");
                    
                    }else{
                    $datas = array(
                        'name' => $this->input->post('name')
                      
                        );
                $insert=$this->subproducts->updateSubProduct($datas);
                if($insert==1)
                        {
                            $this->messages->flash('Data Insert Successfully');
                        }
                redirect("admin/subproduct");
            }
        }
    }
        $data=array();
        $data['frm_data']['view']=$this->subproducts->getSubProductsById($id);

        $this->template->headingtitle="Add SubProduct";
            $this->template->set_breadcrumb("SubProduct Listing",site_url("admin/subproduct/index"));
            $this->template->set_breadcrumb("Add SubProduct","");
        $this->template->build('admin_subproduct_form',$data);   
}

    
     public  function deleted($id='')
    {
        if ($this->input->post("itfaction") == "delete") {
            $allids = $this->input->post("itfrowdata");
            $delete=$this->subproducts->deleteMulti($allids);
             if($delete==1)
            $this->messages->flash("All Data Deleted Successfully");
            }else{
                 $delete=$this->subproducts->deleteMulti($id);
                  if($delete==1)
            $this->messages->flash("Data Deleted Successfully");
            }
            
        redirect('admin/subproduct');
    }
    

}