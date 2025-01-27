<?php

namespace Tests\Unit\App\Command;

use App\Console\HelloCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * @covers App\Console\HelloCommand
 */
class HelloCommandTest extends TestCase
{
    public function testIfKuickSaysHello(): void
    {

        $hello = new HelloCommand('hello');
        $output = new BufferedOutput();
        $hello->run(new ArgvInput([
            './bin/console',
            'hello',
        ]), $output);
        $this->assertEquals("Kuick says: Hello hello!\n", $output->fetch());
    }
}
