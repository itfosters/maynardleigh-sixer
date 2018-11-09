<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends ITFS_Controller {

    public function __construct() {
        $this->load->helper('form', 'url');
        $this->load->library(array('form_validation', 'pagination'));
        $this->load->model('clients');
    }

    public function index() {
        //Filter Data

        $conditions = array();

        if (isset($_POST["q"])) {
            $this->session->set_userdata(array("CLIENTSEARCHFIELD" => $this->input->post()));
        }

        $searchfield = $this->session->userdata("CLIENTSEARCHFIELD");
        if (count($searchfield) > 0)
            $data["frm_data"] = $searchfield;


        $conditions["where"] = array("user_type" => 'C');
        if (isset($searchfield["q"]) and ! empty($searchfield["q"])) {
            $conditions["like"] = array("name" => $searchfield["q"], "email" => $searchfield["q"]);
        }

        // End of Filter Data
        $config = $this->paginationformat["back_page"];
        $config['base_url'] = base_url('admin/client/index');
        $config['total_rows'] = $this->users->totalData($conditions);
        $config['per_page'] = 10;
        $config["uri_segment"] = 4;
        //echo "<pre>";print_r($config);die;
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        //echo "<pre>";print_r($page);die;
        $data['all'] = $this->users->findUser($conditions, $config["per_page"], $page);
        $data['link'] = $this->pagination->create_links();
        //echo "<pre>";print_r($data);die;


        $this->template->headingtitle = "Client Listing";
        //$this->template->set_breadcrumb("Add Client",site_url("admin/client/form"));
        $this->template->set_breadcrumb("Client Listing", "");
        $this->template->build('admin_index', $data);
    }

    public function form($id = '') {
        $data = array();
        if ($this->input->post()) {
            $allData = $this->input->post();
            //echo "<pre>";print_r($allData);die;
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if (empty($id))
            $this->form_validation->set_rules('name', 'Client Name', 'required|is_unique[users.name]');
            $this->form_validation->set_rules('street', 'Street', 'required');
            $this->form_validation->set_rules('location', 'Location', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('pincode', 'Pin-Code', 'required');
            if (empty($id))
                $this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('contact_no', 'Contact No.', 'required');


            if ($this->form_validation->run() == false) {
                $data['frm_data']['view'] = (object) $this->input->post();
            } else {
                $status = true;
                if (!empty($id)) {
                    $datas = $this->input->post();
                    $where = array('id' => $id);
                    //echo "<pre>1234";print_r($datas);die;
                    $updata = $this->clients->updateClient($datas, $where);
                    if ($updata == 1) {
                        
                        //delete billing address
                        $this->clients->deleteBillingAddress($id);
                        if(isset($allData['bstreet'])){
                            foreach ($allData['bstreet'] as $bkey => $bvalue) {
                                if(empty($allData['bstreet'][$bkey]))
                                    continue;
                                $billingaddress[$bkey]['client_id'] = $id;
                                $billingaddress[$bkey]['street'] = $allData['bstreet'][$bkey];
                                $billingaddress[$bkey]['location'] = $allData['blocation'][$bkey];
                                $billingaddress[$bkey]['state'] = $allData['bstate'][$bkey];
                                $billingaddress[$bkey]['country'] = $allData['bcountry'][$bkey];
                                $billingaddress[$bkey]['city'] = $allData['bcity'][$bkey];
                                $billingaddress[$bkey]['pincode'] = $allData['bpincode'][$bkey];
                                $billingaddress[$bkey]['gstinno'] = $allData['bgstinno'][$bkey];
                            }
                            $this->clients->addBillingAddress($billingaddress);
                        }
                        
                        
                        $this->messages->flash('Client has been updated successfully');
                    }
                    redirect('admin/client/index');
                } else {
                    $datas = array(
                        'name' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'street' => $this->input->post('street'),
                        'location' => $this->input->post('location'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                        'pincode' => $this->input->post('pincode'),
                        'contact_no' => $this->input->post('contact_no'),
                        'uinno' => $this->input->post('uinno'),
                        'panno' => $this->input->post('panno'),
                        'username' => $this->input->post('email'),
                        'password' => md5(12345),
                        'user_type' => 'C',
                        'cgstinno' => $this->input->post('cgstinno'),
                        'samebillingaddress' => $this->input->post('samebillingaddress')
                    );
                    //echo "<pre>";print_r($datas);die;
                    $insertedid = $this->clients->addClient($datas);
                    //if ($insert == 1){
                    if ($insertedid >0){
                        $billingaddress = array();
                        //echo "<pre>";print_r($insertedid);echo "<hr>";
                        //echo "<pre>";print_r($allData['bstreet']);die;
                        //saving billing address
                        if(isset($allData['bstreet'])){
                            foreach ($allData['bstreet'] as $bkey => $bvalue) {
                                if(empty($allData['bstreet'][$bkey]))
                                    continue;
                                $billingaddress[$bkey]['client_id'] = $insertedid;
                                $billingaddress[$bkey]['street'] = $allData['bstreet'][$bkey];
                                $billingaddress[$bkey]['location'] = $allData['blocation'][$bkey];
                                $billingaddress[$bkey]['state'] = $allData['bstate'][$bkey];
                                $billingaddress[$bkey]['country'] = $allData['bcountry'][$bkey];
                                $billingaddress[$bkey]['city'] = $allData['bcity'][$bkey];
                                $billingaddress[$bkey]['pincode'] = $allData['bpincode'][$bkey];
                                $billingaddress[$bkey]['gstinno'] = $allData['bgstinno'][$bkey];
                            }
                            $this->clients->addBillingAddress($billingaddress);
                        }
                    }
                        $this->messages->flash("Client has been saved successfully");
                    redirect('admin/client/index');
                }
            }
        }
        else {
            $data['frm_data']['view'] = $this->clients->getId($id);
            //echo "<pre>";print_r($data);die;
            $data['frm_data']['billing'] = $this->clients->getBillingAddress($id);
        }

        $this->template->headingtitle = "Add Client";
        $this->template->set_breadcrumb("Client Listing", site_url("admin/client/index"));
        $this->template->set_breadcrumb("Add Client", "");
        //echo "<pre>";print_r($data);die;
        $this->template->build('admin_user_form', $data);
    }

    public function deleted($id = '') {
        if ($this->input->post("itfaction") == "delete") {
            $allids = $this->input->post("itfrowdata");

            $delete = $this->clients->deleteMulti($allids);
            if ($delete == 1)
                $this->messages->flash("Selected clients has been removed successfully");
        }else {
            $delete = $this->clients->deleteMulti($id);
            if ($delete == 1)
                $this->messages->flash("client has beenremoved successfully");
        }

        redirect('admin/client');
    }

}