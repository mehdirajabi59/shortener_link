<?php

namespace Mehdi\ShortenerLink\Domains\Link\Middleware;

use Mehdi\Core\Contract\MiddlewareInterface;
use Mehdi\Core\Contract\NextMiddleware;
use Mehdi\Core\Request\Request;
use Mehdi\Core\Response\Json;

class TestMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, NextMiddleware $next): NextMiddleware|Json
    {
        return $next;
    }
}