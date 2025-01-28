<?php

namespace Tests\Kuick\Unit\Example\UI;

use App\Security\SampleGuard;
use Kuick\Http\Message\JsonResponse;
use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

/**
 * @covers App\Security\SampleGuard
 */
class SampleGuardTest extends TestCase
{
    public function testIfGuardPassesRequestsWithAuthorizationHeader(): void
    {
        // null === passed
        $this->assertNull(
            (new SampleGuard())(new ServerRequest('GET', '/ping', ['Authorization' => 'anything']))
        );
    }

    public function testIfGuardBlocksUnauthorizedRequests(): void
    {
        $response = (new SampleGuard())(new ServerRequest('GET', '/ping'));
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals('{"error":"Unauthorized"}', $response->getBody()->getContents());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-type'));
        $this->assertEquals(401, $response->getStatusCode());
    }
}
