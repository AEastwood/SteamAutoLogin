<?php
$Username = "pmauser";
$Password = "";
$Database = "steam";

$PDO = new PDO("mysql:host=localhost;dbname=$Database", $Username, $Password);
$Query = $PDO->query('SELECT user FROM accounts WHERE enabled = 1 ORDER BY user ASC');


class Config {
    
    public function SafetyCheck() {
        if(!isset($_SESSION['valid']) || $_SESSION['valid'] != true) {
            header('Location: login.php');
            exit;
        }
    }

    public function Login($details){
        $username = ""; //username
        $password = ""; //sha256 salted hash

        $details = self::saltyBoi($details);

        if($details->username == $username && $details->password == $password){
            $_SESSION['valid'] = true;
            $_SESSION['username'] = $details->username;
            $_SESSION['pin'] = rand(1000, 9999);
            $_SESSION['endpoint'] = $_SERVER['HTTP_X_FORWARDED_FOR'];

            header('Location: index.php');
        }
        else{
            echo "Unknown username or password";
        }
    }
    
    private function saltyBoi($details){
        $salt = ""; // set your salt here
        
        $details->password = hash("sha256", $details->password . $salt);
        return $details;
    }

}