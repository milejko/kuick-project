<?php

use App\UI\HelloController;
use App\UI\PingController;
use Kuick\Framework\Config\RouteConfig;
use Kuick\Http\Message\JsonResponse;

// routing configuration
return [
    // Hello homepage
    new RouteConfig('/', HelloController::class),
    // Hello route with named name parameter
    new RouteConfig('/hello/(?<name>[a-zA-Z0-9-]+)', HelloController::class),
    // Ping route
    new RouteConfig('/ping', PingController::class, ['GET', 'POST']),
];
