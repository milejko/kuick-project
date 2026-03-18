# Copilot Instructions

## Commands

```bash
# Run all checks (PSR-12, PHPStan level 9, PHPMD, PHPUnit with coverage)
composer test:all

# Individual checks
composer test:phpcs       # PSR-12 code style
composer test:phpstan     # Static analysis
composer test:phpmd       # Mess detector
composer test:phpunit     # Unit tests with coverage

# Auto-fix code style
composer fix:phpcbf

# Run a single test class or method
XDEBUG_MODE=coverage phpunit --filter HelloControllerTest
XDEBUG_MODE=coverage phpunit --filter testIfKuickSaysHelloToTheWorld

# Local dev server (Docker, mounts source as volume on port 8080)
make up

# Run full CI suite in Docker
make test
```

## Architecture

The app is built on [Kuick Framework](https://github.com/milejko/kuick-framework) with two entry points:
- **`public/index.php`** — Web: creates a `WebKernel`, dispatches `RequestReceivedEvent` via PSR-14
- **`bin/console`** — CLI: creates a `ConsoleKernel`, retrieves Symfony `Application` from the DI container

The framework wires everything through PHP-DI. Application code lives in `src/` (`App\` namespace); tests in `tests/Unit/` (`Tests\Unit\App\` namespace).

### Configuration (`config/`)

All config files return PHP arrays of typed Config objects. The framework loads them automatically:

| File | Purpose |
|---|---|
| `app.routes.php` | HTTP routes → `RouteConfig` objects |
| `app.guards.php` | Security guards → `GuardConfig` objects |
| `app.middlewares.php` | PSR-15 middleware → `MiddlewareConfig` objects |
| `app.commands.php` | Console commands → `CommandConfig` objects |
| `app.listeners.php` | Event listeners → `ListenerConfig` objects |
| `config/di/app.di.php` | PHP-DI definitions; use `env('VAR', 'default')` for env vars |

**Environment-specific overrides** use an `@env` filename suffix — e.g., `app.routes@dev.php` is only loaded in `dev`, `app.guards@prod.php` only in `prod`. The same convention applies to DI files (`config/di/app.di@dev.php`).

## Conventions

### Controllers and Guards — invokable classes

All controllers and guards are single-method invokable classes:

```php
// Controller: receives PSR-7 request, returns JsonResponse
class HelloController
{
    public function __invoke(ServerRequestInterface $request): JsonResponse { … }
}

// Guard: returns void on success, throws HttpException on failure
class SampleGuard
{
    public function __invoke(ServerRequestInterface $request): void
    {
        if (!$request->getHeaderLine('Authorization')) {
            throw new HttpException(JsonResponse::HTTP_UNAUTHORIZED, 'Unauthorized request');
        }
    }
}
```

### Routes use regex named capture groups for path parameters

```php
new RouteConfig('/hello/(?<name>[a-zA-Z0-9-]+)', HelloController::class),
new RouteConfig('/ping', PingController::class, ['GET', 'POST']), // method list is optional
```

### Console commands extend Symfony Command

```php
class HelloCommand extends Command
{
    protected function configure(): void { $this->addArgument(…); }
    protected function execute(InputInterface $input, OutputInterface $output): int { … return 0; }
}
```
Register in `config/app.commands.php`: `new CommandConfig('app:hello', HelloCommand::class, 'Description')`.

### Tests — use `#[CoversClass]` and instantiate directly

Tests use both the `#[CoversClass]` attribute and `@covers` docblock. Controllers and guards are instantiated directly (no DI); use `Nyholm\Psr7\ServerRequest` for PSR-7 request objects:

```php
#[CoversClass(HelloController::class)]
class HelloControllerTest extends TestCase
{
    public function testIfKuickSaysHelloToTheWorld(): void
    {
        $response = (new HelloController())(new ServerRequest('GET', '/'));
        $this->assertEquals(200, $response->getStatusCode());
    }
}
```

PHPUnit is configured strict: coverage metadata is required (`requireCoverageMetadata="true"`), and warnings/risky tests cause failures.

### PSR-12 + PHPStan level 9

All code in `src/` and `tests/Unit/` must pass PSR-12 (`phpcs`) and PHPStan at level 9.
