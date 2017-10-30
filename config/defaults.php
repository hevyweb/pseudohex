<?php

if (!defined('DS')){
    /**
     * @const DIRECTORY_SEPARATOR slash or forward slash. Very important since initially we were using
     * windows server.
     */
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('MYSQL_HOST')){
    define('MYSQL_HOST', 'localhost');
}

if (!defined('MYSQL_PORT')){
    define('MYSQL_PORT', '3306');
}

if (!defined('MYSQL_DB')){
    define('MYSQL_DB', 'test');
}

if (!defined('MYSQL_USER')){
    define('MYSQL_USER', 'root');
}

if (!defined('MYSQL_PASSWORD')){
    define('MYSQL_PASSWORD', '');
}

if (!defined('ADMIN_NAME')){
    /**
     * @const ADMIN_NAME login for the admin account
     */
    define('ADMIN_NAME', 'admin');
}

if (!defined('ADMIN_EMAIL')){
    /**
     * @const ADMIN_EMAIL email for the admin account
     */
    define('ADMIN_EMAIL', 'admin@gmail.com');
}

if (!defined('ADMIN_PASSWORD')){
    /**
     * @const ADMIN_PASSWORD password for the admin account
     */
    define('ADMIN_PASSWORD', 'admin');
}

