<?php

namespace Mehdi\Core\Response;

class Response
{
    public static function json(array $data, $statusCode = 200): Json
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($statusCode);

        return new Json($data);
    }
}