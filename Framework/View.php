<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * View class
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_View
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
class Framework_View
{
    /**
     * Templates folder
     * 
     * @var string
     */
    private $_templatesFolder;

    /**
     * Default template
     * 
     * @var string
     */
    private $_defaultTemplate;

    /**
     * Extension of templates
     * 
     * @var string
     */
    private $_templatesExtension;

    /**
     * Layout
     * 
     * @var string
     */
    private $_layout;

    /**
     * Array of partial template variables
     * 
     * @var array
     */
    private $_data = array();

    public function __construct()
    {
        $config                    = Framework_Config_Config::getInstance()->init('config');
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
     * Magic method __set()
     * 
     * Set variable by key
     * 
     * @param  string $key   Key
     * @param  mixed  $value Value
     * @return void
     */
    public function __set($key, $value)
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
    {
        $path = ROOT_PATH . $this->_templatesFolder . DIRECTORY_SEPARATOR . $this->_defaultTemplate . 
                DIRECTORY_SEPARATOR . $template . $this->_templatesExtension;
        $this->ensure(file_exists($path), 'Template file ' . $path . ' not found!');
        if ($data) {
            extract($data, EXTR_SKIP);
        }
        ob_start();
        include_once $path;
        $out = ob_get_contents();
        ob_end_clean();
        return $out;
    }

    /**
     * Render layout
     * 
     * @return void
     */
    public function render()
    {
        extract($this->_data);
        include_once $this->_layout;
    }

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
