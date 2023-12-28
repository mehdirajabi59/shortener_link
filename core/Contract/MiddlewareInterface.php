<?php

namespace Mehdi\Core\Contract;

use Mehdi\Core\Request\Request;
use Mehdi\Core\Response\Json;

interface MiddlewareInterface
{
    public function handle(Request $request, NextMiddleware $next): NextMiddleware|Json;
}