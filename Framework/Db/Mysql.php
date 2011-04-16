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
            $this->handleError($e);
        }

        $query = $this->_db->query("SET NAMES " . $charset);

        try {
            if (!$query) {
                throw new PDOException($e);
            }
        } catch (PDOException $e) {
            $this->handleError($e, __METHOD__);
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
            $this->handleError($e, __METHOD__);
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
        if (ERROR_MODE == 'production') {
            $title    = 'Framework :: Error';
            $message  = '<header><h1>Framework :: Error</h1></header>' . "\n";
            $message .= '<article><p>An error has occurred.</p></article>' . "\n";
        } else {
            if ($this->_db instanceof PDO) {
                // SQL-query errors
                $title      = 'Framework :: Error in SQL-query';
                $message    = '<header><h1>Framework :: Error in SQL-query</h1></header>' . "\n";
                $errorInfo  = $this->_db->errorInfo();
                $message   .= '<article><header><h2>SQLSTATE error code</h2></header>' . "\n";
                $message   .= '<p>' . $errorInfo['0'] . '</p></article>' . "\n";
                $message   .= '<article><header><h2>MySQL error code</h2></header>' . "\n";
                $message   .= '<p>' . $errorInfo['1'] . '</p></article>' . "\n";
                $message   .= '<article><header><h2>Message</h2></header>' . "\n";
                $message   .= '<p>' . $errorInfo['2'] . '</p></article>' . "\n";
                $message   .= '<article><header><h2>File</h2></header>' . "\n";
                $message   .= '<p>' . $e->getFile() . '</p></article>' . "\n";
                $message   .= '<article><header><h2>Line</h2></header>' . "\n";
                $message   .= '<p>' . $e->getLine() . '</p></article>' . "\n";
                $message   .= '<article><header><h2>Method</h2></header>' . "\n";
                $message   .= '<p>' . $method . '();</p></article>';
            } else {
                // Connection errors
                $title      = 'Framework :: Database connection error';
                $message    = '<header><h1>Framework :: Database connection error</h1></header>' . "\n";
                $message   .= '<article><header><h2>Message</h2></header>' . "\n";
                $message   .= '<p>' . $e->getMessage() . '</p></article>' . "\n";
                $message   .= '<article><header><h2>File</h2></header>' . "\n";
                $message   .= '<p>' . $e->getFile() . '</p></article>' . "\n";
                $message   .= '<article><header><h2>Line</h2></header>' . "\n";
                $message   .= '<p>' . $e->getLine() . '</p></article>' . "\n";
                $trace      = $e->getTrace();
                $message   .= '<article><header><h2>Method</h2></header>' . "\n";
                if ($trace[0]['class'] != '') {
                    $message .= '<p>' . $trace[1]['class'];
                    $message .= $trace[1]['type'];
                }
                $message .= $trace[1]['function'];
                $message .= '();</p></article>' . "\n";
            }
        }
        include_once ROOT_PATH . 'Application/Errors/db.php';
        die;
    }
}
