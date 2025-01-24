<?php

/**
 * Kuick Project (https://github.com/milejko/kuick-project)
 *
 * @link       https://github.com/milejko/kuick-project
 * @copyright  Copyright (c) 2010-2025 Mariusz Miłejko (mariusz@milejko.pl)
 * @license    https://github.com/milejko/kuick-project?tab=MIT-1-ov-file#readme New BSD License
 */

use Kuick\Framework\Events\RequestReceivedEvent;
use Kuick\Framework\Kernel;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

$projectDir = dirname(__DIR__);
require $projectDir . '/vendor/autoload.php';

// Using .env loader is not recommended from the performance perspective
// uncomment the line below if you really want to use it
// Kuick\Dotenv\DotEnvLoader::fromDirectory($projectDir);

$psr17Factory = new Psr17Factory();

$request = (new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory, // StreamFactory
))->fromGlobals();

(new Kernel($projectDir))->getEventDispatcher()->dispatch(new RequestReceivedEvent($request));
