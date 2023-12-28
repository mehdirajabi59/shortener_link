<?php

namespace Mehdi\ShortenerLink\Domains\Link\Validators;

use Mehdi\Core\DB\DB;
use Mehdi\Core\Validator\ValidatorInterface;

class ShortCodeExistsValidator implements ValidatorInterface
{
    private $value;
    public function passes(): bool
    {
        if (empty($this->value)) {
            return false;
        }

        $sth = DB::getConn()->prepare('SELECT id FROM `url_shortener` WHERE `short_code` = ?');
        $sth->execute([$this->value]);

        return !! $sth->fetch();
    }

    public function message($name): string
    {
        return "Your {$name} Is Not Exists";
    }

    public function __construct($value)
    {
        $this->value = $value;
    }
}