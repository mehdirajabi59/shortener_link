<?php

require __DIR__ .'/vendor/autoload.php';

$application = new \Mehdi\Core\Application(
    require __DIR__ .'/src/routes.php',
    rtrim($_SERVER['PATH_INFO'], '/')
);

$application->run();

