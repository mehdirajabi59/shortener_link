<?php

use Mehdi\Core\Router;

require __DIR__ .'/vendor/autoload.php';

$routers = [
    Router::init(
        path: '/{link}',controller: [\Mehdi\ShortenerLink\Domains\Link\Controller\UrlConvertorController::class, 'convert'],middlewares: [\Mehdi\ShortenerLink\Domains\Link\Middleware\TestMiddleware::class]
    ),
    Router::init(
        path: '/user/sign-in',controller: [\Mehdi\ShortenerLink\Domains\Authentication\Controller\LoginController::class, '__invoke']
    ),
];

$application = new \Mehdi\Core\Application(
    $routers,
    rtrim($_SERVER['PATH_INFO'], '/')
);

$application->run();

