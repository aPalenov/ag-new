#!/bin/sh

set -e

DOCKER_PREFIX_NAME="ag-new-"

DOCKER_APP_ENV="local"
while :; do
    case $1 in
    -a | --prod)
        DOCKER_APP_ENV="production"
        ;;
    *) break ;;
    esac
    shift
done

COMPOSE_FILE=""
# Build base image PHP with 'production' and 'development' tags
if [ "$DOCKER_APP_ENV" = "production" ]; then
    DOCKER_USER="nginx"
    DOCKER_GROUP="www"
    DOCKER_USER="$(id -un)"
        DOCKER_GROUP="$(id -gn $DOCKER_USER)"
    COMPOSE_FILE="--file=docker-compose.prod.yml"
else
    DOCKER_USER="$(id -un)"
    DOCKER_GROUP="$(id -gn $DOCKER_USER)"
    COMPOSE_FILE="--file=docker-compose.dev.yml"
fi

DOCKER_UID="$(id -u $DOCKER_USER)"
DOCKER_GID="$(getent group $DOCKER_GROUP | cut -d: -f3)"
export DOCKER_USER
export DOCKER_UID
export DOCKER_GROUP
export DOCKER_GID

# Сборка контейнеров
docker compose --file=docker-compose.yml $COMPOSE_FILE up --build --pull always -d --remove-orphans

# Build base image PHP with 'production' and 'development' tags
if [ "$DOCKER_APP_ENV" = "production" ]; then
    docker compose --file=docker-compose.yml $COMPOSE_FILE exec backend sh -c " \
        composer install --no-dev --no-interaction --optimize-autoloader --ignore-platform-reqs && \
        php artisan app:deploy && \
        npm i && \
        npm run generate && \
        npm run build \
    "

    docker compose --file=docker-compose.yml $COMPOSE_FILE restart horizon
    docker compose --file=docker-compose.yml $COMPOSE_FILE restart cron
fi

docker ps -f "name=^${DOCKER_PREFIX_NAME}*"
