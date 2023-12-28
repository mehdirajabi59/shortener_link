<?php

namespace Mehdi\ShortenerLink\Domains\Authentication\Repository;

use Mehdi\Core\DB\DB;
use Mehdi\ShortenerLink\Entity\UserEntity;
use PDO;

class RegisterRepository implements IRegisterRepository
{

    public function isUserExists($username): bool
    {
        $sth = DB::getConn()->prepare('SELECT * FROM `users` WHERE `username`=?');
        $sth->execute([$username]);

        return !! $sth->fetch(PDO::FETCH_ASSOC);
    }
    public function createUser($username, $password): int
    {
        $conn = DB::getConn();
        $sth = DB::getConn()->prepare('INSERT INTO `users` (username, password) VALUES (:username, :password)');
        $sth->execute([
            ':username' => $username,
            ':password' => $password
        ]);

        return (int) $conn->lastInsertId();
    }
}