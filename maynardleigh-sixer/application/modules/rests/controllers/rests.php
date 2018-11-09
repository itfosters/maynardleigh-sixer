<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

class Rests extends ITFS_Front_Controller {

    public function __construct() 
    {
    $this->load->helper('form','url');
    //$this->load->library('form_validation');
    $this->load->model('restss');
    }
    public function index() {
            
           $data['all']=$this->restss->showAll();
            
           // die('dhjdusjdi');
            
            $this->template->build('rests/index',$data); 
                   }
	public function getobjdata() {
            //$data=array();
           $data['all']=$this->restss->showAll();
            
          // echo "<pre>";print_r( $data['all']);die('dhjdusjdi');
            
          $this->template->build('rests/asdc',$data);
        
        
           }

}