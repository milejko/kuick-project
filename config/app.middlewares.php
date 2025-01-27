<?php

/**
 * Kuick Project (https://github.com/milejko/kuick-project)
 *
 * @link       https://github.com/milejko/kuick-project
 * @copyright  Copyright (c) 2010-2025 Mariusz Miłejko (mariusz@milejko.pl)
 * @license    https://github.com/milejko/kuick-project?tab=MIT-1-ov-file#readme New BSD License
 */

use Kuick\Routing\RoutingMiddleware;
use Kuick\Security\SecurityMiddleware;

// middleware configuration
return [
    // security middleware
    SecurityMiddleware::class,
    // routing middleware
    RoutingMiddleware::class,
];