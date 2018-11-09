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
            $this->session->set_userdata(array("SUBPRODUCTSEARCHFIELD"=>$this->input->post()));
        } 

        $searchfield = $this->session->userdata("SUBPRODUCTSEARCHFIELD");
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
            $data['page']=$page;
            $data['link']=$this->pagination->create_links();
            $this->template->headingtitle="Sub Product Listing";
            //$this->template->set_breadcrumb("Add Sub Product",site_url("admin/subproduct/form"));
            $this->template->set_breadcrumb("Sub Product Listing","");
            $this->template->build('admin_index',$data);
        
           }
          

    public function form($id='')
    {  
         $data=array();
        $data['property']=single_array($this->subproducts->getSubProducts(),'id','name','Select property type');
        if($this->input->post())
        {
            //die('gfguh');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if(empty($id))
            $this->form_validation->set_rules('name', 'sub product name', 'required|is_unique[subproducts.name]');
        else
            $this->form_validation->set_rules('name', 'sub product name', 'required');
        
            if ($this->form_validation->run() == false) 
            {
                $data['frm_data']['view'] = (object) array(
                            'name' => $this->input->post('name'),
                );
            } 
                else 
                {
                if(!empty($id)){
                     $datas = array(
                        'name' => $this->input->post('name'),
                        'parent_id' => $this->input->post('parent_name')

                        );
                   
                  $where = array('id' => $id );
                  
                 $updata=$this->subproducts->updateSubProduct($datas,$where);
                 if($updata==1)
                        {
                            $this->messages->flash('Data Updated Successfully');
                        }
                 redirect("admin/subproduct");
                    
                    }else{
                    $datas = array(
                        'name' => $this->input->post('name'),
                        'parent_id' => $this->input->post('parent_name')
                      
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
     else{  
        $data['frm_data']['view']=$this->subproducts->getSubProductsById($id);
     }
        $this->template->headingtitle="Add Sub Product";
            $this->template->set_breadcrumb("Sub Product Listing",site_url("admin/subproduct/index"));
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
            
        redirect('admin/subproduct/index/'.$this->input->post("pagevalue"));
    }
     public function childProduct($id=0) {
        //Filter Data
       
        $conditions = array();
        //echo  $data['id'];die;
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
            $config['base_url'] =base_url('admin/subproduct/childProduct');
            $config['total_rows']=$this->subproducts->totalChildData($id,$conditions);
            $config['per_page'] =10;
            $config["uri_segment"]=4;
            //echo "<pre>";print_r($config['total_rows']);die;
            $this->pagination->initialize($config);
            $page =$this->uri->segment(4)? $this->uri->segment(4):0;
            $data['all']=$this->subproducts->findChild($id,$conditions,$config["per_page"],$page);
            $data['link']=$this->pagination->create_links();
            $data['id']=$id;
            //echo "<pre>";print_r($data);die;
            $this->template->headingtitle="Child Product Listing";
            $this->template->set_breadcrumb("Add Child Product",site_url("admin/subproduct/form"));
            $this->template->set_breadcrumb("Child Product Listing","");
            $this->template->build('sub_index',$data);
        
           }

    public function addChildForm($id='',$childpro='')
    {  
//die($childpro);
         $data=array();
         //$data['id']=$id;
        $data['property']=single_array($this->subproducts->getSubProducts(),'id','name','Select property type');
        if($this->input->post())
        {
            //die('gfguh');
        // $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // $this->form_validation->set_rules('name', 'sub product name', 'required');
       
        //     if ($this->form_validation->run() == false) 
        //     {
 
        //     } 
        //         else 
        //         {
                if(!empty($childpro)){
                    //die($childpro);
                     $datas = array(
                        'name' => $this->input->post('name')
                        );
                   
                    $where['id']=$childpro;
                 $updata=$this->subproducts->updateSubProduct($datas,$where);
                 if($updata==1)
                        $this->messages->flash('Data Updated Successfully');
                      
                            redirect("admin/subproduct/childProduct/".$id);
                        
                    
                    }else{
                        //die('hghygiug');
                    $datas = array(
                        'name' => $this->input->post('name'),
                        'parent_id'=>$id
                        );
                   
                $insert=$this->subproducts->updateSubProduct($datas);
                if($insert==1)
                        {
                            $this->messages->flash('Data Insert Successfully');
                        }
                        
                redirect("admin/subproduct/childProduct/".$id);
            }
        //}
    }
       
        $data['frm_data']['view']=$this->subproducts->getSubProductsById($id);
        $data['frm_data']['childproname']=$this->subproducts->getChildProductName($childpro);
        //echo "<pre>";print_r($data['childproname']);die;
        $this->template->headingtitle="Add Sub Product";
            $this->template->set_breadcrumb("Sub Product Listing",site_url("admin/subproduct/index"));
            $this->template->set_breadcrumb("Add SubProduct","");
        
        $this->template->build('admin_child_form',$data);   
}

    

}