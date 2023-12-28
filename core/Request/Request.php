<?php

namespace Mehdi\Core\Request;

class Request
{
    public static function input($name): string
    {
        $data = Input::getInputs();
        return $data[$name] ?? '';
    }
}