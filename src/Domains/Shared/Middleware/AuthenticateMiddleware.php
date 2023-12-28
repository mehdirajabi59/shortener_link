<?php

namespace Mehdi\ShortenerLink\Domains\Shared\Middleware;

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Mehdi\Core\Auth\Auth;
use Mehdi\Core\Contract\MiddlewareInterface;
use Mehdi\Core\Contract\NextMiddleware;
use Mehdi\Core\Helpers\Config;
use Mehdi\Core\Request\Request;
use Mehdi\Core\Response\Json;
use Mehdi\Core\Response\Response;

class AuthenticateMiddleware implements MiddlewareInterface
{

    public function handle(Request $request, NextMiddleware $next): NextMiddleware|Json
    {
        $token = $request->header('HTTP_AUTHORIZATION');

        if (! str_starts_with($token, 'Bearer ')){
            return Response::json([
                'message' => 'Your token is invalid3'
            ], 401);
        }
        $token = str_replace('Bearer ', '', $token);

        try{

            $decoded = JWT::decode($token, new Key(Config::get('jwt.secret_key'), 'HS256'));

            Auth::login($decoded->user_id);

        }catch (SignatureInvalidException $signatureInvalidException) {
            return Response::json([
                'message' => 'Your token is invalid'
            ], 401);
        }catch (ExpiredException $expiredException) {
            return Response::json([
                'message' => 'Your token is expired'
            ], 401);
        }catch (\Exception $e){
            return Response::json([
                'message' => 'Your token is invalid',
                'e' => $e->getMessage()
            ], 401);
        }

        return $next;
    }
}