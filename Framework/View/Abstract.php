<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * Abstract class for Framework_View
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_View
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
abstract class Framework_View_Abstract implements Framework_View_Interface
{
    /**
     * Templates folder
     * 
     * @var string
     */
    protected $_templatesFolder;

    /**
     * Default template
     * 
     * @var string
     */
    protected $_defaultTemplate;

    /**
     * Layout
     * 
     * @var string
     */
    protected $_layout;

    /**
     * Extension of templates
     * 
     * @var string
     */
    protected $_templatesExtension;

    /**
     * Array of partial template variables
     * 
     * @var array
     */
    protected $_data = array();

    public function __construct()
    {
        Framework_Config_Config::getInstance()->init('config');
        $this->_templatesFolder    = Framework_Registry::get('templatesFolder');
        $this->_defaultTemplate    = Framework_Registry::get('defaultTemplate');
        $this->_templatesExtension = Framework_Registry::get('templatesExtension');
        $this->_layout             = ROOT_PATH . $this->_templatesFolder .
                                     DIRECTORY_SEPARATOR . $this->_defaultTemplate .
                                     DIRECTORY_SEPARATOR . 'layouts' .
                                     DIRECTORY_SEPARATOR . Framework_Registry::get('layoutName') .
                                     $this->_templatesExtension;
        $this->ensure(file_exists($this->_layout), 'Layout file ' . $this->_layout . ' not found!');
    }

    /**
     * Return the template engine object
     * 
     * Returns the object instance, as it is its own template engine
     * 
     * @return Framework_View_Abstract
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * Get templates folder
     * 
     * @return string
     */
    public function getTemplatesFolder()
    {
        return $this->_templatesFolder;
    }

    /**
     * Get default template
     * 
     * @return string
     */
    public function getDefaultTemplate()
    {
        return $this->_defaultTemplate;
    }

    /**
     * Get layout
     * 
     * @return string
     */
    public function getLayout()
    {
        return $this->_layout;
    }

    /**
     * Get extension of templates
     * 
     * @return string
     */
    public function getTemplatesExtension()
    {
        return $this->_templatesExtension;
    }

    /**
     * Magic method __get()
     * 
     * Get variable by key
     * 
     * @param  string $key Key
     * @return string
     */
    public function __get($key)
    {
        return $this->_data[$key];
    }

    /**
     * Magic method __set()
     * 
     * Assign variable value by key
     * 
     * @param  string $key   Key
     * @param  mixed  $value Value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->assign($key, $value);
    }

    /**
     * Manually assign variable value by key
     * 
     * @param  string $key   Key
     * @param  mixed  $value Value
     * @return void
     */
    public function assign($key, $value)
    {
        $this->_data[$key] = $value;
    }

    /**
     * Fetch partial template
     * 
     * @param  string $template Template
     * @param  array  $data     Template data
     * @return mixed
     */
    public function fetch($template, $data = array())
    {}

    /**
     * Render layout
     * 
     * @return void
     */
    public function render()
    {}

    /**
     * Render partial
     * 
     * @param  string $template Template
     * @param  array  $data     Data
     * @return void
     */
    public function renderPartial($template, $data = array())
    {
        echo $this->fetch($template, $data);
    }

    /**
     * Handling all exceptions
     * 
     * @param  string $expr    Expression
     * @param  string $message Error message
     * @return void
     */
    protected function ensure($expr, $message)
    {
        try {
            if (!$expr) {
                throw new Framework_View_Exception($message);
            }
        } catch (Framework_View_Exception $e) {
            if (ERROR_MODE == 'production') {
                die($e->showErrorOnProduction());
            } else {
                die($e->showErrorOnDevelopment());
            }
        }
    }
}
