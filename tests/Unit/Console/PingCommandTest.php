<?php

namespace Tests\Unit\App\Command;

use App\Console\PingCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * @covers App\Console\PingCommand
 */
class PingCommandTest extends TestCase
{
    public function testIfKuickSaysHello(): void
    {

        $hello = new PingCommand('ping');
        $output = new BufferedOutput();
        $hello->run(new ArgvInput([
            './bin/console',
            'hello',
        ]), $output);
        $this->assertEquals("Kuick says: Hello hello!\n", $output->fetch());
    }
}
