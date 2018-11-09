<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');
class Diagnose extends ITFS_Front_Controller {



    public function __construct() 
    {
    $this->load->helper('form','url','html');
    $this->load->library('form_validation');
    $this->load->model("diagnoses");

    }
    public function index() {
            
            
        		
           }

	 
}