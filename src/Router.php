<?php

namespace PHPAdvanced;

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;

class Router
{
    private $routes = [];

    public function addRoute(string $route, array $handler)
    {
        $this->routes[] = ['GET', $route, $handler];
    }

    public function dispatch(string $uri)
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $r) {
            foreach ($this->routes as $route) {
                $r->addRoute(...$route);
            }
        });

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                header("HTTP/1.0 404 Not Found");
                echo '404 Not Found';
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                header("HTTP/1.0 405 Method Not Allowed");
                echo '405 Method Not Allowed';
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                //Call controller method dynamically
                $controllerName = $handler[0];
                $methodName = $handler[1];

                $controller = new $controllerName();
                $controller->$methodName($vars);
                break;
        }
    }
}

