<?php

use App\Security\SampleGuard;
use Kuick\Framework\Config\GuardConfig;
use Kuick\Http\Message\JsonResponse;

// security configuration
return [
    // sample guard for /ping route (covering GET method)
    new GuardConfig('/ping', SampleGuard::class, ['GET']),
    // a sample guard for /ping route (covering POST, PUT, PATCH, DELETE methods)
    new GuardConfig('/ping', SampleGuard::class, ['POST', 'PUT', 'PATCH', 'DELETE']),
];
