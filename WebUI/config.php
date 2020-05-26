<?php

$Username = "pmauser";
$Password = "";
$Database = "steam";

$PDO = new PDO("mysql:host=localhost;dbname=$Database", $Username, $Password);
$Query = $PDO->query('SELECT user FROM accounts WHERE enabled = 1 ORDER BY user ASC');


class Config {

    public function SafetyCheck() {
        if(!isset($_COOKIE['adam'])) {
            header('Location: ../');
            exit;
        }
    }

}