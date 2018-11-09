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
 * ITFosters Model Class
 *
 * @package		ITFosters
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://itfosters.com/user_guide/libraries/config.html
 */
class ITF_Model {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	function __construct()
	{
		log_message('debug', "Model Class Initialized");
	}

	/**
	 * __get
	 *
	 * Allows models to access ITF's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string
	 * @access private
	 */
	function __get($key)
	{
		$ITF =& get_instance();
		return $ITF->$key;
	}
}
// END Model Class

/* End of file Model.php */
/* Location: ./system/core/Model.php */