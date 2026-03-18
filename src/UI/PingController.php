<?php

namespace App\UI;

use Kuick\Http\Message\JsonResponse;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ServerRequestInterface;

#[OA\Get(
    path: '/ping',
    description: 'Ping the application',
    tags: ['App'],
    responses: [
        new OA\Response(
            response: JsonResponse::HTTP_OK,
            description: 'Pong response with request URI',
            content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string', example: 'pong'),
                new OA\Property(property: 'request-uri', type: 'string', example: '/ping'),
            ])
        ),
    ]
)]
#[OA\Post(
    path: '/ping',
    description: 'Ping the application (requires Authorization)',
    tags: ['App'],
    security: [['Bearer Token' => []]],
    responses: [
        new OA\Response(
            response: JsonResponse::HTTP_OK,
            description: 'Pong response with request URI',
            content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string', example: 'pong'),
                new OA\Property(property: 'request-uri', type: 'string', example: '/ping'),
            ])
        ),
        new OA\Response(
            response: JsonResponse::HTTP_UNAUTHORIZED,
            description: 'Authorization header is missing',
            content: new OA\JsonContent(properties: [
                new OA\Property(property: 'error', type: 'string'),
            ])
        ),
    ]
)]
class PingController
{
    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'pong',
            'request-uri' => $request->getUri()->getPath(),
        ]);
    }
}
