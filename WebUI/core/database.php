<?php

namespace Core;

class Database {

    public static $pdo;
    public static $commands = array();

    /**
     *  class constructor
     */
    public function __construct()
    {
        self::$pdo = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_TABLE, DB_USER, DB_PASS);

        self::$commands = array(
            'checkAccount' => self::$pdo->prepare('SELECT username, password, suspended FROM users WHERE username = :user AND suspended = 0 LIMIT 1'),
            'listAccounts' => self::$pdo->query('SELECT user FROM accounts WHERE enabled = 1 ORDER BY user ASC'),
            'getPassword' => self::$pdo->prepare('SELECT pass FROM accounts WHERE user=:user LIMIT 1')
        );
    }

    /**
     *  returns login details as object
     */
    public function getAccountDetails($username)
    {
        $account = new \StdClass();
        $account->username = $username;
        $account->password = self::getPassword($username);

        return $account;
    }

    /**
     *  returns password for specified account
     *  @param $username
     */
    public function getPassword(string $username)
    {
        $password = self::$commands['getPassword'];
        $password->bindValue(':user', $username);
        $password->execute();
        
        return $password->fetchAll()[0]['pass'];
    }

    /**
     *  checks if the request is ajax
     */
    public function isAjax()
    {
        if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) 
        {
            return true;
        }

        return false;
    }

    /**
     *  Command handler
     */
    public function listAll()
    {
        if( Auth::$hasAuth )
        {
            return self::$commands['listAccounts']->fetchAll();
        }
    }

    /**
     *  check login details
     */
    public function login($username, $password)
    {
        $login = self::$commands['checkAccount'];
        $login->bindValue(':user', $username, \PDO::PARAM_STR);
        $login->execute();

        if( $login->rowCount() === 1 )
        {
            if( $result = $login->fetch() )
            {
                $dbPassword = $result['password'];

                if( password_verify($password, $dbPassword) )
                {
                    $_SESSION['authenticated'] = true;
                    header('Location: ' . APP_ROOT . '/index.php');
                    exit;
                }
            }
        }

        return;
    }

}