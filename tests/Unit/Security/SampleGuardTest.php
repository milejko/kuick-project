<?php

namespace Tests\Kuick\Unit\Example\UI;

use App\Security\SampleGuard;
use Kuick\Http\HttpException;
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
        (new SampleGuard())(new ServerRequest('GET', '/ping', ['Authorization' => 'anything']));
        $this->assertTrue(true); // No exception should be thrown
    }

    public function testIfGuardBlocksUnauthorizedRequests(): void
    {
        $this->expectException(HttpException::class);
        (new SampleGuard())(new ServerRequest('GET', '/ping'));
    }
}
