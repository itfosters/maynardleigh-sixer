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
            $config['per_page'] =2;
            $config["uri_segment"]=4;
            $this->pagination->initialize($config);
            $page =$this->uri->segment(4)? $this->uri->segment(4):0;
            $data['all']=$this->products->findUser($conditions,$config["per_page"],$page);
            $data['link']=$this->pagination->create_links();
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
                  $where = array('id' => $id );
                  
                 $updata=$this->products->updateProduct($datas,$where);
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
                $insert=$this->products->updateProduct($datas);
                if(count($mrspro)>1 && isset($mrspro)) {
                    //echo "###<pre>".count($casting_manager);print_r($casting_manager);die;
                                    $pro=array();  
						 foreach ($mrspro as $key => $value) {
						   $pro[]=array('id'=>$insert,'name'=>$value);
						}
						$this->products->addmrspro($pro,array("id"=>$insert));
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
       // echo '<pre>';
               // print_r($data);die;
        $this->template->build('admin_user_form',$data);   
}

    
     public  function deleted($id='')
    {
        if ($this->input->post("itfaction") == "delete") {
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