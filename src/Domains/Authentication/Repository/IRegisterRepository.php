<?php

namespace Mehdi\ShortenerLink\Domains\Authentication\Repository;


interface IRegisterRepository
{
    public function createUser($username, $password) : int;
}