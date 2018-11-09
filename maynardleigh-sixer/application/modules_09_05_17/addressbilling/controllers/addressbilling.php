<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');



class Addressbilling extends ITFS_Front_Controller {



    public function __construct() 
    {
    $this->load->helper('form','url');
    $this->load->library('form_validation');
    $this->load->model('addressbillings');
    }
    public function index() {
            
            $data['all']=$this->addressbillings->showAll();
            //echo "<pre>";print_r($data);die;
            $this->template->build('show_view',$data);
        
        
           }
   public function insert($id='')
    {   
        if($this->input->post())
        {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Companyname', 'required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('address', 'Address', 'required|min_length[0]|max_length[100]');
        $this->form_validation->set_rules('contact_No', 'Contact No.', 'required|regex_match[/^[0-9]{10}$/]');
        

            if ($this->form_validation->run() == false) {
                //$this->load->view('new_client');
                } 
                else 
                {
                if(!empty($id)){
                  $datas = $this->input->post();
                  // array(
                  //       'name' => $this->input->post('name'),
                  //       'address' => $this->input->post('address'),
                  //       'contact_No' => $this->input->post('contact_No')
                  //           );
                  $where = array('id' => $id );
                 $this->clients->updateClient($datas,$where);
                 redirect('client');

                    }else{
                    $datas = array(
                        'name' => $this->input->post('name'),
                        'address' => $this->input->post('address'),
                        'contact_No' => $this->input->post('contact_No')
                        
                            );
                    //echo "<pre>";print_r($data);die;
                $this->clients->addClient($datas);
                redirect('client');
                 }
            
            //echo "<pre>";print_r($up);die;
        }
    }
        $data=array();
        $data['frm_data']['view']=$this->clients->up_data($id);
    //echo "<pre>";print_r($r);die;
        //$this->template->build('header');
        $this->template->build('add_client',$data);   
}

    
    public  function delete($id='')
    {
            //$del=$this->input->post();
            $this->clients->deletedata($id);
            //echo "<pre>";print_r($del);die;
        // $deldata['frm_data']['view']=$this->clients->up_data($id);
        //echo "<pre>";print_r($deldata);die;
        //$this->template->build('del_client',$deldata);
        redirect('client');
    }
 

}