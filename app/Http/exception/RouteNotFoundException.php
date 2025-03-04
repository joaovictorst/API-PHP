<?php

namespace App\Http\Exception;

use Exception;
class RouteNotFoundException extends Exception {
    protected $message = 'Route not found.';
}