# Kuick Project
[![Latest Version](https://img.shields.io/github/release/milejko/kuick-project.svg?cacheSeconds=14400)](https://github.com/milejko/kuick-project-project/releases)
[![PHP](https://img.shields.io/badge/PHP-8.2%20|%208.3%20|%208.4-blue?logo=php&cacheSeconds=3600)](https://www.php.net)
[![Total Downloads](https://img.shields.io/packagist/dt/kuick/project.svg?cacheSeconds=14400)](https://packagist.org/packages/kuick/project)
[![CI](https://github.com/milejko/kuick-project/actions/workflows/ci.yml/badge.svg)](https://github.com/milejko/kuick-project/actions/workflows/ci.yml)
[![codecov](https://codecov.io/gh/milejko/kuick-project/graph/badge.svg?token=80QEBDHGPH)](https://codecov.io/gh/milejko/kuick-project)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?cacheSeconds=14400)](LICENSE)

Kuick project is an example application based on [Kuick Framework](https://github.com/milejko/kuick-framework)

## Key features
1. Ready to install package with sample controllers and commands
2. Dockerfile with targets to test, run and deploy the application

## Basic usage
1. With PHP and Composer run:
```
composer create-project kuick/project .
```
Alternatively you can just clone this repository.

2. Make sure to have Docker and Make installed

3. Use make to start the dev server
```
make up
```
Alternatively you can run the docker commands from the Makefile yourself:
```
docker build --target=dev-server --tag=kuick-project .
docker run --rm --name kuick-project -v ./:/var/www/html kuick-project composer install
docker run --rm --name kuick-project -v ./:/var/www/html -p 8080:80 -e APP_ENV=dev kuick-project
```

4. Now you have a local dev server running on 8080 port
The source code is directly mounted as a volume into the container, so changes are "live".

## Docker Demo
Ready to deploy images you can find on [Dockerhub](https://hub.docker.com/r/kuickphp/kuick/tags)

1. Run using Docker
```
docker run -p 8080:80 kuickphp/kuick
```
Now you can try it out by opening http://localhost:8080/<br>

2. Examine those sample routes:
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
With KUICK_OPS_GUARD_TOKEN defined, you can reach /api/ops endpoint:
```
curl -H "Authorization: Bearer secret-token" http://localhost:8080/api/ops
```
