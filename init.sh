#!/bin/bash

docker-compose down
# Build the container
docker-compose build

# Start Docker Compose in detached mode
docker-compose up -d

# Wait for Docker Compose to finish starting
while ! docker-compose ps | grep -q "Up"; do
    sleep 1
done

# Wait for Composer to install dependencies (assuming it's used in your project)
docker exec -it laravel composer install

# Run migrations (adjust the command as per your application)
docker exec -it laravel php artisan migrate:fresh

# Run seeds (adjust the command as per your application)
docker exec -it laravel php artisan db:seed

echo "Deployment complete!"
