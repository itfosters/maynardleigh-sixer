<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class Engagement extends ITFS_Public_Controller 
{
    public function __construct() 
    {
        $this->load->helper('form','url');
        $this->load->library(array('form_validation','pagination'));
        $this->load->model('engagements');
    }
    public function index($client_id,$assigntime_id) 
    {
        //$this->template->build('index', array("frmdata"=>$data)); 
        $this->template->set_layout('front_login');
        $data['assigntime_id']= $assigntime_id;
        $this->template->build('index',$data);   
    }
    public function feedback()
    {
        if($this->input->post())
        {
            $allPost = $this->input->post();
            $data = array(
                 'assign_time_id'=>$allPost['assing_time_id'],
                 'email_id'=>$allPost['email_id'],
                 'mobile_no'=>$allPost['mobile_no'],
                 'feedback'=>$allPost['feedback'],
                 'name'=>$allPost['name'],
                
            );
            $this->engagements->saveEngagement($data);
        }
        $redirctURL = base_url('engagement/thankyou');
        redirect($redirctURL);

    }
    public function thankyou()
    {
        $this->template->set_layout('front_login');
        $this->template->build('thankyou');   
    }
    
}