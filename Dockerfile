# syntax=docker/dockerfile:1.6

ARG PHP_VERSION=8.3 \
    SERVER_VARIANT=apache \
    OS_VARIANT=jammy

###################
# Base PHP target #
###################
FROM milejko/php:${PHP_VERSION}-${SERVER_VARIANT}-${OS_VARIANT} AS base

#########################################################
# Distribution target (ie. for production environments) #
#########################################################
FROM base AS dist

ENV KUICK_APP_NAME=Kuick@Docker \
    OPCACHE_VALIDATE_TIMESTAMPS=0

COPY --link etc/apache2 /etc/apache2
COPY --link bin bin
COPY --link config config
COPY --link src src
COPY --link public public
COPY --link version.* public/
COPY --link composer.* ./

RUN set -eux; \
    mkdir -m 777 var; \
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
    XDEBUG_MODE=coverage \
    OPCACHE_VALIDATE_TIMESTAMPS=1

#####################
# Dev server target #
#####################
FROM test-runner AS dev-server

COPY ./etc/apache2 /etc/apache2
