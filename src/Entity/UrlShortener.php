<?php

namespace Mehdi\ShortenerLink\Entity;

use Mehdi\Core\DB\BaseEntity;

class UrlShortener extends BaseEntity
{
    public int $id;
    public string $longUrl;
    public string $shortCode;
    public string $createdAt;
}