<?php

namespace Mehdi\ShortenerLink\Domains\Link\Validators;

use Mehdi\Core\DB\DB;

class ShortCodeExistsValidator implements ValidatorInterface
{

    public function passes($value): bool
    {
        if (empty($value)) {
            return false;
        }

        $sth = DB::getConn()->prepare('SELECT id FROM `url_shortener` WHERE `short_code` = ?');
        $sth->execute([$value]);

        return !! $sth->fetch();
    }

    public function message(): string
    {
        return 'Your Short Code Is Not Exists';
    }
}