FROM node:22-alpine

WORKDIR /var/www/html/frontend

# Set user
ARG DOCKER_USER
ARG DOCKER_UID
ARG DOCKER_GROUP
ARG DOCKER_GID

# Set user as environment variables
ENV DOCKER_USER=$DOCKER_USER
ENV DOCKER_UID=$DOCKER_UID
ENV DOCKER_GROUP=$DOCKER_GROUP
ENV DOCKER_GID=$DOCKER_GID

# Install shadow package to modify user and group
RUN apk add --no-cache shadow

# Modify node user and group
RUN groupmod -g "${DOCKER_GID}" node && \
    usermod -u "${DOCKER_UID}" -g "${DOCKER_GID}" node

# Ensure ownership of the working directory
RUN chown -R node:node /var/www/html/frontend

USER $DOCKER_UID:$DOCKER_GID

EXPOSE 3000

CMD ["tail", "-f", "/dev/null"]
