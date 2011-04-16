<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * Handler of view's exceptions
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_View
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
class Framework_View_Exception extends Framework_Exception
{
    /**
     * Show error on development mode
     * 
     * @return string
     */
    public function showErrorOnDevelopment()
    {
        $trace      = $this->getTrace();
        $exception  = '<header><h1>Framework :: Error #' . $this->getCode() . '</h1></header>' . "\n";
        $exception .= '<article><header><h2>Message:</h2></header>' . "\n";
        $exception .= '<p>' . $this->getMessage() . '</p></article>' . "\n";
        $exception .= '<article><header><h2>File</h2></header>' . "\n";
        $exception .= '<p>' . $this->getFile() . '</p></article>' . "\n";
        $exception .= '<article><header><h2>Line</h2></header>' . "\n";
        $exception .= '<p>' . $this->getLine() . '</p></article>' . "\n";
        $exception .= '<article><header><h2>Class::method</h2></header>' . "\n";
        if ($trace[0]['class'] != '') {
            $exception .= '<p>' . $trace[0]['class'];
            $exception .= $trace[0]['type'];
        }
        $exception .= $trace[0]['function'];
        $exception .= '();</p></article>' . "\n";
        $exception .= '<article><header><h2>Trace</h2></header>' . "\n";
        $i = -1;
        foreach ($trace as $one) {
            $i++;
            $exception .= '<p>' . $i . '</p>' . "\n";
            $exception .= '<ul><li><strong>File</strong>: ' . $one['file'] . '</li>' . "\n";
            $exception .= '<li><strong>Line</strong>: ' . $one['line'] . '</li>' . "\n";
            $exception .= '<li><strong>Class::method</strong>: ' . $one['class'] . $one['type'] . $one['function'] . '();</li></ul>' . "\n";
        }
        $exception .= '</article>' . "\n";

        return $exception;
    }
}
