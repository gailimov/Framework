<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * Main handler of exceptions
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_Controller_Router
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
class Framework_Exception extends Exception
{
    /**
     * Show error on development mode
     * 
     * @return string
     */
    public function showErrorOnDevelopment()
    {
        $exception  = '<h1>Framework &mdash; Error #' . $this->getCode() . '</h1>' . "\n";
        $exception .= '<p>' . $this->getMessage() . '</p>' . "\n";
        $exception .= '<h2>File</h2>' . "\n";
        $exception .= '<p>' . $this->getFile() . '</p>' . "\n";
        $exception .= '<h2>Line</h2>' . "\n";
        $exception .= '<p>' . $this->getLine() . '</p>' . "\n";
        $trace = $this->getTrace();
        $exception .= '<h2>Class</h2>' . "\n";
        if ($trace[0]['class'] != '') {
            $exception .= '<p>' . $trace[0]['class'];
            $exception .= '->';
        }
        $exception .= $trace[0]['function'];
        $exception .= '();</p>';

        return $exception;
    }

    /**
     * Show error on production mode
     * 
     * @return string
     */
    public function showErrorOnProduction()
    {
        return 'Error';
    }
}
