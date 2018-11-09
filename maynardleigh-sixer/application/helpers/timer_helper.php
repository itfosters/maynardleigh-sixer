<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Time Convert
 *
 * Determines what the form validation class was instantiated as, fetches
 * the object and returns it.
 *
 * @access	private
 * @return	mixed
 */
if ( ! function_exists('hourMinuteToSecond'))
{
	function hourMinuteToSecond($hour_minute="")
	{
		$t = explode(':', $hour_minute);
        return ((int)$t[0] * 60 * 60) + ((int)$t[1] * 60);
	}
}

if ( ! function_exists('secondToTime'))
{
	function secondToTime($totalsec="1")
	{
		$h = (int)($totalsec/(60*60));
		$m= (int)(($totalsec%(60*60))/60);
		$s= (int)(($totalsec%(60*60))%60);
        return $h.":".$m.":".$s;
	}
}


/* End of file form_helper.php */
/* Location: ./system/helpers/form_helper.php */
