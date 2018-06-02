# Project lulyb

[ ![Codeship Status for ndreux/lulyb](https://app.codeship.com/projects/84a9a5e0-48a9-0136-6554-029627939682/status?branch=master)](https://app.codeship.com/projects/292412)
[![Maintainability](https://api.codeclimate.com/v1/badges/06652852d9ac7a8022fa/maintainability)](https://codeclimate.com/github/ndreux/lulyb/maintainability)

## Installation

If you need a working dev environment and have Docker/Docker Compose, run `docker-compose up -d`
It will install php v7.1 and composer.

Otherwise, just use:
```
composer install
```
or
```
docker-compose exec bully composer install
```

It installs `phpunit` and use composer autoloader.

## Run the app

To run the app, just use:
```
php main.php
```
or
```
docker-compose exec bully php main.php
```

## Test

To run the tests, just use:

```
php vendor/bin/phpunit
```
or
```
docker-compose exec bully vendor/bin/phpunit
```
