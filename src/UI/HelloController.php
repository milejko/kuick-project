<?php

namespace App\UI;

use Kuick\Http\Message\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class HelloController
{
    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        $name = $request->getQueryParams()['name'] ?? 'world';
        return new JsonResponse([
            'message' => 'Kuick says: hello ' . $name . '!'
        ]);
    }
}
