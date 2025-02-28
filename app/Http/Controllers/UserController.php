<?php

namespace App\Http\Controllers;

class UserController
{

    public function profile($uuid, $gameId = null)
    {
        exit(json_encode(["message" => "olá, você chegou!", "uuid" => $uuid, "GameID" => $gameId]));
    }
}
