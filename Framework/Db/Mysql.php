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
            die($e->getMessage());
        }

        $query = $this->_db->query("SET NAMES utf8");

        $this->ensure($query, 'Error in SQL-query');

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
        $res = $this->_db->query($query);

        $this->ensure($res, 'Error in SQL-query!');

        $data = array();

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function __destruct()
    {
        $this->_db = null;
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
                throw new PDOException($message);
            }
        } catch (PDOException $e) {
            if (ERROR_MODE == 'production') {
                die('Error');
            } else {
                die($e->getMessage());
            }
        }
    }
}
