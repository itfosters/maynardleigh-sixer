<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class ITFS_ImageMove {
	protected $itf;
	protected $file_ext;
	protected $new_filename;
	protected $client_name;
	protected $old_image_path;
	protected $source_path_name;
	
	function __construct($params = array()) {
		$this->itf = & get_instance();
	}
	
	public function clean_file_name($filename)
	{
		$bad = array(
						"<!--",
						"-->",
						"'",
						"<",
						">",
						'"',
						'&',
						'$',
						'=',
						';',
						'?',
						'/',
						"%20",
						"%22",
						"%3c",		// <
						"%253c",	// <
						"%3e",		// >
						"%0e",		// >
						"%28",		// (
						"%29",		// )
						"%2528",	// (
						"%26",		// &
						"%24",		// $
						"%3f",		// ?
						"%3b",		// ;
						"%3d"		// =
					);

		$filename = str_replace($bad, '', $filename);

		return stripslashes($filename);
	}

	public function get_extension($filename)
	{
		$x = explode('.', $filename);
		return '.'.end($x);
	}

	public function set_filename($path="", $filename="")
	{
		
		if ( ! file_exists($path.$filename))
			return $filename;
		
		

		$filename = str_replace($this->file_ext, '', $filename);
		$filename = preg_replace("/\s+/", "_", $filename);

		$new_filename = '';
		for ($i = 1; $i < 100; $i++)
		{
			if ( ! file_exists($path.$filename.$i.$this->file_ext))
			{
				$new_filename = $filename.$i.$this->file_ext;
				break;
			}
		}

		if ($new_filename == '')			
			return FALSE;
		else
			return $new_filename;
	}

	
	function move($sourcename="",$destination="",$oldimagepath="")
	{
		
		if(!file_exists($sourcename))
			return false;
		$this->source_path_name = $sourcename;
		$this->file_ext = $this->get_extension($sourcename);
		$this->old_image_path = $oldimagepath;

		$path_name = dirname($sourcename)."/";
		$image_name = basename($sourcename);
		$this->client_name = $image_name;

		$image_name = $this->clean_file_name($image_name);
		$this->new_filename = $this->set_filename($path_name,$image_name);
		chmod($sourcename,"0777");
		if(copy($sourcename,$destination.$this->new_filename))
			return true;
		else
			return false;
	}

	function remove($old_image_path,$source=false)
	{
		@unlink($old_image_path);
		if($source)
			@unlink($this->source_path_name);
	}

	function getFileName()
	{
		return $this->new_filename;
	}	
}  