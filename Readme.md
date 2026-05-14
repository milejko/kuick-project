# Kuick Project

[![Latest Version](https://img.shields.io/github/release/milejko/kuick-project.svg?cacheSeconds=14400)](https://github.com/milejko/kuick-project/releases)
[![PHP](https://img.shields.io/badge/PHP-8.3%20|%208.4%20|%208.5-blue?logo=php&cacheSeconds=3600)](https://www.php.net)
[![Total Downloads](https://img.shields.io/packagist/dt/kuick/project.svg?cacheSeconds=14400)](https://packagist.org/packages/kuick/project)
[![CI](https://github.com/milejko/kuick-project/actions/workflows/ci.yml/badge.svg)](https://github.com/milejko/kuick-project/actions/workflows/ci.yml)
[![codecov](https://codecov.io/gh/milejko/kuick-project/graph/badge.svg?token=80QEBDHGPH)](https://codecov.io/gh/milejko/kuick-project)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?cacheSeconds=14400)](LICENSE)

A skeleton application built on top of [Kuick Framework](https://github.com/milejko/kuick-framework) — get a working PHP app with routing, console commands, DI, and Docker support in minutes.

## Features

- 📦 Ready-to-use project structure with sample controllers and console commands
- 🐳 Dockerfile with `dev-server`, `test`, and production targets
- 🔒 Guard-based security (e.g. bearer token for `/api/ops`)
- 🧪 PHPUnit, PHPStan (level 9), PHPMD, and PSR-12 checks out of the box

## Quick Start

### Option A — Composer create-project

```bash
composer create-project kuick/project my-app
cd my-app
```

### Option B — Clone the repository

```bash
git clone https://github.com/milejko/kuick-project.git my-app
cd my-app
```

### Start the dev server (Docker + Make)

```bash
make up
```

The app will be available at **http://localhost:8080**. Source code is mounted as a volume, so changes are reflected immediately — no rebuild needed.

> **Manual Docker equivalent:**
> ```bash
> docker build --target=dev-server --tag=kuick-project .
> docker run --rm --name kuick-project -v ./:/var/www/html kuick-project composer install
> docker run --rm --name kuick-project -v ./:/var/www/html -p 8080:80 -e APP_ENV=dev kuick-project
> ```

## Sample Routes

| Method | Path | Description |
|--------|------|-------------|
| GET | `/` | Homepage (Hello World) |
| GET | `/hello/{name}` | Greeting with name |
| GET, POST | `/ping` | Ping endpoint |
| GET | `/api/ops` | OPS/health info (requires bearer token in prod) |

```bash
curl http://localhost:8080/
curl http://localhost:8080/hello/John
curl http://localhost:8080/ping
```

## Docker Demo (pre-built image)

Pull and run the ready-to-go image from [Docker Hub](https://hub.docker.com/r/kuickphp/kuick/tags):

```bash
docker run -p 8080:80 kuickphp/kuick
```

### Runtime configuration via environment variables

```bash
docker run -p 8080:80 \
    -e APP_ENV=dev \
    -e APP_NAME=ExampleApp \
    -e APP_CHARSET=UTF-8 \
    -e APP_LOCALE=pl_PL.utf-8 \
    -e APP_TIMEZONE="Europe/Warsaw" \
    -e APP_LOG_USEMICROSECONDS=1 \
    -e APP_LOG_LEVEL=DEBUG \
    -e API_SECURITY_OPS_GUARD_TOKEN=secret-token \
    kuickphp/kuick:alpine
```

With `API_SECURITY_OPS_GUARD_TOKEN` set, you can access the OPS endpoint:

```bash
curl -H "Authorization: Bearer secret-token" http://localhost:8080/api/ops
```

## Development & Testing

```bash
composer test:all      # run all checks (PSR-12, PHPStan, PHPMD, PHPUnit)
composer test:phpcs    # PSR-12 code style
composer test:phpstan  # static analysis (level 9)
composer test:phpmd    # mess detector
composer test:phpunit  # unit tests with coverage
composer fix:phpcbf    # auto-fix code style issues

make test              # run the full CI suite inside Docker
```

## License

[MIT](LICENSE)
