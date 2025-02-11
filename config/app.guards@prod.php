<?php

use App\Security\SampleGuard;
use Kuick\Framework\Config\GuardConfig;

// security configuration for prod environment only
return [
    // sample guard for / route (covering GET method)
    new GuardConfig('/', SampleGuard::class, ['GET']),
];
