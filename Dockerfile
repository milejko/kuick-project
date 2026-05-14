ARG PHP_VERSION=8.5 \
    SERVER_VARIANT=apache \
    OS_VARIANT=noble

###################
# Base PHP target #
###################
FROM milejko/php:${PHP_VERSION}-${SERVER_VARIANT}-${OS_VARIANT} AS base

#########################################################
# Distribution target (ie. for production environments) #
#########################################################
FROM base AS dist

ENV APP_NAME=Kuick@Docker \
    OPCACHE_VALIDATE_TIMESTAMPS=0 \
    # empty token by default, you should provide one through environment variables
    API_SECURITY_OPS_GUARD_TOKEN=

COPY --link etc/apache2 /etc/apache2
COPY --link bin bin
COPY --link config config
COPY --link src src
COPY --link public public
COPY --link composer.json composer.json

RUN set -eux; \
    mkdir -pm 777 var/cache; \
    composer install \ 
        --prefer-dist \
        --classmap-authoritative \
        --no-dev \
        --no-scripts \
        --no-plugins

######################
# Test runner target #
######################
FROM base AS test-runner

ENV XDEBUG_ENABLE=1 \
    XDEBUG_MODE=coverage

#####################
# Dev server target #
#####################
FROM base AS dev-server

ENV APP_ENV=dev \
    APP_LOG_LEVEL=debug \
    APP_LOG_USEMICROSECONDS=1 \
    API_SECURITY_OPS_GUARD_TOKEN=let-me-in \
    XDEBUG_ENABLE=1 \
    XDEBUG_MODE=develop \
    OPCACHE_VALIDATE_TIMESTAMPS=1

COPY ./etc/apache2 /etc/apache2
