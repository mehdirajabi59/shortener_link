<?php

namespace Mehdi\Core\Request;

class Request
{
    public static function input($name): string
    {
        return $_POST[$name] ?? '';
    }
}