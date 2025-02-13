<?php

use App\Security\SampleGuard;
use Kuick\Framework\Config\GuardConfig;

// security configuration
return [
    // a sample guard for /ping (covering POST, PUT, PATCH, DELETE method)
    new GuardConfig('/ping', SampleGuard::class, ['POST']),
];
