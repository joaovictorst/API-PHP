<?php

namespace Routes;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Router;

Router::get( '/', HomeController::class . '@profile');
Router::get( '/user/{uuid}', UserController::class . '@profile');
Router::get( '/user/{uuid}/game/{game_id}', UserController::class . '@profile');



// '/joao/755/joaovictorst'

// $params["uuid"] = 755;
