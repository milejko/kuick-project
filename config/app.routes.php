<?php

use App\UI\HelloController;
use App\UI\PingController;
use Kuick\Framework\Config\RouteConfig;

// routing configuration
return [
    // Hello homepage
    new RouteConfig('/', HelloController::class),
    // Hello route with named name parameter
    new RouteConfig('/hello/(?<name>[a-zA-Z0-9-]+)', HelloController::class),
    // Ping route supporting GET and POST methods
    new RouteConfig('/ping', PingController::class, ['GET', 'POST']),
];
