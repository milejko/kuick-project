<?php

/**
 * Kuick Framework (https://github.com/milejko/kuick-project)
 *
 * @link       https://github.com/milejko/kuick-project
 * @copyright  Copyright (c) 2010-2026 Mariusz Miłejko (mariusz@milejko.pl)
 * @license    https://github.com/milejko/kuick-framework?tab=MIT-1-ov-file#readme New BSD License
 */

use function DI\env;

return [
    // OpenAPI documentation settings
    'api.openapi.title' => env('API_OPENAPI_TITLE', 'Kuick App API Documentation'),
    'api.openapi.description' => env('API_OPENAPI_DESCRIPTION', 'The OpenAPI documentation for this sample Kuick based application.'),
    'api.openapi.version' => env('API_OPENAPI_VERSION', '2.8.4'),
];