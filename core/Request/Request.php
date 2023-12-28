<?php

namespace Mehdi\Core\Request;

class Request
{
    public static function input($name): string
    {
        $data = Input::getInputs();
        return $data[$name] ?? '';
    }

    public function header($name)
    {
        return $_SERVER[$name] ?? '';
    }
}