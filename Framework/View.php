<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * Concrete View class
 * 
 * Standard view class uses the native PHP. For use another template engine,
 * create a new class extending Framework_View_Abstract.
 * For details @see Framework_View_Abstract
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_View
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
class Framework_View extends Framework_View_Abstract
{
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
}
