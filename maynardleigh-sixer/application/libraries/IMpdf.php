<?php
	include_once APPPATH.'/third_party/mpdf/mpdf.php';
	class IMpdf
	{

		private $ci;
		public $param;
    	public $mpdf;

		public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
		{
			$this->ci =& get_instance();
			$this->param =$param;
			$this->mpdf = new mPDF($this->param);
		}


		
	}