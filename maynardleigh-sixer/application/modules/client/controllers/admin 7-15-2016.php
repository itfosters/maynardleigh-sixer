<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin extends ITFS_Controller {



	

	public function index()

	{

		

		$this->load->library("pagination");

		$this->load->model("clients");			

		//Filter Data

		$conditions = array();

		if(isset($_POST["q"])) {

			$this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));

		} 

		$searchfield = $this->session->userdata("SEARCHFIELD");

		

		if(count($searchfield)>0)

		$data["frm_data"] = $searchfield;

		

		if(isset($searchfield["q"]) and !empty($searchfield["q"]))

			$conditions["like"] = array("name"=>$searchfield["q"]);

		// End of Filter Data

		

		$totalpage = $this->clients->totalData($conditions);

		$config = $this->paginationformat["back_page"];

		$config["base_url"] = base_url()."admin/user/index";

		$config["total_rows"] = $totalpage;

		$config["per_page"] = $this->config->item("admin_perpage");

		$config["uri_segment"] = 4;

		$this->pagination->initialize($config);

		

		$current_page = ($this->uri->segment($config["uri_segment"]))?$this->uri->segment($config["uri_segment"]):0;

		$data["results"] = $this->clients->findUser($conditions,$config["per_page"], $current_page);

		$data["links"] = $this->pagination->create_links();

		

		$this->template->headingtitle="User";

		$this->template->set_breadcrumb("User","");



		$this->template->build('admin_index',$data);

			

	}

	

	public function employee()

	{

		

		$this->load->library("pagination");

		$this->load->model("clients");

		

		//Filter Data

		$conditions = array();

		if(isset($_POST["q"])) {

			$this->session->set_userdata(array("SEARCHFIELD"=>$this->input->post()));

		} 

		$searchfield = $this->session->userdata("SEARCHFIELD");

		

		if(count($searchfield)>0)

		$data["frm_data"] = $searchfield;

		

		if(isset($searchfield["q"]) and !empty($searchfield["q"]))

			$conditions["like"] = array("name"=>$searchfield["q"]);



		$conditions["where"] = array("user_type"=>"N");

		// End of Filter Data

		

		$totalpage = $this->clients->totalData($conditions);

		$config = $this->paginationformat["back_page"];

		$config["base_url"] = base_url()."admin/user/employee";

		$config["total_rows"] = $totalpage;

		$config["per_page"] = $this->config->item("admin_perpage");

		$config["uri_segment"] = 4;

		$this->pagination->initialize($config);

		

		$current_page = ($this->uri->segment($config["uri_segment"]))?$this->uri->segment($config["uri_segment"]):0;

		$data["results"] = $this->clients->find($conditions,$config["per_page"], $current_page);

		$data["links"] = $this->pagination->create_links();

		

		$this->template->headingtitle="Employee";

		$this->template->set_breadcrumb("Employee","");



		$this->template->build('admin_employee',$data);

			

	}



	public function detail($id='')

	{

		$this->load->model("clients");

		$this->load->library('form_validation');

		$this->load->model("user/contact_detail");

		$this->load->model("user/personal_detail");

		$this->load->model("user/job_detail");

		$this->load->model("job_type/job_types");

		$this->load->model("job_category/job_categorys");

		$this->load->model("location/locations");

		

					

		if(count($_POST)>0) {

			

			//Validation rule	

			$this->form_validation->set_rules('name', 'first name', 'required')

				->set_rules('email', 'email id', 'required|valid_email|is_unique[users.email.'.$this->input->post("id").']');

			

			//form validate

			if($this->form_validation->run() == FALSE) {

			

			$data["frm_data"]["frm_data"] = (object)$this->input->post();

			}else{

				$data= $this->input->post();

				unset($data["id"]);

				

				

				$user_conact_id=isset($data["conact_id"])?$data["conact_id"]:"";

				$user_personal_id=isset($data["personal_id"])?$data["personal_id"]:"";

				$user_job_id=isset($data["job_id"])?$data["job_id"]:"";

				

				$contact_info=array(

					"address1"=>$data["address1"],

					"address2"=>$data["address2"],

					"city"=>$data["city"],

					"state"=>$data["state"],

					"zipcode"=>$data["zipcode"],

					"country"=>$data["country"],

					"home_phone"=>$data["home_phone"],

					"mobile"=>$data["mobile"],

					"work_email"=>$data["work_email"],

					"other_email"=>$data["other_email"]

				);

				

				$personal_info=array(

					"licence_number"=>$data["licence_number"],

					"licence_expire"=>$data["licence_expire"],

					"gender"=>$data["gender"],

					"marital_status"=>$data["marital_status"],

					"nationality"=>$data["nationality"],

					"dob"=>$data["dob"]

				);



				$job_info=array(

					"job_type_id"=>$data["job_type_id"],

					"salary"=>$data["salary"],

					"emp_status"=>$data["emp_status"],

					"job_category_id"=>$data["job_category_id"],

					"join_date"=>$data["join_date"],

					"location_id"=>$data["location_id"],

					"contract_start_date"=>$data["contract_start_date"],

					"contract_end_date"=>$data["contract_end_date"],

					"contract_detail"=>$data["contract_detail"]

				);



				

				

				if(!empty($id)) {

					$this->clients->updateUser($data,array("id"=>$id));

					$contact_info["user_id"]=$id;

					$personal_info["user_id"]=$id;

					$job_info["user_id"]=$id;

					

					

					if(!empty($user_conact_id))

						$this->contact_detail->update($contact_info,array("id"=>$user_conact_id));

					else

						$this->contact_detail->save($contact_info);

						

					if(!empty($user_personal_id))

						$this->personal_detail->update($personal_info,array("id"=>$user_personal_id));

					else

						$this->personal_detail->save($personal_info);

					

					if(!empty($user_job_id))

						$this->job_detail->update($job_info,array("id"=>$user_job_id));

					else

						$this->job_detail->save($job_info);



					

					$this->messages->flash("Employee have been succesfully updated.","success");

					

				} else {

					$userid =$this->clients->register($data);

					$contact_info["user_id"]=$userid;

					$personal_info["user_id"]=$userid;

					$job_info["user_id"]=$userid;



					$this->contact_detail->save($contact_info);

					$this->personal_detail->save($personal_info);

					$this->job_detail->save($job_info);

					

					$this->messages->flash("Employee have been succesfully saved.","success");

				}

				

				redirect(array("admin","user","employee"));

			}

		

		

		}elseif(!empty($id)) {

			$data["frm_data"]["frm_data"] = $this->clients->getclientsInfoById($id);

		}



		$data["job_type_list"]= single_array($this->job_types->findAll(),"id","name");

		$data["job_category_list"]= single_array($this->job_categorys->findAll(),"id","name");

		$data["location_list"]= single_array($this->locations->findAll(),"id","name");





		$this->template->add_js("assests/admin/js/bootstrap-select.min.js","B");

		$this->template->add_css("assests/admin/css/bootstrap-select.min.css","B");



		$this->template->headingtitle="Employee";

		$this->template->set_breadcrumb("Employee",site_url("admin/user/employee"));

		$this->template->set_breadcrumb("Employee Information","");



		$this->template->build('admin_detail', $data);

	}



		

	public function logout()

	{

		$this->auth->logout();

		$this->messages->flash("You have successfully logged out.","success");

		redirect(array(""));

	}

	

	public function delete()

	{

		

		if($this->input->post("itfaction") == "delete") {			

			$allids = $this->input->post("itfrowdata");

			$delds = array();

                        $this->load->model("user/users");

            			

			$this->clients->deleteMulti($allids);

			$this->messages->flash("clients have been succesfully deleted.","success");

			redirect(array("admin","user","index"));

		}

		elseif($this->input->post("itfaction") == "publish") {

			$allids = $this->input->post("itfrowdata");

			$this->load->model("user/clients");

			$this->clients->statusupdate($allids,"1");

			$this->messages->flash("clients have been succesfully publish.","success");

			redirect(array("admin","user","index"));		

		}

		elseif($this->input->post("itfaction") == "unpublish") {

			$allids = $this->input->post("itfrowdata");

			$this->load->model("user/users");

			$this->clients->statusupdate($allids,"0");

			$this->messages->flash("User have been succesfully Unpublish.","success");

			redirect(array("admin","user","index"));		

		}else{

			$this->messages->flash("Invalid information.","error");

			redirect(array("admin","user","index"));		

		}

				

	}

	

	public function form($id='')

	{

		$this->load->model("clients");

		$this->load->library('form_validation');

		

		if(count($_POST)>0) {

			

			//Validation rule	

			$this->form_validation->set_rules('name', 'first name', 'required')

				->set_rules('email', 'email id', 'required|valid_email|is_unique[users.email.'.$this->input->post("id").']')

				->set_rules('password', 'password', 'matches[cpassword]');

			

			//form validate

			if($this->form_validation->run() == FALSE) {

			

			$data["frm_data"]["frm_data"] = (object)$this->input->post();

			}else{

				$data=$this->input->post();

				

				unset($data["id"]);

				

				if(!empty($id)) {

					$this->clients->updateUser($data,array("id"=>$id));

					$this->messages->flash("User have been succesfully updated.","success");

				} else {

					$this->clients->register($data);

					$this->messages->flash("User have been succesfully saved.","success");

				}

				

				redirect(array("admin","user"));

			}

		

		

		}elseif(!empty($id)) {

			$data["frm_data"]["frm_data"] = $this->clients->getUsersById($id);

		}





		$this->template->headingtitle="User";

		$this->template->set_breadcrumb("User",site_url("admin/user"));

		$this->template->set_breadcrumb("User Information","");



		$data["user_type"] = $this->config->item('user_type');

                $this->template->build('admin_user_form', $data);

	}

	

	public function status()

	{

            if($this->input->post("itfaction") == "status") 

                {

                    $this->load->model("clients");

                    $recid = $this->input->post("recid");

                    $res = $this->clients->statuchange($recid);

                    echo json_encode(array("status"=>$res));

               }

	}



	public function profile()

	{

	

		$this->load->model("clients");

		$this->load->library('form_validation');

		

		$userid = $this->auth->getUserId();

		

		if(count($_POST)>0){

			$this->form_validation->set_rules('name', 'first name', 'required')

						->set_rules('email', 'email id', 'required|valid_email|is_unique[users.email.'.$userid.']')

						->set_rules('username', 'user name', 'required|is_unique[users.username.'.$userid.']');

			

			if($this->form_validation->run() == FALSE) {

					$data["frm_data"] = (object)$this->input->post();

			}else{

				$alldata = $this->input->post();

				$data=array(

					"name"=>$alldata["name"],

					"last_name"=>$alldata["last_name"],

					"username"=>$alldata["username"],

					"email"=>$alldata["email"]

				);

				$this->clients->updateUser($data , array("id"=>$userid));

				$this->messages->flash("Profile have been succesfully updated.","success");

				redirect(array("admin","user","profile"));			

			}	

		}

		else

		{

			$userinfo = $this->clients->getUsersById($userid);

			$data["frm_data"]=$userinfo;

		}

		$this->template->headingtitle="Profile";

		$this->template->set_breadcrumb("Profile Information","");

		$this->template->build('admin_profile',array("frm_data"=>$data));

	

	}



	public function profile_image()

	{

	

		$this->load->model("clients");

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

					$this->clients->updateUser($data , array("id"=>$userid));

					$this->messages->flash("Profile image been succesfully updated.","success");

					redirect(array("admin","user","profile_image"));			

				}else{



					$this->messages->flash(isset($data["error_msg"])?$data["error_msg"]:"Profile image uploading failed.","error");

				}

				

			}	

		}



		$this->template->headingtitle="Profile Image";

		$this->template->set_breadcrumb("Profile Image","");

		$this->template->build('admin_profile_image');

	

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

			$imageinfo = $this->clients->getUsersById($ids);

			@unlink(PUBLIC_PATH."profile/".$imageinfo->profile_image);

	}





	//Change Password

    public function change_password() {



        $this->load->library('form_validation');



        $data = array();

        if ($this->input->post()) {

            $userid = $this->auth->getUserId();

            $this->load->model('clients');

            $this->form_validation->set_rules('opassword', 'Old Password', 'required|trim|xss_clean|callback_change')

            ->set_rules('npassword', 'New Password', 'required|trim')

            ->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[npassword]');

            if ($this->form_validation->run() == FALSE) {

                $data["frm_data"]["frm_data"] = (object) $this->input->post();

            } else {



                $Oldpassword = $this->input->post('opassword');

                $Newpassword = $this->input->post('npassword');

                $userinfo =$this->clients->getUsersById($userid);

                if(isset($userinfo->id) and ($userinfo->password==md5($Oldpassword)))

                {

                    $this->clients->updateUser(array("password"=>$Newpassword),array("id"=>$userid));

                    $this->messages->flash("Password have been succesfully change.", "success");

                    redirect('admin');



                }else{

                    $this->messages->flash("Old Password not matched.", "error");

                }                

            }

        }

        $this->template->headingtitle="Change Password";

        $this->template->set_breadcrumb("Change Password","");

        $this->template->build('admin_change_password', $data);

    }

}