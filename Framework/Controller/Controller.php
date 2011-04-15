<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * Front Controller
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_Controller
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
class Framework_Controller_Controller
{
    private function __construct()
    {}

    /**
     * Running
     * 
     * @return void
     */
    public static function run()
    {
        $instance = new Framework_Controller_Controller();
        $instance->init('db');
        $instance->handleRequest();
    }

    /**
     * Initialize
     * 
     * @return void
     */
    public function init($configName)
    {
        $config = Framework_Config_Config::getInstance();
        $config->init($configName);
    }

    /**
     * Handling of request
     * 
     * @return void
     */
    private function handleRequest()
    {
        $request = new Framework_Controller_Router();
        $request->dispatch();
    }
}
