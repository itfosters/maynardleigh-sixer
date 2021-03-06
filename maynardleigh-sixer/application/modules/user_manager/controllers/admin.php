<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin extends ITFS_Controller 
{

    public function __construct() 
    {
        //this contructor
        $this->load->helper('form','url');
        $this->load->library(array('form_validation','pagination'));
        $this->load->model('user_managers');

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


        $conditions["where"] = array("user_type"=>'N');
        if(isset($searchfield["q"]) and !empty($searchfield["q"])){
            $conditions["like"] = array("name"=>$searchfield["q"],"email"=>$searchfield["q"]); 
        }
    
        // End of Filter Data
        
            $totalpages=$this->users->totalData($conditions);
            //echo $totalpages;die;
            $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('admin/user_manager/index');
            $config['total_rows'] =$totalpages;
            $config['per_page'] =10;
            $config["uri_segment"]=4;
            $this->pagination->initialize($config);
            $page =$this->uri->segment(4)?$this->uri->segment(4):0;

            $data['all']=$this->users->findUser($conditions,$config["per_page"],$page);
            $data['link']=$this->pagination->create_links();

             $this->template->headingtitle="Participants Listing";
            //$this->template->set_breadcrumb("Add User",site_url("admin/user_manager/form"));
            $this->template->set_breadcrumb("Participants Listing","");
        //print_r($data);die;
            $this->template->build('admin_index',$data);
      }
   public function form($id='')
    {  
        $this->load->model('client/clients');
        $data['clients'] = single_array($this->clients->getClientsForSelect(),'id','name');
        $data['clients']['']= 'Select Client';
        ksort($data['clients']);
        
        //die($id);
        if($this->input->post())
        {
            //echo "<pre>";print_r($this->input->post());die;
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'User Name', 'required');
        $this->form_validation->set_rules('client', 'Client Name', 'required');
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
                        'password' => $this->input->post("password"),
                        'client_id' => $this->input->post("client"),
                        'address' => $this->input->post("address"),
                        'street' => $this->input->post("street"),
                        'location' => $this->input->post("location"),
                        'city' => $this->input->post("city"),
                        'state' => $this->input->post("state"),
                        'pincode' => $this->input->post("pincode"),
                        'age' => $this->input->post("age"),
                        'department' => $this->input->post("department"),
                        'designation' => $this->input->post("designation"),
                        'reporting_to' => $this->input->post("reporting_to"),
                        'area_of_responsibility' => $this->input->post("area_of_responsibility"),
                        'yrs_at_ey' => $this->input->post("yrs_at_ey"),
                        'total_experience' => $this->input->post("total_experience"),
                        'qualification' => $this->input->post("qualification"),
                        'training_attended_in_the_past' => $this->input->post("training_attended_in_the_past"),
                        'previous_employer' => $this->input->post("previous_employer"),
                        );
                    //echo "<pre>";print_r($datas);die;
                if(empty($id))
                {
                    $datas['user_type']="N";
                    //echo "<pre>";print_r($datas);die;
                    $insert=$this->users->register($datas);
                    //email code
                    $this->load->library('email');
                    $link =site_url('user/user_login'.'/'.$id);
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
                    //$this->email->send();
                    $this->email->clear();
                    
                    if(!empty($insert))
                        {
                            $this->messages->flash('User has been saved successfully');
                        }
                }else{
                    unset($datas['password']);
                   $where = array('id' => $id );
                   $updata=$this->users->updateUser($datas,$where);
                   if($updata==1)
                        {
                            $this->messages->flash('Participant has been update successfully');
                        }
                }
                 redirect("admin/user_manager");
             }
         }else{

                    $data['frm_data']['view']=$this->user_managers->findById($id);
                    //echo "<pre>";print_r($data);die;
                }

            $this->template->headingtitle="Add Participants";
            $this->template->set_breadcrumb("Participants Listing",site_url("admin/user_manager/index"));
            $this->template->set_breadcrumb("Add Participants","");
                $this->template->build('admin_user_form',$data);

               		   
        }
        
    
    public  function deleted($id='')
    { //die("nbhgyhghuh");
        if ($this->input->post("itfaction") == "delete") {
            $allids = $this->input->post("itfrowdata");
            //$delds = array();
           
            $delete=$this->user_managers->deleteMulti($allids);
            if($delete==1)
            $this->messages->flash("Deleted Successfully");
            }else{
                 $delete=$this->user_managers->deleteMulti($id);
                 if($delete==1)
            $this->messages->flash("Data Deleted Successfully");
            }
            
        redirect('admin/user_manager');
    }
    

}