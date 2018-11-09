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
 * ITFosters Application Controller Class
 *
 * This class object is the super class that every library in
 * ITFosters will be assigned to.
 *
 * @package		ITFosters
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://itfosters.com/user_guide/general/controllers.html
 */
class ITF_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (ITFosters.php) to local class variables
		// so that ITF can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */