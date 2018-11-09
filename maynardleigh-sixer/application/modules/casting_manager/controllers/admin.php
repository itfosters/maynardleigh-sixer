<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin extends ITFS_Controller 
{

    public function __construct() 
    {
        $this->load->helper('form','url');
        $this->load->library(array('form_validation','pagination'));
        $this->load->model('casting_managers');

    }
    public function index() {

    //Filter Data

        $conditions = array();

        if(isset($_POST["q"])) {
            $this->session->set_userdata(array("CASTINGSEARCHFIELD"=>$this->input->post()));
        } 

        $searchfield = $this->session->userdata("CASTINGSEARCHFIELD");
        if(count($searchfield)>0)
        $data["frm_data"] = $searchfield;


        $conditions["where"] = array("user_type"=>'CM');
        if(isset($searchfield["q"]) and !empty($searchfield["q"])){
            $conditions["like"] = array("name"=>$searchfield["q"],"email"=>$searchfield["q"]); 
        }
    
        // End of Filter Data
        
            $totalpages=$this->users->totalData($conditions);
            //echo $totalpages;die;
            $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('admin/casting_manager/index');
            $config['total_rows'] =$totalpages;
            $config['per_page'] =10;
            $config["uri_segment"]=4;
            $this->pagination->initialize($config);
            $page =$this->uri->segment(4)?$this->uri->segment(4):0;

            $data['all']=$this->users->findUser($conditions,$config["per_page"],$page);
            $data['link']=$this->pagination->create_links();

             $this->template->headingtitle="Resource Listing";
            //$this->template->set_breadcrumb("Add Resource",site_url("admin/casting_manager/form"));
            $this->template->set_breadcrumb("Resource Listing","");
        //print_r($data);die;
            $this->template->build('admin_index',$data);
      }
   public function form($id='')
    {   
        //die($id);
        if($this->input->post())
        {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Casting Manager Name', 'required');
        if(empty($id))
        $this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|is_unique[users.email]');
        else
        $this->form_validation->set_rules('email', 'Email Id', 'required|valid_email');
        $this->form_validation->set_rules('contact_no', 'Contact No.', 'required|regex_match[/^[0-9]{10}$/]');
        if(empty($id))
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) 
				{
                    $data['frm_data']['view'] = (object) $this->input->post();
                } 
                else
                {
                    $datas = array(
                        'name' => $this->input->post('name'),
                        'contact_no' => $this->input->post('contact_no'),
                        'email' => $this->input->post('email'),
                        'username' => $this->input->post('email'),
                        'password' => $this->input->post("password")
                        );
                    //echo "<pre>";print_r($datas);die;
                if(empty($id))
                {
                    //email code
                    $this->load->library('email');
                    $link =site_url('user/resource_login'.'/'.$id);
                    //$image= base_url('assests/img/logo.gif');
                    //echo "<pre>";print_r($image);die;
                    $this->email->to($this->input->post('email'));                
                    //$this->email->to('send2ranu@gmail.com');                
                    $this->email->from('info@maynardleighonline.in');
                    $this->email->set_mailtype("html");
                    $maildata = $this->mails->getMailById(20);
                    $information = array('password'=>$this->input->post("password"),
                                        'username'=>$this->input->post('email'),
                                        'name'=>$this->input->post('name'),
                                        'link'=>$link);
                    $datainfo = $this->messages->mailData($information ,$maildata->mailbody);                                 
                    $bodymessage = $this->messages->mailTemplate($datainfo);
                    $this->email->subject($maildata->mailsubject);
                    $this->email->message($bodymessage);
                    //echo "<pre>";print_r($this->email);die;
                    $this->email->send();
                    $this->email->clear();
                    $datas['user_type']="CM";
                    $insert=$this->users->register($datas);
                    if(!empty($insert))
                        {
                            $this->messages->flash('Resource has been saved successfully');
                        }
                }else{
                    unset($datas['password']);
                   $where = array('id' => $id );
                   $updata=$this->users->updateUser($datas,$where);
                   if($updata==1)
                        {
                            $this->messages->flash('Resource has been update successfully');
                        }
                }
                 redirect("admin/casting_manager");
             }
         }else{

                    $data['frm_data']['view']=$this->casting_managers->findById($id);
                    //echo "<pre>";print_r($data);die;
                }

                $this->template->headingtitle="Add Resource";
            $this->template->set_breadcrumb("Resource Listing",site_url("admin/casting_manager/index"));
            $this->template->set_breadcrumb("Add Resource","");
                $this->template->build('admin_user_form',$data);

               		   
        }
        
    
    public  function deleted($id='')
    { //die("nbhgyhghuh");
        if ($this->input->post("itfaction") == "delete") {
            $allids = $this->input->post("itfrowdata");
            //$delds = array();
           
            $delete=$this->casting_managers->deleteMulti($allids);
            if($delete==1)
            $this->messages->flash("Deleted Successfully");
            }else{
                 $delete=$this->casting_managers->deleteMulti($id);
                 if($delete==1)
            $this->messages->flash("Data Deleted Successfully");
            }
            
        redirect('admin/casting_manager');
    }
    

}