<?php

namespace Mehdi\ShortenerLink\Domains\Link\Services;

use Mehdi\ShortenerLink\Domains\Link\Repository\IUrlShortenerRepository;
use Mehdi\ShortenerLink\Domains\Link\Repository\UrlShortenerRepository;

class ConvertService
{
    private IUrlShortenerRepository $shortenerRepository;

    public function __construct()
    {
        $this->shortenerRepository = new UrlShortenerRepository();
    }

    public function convert($shortCode) : void
    {
        $urlEntity = $this->shortenerRepository->show($shortCode);
        $redirectUrl = $urlEntity->longUrl;

        header("Location: {$redirectUrl}");
    }
}