<?php

namespace Mehdi\ShortenerLink\Domains\Authentication\Services;

use Firebase\JWT\JWT;
use Mehdi\Core\Helpers\Config;
use Mehdi\ShortenerLink\Domains\Authentication\Repository\ILoginRepository;
use Mehdi\ShortenerLink\Domains\Authentication\Repository\LoginRepository;

class LoginService
{

    private ILoginRepository $loginRepository;

    private int $userId;

    public function __construct()
    {
        $this->loginRepository  = new LoginRepository();
    }

    public function canLogin($username, $password): bool
    {
        $user = $this->loginRepository->getUser($username);

        if (! $user->isEmpty()) {
            $this->userId = $user->getId();
        }

        return ! $user->isEmpty() && password_verify($password, $user->getPassword());
    }

    public function generateJWTToken($userId)
    {
        $payload = [
            'iss' => 'Shortener',
            'exp' => time() + 86400, // 1 day
            'user_id' => $userId
        ];

        return JWT::encode($payload, Config::get('jwt.secret_key'), 'HS256');
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}