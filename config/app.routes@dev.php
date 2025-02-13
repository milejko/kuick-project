<?php

use App\UI\PingController;
use Kuick\Framework\Config\RouteConfig;

// routing configuration for dev environment only
return [
    // dev only ping page
    new RouteConfig('/dev-only-ping', PingController::class),
];
