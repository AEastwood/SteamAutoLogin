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
    public function generateTableRows()
    {
        foreach(self::$accounts as $account)
        {
                echo "<tr>";
                echo "<td class='table_display'><img src='" . $account['avatarmedium'] . "'></td>";
                echo "<td class='table_persona'>" .$account['personaname'] . "</td>";
                echo "<td class='table_profile' onclick=\"window.open('" .$account['profileurl'] . "');\">" . $account['profileurl'] . "</td>";
                echo "<td onclick=\"login('" . $account['user'] . "');\">Login</td>";
                echo "</tr>\n";
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
                    self::$accounts[$i]['steamid'] = $account['steamID64'];
                    self::$accounts[$i]['username'] = $account['user'];
                    self::$accounts[$i]['avatarmedium'] = $player->avatarmedium;
                    self::$accounts[$i]['personaname'] = $player->personaname;
                    self::$accounts[$i]['profileurl'] = $player->profileurl;
                }
            }
        }
    }

}