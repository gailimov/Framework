<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * MySQL database class
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @category  Framework
 * @package   Framework_Db
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 */
class Framework_Db_Mysql implements Framework_Db_Interface
{
    /**
     * Database connection descriptor
     * 
     * @var resource
     */
    private $_db = null;

    /**
     * Constructor
     * 
     * Set database connection and register descriptor of connection
     * 
     * @return void
     */
    public function __construct()
    {
        $name     = Framework_Registry::get('name');
        $host     = Framework_Registry::get('host');
        $user     = Framework_Registry::get('user');
        $password = Framework_Registry::get('password');
        $charset  = Framework_Registry::get('charset');
        $prefix   = Framework_Registry::get('prefix');

        try {
            $this->_db = new PDO('mysql:host=' . $host . ';dbname=' . $name, $user, $password);
        } catch (PDOException $e) {
            if (ERROR_MODE == 'production') {
                die('Error');
            } else {
                if (ERROR_MODE == 'production') {
                    die('Error');
                } else {
                    $this->handleError($e);
                }
            }
        }

        $query = $this->_db->query("SET NAMES " . $charset);

        try {
            if (!$query) {
                throw new PDOException($e);
            }
        } catch (PDOException $e) {
            if (ERROR_MODE == 'production') {
                die('Error');
            } else {
                $this->handleError($e, __METHOD__);
            }
        }

        Framework_Registry::set('db', $this->_db);
    }

    /**
     * Returns associative array
     * 
     * @param  string $query SQL-query
     * @return array
     */
    public function fetchAssoc($query)
    {
        $result = $this->_db->query($query);

        try {
            if (!$result) {
                throw new PDOException($e);
            }
        } catch (PDOException $e) {
            if (ERROR_MODE == 'production') {
                die('Error');
            } else {
                $this->handleError($e, __METHOD__);
            }
        }

        $data = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    /**
     * Destructor
     * 
     * Close database connection
     * 
     * @return void
     */
    public function __destruct()
    {
        $this->_db = null;
    }

    /**
     * Errors handler
     * 
     * @param  obj    $e      Instance of PDOException class
     * @param  string $method __METHOD__ (optional)
     * @return void
     */
    private function handleError($e, $method = '')
    {
        // SQL-query errors
        if ($this->_db instanceof PDO) {
            $message  = '<h1>Framework &mdash; Error in SQL-query</h1>' . "\n";
            $errorInfo = $this->_db->errorInfo();
            $message .= '<h2>SQLSTATE error code</h2>' . "\n";
            $message .= '<p>' . $errorInfo['0'] . '</p>' . "\n";
            $message .= '<h2>MySQL error code</h2>' . "\n";
            $message .= '<p>' . $errorInfo['1'] . '</p>' . "\n";
            $message .= '<h2>Message</h2>' . "\n";
            $message .= '<p>' . $errorInfo['2'] . '</p>' . "\n";
            $message .= '<h2>File</h2>' . "\n";
            $message .= '<p>' . $e->getFile() . '</p>' . "\n";
            $message .= '<h2>Line</h2>' . "\n";
            $message .= '<p>' . $e->getLine() . '</p>' . "\n";
            $message .= '<h2>Method</h2>' . "\n";
            $message .= '<p>' . $method . '();</p>';
            die($message);
        }

        // Connection errors
        $message  = '<h1>Framework &mdash; Database connection error</h1>' . "\n";
        $message .= '<h2>Message</h2>' . "\n";
        $message .= '<p>' . $e->getMessage() . '</p>' . "\n";
        $message .= '<h2>File</h2>' . "\n";
        $message .= '<p>' . $e->getFile() . '</p>' . "\n";
        $message .= '<h2>Line</h2>' . "\n";
        $message .= '<p>' . $e->getLine() . '</p>' . "\n";
        $trace    = $e->getTrace();
        $message .= '<h2>Method</h2>' . "\n";
        if ($trace[0]['class'] != '') {
            $message .= '<p>' . $trace[1]['class'];
            $message .= $trace[1]['type'];
        }
        $message .= $trace[1]['function'];
        $message .= '();</p>';
        die($message);
    }
}
