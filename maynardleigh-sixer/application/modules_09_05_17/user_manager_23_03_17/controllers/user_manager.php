<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class User_manager extends ITFS_Front_Controller {



    public function __construct() 
    {
     parent::__construct();
    $this->load->helper('form','url');
    $this->load->library('form_validation');
    $this->load->model('user_managers');
    $this->load->model('welcome/welcomes','welcomes');    
        $this->load->model('order/orders');    
        $this->load->model('document/documents');    
        $this->load->model('transport/transports');    
        $this->load->model('diagnose/diagnoses');    
        $this->load->model('design/designs');    
        $this->load->model('delivery/deliveries');    
        $this->load->model('discovery/discoveries');
        $this->load->library('pagination');    
        $this->load->model('user/users'); 
    }
    public function index() {
		
         
        $this->template->build('index');
        
           }
          



    
    public function insert($id='')
    {   
        //die($id);
        if($this->input->post())
        {
            //die('gfguh');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Casting manager name', 'required');
        $this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|callback_email_check');
        $this->form_validation->set_rules('contact_no', 'Contact No.', 'required|regex_match[/^[0-9]{10}$/]');
        

            if ($this->form_validation->run() == false) 
				{
                //$this->load->view('new_client');
                //die('hello111');
                 $data['frm_data']['view'] = (object) $this->input->post();
                } 
                else
                {
                    if(empty($id))
                    {//die('bhvdshbd');
                
                    $datas = array(
                        'name' => $this->input->post('name'),
                        'contact_no' => $this->input->post('contact_no'),
                        'email' => $this->input->post('email'),
                        'username' => $this->input->post('email'),
                        'password' => md5(123456),
                        'user_type'=>"U"
                            );
                    //echo "@@@@@<pre>";print_r($datas);die;
               		 $this->casting_managers->updateCastingManager($datas);
                		redirect("casting_manager");
                	}
                	else
                    {
						$datas = array(
                        'name' => $this->input->post('name'),
                        'contact_no' => $this->input->post('contact_no'),
                        'email' => $this->input->post('email'),
                        'username' => $this->input->post('email'),
                        'password' => md5(123456),
                        'user_type'=>"U"
                            );
                    $where = array('id' => $id );
                    
                 		$this->casting_managers->updateCastingManager($datas,$where);
                 		redirect("casting_manager");
               		 }
                
             	}   
            
            
                    }else
        {
        $data=array();
        $data['frm_data']['view']=$this->casting_managers->up_data($id);
        }
        $this->template->build('add_castingmanager',$data);   
}
 public function email_check()
    {
        die('ranu');
        $email = $this->input->post('email');
        echo "<pre>";print_r($email);die;
        $check = $this->casting_managers->email_check($email);
        if($check > 0)
        {
            $this->form_validation->set_message('email_check', 'Sorry, it looks like the Email id, belongs to an existing account.');
            return false;

        }
        else
        {
            return true;
        }
    }

    
    public  function deleted($id='')
    {
        if ($this->input->post("itfaction") == "delete") {
            $allids = $this->input->post("itfrowdata");
            //$delds = array();
           
            $this->casting_managers->deleteMulti($allids);
            }else{
                 $this->casting_managers->deleteMulti($id);
            }
            
        redirect('casting_manager');
    }
    public function profile()

    {

    

        $this->load->model("users");

        $this->load->model("user/contact_detail");

        $this->load->model("user/personal_detail");

        $this->load->library('form_validation');

        

        $userid = $this->auth->getUserId();

        

        if(count($_POST)>0){

            $this->form_validation->set_rules('name', 'first name', 'required');

            

            if($this->form_validation->run() == FALSE) {

                    $data["frm_data"] = (object)$this->input->post();

            }else{

                $alldata = $this->input->post();



                $user_conact_id=isset($alldata["conact_id"])?$alldata["conact_id"]:"";

                $user_personal_id=isset($alldata["personal_id"])?$alldata["personal_id"]:"";



                $data=array(

                    "name"=>$alldata["name"],

                    "last_name"=>$alldata["last_name"]

                );



                $contact_info=array(

                    "address1"=>$alldata["address1"],

                    "address2"=>$alldata["address2"],

                    "city"=>$alldata["city"],

                    "state"=>$alldata["state"],

                    "zipcode"=>$alldata["zipcode"],

                    "country"=>$alldata["country"],

                    "home_phone"=>$alldata["home_phone"],

                    "mobile"=>$alldata["mobile"],

                    "work_email"=>$alldata["work_email"],

                    "other_email"=>$alldata["other_email"]

                );

                

                $personal_info=array(

                    "licence_number"=>$alldata["licence_number"],

                    "licence_expire"=>$alldata["licence_expire"],

                    "gender"=>$alldata["gender"],

                    "marital_status"=>$alldata["marital_status"],

                    "nationality"=>$alldata["nationality"],

                    "dob"=>$alldata["dob"]

                );



                $this->users->updateUser($data , array("id"=>$userid));



                $contact_info["user_id"]=$userid;

                $personal_info["user_id"]=$userid;

                    

                    

                if(!empty($user_conact_id))

                    $this->contact_detail->update($contact_info,array("user_id"=>$userid));

                else

                    $this->contact_detail->save($contact_info);

                    

                if(!empty($user_personal_id))

                    $this->personal_detail->update($personal_info,array("user_id"=>$userid));

                else

                    $this->personal_detail->save($personal_info);



                $this->messages->flash("Profile have been succesfully updated.","success");

                redirect(array("user","profile"));          

            }   

        }

        else

        {

            $userinfo = $this->users->getUsersInfoById($userid);

            $data["frm_data"]=$userinfo;

        }

        $this->template->headingtitle="Profile";

        $this->template->set_breadcrumb("Profile Information","");

        $this->template->build('profile',array("frm_data"=>$data));

    

    }





    public function profile_image()

    {

    

        $this->load->model("users");

        $this->load->library('form_validation');

        

        $userid = $this->auth->getUserId();

        $data=array();

        

        if(count($_POST)>0){

            $this->form_validation->set_rules('profile', 'profile image', 'required');

            

            if($this->form_validation->run() == FALSE) {

                    $data["frm_data"] = (object)$this->input->post();

            }else{



                $data = $this->input->post();



                if($this->UploadImage($data,$userid)===false) { 

                    $data["frm_data"]["frm_data"] = (object)$this->input->post();

                    $status = false;

                }

                

                if(isset($data["image_name"]) and !empty($data["image_name"]))

                {

                    $data=array("profile_image"=>$data["image_name"]);

                    $this->users->updateUser($data , array("id"=>$userid));

                    $this->messages->flash("Profile image been succesfully updated.","success");

                    redirect(array("user","profile_image"));            

                }else{



                    $this->messages->flash(isset($data["error_msg"])?$data["error_msg"]:"Profile image uploading failed.","error");

                }

                

            }   

        }



        $this->template->headingtitle="Profile Image";

        $this->template->set_breadcrumb("Profile Image","");

        $this->template->build('profile_image');

    

    }





    protected function UploadImage(&$data,$id) {   



        if(isset($_FILES["your_image"]["name"]) and !empty($_FILES["your_image"]["name"])) 

        {

            $config['upload_path'] = PUBLIC_PATH."profile/";

            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $config['max_size'] = '20000000';

            $config['max_width'] = '2024';

            $config['max_height'] = '2024';

            $this->load->library('upload');

            $this->upload->initialize($config);

            $result = $this->upload->do_upload('your_image');

                        

            if($result>=1) {

                $this->deleteImage($id);

                $imageinfo = $this->upload->data();

                $data["image_name"] = $imageinfo["file_name"];



                return true;

            }else {

                $data["error_msg"]= $this->upload->display_errors('<span>','</span>');

                return false;

            }

        }

            return true;

    }



    //Deleted File

    function deleteImage($ids="0") {    

            $imageinfo = $this->users->getUsersById($ids);

            @unlink(PUBLIC_PATH."profile/".$imageinfo->profile_image);

    }



    public function captch()

    {

        $this->load->library('captcha');

        $this->captcha->setFont(FCPATH."assests/fonts/KhmerUI.ttf");

        $this->captcha->Images(145,35,6);

    }





    public function restricted()

    {



        $this->template

        ->build('restricted');



    }





    public function activate($userid=""){

        $this->load->model("users");

        $this->users->activateuser($userid,"1");

        $this->messages->flash("Now, You have successfully activated your account.", "success");

        redirect(array("user/user_login"));



    }



    public function job(){



        $this->load->model("user/job_detail");



         $userid = $this->auth->getUserId();

        $data["jobinfo"] = $this->job_detail->getUsersJobById($userid);



        $this->template->headingtitle="Job Detail";

        $this->template->set_breadcrumb("Job Detail","");

        $this->template->build('job',array("itfdata"=>$data));

    }

}