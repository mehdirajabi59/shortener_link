<?php

namespace Mehdi\ShortenerLink\Domains\Link\Controller;

use Mehdi\Core\Response\Json;
use Mehdi\Core\Response\Response;
use Mehdi\ShortenerLink\Domains\Link\Services\ConvertService;
use Mehdi\ShortenerLink\Domains\Link\Validators\ShortCodeExistsValidator;

class UrlConvertorController
{
    private ConvertService $convertService;
    function __construct()
    {
        $this->convertService = new ConvertService();
    }
    public function convert($path): ?Json
    {
        $shortCodeValidator = new ShortCodeExistsValidator;
        if (! $shortCodeValidator->passes($path)) {
            return Response::json([
                'message' => $shortCodeValidator->message()
            ], 422);
        }

        $this->convertService->convert($path);
    }
}