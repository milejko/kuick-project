<?php

namespace Tests\Kuick\Unit\Security;

use App\Security\SampleGuard;
use Kuick\Http\HttpException;
use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(SampleGuard::class)]
class SampleGuardTest extends TestCase
{
    public function testIfGuardPassesRequestsWithAuthorizationHeader(): void
    {
        new SampleGuard()(new ServerRequest('GET', '/ping', ['Authorization' => 'anything']));
        $this->expectNotToPerformAssertions(); // No exception should be thrown
    }

    public function testIfGuardBlocksUnauthorizedRequests(): void
    {
        $this->expectException(HttpException::class);
        new SampleGuard()(new ServerRequest('GET', '/ping'));
    }
}
