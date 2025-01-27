<?php

/**
 * Kuick Framework (https://github.com/milejko/kuick-project)
 *
 * @link       https://github.com/milejko/kuick-project
 * @copyright  Copyright (c) 2010-2025 Mariusz Miłejko (mariusz@milejko.pl)
 * @license    https://github.com/milejko/kuick-project?tab=MIT-1-ov-file#readme New BSD License
 */

namespace App\UI;

use Kuick\Http\Message\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class HelloController
{
    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        $name = $request->getQueryParams()['name'];
        $message = ['message' => 'Kuick says: hello ' . $name . '!'];
        return new JsonResponse($message);
    }
}
