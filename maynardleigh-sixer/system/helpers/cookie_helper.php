<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ITFosters
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		ITFosters
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://itfosters.com/user_guide/license.html
 * @link		http://itfosters.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ITFosters Cookie Helpers
 *
 * @package		ITFosters
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://itfosters.com/user_guide/helpers/cookie_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Set cookie
 *
 * Accepts six parameter, or you can submit an associative
 * array in the first parameter containing all the values.
 *
 * @access	public
 * @param	mixed
 * @param	string	the value of the cookie
 * @param	string	the number of seconds until expiration
 * @param	string	the cookie domain.  Usually:  .yourdomain.com
 * @param	string	the cookie path
 * @param	string	the cookie prefix
 * @return	void
 */
if ( ! function_exists('set_cookie'))
{
	function set_cookie($name = '', $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = FALSE)
	{
		// Set the config file options
		$ITF =& get_instance();
		$ITF->input->set_cookie($name, $value, $expire, $domain, $path, $prefix, $secure);
	}
}

// --------------------------------------------------------------------

/**
 * Fetch an item from the COOKIE array
 *
 * @access	public
 * @param	string
 * @param	bool
 * @return	mixed
 */
if ( ! function_exists('get_cookie'))
{
	function get_cookie($index = '', $xss_clean = FALSE)
	{
		$ITF =& get_instance();

		$prefix = '';

		if ( ! isset($_COOKIE[$index]) && config_item('cookie_prefix') != '')
		{
			$prefix = config_item('cookie_prefix');
		}

		return $ITF->input->cookie($prefix.$index, $xss_clean);
	}
}

// --------------------------------------------------------------------

/**
 * Delete a COOKIE
 *
 * @param	mixed
 * @param	string	the cookie domain.  Usually:  .yourdomain.com
 * @param	string	the cookie path
 * @param	string	the cookie prefix
 * @return	void
 */
if ( ! function_exists('delete_cookie'))
{
	function delete_cookie($name = '', $domain = '', $path = '/', $prefix = '')
	{
		set_cookie($name, '', '', $domain, $path, $prefix);
	}
}


/* End of file cookie_helper.php */
/* Location: ./system/helpers/cookie_helper.php */