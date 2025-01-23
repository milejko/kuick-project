<?php

use App\Console\PingCommand;
use App\UI\PingController;

use function DI\autowire;

return [
    // performance tuning: autowiring all components
    PingCommand::class => autowire(),
    PingController::class => autowire(),
];