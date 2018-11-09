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
if ( ! function_exists('word_limiter'))
{
	function word_limiter($str, $limit = 100, $end_char = '&#8230;')
	{
		
		if (trim($str) == '')
		{
			return $str;
		}

		$matches = preg_replace('/(?:<|)\/?([a-zA-Z]+) *[^<\/]*?(?:>)/', '',$str);
		$matches = explode(" ",$matches);
		$matchess = array_chunk($matches,$limit);

		if (count($matchess)>1)
		{
			$str = implode(" ",$matchess[0]);
		} 
		else
		{
			$end_char = '';
		}
		

		return rtrim($str).$end_char;
	}
}

/* End of file form_helper.php */
/* Location: ./system/helpers/form_helper.php */
