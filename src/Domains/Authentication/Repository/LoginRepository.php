<?php

namespace Mehdi\ShortenerLink\Domains\Authentication\Repository;

use Mehdi\Core\DB\DB;
use Mehdi\ShortenerLink\Entity\UserEntity;
use PDO;

class LoginRepository implements ILoginRepository
{

    public function getUser($username): UserEntity
    {
        $sth = DB::getConn()->prepare('SELECT * FROM `users` WHERE `username`=?');
        $sth->execute([$username]);

        $user = $sth->fetch(PDO::FETCH_ASSOC);

        $userEntity = new UserEntity();
        $userEntity->setAttributes($user);

        return $userEntity;
    }
}