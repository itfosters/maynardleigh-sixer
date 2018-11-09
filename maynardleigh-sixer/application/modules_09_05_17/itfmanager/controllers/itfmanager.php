<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itfmanager extends ITFS_Controller {

	public function index()
	{
		$this->load->view("itfmanager/filemanager");
		$message =  array();
		if(isset($_FILES["upload"]["name"]) and !empty($_FILES["upload"]["name"]))
		{
			
			$config['upload_path'] = PUBLIC_PATH . "datas/";
           $config['allowed_types'] = 'gif|jpg|png|doc|docx|pdf|jpeg|txt|xls|xlsx';
            $config['max_size'] = '20000000';
       

           	$this->load->library('upload');
            
            $this->upload->initialize($config);
            $result = $this->upload->do_upload('upload');
            if ($result >= 1) {
                $imageinfo = $this->upload->data();
               	$imageinfo["file_name"];
               	$message["success"]="Success full uploaded";
                
            } else {
                $message["success"]="Uploading Failed";
            }
			//print_r($_FILES["upload"]); die;	
		}
		//echo json_encode($message);
		
	}
	
	public function filemanager($action="")
	{
		$this->load->helper('directory');
		$this->load->helper('number');
		$this->load->library('watermark');
		

		if($action=="files") {
		
			$dirname = (isset($_REQUEST["directory"]) and !empty($_REQUEST["directory"]))?$_REQUEST["directory"]."/":"";
			$public_path = PUBLIC_PATH."datas/".$dirname;


			$res= array();			
			$alldir = directory_map($public_path);

			if(is_array($alldir))
			foreach($alldir as $dirnames=>$filelist)
			{		

				if(is_dir($public_path.$dirnames)){}
				elseif(file_exists($public_path.$filelist))
				{
					//echo $public_path.$dirnames;
					$filesize = filesize($public_path.$filelist);
					$res[] = array("filename"=>$filelist,"file"=>$dirname.$filelist,"size"=>byte_format($filesize));
				}
			}

			echo json_encode($res);
		
		} elseif($action=="image") {
		
			$imagename = isset($_REQUEST["image"])?$_REQUEST["image"]:"";

			if(!file_exists(PUBLIC_PATH."cache/".$imagename))
			{
				$originfilename = PUBLIC_PATH.$imagename;				
				$this->watermark->load($originfilename);
				$this->watermark->resizeImage(50,50);
				$this->watermark->saveImage(PUBLIC_PATH."cache/".$imagename);
			}
			echo PUBLIC_ULR."cache"."/".$imagename;
			//echo "http://localhost/opencart/image/cache/data/cart-100x100.png";		
		} elseif($action=="directory") {
								
			$dirname = (isset($_REQUEST["directory"]) and !empty($_REQUEST["directory"]))?$_REQUEST["directory"]."/":"";
			$public_path = PUBLIC_PATH."datas/".$dirname;
			$resdata= array();			
			$alldir = directory_map($public_path);
			
			foreach($alldir as $dirnames=>$filelist)
			{				
				if(is_dir($public_path.$dirnames))
				{					
					$resdata[] = array("data"=>$dirnames,"attributes"=>array("directory"=>$dirname.$dirnames));
				}
			}
			echo json_encode($resdata);

		} elseif($action=="create") {
								
			$dirname = (isset($_REQUEST["directory"]) and !empty($_REQUEST["directory"]))?$_REQUEST["directory"]."/":"";
			$name = (isset($_REQUEST["name"]) and !empty($_REQUEST["name"]))?$_REQUEST["name"]:"";
			$dirname=$dirname.$name;
			
			$public_path = PUBLIC_PATH."datas/".$dirname;
			mkdir($public_path,DIR_READ_MODE,TRUE);
			chmod($public_path,DIR_READ_MODE);
			$resdata["success"]="Folder has been created";
			//$resdata["error"]="File has not exists";
			echo json_encode($resdata);

		} elseif($action=="delete") {
			$resdata=array();										
			$filename =(isset($_REQUEST["path"]) and !empty($_REQUEST["path"]))?$_REQUEST["path"]:""; 
			$file_path = PUBLIC_PATH."datas/".$filename;			
			if(file_exists($file_path)){
				unlink($file_path);
				$resdata["success"]="File has been deleted";
			}else{
				$resdata["error"]="File has not exists";
			}

			echo json_encode($resdata);

		}elseif($action=="upload") {

			$resdata=array();
			if(isset($_FILES["image"]["name"]) and !empty($_FILES["image"]["name"]))
			{				
				$dirname = (isset($_REQUEST["directory"]) and !empty($_REQUEST["directory"]))?$_REQUEST["directory"]."/":"";

				$config['upload_path'] = PUBLIC_PATH .$dirname."datas/";
	           $config['allowed_types'] = 'gif|jpg|png|doc|docx|pdf|jpeg|txt|xls|xlsx';
	            $config['max_size'] = '20000000';	       

	           	$this->load->library('upload');
	            
	            $this->upload->initialize($config);
	            $result = $this->upload->do_upload('image');
	            if ($result >= 1) {
	                $imageinfo = $this->upload->data();
	               	$imageinfo["file_name"];
	               	$resdata["success"]="Success full uploaded";	                
	            } else {
	                $resdata["error"]="Uploading Failed";
	            }				
			}

			echo json_encode($resdata);

		}
	}

	private function checkFolder($folderpath="")
	{
		$alldir = directory_map($folderpath);

		$isdir = false;
		foreach($alldir as $fdname=>$filelist)
		{			
			
			if(is_dir($folderpath."/".$fdname))
			{
				$isdir=true;
				break;
			}
		}

		return $isdir;
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */