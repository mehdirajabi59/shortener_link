<?php

namespace Mehdi\ShortenerLink\Domains\Authentication\Repository;

use Mehdi\ShortenerLink\Entity\UserEntity;

interface ILoginRepository
{
    public function getUser($username) : UserEntity;
}