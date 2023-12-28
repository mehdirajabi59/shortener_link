<?php

namespace Mehdi\Core\Auth;

class Auth
{
    private static int $id;

    public static function login($id): void
    {
        static::$id = $id;
    }
    public static function getId(): int
    {
        return static::$id;
    }
}