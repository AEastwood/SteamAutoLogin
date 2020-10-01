<?php

define('APP_ROOT', '/steam');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_TABLE', '');
define('DB_HOST', '');

$required = array( 'core/auth', 'core/database' );

foreach($required as $file) 
{
    require_once $file . ".php";
}

$auth = new Core\Auth;
$accounts = new Core\Database;
