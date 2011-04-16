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
 * @package   Framework_Exception
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
        $exception  = '<header><h1>Framework :: Error #' . $this->getCode() . '</h1></header>' . "\n";
        $exception .= '<article><header><h2>Message:</h2></header>' . "\n";
        $exception .= '<p>' . $this->getMessage() . '</p></article>' . "\n";
        $exception .= '<article><header><h2>File</h2></header>' . "\n";
        $exception .= '<p>' . $this->getFile() . '</p></article>' . "\n";
        $exception .= '<article><header><h2>Line</h2></header>' . "\n";
        $exception .= '<p>' . $this->getLine() . '</p></article>' . "\n";
        $trace = $this->getTrace();
        $exception .= '<article><header><h2>Class</h2></header>' . "\n";
        if ($trace[0]['class'] != '') {
            $exception .= '<p>' . $trace[0]['class'];
            $exception .= $trace[0]['type'];
        }
        $exception .= $trace[0]['function'];
        $exception .= '();</p></article>' . "\n";

        return $exception;
    }

    /**
     * Show error on production mode
     * 
     * @return string
     */
    public function showErrorOnProduction()
    {
        $message  = '<header><h1>Framework :: Error</h1></header>' . "\n";
        $message .= '<article><p>An error has occurred.</p></article>' . "\n";

        return $message;
    }
}
