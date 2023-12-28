<?php

namespace Mehdi\Core;

class Router
{
    private string $path;
    private array $controller;
    private array $middlewares;
    private string $method;
    public static function init($method, $path, $controller, $middlewares = []): self
    {
        $router = new self;
        $router->path = $path;
        $router->controller = $controller;
        $router->middlewares = $middlewares;
        $router->method = $method;

        return $router;
    }

    public function getParameters($splitPath, $splitPattern) {
        $params = [];
        for ($i=0; $i < count($splitPath); $i++) {
            if (preg_match('/^{.+}$/', $splitPattern[$i])) {
                array_push($params, $splitPath[$i]);
            }
        }

        return $params;
    }

    public function isRouteMatch($splitPath, $splitPattern)
    {
        for ($i=0; $i < count($splitPath); $i++) {
            if (preg_match('/^\{.+\}$/', $splitPattern[$i])) {
                continue;
            }
            if ($splitPath[$i] !== $splitPattern[$i]) {
                return false;
            }
        }
        return true;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getClassController(): string
    {
        return $this->controller[0];
    }

    public function getMethodController(): string
    {
        return $this->controller[1];
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function getMethod(): string
    {
        return strtolower($this->method);
    }
}
