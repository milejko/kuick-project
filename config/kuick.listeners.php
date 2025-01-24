<?php

/**
 * Kuick Project (https://github.com/milejko/kuick-project)
 *
 * @link       https://github.com/milejko/kuick-project
 * @copyright  Copyright (c) 2010-2025 Mariusz Miłejko (mariusz@milejko.pl)
 * @license    https://github.com/milejko/kuick-project?tab=MIT-1-ov-file#readme New BSD License
 */

use Kuick\Framework\Config\ListenerConfig;
use Kuick\Framework\Events\KernelCreatedEvent;
use Kuick\Framework\Events\RequestReceivedEvent;
use Kuick\Framework\Events\ResponseCreatedEvent;
use Kuick\Framework\Listeners\EventLoggingListener;
use Kuick\Framework\Listeners\LocalizingListener;
use Kuick\Framework\Listeners\RequestHandlingListener;
use Kuick\Framework\Listeners\ResponseEmittingListener;
use Kuick\EventDispatcher\ListenerPriority;

return [
    // logging all the events
    new ListenerConfig(
        '*',
        EventLoggingListener::class,
        ListenerPriority::HIGHEST
    ),
    // setup locale after kernel is created
    new ListenerConfig(
        KernelCreatedEvent::class,
        LocalizingListener::class,
        ListenerPriority::HIGHER
    ),
    // handle request when received
    new ListenerConfig(
        RequestReceivedEvent::class,
        RequestHandlingListener::class
    ),
    // emitt response when created
    new ListenerConfig(
        ResponseCreatedEvent::class,
        ResponseEmittingListener::class
    ),
];
