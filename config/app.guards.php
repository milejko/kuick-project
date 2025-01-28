<?php

use App\Security\SampleGuard;
use Kuick\Framework\Config\GuardConfig;
use Kuick\Http\Message\JsonResponse;

// security configuration
return [
    // sample guard for /ping route (covering GET method)
    new GuardConfig('/ping', SampleGuard::class, ['GET']),
    // an inline guard for /ping route (covering POST, PUT, PATCH, DELETE methods)
    new GuardConfig(
        '/ping',
        function (): ?JsonResponse {
            return new JsonResponse(['error' => 'Forbidden'], JsonResponse::HTTP_FORBIDDEN);
        },
        ['POST', 'PUT', 'PATCH', 'DELETE']
    ),
];
