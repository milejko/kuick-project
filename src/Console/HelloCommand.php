<?php

/**
 * Kuick Project (https://github.com/milejko/kuick-project)
 *
 * @link       https://github.com/milejko/kuick-project
 * @copyright  Copyright (c) 2010-2025 Mariusz Miłejko (mariusz@milejko.pl)
 * @license    https://github.com/milejko/kuick-project?tab=MIT-1-ov-file#readme New BSD License
 */

namespace App\Console;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:hello', description: 'Says hello')]
class HelloCommand extends Command
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
