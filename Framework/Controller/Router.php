<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * Router
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_Controller_Router
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
class Framework_Controller_Router
{
    /**
     * Instance of Framework_Config_Config class
     * 
     * @var object
     */
    private $_config;

    /**
     * Routes
     * 
     * @var string
     */
    private $_routes;

    public function __construct()
    {
        $this->_config = Framework_Config_Config::getInstance();
    }

    /**
     * Get URI
     * 
     * @return array
     */
    private function getUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return $_SERVER['REQUEST_URI'];
        }

        if (!empty($_SERVER['PATH_INFO'])) {
            return $_SERVER['PATH_INFO'];
        }

        if (!empty($_SERVER['QUERY_STRING'])) {
            return $_SERVER['QUERY_STRING'];
        }
    }

    /**
     * Parsing of the URI and getting segments
     * 
     * @return array
     */
    private function getUriSegments()
    {
        $uri = $this->getUri();

        // Parsing of the URI
        $segments = preg_replace("/^(.*?)index\.php$/is", "$1", $_SERVER['SCRIPT_NAME']);
        $segments = preg_replace("/^".preg_quote($segments, "/")."/is", "", urldecode($uri));
        $segments = preg_replace("/(\/?)(\?.*)?$/is", "", $segments);
        // Cut out unnecessary characters
        $segments = preg_replace("/[^0-9A-Za-zА-Я-а-я._\\-\\/]/is", "", $segments);
        // Split the URI to slashes
        $segments = explode("/", $segments);
        // Remove the suffix
        if (preg_match("/^index\.(?:html|php)$/is", $_URL[count($segments) - 1])) {
            unset($segments[count($segments) - 1]);
        }

        return $segments;
    }

    /**
     * Dispatcher of the URI
     * 
     * @return void
     */
    public function dispatch()
    {
        $segments = $this->getUriSegments();

        $params = array();

        if ($segments[0] == 'index.php') {
            $controller = ucfirst($segments[1]);
            $action = $segments[2];
            if (count($segments) > 3) {
                $params = array_slice($segments, 3);
            }
        } else {
            $controller = ucfirst($segments[0]);
            $action = $segments[1];
            if (count($segments) > 2) {
                $params = array_slice($segments, 2);
            }
        }

        // If there is no controller - set the default controller
        if (empty($controller)) {
            $this->_config->init('routes');
            $controller = Framework_Registry::get('defaultController');
        }

        // If there is no action - set the default action
        if (empty($action)) {
            $action = 'index';
        }

        $controllerFile = ROOT_PATH . 'Application/Controllers/' . $controller . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
        }

        // If the class of controller is not loaded or there is no necessary method - 404
        if (!is_callable(array($controller, $action))) {
            header("HTTP/1.0 404 Not Found");
            echo '404';
            die;
        }

        // Create instance of controller class
        $obj = new $controller();

        // Calling controller's action with parameters
        call_user_func_array(array($obj, $action), $params);
    }
}
