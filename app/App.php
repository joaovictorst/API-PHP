<?php

namespace App;

use App\Http\Controllers\UserController;
use App\Router;
class App {

    private static $Router;
    private $container;

    public function __construct() {
       self::$Router = new Router();

       require __DIR__ . './../routes/Web.php';
       
    }
    public function handleRequest() {   
        $url = $_SERVER['REQUEST_URI'];
        self::$Router->dispatch($url);
    }

    public function getRoute(){
        return self::$Router->getRoutes();
    }
}