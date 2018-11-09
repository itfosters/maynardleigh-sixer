<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class Contract extends ITFS_Front_Controller 
{



    public function __construct() 
    {
        $this->load->helper('form','url');
        $this->load->library(array('form_validation','pagination'));
        $this->load->model('contracts');
		$this->load->model('order/orders');
		$this->load->model('diagnose/diagnoses');
		$this->load->model('design/designs');
		$this->load->model('delivery/deliveries');
		$this->load->model('discovery/discoveries');
		$this->load->model('product/products');
    }
    public function index($orderid="") 
    {
            //die('vghujh');
            $all=$this->contracts->showAllRows();
           	
			
			$data['detail']=$this->orders->getOrderDetail(array("O.id"=>$orderid));
			$data['diagonoesdetail']=$this->diagnoses->getDiagonoesDetail($orderid);
			$data['getdesigndetail']=$this->designs->getdesignDetail($orderid);
			$data['getdeliverydetail']=$this->deliveries->getdeliveryDetail($orderid);
			$data['getdiscoveryDetail']=$this->discoveries->getdiscoveryDetail($orderid);
			$data['get_diagnose']=$this->contracts->get_diagnose($orderid="");
			$data['get_design']=$this->contracts->get_design($orderid='');
			$data['get_delivey']=$this->contracts->get_delivey($orderid='');
			$data['get_discovery']=$this->contracts->get_discovery($orderid='');
            //echo "<pre>zcyughyuuihyse"; print_r($data); die();
			$this->template->set_layout('contract_layout');
			$this->template->build('show_contract', array("frmdata"=>$data));
			
    }
}