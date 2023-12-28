<?php

namespace Mehdi\ShortenerLink\Domains\Link\Controller;

use Mehdi\Core\Auth\Auth;
use Mehdi\Core\Request\Request;
use Mehdi\Core\Response\Response;
use Mehdi\Core\Validator\Rules\Required;
use Mehdi\Core\Validator\Rules\UrlValidator;
use Mehdi\Core\Validator\Validator;
use Mehdi\ShortenerLink\Domains\Link\Repository\UrlRepository;
use Mehdi\ShortenerLink\Domains\Link\Services\StoreUrlService;

class UrlController
{
    private StoreUrlService $storeUrlService;
    public function __construct()
    {
        $this->storeUrlService = new StoreUrlService(new UrlRepository());
    }

    public function index()
    {
        $all = $this->storeUrlService->all(Auth::getId());
        return Response::json($all);
    }
    public function create()
    {
        $url = Request::input('url');

        $validator = Validator::make([
            'url' => new UrlValidator($url)
        ]);

        if (! $validator->validate()){
            return Response::json($validator->getErrors(), 422);
        }

        $this->storeUrlService->create($url, Auth::getId());
        return Response::json([
            'message' => 'Your url saved successfully'
        ], 201);

    }
    public function delete($shortCode)
    {

        if (! $this->storeUrlService->delete($shortCode, Auth::getId())) {
            return Response::json([
                'message' => 'Your Short Code Is Not Exists!'
            ], 404);
        }else {
            return Response::json([
                'message' => 'Your Short Code Deleted Successfully'
            ], 200);
        }

    }
}