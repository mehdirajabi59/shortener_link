<?php

namespace Mehdi\Core\Helpers;

use JetBrains\PhpStorm\NoReturn;

class Route
{
    #[NoReturn] public static function redirect($url): void
    {
        header("Location: {$url}");
        exit();
    }
}