<?php

use App\UI\HelloController;
use Kuick\Framework\Config\RouteConfig;

// routing configuration for dev environment only
return [
    // dev only page
    new RouteConfig('/dev-only', HelloController::class),
];
