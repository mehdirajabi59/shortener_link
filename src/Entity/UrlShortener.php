<?php

namespace Mehdi\ShortenerLink\Entity;

class UrlShortener extends BaseEntity
{
    public int $id;
    public string $longUrl;
    public string $shortCode;
    public string $createdAt;
}