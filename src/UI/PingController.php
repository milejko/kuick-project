<?php

namespace App\UI;

use Kuick\Http\Message\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class PingController
{
    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'pong',
            'request-uri' => $request->getUri()->getPath(),
        ]);
    }
}
