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
        return $request->getHeaderLine('Authorization') ?
            null :
            new JsonResponse(['error' => 'Unauthorized'], JsonResponse::HTTP_UNAUTHORIZED);
    }
}
