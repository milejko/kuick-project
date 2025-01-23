<?php

/**
 * Kuick Framework (https://github.com/milejko/kuick-project)
 *
 * @link       https://github.com/milejko/kuick-project
 * @copyright  Copyright (c) 2010-2025 Mariusz Miłejko (mariusz@milejko.pl)
 * @license    https://github.com/milejko/kuick-project?tab=MIT-1-ov-file#readme New BSD License
 */

use App\UI\PingController;
use Kuick\Framework\Api\UI\DocHtmlController;
use Kuick\Framework\Api\UI\DocJsonController;
use Kuick\Framework\Config\RouteConfig;
use Kuick\Framework\Api\UI\OpsController;

return [
    // Homepage
    new RouteConfig('/', PingController::class),
    // Ping route with named name parameter
    new RouteConfig('/hello/(?<name>[a-zA-Z0-9-]+)', PingController::class),
    // OPS route gives some insight of server environment
    new RouteConfig('/api/ops', OpsController::class),
    // OpenAPI documentation
    new RouteConfig('/api/doc.json', DocJsonController::class),
    new RouteConfig('/api/doc', DocHtmlController::class),
];
