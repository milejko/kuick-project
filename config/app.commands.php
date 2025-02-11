<?php

use App\Console\HelloCommand;
use Kuick\Framework\Config\CommandConfig;

// command configuration
return [
    // Sample command
    new CommandConfig('app:hello', HelloCommand::class, 'Says hello to you'),
];