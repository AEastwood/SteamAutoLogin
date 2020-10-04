<?php

define('APP_ROOT', '/steam');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_TABLE', '');
define('DB_HOST', '');
define('STEAM_KEY', '');

$required = array( 'core/auth', 'core/database', 'core/steamAPI' );

foreach($required as $file) 
{
    require_once $file . ".php";
}

$auth = new Core\Auth;
$database = new Core\Database;
$steamAPI = new Core\SteamAPI();
