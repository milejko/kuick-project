<?php

namespace Tests\Kuick\Unit\Example\UI;

use App\UI\PingController;
use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

/**
 * @covers App\UI\PingController
 */
class PingControllerTest extends TestCase
{
    public function testIfPingPongs(): void
    {
        $response = (new PingController())(new ServerRequest('GET', '/ping'));
        $this->assertEquals('{"message":"pong","request-uri":"\/ping"}', $response->getBody()->getContents());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-type'));
        $this->assertEquals(200, $response->getStatusCode());
    }
}
