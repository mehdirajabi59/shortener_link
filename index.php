<?php

use Mehdi\Core\Router;

require __DIR__ .'/vendor/autoload.php';

$routers = [
    Router::init(
        'GET',
        '/{link}',
        [\Mehdi\ShortenerLink\Domains\Link\Controller\UrlConvertorController::class, 'convert']
    ),
    Router::init(
        'POST',
        '/user/sign-in',
        [\Mehdi\ShortenerLink\Domains\Authentication\Controller\LoginController::class, '__invoke']
    ),
    // Access below route with token
    Router::init(
        'POST',
        '/user/urls',
        [\Mehdi\ShortenerLink\Domains\Link\Controller\UrlController::class, 'create'],
        [\Mehdi\ShortenerLink\Domains\Shared\Middleware\AuthenticateMiddleware::class]
    ),
    Router::init(
        'DELETE',
        '/user/urls/{shortCode}',
        [\Mehdi\ShortenerLink\Domains\Link\Controller\UrlController::class, 'delete'],
        [\Mehdi\ShortenerLink\Domains\Shared\Middleware\AuthenticateMiddleware::class]
    ),
    Router::init(
        'GET',
        '/user/urls/all',
        [\Mehdi\ShortenerLink\Domains\Link\Controller\UrlController::class, 'index'],
        [\Mehdi\ShortenerLink\Domains\Shared\Middleware\AuthenticateMiddleware::class]
    )
];

$application = new \Mehdi\Core\Application(
    $routers,
    rtrim($_SERVER['PATH_INFO'], '/')
);

$application->run();

