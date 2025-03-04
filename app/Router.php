<?php

namespace App;

require __DIR__ . "/../vendor/autoload.php";

class Router
{
    private static array $routes = [];

    private static function addRoute($method, $route, $action)
    {
        self::$routes[] = [
            'METHOD' => $method,
            'ROUTE' => self::treatRoute($route),
            'ACTION' => explode('@', $action)
        ];
    }

    public static function get($route, $action)
    {
        self::addRoute(Request::METHOD_GET, $route, $action);
    }

    public static function put($route, $action)
    {
        self::addRoute(Request::METHOD_PUT, $route, $action);
    }

    public static function post($route, $action)
    {
        self::addRoute(Request::METHOD_GET, $route, $action);
    }

    public static function delete($route, $action)
    {
        self::addRoute(Request::METHOD_GET, $route, $action);
    }

    public function dispatch($url)
    {
        self::verifyRoute($this->treatRoute($url), self::$routes);
    }

    public function getRoutes(): array
    {
        return $this::$routes;
    }

    protected static function treatRoute($uri)
    {
        if (str_ends_with($uri, "/")) {
            return $uri;
        }
        $uri .= "/";
        return $uri;
    }

    private static function verifyRoute($url, $routes)
    {
        $routeFound = false;
        foreach ($routes as $route) {
            $regex = '/\{([\w]+)\}/';
            $pattern = preg_replace($regex, '([\w\.-]+)', $route['ROUTE']);
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = '/^' . $pattern . '$/';

            if (preg_match($pattern, $url, $matches)) {

                $routeFound = true;

                [$class, $method] = $route['ACTION'];

                array_shift($matches);

                try {
                    $instance = new $class();
                    $instance->$method(...$matches);
                } catch (\ArgumentCountError $th) {

                    var_dump($th);
                } catch (\Throwable $th) {
                    var_dump($th);
                }
            }
        }

        if(!$routeFound){
            print_r(json_encode([
                'ERROR' => "ROUTE NOT FOUND"
            ]));
        }
    }
}