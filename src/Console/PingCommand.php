<?php

/**
 * Kuick Framework (https://github.com/milejko/kuick)
 *
 * @link       https://github.com/milejko/kuick
 * @copyright  Copyright (c) 2010-2025 Mariusz Miłejko (mariusz@milejko.pl)
 * @license    https://en.wikipedia.org/wiki/BSD_licenses New BSD License
 */

namespace App\Console;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:ping', description: 'Says hello')]
class PingCommand extends Command
{
    private const MESSAGE_TEMPLATE = 'Kuick says: Hello %s!';
    private const DEFAULT_NAME = 'my friend';

    protected function configure(): void
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = self::DEFAULT_NAME;
        if (is_string($input->getArgument('name'))) {
            $name = $input->getArgument('name');
        }
        $output->writeln(sprintf(self::MESSAGE_TEMPLATE, $name));
        return 0;
    }
}
