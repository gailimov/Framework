<?php

class Application_Models_Messages
{
    /**
     * Instance of database adapter class
     * 
     * @var object
     */
    private $_db;

    public function __construct()
    {
        $this->_db = Framework_Db::factory(Framework_Registry::get('adapter'));
    }

    public function get()
    {
        $query = "SELECT message FROM messages";

        return $this->_db->fetchAssoc($query);
    }
}
