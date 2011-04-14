<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * Autoloading
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_Controller_Router
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
class Framework_Autoload
{
    /**
     * Singleton instance
     * 
     * @var Framework_Autoload
     */
    private static $_instance;

    /**
     * Constructor
     * 
     * Registration functions of autoload
     * 
     * @return void
     */
    private function __construct()
    {
        $this->ensure(spl_autoload_register(array($this, 'load')),
                      'Could not register ' . __CLASS__ . '\'s autoload function!');
    }

    private function __clone()
    {}

    /**
     * Singleton instance
     * 
     * @return Framework_Autoload
     */
    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Autoloading
     * 
     * @param  string $className Class name
     * @return void
     */
    private function load($className)
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

    /**
     * Handling all exceptions
     * 
     * @param  string $expr    Expression
     * @param  string $message Error message
     * @return void
     */
    private function ensure($expr, $message)
    {
        try {
            if (!$expr) {
                throw new Framework_Exception($message);
            }
        } catch (Framework_Exception $e) {
            if (ERROR_MODE == 'production') {
                die($e->showErrorOnProduction());
            } else {
                die($e->showErrorOnDevelopment());
            }
        }
    }
}
