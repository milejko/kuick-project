# Kuick Project
[![Latest Version](https://img.shields.io/github/release/milejko/kuick-project.svg?cacheSeconds=14400)](https://github.com/milejko/kuick-project-project/releases)
[![PHP](https://img.shields.io/badge/PHP-8.2%20|%208.3%20|%208.4-blue?logo=php&cacheSeconds=3600)](https://www.php.net)
[![Total Downloads](https://img.shields.io/packagist/dt/kuick/project.svg?cacheSeconds=14400)](https://packagist.org/packages/kuick/project)
[![CI](https://github.com/milejko/kuick-project/actions/workflows/ci.yml/badge.svg)](https://github.com/milejko/kuick-project/actions/workflows/ci.yml)
[![codecov](https://codecov.io/gh/milejko/kuick-project/graph/badge.svg?token=80QEBDHGPH)](https://codecov.io/gh/milejko/kuick-project)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?cacheSeconds=14400)](LICENSE)

Kuick project is an example application based on [Kuick Framework](https://github.com/milejko/kuick-framework)

## Key features
1. Logging realized with PSR-3 Logger Interface implementation
2. Integrated PSR-7 HTTP message interface
3. PSR-11 Container
4. Implemented Event Dispatcher compatible with [PSR-14](https://github.com/milejko/kuick-event-dispatcher)
4. Request handling compatible with [PSR-15](https://github.com/milejko/kuick-http)
5. [PSR-16 Caching](https://github.com/milejko/kuick-cache)

## Basic usage
Use composer to create this project
```
composer create-project kuick/project
```

## Usage (Docker)
Ready to deploy images you can find here: https://hub.docker.com/r/kuickphp/kuick/tags

1. Run using Docker
This example utilizes the smallest, Alpine distribution.
```
docker run -p 8080:80 kuickphp/kuick:alpine
```
Now you can try it out by opening http://localhost:8080/<br>

2. Examine sample routes:
- Homepage:
```
curl http://localhost:8080/
```
- Hello/ping:
```
curl http://localhost:8080/hello/John
```

3. Container runtime configuration:
- dev mode enabled
- custom app name
- custom localization (charset, locale, timezone)
- DEBUG log with microtime
- custom OPS API token
```
docker run -p 8080:80 \
    -e APP_ENV=dev \
    -e KUICK_APP_NAME=ExampleApp \
    -e KUICK_APP_CHARSET=UTF-8 \
    -e KUICK_APP_LOCALE=pl_PL.utf-8 \
    -e KUICK_APP_TIMEZONE="Europe/Warsaw" \
    -e KUICK_APP_MONOLOG.USEMICROSECONDS=1 \
    -e KUICK_APP_MONOLOG_LEVEL=DEBUG \
    -e KUICK_OPS_GUARD_TOKEN=secret-token \
    kuickphp/kuick:alpine
```
OPS endpoint:
```
curl -H "Authorization: Bearer secret-token" http://localhost:8080/api/ops
```
