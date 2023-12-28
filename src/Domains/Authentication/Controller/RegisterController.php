<?php

namespace Mehdi\ShortenerLink\Domains\Authentication\Controller;

use Mehdi\Core\Request\Request;
use Mehdi\Core\Response\Response;
use Mehdi\Core\Validator\Rules\Required;
use Mehdi\Core\Validator\Validator;
use Mehdi\ShortenerLink\Domains\Authentication\Services\LoginService;
use Mehdi\ShortenerLink\Domains\Authentication\Services\RegisterService;
use Mehdi\ShortenerLink\Domains\Authentication\Validator\UsernameUnique;

class RegisterController
{
    private RegisterService $registerService;

    public function __construct()
    {
        $this->registerService = new RegisterService();
    }
    public function __invoke()
    {

        $username = Request::input('username');
        $password = Request::input('password');

        $validator = Validator::make([
            'username' => new UsernameUnique($username),
            'password' => new Required($password)
        ]);

        if (! $validator->validate()) {
            return Response::json($validator->getErrors(), 422);
        }

        if ($this->registerService->register($username, $password)) {
            //Generate JWT Code

            return Response::json([
                'token' => $this->registerService->generateJWTToken($this->registerService->getUserId())
            ], 201);
        }

    }
}