<?php

namespace Core;

class SteamAPI {

    public static $accounts = array();

    /**
     *  adds account to array
     */
    public function addaccount($account)
    {
        array_push(self::$accounts, $account);
    }

    /**
     *  Generates table rows for UI
     */
    public function generateUserCards()
    {
        foreach(self::$accounts as $account)
        {
            $userCard = "<div class=\"card\">";
            $userCard .= "<img src=\"" . $account['avatarfull'] ."\" alt=\"" . $account['personaname'] . "\" style=\"width:250px\">";
            $userCard .= "<b>" . $account['personaname'] . "</b>";
            $userCard .= "<p class=\"title\" onclick=\"window.open('" .$account['profileurl'] . "');\">Profile</p>";
            $userCard .= "<p><button onclick=\"login('" . $account['user'] . "');\">Login</button></p>";
            $userCard .= "</div>";

            echo $userCard;
        }
    }

    /**
     *  runs all queries as one request making it load faster
     */
    public function makeRequest()
    {
        $steamIDs = array();

        foreach(self::$accounts as $account) 
        {
            array_push($steamIDs, $account['steamID64']);
        }

        $apiLink = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . STEAM_KEY . "&steamids=" . implode(',', $steamIDs);
        $apiData = file_get_contents($apiLink);
        $apiData = json_decode($apiData);

        foreach($apiData->response->players as $player)
        {
            for($i = 0; $i < count(self::$accounts); $i++)
            {
                if(self::$accounts[$i]['steamID64'] === $player->steamid)
                {
                    self::$accounts[$i]['avatarfull'] = $player->avatarfull;
                    self::$accounts[$i]['personaname'] = $player->personaname;
                    self::$accounts[$i]['profileurl'] = $player->profileurl;
                }
            }
        }
    }

}