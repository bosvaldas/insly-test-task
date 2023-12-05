# Test task

## Setup

Run the following commands to bootstrap and start the application:
```shell
cp -n .env.example .env

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

vendor/bin/sail up --build -d

vendor/bin/sail artisan key:generate
vendor/bin/sail artisan migrate
```

Validate successful setup by running tests:
```shell
vendor/bin/sail test
```
