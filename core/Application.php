<?php

namespace Mehdi\Core;

use Mehdi\Core\Contract\MiddlewareInterface;
use Mehdi\Core\Contract\NextMiddleware;
use Mehdi\Core\Request\Request;
use Mehdi\Core\Response\Json;
use Mehdi\Core\Response\Response;

class Application
{
    private $routes;
    private $splitCurrentPath;
    public function __construct(array $routes, string $currentPath)
    {
        $this->routes = $routes;
        $this->splitCurrentPath = explode('/', $currentPath);
    }

    public function run(): void
    {
        foreach ($this->routes as $routeInstance) {

            $params = [];

            $methodName = strtolower($_SERVER['REQUEST_METHOD']);
            $splitPattern = explode('/', $routeInstance->getPath());

            if (count($splitPattern) === count($this->splitCurrentPath) && $methodName === $routeInstance->getMethod()) {
                if ($routeInstance->isRouteMatch($this->splitCurrentPath, $splitPattern)) {

                    $middlewares = $routeInstance->getMiddlewares();

                    foreach ($middlewares as $middleware) {
                        $middlewareInstance = new $middleware;
                        if ($middlewareInstance instanceof MiddlewareInterface) {
                            $res = $middlewareInstance->handle(new Request(), new NextMiddleware());
                            if ($res instanceof Json) {
                                echo $res;
                                return;
                            }
                        }
                    }

                    $params = $routeInstance->getParameters($this->splitCurrentPath, $splitPattern);

                    $controllerClassName = $routeInstance->getClassController();
                    $controllerInstance = new $controllerClassName();
                    $res = call_user_func_array([$controllerInstance, $routeInstance->getMethodController()], $params);

                    if ($res instanceof Json) {
                        echo $res;
                    }
                }
            }

        }
    }




}