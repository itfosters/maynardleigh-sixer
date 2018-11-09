<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin extends ITFS_Controller {
    
    public function __construct() 
    {
    $this->load->helper('form','url');
    $this->load->library(array('form_validation','pagination'));
    $this->load->model('sellers');
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


        $conditions["where"] = array("user_type"=>'S');
        if(isset($searchfield["q"]) and !empty($searchfield["q"])){
            $conditions["like"] = array("name"=>$searchfield["q"],"email"=>$searchfield["q"]); 
        }
    
        // End of Filter Data
            $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('admin/seller/index');
            $config['total_rows'] =$this->users->totalData($conditions);
            $config['per_page'] =10;
            $config["uri_segment"]=4;
            $this->pagination->initialize($config);
            $page =$this->uri->segment(4)? $this->uri->segment(4):0;
            $data['all']=$this->users->findUser($conditions,$config["per_page"],$page);
            $data['link'] =$this->pagination->create_links();

            $this->template->headingtitle="Seller Listing";
            //$this->template->set_breadcrumb("Add Seller",site_url("admin/seller/form"));
            $this->template->set_breadcrumb("Seller Listing","");
            $this->template->build('admin_index',$data);
        
        
           }
    
   


    
    public function form($id='')
    {   //die('dsfdsw');
        if($this->input->post())
        {
            //die('dsfdsw');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Companyname', 'required');
        if(empty($id))
        $this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|is_unique[users.email]');
        

            if ($this->form_validation->run() == false) {
                 $data['frm_data']['view'] = (object) $this->input->post();
                } 
                else 
                {
                if(!empty($id)){
                  $datas = $this->input->post();
                  $where = array('id' => $id );
                  unset($datas['email']);
                 $updata=$this->sellers->updateSales($datas,$where);
                 if($updata==1)
                        {
                            $this->messages->flash('Data Updated Successfully');
                        }
                 redirect('admin/seller');

                    }else{

                    $datas = array(
                        'name' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'username' => $this->input->post('email'),
                        'password' => md5(123456),
                        'user_type'=>'S'
                        
                            );
                $insert=$this->sellers->updateSales($datas);
                if($insert==1)
            $this->messages->flash("Data saved successfully");
                redirect('admin/seller');
                 }
            }
    }
    else
    {
        $data=array();
        $data['frm_data']['view']=$this->sellers->up_data($id);
    }

    $this->template->headingtitle="Add Seller";
            $this->template->set_breadcrumb("Seller Listing",site_url("admin/seller/index"));
            $this->template->set_breadcrumb("Add Seller","");
        $this->template->build('admin_user_form',$data);   
}

    public  function deleted($id='')
    { //die("nbhgyhghuh");
        if ($this->input->post("itfaction") == "delete") {
            $allids = $this->input->post("itfrowdata");
            //$delds = array();
           
            $delete=$this->sellers->deleteMulti($allids);
            if($delete==1)
            $this->messages->flash("All Data Deleted Successfully");
            }else{
                 $delete=$this->sellers->deleteMulti($id);
                 if($delete==1)
            $this->messages->flash("Data Deleted Successfully");
            }
            
        redirect('admin/seller');
    }

   

}