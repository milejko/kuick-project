<?php

namespace Tests\Kuick\Unit\Example\UI;

use App\UI\HelloController;
use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

/**
 * @covers App\UI\HelloController
 */
class HelloControllerTest extends TestCase
{
    public function testIfKuickSaysHelloToTheWorld(): void
    {
        $response = (new HelloController())(new ServerRequest('GET', '/'));
        $this->assertEquals('{"message":"Kuick says: hello world!"}', $response->getBody()->getContents());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-type'));
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testIfKuickSaysHelloUsingName(): void
    {
        $response = (new HelloController())(new ServerRequest('GET', '/?name=John'));
        $this->assertEquals('{"message":"Kuick says: hello John!"}', $response->getBody()->getContents());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-type'));
        $this->assertEquals(200, $response->getStatusCode());
    }
}
