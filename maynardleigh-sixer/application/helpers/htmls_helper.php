<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Array Convert
 *
 * Determines what the form validation class was instantiated as, fetches
 * the object and returns it.
 *
 * @access	private
 * @return	mixed
 */
if ( ! function_exists('single_array'))
{
	function single_array($arraydata=array(),$keys="",$itfval="",$first_string="")
	{
			 
		//echo "@@@!!<pre>";print_r($arraydata);die;
		$results=array();
		if(!empty($first_string))
			$results[]=$first_string;

		foreach($arraydata as $itfv) {
			$itfv=is_object($itfv)?(array)$itfv:$itfv;
			if(isset($itfv[$keys]))
				$results[$itfv[$keys]]=isset($itfv[$itfval])?$itfv[$itfval]:"";
		}
		
		return $results;
	}
}


/* End of file form_helper.php */
/* Location: ./system/helpers/form_helper.php */
