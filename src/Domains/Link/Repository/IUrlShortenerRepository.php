<?php

namespace Mehdi\ShortenerLink\Domains\Link\Repository;

use Mehdi\ShortenerLink\Entity\UrlShortener;

interface IUrlShortenerRepository
{
    public function show(string $shortCode): UrlShortener;
}