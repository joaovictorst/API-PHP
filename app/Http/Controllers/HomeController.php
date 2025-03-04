<?php

namespace App\Http\Controllers;

class HomeController {

    private  $homeArray = [
        'message' => "BEM VINDO AO HOME DA API ",
        'stats' => "200"
    ];
    
    public function profile() {
        
        print_r(json_encode($this->homeArray));
    }
}