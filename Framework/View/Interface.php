<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * Interface class for Framework_View
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_View
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
interface Framework_View_Interface
{
    /**
     * Return the template engine object
     * 
     * Returns the object instance, as it is its own template engine
     * 
     * @return Framework_View_Abstract
     */
    public function getEngine();

    /**
     * Get templates folder
     * 
     * @return string
     */
    public function getTemplatesFolder();

    /**
     * Get default template
     * 
     * @return string
     */
    public function getDefaultTemplate();

    /**
     * Get extension of templates
     * 
     * @return string
     */
    public function getTemplatesExtension();

    /**
     * Get variable by key
     * 
     * @param  string $key Key
     * @return string
     */
    public function __get($key);

    /**
     * Assign variable value by key
     * 
     * @param  string $key   Key
     * @param  mixed  $value Value
     * @return void
     */
    public function __set($key, $value);

    /**
     * Manually assign variable value by key
     * 
     * @param  string $key   Key
     * @param  mixed  $value Value
     * @return void
     */
    public function assign($key, $value);

    /**
     * Fetch partial template
     * 
     * @param  string $template Template
     * @param  array  $data     Template data
     * @return mixed
     */
    public function fetch($template, $data = array());

    /**
     * Render layout
     * 
     * @return void
     */
    public function render();

    /**
     * Render partial
     * 
     * @param  string $template Template
     * @param  array  $data     Data
     * @return void
     */
    public function renderPartial($template, $data = array());
}
