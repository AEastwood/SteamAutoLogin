<?php

namespace Core;

class Auth {

    public static $hasAuth;

    /**
     *  class constructor
     */
    public function __construct()
    {
        session_start();
        self::$hasAuth = $this->isAuthenticated();
    }

    /**
     *  this will fail a login and reset the login instance
     */
    public function failLogin()
    {
        $_SESSION['authenticated'] = false;
        header('Location: ' . APP_ROOT . '/login.php');
        exit;
    }

    /**
     *  checks if user has valid authentication
     *  @return bool
     */
    public function isAuthenticated()
    {
        if( isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ) {
            return true;
        }

        return false;
    }

    /**
     *  checks request is ajax
     */
    public function isAjax()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
        {
            return true;
        }

        return false;
    }

    /**
     *  login to account
     */
    public function login($username, $password)
    {
        if( self::$hasAuth )
        {
            header('Location: ' . APP_ROOT . '/index.php');
        }

        if( !isset($username) || !isset($password) )
        {
            self::failLogin();
        }

        Database::login($username, $password);
    }

    /**
     *  requires authentication to show page
     */
    public function requireAuthentication()
    {
        if( !self::$hasAuth )
        {
            header('Location: ' . APP_ROOT . '/login.php');
            exit;
        }
    }

}