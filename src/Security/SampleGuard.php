<?php

namespace App\Security;

use Kuick\Http\HttpException;
use Kuick\Http\Message\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Sample guard that requires any Authorization to pass
 */
class SampleGuard
{
    public function __invoke(ServerRequestInterface $request): void
    {
        // if Authorization header is present, then the request is authorized
        if ($request->getHeaderLine('Authorization')) {
            return;
        }
        throw new HttpException(JsonResponse::HTTP_UNAUTHORIZED, 'Unauthorized request');
    }
}
