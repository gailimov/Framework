<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * Registry
 * 
 * Implementation of Registry design pattern
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_Registry
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
class Framework_Registry
{
    /**
     * Singleton instance
     * 
     * @var Framework_Registry
     */
    private static $_instance;

    /**
     * Array of registry
     * 
     * @var array
     */
    private $_registry = array();

    private function __construct()
    {}

    private function __clone()
    {}

    /**
     * Singleton instance
     * 
     * @return Framework_Registry
     */
    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Save an object by key into registry
     * 
     * @param  string $key    Key
     * @param  object $object Object
     * @return void
     */
    public static function set($key, $object)
    {
        self::getInstance()->_registry[$key] = $object;
    }

    /**
     * Get an object by key from registry
     * 
     * @param  string $key Key
     * @return object
     */
    public static function get($key)
    {
        if (isset(self::getInstance()->_registry[$key])) {
            return self::getInstance()->_registry[$key];
        }
        return null;
    }
}
