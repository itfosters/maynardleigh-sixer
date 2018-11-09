<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load MX core classes */
require_once dirname(__FILE__).'/Lang.php';
require_once dirname(__FILE__).'/Config.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the ITFosters Core Classes
 * @link	http://itfosters.com
 *
 * Description:
 * This library creates a ITF class which allows the use of modules in an application.
 *
 * Install this file as application/third_party/MX/Itf.php
 *
 * @copyright	Copyright (c) 2011 Wiredesignz
 * @version 	5.4
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class ITF
{
	public static $APP;
	
	public function __construct() {
		
		/* assign the application instance */
		self::$APP = ITF_Controller::get_instance();
		
		global $LANG, $CFG;
		
		/* re-assign language and config for modules */
		if ( ! is_a($LANG, 'MX_Lang')) $LANG = new MX_Lang;
		if ( ! is_a($CFG, 'MX_Config')) $CFG = new MX_Config;
		
		/* assign the core loader */
		self::$APP->load = new MX_Loader;
		
		/* autoload module items */
		self::$APP->load->_autoloader(array());
	}
}

/* create the application object */
new ITF;