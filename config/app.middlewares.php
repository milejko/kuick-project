<?php

// use Kuick\Framework\Config\MiddlewareConfig;

// middleware configuration
return [
    //new MiddlewareConfig(SomeMiddleware::class),

    //note that the second parameter is optional
    //it allows to specify that this middleware should be executed before another one
    //for example, if you have a middleware that requires authentication, you can specify that it
    //should be executed before the routing middleware
    //new MiddlewareConfig(RoutingMiddleware::class, SecurityMiddleware::class),

    //new MiddlewareConfig(AnotherMiddleware::class, PutThatMiddlewareBeforeThisOne::class),
];