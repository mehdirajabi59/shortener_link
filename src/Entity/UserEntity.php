<?php

namespace Mehdi\ShortenerLink\Entity;

use Mehdi\Core\DB\BaseEntity;

class UserEntity extends BaseEntity
{
    public int $id;
    public string $username;
    public string $password;
    public string $createdAt;
}