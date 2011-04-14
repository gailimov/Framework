<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * loader of the configurations
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_Controller_Router
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
class Framework_Config_Config
{
    /**
     * Singleton instance
     * 
     * @var Framework_Config_Config
     */
    private static $_instance;

    /**
     * Configuration
     * 
     * @var string
     */
    private $_config;

    private function __construct()
    {
        $this->_config = ROOT_PATH . 'Application' . DIRECTORY_SEPARATOR . 'Configs' . DIRECTORY_SEPARATOR;
    }

    private function __clone()
    {}

    /**
     * Singleton instance
     * 
     * @return Framework_Config_Config
     */
    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Initialize
     * 
     * @param  string $configName Name of the config
     * @return void
     */
    public function init($configName)
    {
        $config = Framework_Registry::get($configName);
        if ($config) {
            return;
        }
        $this->getConfig($configName);
    }

    /**
     * Get config data
     * 
     * @param  string $configName Name of the config
     * @return void
     */
    private function getConfig($configName)
    {
        $this->ensure(file_exists($this->_config . $configName . '.php'),
                                  'Configuration file not found!');
        $config = require_once $this->_config . $configName . '.php';
        foreach ($config as $key => $value) {
            Framework_Registry::set($key, $config[$key]);
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
        if (!$expr) {
            throw new Framework_Config_Exception($message);
        }
    }
}
