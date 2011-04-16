<?php

/**
 * Framework
 * 
 * @copyright Copyright (c) 2011 Kanat Gailimov (http://gailimov.info)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3
 * @version   0.1 pre-alpha
 */


/**
 * Database confuguration
 * 
 * "adapter"  - Database adapter. May be "Sqlite" for SQlite, "Mysql" for MySQL or "Pgsql" for PostgreSQL.
 * "host"     - Database host. Usually "localhost".
 * "user"     - Database user.
 * "password" - Database password.
 * "name"     - Database name.
 * "charset"  - Database charset. We use everywhere utf8, and advise to you :).
 * "prefix"   - Database prefix. It indicates with an underscore at the end. 
 *              For example: 'prefix' => 'my_' Leave blank if not used.
 * 
 * Example:
 * 
 * return array(
 *     'adapter'  => 'Mysql' (or 'Sqlite', or 'Pgsql')
 *     'host'     => 'localhost',
 *     'user'     => 'root',
 *     'password' => 'password',
 *     'name'     => 'db_name',
 *     'charset'  => 'utf8',
 *     'prefix'   => 'my_'
 * );
 */
return array(
    'adapter'  => 'Mysql',
    'host'     => 'localhost',
    'user'     => 'root',
    'password' => '',
    'name'     => '',
    'charset'  => 'utf8',
    'prefix'   => ''
);
