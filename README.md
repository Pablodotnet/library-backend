#### Description
Library system simulation for Maniak

#### Build Setup

Make sure to have Docker & Docker Compose installed or if you don't have them download Docker Desktop from
https://www.docker.com/products/docker-desktop

``` bash
# On project directory copy .env.example to .env
cp .env.example .env

# Start all containers with all the setup
docker-compose up -d

# When finish running
docker-compose exec app bash

# Installing dependencies
composer install

# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# Run tests
composer test

# On browser
https://localhost

```

