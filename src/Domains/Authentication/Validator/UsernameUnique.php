<?php

namespace Mehdi\ShortenerLink\Domains\Authentication\Validator;

use Mehdi\Core\DB\DB;
use Mehdi\Core\Validator\ValidatorInterface;
use PDO;

class UsernameUnique implements ValidatorInterface
{
    private string $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function passes(): bool
    {
        $sth = DB::getConn()->prepare('SELECT id FROM `users` WHERE `username`=?');
        $sth->execute([$this->value]);

        return ! $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function message($name): string
    {
        return "Your {$name} is exists!";
    }
}