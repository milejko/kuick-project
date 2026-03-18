<?php

namespace App\UI;

use Kuick\Http\Message\JsonResponse;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ServerRequestInterface;

#[OA\Get(
    path: '/',
    description: 'Returns a hello world greeting',
    tags: ['App'],
    responses: [
        new OA\Response(
            response: JsonResponse::HTTP_OK,
            description: 'Greeting message',
            content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string', example: 'Kuick says: hello world!'),
            ])
        ),
    ]
)]
#[OA\Get(
    path: '/hello/{name}',
    description: 'Returns a personalised hello greeting',
    tags: ['App'],
    parameters: [
        new OA\PathParameter(name: 'name', description: 'Name to greet', required: true, schema: new OA\Schema(type: 'string')),
    ],
    responses: [
        new OA\Response(
            response: JsonResponse::HTTP_OK,
            description: 'Personalised greeting message',
            content: new OA\JsonContent(properties: [
                new OA\Property(property: 'message', type: 'string', example: 'Kuick says: hello John!'),
            ])
        ),
    ]
)]
class HelloController
{
    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        $name = $request->getQueryParams()['name'] ?? 'world';
        return new JsonResponse(['message' => "Kuick says: hello $name!"]);
    }
}
