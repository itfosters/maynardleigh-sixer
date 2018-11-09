<?php

class ITFS_Controller extends MX_Controller {



        public function _remap($method, $args) {

                // Call before action

					$this->before();

					call_user_func_array(array($this, $method), $args);

                	$this->after();

               

        }



        protected function before() {



			$admin_prefix = $this->uri->segment(1);						



			if($this->auth) {

				$this->auth->username = "email";

				$this->auth->loginurl = "admin/user/index";

			}

			

			$this->paginationformat = $this->config->item("pagination");

			$this->load->model("siteconfig/siteconfiguration","siteconfiguration");	

			$this->load->helper("html");	

			$siteinformation = $this->siteconfiguration->getSiteConfig();

			$this->template->set("siteinformation",single_array($siteinformation,"field_code","field_value"));



			if($admin_prefix === "admin") 

			{

				if($this->auth->isLoggedIn() and $this->auth->getUserType()=="A") {

					$this->template->set("loginuserinfo",array("LOGEDDATA"=>$this->users->getUsersById($this->auth->getUserId())));

					$this->template->set_layout("admin");	

				}

				else

					redirect("user/login");

			} 			

			return; 

		}



		/** 

		*	After action execute

		**/

        protected function after() {  return; }        

}




//public controller
class ITFS_Public_Controller extends MX_Controller{




		public $publi_url=array(

								"user/login"=>"user/login",

								"user/user_login"=>"user/user_login"

								);



        public function _remap($method, $args) {

					$this->before();

					call_user_func_array(array($this, $method), $args);

                	$this->after();

               

        }

        

        protected function before() {



				$this->paginationformat = $this->config->item("pagination");		

				$urlstring = $this->router->fetch_class()."/".$this->router->fetch_method();



				
				

				

				

				$this->load->model("siteconfig/siteconfiguration","siteconfiguration");	

				$this->load->helper("html");	

				$siteinformation = $this->siteconfiguration->getSiteConfig();

				$this->template->set("siteinformation",single_array($siteinformation,"field_code","field_value"));
			


				//Meta Tag Addeing 				

				if($urlstring!="page/index")

				{				

					$itf_args = $this->uri->segment(3);

					$metainfo = $this->metatags->getMetaTagInfo($urlstring);

					if(!isset($metainfo->title) and !empty($itf_args))

					{					

						

						$metainfo = $this->metatags->getMetaTagInfo($urlstring."/".$itf_args);					

					}

					

					if(isset($metainfo->title) and !empty($metainfo->title))

					{

						$this->template->title($metainfo->title);

						

						if(!empty($metainfo->metakeywords))

							$this->template->set_metadata("keyword",$metainfo->metakeywords);

						

						if(!empty($metainfo->metadiscryption))

							$this->template->set_metadata("description",$metainfo->metadiscryption);

					}

				}

				//Meta Tag Adding End 			

			return; 

		}



		/** 

		*	After action execute

		**/

        protected function after() {  return; }        


}


//Front Base Class



class ITFS_Front_Controller extends MX_Controller {



		public $publi_url=array(

								"user/login"=>"user/login",
								"user/user_login"=>"user/user_login",
								"user/resource_login"=>"user/resource_login"

								);



        public function _remap($method, $args) {

					$this->before();

					call_user_func_array(array($this, $method), $args);

                	$this->after();

               

        }

        

        protected function before() {



				$this->paginationformat = $this->config->item("pagination");		

				$urlstring = $this->router->fetch_class()."/".$this->router->fetch_method();



				if($this->auth) {

					$this->auth->username = "email";

					$this->auth->loginurl = "user/index";

				}

				

				if(!isset($this->publi_url[$urlstring]) and !$this->auth->isLoggedIn()){
                                        //if(strstr('resouces_form', $leadershipreport)){
                                        //echo "<pre>1234567";print_r($_SERVER);die;
                                        $leadershipreport = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                                        if(strpos($leadershipreport,'resouces_form' )>0){
                                            //$this->session->set_userdata('resouceurl', $leadershipreport); 
                                            $this->session->set_userdata(array('resouceurl'=>$leadershipreport)); 
                                            redirect("user/resource_login");
                                        }else{
                                            redirect("user/user_login");
                                        }
                                }        
				

				

				$this->load->model("siteconfig/siteconfiguration","siteconfiguration");	

				$this->load->helper("html");	

				$siteinformation = $this->siteconfiguration->getSiteConfig();

				$this->template->set("siteinformation",single_array($siteinformation,"field_code","field_value"));

								

				if($this->auth->isLoggedIn())

				{						

					$this->load->model("user/users","users");				

					$this->template->set("loginuserinfo",array("LOGEDDATA"=>$this->users->getUsersById($this->auth->getUserId())));

				} 

			

				



				//Meta Tag Addeing 				

				if($urlstring!="page/index")

				{				

					$itf_args = $this->uri->segment(3);

					$metainfo = $this->metatags->getMetaTagInfo($urlstring);

					if(!isset($metainfo->title) and !empty($itf_args))

					{					

						

						$metainfo = $this->metatags->getMetaTagInfo($urlstring."/".$itf_args);					

					}

					

					if(isset($metainfo->title) and !empty($metainfo->title))

					{

						$this->template->title($metainfo->title);

						

						if(!empty($metainfo->metakeywords))

							$this->template->set_metadata("keyword",$metainfo->metakeywords);

						

						if(!empty($metainfo->metadiscryption))

							$this->template->set_metadata("description",$metainfo->metadiscryption);

					}

				}

				//Meta Tag Adding End 			

			return; 

		}



		/** 

		*	After action execute

		**/

        protected function after() {  return; }        

}





