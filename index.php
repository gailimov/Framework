<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/** Defining of root path */
defined('ROOT_PATH') || define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

/** Autoloading */
require_once ROOT_PATH . 'Framework' . DIRECTORY_SEPARATOR . 'Autoload.php';
Framework_Autoload::getInstance();

/** Running of the Front Controller */
Framework_Controller_Controller::run();
