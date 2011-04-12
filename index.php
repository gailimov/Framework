<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/** Defining of root path */
if (!defined('ROOT_PATH')) define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

/**
 * Autoloading
 * 
 * @param  string $className Class name
 * @return void
 */
function frameworkAutoload($className)
{
    $path = str_replace('_', DIRECTORY_SEPARATOR, $className);
    if (file_exists(ROOT_PATH . $path . '.php')) {
        require_once ROOT_PATH . $path . '.php';
    } else {
        header("HTTP/1.0 404 Not Found");
        echo '404';
        die;
    }
}

/** Register of autoload functions */
spl_autoload_register('frameworkAutoload');

/** Running of the front controller */
Framework_Controller_Controller::run();
