<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class Manager extends ITFS_Front_Controller {



    public function __construct() 
    {
    $this->load->helper('form','url');
    $this->load->library(array('form_validation','pagination'));
    $this->load->model('managers');
    }
    public function index() {
            $config = $this->paginationformat["back_page"];
            $config['base_url'] =base_url('admin/manager/index');
            $config['total_rows'] =$this->managers->showAllCount();
            $config['per_page'] =2;
            $config["uri_segment"]=4;
            $this->pagination->initialize($config);
            $page =$this->uri->segment(4)? $this->uri->segment(4):0;
            $data['all']=$this->managers->showAll($config["per_page"],$page);
            $data['link']=$this->pagination->create_links();
            $this->template->build('show_view',$data);
           }
    public function insert($id='')
    { 
        if($this->input->post())
        {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Sales name', 'required');
        $this->form_validation->set_rules('email_Id', 'Email Id', 'required|valid_email');
        //$this->form_validation->set_rules('contact_No', 'Contact No.', 'required|regex_match[/^[0-9]{10}$/]');
        

            if ($this->form_validation->run() == false) 
            {
                 $data['frm_data']['view'] = (object) $this->input->post();
                } 
                else
                {
                    if(empty($id))
                    {
                
                    $datas = array(
                        'name' => $this->input->post('name'),
                        //'email_Id' => $this->input->post('email_Id')
                        //'contact_No' => $this->input->post('contact_No')
                        //'name' => $this->input->post('name'),
                        'email' => $this->input->post('email_Id'),
                        'username' => $this->input->post('email_Id'),
                        'password' => md5(123456),
                        'user_type'=>"PM"
                            );
                    //echo "<pre>";print_r($datas);die;
                $this->managers->updateSales($datas);
                redirect("manager");
                }
                else
                    {//die('gfsgashagsy');
                    $datas = $this->input->post();
                    //echo "@@@@<pre>";print_r($datas);die;
                        //$datas = array(
                            //'name' => $this->input->post('name'),
                            //'email_Id' => $this->input->post('email_Id')
                        //'contact_No' => $this->input->post('contact_No')
                        
                           // );
                    $where = array('id' => $id );
                //echo "<pre>";print_r($id);die;
                    
                 $this->managers->updateSales($datas,$where);
                 redirect("manager");
                }
                
             }   
            
            
            //echo "<pre>";print_r($up);die;
        }else
        {
        $data=array();
        $data['frm_data']['view']=$this->managers->up_data($id);
        //echo "<pre>";print_r($data);die;
        //$this->template->build('header');
        }
        $this->template->build('add_manager',$data);   
}

    
    public  function deleted($id='')
    { //die("nbhgyhghuh");
        if ($this->input->post("itfaction") == "delete") {
            $allids = $this->input->post("itfrowdata");
            //$delds = array();
           
            $this->managers->deleteMulti($allids);
            }else{
                 $this->managers->deleteMulti($id);
            }
            
        redirect('manager');
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