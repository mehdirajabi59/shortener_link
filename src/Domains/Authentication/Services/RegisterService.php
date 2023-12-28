<?php

namespace Mehdi\ShortenerLink\Domains\Authentication\Services;

use Firebase\JWT\JWT;
use Mehdi\Core\Helpers\Config;
use Mehdi\ShortenerLink\Domains\Authentication\Repository\ILoginRepository;
use Mehdi\ShortenerLink\Domains\Authentication\Repository\IRegisterRepository;
use Mehdi\ShortenerLink\Domains\Authentication\Repository\LoginRepository;
use Mehdi\ShortenerLink\Domains\Authentication\Repository\RegisterRepository;

class RegisterService
{

    private IRegisterRepository $registerRepository;

    private int $userId;

    public function __construct()
    {
        $this->registerRepository  = new RegisterRepository();
    }

    public function register($username, $password): bool
    {
        $userId = $this->registerRepository->createUser($username, password_hash($password, PASSWORD_BCRYPT));

        if ($userId) {
            $this->userId = $userId;
        }

        return $userId;
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