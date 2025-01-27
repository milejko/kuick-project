<?php

/**
 * Kuick Project (https://github.com/milejko/kuick-project)
 *
 * @link       https://github.com/milejko/kuick-project
 * @copyright  Copyright (c) 2010-2025 Mariusz Miłejko (mariusz@milejko.pl)
 * @license    https://github.com/milejko/kuick-project?tab=MIT-1-ov-file#readme New BSD License
 */

use App\UI\HelloController;
use Kuick\Framework\Config\RouteConfig;
use Kuick\Http\Message\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

// route configuration
return [
    // Homepage (inline route)
    new RouteConfig(
        '/',
        function (): JsonResponse {
            return new JsonResponse(['message' => 'Kuick says: hello world!']);
        },
        //['GET', 'OPTIONS']
    ),
    // Hello route with named name parameter
    new RouteConfig(
        '/hello/(?<name>[a-zA-Z0-9-]+)',
        HelloController::class
    ),
    // Sample inline route
    new RouteConfig(
        '/ping',
        function (ServerRequestInterface $request): JsonResponse {
            return new JsonResponse([
                'message' => 'pong',
                'request-uri' => $request->getUri()->getPath(),
            ]);
        }
    ),
];
