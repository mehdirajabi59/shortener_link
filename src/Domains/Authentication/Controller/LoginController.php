<?php

namespace Mehdi\ShortenerLink\Domains\Authentication\Controller;

use Mehdi\Core\Request\Request;
use Mehdi\Core\Response\Response;
use Mehdi\Core\Validator\Rules\Required;
use Mehdi\Core\Validator\Validator;
use Mehdi\ShortenerLink\Domains\Authentication\Services\LoginService;

class LoginController
{
    private LoginService $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();
    }

    public function __invoke()
    {
        $username = Request::input('username');
        $password = Request::input('password');

        $validator = Validator::make([
            'username' => new Required($username),
            'password' => new Required($password)
        ]);

        if (! $validator->validate()) {
            return Response::json($validator->getErrors(), 422);
        }

        if ($this->loginService->canLogin($username, $password)) {
            //Generate JWT Code

            return Response::json([
                'token' => $this->loginService->generateJWTToken($this->loginService->getUserId())
            ], 200);
        }else {
            return Response::json([
                'message' => [
                    'Your username or password is wrong',
                ]
            ], 401);
        }

    }
}