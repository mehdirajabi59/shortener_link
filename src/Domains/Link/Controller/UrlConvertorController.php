<?php

namespace Mehdi\ShortenerLink\Domains\Link\Controller;

use Mehdi\ShortenerLink\Domains\Link\Services\ConvertService;

class UrlConvertorController
{
    private ConvertService $convertService;
    function __construct()
    {
        $this->convertService = new ConvertService();
    }
    public function convert($path): void
    {
        echo $path . '<br>';
        $path = 'url-short-test-aparat-active-link';

        echo $this->convertService->convert($path);
    }
}