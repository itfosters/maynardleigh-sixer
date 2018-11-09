<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class Admin extends ITFS_Controller {
	public function index() {
		$data["status"] = "error";
		$data["message"] = "Please upload the image";

	    if (isset($_FILES["imagedata"]["name"]) and !empty($_FILES["imagedata"]["name"])) {
	       
	        $config['upload_path'] = PUBLIC_PATH . "uploadimage/";
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        $config['max_size'] = '20000000';
	        $config['max_width'] = '2024';
	        $config['max_height'] = '2024';
	        $this->load->library('upload');
	        $this->upload->initialize($config);
	        $result = $this->upload->do_upload('imagedata');

	        if ($result >= 1) {	            
	            $imageinfo = $this->upload->data();
	            chmod($imageinfo["full_path"], 0777);
	            $filedata = file_get_contents($imageinfo["full_path"]);
				$data["img"]='data:image/' . $imageinfo["image_type"] . ';base64,' . base64_encode($filedata);
	            $data["imagename"] = $imageinfo["file_name"];
	            $data["status"] = "success";
	            $data["message"] = "succesfully upload file";
	            
	        } else {
	            $data["status"] = "error";
	            $data["message"] = $this->upload->display_errors();
	        }
	    }
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
