<?php

namespace Core;

class SteamAPI {

    public static $account;

    /**
     *  constructor function
     */
    public function __construct($steamId)
    {
        $apiLink = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . STEAM_KEY . "&steamids=" . $steamId;
        $apiData = file_get_contents($apiLink);
        $apiData = json_decode($apiData);
        
        foreach($apiData->response->players[0] as $k => $v)
        {
            self::$account[$k] = $v;
        }
    }

    /**
     *  get data from the api request
     */
    public static function getData($key)
    {
        if(isset(self::$account[$k]))
        {
            return self::$account[$k];
        }

        return "undefined";
    }


}