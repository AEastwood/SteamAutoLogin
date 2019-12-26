<?php

$validCommands = ["delete", "login"];
$Command = isset($_GET['command']) ? $_GET['command'] : "nothing"; 

if(!in_array($_GET['command'], $validCommands)){
    header("Location: ./index.php");
}

if(isset($_GET['command'])){
    $Account = (object)[];
    $Account->Username = isset($_GET['username']) ? $_GET['username'] : "";
    Commands::RunCommand($Command, $Account);  
}

class Commands {

    public function RunCommand(string $Command, $Account = null){
        switch($Command) {
            
            case "login":
                if(!file_exists("login.txt")){
                    fopen("login.txt", "w");
                }

                $Account->Password = Commands::GetPassword($Account->Username);
                file_put_contents(__DIR__ . "/login.txt", json_encode($Account));
                break;

            case "delete":
                if(file_exists("login.txt")){
                    unlink("login.txt");
                }

                break;
        }
    }

    public function GetPassword(string $Account): string{
        $Username = "root";
        $Password = "";
        $Database = "steam";
        $RPassword = "steam";

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
