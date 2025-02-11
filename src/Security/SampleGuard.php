<?php

namespace App\Security;

use Kuick\Http\Message\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Sample guard that requires any Authorization to pass
 */
class SampleGuard
{
    public function __invoke(ServerRequestInterface $request): ?JsonResponse
    {
        // if Authorization header is present, then the request is authorized
        if ($request->getHeaderLine('Authorization')) {
            return null;
        }
        // otherwise, return 401 Unauthorized
        return new JsonResponse(['error' => 'Unauthorized'], JsonResponse::HTTP_UNAUTHORIZED);
    }
}
