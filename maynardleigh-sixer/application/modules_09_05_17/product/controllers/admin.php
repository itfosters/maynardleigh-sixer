<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin extends ITFS_Controller 
{
    public function __construct() 
    {
    $this->load->helper('form','url');
    $this->load->library(array('form_validation','pagination'));
    $this->load->model('products');
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
            $config['base_url'] =base_url('admin/product/index');
            $config['total_rows']=$this->products->totalData($conditions);
            $config['per_page'] =10;
            $config["uri_segment"]=4;
            $this->pagination->initialize($config);
            $page =$this->uri->segment(4)? $this->uri->segment(4):0;
            $data['all']=$this->products->findUser($conditions,$config["per_page"],$page);
            $data['link']=$this->pagination->create_links();
            $this->template->headingtitle="Product Listing";
            //$this->template->set_breadcrumb("Add Product",site_url("admin/product/form"));
            $this->template->set_breadcrumb("Product Listing",""); 
            $this->template->build('admin_index',$data);
        
           }
          

    public function form($id='')
    {  $data=array();
        $allmrsdata=single_array($this->products->getMrsProduct(),'id','name');
        $data['mrsproduct']=$allmrsdata;
        //echo '<pre>';print_r($data);die;
		if($this->input->post())
        {
               //echo '<pre>';print_r($_POST);die;     
            //die('gfguh');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Product name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('weight', 'Weight', 'required');
            if ($this->form_validation->run() == false) 
            {
 
            } 
                else 
                {
                if(!empty($id)){
                     $datas = array(
                        'name' => $this->input->post('name'),
                        'price' => $this->input->post('price'),
                        'weight' => $this->input->post('weight'),
                        'product_type' => $this->input->post('product_type')
                        );
                      $mrspro=array();
                     $mrspro=is_array($this->input->post('mrs_list'))?$this->input->post('mrs_list'):array();
                  $where = array('id' => $id );
                  
                 $updata=$this->products->updateProduct($datas,$where);
                 $pro=array();  
						 foreach ($mrspro as $key => $value) {
						   $pro[]=array('proid'=>$id,'name'=>$value);
						}
						$this->products->addmrspro($pro,array("proid"=>$id));
                    
                 if($updata==1)
                        {
                            $this->messages->flash('Data Updated Successfully');
                        }
                 redirect("admin/product");
                    
                    }else{
                    $datas = array(
                        'name' => $this->input->post('name'),
                        'price' => $this->input->post('price'),
                        'weight' => $this->input->post('weight'),
                        'product_type' => $this->input->post('product_type')
                        );
                    $mrspro=$this->input->post('mrs_list');
                    //echo '####<pre>';print_r($mrspro);die;
                                        
                $insert=$this->products->updateProduct($datas);
                if(count($mrspro)>1 && isset($mrspro)) {
                    //echo "###<pre>".count($casting_manager);print_r($casting_manager);die;
                                    $pro=array();  
						 foreach ($mrspro as $key => $value) {
						   $pro[]=array('proid'=>$insert,'name'=>$value);
						}
						$this->products->addmrspro($pro,array("proid"=>$insert));
                    }
                if($insert==1)
                        {
                            $this->messages->flash('Data Insert Successfully');
                        }
                redirect("admin/product");
            }
        }
    }
        
        $data['frm_data']['view']=$this->products->getUsersById($id);
        $data['frm_data']['mrs']=$this->products->getAllMrs($id);
        //$data['frm_data']['mrs']=$this->products->getAllMrs($id);
        //echo '<pre>'; print_r($data);die;
             $this->template->headingtitle="Add Product";
            $this->template->set_breadcrumb("Product Listing",site_url("admin/product/index"));
            $this->template->set_breadcrumb("Add Product","");  
        $this->template->build('admin_user_form',$data);   
}

    
     public  function deleted($id='')
    {//echo "###<pre>";print_r($_POST);die;
        if ($this->input->post("itfaction") == "delete") {
            echo "###<pre>";print_r($_POST);die;
            $allids = $this->input->post("itfrowdata");
            $delete=$this->products->deleteMulti($allids);
             if($delete==1)
            $this->messages->flash("All Data Deleted Successfully");
            }else{
                 $delete=$this->products->deleteMulti($id);
                  if($delete==1)
            $this->messages->flash("Data Deleted Successfully");
            }
            
        redirect('admin/product');
    }
    

}