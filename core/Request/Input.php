<?php

namespace Mehdi\Core\Request;

class Input
{
    public static function getInputs(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        return array_merge($_POST, $data);
    }
}