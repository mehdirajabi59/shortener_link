<?php

require __DIR__ .'/vendor/autoload.php';

$pathInfo = rtrim($_SERVER['PATH_INFO'], '/');
$splitPath = explode('/', $pathInfo);

$routers = [
    '/{link}' => [\Mehdi\ShortenerLink\Domains\Link\Controller\UrlConvertorController::class, 'convert'],
    '/user/sign-in' => [\Mehdi\ShortenerLink\Domains\Authentication\Controller\LoginController::class, '__invoke']
];


foreach ($routers as $pattern => $controller) {

    $params = [];

    $splitPattern = explode('/', $pattern);

    if (count($splitPattern) === count($splitPath)) {
        if (isRouteMatch($splitPath, $splitPattern)) {
            $params = getParameters($splitPath, $splitPattern);

            $controllerInstance = new $controller[0];
            $res = call_user_func_array([$controllerInstance, $controller[1]], $params);

            if ($res instanceof \Mehdi\Core\Response\Json) {
                echo $res;
            }
        }
    }

}


function getParameters($splitPath, $splitPattern) {
    $params = [];
    for ($i=0; $i < count($splitPath); $i++) {
        if (preg_match('/^{.+}$/', $splitPattern[$i])) {
            array_push($params, $splitPath[$i]);
        }
    }

    return $params;
}
function isRouteMatch($splitPath, $splitPattern)
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