<?php

use App\Security\SampleGuard;
use Kuick\Framework\Config\GuardConfig;

// security configuration for prod environment only
return [
    // a sample guard for /ping (covering also GET)
    new GuardConfig('/ping', SampleGuard::class, ['GET']),
];
