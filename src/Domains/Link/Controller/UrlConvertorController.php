<?php

namespace Mehdi\ShortenerLink\Domains\Link\Controller;

use Mehdi\Core\Response\Json;
use Mehdi\Core\Response\Response;
use Mehdi\Core\Validator\Validator;
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
        $validator = Validator::make([
            new ShortCodeExistsValidator($path)
        ]);

        if (! $validator->validate()) {
            return Response::json([
                'message' => $validator->getErrors()
            ], 422);
        }

        $this->convertService->convert($path);
    }
}