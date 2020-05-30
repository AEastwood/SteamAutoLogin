<?php
require('config.php');
session_start();
Config::SafetyCheck();

$validCommands = ["login"];
$Command = isset($_GET['command']) ? $_GET['command'] : null; 

if(!in_array($_GET['command'], $validCommands) || $Command == null){
    return;
}

$Account = (object)[];
$Account->Username = isset($_GET['username']) ? $_GET['username'] : null;
Commands::RunCommand($Command, $Account);  

class Commands {

    public function RunCommand(string $Command, $Account = null){
        switch($Command) {
            
            case "login":
                $Account->Password = self::GetPassword($Account->Username);
                $Account->data = base64_encode(json_encode($Account));
                echo $Account->data;
                break;
        }
    }

    public function GetPassword(string $Account): string{
        $Username = "pmauser";
        $Password = "";
        $Database = "steam";

        $PDO = new PDO("mysql:host=localhost;dbname=$Database", $Username, $Password);
        $Query = $PDO->prepare('SELECT pass FROM accounts WHERE user=:user');
        $Query->bindValue(":user", $Account);
        $Query->execute();

        $Accounts = $Query->RowCount();

        if($Accounts == 0){
            $RPassword = "unknown_password";
        }
        else{
            $Accounts = $Query->FetchAll();
            foreach($Accounts as $Account){
                $RPassword = $Account['pass'];
            }
        }

        return base64_encode($RPassword);
    }

}
