<?php

/**
 * Kuick Framework (https://github.com/milejko/kuick-project)
 *
 * @link       https://github.com/milejko/kuick-project
 * @copyright  Copyright (c) 2010-2025 Mariusz Miłejko (mariusz@milejko.pl)
 * @license    https://github.com/milejko/kuick-project?tab=MIT-1-ov-file#readme New BSD License
 */

use Kuick\Framework\Middlewares\OptionsSendingMiddleware;
use Kuick\Routing\RoutingMiddleware;
use Kuick\Security\SecurityMiddleware;

return [
    // default 204 for OPTIONS    
    OptionsSendingMiddleware::class,
    // security middleware
    SecurityMiddleware::class,
    // routing middleware
    RoutingMiddleware::class,
];